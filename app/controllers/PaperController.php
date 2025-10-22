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
}