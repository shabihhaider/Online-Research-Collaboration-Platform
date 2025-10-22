<?php
// public/index.php

use App\Core\Router;

// Start the session for user authentication later
session_start();

// Autoload all our classes
require_once __DIR__ . '/../vendor/autoload.php';

// Load the routes file and pass it to the router
$router = Router::load(__DIR__ . '/../app/routes.php');

// Get the current URI and request method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Let the router handle the request
$router->resolve($uri, $method);