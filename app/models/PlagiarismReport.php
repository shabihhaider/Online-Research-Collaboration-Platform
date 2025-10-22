<?php
namespace App\Models;

use App\Core\Database;

class PlagiarismReport
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create($paperId, $reportedBy, $reason, $evidence)
    {
        $sql = "INSERT INTO plagiarism_reports (paper_id, reported_by, reason, evidence, status) 
                VALUES (:paper_id, :reported_by, :reason, :evidence, 'Pending')";
        try {
            $this->db->query($sql, [
                ':paper_id' => $paperId,
                ':reported_by' => $reportedBy,
                ':reason' => $reason,
                ':evidence' => $evidence
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getAllReports()
    {
        $sql = "SELECT pr.*, p.title as paper_title, u.name as reporter_name 
                FROM plagiarism_reports pr
                JOIN papers p ON pr.paper_id = p.id
                JOIN users u ON pr.reported_by = u.id
                ORDER BY pr.created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function updateStatus($reportId, $status, $adminNotes = '')
    {
        $sql = "UPDATE plagiarism_reports 
                SET status = :status, admin_notes = :admin_notes, reviewed_at = NOW() 
                WHERE id = :id";
        try {
            $this->db->query($sql, [
                ':status' => $status,
                ':admin_notes' => $adminNotes,
                ':id' => $reportId
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}