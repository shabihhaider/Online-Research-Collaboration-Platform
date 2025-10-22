<?php
// app/controllers/LibrarianController.php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Library;

class LibrarianController extends Controller
{
    protected $libraryModel;

    public function __construct()
    {
        // Security check
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 4) {
            http_response_code(403);
            die('Access Denied. You must be a librarian to view this page.');
        }

        $this->libraryModel = new Library();
    }

    public function edit($id)
    {
        $libraryEntry = $this->libraryModel->findById($id);

        if (!$libraryEntry) {
            http_response_code(404);
            die('Library entry not found.');
        }

        return $this->view('librarian/edit', [
            'title' => 'Edit Citation',
            'entry' => $libraryEntry
        ]);
    }

    /**
     * Update the citation for a library entry.
     */
    public function update()
    {
        // 1. Get data from the form
        $libraryId = $_POST['library_id'] ?? null;
        $citation = $_POST['citation'] ?? '';

        // 2. Basic validation
        if (empty($libraryId)) {
            die('Invalid data provided.');
        }

        // 3. Call the model to update the database
        $this->libraryModel->updateCitation($libraryId, $citation);

        // 4. Redirect the librarian back to their dashboard
        header('Location: /');
        exit;
    }
}