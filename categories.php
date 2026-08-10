<?php include 'components/header.php'; ?>

<main class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <nav class="text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="/" class="hover:text-teal transition-colors">Home</a>
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                </li>
                <li class="flex items-center">
                    <span class="text-gray-800">All Categories</span>
                </li>
            </ol>
        </nav>

        <div class="mb-10">
            <span class="text-xs font-bold text-teal tracking-wider uppercase bg-teal-50 px-3 py-1 rounded-full">50+ CATEGORIES</span>
            <h1 class="text-3xl font-serif font-bold text-gray-900 mt-4 mb-3">All Categories</h1>
            <p class="text-gray-600 max-w-3xl">
                Browse our directory across a wide range of business categories. Find local businesses in the US cities in your area, or discover new ones across the US. Click on a subcategory to view business listings.
            </p>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            
            <!-- Category Card 1 -->
            <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md transition-shadow rounded-xl p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center mr-4">
                        <img src="https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&q=80&w=64&h=64" alt="Beauty Salon" class="w-8 h-8 object-cover rounded-full mix-blend-multiply opacity-80">
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Beauty Salon</h3>
                        <p class="text-sm text-gray-500">8 subcategories</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 mt-4">
                    <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200 text-sm text-gray-600 hover:border-teal hover:text-teal transition-colors">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> Hair Care
                    </a>
                    <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200 text-sm text-gray-600 hover:border-teal hover:text-teal transition-colors">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> Massage
                    </a>
                    <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200 text-sm text-gray-600 hover:border-teal hover:text-teal transition-colors">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> Skin Care
                    </a>
                    <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200 text-sm text-gray-600 hover:border-teal hover:text-teal transition-colors">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> Nail Salons
                    </a>
                    <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200 text-sm text-gray-600 hover:border-teal hover:text-teal transition-colors">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> Spa
                    </a>
                </div>
            </div>

            <!-- Category Card 2 -->
            <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md transition-shadow rounded-xl p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center mr-4">
                        <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&q=80&w=64&h=64" alt="Automotive" class="w-8 h-8 object-cover rounded-full mix-blend-multiply opacity-80">
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Automotive</h3>
                        <p class="text-sm text-gray-500">4 subcategories</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 mt-4">
                    <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200 text-sm text-gray-600 hover:border-teal hover:text-teal transition-colors">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> Car Repair
                    </a>
                    <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200 text-sm text-gray-600 hover:border-teal hover:text-teal transition-colors">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> Car Wash
                    </a>
                    <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200 text-sm text-gray-600 hover:border-teal hover:text-teal transition-colors">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> Tyres & Wheels
                    </a>
                    <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200 text-sm text-gray-600 hover:border-teal hover:text-teal transition-colors">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> Car Accessories
                    </a>
                    <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200 text-sm text-gray-600 hover:border-teal hover:text-teal transition-colors">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> Showroom
                    </a>
                </div>
            </div>
            
            <!-- Category Card 3 -->
            <div class="bg-white border border-gray-100 shadow-sm hover:shadow-md transition-shadow rounded-xl p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center mr-4">
                        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&q=80&w=64&h=64" alt="Restaurants" class="w-8 h-8 object-cover rounded-full mix-blend-multiply opacity-80">
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Restaurants</h3>
                        <p class="text-sm text-gray-500">6 subcategories</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 mt-4">
                    <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200 text-sm text-gray-600 hover:border-teal hover:text-teal transition-colors">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> Fast Food
                    </a>
                    <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200 text-sm text-gray-600 hover:border-teal hover:text-teal transition-colors">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> BBQ
                    </a>
                    <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200 text-sm text-gray-600 hover:border-teal hover:text-teal transition-colors">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> Ice Cream
                    </a>
                    <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200 text-sm text-gray-600 hover:border-teal hover:text-teal transition-colors">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> Chinese
                    </a>
                    <a href="#" class="inline-flex items-center px-3 py-1.5 rounded-full border border-gray-200 text-sm text-gray-600 hover:border-teal hover:text-teal transition-colors">
                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> Cafe
                    </a>
                </div>
            </div>
            
            <!-- Add more categories as per the screenshot... -->
            
        </div>
        
    </div>
</main>

<?php include 'components/footer.php'; ?>
