<?php
// app/models/Library.php

namespace App\Models;

use App\Core\Database;

class Library
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Publish a paper by adding its ID to the library.
     *
     * @param int $paperId The ID of the paper to be published.
     * @return bool True on success, false on failure.
     */
    public function publish($paperId)
    {
        // The 'citation' can be added later by the Librarian.
        $sql = "INSERT INTO library (paper_id) VALUES (:paper_id)";

        try {
            $this->db->query($sql, [':paper_id' => $paperId]);
            return true;
        } catch (\Exception $e) {
            // In a real app, you would log this error.
            return false;
        }
    }

    /**
     * Get all published papers from the library.
     *
     * @return array An array of published paper records.
     */
    public function getPublishedPapers()
    {
        // This query joins the library, papers, and users tables
        // to get all the necessary details for the public-facing library.
        $sql = "SELECT 
                    l.id as library_id,
                    l.citation,
                    p.id as paper_id,
                    p.title,
                    u.name as author_name,
                    l.published_at
                FROM library l
                JOIN papers p ON l.paper_id = p.id
                JOIN users u ON p.author_id = u.id
                ORDER BY l.published_at DESC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Find a single library entry by its ID.
     *
     * @param int $libraryId The ID of the library entry.
     * @return mixed The record if found, or false.
     */
    public function findById($libraryId)
    {
        $sql = "SELECT 
                    l.id as library_id,
                    l.citation,
                    p.title
                FROM library l
                JOIN papers p ON l.paper_id = p.id
                WHERE l.id = :library_id 
                LIMIT 1";
        
        $stmt = $this->db->query($sql, [':library_id' => $libraryId]);
        return $stmt->fetch();
    }

    /**
     * Update the citation for a specific library entry.
     *
     * @param int $libraryId The ID of the library entry.
     * @param string $citation The new citation text.
     * @return bool True on success, false on failure.
     */
    public function updateCitation($libraryId, $citation)
    {
        $sql = "UPDATE library SET citation = :citation WHERE id = :id";

        try {
            $this->db->query($sql, [
                ':citation' => $citation,
                ':id' => $libraryId
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}