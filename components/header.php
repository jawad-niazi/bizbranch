<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Directory</title>
    <!-- Tailwind CDN for dynamic class support -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Compiled Tailwind (custom theme colors like teal) -->
    <link href="/css/output.css" rel="stylesheet">
    <!-- Search Widgets CSS -->
    <link href="/css/search-widgets.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
      body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="font-sans text-gray-800 bg-gray-50">

<!-- Navigation Bar -->
<header class="bg-white shadow-md rounded-b-2xl sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="text-2xl font-extrabold text-teal tracking-tight">BizBranches</a>
        
        <!-- Centered Nav Links -->
        <nav class="hidden md:flex space-x-6 text-sm font-medium absolute left-1/2 -translate-x-1/2">
            <a href="/" class="text-gray-600 hover:text-teal transition-colors">Home</a>
            <a href="/categories.php" class="text-gray-600 hover:text-teal transition-colors">Categories</a>
            <div class="relative group cursor-pointer">
                <span class="text-gray-600 hover:text-teal transition-colors flex items-center gap-1">
                    Our directories 
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </span>
            </div>
        </nav>

        <div class="flex items-center gap-4">
            <a href="/add-business.php" class="hidden md:inline-flex items-center justify-center px-5 py-2.5 bg-teal border border-teal text-white font-semibold text-sm rounded-full hover:bg-transparent hover:text-teal transition-all duration-300 shadow-sm hover:shadow-none">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Add Free
            </a>
            <!-- Mobile Menu Button -->
            <button class="md:hidden text-gray-600 hover:text-teal">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </div>
</header>
<main>
