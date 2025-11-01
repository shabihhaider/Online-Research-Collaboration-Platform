<?php
// app/controllers/ProfileController.php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        // Security check: User must be logged in
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }
        
        $this->userModel = new User();
    }

    /**
     * Show the user's profile editing form.
     */
    public function index()
    {
        // Get the current user's data from the database
        // We re-fetch it instead of just using the session in case data (like the pic) was updated
        $user = $this->userModel->findById($_SESSION['user']['id']);
        
        if (!$user) {
            // This should not happen if they are logged in, but it's a good failsafe
            $this->flash('error', 'Could not find your user profile.');
            $this->redirect('/');
        }
        
        return $this->view('profile/edit', [
            'title' => 'Edit My Profile',
            'user' => $user // Pass the full user record to the view
        ]);
    }

    /**
     * Store the updated profile data.
     */
    public function store()
    {
        // 1. Get form data
        $userId = $_SESSION['user']['id'];
        $name = $_POST['name'] ?? $_SESSION['user']['name'];
        $email = $_POST['email'] ?? $_SESSION['user']['email'];
        $file = $_FILES['profile_pic'] ?? null;

        $dbPath = null;
        $errors = [];

        // 2. Validate basic info
        if (empty($name)) {
            $errors[] = 'Name cannot be empty.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'A valid email is required.';
        }
        
        // 3. Check if email is being changed and is already taken
        if ($email !== $_SESSION['user']['email']) {
            if ($this->userModel->findByEmail($email)) {
                $errors[] = 'That email address is already in use by another account.';
            }
        }

        // 4. Handle File Upload, if one was provided
        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $maxSize = 5 * 1024 * 1024; // 5MB

            if (!in_array($file['type'], $allowedTypes)) {
                $errors[] = 'Invalid file type. Only JPG, PNG, GIF, or WEBP are allowed.';
            }
            if ($file['size'] > $maxSize) {
                $errors[] = 'File is too large. Maximum size is 5MB.';
            }

            if (empty($errors)) {
                // Create a unique file name
                $fileName = 'user_' . $userId . '_' . time() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
                
                // Set upload path
                $uploadDir = __DIR__ . '/../../public/uploads/avatars/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true); // Create directory if it doesn't exist
                }
                $uploadPath = $uploadDir . $fileName;

                // This is the relative web path we will save in the database
                $dbPath = '/uploads/avatars/' . $fileName;

                if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    $errors[] = 'Failed to move uploaded file. Check folder permissions.';
                }
            }
        }

        // 5. Handle Validation Failure
        if (!empty($errors)) {
            $this->flash('error', implode('<br>', $errors));
            $this->redirect('/profile');
        }

        // 6. Update Database
        $success = $this->userModel->updateProfile($userId, $name, $email, $dbPath);

        if ($success) {
            // Update the session with new data
            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['email'] = $email;
            
            // --- ADD THIS LOGIC ---
            // If a new picture was uploaded, update it in the session
            if ($dbPath) {
                $_SESSION['user']['profile_pic'] = $dbPath;
            }
            // --- END ADD ---

            $this->flash('success', 'Profile updated successfully!');
            $this->redirect('/profile');
        } else {
            $this->flash('error', 'An error occurred while updating your profile.');
            $this->redirect('/profile');
        }
    }
}