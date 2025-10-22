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
                    $paperModel = new \App\Models\Paper();
                    $data['papers'] = $paperModel->findByAuthor($userId);
                    break;
                case 2: // Reviewer
                    $title = 'Reviewer Dashboard';
                    $assignmentModel = new \App\Models\Assignment();
                    $data['assignments'] = $assignmentModel->getPendingAssignmentsByReviewer($userId);
                    break;
                case 3: // Editor
                    $title = 'Editor Dashboard';
                    $paperModel = new \App\Models\Paper();
                    $data['submitted_papers'] = $paperModel->getSubmittedPapers();
                    $data['decision_papers'] = $paperModel->getPapersReadyForDecision();
                    break;
                case 4: // Librarian
                    $title = 'Library Management';
                    $libraryModel = new \App\Models\Library();
                    $data['published_papers'] = $libraryModel->getPublishedPapers();
                    break;
                case 5: // Admin
                    $title = 'Admin Dashboard';
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