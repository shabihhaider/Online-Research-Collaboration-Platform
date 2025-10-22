<?php
namespace App\Models;

use App\Core\Database;

class Category
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM categories ORDER BY name ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function create($name, $description)
    {
        $sql = "INSERT INTO categories (name, description) VALUES (:name, :description)";
        try {
            $this->db->query($sql, [':name' => $name, ':description' => $description]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id LIMIT 1";
        $stmt = $this->db->query($sql, [':id' => $id]);
        return $stmt->fetch();
    }

    public function update($id, $name, $description)
    {
        $sql = "UPDATE categories SET name = :name, description = :description WHERE id = :id";
        try {
            $this->db->query($sql, [':name' => $name, ':description' => $description, ':id' => $id]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        try {
            $this->db->query($sql, [':id' => $id]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}