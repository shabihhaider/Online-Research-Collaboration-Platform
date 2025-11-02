<?php
// app/controllers/PagesController.php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Paper;
use App\Models\Assignment;
use App\Models\Library; // Import the Library model

class PagesController extends Controller
{
    /**
     * Show the home page.
     */
    public function home()
    {
        $data = [];
        $title = 'Homepage';

        if (isset($_SESSION['user'])) {
            $roleId = $_SESSION['user']['role_id'];
            $userId = $_SESSION['user']['id'];

            switch ($roleId) {
                case 1: // Researcher
                    $title = 'My Dashboard';
                    
                    // Load their own submissions
                    $paperModel = new \App\Models\Paper();
                    $data['papers'] = $paperModel->findByAuthor($userId);
                    
                    // Load the public library
                    $libraryModel = new \App\Models\Library();
                    $data['published_papers'] = $libraryModel->getPublishedPapers();
                    break;
                case 2: // Reviewer
                    $title = 'Reviewer Dashboard';
                    $assignmentModel = new \App\Models\Assignment();
                    
                    // Get both pending and completed assignments
                    $pending = $assignmentModel->getPendingAssignmentsByReviewer($userId);
                    $completed = $assignmentModel->getCompletedAssignmentsByReviewer($userId);
                    
                    // Pass data to the view
                    $data['assignments'] = $pending;
                    $data['completed_reviews'] = $completed;
                    
                    // Create stats for the new dashboard
                    $data['stats'] = [
                        'pending' => count($pending),
                        'completed' => count($completed)
                    ];
                    break;
                case 3: // Editor
                    $title = 'Editor Dashboard';
                    $paperModel = new \App\Models\Paper();
                    
                    // Get the data
                    $submitted = $paperModel->getSubmittedPapers();
                    $decisions = $paperModel->getPapersReadyForDecision();
                    
                    // Pass full data and counts
                    $data['submitted_papers'] = $submitted;
                    $data['decision_papers'] = $decisions;
                    $data['stats'] = [
                        'new_submissions' => count($submitted),
                        'awaiting_decision' => count($decisions)
                    ];
                    break;
               case 4: // Librarian
                    $title = 'Library Management';
                    $libraryModel = new \App\Models\Library();
                    
                    // Load the new stats
                    $data['stats'] = [
                        'total_published' => $libraryModel->getTotalPublishedCount(),
                        'pending_citations' => $libraryModel->getPendingCitationCount()
                    ];
                    
                    // Load the new "to-do" list
                    $data['pending_papers'] = $libraryModel->getPendingCitations();
                    
                    // Load the full list for reference
                    $data['all_papers'] = $libraryModel->getPublishedPapers();
                    break;
                case 5: // Admin
                    $title = 'Admin Dashboard';
                    $userModel = new \App\Models\User();
                    $paperModel = new \App\Models\Paper();
                    
                    // Load stats for the new dashboard
                    $data['stats'] = [
                        'total_users' => $userModel->getTotalCount(),
                        'total_papers' => $paperModel->getTotalCount(),
                        'pending_approvals' => count($userModel->getPendingUsers())
                    ];
                    break;
                default:
                    $title = 'Dashboard';
            }
        }

        return $this->view('pages/home', [
            'title' => $title,
            'data' => $data 
        ]);
    }
}