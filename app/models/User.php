<?php
// app/models/User.php

namespace App\Models;

use App\Core\Database;

class User
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Find a user by their email address.
     *
     * @param string $email The email to search for.
     * @return mixed The user record if found, or false.
     */
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        
        $stmt = $this->db->query($sql, [':email' => $email]);
        return $stmt->fetch();
    }

    /**
     * Get all users who are not yet approved.
     *
     * @return array An array of pending user records.
     */
    public function getPendingUsers()
    {
        // We join with the 'roles' table to get the text name of their requested role
        $sql = "SELECT u.id, u.name, u.email, u.created_at, r.role_name 
                FROM users u
                JOIN roles r ON u.role_id = r.id
                WHERE u.is_approved = 0
                ORDER BY u.created_at ASC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
    
    /**
     * Create a new user in the database.
     *
     * @param string $name User's full name.
     * @param string $email User's email address.
     * @param string $passwordHash The hashed password.
     * @param int $roleId The ID for the 'Researcher' role (usually 1).
     * @return bool True on success, false on failure.
     */
    public function create($name, $email, $passwordHash, $roleId)
    {
        $sql = "INSERT INTO users (name, email, password_hash, role_id) VALUES (:name, :email, :password_hash, :role_id)";

        try {
            $this->db->query($sql, [
                ':name' => $name,
                ':email' => $email,
                ':password_hash' => $passwordHash,
                ':role_id' => $roleId
            ]);
            return true;
        } catch (\Exception $e) {
            // In a real application, you would log this error.
            return false;
        }
    }

    /**
     * Approves a user by setting their 'is_approved' flag to 1.
     *
     * @param int $userId The ID of the user to approve.
     * @return bool True on success, false on failure.
     */
    public function approveUser($userId)
    {
        $sql = "UPDATE users SET is_approved = 1 WHERE id = :id";

        try {
            $this->db->query($sql, [':id' => $userId]);
            return true;
        } catch (\Exception $e) {
            // In a real app, you would log this error.
            return false;
        }
    }

    /**
     * Get all approved users with the 'Reviewer' role.
     *
     * @return array An array of reviewer user records.
     */
    public function getReviewers()
    {
        // Role 2 is 'Reviewer'
        $sql = "SELECT id, name FROM users WHERE role_id = 2 AND is_approved = 1";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}