<?php
// app/routes.php

// Homepage
$router->get('/', 'PagesController@home');

// Registration routes
$router->get('/register', 'AuthController@create'); // Shows the registration form
$router->post('/register', 'AuthController@store'); // Handles form submission
// Login routes
$router->get('/login', 'AuthController@loginIndex'); // Shows the login form
$router->post('/login', 'AuthController@loginStore'); // Handles login attempt
// Logout route
$router->get('/logout', 'AuthController@logout');

// Paper Submission routes
$router->get('/submit', 'PaperController@create'); // Shows the submission form
$router->post('/submit', 'PaperController@store'); // Handles form submission

// Admin routes
$router->get('/admin/users', 'AdminController@users'); // Shows the user management page
$router->post('/admin/users/approve', 'AdminController@approve'); // Handles the user approval

// Editor routes
$router->get('/editor/assign/{id}', 'EditorController@assignIndex'); // Shows the 'assign reviewers' page for a specific paper
$router->post('/editor/assign', 'EditorController@assignStore'); // Handles the assignment form submission
$router->get('/editor/decision/{id}', 'EditorController@decisionIndex'); // Shows the decision page for a specific paper
$router->post('/editor/decision', 'EditorController@decisionStore'); // Handles the decision form submission

// Reviewer routes
$router->get('/review/submit/{id}', 'ReviewController@create'); // Shows the review form for a specific assignment
$router->post('/review/submit', 'ReviewController@store'); // Handles the review form submission

// Librarian routes
$router->get('/library/edit/{id}', 'LibrarianController@edit'); // Shows the citation edit form for a library entry
$router->post('/library/edit', 'LibrarianController@update'); // Handles the citation update