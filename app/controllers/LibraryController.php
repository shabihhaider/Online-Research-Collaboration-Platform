<?php
// app/controllers/LibraryController.php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Library; // We will use the Library model

class LibraryController extends Controller
{
    protected $libraryModel;

    public function __construct()
    {
        // Note: No security check. This is a public controller.
        $this->libraryModel = new Library();
    }

    /**
     * Show the main public library browsing page.
     * This will power the '/library' route.
     */
    public function index()
    {
        // Fetch all published papers using the existing model function
        $papers = $this->libraryModel->getPublishedPapers();
        
        return $this->view('library/index', [
            'title' => 'Research Library',
            'papers' => $papers
        ]);
    }

    /**
     * Show the single page for a specific paper.
     * This is the method that fixes your 404 error for '/library/paper/{id}'
     *
     * @param int $id The ID of the paper (not the library ID).
     */
    public function show($id)
    {
        // We need a new model function for this. See Step 2.
        $paper = $this->libraryModel->findPublishedPaperById($id);

        if (!$paper) {
            http_response_code(404);
            die('404 - Paper not found in library.');
        }
        
        // Split keywords into an array for the view
        $paper['keywords_array'] = array_filter(array_map('trim', explode(',', $paper['keywords'])));

        return $this->view('library/view', [
            'title' => $paper['title'],
            'paper' => $paper
        ]);
    }
}