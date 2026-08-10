<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Mock database for dynamic routing
$businesses = [
    1 => [
        'name' => 'AURA ELITE WELLNESS & SPA',
        'location' => 'Luxury Day Spa • Mayfair, London',
        'rating' => '5.0 ★★★★★',
        'reviews' => '124',
        'hero_image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80',
        'phone' => '+44 20 1234 5678',
        'email' => 'email@auraelite.com',
        'price' => '£180',
        'services' => [
            ['title' => 'Radiance Ritual', 'desc' => 'Elegant glassmorphism treatment card experience.', 'icon' => '✦', 'price' => '£180'],
            ['title' => 'Royal Massage', 'desc' => 'Deep tissue full-body therapy experience.', 'icon' => '♨', 'price' => '£150'],
            ['title' => 'Emerald Facial', 'desc' => 'Revitalizing skin care and luxury polish.', 'icon' => '✵', 'price' => '£180']
        ]
    ],
    2 => [
        'name' => 'THE GOLDEN FORK',
        'location' => 'Fine Dining • Soho, London',
        'rating' => '4.8 ★★★★☆',
        'reviews' => '312',
        'hero_image' => 'https://images.unsplash.com/photo-1550966871-3ed3cdb5ed0c?auto=format&fit=crop&w=1200&q=80',
        'phone' => '+44 20 9876 5432',
        'email' => 'hello@goldenfork.com',
        'price' => '£120',
        'services' => [
            ['title' => 'Tasting Menu', 'desc' => '7-course seasonal tasting menu.', 'icon' => '🍽', 'price' => '£120'],
            ['title' => 'Wine Pairing', 'desc' => 'Sommelier selected pairings.', 'icon' => '🍷', 'price' => '£80'],
            ['title' => 'Chef Table', 'desc' => 'Exclusive kitchen side experience.', 'icon' => '👨‍🍳', 'price' => '£200']
        ]
    ],
    3 => [
        'name' => 'PRIME PROPERTIES GROUP',
        'location' => 'Real Estate • Miami, FL',
        'rating' => '5.0 ★★★★★',
        'reviews' => '89',
        'hero_image' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=1200&q=80',
        'phone' => '+1 305 555 1234',
        'email' => 'contact@primeproperties.com',
        'price' => 'Consultation',
        'services' => [
            ['title' => 'Buying Consult', 'desc' => 'Expert guidance on purchasing.', 'icon' => '🏠', 'price' => 'Free'],
            ['title' => 'Listing Service', 'desc' => 'Premium marketing for sellers.', 'icon' => '📈', 'price' => '2.5%'],
            ['title' => 'Property Mgt', 'desc' => 'Full service property management.', 'icon' => '🔑', 'price' => '$150/mo']
        ]
    ]
];

$business = $businesses[$id] ?? $businesses[1];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($business['name']) ?> Details</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Inter', sans-serif; background-color: #0F1317; color: #E5E7EB; overflow-x: hidden; }
    .glass-card {
      background: rgba(22, 28, 36, 0.75);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .gold-border { border: 1px solid rgba(212, 175, 55, 0.3); }

    /* Custom Animations */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes glowPulse {
      0% { box-shadow: 0 0 10px rgba(212, 175, 55, 0.1); }
      50% { box-shadow: 0 0 25px rgba(212, 175, 55, 0.4); }
      100% { box-shadow: 0 0 10px rgba(212, 175, 55, 0.1); }
    }
    .fade-in-up { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }
    .delay-100 { animation-delay: 0.1s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-500 { animation-delay: 0.5s; }
    .glow-pulse { animation: glowPulse 3s infinite; }
  </style>
</head>
<body class="min-h-screen p-4 md:p-8">

  <!-- Header -->
  <header class="max-w-7xl mx-auto flex items-center justify-between pb-6 border-b border-gray-800 fade-in-up delay-100">
    <div class="flex items-center space-x-2">
      <div class="w-8 h-8 rounded-full bg-emerald-600 flex items-center justify-center font-bold text-xs text-white">AE</div>
      <a href="/" class="font-bold tracking-wider text-amber-100 text-lg hover:text-amber-300 transition-colors">BIZDIRECTORY</a>
    </div>
    <nav class="hidden md:flex space-x-6 text-sm text-gray-400">
      <a href="/" class="hover:text-white transition">Discover</a>
      <a href="#" class="text-amber-200 border-b border-amber-200 pb-1">Services</a>
      <a href="#" class="hover:text-white transition">Gallery</a>
      <a href="#" class="hover:text-white transition">Book</a>
      <a href="#" class="hover:text-white transition">Account</a>
    </nav>
    <div class="w-8 h-8 rounded-full border border-gray-700 flex items-center justify-center text-xs font-semibold">AE</div>
  </header>

  <!-- Main Container -->
  <main class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 mt-6">
    
    <!-- Left Column (65%) -->
    <div class="lg:col-span-8 space-y-8 fade-in-up delay-300">
      
      <!-- Business Header -->
      <div class="flex justify-between items-start">
        <div>
          <h1 class="text-2xl font-bold text-amber-100 tracking-wide"><?= htmlspecialchars($business['name']) ?></h1>
          <p class="text-xs text-gray-400 mt-1"><?= htmlspecialchars($business['location']) ?> • <span class="text-amber-300"><?= htmlspecialchars($business['rating']) ?></span> (<?= htmlspecialchars($business['reviews']) ?> Reviews)</p>
        </div>
        <button class="p-2 rounded-full glass-card hover:border-amber-400/50 hover:scale-110 transition-all duration-300">
          <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
        </button>
      </div>

      <!-- Hero Gallery -->
      <div class="space-y-3">
        <div class="relative rounded-2xl overflow-hidden h-72 md:h-96 border border-gray-800 transition-transform duration-500 hover:shadow-2xl">
          <img src="<?= htmlspecialchars($business['hero_image']) ?>" alt="Business Preview" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105" />
          <button class="absolute left-3 top-1/2 -translate-y-1/2 p-2 rounded-full glass-card text-xs hover:bg-gray-800 transition-colors">❮</button>
          <button class="absolute right-3 top-1/2 -translate-y-1/2 p-2 rounded-full glass-card text-xs hover:bg-gray-800 transition-colors">❯</button>
        </div>
        
        <!-- Thumbnails -->
        <div class="flex space-x-3 overflow-x-auto pb-2">
          <img src="<?= htmlspecialchars($business['hero_image']) ?>" class="w-20 h-14 object-cover rounded-lg border-2 border-amber-400 opacity-100 transition-all duration-300 hover:scale-105" />
          <img src="https://images.unsplash.com/photo-1519823551278-64ac92734fb1?auto=format&fit=crop&w=200&q=80" class="w-20 h-14 object-cover rounded-lg border border-gray-800 opacity-60 hover:opacity-100 cursor-pointer transition-all duration-300 hover:scale-105 hover:border-amber-400/50" />
          <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=200&q=80" class="w-20 h-14 object-cover rounded-lg border border-gray-800 opacity-60 hover:opacity-100 cursor-pointer transition-all duration-300 hover:scale-105 hover:border-amber-400/50" />
          <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=200&q=80" class="w-20 h-14 object-cover rounded-lg border border-gray-800 opacity-60 hover:opacity-100 cursor-pointer transition-all duration-300 hover:scale-105 hover:border-amber-400/50" />
        </div>
      </div>

      <!-- Signature Services -->
      <div class="space-y-4">
        <h3 class="text-lg font-semibold text-gray-200">Signature Services</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          
          <?php foreach ($business['services'] as $service): ?>
          <div class="glass-card p-4 rounded-xl border border-gray-800 hover:border-amber-500/50 transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-amber-900/20 cursor-pointer">
            <div class="w-7 h-7 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-300 text-xs font-bold mb-3"><?= htmlspecialchars($service['icon']) ?></div>
            <h4 class="font-medium text-sm text-gray-200"><?= htmlspecialchars($service['title']) ?></h4>
            <p class="text-xs text-gray-400 mt-1 line-clamp-2"><?= htmlspecialchars($service['desc']) ?></p>
            <p class="text-xs font-semibold text-amber-200 mt-3"><?= htmlspecialchars($service['price']) ?></p>
          </div>
          <?php endforeach; ?>

        </div>
      </div>

      <!-- About & Reviews -->
      <div class="space-y-4 pt-2">
        <h3 class="text-lg font-semibold text-gray-200">About the Experience</h3>
        <p class="text-xs text-gray-400 leading-relaxed">
          Experience world-class luxury and deep relaxation. Designed with state-of-the-art ambient lighting, exceptional service, and custom experiences tailored to your comfort.
        </p>

        <!-- Reviews Carousel/Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
          <div class="glass-card p-3.5 rounded-xl border border-gray-800 hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-center space-x-2 mb-2">
              <div class="w-6 h-6 rounded-full bg-gray-700"></div>
              <div>
                <p class="text-xs font-medium text-gray-300">Justine Namer</p>
                <div class="text-amber-300 text-[10px]">★★★★★ 5.0</div>
              </div>
            </div>
            <p class="text-[11px] text-gray-400">Exceptional service and extremely tranquil atmosphere. Highly recommended!</p>
          </div>

          <div class="glass-card p-3.5 rounded-xl border border-gray-800 hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-center space-x-2 mb-2">
              <div class="w-6 h-6 rounded-full bg-gray-700"></div>
              <div>
                <p class="text-xs font-medium text-gray-300">Lisa Rame</p>
                <div class="text-amber-300 text-[10px]">★★★★★ 5.0</div>
              </div>
            </div>
            <p class="text-[11px] text-gray-400">Pure luxury! The facilities are spotless and the staff is very professional.</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Right Sticky Booking Column (35%) -->
    <div class="lg:col-span-4 fade-in-up delay-500">
      <div class="sticky top-6 glass-card rounded-2xl p-5 gold-border space-y-5 glow-pulse transition-transform duration-300 hover:-translate-y-2">
        
        <!-- CTA -->
        <div>
          <button class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-semibold py-3 rounded-xl text-xs tracking-wider transition-all duration-300 shadow-lg shadow-emerald-900/40 hover:shadow-emerald-500/40 hover:scale-105 active:scale-95">
            REQUEST BOOKING
          </button>
          <p class="text-center text-[11px] text-gray-400 mt-2">From <span class="text-amber-200 font-semibold"><?= htmlspecialchars($business['price']) ?></span></p>
        </div>

        <!-- Mini Calendar -->
        <div class="space-y-3 pt-2 border-t border-gray-800">
          <div class="flex justify-between items-center text-xs text-gray-300 font-medium">
            <span>October 2024</span>
            <div class="space-x-1">
              <button class="px-1 text-gray-500 hover:text-white transition-colors">❮</button>
              <button class="px-1 text-gray-300 hover:text-white transition-colors">❯</button>
            </div>
          </div>

          <div class="grid grid-cols-7 gap-1 text-center text-[10px] text-gray-400">
            <span>Su</span><span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span>
            <span class="text-gray-600">29</span><span class="text-gray-600">30</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">1</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">2</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">3</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">4</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">5</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">6</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">7</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">8</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">9</span>
            <span class="bg-amber-400 text-black font-bold rounded-full w-5 h-5 flex items-center justify-center mx-auto shadow-md shadow-amber-400/50 cursor-pointer transform hover:scale-110 transition-transform">10</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">11</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">12</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">13</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">14</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">15</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">16</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">17</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">18</span>
            <span class="hover:text-amber-300 cursor-pointer transition-colors">19</span>
          </div>
        </div>

        <!-- Time Slots -->
        <div class="space-y-2 border-t border-gray-800 pt-3">
          <p class="text-[11px] font-medium text-gray-400">Timeslots</p>
          <div class="grid grid-cols-3 gap-2 text-[10px]">
            <button class="bg-amber-400/20 text-amber-200 border border-amber-400/40 py-1.5 rounded-lg font-medium transition-all duration-300 hover:bg-amber-400/30">10:30 AM</button>
            <button class="glass-card text-gray-300 py-1.5 rounded-lg border border-gray-800 hover:border-gray-600 transition-all duration-300 hover:bg-gray-800">11:00 AM</button>
            <button class="glass-card text-gray-300 py-1.5 rounded-lg border border-gray-800 hover:border-gray-600 transition-all duration-300 hover:bg-gray-800">11:30 AM</button>
            <button class="glass-card text-gray-300 py-1.5 rounded-lg border border-gray-800 hover:border-gray-600 transition-all duration-300 hover:bg-gray-800">1:00 PM</button>
            <button class="glass-card text-gray-300 py-1.5 rounded-lg border border-gray-800 hover:border-gray-600 transition-all duration-300 hover:bg-gray-800">2:30 PM</button>
          </div>
        </div>

        <!-- Location & Contact -->
        <div class="space-y-3 border-t border-gray-800 pt-3 text-[11px] text-gray-400">
          <div class="flex items-center space-x-2">
            <span class="text-amber-300">📍</span>
            <span><?= htmlspecialchars(explode('•', $business['location'])[1] ?? $business['location']) ?></span>
          </div>
          
          <!-- Map Placeholder -->
          <div class="h-20 rounded-lg bg-gray-900 border border-gray-800 relative overflow-hidden flex items-center justify-center group cursor-pointer">
            <div class="absolute inset-0 bg-gradient-to-tr from-gray-900 via-gray-800 to-gray-900 opacity-80 group-hover:scale-105 transition-transform duration-700"></div>
            <span class="relative text-amber-300 text-lg animate-bounce mt-2">📍</span>
          </div>

          <div class="space-y-1 text-[10px] text-gray-400">
            <p class="hover:text-amber-200 cursor-pointer transition-colors">📞 <?= htmlspecialchars($business['phone']) ?></p>
            <p class="hover:text-amber-200 cursor-pointer transition-colors">✉️ <?= htmlspecialchars($business['email']) ?></p>
            <p class="hover:text-amber-200 cursor-pointer transition-colors">🌐 www.website.com</p>
          </div>
        </div>

      </div>
    </div>

  </main>

</body>
</html>
