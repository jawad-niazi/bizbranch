<?php include 'components/header.php'; ?>

<!-- Hero Section -->
<section class="relative bg-teal-dark overflow-hidden">
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-teal-dark to-teal mix-blend-multiply opacity-90 z-10"></div>
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1449844908441-8829872d2607?auto=format&fit=crop&q=80')] bg-cover bg-center opacity-40 z-0"></div>
    
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 text-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-serif font-bold text-white mb-6 drop-shadow-md">
            BizBranches: Free US Business Directory
        </h1>
        <p class="text-lg md:text-xl text-teal-50 mb-8 max-w-2xl mx-auto">
            Find local businesses by city and category across the US. List your business free—no fees, no credit card.
        </p>


        
        <!-- Search Bar -->
        <div class="max-w-4xl mx-auto bg-white rounded-full shadow-lg p-2 flex flex-col md:flex-row items-center gap-2">
            <div class="flex-1 w-full flex items-center px-4 border-b md:border-b-0 md:border-r border-gray-200">
                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" placeholder="Search businesses..." class="w-full py-3 focus:outline-none text-gray-700 bg-transparent">
            </div>
            <div class="flex-1 w-full flex items-center px-4 border-b md:border-b-0 md:border-r border-gray-200">
                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <input type="text" placeholder="All Cities" class="w-full py-3 focus:outline-none text-gray-700 bg-transparent">
            </div>
            <div class="flex-1 w-full flex items-center px-4">
                <select class="w-full py-3 focus:outline-none text-gray-500 bg-transparent appearance-none">
                    <option>Category</option>
                    <option>Restaurants</option>
                    <option>Automotive</option>
                </select>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
            <button class="w-full md:w-auto bg-teal hover:bg-teal-dark text-white rounded-full px-8 py-3 font-medium transition-colors m-1">
                Search
            </button>
        </div>
        
        <div class="mt-8 flex flex-wrap justify-center gap-4">
            <a href="/add-business.php" class="bg-[#00b26b] hover:bg-green-600 text-white rounded-lg px-6 py-3 font-medium transition-colors">Add Your Business Free</a>
            <a href="/categories.php" class="bg-transparent border border-white text-white hover:bg-white/10 rounded-lg px-6 py-3 font-medium transition-colors">Browse All Businesses</a>
        </div>
    </div>
</section>

<!-- Recent Listings Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-bold text-gray-900 mb-4">Recent Listings</h2>
            <p class="text-gray-600">Discover some of the latest additions to the BizBranches directory.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
            $data_file = 'data/businesses.json';
            $businesses = [];
            if (file_exists($data_file)) {
                $businesses = json_decode(file_get_contents($data_file), true) ?? [];
            }

            if (empty($businesses)):
            ?>
                <!-- Empty State -->
                <div class="col-span-1 md:col-span-3 text-center py-16 bg-white rounded-xl border border-gray-100 shadow-sm">
                    <div class="w-20 h-20 mx-auto bg-gray-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4m-4 0H7"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No businesses listed yet</h3>
                    <p class="text-gray-500 mb-6">Be the first to add your business to our growing directory.</p>
                    <a href="add-business.php" class="inline-block bg-teal-600 hover:bg-teal-700 text-white rounded-xl px-6 py-3 font-medium transition-all shadow-md shadow-teal-500/20">
                        Add Your Business Free
                    </a>
                </div>
            <?php else: ?>
                <?php for ($i = count($businesses) - 1; $i >= max(0, count($businesses) - 6); $i--): 
                    $biz = $businesses[$i];
                    $logo = !empty($biz['logo']) ? htmlspecialchars($biz['logo']) : '';
                    $category = htmlspecialchars($biz['category'] ?? 'Business');
                    $name = htmlspecialchars($biz['name'] ?? 'Unnamed Business');
                    $location = htmlspecialchars($biz['city'] ?? $biz['location'] ?? 'Unknown Location');
                    $rating = htmlspecialchars($biz['rating'] ?? '5.0');
                    $reviews_count = htmlspecialchars($biz['reviews_count'] ?? '0');
                ?>
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden border border-gray-100">
                    <div class="h-48 bg-gray-100 relative">
                        <?php if($logo): ?>
                        <img src="<?= $logo ?>" alt="<?= $name ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <?php endif; ?>
                        <span class="absolute top-4 left-4 bg-white px-3 py-1 text-xs font-bold rounded-full text-teal-600 shadow-sm"><?= $category ?></span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-gray-900 truncate"><?= $name ?></h3>
                        <p class="text-sm text-gray-500 mb-4 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            <?= $location ?>
                        </p>
                        <div class="flex items-center justify-between mt-auto">
                            <div class="flex items-center text-yellow-400">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <span class="ml-1 text-sm font-bold text-gray-700"><?= $rating ?></span> 
                                <span class="text-gray-400 text-xs ml-1">(<?= $reviews_count ?>)</span>
                            </div>
                            <a href="business-detail.php?id=<?= $i ?>" class="text-teal-600 font-bold text-sm hover:text-teal-800 flex items-center">
                                View Details
                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- What is BizBranches Section -->
<section class="py-20 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <!-- Left Column (Image) -->
            <div class="lg:w-1/2 w-full">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80" alt="About BizBranches" class="w-full h-auto rounded-3xl shadow-xl object-cover aspect-[4/3]">
            </div>
            
            <!-- Right Column (Content) -->
            <div class="lg:w-1/2 w-full flex flex-col items-start text-left">
                <span class="bg-teal-50 text-teal-700 font-medium px-4 py-1.5 rounded-full text-sm uppercase tracking-wide mb-4">
                    About Us
                </span>
                
                <h2 class="font-serif text-3xl md:text-4xl font-bold text-slate-900 mb-6">
                    Connecting Communities with Local Businesses
                </h2>
                
                <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                    BizBranches helps users discover trusted local services in their city with ease. We also empower business owners to list their services for free and reach a broader audience.
                </p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 w-full mb-10">
                    <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100">
                        <h4 class="font-bold text-slate-900 mb-2">Who it is for</h4>
                        <p class="text-gray-600 text-sm">Perfect for local residents looking for services & business owners wanting growth.</p>
                    </div>
                    <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100">
                        <h4 class="font-bold text-slate-900 mb-2">What value it brings</h4>
                        <p class="text-gray-600 text-sm">100% free directory listings, direct contacts, and easy search by city/category.</p>
                    </div>
                </div>
                
                <a href="/about.php" class="bg-teal-600 hover:bg-teal-700 text-white rounded-xl px-6 py-3 font-medium transition-all shadow-md shadow-teal-500/20 inline-flex items-center">
                    Learn More About Us
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Browse By Category Section -->
<section class="py-20 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-bold text-gray-900 mb-4">Browse By Category</h2>
            <p class="text-gray-600">Find exactly what you're looking for by browsing our popular categories.</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <a href="#" class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow text-center border border-gray-100 group">
                <div class="w-16 h-16 mx-auto bg-teal-50 rounded-full flex items-center justify-center mb-4 group-hover:bg-teal transition-colors">
                    <svg class="w-8 h-8 text-teal group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Shopping</h3>
                <p class="text-sm text-gray-500">120 Listings</p>
            </a>
            <a href="#" class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow text-center border border-gray-100 group">
                <div class="w-16 h-16 mx-auto bg-teal-50 rounded-full flex items-center justify-center mb-4 group-hover:bg-teal transition-colors">
                    <svg class="w-8 h-8 text-teal group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Business</h3>
                <p class="text-sm text-gray-500">85 Listings</p>
            </a>
            <a href="#" class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow text-center border border-gray-100 group">
                <div class="w-16 h-16 mx-auto bg-teal-50 rounded-full flex items-center justify-center mb-4 group-hover:bg-teal transition-colors">
                    <svg class="w-8 h-8 text-teal group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Education</h3>
                <p class="text-sm text-gray-500">42 Listings</p>
            </a>
            <a href="#" class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow text-center border border-gray-100 group">
                <div class="w-16 h-16 mx-auto bg-teal-50 rounded-full flex items-center justify-center mb-4 group-hover:bg-teal transition-colors">
                    <svg class="w-8 h-8 text-teal group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Real Estate</h3>
                <p class="text-sm text-gray-500">65 Listings</p>
            </a>
        </div>
    </div>
</section>

<!-- Cities Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-bold text-gray-900 mb-4">Discover Businesses in Top US Cities</h2>
            <p class="text-gray-600">Explore the best local spots across major cities.</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            <a href="#" class="p-6 border border-gray-100 rounded-xl hover:shadow-md transition-shadow group">
                <h3 class="font-bold text-lg text-gray-900 group-hover:text-teal transition-colors">New York</h3>
                <p class="text-sm text-gray-500 mt-1">1,250 Businesses</p>
            </a>
            <a href="#" class="p-6 border border-gray-100 rounded-xl hover:shadow-md transition-shadow group">
                <h3 class="font-bold text-lg text-gray-900 group-hover:text-teal transition-colors">Los Angeles</h3>
                <p class="text-sm text-gray-500 mt-1">980 Businesses</p>
            </a>
            <a href="#" class="p-6 border border-gray-100 rounded-xl hover:shadow-md transition-shadow group">
                <h3 class="font-bold text-lg text-gray-900 group-hover:text-teal transition-colors">Chicago</h3>
                <p class="text-sm text-gray-500 mt-1">740 Businesses</p>
            </a>
            <a href="#" class="p-6 border border-gray-100 rounded-xl hover:shadow-md transition-shadow group">
                <h3 class="font-bold text-lg text-gray-900 group-hover:text-teal transition-colors">Houston</h3>
                <p class="text-sm text-gray-500 mt-1">620 Businesses</p>
            </a>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-20 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-serif font-bold text-gray-900 mb-4">How It <span class="text-teal">Works</span></h2>
            <p class="text-gray-600">Connect with local businesses in three simple steps.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center relative">
            <div class="hidden md:block absolute top-12 left-1/6 right-1/6 h-0.5 bg-gray-200 border-t border-dashed border-gray-300 z-0 w-2/3 mx-auto"></div>
            
            <div class="relative z-10">
                <div class="w-24 h-24 mx-auto bg-white border border-gray-100 shadow-sm rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">1. Find Businesses</h3>
                <p class="text-gray-600">Search through our extensive directory by category or location to find exactly what you need.</p>
            </div>
            
            <div class="relative z-10">
                <div class="w-24 h-24 mx-auto bg-teal border-4 border-white shadow-md rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">2. Contact Directly</h3>
                <p class="text-gray-600">Get all the details you need to reach out directly to the business via phone, email, or their website.</p>
            </div>
            
            <div class="relative z-10">
                <div class="w-24 h-24 mx-auto bg-white border border-gray-100 shadow-sm rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">3. Read & Review</h3>
                <p class="text-gray-600">Make informed decisions by reading reviews from other customers, and share your own experiences.</p>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-20 bg-teal text-white">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-serif font-bold mb-4">Join our newsletter</h2>
        <p class="mb-8 text-teal-100">Get the latest business listings and updates delivered straight to your inbox.</p>
        <form class="flex flex-col sm:flex-row gap-2 justify-center max-w-lg mx-auto">
            <input type="email" placeholder="Enter your email address" class="px-6 py-3 rounded-full text-gray-900 focus:outline-none flex-1">
            <button type="submit" class="bg-gray-900 hover:bg-gray-800 text-white px-8 py-3 rounded-full font-medium transition-colors">Subscribe</button>
        </form>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-white">
    <div class="max-w-3xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-bold text-gray-900 mb-4">Frequently Asked <span class="text-teal">Questions</span></h2>
            <p class="text-gray-600">Find answers to common questions about BizBranches.</p>
        </div>
        
        <div class="space-y-4">
            <div class="border border-gray-100 rounded-lg p-6 bg-gray-50">
                <h3 class="font-bold text-lg mb-2 text-gray-900">Is it really free to add my business?</h3>
                <p class="text-gray-600 text-sm">Yes, listing your business in our directory is completely free. We do not require a credit card or charge any hidden fees for basic listings.</p>
            </div>
            <div class="border border-gray-100 rounded-lg p-6 hover:bg-gray-50 transition-colors">
                <h3 class="font-bold text-lg mb-2 text-gray-900">How long does it take for a listing to appear?</h3>
                <p class="text-gray-600 text-sm hidden">Usually, listings appear within 24-48 hours after our team verifies the information to ensure quality and accuracy.</p>
            </div>
            <div class="border border-gray-100 rounded-lg p-6 hover:bg-gray-50 transition-colors">
                <h3 class="font-bold text-lg mb-2 text-gray-900">Can I update my business information later?</h3>
                <p class="text-gray-600 text-sm hidden">Absolutely. You can log into your account at any time to update your business details, add new photos, or respond to reviews.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'components/footer.php'; ?>
