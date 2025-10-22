<?php
// app/core/Controller.php

namespace App\Core;

class Controller {
    public function view($view, $data = []) {
        extract($data);
        $viewPath = __DIR__ . "/../views/{$view}.php";

        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            die("View not found: {$viewPath}");
        }
    }

    /**
     * Sets a message to be displayed on the next request.
     * @param string $key e.g., 'error', 'success'
     * @param string $message The message to display.
     */
    public function flash($key, $message) {
        $_SESSION['_flash'][$key] = $message;
    }

    /**
     * Redirects to a specified URI.
     * @param string $uri The path to redirect to.
     */
    public function redirect($uri) {
        header("Location: {$uri}");
        exit;
    }
}