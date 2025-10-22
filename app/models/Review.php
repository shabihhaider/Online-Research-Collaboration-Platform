<?php
// app/models/Review.php

namespace App\Models;

use App\Core\Database;

class Review
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Create a new review record in the database.
     *
     * @param int $assignmentId
     * @param string $comments
     * @param int $score
     * @param string $recommendation
     * @return bool
     */
    public function create($assignmentId, $comments, $score, $recommendation)
    {
        $sql = "INSERT INTO reviews (assignment_id, comments, score, recommendation) 
                VALUES (:assignment_id, :comments, :score, :recommendation)";

        try {
            $this->db->query($sql, [
                ':assignment_id' => $assignmentId,
                ':comments' => $comments,
                ':score' => $score,
                ':recommendation' => $recommendation
            ]);
            return true;
        } catch (\Exception $e) {
            // In a real app, you would log this error
            return false;
        }
    }

    /**
     * Get all completed reviews for a specific paper.
     *
     * @param int $paperId The ID of the paper.
     * @return array An array of review records, including reviewer names.
     */
    public function getReviewsForPaper($paperId)
    {
        // This query joins reviews -> assignments -> users (as reviewers)
        // to collect all feedback for a single paper.
        $sql = "SELECT 
                    r.comments, 
                    r.score, 
                    r.recommendation, 
                    u.name as reviewer_name 
                FROM reviews r
                JOIN assignments a ON r.assignment_id = a.id
                JOIN users u ON a.reviewer_id = u.id
                WHERE a.paper_id = :paper_id";
        
        $stmt = $this->db->query($sql, [':paper_id' => $paperId]);
        return $stmt->fetchAll();
    }
}