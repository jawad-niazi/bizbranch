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
$preselected_location  = $_GET['location']  ?? '';
$preselected_q         = $_GET['q']         ?? '';
$preselected_sub       = $_GET['subcategory'] ?? '';
?>
<?php include 'components/header.php'; ?>
<style>
  .card-white {
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    transition: all 0.25s ease;
  }
  /* ── Custom Filter Dropdown ── */
  .csel-wrap {
    position: relative;
    width: 100%;
  }
  .csel-btn {
    width: 100%;
    padding: 9px 36px 9px 14px;
    border: 1px solid #CBD5E1;
    border-radius: 12px;
    font-size: 13px;
    color: #334155;
    background: #fff;
    outline: none;
    font-family: 'Inter', sans-serif;
    cursor: pointer;
    transition: border-color 0.2s, box-shadow 0.2s;
    display: flex;
    align-items: center;
    justify-content: space-between;
    user-select: none;
    text-align: left;
  }
  .csel-btn:hover { border-color: #368997; }
  .csel-btn.disabled-look {
    background: #f8fafc;
    color: #94a3b8;
    cursor: not-allowed;
    pointer-events: none;
  }
  .csel-label {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    flex: 1;
  }
  .csel-chevron {
    width: 16px;
    height: 16px;
    color: #94a3b8;
    flex-shrink: 0;
    margin-left: 6px;
    transition: transform 0.2s ease;
  }
  .csel-dropdown {
    position: absolute;
    top: calc(100% + 6px);
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    box-shadow: 0 12px 32px rgba(0,0,0,0.10);
    z-index: 1001;
    max-height: 280px;
    overflow-y: auto;
    padding: 6px 0;
    display: none;
  }
  .csel-dropdown::-webkit-scrollbar { width: 5px; }
  .csel-dropdown::-webkit-scrollbar-track { background: transparent; }
  .csel-dropdown::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }
  .csel-item {
    padding: 9px 16px;
    font-size: 13px;
    color: #334155;
    cursor: pointer;
    transition: background 0.15s, color 0.15s;
    font-family: 'Inter', sans-serif;
  }
  .csel-item:hover, .csel-item.active {
    background: #f0f9fa;
    color: #368997;
    font-weight: 600;
  }
  /* Mobile: fixed positioning */
  @media (max-width: 767px) {
    .csel-dropdown {
      position: fixed !important;
      left: 12px !important;
      right: 12px !important;
      width: auto !important;
      max-width: calc(100vw - 24px) !important;
      max-height: 50vh !important;
      overflow-y: auto !important;
      z-index: 9999 !important;
      border-radius: 20px !important;
      box-shadow: 0 16px 48px rgba(0,0,0,0.18) !important;
    }
    .csel-btn {
      border-radius: 16px !important;
      padding: 12px 40px 12px 16px !important;
      font-size: 14px !important;
    }
  }
</style>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8 w-full">

    <!-- CENTERED FILTER CONTROL CARD WITH INTEGRATED SEARCH BAR -->
    <div class="bg-white border border-slate-200 rounded-3xl p-6 md:p-8 shadow-sm space-y-6 text-center">
      
      <!-- Centered Header Text -->
      <div class="max-w-xl mx-auto space-y-1">
        <h1 class="text-2xl font-bold text-slate-900">Search Businesses</h1>
        <p class="text-sm text-slate-500">Find businesses by category, location, or rating</p>
      </div>

      <!-- Integrated Search Input & Reset Button Row -->
      <div class="max-w-2xl mx-auto flex flex-col sm:flex-row items-center gap-3">
        <div class="relative w-full">
          <input 
            type="text" 
            id="search-input" 
            placeholder="Search by business name, city, service, or keyword..." 
            class="w-full pl-11 pr-4 py-3 rounded-full bg-slate-50 border border-slate-200 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:border-teal focus:bg-white focus:ring-4 focus:ring-teal/10 transition"
          />
          <svg class="w-4 h-4 text-slate-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>

        <button id="reset-filters" class="w-full sm:w-auto text-xs text-slate-600 hover:text-teal font-bold flex justify-center items-center gap-1.5 transition whitespace-nowrap px-5 py-3 rounded-full border border-slate-200 hover:border-teal/30 hover:bg-teal/5 bg-white">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
          <span>Reset</span>
        </button>

        <!-- Search Button -->
        <button id="search-btn" class="w-full sm:w-auto text-xs text-white font-bold flex justify-center items-center gap-1.5 transition whitespace-nowrap px-6 py-3 rounded-full bg-teal hover:bg-teal-dark shadow-md shadow-teal/20">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
          <span>Search</span>
        </button>
      </div>

      <!-- FILTER DROPDOWNS ROW -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 text-left max-w-5xl mx-auto pt-2">
        
        <!-- 1. CATEGORY custom dropdown -->
        <div id="filter-category-widget" class="csel-wrap"></div>

        <!-- 2. SUBCATEGORY custom dropdown -->
        <div id="filter-subcategory-widget" class="csel-wrap"></div>

        <!-- 3. LOCATION — Smart State → City Widget -->
        <div id="filter-location-widget" style="position:relative;"></div>

        <!-- 4. RATING custom dropdown -->
        <div id="filter-rating-widget" class="csel-wrap"></div>

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

  </div>

  <?php include 'components/footer.php'; ?>

  <!-- JAVASCRIPT DEPENDENT DROPDOWN & REAL-TIME FILTERING -->
  <script src="/js/location-search.js"></script>
  <script>
    const categoriesTree = <?php echo json_encode($categories_tree); ?>;

    const searchInput   = document.getElementById('search-input');
    const resetBtn      = document.getElementById('reset-filters');
    const searchBtn     = document.getElementById('search-btn');
    const businessCards = document.querySelectorAll('.business-card');
    const noResults     = document.getElementById('no-results');
    const resultsCount  = document.getElementById('results-count');

    // ────────────────────────────────────────────────────────────
    // CustomSelect — reusable custom dropdown widget
    // ────────────────────────────────────────────────────────────
    class CustomSelect {
      constructor({ containerId, options, placeholder = 'Select', onChange, disabled = false }) {
        this.containerId = containerId;
        this.options     = options;   // [{value, label}]
        this.placeholder = placeholder;
        this.onChange    = onChange;
        this.disabled    = disabled;
        this.selected    = { value: '', label: placeholder };
        this.isOpen      = false;
        this._render();
        this._bind();
      }

      _render() {
        const c = document.getElementById(this.containerId);
        if (!c) return;

        const chevronSVG = `<svg class="csel-chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>`;

        const btn = document.createElement('div');
        btn.className = 'csel-btn' + (this.disabled ? ' disabled-look' : '');
        btn.innerHTML = `<span class="csel-label">${this.placeholder}</span>${chevronSVG}`;

        const dropdown = document.createElement('div');
        dropdown.className = 'csel-dropdown';

        c.innerHTML = '';
        c.appendChild(btn);
        c.appendChild(dropdown);
        this.el = { btn, dropdown, label: btn.querySelector('.csel-label'), chevron: btn.querySelector('.csel-chevron') };

        this._renderItems();
      }

      _renderItems() {
        this.el.dropdown.innerHTML = this.options.map(o =>
          `<div class="csel-item${this.selected.value === o.value ? ' active' : ''}" data-value="${o.value}">${o.label}</div>`
        ).join('');

        this.el.dropdown.querySelectorAll('.csel-item').forEach(item => {
          item.addEventListener('mousedown', (e) => {
            e.preventDefault();
            const val = item.dataset.value;
            this.selected = this.options.find(o => o.value === val) || { value: val, label: item.textContent };
            this.el.label.textContent = this.selected.label;
            this._close();
            if (typeof this.onChange === 'function') this.onChange(this.selected.value);
          });
        });
      }

      _bind() {
        this.el.btn.addEventListener('click', (e) => {
          e.stopPropagation();
          if (this.disabled) return;
          this.isOpen ? this._close() : this._open();
        });
        document.addEventListener('click', (e) => {
          const c = document.getElementById(this.containerId);
          if (c && !c.contains(e.target)) this._close();
        });
      }

      _open() {
        this.el.dropdown.style.display = 'block';
        this.el.chevron.style.transform = 'rotate(180deg)';
        this.isOpen = true;
        // Mobile: anchor below the button
        if (window.innerWidth < 768) {
          const rect = this.el.btn.getBoundingClientRect();
          this.el.dropdown.style.top = (rect.bottom + 6) + 'px';
        }
      }

      _close() {
        this.el.dropdown.style.display = 'none';
        this.el.chevron.style.transform = '';
        this.isOpen = false;
      }

      getValue() { return this.selected.value; }

      setOptions(options, placeholder, disabled) {
        this.options     = options;
        this.placeholder = placeholder ?? this.placeholder;
        this.disabled    = disabled ?? false;
        this.selected    = { value: '', label: this.placeholder };
        this.el.label.textContent = this.placeholder;
        this.el.btn.classList.toggle('disabled-look', this.disabled);
        this._renderItems();
        this._close();
      }

      reset() {
        this.selected = { value: '', label: this.placeholder };
        this.el.label.textContent = this.placeholder;
        this._renderItems();
        this._close();
      }
    }

    // ── Build category options ────────────────────────────────────
    const categoryOptions = [
      { value: '', label: 'All Categories' },
      ...Object.keys(categoriesTree).map(c => ({ value: c, label: c }))
    ];

    const ratingOptions = [
      { value: '0',   label: '⭐ All Ratings' },
      { value: '4.5', label: '⭐ 4.5+ Stars'  },
      { value: '4.8', label: '⭐ 4.8+ Stars'  },
      { value: '5.0', label: '⭐ 5.0 Stars Only' }
    ];

    // ── Instantiate custom selects ────────────────────────────────
    const catWidget = new CustomSelect({
      containerId: 'filter-category-widget',
      options: categoryOptions,
      placeholder: 'All Categories',
      onChange: (val) => {
        updateSubWidget(val, '');
        filterListings();
      }
    });

    let subWidget = new CustomSelect({
      containerId: 'filter-subcategory-widget',
      options: [{ value: '', label: 'All Subcategories' }],
      placeholder: 'All Subcategories',
      disabled: true,
      onChange: () => filterListings()
    });

    const ratingWidget = new CustomSelect({
      containerId: 'filter-rating-widget',
      options: ratingOptions,
      placeholder: '⭐ All Ratings',
      onChange: () => filterListings()
    });

    // ── Location Widget ───────────────────────────────────────────
    var filterLocation = new BizBranches.LocationSearch({
      containerId: 'filter-location-widget',
      placeholder: 'All Locations',
      initialCity: <?php echo json_encode($preselected_location); ?>,
      onChange: function () { filterListings(); }
    });

    // ── Update subcategory options when category changes ──────────
    function updateSubWidget(cat, preselectSub) {
      if (cat && categoriesTree[cat]) {
        const subs = [
          { value: '', label: 'All Subcategories' },
          ...categoriesTree[cat].map(s => ({ value: s, label: s }))
        ];
        subWidget.setOptions(subs, 'All Subcategories', false);
        if (preselectSub) {
          const match = subs.find(s => s.value.toLowerCase() === preselectSub.toLowerCase());
          if (match) {
            subWidget.selected = match;
            subWidget.el.label.textContent = match.label;
            subWidget._renderItems();
          }
        }
      } else {
        subWidget.setOptions([{ value: '', label: 'All Subcategories' }], 'All Subcategories', true);
      }
    }

    // ── Filter logic ──────────────────────────────────────────────
    function filterListings() {
      const query          = searchInput.value.toLowerCase().trim();
      const selectedCat    = catWidget.getValue();
      const selectedSub    = subWidget.getValue();
      const locVal         = filterLocation.getValue();
      const locQuery       = (locVal.city || locVal.state || '').toLowerCase();
      const selectedRating = parseFloat(ratingWidget.getValue()) || 0;

      let visibleCount = 0;

      businessCards.forEach(card => {
        const name     = card.dataset.name;
        const category = card.dataset.category;
        const subcat   = card.dataset.subcategory;
        const city     = card.dataset.city.toLowerCase();
        const rating   = parseFloat(card.dataset.rating) || 0;

        const matchesQuery    = !query          || name.includes(query) || category.toLowerCase().includes(query) || subcat.toLowerCase().includes(query) || city.includes(query);
        const matchesCategory = !selectedCat    || category === selectedCat;
        const matchesSub      = !selectedSub    || subcat.toLowerCase() === selectedSub.toLowerCase();
        const matchesCity     = !locQuery       || city.includes(locQuery);
        const matchesRating   = rating >= selectedRating;

        const show = matchesQuery && matchesCategory && matchesSub && matchesCity && matchesRating;
        card.classList.toggle('hidden', !show);
        if (show) visibleCount++;
      });

      noResults.classList.toggle('hidden', visibleCount > 0);
      resultsCount.innerText = visibleCount === 0
        ? '0 business branches found'
        : `Showing ${visibleCount} business branch${visibleCount > 1 ? 'es' : ''}`;
    }

    // ── Events ────────────────────────────────────────────────────
    searchInput.addEventListener('input', filterListings);
    searchInput.addEventListener('keydown', (e) => { if (e.key === 'Enter') filterListings(); });
    if (searchBtn) searchBtn.addEventListener('click', filterListings);

    resetBtn.addEventListener('click', () => {
      searchInput.value = '';
      catWidget.reset();
      subWidget.setOptions([{ value: '', label: 'All Subcategories' }], 'All Subcategories', true);
      ratingWidget.reset();
      filterLocation = new BizBranches.LocationSearch({
        containerId: 'filter-location-widget',
        placeholder: 'All Locations',
        onChange: function () { filterListings(); }
      });
      filterListings();
    });

    // ── Pre-select from URL params ────────────────────────────────
    (function () {
      var preCat = <?php echo json_encode($preselected_category); ?>;
      var preSub = <?php echo json_encode($preselected_sub); ?>;
      var preQ   = <?php echo json_encode($preselected_q); ?>;

      if (preQ) searchInput.value = preQ;
      if (preCat) {
        catWidget.selected = { value: preCat, label: preCat };
        catWidget.el.label.textContent = preCat;
        catWidget._renderItems();
        updateSubWidget(preCat, preSub);
      }
      filterListings();
    })();
  </script>

</body>
</html>

