<?php
// app/controllers/EditorController.php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Paper;
use App\Models\User;
use App\Models\Assignment;
use App\Models\Review;
use App\Models\Library;

class EditorController extends Controller
{
    protected $paperModel;
    protected $userModel;
    protected $assignmentModel;
    protected $reviewModel;
    protected $libraryModel;

    public function __construct()
    {
        // Security check: Ensure user is logged in and is an Editor (role_id 3)
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 3) {
            http_response_code(403);
            die('Access Denied. You must be an editor to view this page.');
        }

        // Instantiate all necessary models
        $this->paperModel = new Paper();
        $this->userModel = new User();
        $this->assignmentModel = new Assignment();
        $this->reviewModel = new Review();
        $this->libraryModel = new Library();
    }

    /**
     * Show the page to assign reviewers to a specific paper.
     *
     * @param int $id The ID of the paper from the URL.
     */
    public function assignIndex($id)
    {
        // Fetch the specific paper using the ID from the URL
        $paper = $this->paperModel->findById($id);

        // Fetch all available reviewers
        $reviewers = $this->userModel->getReviewers();

        // If the paper doesn't exist, show a 404 error
        if (!$paper) {
            http_response_code(404);
            die('Paper not found.');
        }

        // Pass the paper details and the list of reviewers to the view
        return $this->view('editor/assign', [
            'title' => 'Assign Reviewers',
            'paper' => $paper,
            'reviewers' => $reviewers
        ]);
    }

    /**
     * Store the new reviewer assignments in the database.
     */
    public function assignStore()
    {
        // 1. Get data from the form
        $paperId = $_POST['paper_id'] ?? null;
        $reviewerIds = $_POST['reviewer_ids'] ?? [];
        $editorId = $_SESSION['user']['id'];

        // 2. Basic validation
        if (empty($paperId) || empty($reviewerIds)) {
            // In a real app, redirect back with an error message
            die('You must select at least one reviewer.');
        }

        // 3. Create an assignment for each selected reviewer
        foreach ($reviewerIds as $reviewerId) {
            $this->assignmentModel->create($paperId, $reviewerId, $editorId);
        }

        // 4. Update the paper's status to 'Under Review'
        $this->paperModel->updateStatus($paperId, 'Under Review');

        // 5. Redirect the editor back to their dashboard
        header('Location: /');
        exit;
    }

    /**
     * Show the page for an editor to make a final decision on a paper.
     *
     * @param int $id The ID of the paper from the URL.
     */
    public function decisionIndex($id)
    {
        // 1. Fetch the paper's main details
        $paper = $this->paperModel->findById($id);

        if (!$paper) {
            http_response_code(404);
            die('Paper not found.');
        }

        // 2. Fetch all completed reviews for this paper
        $reviews = $this->reviewModel->getReviewsForPaper($id);

        // 3. Pass all data to the view
        return $this->view('editor/decision', [
            'title' => 'Make Final Decision',
            'paper' => $paper,
            'reviews' => $reviews
        ]);
    }

    /**
     * Store the editor's final decision.
     */
    public function decisionStore()
    {
        // 1. Get data from the form
        $paperId = $_POST['paper_id'] ?? null;
        $decision = $_POST['decision'] ?? null; // 'Accepted', 'Rejected', or 'Revision Requested'

        if (empty($paperId) || empty($decision)) {
            die('Invalid decision data.');
        }

        // 2. Process the decision
        if ($decision === 'Accepted') {
            $this->paperModel->updateStatus($paperId, 'Accepted');
            $this->libraryModel->publish($paperId);
        } elseif ($decision === 'Rejected') {
            $this->paperModel->updateStatus($paperId, 'Rejected');
        } elseif ($decision === 'Revision Requested') {
            // This is the new logic
            $this->paperModel->updateStatus($paperId, 'Revision Requested');
        }

        // 3. Redirect the editor back to their dashboard
        header('Location: /');
        exit;
    }
}