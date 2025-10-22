<?php
// app/core/Database.php

namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $pdo;
    private $stmt;

    private function __construct() {
        $config = require_once __DIR__ . '/../../config/database.php';

        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $config['user'], $config['password'], $options);
        } catch (PDOException $e) {
            // In production, you'd log this error, not show it to the user.
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    /**
     * Ensures only one database connection is ever made (Singleton Pattern).
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    /**
     * A simple query method for executing prepared statements.
     */
    public function query($sql, $params = []) {
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute($params);
        return $this->stmt;
    }
}