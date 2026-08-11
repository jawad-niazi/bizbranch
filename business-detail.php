<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$data_file = 'data/businesses.json';
$all_businesses = [];
if (file_exists($data_file)) {
    $all_businesses = json_decode(file_get_contents($data_file), true) ?? [];
}

if (isset($all_businesses[$id])) {
    $business = $all_businesses[$id];
    $business['hero_image'] = $business['hero_image'] ?? 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80';
    $business['reviews'] = $business['reviews'] ?? [];
    $business['reviews_count'] = $business['reviews_count'] ?? '0';
    $business['rating'] = $business['rating'] ?? '5.0';
} else {
    // Fallback for demo purposes if ID doesn't exist
    $business = [
        'name' => 'Aura Elite Wellness & Spa',
        'location' => '74 Pall Mall, Mayfair, London',
        'category' => 'Luxury Day Spa',
        'rating' => '5.0',
        'reviews_count' => '124',
        'hero_image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80',
        'logo' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=150&h=150&q=80',
        'phone' => '+44 20 1234 5678',
        'email' => 'hello@auraelite.com',
        'website' => 'www.auraelite.com',
        'contact_person' => 'Sarah Jenkins',
        'owner' => [
            'name' => 'Eleanor Vance',
            'designation' => 'Founder & Master Therapist',
            'photo' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
            'intro' => 'Welcome to Aura Elite. My vision was to create a sanctuary where modern luxury meets holistic wellness. Every treatment is meticulously designed to restore your balance, rejuvenate your skin, and elevate your spirit in the heart of London.'
        ],
        'about_text' => "Experience world-class luxury and deep relaxation at Aura Elite Wellness & Spa. Designed with state-of-the-art ambient lighting, thermal pools, and custom wellness therapies tailored to your comfort.\n\nOur team of expert therapists are dedicated to providing a serene escape from the bustling city. Whether you're looking for a quick revitalizing facial or a full-day retreat, every detail is crafted to elevate your wellbeing.",
        'reviews' => [
            ['name' => 'Justine Namer', 'initials' => 'JN', 'date' => 'Oct 12, 2024', 'rating' => 5, 'text' => 'Exceptional service and extremely tranquil atmosphere. Highly recommended!'],
            ['name' => 'Lisa Rame', 'initials' => 'LR', 'date' => 'Oct 10, 2024', 'rating' => 5, 'text' => 'Pure luxury! The facilities are spotless and the staff is very professional.']
        ]
    ];
}

$recently_added = [
    ['name' => 'Serenity Spa', 'category' => 'Wellness', 'image' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=600&q=80'],
    ['name' => 'Glow Aesthetics', 'category' => 'Beauty', 'image' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&w=600&q=80'],
    ['name' => 'Urban Retreat', 'category' => 'Spa', 'image' => 'https://images.unsplash.com/photo-1519823551278-64ac92734fb1?auto=format&fit=crop&w=600&q=80'],
    ['name' => 'Zen Massage', 'category' => 'Therapy', 'image' => 'https://images.unsplash.com/photo-1600334129128-685054110de4?auto=format&fit=crop&w=600&q=80']
];

$similar_businesses = [
    ['name' => 'Mayfair Wellness', 'category' => 'Day Spa', 'image' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=600&q=80'],
    ['name' => 'London Bathhouse', 'category' => 'Spa', 'image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=600&q=80'],
    ['name' => 'Elite Therapies', 'category' => 'Massage', 'image' => 'https://images.unsplash.com/photo-1560750588-73207b1ef5b8?auto=format&fit=crop&w=600&q=80'],
    ['name' => 'Pure Oasis', 'category' => 'Wellness', 'image' => 'https://images.unsplash.com/photo-1583417319070-4a69db38a482?auto=format&fit=crop&w=600&q=80']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($business['name']) ?> - BizBranches</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Inter', sans-serif; background-color: #F8FAFC; color: #0F172A; overflow-x: hidden; }
    
    /* Subtle hover scale */
    .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .hover-lift:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }

    /* Custom Animations */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .fade-in-up { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
  </style>
</head>
<body class="min-h-screen">

  <!-- Header -->
  <header class="bg-white border-b border-slate-200 sticky top-0 z-50 fade-in-up">
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-4 flex items-center justify-between">
      <div class="flex items-center space-x-2">
        <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center font-bold text-xs text-white shadow-sm">BB</div>
        <a href="/" class="font-bold tracking-tight text-slate-900 text-xl hover:text-blue-600 transition-colors">BizBranches</a>
      </div>
      <nav class="hidden md:flex space-x-8 text-sm font-medium text-slate-600">
        <a href="/" class="hover:text-blue-600 transition-colors">Discover</a>
        <a href="#" class="text-blue-600 border-b-2 border-blue-600 pb-1">Services</a>
        <a href="#" class="hover:text-blue-600 transition-colors">Gallery</a>
        <a href="#" class="hover:text-blue-600 transition-colors">Bookings</a>
      </nav>
      <div class="flex items-center space-x-4">
        <button class="text-sm font-medium text-slate-600 hover:text-blue-600 transition-colors">Log In</button>
        <button class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">Add Business</button>
      </div>
    </div>
  </header>

  <!-- Main Container -->
  <main class="max-w-7xl mx-auto px-4 md:px-8 py-8 space-y-8">
    
    <!-- 1. Business Showcase Banner -->
    <section class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200 flex flex-col xl:flex-row justify-between items-center xl:space-x-8 space-y-6 xl:space-y-0 fade-in-up delay-200">
      
      <div class="flex items-center space-x-6 w-full xl:w-auto">
        <div class="w-20 h-20 shrink-0 rounded-2xl overflow-hidden border border-slate-100 shadow-sm bg-slate-50">
           <img src="<?= htmlspecialchars($business['logo']) ?>" alt="Logo" class="w-full h-full object-cover" />
        </div>
        <div class="flex flex-col">
          <div class="flex items-center space-x-3 mb-1">
            <h2 class="text-2xl font-bold text-slate-900"><?= htmlspecialchars($business['name']) ?></h2>
            <span class="bg-blue-50 text-blue-700 px-2.5 py-0.5 rounded-full text-xs font-bold border border-blue-100 flex items-center">
              <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
              Listed on BizBranches
            </span>
          </div>
          <div class="flex flex-wrap items-center text-sm text-slate-500 gap-y-2">
            <span class="flex items-center mr-4">
              <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
              <?= htmlspecialchars($business['category']) ?>
            </span>
            <span class="flex items-center mr-4">
              <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
              <?= htmlspecialchars($business['location']) ?>
            </span>
            <span class="flex items-center text-amber-500 font-medium">
              <?= htmlspecialchars($business['rating']) ?>
              <svg class="w-4 h-4 ml-1 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
              <span class="text-slate-400 ml-1 font-normal">(<?= htmlspecialchars($business['reviews_count']) ?>)</span>
            </span>
          </div>
          <div class="flex items-center space-x-4 mt-3 pt-3 border-t border-slate-100">
            <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
            <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
            <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></a>
            <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg></a>
          </div>
        </div>
      </div>

      <!-- Action Bar -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-3 w-full xl:w-auto shrink-0">
        <button class="bg-white border border-slate-200 hover:border-blue-600 hover:text-blue-600 text-slate-700 py-2.5 px-4 rounded-xl flex items-center justify-center text-sm font-semibold transition-colors shadow-sm">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
          Call Now
        </button>
        <button class="bg-white border border-slate-200 hover:border-blue-600 hover:text-blue-600 text-slate-700 py-2.5 px-4 rounded-xl flex items-center justify-center text-sm font-semibold transition-colors shadow-sm">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
          Visit Website
        </button>
        <button class="bg-white border border-slate-200 hover:border-blue-600 hover:text-blue-600 text-slate-700 py-2.5 px-4 rounded-xl flex items-center justify-center text-sm font-semibold transition-colors shadow-sm">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
          Write Review
        </button>
        <button class="bg-blue-600 hover:bg-blue-700 text-white border border-transparent py-2.5 px-4 rounded-xl flex items-center justify-center text-sm font-semibold transition-colors shadow-sm shadow-blue-600/20">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
          Directions
        </button>
      </div>

    </section>

    <!-- Main Content Columns -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      
      <!-- 3. Left Column (65%) -->
      <div class="lg:col-span-8 space-y-8 fade-in-up delay-300">
        
        <!-- About the Business -->
        <section class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200">
          <h3 class="text-xl font-bold text-slate-900 mb-4 flex items-center">
             <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
             About the Business
          </h3>
          <div class="text-slate-600 leading-relaxed space-y-4 mb-8">
            <?php foreach(explode("\n\n", $business['about_text']) as $p): ?>
              <p><?= htmlspecialchars($p) ?></p>
            <?php endforeach; ?>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-6 border-t border-slate-100">
            <div class="flex items-start space-x-3">
              <div class="bg-blue-50 p-2 rounded-lg text-blue-600 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
              </div>
              <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-0.5">Address</p>
                <p class="text-sm text-slate-700 font-medium leading-tight"><?= htmlspecialchars($business['location']) ?></p>
              </div>
            </div>
            <div class="flex items-start space-x-3">
              <div class="bg-blue-50 p-2 rounded-lg text-blue-600 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
              </div>
              <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-0.5">Phone</p>
                <a href="tel:<?= htmlspecialchars($business['phone']) ?>" class="text-sm text-slate-700 font-medium hover:text-blue-600 transition-colors"><?= htmlspecialchars($business['phone']) ?></a>
              </div>
            </div>
            <div class="flex items-start space-x-3">
              <div class="bg-blue-50 p-2 rounded-lg text-blue-600 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z"></path></svg>
              </div>
              <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-0.5">Email</p>
                <a href="mailto:<?= htmlspecialchars($business['email']) ?>" class="text-sm text-slate-700 font-medium hover:text-blue-600 transition-colors"><?= htmlspecialchars($business['email']) ?></a>
              </div>
            </div>
            <div class="flex items-start space-x-3">
              <div class="bg-blue-50 p-2 rounded-lg text-blue-600 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
              </div>
              <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-0.5">Website</p>
                <a href="https://<?= htmlspecialchars($business['website']) ?>" class="text-sm text-blue-600 font-semibold hover:text-blue-800 transition-colors"><?= htmlspecialchars($business['website']) ?></a>
              </div>
            </div>
          </div>
        </section>

        <!-- Customer Reviews -->
        <section class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200">
          <div class="flex items-center justify-between mb-6 pb-6 border-b border-slate-100">
            <div>
              <h3 class="text-xl font-bold text-slate-900">Customer Reviews</h3>
              <p class="text-sm text-slate-500 mt-1"><span class="text-amber-500 font-bold text-lg"><?= htmlspecialchars($business['rating']) ?></span> out of 5 based on <?= htmlspecialchars($business['reviews_count']) ?> reviews</p>
            </div>
            <button class="bg-white border border-slate-200 hover:border-blue-600 hover:text-blue-600 text-slate-700 py-2 px-4 rounded-xl flex items-center text-sm font-semibold transition-colors shadow-sm">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
              Write a Review
            </button>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach($business['reviews'] as $review): ?>
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 hover-lift">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center space-x-3">
                  <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-sm">
                    <?= htmlspecialchars($review['initials']) ?>
                  </div>
                  <div>
                    <p class="text-sm font-bold text-slate-900"><?= htmlspecialchars($review['name']) ?></p>
                    <p class="text-[11px] font-medium text-slate-500"><?= htmlspecialchars($review['date']) ?></p>
                  </div>
                </div>
                <div class="flex text-amber-500">
                  <?php for($i = 0; $i < $review['rating']; $i++): ?>
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                  <?php endfor; ?>
                </div>
              </div>
              <p class="text-sm text-slate-600 leading-relaxed italic">"<?= htmlspecialchars($review['text']) ?>"</p>
            </div>
            <?php endforeach; ?>
          </div>
        </section>

        <!-- Recently Added Businesses -->
        <section class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200">
          <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Recently Added Businesses
          </h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <?php foreach($recently_added as $recent): ?>
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden group hover:border-blue-200 hover-lift transition-all cursor-pointer flex flex-col">
              <div class="h-28 overflow-hidden bg-slate-100 relative">
                <img src="<?= htmlspecialchars($recent['image']) ?>" alt="<?= htmlspecialchars($recent['name']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" />
              </div>
              <div class="p-4 flex flex-col items-center text-center bg-slate-50 flex-grow">
                <h4 class="font-bold text-sm text-slate-900 truncate w-full mb-1"><?= htmlspecialchars($recent['name']) ?></h4>
                <p class="text-[11px] text-slate-500 bg-white px-2 py-0.5 rounded border border-slate-100 shadow-sm mb-3 uppercase tracking-wider font-semibold"><?= htmlspecialchars($recent['category']) ?></p>
                <a href="#" class="text-blue-600 text-xs font-bold hover:text-blue-800 flex items-center mt-auto">
                  View Details 
                  <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </section>

        <!-- Similar Businesses -->
        <section class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200">
          <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            Similar Businesses in <span class="text-blue-600 ml-1"><?= htmlspecialchars($business['category']) ?></span>
          </h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <?php foreach($similar_businesses as $similar): ?>
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden group hover:border-blue-200 hover-lift transition-all cursor-pointer flex flex-col">
              <div class="h-28 overflow-hidden bg-slate-100 relative">
                <img src="<?= htmlspecialchars($similar['image']) ?>" alt="<?= htmlspecialchars($similar['name']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" />
              </div>
              <div class="p-4 flex flex-col items-center text-center bg-slate-50 flex-grow">
                <h4 class="font-bold text-sm text-slate-900 truncate w-full mb-1"><?= htmlspecialchars($similar['name']) ?></h4>
                <p class="text-[11px] text-slate-500 bg-white px-2 py-0.5 rounded border border-slate-100 shadow-sm mb-3 uppercase tracking-wider font-semibold"><?= htmlspecialchars($similar['category']) ?></p>
                <a href="#" class="text-blue-600 text-xs font-bold hover:text-blue-800 flex items-center mt-auto">
                  View Details 
                  <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </section>

      </div>

      <!-- 4. Right Column (35%) - Sticky Sidebar -->
      <div class="lg:col-span-4 fade-in-up delay-400 relative">
        <div class="sticky top-24 space-y-6">
          
          <!-- Interactive Google Maps -->
          <div class="bg-white rounded-3xl p-2 shadow-sm border border-slate-200">
             <div class="aspect-[4/3] rounded-2xl relative overflow-hidden border border-slate-100">
               <iframe 
                 src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.284724016629!2d-0.14154948407421375!3d51.50796341848529!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604d50849204b%3A0x868b4b2cdaeb5749!2sPall%20Mall%2C%20London%2C%20UK!5e0!3m2!1sen!2sus!4v1689255018698!5m2!1sen!2sus" 
                 width="100%" 
                 height="100%" 
                 style="border:0;" 
                 allowfullscreen="" 
                 loading="lazy" 
                 referrerpolicy="no-referrer-when-downgrade"
                 class="absolute inset-0">
               </iframe>
             </div>
             <a href="#" target="_blank" class="mt-2 text-blue-600 text-sm font-semibold hover:text-blue-800 flex items-center justify-center p-2 rounded-xl hover:bg-blue-50 transition-colors w-full">
               Open in Google Maps
               <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
             </a>
          </div>

          <!-- Business Owner Profile Card -->
          <?php if (!empty($business['owner']['name'])): ?>
          <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
            <h3 class="text-lg font-bold text-slate-900 mb-5 border-b border-slate-100 pb-4 flex items-center">
              <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
              Meet the Owner
            </h3>
            <div class="flex flex-col items-center text-center">
              <div class="relative mb-4">
                <img src="<?= htmlspecialchars($business['owner']['photo']) ?>" alt="<?= htmlspecialchars($business['owner']['name']) ?>" class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md" />
                <div class="absolute bottom-0 right-0 bg-blue-600 text-white p-1 rounded-full border-2 border-white shadow-sm" title="Verified Owner">
                  <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                </div>
              </div>
              <h4 class="font-bold text-slate-900 text-lg"><?= htmlspecialchars($business['owner']['name']) ?></h4>
              <p class="text-sm font-medium text-slate-500 mb-1"><?= htmlspecialchars($business['owner']['designation']) ?></p>
              <p class="text-xs text-slate-400 mb-4 flex items-center justify-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                From London, UK
              </p>
              <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                <p class="text-sm text-slate-600 italic line-clamp-2 leading-relaxed">"<?= htmlspecialchars($business['owner']['intro']) ?>"</p>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <!-- Contact & Location Card -->
          <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
            <h3 class="text-lg font-bold text-slate-900 mb-5 border-b border-slate-100 pb-4">Contact Information</h3>
            <ul class="space-y-4">
              <li class="flex items-start">
                <div class="bg-blue-50 p-2 rounded-lg text-blue-600 mr-4 shrink-0">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div>
                  <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-0.5">Address</p>
                  <p class="text-sm text-slate-700 font-medium leading-tight"><?= htmlspecialchars($business['location']) ?></p>
                </div>
              </li>
              <li class="flex items-start">
                <div class="bg-blue-50 p-2 rounded-lg text-blue-600 mr-4 shrink-0">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </div>
                <div>
                  <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-0.5">Phone</p>
                  <a href="tel:<?= htmlspecialchars($business['phone']) ?>" class="text-sm text-slate-700 font-medium hover:text-blue-600 transition-colors"><?= htmlspecialchars($business['phone']) ?></a>
                </div>
              </li>
              <li class="flex items-start">
                <div class="bg-blue-50 p-2 rounded-lg text-blue-600 mr-4 shrink-0">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                  <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-0.5">Email</p>
                  <a href="mailto:<?= htmlspecialchars($business['email']) ?>" class="text-sm text-slate-700 font-medium hover:text-blue-600 transition-colors"><?= htmlspecialchars($business['email']) ?></a>
                </div>
              </li>
              <li class="flex items-start">
                <div class="bg-blue-50 p-2 rounded-lg text-blue-600 mr-4 shrink-0">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                </div>
                <div>
                  <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-0.5">Website</p>
                  <a href="https://<?= htmlspecialchars($business['website']) ?>" class="text-sm text-blue-600 font-semibold hover:text-blue-800 transition-colors"><?= htmlspecialchars($business['website']) ?></a>
                </div>
              </li>
              <li class="flex items-start pt-4 border-t border-slate-100">
                <div class="bg-slate-100 p-2 rounded-lg text-slate-500 mr-4 shrink-0">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                  <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-0.5">Contact Person</p>
                  <p class="text-sm text-slate-900 font-bold"><?= htmlspecialchars($business['contact_person']) ?></p>
                </div>
              </li>
            </ul>
          </div>



        </div>
      </div>

    </div>
  </main>

  <!-- 5. Footer -->
  <footer class="bg-white border-t border-slate-200 mt-12 py-12">
    <div class="max-w-7xl mx-auto px-4 md:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
      <div class="space-y-4 col-span-1 md:col-span-2">
        <div class="flex items-center space-x-2">
          <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center font-bold text-xs text-white">BB</div>
          <span class="font-bold tracking-tight text-slate-900 text-xl">BizBranches</span>
        </div>
        <p class="text-sm text-slate-500 leading-relaxed max-w-sm">
          The most trusted local business directory. Discover and connect with top-rated businesses, services, and professionals in your area.
        </p>
        <div class="flex space-x-6 pt-2">
          <div class="text-slate-900 font-bold">50K+ <span class="text-slate-500 font-normal text-sm ml-1">Businesses</span></div>
          <div class="text-slate-900 font-bold">2M+ <span class="text-slate-500 font-normal text-sm ml-1">Users</span></div>
          <div class="text-slate-900 font-bold">1M+ <span class="text-slate-500 font-normal text-sm ml-1">Reviews</span></div>
        </div>
      </div>
      <div>
        <h4 class="font-bold text-slate-900 mb-4">Categories</h4>
        <ul class="space-y-3 text-sm text-slate-500">
          <li><a href="#" class="hover:text-blue-600 transition-colors">Restaurants & Food</a></li>
          <li><a href="#" class="hover:text-blue-600 transition-colors">Health & Medical</a></li>
          <li><a href="#" class="hover:text-blue-600 transition-colors">Home Services</a></li>
          <li><a href="#" class="hover:text-blue-600 transition-colors">Beauty & Spas</a></li>
          <li><a href="#" class="hover:text-blue-600 transition-colors">Real Estate</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold text-slate-900 mb-4">Support</h4>
        <ul class="space-y-3 text-sm text-slate-500">
          <li><a href="#" class="hover:text-blue-600 transition-colors">About Us</a></li>
          <li><a href="#" class="hover:text-blue-600 transition-colors">Contact</a></li>
          <li><a href="#" class="hover:text-blue-600 transition-colors">Terms of Service</a></li>
          <li><a href="#" class="hover:text-blue-600 transition-colors">Privacy Policy</a></li>
        </ul>
      </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 md:px-8 mt-12 pt-8 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between">
      <p class="text-sm text-slate-400">© 2024 BizBranches. All rights reserved.</p>
      <div class="flex space-x-4 mt-4 md:mt-0 text-slate-400">
         <!-- Social Icons Placeholders -->
         <a href="#" class="hover:text-blue-600 transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
         <a href="#" class="hover:text-blue-600 transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
      </div>
    </div>
  </footer>

</body>
</html>
