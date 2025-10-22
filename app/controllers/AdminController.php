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
}