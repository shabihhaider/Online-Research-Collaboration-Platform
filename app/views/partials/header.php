<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Research Platform | <?= htmlspecialchars($title ?? 'Welcome') ?></title>
    
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body class="h-full">

<div class="min-h-full">
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Research Platform">
                    </div>
                    <div class="ml-10 flex items-baseline space-x-4">
                        <?php if (isset($_SESSION['user'])): ?>
                            <a href="/" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Dashboard</a>
                            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">My Submissions</a>
                            <?php else: ?>
                            <a href="/" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Home</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="ml-4 flex items-center md:ml-6">
                    <?php if (isset($_SESSION['user'])): ?>
                        <div class="text-gray-300 px-3 py-2 text-sm font-medium">
                            Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?>
                        </div>
                        <a href="/logout" class="ml-4 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Logout</a>
                    <?php else: ?>
                        <a href="/login" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Login</a>
                        <a href="/register" class="ml-4 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Register</a>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900"><?= htmlspecialchars($title ?? 'Page') ?></h1>
        </div>
    </header>
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <?php if (isset($_SESSION['_flash'])): ?>
            <?php foreach ($_SESSION['_flash'] as $key => $message): ?>
                <div class="mb-4 rounded-md p-4 <?= $key === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                    <?= $message ?>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION['_flash']); ?>
        <?php endif; ?>