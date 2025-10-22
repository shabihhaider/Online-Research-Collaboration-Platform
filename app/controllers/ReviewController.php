<?php
// app/controllers/ReviewController.php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Assignment;
use App\Models\Review; // Import the new Review model

class ReviewController extends Controller
{
    protected $assignmentModel;
    protected $reviewModel; // Add a property for the new model

    public function __construct()
    {
        // Security check: Ensure user is logged in and is a Reviewer (role_id 2)
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 2) {
            http_response_code(403);
            die('Access Denied. You must be a reviewer to view this page.');
        }

        $this->assignmentModel = new Assignment();
        $this->reviewModel = new Review(); // Create an instance
    }

    /**
     * Show the form to submit a review for a specific assignment.
     *
     * @param int $id The ID of the assignment from the URL.
     */
    public function create($id)
    {
        // Fetch the assignment details using the ID from the URL
        $assignment = $this->assignmentModel->findById($id, $_SESSION['user']['id']);

        if (!$assignment) {
            http_response_code(404);
            die('Assignment not found.');
        }

        // Pass the assignment details to the view
        return $this->view('reviews/submit', [
            'title' => 'Submit Review',
            'assignment' => $assignment
        ]);
    }

    /**
     * Store the new review in the database.
     */
    public function store()
    {
        // 1. Get data from the form
        $assignmentId = $_POST['assignment_id'] ?? null;
        $comments = $_POST['comments'] ?? '';
        $score = $_POST['score'] ?? null;
        $recommendation = $_POST['recommendation'] ?? '';

        // 2. Basic validation
        if (empty($assignmentId) || empty($comments) || empty($score) || empty($recommendation)) {
            // In a real app, redirect back with an error message
            die('All fields are required.');
        }

        // 3. Save the review to the database
        $this->reviewModel->create($assignmentId, $comments, (int)$score, $recommendation);

        // 4. Update the assignment's status to 'Completed'
        $this->assignmentModel->updateStatus($assignmentId, 'Completed');

        // 5. Redirect the reviewer back to their dashboard
        header('Location: /');
        exit;
    }
}