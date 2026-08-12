<?php include 'components/header.php'; ?>
<?php
// Landing Page Categories Data with HD CDN Background Images
$landing_categories = [
    [
        'name' => 'Home Services',
        'subs' => ['Locksmith', 'Plumbing', 'Electrical', 'HVAC', 'Garage Door', 'Roofing', 'Appliance Repair', 'Pest Control', 'Solar', 'EV Charger Installation', 'Exterior Paint', 'Bath Remodeling', 'Kitchen Remodeling', 'Home Remodeling', 'Water Damage Restoration', 'Fire Damage Restoration', 'Windows', 'Lawn Care', 'Mold Removal', 'Home Security', 'Porta Potties'],
        'image' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=600&q=80'
    ],
    [
        'name' => 'Legal',
        'subs' => ['Personal Injury Lawyers', 'Motor Vehicle Accident Lawyers (MVA)', 'Mass Torts', 'Immigration Lawyers', 'Criminal Defense / DUI Lawyers'],
        'image' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&w=600&q=80'
    ],
    [
        'name' => 'Insurance',
        'subs' => ['Auto Insurance', 'Home Insurance', 'Life Insurance', 'Final Expense', 'ACA (Health Insurance)'],
        'image' => 'https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&w=600&q=80'
    ],
    [
        'name' => 'Auto',
        'subs' => ['Towing Services', 'Car Rental'],
        'image' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&w=600&q=80'
    ],
    [
        'name' => 'Financial',
        'subs' => ['Credit Repair', 'Debt Settlement', 'Tax Debt Relief', 'Personal Loans', 'Business Loans', 'Mortgage'],
        'image' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=600&q=80'
    ],
    [
        'name' => 'Travel',
        'subs' => ['Flight Booking / Changes', 'Hotel Rental'],
        'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=600&q=80'
    ],
    [
        'name' => 'Medical',
        'subs' => ['Medicare', 'Home Care / Caregivers', 'SSDI'],
        'image' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=600&q=80'
    ],
    [
        'name' => 'Telecom',
        'subs' => ['Tv/Internet services'],
        'image' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?auto=format&fit=crop&w=600&q=80'
    ],
];
?>

<!-- Hero Section -->
<section class="relative bg-teal-dark overflow-hidden">
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-teal-dark to-teal mix-blend-multiply opacity-90 z-10"></div>
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1449844908441-8829872d2607?auto=format&fit=crop&q=80')] bg-cover bg-center opacity-40 z-0"></div>
    
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 text-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white mb-6 drop-shadow-md">
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
            <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Recent Listings</h2>
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
                <div class="listing-card bg-white border border-slate-200/80 rounded-[28px] p-3.5 space-y-3 flex flex-col justify-between group shadow-sm hover:shadow-md transition">
                    <div>
                        <!-- 1. TOP IMAGE BLOCK WITH FLOATING PILL BADGES -->
                        <div class="relative h-44 w-full rounded-[20px] overflow-hidden bg-slate-100 border border-slate-100">
                            <?php if($logo): ?>
                            <img src="<?= $logo ?>" alt="<?= $name ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Top-Left Category Badge -->
                            <span class="absolute top-3 left-3 bg-white text-blue-600 font-extrabold text-[10px] px-3.5 py-1 rounded-full shadow-sm uppercase tracking-wider">
                                <?= $category ?>
                            </span>
                            
                            <!-- Top-Right Rating Badge -->
                            <span class="absolute top-3 right-3 bg-white text-slate-800 font-extrabold text-[10px] px-2.5 py-1 rounded-full shadow-sm flex items-center gap-1">
                                <span class="text-amber-400">★</span> <?= $rating ?>
                            </span>
                        </div>
    
                        <!-- 2. CARD CONTENT (TITLE & LOCATION) -->
                        <div class="px-1 pt-3 space-y-1">
                            <h3 class="font-extrabold text-sm text-slate-900 group-hover:text-blue-600 transition truncate"><?= $name ?></h3>
                            <p class="text-xs text-slate-500 font-medium flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                <span class="truncate"><?= $location ?></span>
                            </p>
                        </div>
                    </div>

                    <!-- 3. BOTTOM DARK PILL BUTTON -->
                    <div class="pt-1">
                        <a href="business-detail.php?id=<?= $i ?>" class="w-full bg-[#111827] hover:bg-blue-600 text-white font-bold py-3 rounded-2xl text-xs text-center block transition shadow-sm">
                            View Details
                        </a>
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
                
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6">
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

<!-- LANDING PAGE CATEGORY GRID -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
  <div class="flex items-center justify-between">
    <div>
      <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Explore Top Categories</h2>
      <p class="text-xs text-slate-500 mt-1">Find local specialists and verified business branches</p>
    </div>
    <a href="categories.php" class="text-xs font-bold text-blue-600 hover:underline">
      View All Categories &rarr;
    </a>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
    <?php foreach ($landing_categories as $cat): ?>
      <a 
        href="categories.php?category=<?php echo urlencode($cat['name']); ?>" 
        class="group relative h-52 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 block"
      >
        <!-- CDN Background Image -->
        <img 
          src="<?php echo $cat['image']; ?>" 
          alt="<?php echo htmlspecialchars($cat['name']); ?>" 
          class="w-full h-full object-cover group-hover:scale-110 transition duration-500" 
        />

        <!-- Dark Gradient Overlay for Contrast -->
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent"></div>

        <!-- Content Overlay -->
        <div class="absolute inset-0 p-5 flex flex-col justify-end text-white space-y-2">
          <h3 class="font-extrabold text-lg text-white group-hover:text-blue-300 transition tracking-tight">
            <?php echo htmlspecialchars($cat['name']); ?>
          </h3>

          <div class="flex flex-wrap gap-1">
            <?php foreach (array_slice($cat['subs'], 0, 3) as $sub): ?>
              <span class="px-2 py-0.5 rounded-md bg-white/20 backdrop-blur-md border border-white/20 text-white text-[10px] font-semibold">
                <?php echo htmlspecialchars($sub); ?>
              </span>
            <?php endforeach; ?>
          </div>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<!-- Cities Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Discover Businesses in Top US Cities</h2>
            <p class="text-gray-600">Explore the best local spots across major cities.</p>
        </div>
        
        <style>
            .scrollbar-hide::-webkit-scrollbar { display: none; }
            .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        </style>
        
        <?php
        $top_cities = [
            [
                'name' => 'New York',
                'count' => '1,250 Businesses',
                'image' => 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?auto=format&fit=crop&w=600&q=80',
                'tags' => ['Restaurants', 'Retail', 'Tech']
            ],
            [
                'name' => 'Los Angeles',
                'count' => '980 Businesses',
                'image' => 'https://images.unsplash.com/photo-1515896769750-31548ea180d1?auto=format&fit=crop&w=600&q=80',
                'tags' => ['Entertainment', 'Real Estate', 'Auto']
            ],
            [
                'name' => 'Chicago',
                'count' => '740 Businesses',
                'image' => 'https://images.unsplash.com/photo-1494522855154-9297ac14b55f?auto=format&fit=crop&w=600&q=80',
                'tags' => ['Finance', 'Food', 'Legal']
            ],
            [
                'name' => 'Houston',
                'count' => '620 Businesses',
                'image' => 'https://images.unsplash.com/photo-1531218150217-5afc50ba5151?auto=format&fit=crop&w=600&q=80',
                'tags' => ['Energy', 'Medical', 'Manufacturing']
            ],
            [
                'name' => 'Miami',
                'count' => '510 Businesses',
                'image' => 'https://images.unsplash.com/photo-1514214246283-d427a95c5d2f?auto=format&fit=crop&w=600&q=80',
                'tags' => ['Tourism', 'Nightlife', 'Real Estate']
            ],
            [
                'name' => 'Seattle',
                'count' => '430 Businesses',
                'image' => 'https://images.unsplash.com/photo-1502175353174-a7a70e73b362?auto=format&fit=crop&w=600&q=80',
                'tags' => ['Tech', 'Coffee', 'Outdoors']
            ],
        ];
        ?>
        
        <div class="relative group max-w-7xl mx-auto">
            <!-- Carousel Container -->
            <div id="city-carousel" class="flex overflow-x-auto snap-x snap-mandatory gap-5 pb-8 pt-4 px-4 scrollbar-hide items-stretch">
                <?php foreach ($top_cities as $city): ?>
                <a href="categories.php?location=<?php echo urlencode($city['name']); ?>" class="group relative h-52 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 block min-w-[280px] sm:min-w-[300px] flex-shrink-0 snap-center">
                    <!-- CDN Background Image -->
                    <img 
                      src="<?php echo $city['image']; ?>" 
                      alt="<?php echo htmlspecialchars($city['name']); ?>" 
                      class="w-full h-full object-cover group-hover:scale-110 transition duration-500" 
                    />

                    <!-- Dark Gradient Overlay for Contrast -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent"></div>

                    <!-- Content Overlay -->
                    <div class="absolute inset-0 p-5 flex flex-col justify-end text-white space-y-2">
                      <h3 class="font-extrabold text-2xl text-white group-hover:text-teal-300 transition tracking-tight">
                        <?php echo htmlspecialchars($city['name']); ?>
                      </h3>
                      
                      <div class="flex flex-wrap gap-1 mt-1">
                        <span class="px-2 py-0.5 rounded-md bg-teal-600/80 backdrop-blur-md border border-teal-500/30 text-white text-[10px] font-semibold mb-1">
                            <?php echo $city['count']; ?>
                        </span>
                      </div>

                      <div class="flex flex-wrap gap-1">
                        <?php foreach ($city['tags'] as $tag): ?>
                          <span class="px-2 py-0.5 rounded-md bg-white/20 backdrop-blur-md border border-white/20 text-white text-[10px] font-semibold">
                            <?php echo htmlspecialchars($tag); ?>
                          </span>
                        <?php endforeach; ?>
                      </div>
                    </div>
                </a>
                <?php endforeach; ?>

                <!-- See More Card -->
                <a href="categories.php?filter=location" class="group relative h-52 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 block min-w-[280px] sm:min-w-[300px] flex-shrink-0 snap-center bg-gradient-to-br from-teal-700 to-teal-900 flex flex-col items-center justify-center text-center p-6 border border-teal-600">
                    <div class="bg-white/20 p-4 rounded-full mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                    <h3 class="font-extrabold text-xl text-white mb-2">See More Cities</h3>
                    <p class="text-teal-100 text-sm">Filter businesses by location</p>
                </a>
            </div>

            <!-- Navigation Arrows -->
            <button onclick="document.getElementById('city-carousel').scrollBy({left: -300, behavior: 'smooth'})" class="absolute top-1/2 left-0 -translate-y-1/2 -translate-x-2 md:-translate-x-6 bg-white shadow-lg rounded-full p-2.5 text-teal opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 hover:bg-teal hover:text-white border border-slate-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button onclick="document.getElementById('city-carousel').scrollBy({left: 300, behavior: 'smooth'})" class="absolute top-1/2 right-0 -translate-y-1/2 translate-x-2 md:translate-x-6 bg-white shadow-lg rounded-full p-2.5 text-teal opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 hover:bg-teal hover:text-white border border-slate-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
            
            <!-- Indicators -->
            <div class="flex justify-center items-center gap-2 mt-4">
                <div class="w-6 h-1.5 rounded-full bg-teal"></div>
                <div class="w-2 h-1.5 rounded-full bg-slate-200"></div>
                <div class="w-2 h-1.5 rounded-full bg-slate-200"></div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-20 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-4">How It <span class="text-teal">Works</span></h2>
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
        <h2 class="text-3xl font-extrabold mb-4">Join our newsletter</h2>
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
            <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Frequently Asked <span class="text-teal">Questions</span></h2>
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
