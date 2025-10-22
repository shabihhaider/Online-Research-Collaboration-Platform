<?php
// app/controllers/PaperController.php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Paper; // We need to use the Paper model

class PaperController extends Controller
{
    protected $paperModel;

    public function __construct()
    {
        // Create an instance of the Paper model
        $this->paperModel = new Paper();
    }

    /**
     * Show the paper submission form.
     */
    public function create()
    {
        // First, check if the user is logged in.
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        // The user is logged in, so show the submission form.
        return $this->view('papers/submit', [
            'title' => 'Submit New Paper'
        ]);
    }

    /**
     * Store a new paper submission in the database.
     */
    public function store()
    {
        // 1. Check if user is logged in.
        if (!isset($_SESSION['user'])) {
            http_response_code(403);
            die('You are not authorized.');
        }

        // 2. Get form data and file
        $title = $_POST['title'] ?? '';
        $abstract = $_POST['abstract'] ?? '';
        $keywords = $_POST['keywords'] ?? '';
        $authorId = $_SESSION['user']['id'];
        $file = $_FILES['paper_file'] ?? null;

        // 3. Validation
        $errors = [];
        if (empty($title)) $errors[] = 'Title is required.';
        if (empty($abstract)) $errors[] = 'Abstract is required.';
        if (empty($keywords)) $errors[] = 'Keywords are required.';

        // File validation
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'File upload failed or no file was selected.';
        } else {
            // Check file type
            $allowedTypes = [
                'application/pdf', // PDF
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document' // .docx
            ];
            if (!in_array($file['type'], $allowedTypes)) {
                $errors[] = 'Invalid file type. Only PDF and DOCX are allowed.';
            }

            // Check file size (e.g., 10MB max)
            $maxSize = 10 * 1024 * 1024; // 10 megabytes
            if ($file['size'] > $maxSize) {
                $errors[] = 'File is too large. Maximum size is 10MB.';
            }
        }

        // 4. Handle Validation Failure
        if (!empty($errors)) {
            $this->flash('error', implode('<br>', $errors));
            $this->redirect('/submit');
        }

        // 5. Validation Success: Process File Upload
        
        // Create a unique file name to prevent overwriting other files
        $fileName = time() . '_' . basename($file['name']);
        
        // This is the absolute server path to move the file to
        $uploadDir = __DIR__ . '/../../public/uploads/';
        $uploadPath = $uploadDir . $fileName;

        // This is the relative web path we will save in the database
        $dbPath = '/uploads/' . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            die('Failed to move uploaded file. Check folder permissions.');
        }

        // 6. Save to Database
        $success = $this->paperModel->create($authorId, $title, $abstract, $keywords, $dbPath);

        if ($success) {
            // Redirect to the homepage (which is now their dashboard)
            header('Location: /');
            exit;
        } else {
            die('An error occurred while saving your paper to the database.');
        }
    }

    /**
     * Show the revision form for a paper
     */
    public function reviseIndex($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $paper = $this->paperModel->findById($id);
        
        // Security: Only the author can revise their own paper
        if (!$paper || $paper['author_id'] != $_SESSION['user']['id']) {
            http_response_code(403);
            die('Unauthorized');
        }

        // Only allow revision if status is "Revision Requested"
        if ($paper['status'] !== 'Revision Requested') {
            $this->flash('error', 'This paper is not available for revision.');
            $this->redirect('/');
        }

        // Get the reviews/feedback
        $reviewModel = new \App\Models\Review();
        $reviews = $reviewModel->getReviewsForPaper($id);

        return $this->view('papers/revise', [
            'title' => 'Submit Revision',
            'paper' => $paper,
            'reviews' => $reviews
        ]);
    }

    /**
     * Handle revision submission
     */
    public function reviseStore()
    {
        if (!isset($_SESSION['user'])) {
            http_response_code(403);
            die('Unauthorized');
        }

        $paperId = $_POST['paper_id'] ?? null;
        $revisionNotes = $_POST['revision_notes'] ?? '';
        $file = $_FILES['paper_file'] ?? null;

        if (!$paperId) {
            $this->flash('error', 'Invalid paper ID.');
            $this->redirect('/');
        }

        // Handle file upload if provided
        $dbPath = null;
        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $fileName = time() . '_revision_' . basename($file['name']);
            $uploadDir = __DIR__ . '/../../public/uploads/';
            $uploadPath = $uploadDir . $fileName;
            $dbPath = '/uploads/' . $fileName;

            if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
                $this->flash('error', 'File upload failed.');
                $this->redirect('/paper/revise/' . $paperId);
            }
        }

        // Get database instance
        $db = \App\Core\Database::getInstance();

        // Update paper with new file and notes
        if ($dbPath) {
            $sql = "UPDATE papers SET file_path = :file_path, revision_notes = :notes, status = 'Submitted', submitted_at = NOW() WHERE id = :id";
            $db->query($sql, [
                ':file_path' => $dbPath,
                ':notes' => $revisionNotes,
                ':id' => $paperId
            ]);
        } else {
            $sql = "UPDATE papers SET revision_notes = :notes, status = 'Submitted', submitted_at = NOW() WHERE id = :id";
            $db->query($sql, [
                ':notes' => $revisionNotes,
                ':id' => $paperId
            ]);
        }

        $this->flash('success', 'Revision submitted successfully!');
        $this->redirect('/');
    }
}