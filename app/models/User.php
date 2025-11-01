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
     * Find a user by their ID.
     *
     * @param int $id The user's ID.
     * @return mixed The user record if found, or false.
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        
        $stmt = $this->db->query($sql, [':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Update a user's profile information.
     *
     * @param int $userId The ID of the user to update.
     * @param string $name The new name.
     * @param string $email The new email.
     * @param string|null $profilePicPath The new profile pic path, or null to keep the old one.
     * @return bool True on success, false on failure.
     */
    public function updateProfile($userId, $name, $email, $profilePicPath = null)
    {
        // If no new picture is uploaded, we only update name and email
        if ($profilePicPath === null) {
            $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
            $params = [
                ':name' => $name,
                ':email' => $email,
                ':id' => $userId
            ];
        } else {
            // If a new picture is uploaded, we update all three
            $sql = "UPDATE users SET name = :name, email = :email, profile_pic = :profile_pic WHERE id = :id";
            $params = [
                ':name' => $name,
                ':email' => $email,
                ':profile_pic' => $profilePicPath,
                ':id' => $userId
            ];
        }

        try {
            $this->db->query($sql, $params);
            return true;
        } catch (\Exception $e) {
            // In a real app, you would log this error
            return false;
        }
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

    /**
     * Get total user count
     */
    public function getTotalCount()
    {
        $sql = "SELECT COUNT(*) as count FROM users WHERE is_approved = 1";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();
        return $result['count'];
    }

    /**
     * Get user count by role
     */
    public function getCountByRole()
    {
        $sql = "SELECT r.role_name, COUNT(*) as count 
                FROM users u
                JOIN roles r ON u.role_id = r.id
                WHERE u.is_approved = 1
                GROUP BY r.role_name";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Delete/deactivate a user
     */
    public function deleteUser($userId)
    {
        $sql = "UPDATE users SET is_approved = 0, is_active = 0 WHERE id = :id";
        try {
            $this->db->query($sql, [':id' => $userId]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}