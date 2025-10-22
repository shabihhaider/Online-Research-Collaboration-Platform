<?php
// app/views/pages/home.php

require __DIR__ . '/../partials/header.php';

// This is our new, clean dashboard loader.
// It keeps this file simple and separates the logic for each role.
echo '<div class="space-y-8">';

if (isset($_SESSION['user'])) {
    $roleId = $_SESSION['user']['role_id'];

    switch ($roleId) {
        case 1: // Researcher
            require __DIR__ . '/../dashboards/_researcher.php';
            break;
        case 2: // Reviewer
            require __DIR__ . '/../dashboards/_reviewer.php';
            break;
        case 3: // Editor
            require __DIR__ . '/../dashboards/_editor.php';
            break;
        case 4: // Librarian
            require __DIR__ . '/../dashboards/_librarian.php';
            break;
        case 5: // Admin
            require __DIR__ . '/../dashboards/_admin.php';
            break;
        default:
            echo '<p class="text-slate-600">Welcome to your dashboard.</p>';
    }

} else {
    // Guest Homepage
    require __DIR__ . '/../dashboards/_guest.php';
}

echo '</div>';

require __DIR__ . '/../partials/footer.php';