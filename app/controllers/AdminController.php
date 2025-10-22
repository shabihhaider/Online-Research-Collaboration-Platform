<?php
// app/controllers/AdminController.php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User; // We will need the User model

class AdminController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        // This is a security check that runs before ANY method in this controller
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 5) {
            // Role 5 is 'Admin' (based on our database setup)
            http_response_code(403);
            die('Access Denied. You must be an administrator to view this page.');
        }

        // If the check passes, create the user model instance
        $this->userModel = new User();
    }

    /**
     * Show the user management page.
     */
    public function users()
    {
        // Fetch the list of pending users
        $pendingUsers = $this->userModel->getPendingUsers();

        // Pass that list to the view
        return $this->view('admin/users', [
            'title' => 'Manage Users',
            'users' => $pendingUsers // This now contains the list
        ]);
    }

    /**
     * Approve a user registration.
     */
    public function approve()
    {
        // Get the user ID from the form submission
        $userId = $_POST['user_id'] ?? null;

        if ($userId) {
            // Call the model method to approve the user
            $this->userModel->approveUser((int)$userId);
        }

        // Redirect the admin back to the user management page
        header('Location: /admin/users');
        exit;
    }

    /**
     * Show plagiarism reports dashboard
     */
    public function plagiarismReports()
    {
        // You'll need a PlagiarismReport model
        $plagiarismModel = new \App\Models\PlagiarismReport();
        $reports = $plagiarismModel->getAllReports();
        
        return $this->view('admin/plagiarism', [
            'title' => 'Plagiarism Reports',
            'reports' => $reports
        ]);
    }

    /**
     * Show system analytics
     */
    public function analytics()
    {
        $paperModel = new \App\Models\Paper();
        $userModel = new \App\Models\User();
        
        $stats = [
            'total_papers' => $paperModel->getTotalCount(),
            'papers_by_status' => $paperModel->getCountByStatus(),
            'papers_this_month' => $paperModel->getCountThisMonth(),
            'total_users' => $userModel->getTotalCount(),
            'users_by_role' => $userModel->getCountByRole(),
            'monthly_submissions' => $paperModel->getMonthlySubmissions(12)
        ];
        
        return $this->view('admin/analytics', [
            'title' => 'System Analytics',
            'stats' => $stats
        ]);
    }

    /**
     * Manage paper categories
     */
    public function categories()
    {
        $categoryModel = new \App\Models\Category();
        $categories = $categoryModel->getAll();
        
        return $this->view('admin/categories', [
            'title' => 'Manage Categories',
            'categories' => $categories
        ]);
    }

    /**
     * Add new category
     */
    public function addCategory()
    {
        $name = $_POST['category_name'] ?? '';
        $description = $_POST['description'] ?? '';
        
        if (!empty($name)) {
            $categoryModel = new \App\Models\Category();
            $categoryModel->create($name, $description);
        }
        
        $this->redirect('/admin/categories');
    }

    /**
     * Update plagiarism report status
     */
    public function updatePlagiarismReport()
    {
        $reportId = $_POST['report_id'] ?? null;
        $status = $_POST['status'] ?? '';
        $adminNotes = $_POST['admin_notes'] ?? '';
        
        if ($reportId && $status) {
            $plagiarismModel = new \App\Models\PlagiarismReport();
            $plagiarismModel->updateStatus($reportId, $status, $adminNotes);
        }
        
        $this->redirect('/admin/plagiarism');
    }

    /**
     * Edit category
     */
    public function editCategory()
    {
        $categoryId = $_POST['category_id'] ?? null;
        $name = $_POST['category_name'] ?? '';
        $description = $_POST['description'] ?? '';
        
        if ($categoryId && $name) {
            $categoryModel = new \App\Models\Category();
            $categoryModel->update($categoryId, $name, $description);
        }
        
        $this->redirect('/admin/categories');
    }

    /**
     * Delete category
     */
    public function deleteCategory()
    {
        $categoryId = $_POST['category_id'] ?? null;
        
        if ($categoryId) {
            $categoryModel = new \App\Models\Category();
            $categoryModel->delete($categoryId);
        }
        
        $this->redirect('/admin/categories');
    }
}