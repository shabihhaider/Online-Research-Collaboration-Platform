<?php
// app/controllers/AuthController.php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * Show the user registration form.
     */
    public function create()
    {
        return $this->view('auth/register', [
            'title' => 'Register'
        ]);
    }

    /**
     * Store a new user in the database.
     */
    public function store()
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $password_confirmation = $_POST['password_confirmation'] ?? '';
        $role_id = $_POST['role_id'] ?? 1; // Default to Researcher

        // --- 1. Validation ---
        $errors = [];

        if (empty($name)) {
            $errors[] = 'Name is required.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'A valid email is required.';
        }
        if (strlen($password) < 8) {
            $errors[] = 'Password must be at least 8 characters long.';
        }
        if ($password !== $password_confirmation) {
            $errors[] = 'Passwords do not match.';
        }

        // --- 2. Check if email already exists ---
        if ($this->userModel->findByEmail($email)) {
            $errors[] = 'An account with this email already exists.';
        }

        // --- 3. Handle Validation Failure ---
        if (!empty($errors)) {
            $this->flash('error', implode('<br>', $errors));
            $this->redirect('/register');
        }

        // --- 4. Validation Success: Create User ---
        
        // Hash the password securely
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Create the user
        $success = $this->userModel->create($name, $email, $passwordHash, (int)$role_id);

        if ($success) {
            // Redirect to the login page (which we will build next)
            header('Location: /login');
            exit;
        } else {
            die('An error occurred while creating your account. Please try again.');
        }
    }

    /**
     * Show the user login form.
     */
    public function loginIndex()
    {
        return $this->view('auth/login', [
            'title' => 'Login'
        ]);
    }

    /**
     * Process the login attempt.
     */
    public function loginStore()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // --- 1. Validation ---
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)) {
            // In a real app, we'd redirect back with an error.
            $this->flash('error', 'Invalid email or password.');
            $this->redirect('/login');
        }

        // --- 2. Find the user ---
        $user = $this->userModel->findByEmail($email);

        if (!$user) {
            // Email not found
            $this->flash('error', 'Invalid email or password.');
            $this->redirect('/login');
        }

        // --- 3. Verify the password ---
        if (!password_verify($password, $user['password_hash'])) {
            // Password does not match
            $this->flash('error', 'Invalid email or password.');
            $this->redirect('/login');
        }

        // --- 4. Check if user is approved by Admin ---
        if ($user['is_approved'] == 0) {
            $this->flash('error', 'Your account is pending approval by an administrator.');
            $this->redirect('/login');
        }

        // --- 5. Login Success: Create Session ---
        // Regenerate session ID to prevent session fixation
        session_regenerate_id(true);

        // Store user data in the session
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role_id' => $user['role_id']
        ];

        // Redirect to the homepage (which will become their dashboard)
        header('Location: /');
        exit;
    }

    /**
     * Log the user out by destroying the session.
     */
    public function logout()
    {
        // Unset all session variables
        $_SESSION = [];

        // Destroy the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finally, destroy the session
        session_destroy();

        // Redirect to the homepage
        header('Location: /');
        exit;
    }
}