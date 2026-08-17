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

        <!-- Centered Nav Links (desktop) -->
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
            <!-- Mobile Hamburger Button -->
            <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg text-gray-600 hover:text-teal hover:bg-gray-100 transition-colors" aria-label="Open menu">
                <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 z-[998] hidden md:hidden" aria-hidden="true"></div>

<!-- Mobile Menu Drawer -->
<div id="mobile-menu-drawer" class="fixed top-0 right-0 h-full w-72 bg-white z-[999] shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col">
    <!-- Drawer Header -->
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
        <a href="/" class="text-xl font-extrabold text-teal tracking-tight">BizBranches</a>
        <button id="mobile-menu-close" class="p-2 rounded-lg text-gray-500 hover:text-gray-900 hover:bg-gray-100 transition-colors" aria-label="Close menu">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <!-- Drawer Nav Links -->
    <nav class="flex flex-col px-4 py-4 gap-1 flex-1">
        <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium hover:bg-teal/10 hover:text-teal transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Home
        </a>
        <a href="/categories.php" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium hover:bg-teal/10 hover:text-teal transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            Categories
        </a>
        <a href="/about.php" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium hover:bg-teal/10 hover:text-teal transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            About Us
        </a>
        <div class="border-t border-gray-100 my-2"></div>
        <a href="/add-business.php" class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-teal text-white font-semibold hover:bg-teal-dark transition-colors mt-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            Add Your Business Free
        </a>
    </nav>

    <!-- Drawer Footer -->
    <div class="px-5 py-4 border-t border-gray-100 text-xs text-gray-400 text-center">
        © <?php echo date('Y'); ?> BizBranches. All rights reserved.
    </div>
</div>

<script>
(function () {
    var btn = document.getElementById('mobile-menu-btn');
    var closeBtn = document.getElementById('mobile-menu-close');
    var overlay = document.getElementById('mobile-menu-overlay');
    var drawer = document.getElementById('mobile-menu-drawer');

    function openMenu() {
        drawer.classList.remove('translate-x-full');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeMenu() {
        drawer.classList.add('translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
    }

    if (btn) btn.addEventListener('click', openMenu);
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);
    if (overlay) overlay.addEventListener('click', closeMenu);
})();
</script>

<main>

