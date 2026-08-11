<?php
// categories.php - Centered Search Header with Integrated Search Input & Split Cards

$json_file = 'data/businesses.json';
$stored_businesses = file_exists($json_file) ? json_decode(file_get_contents($json_file), true) : [];

// Master Categories & Subcategories Tree
$categories_tree = [
    'Home Services' => [
        'Locksmith', 'Plumbing', 'Electrical', 'HVAC', 'Garage Door', 'Roofing',
        'Appliance Repair', 'Pest Control', 'Solar', 'EV Charger Installation',
        'Exterior Paint', 'Bath Remodeling', 'Kitchen Remodeling', 'Home Remodeling',
        'Water Damage Restoration', 'Fire Damage Restoration', 'Windows',
        'Lawn Care', 'Mold Removal', 'Home Security', 'Porta Potties'
    ],
    'Legal' => [
        'Personal Injury Lawyers', 'Motor Vehicle Accident Lawyers (MVA)',
        'Mass Torts', 'Immigration Lawyers', 'Criminal Defense / DUI Lawyers'
    ],
    'Insurance' => [
        'Auto Insurance', 'Home Insurance', 'Life Insurance', 'Final Expense', 'ACA (Health Insurance)'
    ],
    'Auto' => [
        'Towing Services', 'Car Rental'
    ],
    'Financial' => [
        'Credit Repair', 'Debt Settlement', 'Tax Debt Relief', 'Personal Loans', 'Business Loans', 'Mortgage'
    ],
    'Travel' => [
        'Flight Booking / Changes', 'Hotel Rental'
    ],
    'Medical' => [
        'Medicare', 'Home Care / Caregivers', 'SSDI'
    ],
    'Telecom' => [
        'Tv/Internet services'
    ]
];

$default_businesses = [
    [
        'id' => 101,
        'business_name' => 'ProLock Locksmith & Security',
        'category' => 'Home Services',
        'subcategory' => 'Locksmith',
        'city' => 'Austin, TX',
        'full_address' => '320 Main St, Austin, TX',
        'rating' => 4.9,
        'reviews_count' => 88,
        'logo' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=600&q=80'
    ],
    [
        'id' => 102,
        'business_name' => 'Apex Legal Injury Attorneys',
        'category' => 'Legal',
        'subcategory' => 'Personal Injury Lawyers',
        'city' => 'Austin, TX',
        'full_address' => '120 Congress Ave, Austin, TX',
        'rating' => 4.8,
        'reviews_count' => 124,
        'logo' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&w=600&q=80'
    ],
    [
        'id' => 103,
        'business_name' => 'Express Towing & Roadside',
        'category' => 'Auto',
        'subcategory' => 'Towing Services',
        'city' => 'Chicago, IL',
        'full_address' => '450 Michigan Ave, Chicago, IL',
        'rating' => 4.7,
        'reviews_count' => 64,
        'logo' => 'https://images.unsplash.com/photo-1486006920555-c77dce18193b?auto=format&fit=crop&w=600&q=80'
    ],
    [
        'id' => 104,
        'business_name' => 'Summit Debt Settlement',
        'category' => 'Financial',
        'subcategory' => 'Debt Settlement',
        'city' => 'New York, NY',
        'full_address' => '100 Wall St, New York, NY',
        'rating' => 5.0,
        'reviews_count' => 210,
        'logo' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=600&q=80'
    ]
];

$all_businesses = !empty($stored_businesses) ? array_merge($stored_businesses, $default_businesses) : $default_businesses;
$preselected_category = $_GET['category'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Categories & Business Directory - BizBranches</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8FAFC; color: #0F172A; }
    .card-white {
      background: #FFFFFF;
      border: 1px solid #E2E8F0;
      box-shadow: 0 1px 3px rgba(0,0,0,0.04);
      transition: all 0.25s ease;
    }
    .filter-select {
      background-color: #FFFFFF;
      border: 1px solid #CBD5E1;
      border-radius: 0.75rem;
      padding: 0.625rem 0.875rem;
      font-size: 0.8125rem;
      color: #334155;
      outline: none;
      transition: all 0.2s;
    }
    .filter-select:focus {
      border-color: #2563EB;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
  </style>
</head>
<body class="min-h-screen flex flex-col justify-between">

  <!-- Header -->
  <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      <a href="index.php" class="flex items-center space-x-3">
        <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center font-bold text-white tracking-wider">BB</div>
        <span class="font-extrabold text-xl text-slate-900 tracking-tight">BizBranches</span>
      </a>
      <nav class="hidden md:flex space-x-8 text-sm font-semibold text-slate-600">
        <a href="index.php" class="hover:text-blue-600 transition">Discover</a>
        <a href="categories.php" class="text-blue-600 font-bold border-b-2 border-blue-600 pb-1">Categories</a>
        <a href="#" class="hover:text-blue-600 transition">Our Directories</a>
      </nav>
      <div class="flex items-center space-x-3">
        <a href="add-business.php" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-xl text-xs transition shadow-md shadow-blue-600/20">
          + Add Business
        </a>
      </div>
    </div>
  </header>

  <!-- Main Section -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8 w-full">

    <!-- CENTERED FILTER CONTROL CARD WITH INTEGRATED SEARCH BAR -->
    <div class="bg-white border border-slate-200 rounded-3xl p-6 md:p-8 shadow-sm space-y-6 text-center">
      
      <!-- Centered Header Text -->
      <div class="max-w-xl mx-auto space-y-1">
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Search & Filter Businesses</h1>
        <p class="text-xs text-slate-500">Find businesses by main category, specific service, location, or rating</p>
      </div>

      <!-- Integrated Search Input & Reset Button Row -->
      <div class="max-w-2xl mx-auto flex items-center gap-3">
        <div class="relative w-full">
          <input 
            type="text" 
            id="search-input" 
            placeholder="Search by business name, service, or keyword..." 
            class="w-full pl-11 pr-4 py-3 rounded-2xl bg-slate-50 border border-slate-200 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition"
          />
          <svg class="w-4 h-4 text-slate-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>

        <button id="reset-filters" class="text-xs text-slate-600 hover:text-blue-600 font-bold flex items-center gap-1.5 transition whitespace-nowrap px-4 py-3 rounded-2xl border border-slate-200 hover:border-blue-200 hover:bg-blue-50 bg-white">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
          <span>Reset</span>
        </button>
      </div>

      <!-- FILTER DROPDOWNS ROW -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 text-left max-w-5xl mx-auto pt-2">
        
        <!-- 1. MAIN CATEGORY DROPDOWN -->
        <select id="filter-category" class="filter-select">
          <option value="">All Categories</option>
          <?php foreach(array_keys($categories_tree) as $cat): ?>
            <option value="<?php echo htmlspecialchars($cat); ?>" <?php echo $preselected_category === $cat ? 'selected' : ''; ?>>
              <?php echo htmlspecialchars($cat); ?>
            </option>
          <?php endforeach; ?>
        </select>

        <!-- 2. DEPENDENT SUBCATEGORY DROPDOWN -->
        <select id="filter-subcategory" class="filter-select disabled:bg-slate-50 disabled:text-slate-400" disabled>
          <option value="">All Subcategories</option>
        </select>

        <!-- 3. LOCATION / CITY DROPDOWN -->
        <select id="filter-city" class="filter-select">
          <option value="">All Locations</option>
          <option value="Austin, TX">Austin, TX</option>
          <option value="Chicago, IL">Chicago, IL</option>
          <option value="New York, NY">New York, NY</option>
          <option value="Miami, FL">Miami, FL</option>
          <option value="London">London</option>
        </select>

        <!-- 4. RATING DROPDOWN -->
        <select id="filter-rating" class="filter-select">
          <option value="0">All Ratings</option>
          <option value="4.5">4.5+ Stars</option>
          <option value="4.8">4.8+ Stars</option>
          <option value="5.0">5.0 Stars Only</option>
        </select>

      </div>
    </div>

    <!-- BUSINESS LISTINGS GRID (SPLIT CARD LAYOUT) -->
    <section class="space-y-6">
      <div class="flex items-center justify-between border-b border-slate-200 pb-3">
        <h2 class="text-base font-extrabold text-slate-900 tracking-tight" id="results-count">Showing all listed businesses</h2>
      </div>

      <div id="business-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach ($all_businesses as $item): ?>
          <div 
            class="business-card bg-white border border-slate-200/80 rounded-[28px] p-3.5 space-y-3 flex flex-col justify-between group shadow-sm hover:shadow-md transition"
            data-name="<?php echo strtolower(htmlspecialchars($item['business_name'])); ?>"
            data-category="<?php echo htmlspecialchars($item['category']); ?>"
            data-subcategory="<?php echo htmlspecialchars($item['subcategory'] ?? ''); ?>"
            data-city="<?php echo htmlspecialchars($item['city']); ?>"
            data-rating="<?php echo $item['rating']; ?>"
          >
            <div>
              
              <!-- 1. TOP IMAGE BLOCK WITH FLOATING PILL BADGES -->
              <div class="relative h-44 w-full rounded-[20px] overflow-hidden bg-slate-100 border border-slate-100">
                <img 
                  src="<?php echo htmlspecialchars($item['logo']); ?>" 
                  alt="<?php echo htmlspecialchars($item['business_name']); ?>" 
                  onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=600&q=80';"
                  class="w-full h-full object-cover group-hover:scale-105 transition duration-300" 
                />
                
                <!-- Top-Left Category Badge -->
                <span class="absolute top-3 left-3 bg-white text-blue-600 font-extrabold text-[10px] px-3.5 py-1 rounded-full shadow-sm uppercase tracking-wider">
                  <?php echo htmlspecialchars($item['category']); ?>
                </span>

                <!-- Top-Right Rating Badge -->
                <span class="absolute top-3 right-3 bg-white text-slate-800 font-extrabold text-[10px] px-2.5 py-1 rounded-full shadow-sm flex items-center gap-1">
                  <span class="text-amber-400">★</span> <?php echo number_format($item['rating'] ?? 5.0, 1); ?>
                </span>
              </div>

              <!-- 2. CARD CONTENT (TITLE & LOCATION) -->
              <div class="px-1 pt-3 space-y-1">
                <h3 class="font-extrabold text-sm text-slate-900 group-hover:text-blue-600 transition truncate">
                  <?php echo htmlspecialchars($item['business_name']); ?>
                </h3>
                
                <p class="text-xs text-slate-500 font-medium flex items-center gap-1.5">
                  <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                  <span class="truncate"><?php echo htmlspecialchars($item['city'] ?? $item['full_address'] ?? 'Multan'); ?></span>
                </p>
              </div>

            </div>

            <!-- 3. BOTTOM DARK PILL BUTTON -->
            <div class="pt-1">
              <a 
                href="business-detail.php?id=<?php echo $item['id']; ?>" 
                class="w-full bg-[#111827] hover:bg-blue-600 text-white font-bold py-3 rounded-2xl text-xs text-center transition block shadow-sm"
              >
                View Details
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div id="no-results" class="hidden card-white rounded-3xl p-10 text-center space-y-2">
        <p class="text-sm font-bold text-slate-800">No business branches match your search criteria</p>
        <p class="text-xs text-slate-500">Try adjusting your search input or resetting your filters.</p>
      </div>
    </section>

  </main>

  <footer class="mt-16 bg-slate-900 text-white border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center text-xs text-slate-500">
      &copy; <?php echo date('Y'); ?> BizBranches. All rights reserved.
    </div>
  </footer>

  <!-- JAVASCRIPT DEPENDENT DROPDOWN & REAL-TIME FILTERING -->
  <script>
    const categoriesTree = <?php echo json_encode($categories_tree); ?>;

    const searchInput = document.getElementById('search-input');
    const filterCategory = document.getElementById('filter-category');
    const filterSubcategory = document.getElementById('filter-subcategory');
    const filterCity = document.getElementById('filter-city');
    const filterRating = document.getElementById('filter-rating');
    const resetBtn = document.getElementById('reset-filters');
    const businessCards = document.querySelectorAll('.business-card');
    const noResults = document.getElementById('no-results');
    const resultsCount = document.getElementById('results-count');

    function updateSubcategories() {
      const selectedCat = filterCategory.value;
      filterSubcategory.innerHTML = '<option value="">All Subcategories</option>';

      if (selectedCat && categoriesTree[selectedCat]) {
        categoriesTree[selectedCat].forEach(sub => {
          const opt = document.createElement('option');
          opt.value = sub;
          opt.textContent = sub;
          filterSubcategory.appendChild(opt);
        });
        filterSubcategory.disabled = false;
      } else {
        filterSubcategory.disabled = true;
      }
    }

    function filterListings() {
      const query = searchInput.value.toLowerCase().trim();
      const selectedCat = filterCategory.value;
      const selectedSub = filterSubcategory.value;
      const selectedCity = filterCity.value;
      const selectedRating = parseFloat(filterRating.value) || 0;

      let visibleCount = 0;

      businessCards.forEach(card => {
        const name = card.dataset.name;
        const category = card.dataset.category;
        const subcategory = card.dataset.subcategory;
        const city = card.dataset.city.toLowerCase();
        const rating = parseFloat(card.dataset.rating) || 0;

        const matchesQuery = !query || name.includes(query) || category.toLowerCase().includes(query) || subcategory.toLowerCase().includes(query) || city.includes(query);
        const matchesCategory = !selectedCat || category === selectedCat;
        const matchesSubcategory = !selectedSub || subcategory.toLowerCase() === selectedSub.toLowerCase();
        const matchesCity = !selectedCity || card.dataset.city.includes(selectedCity);
        const matchesRating = rating >= selectedRating;

        if (matchesQuery && matchesCategory && matchesSubcategory && matchesCity && matchesRating) {
          card.classList.remove('hidden');
          visibleCount++;
        } else {
          card.classList.add('hidden');
        }
      });

      if (visibleCount === 0) {
        noResults.classList.remove('hidden');
        resultsCount.innerText = '0 business branches found';
      } else {
        noResults.classList.add('hidden');
        resultsCount.innerText = `Showing ${visibleCount} business branch${visibleCount > 1 ? 'es' : ''}`;
      }
    }

    searchInput.addEventListener('input', filterListings);

    filterCategory.addEventListener('change', () => {
      updateSubcategories();
      filterListings();
    });

    filterSubcategory.addEventListener('change', filterListings);
    filterCity.addEventListener('change', filterListings);
    filterRating.addEventListener('change', filterListings);

    resetBtn.addEventListener('click', () => {
      searchInput.value = '';
      filterCategory.value = '';
      filterCity.value = '';
      filterRating.value = '0';
      updateSubcategories();
      filterListings();
    });

    if (filterCategory.value) {
      updateSubcategories();
      filterListings();
    }
  </script>

</body>
</html>
