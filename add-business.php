<?php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data_file = 'data/businesses.json';
    $businesses = [];
    if (file_exists($data_file)) {
        $businesses = json_decode(file_get_contents($data_file), true) ?? [];
    }
    
    $logo_path = '';
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $logo_name = time() . '_' . basename($_FILES['logo']['name']);
        $target = 'uploads/' . $logo_name;
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $target)) {
            $logo_path = $target;
        }
    }
    
    $owner_photo_path = '';
    if (isset($_FILES['owner_photo']) && $_FILES['owner_photo']['error'] === UPLOAD_ERR_OK) {
        $photo_name = time() . '_owner_' . basename($_FILES['owner_photo']['name']);
        $target = 'uploads/' . $photo_name;
        if (move_uploaded_file($_FILES['owner_photo']['tmp_name'], $target)) {
            $owner_photo_path = $target;
        }
    }
    
    $new_business = [
        'name' => $_POST['business_name'] ?? '',
        'location' => $_POST['full_address'] ?? '',
        'city' => $_POST['city'] ?? '',
        'category' => $_POST['category'] ?? '',
        'subcategory' => $_POST['subcategory'] ?? '',
        'rating' => '5.0',
        'reviews_count' => '0',
        'logo' => $logo_path,
        'phone' => $_POST['phone'] ?? '',
        'whatsapp' => $_POST['whatsapp'] ?? '',
        'email' => $_POST['email'] ?? '',
        'website' => $_POST['website'] ?? '',
        'facebook' => $_POST['facebook'] ?? '',
        'instagram' => $_POST['instagram'] ?? '',
        'twitter' => $_POST['twitter'] ?? '',
        'contact_person' => $_POST['contact_person'] ?? '',
        'owner' => [
            'name' => $_POST['owner_name'] ?? '',
            'designation' => $_POST['owner_role'] ?? '',
            'photo' => $owner_photo_path,
            'intro' => $_POST['owner_quote'] ?? '',
            'location' => $_POST['owner_location'] ?? ''
        ],
        'about_text' => $_POST['description'] ?? '',
        'reviews' => []
    ];
    
    $businesses[] = $new_business;
    file_put_contents($data_file, json_encode($businesses, JSON_PRETTY_PRINT));
    
    header('Location: index.php');
    exit;
}
?>
<?php include 'components/header.php'; ?>
<style>
  .card-white { background: #FFFFFF; border: 1px solid #E2E8F0; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
  .input-field {
    width: 100%;
    padding: 0.625rem 0.875rem;
    border-radius: 0.75rem;
    border: 1px solid #CBD5E1;
    background-color: #FFFFFF;
    font-size: 0.8125rem;
    color: #0F172A;
    transition: all 0.2s ease;
  }
  .input-field:focus {
    outline: none;
    border-color: #368997;
    box-shadow: 0 0 0 3px rgba(54, 137, 151, 0.1);
  }
  .label-title { font-size: 0.75rem; font-weight: 700; color: #334155; margin-bottom: 0.375rem; display: block; }
</style>

<div class="max-w-3xl mx-auto px-4 sm:px-6 py-10 w-full">
    
    <div class="mb-8 space-y-2">
      <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Add Your Business Free</h1>
      <p class="text-xs text-slate-500">US free business listing directory. Get visibility in minutes.</p>
      
      <div class="flex items-center gap-3 pt-3">
        <span class="text-xs font-bold text-blue-600">13% complete</span>
        <div class="w-48 bg-slate-200 h-2 rounded-full overflow-hidden">
          <div class="bg-blue-600 h-full w-[13%] rounded-full"></div>
        </div>
      </div>
    </div>

    <!-- DIRECT POST TO add-business.php -->
    <form action="add-business.php" method="POST" enctype="multipart/form-data" class="card-white rounded-3xl p-6 md:p-8 space-y-8">

      <!-- SECTION 1: BUSINESS & CONTACT -->
      <div class="space-y-4">
        <div class="flex items-center space-x-2 border-b border-slate-100 pb-3">
          <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4m-4 0H7"></path></svg>
          <h2 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">BUSINESS & CONTACT</h2>
        </div>

        <div>
          <label class="label-title">Business name <span class="text-rose-500">*</span></label>
          <input type="text" name="business_name" required placeholder="e.g. Aura Elite Wellness & Spa" class="input-field" />
          <span class="text-[10px] text-slate-400 mt-1 block">Official name as on documents</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="label-title">Contact person</label>
            <input type="text" name="contact_person" placeholder="Name" class="input-field" />
          </div>
          <div>
            <label class="label-title">Email</label>
            <input type="email" name="email" placeholder="business@example.com" class="input-field" />
          </div>
        </div>
      </div>

      <!-- SECTION 2: PHONE -->
      <div class="space-y-4">
        <div class="flex items-center space-x-2 border-b border-slate-100 pb-3">
          <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
          <h2 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">PHONE</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="label-title">Phone <span class="text-rose-500">*</span></label>
            <input type="text" name="phone" required placeholder="+1 (555) 123-4567" class="input-field" />
          </div>
          <div>
            <label class="label-title">WhatsApp <span class="text-slate-400 font-normal">(optional)</span></label>
            <input type="text" name="whatsapp" placeholder="+1 (555) 123-4567" class="input-field" />
          </div>
        </div>
      </div>

      <!-- SECTION 3: LOCATION & CATEGORY -->
      <div class="space-y-4">
        <div class="flex items-center space-x-2 border-b border-slate-100 pb-3">
          <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
          <h2 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">LOCATION & CATEGORY</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div>
            <label class="label-title">City <span class="text-rose-500">*</span></label>
            <input type="text" name="city" required placeholder="e.g. London" class="input-field" />
          </div>
          <div>
            <label class="label-title">Category <span class="text-rose-500">*</span></label>
            <select name="category" id="category" required class="input-field">
              <option value="">Select Category</option>
              <?php foreach(array_keys($categories_tree) as $cat): ?>
                <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label class="label-title">Subcategory</label>
            <select name="subcategory" id="subcategory" class="input-field disabled:bg-slate-50 disabled:text-slate-400" disabled>
              <option value="">Select Subcategory</option>
            </select>
          </div>
        </div>

        <div>
          <label class="label-title">Full address <span class="text-rose-500">*</span></label>
          <input type="text" name="full_address" required placeholder="74 Pall Mall, Mayfair, London SW1Y 5ES, UK" class="input-field" />
        </div>
      </div>

      <!-- SECTION 4: DESCRIPTION & LOGO -->
      <div class="space-y-4">
        <div class="flex items-center space-x-2 border-b border-slate-100 pb-3">
          <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
          <h2 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">DESCRIPTION & LOGO</h2>
        </div>

        <div>
          <label class="label-title">Description <span class="text-rose-500">*</span></label>
          <textarea name="description" required rows="4" placeholder="What you do, services, what makes you unique..." class="input-field resize-none"></textarea>
        </div>

        <div>
          <label class="label-title">Logo <span class="text-rose-500">*</span></label>
          <input type="file" name="logo" required class="input-field bg-slate-50 cursor-pointer text-xs" />
        </div>
      </div>

      <!-- SECTION 5: LINKS (OPTIONAL) -->
      <div class="space-y-4">
        <div class="flex items-center space-x-2 border-b border-slate-100 pb-3">
          <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
          <h2 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">LINKS <span class="text-slate-400 font-normal lowercase">(optional)</span></h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="label-title">Website</label>
            <input type="url" name="website" placeholder="https://example.com" class="input-field" />
          </div>
          <div>
            <label class="label-title">Facebook</label>
            <input type="url" name="facebook" placeholder="https://facebook.com/..." class="input-field" />
          </div>
          <div>
            <label class="label-title">Instagram</label>
            <input type="url" name="instagram" placeholder="https://instagram.com/..." class="input-field" />
          </div>
          <div>
            <label class="label-title">Twitter / X</label>
            <input type="url" name="twitter" placeholder="https://x.com/..." class="input-field" />
          </div>
        </div>
      </div>

      <!-- SECTION 6: BUSINESS OWNER PROFILE (OPTIONAL) -->
      <div class="space-y-4 pt-2 border-t border-slate-100">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
          <div class="flex items-center space-x-2">
            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            <h2 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">BUSINESS OWNER PROFILE</h2>
          </div>
          <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-md">Optional</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="label-title">Owner full name <span class="text-slate-400 font-normal">(optional)</span></label>
            <input type="text" name="owner_name" placeholder="e.g. Eleanor Vance" class="input-field" />
          </div>
          <div>
            <label class="label-title">Role / Designation <span class="text-slate-400 font-normal">(optional)</span></label>
            <input type="text" name="owner_role" placeholder="e.g. Founder & Master Therapist" class="input-field" />
          </div>
        </div>

        <div>
          <label class="label-title">Owner origin / Location <span class="text-slate-400 font-normal">(optional)</span></label>
          <input type="text" name="owner_location" placeholder="e.g. From London, UK" class="input-field" />
        </div>

        <div>
          <label class="label-title">Owner short quote <span class="text-slate-400 font-normal">(optional)</span></label>
          <textarea name="owner_quote" rows="2" placeholder="e.g. My vision was to create a sanctuary where modern luxury meets holistic wellness." class="input-field resize-none"></textarea>
        </div>

        <div>
          <label class="label-title">Owner profile photo <span class="text-slate-400 font-normal">(optional)</span></label>
          <input type="file" name="owner_photo" class="input-field bg-slate-50 cursor-pointer text-xs" />
        </div>
      </div>

      <!-- SUBMIT BUTTON -->
      <div class="pt-4 text-center space-y-2">
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-6 rounded-2xl text-xs tracking-wider transition shadow-lg shadow-blue-600/20">
          Submit Business
        </button>
      </div>

    </form>
  </main>

  <?php include 'components/footer.php'; ?>

  <script>
    const categoriesTree = <?= json_encode($categories_tree) ?>;
    const categorySelect = document.getElementById('category');
    const subcategorySelect = document.getElementById('subcategory');

    categorySelect.addEventListener('change', function() {
      const selectedCat = this.value;
      subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
      
      if (selectedCat && categoriesTree[selectedCat]) {
        categoriesTree[selectedCat].forEach(sub => {
          const opt = document.createElement('option');
          opt.value = sub;
          opt.textContent = sub;
          subcategorySelect.appendChild(opt);
        });
        subcategorySelect.disabled = false;
      } else {
        subcategorySelect.disabled = true;
      }
    });
  </script>
</body>
</html>
