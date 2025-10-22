<?php
// app/models/Assignment.php

namespace App\Models;

use App\Core\Database;

class Assignment
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Create a new assignment record.
     *
     * @param int $paperId
     * @param int $reviewerId
     * @param int $editorId
     * @return bool
     */
    public function create($paperId, $reviewerId, $editorId)
    {
        $sql = "INSERT INTO assignments (paper_id, reviewer_id, editor_id) VALUES (:paper_id, :reviewer_id, :editor_id)";

        try {
            $this->db->query($sql, [
                ':paper_id' => $paperId,
                ':reviewer_id' => $reviewerId,
                ':editor_id' => $editorId
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get all pending assignments for a specific reviewer.
     *
     * @param int $reviewerId The reviewer's user ID.
     * @return array An array of assigned papers.
     */
    public function getPendingAssignmentsByReviewer($reviewerId)
    {
        // We join with papers and users to get all necessary details
        $sql = "SELECT 
                    a.id as assignment_id,
                    p.id as paper_id,
                    p.title,
                    p.status,
                    u.name as author_name
                FROM assignments a
                JOIN papers p ON a.paper_id = p.id
                JOIN users u ON p.author_id = u.id
                WHERE a.reviewer_id = :reviewer_id AND a.status = 'Pending'";

        $stmt = $this->db->query($sql, [':reviewer_id' => $reviewerId]);
        return $stmt->fetchAll();
    }

    /**
     * Find a single assignment by its ID, ensuring it belongs to the correct reviewer.
     *
     * @param int $assignmentId The assignment's ID.
     * @param int $reviewerId The ID of the currently logged-in reviewer.
     * @return mixed The assignment record if found and owned, or false.
     */
    public function findById($assignmentId, $reviewerId)
    {
        $sql = "SELECT 
                    a.id as assignment_id, p.id as paper_id, p.title,
                    p.abstract, p.file_path, u.name as author_name
                FROM assignments a
                JOIN papers p ON a.paper_id = p.id
                JOIN users u ON p.author_id = u.id
                WHERE a.id = :assignment_id AND a.reviewer_id = :reviewer_id
                LIMIT 1";

        $stmt = $this->db->query($sql, [
            ':assignment_id' => $assignmentId,
            ':reviewer_id' => $reviewerId
        ]);
        return $stmt->fetch();
    }

    /**
     * Update the status of a specific assignment.
     *
     * @param int $assignmentId The assignment's ID.
     * @param string $status The new status (e.g., 'Completed').
     * @return bool
     */
    public function updateStatus($assignmentId, $status)
    {
        $sql = "UPDATE assignments SET status = :status WHERE id = :id";

        try {
            $this->db->query($sql, [
                ':status' => $status,
                ':id' => $assignmentId
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}