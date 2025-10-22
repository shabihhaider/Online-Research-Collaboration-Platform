<?php
// app/models/Paper.php

namespace App\Models;

use App\Core\Database;

class Paper
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Create a new paper record in the database.
     *
     * @param int $authorId The ID of the submitting user.
     * @param string $title The paper's title.
     * @param string $abstract The paper's abstract.
     * @param string $keywords Comma-separated keywords.
     * @param string $filePath The path to the stored file.
     * @return bool True on success, false on failure.
     */
    public function create($authorId, $title, $abstract, $keywords, $filePath)
    {
        $sql = "INSERT INTO papers (author_id, title, abstract, keywords, file_path, status) 
                VALUES (:author_id, :title, :abstract, :keywords, :file_path, 'Submitted')";

        try {
            $this->db->query($sql, [
                ':author_id' => $authorId,
                ':title' => $title,
                ':abstract' => $abstract,
                ':keywords' => $keywords,
                ':file_path' => $filePath
            ]);
            return true;
        } catch (\Exception $e) {
            // In a real application, you would log this error.
            return false;
        }
    }

    /**
     * Find all papers submitted by a specific author.
     *
     * @param int $authorId The user's ID.
     * @return array An array of paper records.
     */
    public function findByAuthor($authorId)
    {
        $sql = "SELECT * FROM papers WHERE author_id = :author_id ORDER BY submitted_at DESC";
        
        $stmt = $this->db->query($sql, [':author_id' => $authorId]);
        return $stmt->fetchAll();
    }

    /**
     * Get all papers with the 'Submitted' status.
     *
     * @return array An array of submitted paper records.
     */
    public function getSubmittedPapers()
    {
        // We join with the 'users' table to get the author's name
        $sql = "SELECT p.id, p.title, p.submitted_at, u.name as author_name
                FROM papers p
                JOIN users u ON p.author_id = u.id
                WHERE p.status = 'Submitted'
                ORDER BY p.submitted_at ASC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Find a single paper by its ID.
     *
     * @param int $id The paper's ID.
     * @return mixed The paper record if found, or false.
     */
    public function findById($id)
    {
        $sql = "SELECT p.*, u.name as author_name 
                FROM papers p
                JOIN users u ON p.author_id = u.id
                WHERE p.id = :id 
                LIMIT 1";
        
        $stmt = $this->db->query($sql, [':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Update the status of a specific paper.
     *
     * @param int $id The paper's ID.
     * @param string $status The new status.
     * @return bool
     */
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE papers SET status = :status WHERE id = :id";

        try {
            $this->db->query($sql, [
                ':status' => $status,
                ':id' => $id
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get papers that are 'Under Review' and have no pending assignments.
     * This means all reviewers have submitted their feedback.
     *
     * @return array An array of paper records ready for a final decision.
     */
    public function getPapersReadyForDecision()
    {
        $sql = "SELECT p.id, p.title, u.name as author_name
                FROM papers p
                JOIN users u ON p.author_id = u.id
                WHERE p.status = 'Under Review' AND NOT EXISTS (
                    SELECT 1 
                    FROM assignments a 
                    WHERE a.paper_id = p.id AND a.status = 'Pending'
                )";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}