<?php
$data_file = 'data/businesses.json';
$businesses = [];
if (file_exists($data_file)) {
    $businesses = json_decode(file_get_contents($data_file), true) ?? [];
}
// Reverse to show newest first
$businesses = array_reverse($businesses);

// Mock data if empty
if (empty($businesses)) {
    $businesses = [
        [
            'id' => 'mock_1',
            'name' => 'Serenity Spa & Wellness',
            'category' => 'Home Services', // To match a category
            'city' => 'Los Angeles, CA',
            'rating' => '5.0',
            'reviews_count' => '5',
            'hero_image' => 'https://images.unsplash.com/photo-1600334129128-68505d48fc36?auto=format&fit=crop&q=80&w=600'
        ],
        [
            'id' => 'mock_2',
            'name' => 'The Golden Fork',
            'category' => 'Travel', // To match a category
            'city' => 'New York, NY',
            'rating' => '4.5',
            'reviews_count' => '12',
            'hero_image' => 'https://images.unsplash.com/photo-1550966871-3ed3cdb5ed0c?auto=format&fit=crop&q=80&w=600'
        ]
    ];
} else {
    // ensure IDs are set for real data to link correctly
    foreach ($businesses as $index => &$biz) {
        $biz['id'] = count($businesses) - 1 - $index;
    }
    unset($biz);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Categories - BizBranches</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8FAFC; color: #0F172A; }
  </style>
</head>
<body class="min-h-screen flex flex-col">

  <!-- Header -->
  <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      <a href="index.php" class="flex items-center space-x-3">
        <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center font-bold text-white tracking-wider">BB</div>
        <span class="font-extrabold text-xl text-slate-900 tracking-tight">BizBranches</span>
      </a>
      <nav class="hidden md:flex space-x-8 text-sm font-semibold text-slate-600">
        <a href="index.php" class="hover:text-blue-600 transition">Discover</a>
        <a href="categories.php" class="text-blue-600 transition">Categories</a>
        <a href="#" class="hover:text-blue-600 transition">Our Directories</a>
      </nav>
      <div class="flex items-center space-x-3">
        <a href="add-business.php" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-xl text-xs transition shadow-md shadow-blue-600/20">+ Add Business</a>
      </div>
    </div>
  </header>

  <main class="flex-grow">
    <!-- Hero Header with Search -->
    <section class="bg-slate-900 py-16 px-4">
      <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-6 tracking-tight">Discover Your BizBranches</h1>
        
        <div class="relative max-w-2xl mx-auto">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
          </div>
          <input type="text" id="liveSearch" placeholder="Search for a business..." class="w-full pl-12 pr-4 py-4 rounded-2xl bg-white border-0 shadow-lg text-slate-900 font-medium focus:ring-4 focus:ring-blue-500/30 transition-all outline-none" />
        </div>
      </div>
    </section>

    <!-- Filter Control Bar -->
    <section class="bg-white border-b border-slate-200 sticky top-16 z-40 shadow-sm">
      <div class="max-w-7xl mx-auto px-4 py-3 flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
          <select id="filterCategory" class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl px-4 py-2 font-medium focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer">
            <option value="">All Categories</option>
            <option value="Home Services">Home Services</option>
            <option value="Legal">Legal</option>
            <option value="Auto">Auto</option>
            <option value="Financial">Financial</option>
            <option value="Insurance">Insurance</option>
            <option value="Travel">Travel</option>
            <option value="Medical">Medical</option>
            <option value="Telecom">Telecom</option>
          </select>
          
          <select id="filterLocation" class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl px-4 py-2 font-medium focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer">
            <option value="">All Locations</option>
            <!-- Locations will be populated by JS based on data -->
          </select>

          <select id="filterRating" class="bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-xl px-4 py-2 font-medium focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer">
            <option value="0">Any Rating</option>
            <option value="4">4+ Stars</option>
            <option value="4.5">4.5+ Stars</option>
            <option value="5">5 Stars</option>
          </select>
        </div>
        <button id="resetFilters" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition flex items-center shrink-0">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
          Reset Filters
        </button>
      </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      
      <!-- Parent Category Grid -->
      <div class="mb-16">
        <h2 class="text-2xl font-extrabold text-slate-900 mb-6">Browse Categories</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <?php
            $parent_cats = [
                'Home Services' => ['Plumbing', 'Electrical', 'Cleaning'],
                'Legal' => ['Lawyers', 'Notary', 'Consulting'],
                'Auto' => ['Repair', 'Wash', 'Dealerships'],
                'Financial' => ['Accounting', 'Planning', 'Tax'],
                'Insurance' => ['Auto', 'Health', 'Home'],
                'Travel' => ['Agencies', 'Hotels', 'Tours'],
                'Medical' => ['Clinics', 'Dental', 'Therapy'],
                'Telecom' => ['Internet', 'Mobile', 'Repairs']
            ];
            foreach ($parent_cats as $cat => $subs):
          ?>
          <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:shadow-md transition cursor-pointer cat-card" data-category="<?= htmlspecialchars($cat) ?>">
            <h3 class="text-lg font-bold text-slate-900 mb-3"><?= htmlspecialchars($cat) ?></h3>
            <div class="flex flex-wrap gap-2">
              <?php foreach ($subs as $sub): ?>
                <span class="text-[10px] font-bold text-slate-500 bg-slate-100 px-2 py-1 rounded-md uppercase tracking-wider"><?= htmlspecialchars($sub) ?></span>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Business Listings Grid -->
      <div>
        <h2 class="text-2xl font-extrabold text-slate-900 mb-6">Business Listings</h2>
        <div id="listingsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <?php foreach ($businesses as $biz): 
              // Extract details
              $name = htmlspecialchars($biz['name'] ?? 'Unnamed');
              $category = htmlspecialchars($biz['category'] ?? 'Uncategorized');
              $location = htmlspecialchars($biz['city'] ?? $biz['location'] ?? 'Location unknown');
              $rating = htmlspecialchars($biz['rating'] ?? '0');
              $reviews = htmlspecialchars($biz['reviews_count'] ?? '0');
              $link = "business-detail.php?id=" . htmlspecialchars($biz['id']);
              
              // Determine background image (fallback to placeholder if no logo or hero_image)
              $bg_image = !empty($biz['hero_image']) ? $biz['hero_image'] : (!empty($biz['logo']) ? $biz['logo'] : 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=600');
          ?>
          <div class="listing-card bg-cover bg-center relative overflow-hidden rounded-3xl shadow-sm border border-slate-200 group h-[280px]" 
               style="background-image: url('<?= htmlspecialchars($bg_image) ?>');"
               data-name="<?= strtolower($name) ?>"
               data-category="<?= strtolower($category) ?>"
               data-location="<?= strtolower($location) ?>"
               data-rating="<?= $rating ?>">
            
            <!-- Foggy Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-white/75 to-white backdrop-blur-[3px] transition group-hover:backdrop-blur-[2px]"></div>

            <!-- Card Content (Relative z-10) -->
            <div class="relative z-10 p-6 h-full flex flex-col justify-between">
              
              <div class="flex justify-between items-start">
                <span class="text-[10px] font-bold text-blue-700 bg-blue-50 px-2.5 py-1 rounded-full uppercase tracking-wider border border-blue-100">
                  <?= $category ?>
                </span>
                <div class="flex items-center bg-white/80 backdrop-blur-sm px-2 py-1 rounded-full shadow-sm">
                  <svg class="w-3.5 h-3.5 text-amber-500 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                  <span class="text-xs font-bold text-slate-800"><?= $rating ?> <span class="text-slate-500 font-medium">(<?= $reviews ?>)</span></span>
                </div>
              </div>

              <div>
                <h3 class="text-xl font-extrabold text-slate-900 mb-2 leading-tight"><?= $name ?></h3>
                <p class="text-sm font-medium text-slate-600 mb-5 flex items-center">
                  <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                  <?= $location ?>
                </p>
                <a href="<?= $link ?>" class="inline-flex items-center justify-center w-full bg-slate-900 hover:bg-blue-600 text-white font-bold py-2.5 rounded-xl text-sm transition-colors">
                  View Details
                </a>
              </div>

            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <div id="noResults" class="hidden text-center py-16 bg-white rounded-3xl border border-slate-200 shadow-sm mt-6">
          <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          <h3 class="text-lg font-bold text-slate-900 mb-2">No businesses found</h3>
          <p class="text-slate-500 text-sm">Try adjusting your search or filters.</p>
        </div>

      </div>
    </div>
  </main>

  <footer class="bg-slate-900 text-white py-8 border-t border-slate-800 text-center">
    <div class="max-w-7xl mx-auto px-4 text-xs text-slate-500">
      &copy; <?= date('Y') ?> BizBranches. All rights reserved.
    </div>
  </footer>

  <!-- JavaScript for Live Filtering -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const searchInput = document.getElementById('liveSearch');
      const filterCategory = document.getElementById('filterCategory');
      const filterLocation = document.getElementById('filterLocation');
      const filterRating = document.getElementById('filterRating');
      const resetBtn = document.getElementById('resetFilters');
      const cards = document.querySelectorAll('.listing-card');
      const noResults = document.getElementById('noResults');
      const catCards = document.querySelectorAll('.cat-card');

      // Populate locations dropdown dynamically
      const locations = new Set();
      cards.forEach(card => {
          let loc = card.getAttribute('data-location').trim();
          if (loc) {
              // Capitalize words for nice display
              loc = loc.split(' ').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join(' ');
              locations.add(loc);
          }
      });
      locations.forEach(loc => {
          const option = document.createElement('option');
          option.value = loc;
          option.textContent = loc;
          filterLocation.appendChild(option);
      });

      function filterListings() {
        const query = searchInput.value.toLowerCase().trim();
        const selectedCat = filterCategory.value.toLowerCase();
        const selectedLoc = filterLocation.value.toLowerCase();
        const minRating = parseFloat(filterRating.value);

        let visibleCount = 0;

        cards.forEach(card => {
          const name = card.getAttribute('data-name');
          const cat = card.getAttribute('data-category');
          const loc = card.getAttribute('data-location');
          const rating = parseFloat(card.getAttribute('data-rating')) || 0;

          const matchesQuery = name.includes(query) || cat.includes(query) || loc.includes(query);
          const matchesCat = selectedCat === '' || cat.includes(selectedCat);
          const matchesLoc = selectedLoc === '' || loc.includes(selectedLoc);
          const matchesRating = rating >= minRating;

          if (matchesQuery && matchesCat && matchesLoc && matchesRating) {
            card.style.display = 'block';
            visibleCount++;
          } else {
            card.style.display = 'none';
          }
        });

        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
      }

      // Event Listeners
      searchInput.addEventListener('input', filterListings);
      filterCategory.addEventListener('change', filterListings);
      filterLocation.addEventListener('change', filterListings);
      filterRating.addEventListener('change', filterListings);

      resetBtn.addEventListener('click', () => {
        searchInput.value = '';
        filterCategory.value = '';
        filterLocation.value = '';
        filterRating.value = '0';
        filterListings();
      });

      // Clicking Parent Category Card
      catCards.forEach(cc => {
        cc.addEventListener('click', () => {
          filterCategory.value = cc.getAttribute('data-category');
          filterListings();
          // Scroll to listings smoothly
          document.getElementById('listingsGrid').scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
      });
    });
  </script>
</body>
</html>
