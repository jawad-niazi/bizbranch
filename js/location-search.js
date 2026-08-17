/**
 * BizBranches Location Search Widget
 * Provides state → city hierarchical dropdown + search-as-you-type with pagination
 * Usage: new LocationSearch(config)
 */
(function (window) {
  'use strict';

  // ─── Data ────────────────────────────────────────────────────────────────────
  let _citiesData = null;

  async function loadCitiesData() {
    if (_citiesData) return _citiesData;
    try {
      const res = await fetch('/data/us_cities.json');
      _citiesData = await res.json();
    } catch (e) {
      _citiesData = {};
    }
    return _citiesData;
  }

  // ─── LocationSearch Class ─────────────────────────────────────────────────────
  class LocationSearch {
    /**
     * @param {Object} config
     * @param {string} config.containerId   - ID of the wrapper <div>
     * @param {string} [config.placeholder] - Input placeholder text
     * @param {function} [config.onChange]  - Callback(selectedCity, selectedState)
     * @param {string} [config.inputClass]  - Extra classes for the text input
     * @param {string} [config.initialState]  - Pre-selected state
     * @param {string} [config.initialCity]   - Pre-selected city
     */
    constructor(config) {
      this.cfg = Object.assign({
        placeholder: 'All Cities',
        onChange: null,
        inputClass: '',
        initialState: '',
        initialCity: ''
      }, config);

      this.selectedState = this.cfg.initialState;
      this.selectedCity  = this.cfg.initialCity;
      this.displayedCount = 20;
      this.isOpen = false;
      this.data = {};
      this.filteredCities = [];

      this._init();
    }

    async _init() {
      this.data = await loadCitiesData();
      this.states = Object.keys(this.data).sort();
      this._render();
      this._bindEvents();

      // Restore pre-selected values
      if (this.cfg.initialState) {
        this.elements.stateSelect.value = this.cfg.initialState;
        this._onStateChange();
        if (this.cfg.initialCity) {
          this.elements.input.value = this.cfg.initialCity;
          this.selectedCity = this.cfg.initialCity;
        }
      }
    }

    _render() {
      const c = document.getElementById(this.cfg.containerId);
      if (!c) return;
      c.style.position = 'relative';

      // State select
      const stateSelect = document.createElement('select');
      stateSelect.className = 'loc-state-select';
      stateSelect.innerHTML = `<option value="">All States</option>` +
        this.states.map(s => `<option value="${s}">${s}</option>`).join('');

      // City search input
      const input = document.createElement('input');
      input.type = 'text';
      input.placeholder = this.cfg.placeholder;
      input.className = 'loc-city-input ' + (this.cfg.inputClass || '');
      input.autocomplete = 'off';

      // Pin icon
      const icon = document.createElement('span');
      icon.className = 'loc-pin-icon';
      icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>`;

      // Dropdown panel
      const dropdown = document.createElement('div');
      dropdown.className = 'loc-dropdown';
      dropdown.style.display = 'none';

      const inputWrap = document.createElement('div');
      inputWrap.className = 'loc-input-wrap';
      inputWrap.appendChild(icon);
      inputWrap.appendChild(input);

      const fieldWrap = document.createElement('div');
      fieldWrap.className = 'loc-field-wrap';
      fieldWrap.appendChild(stateSelect);
      fieldWrap.appendChild(inputWrap);
      fieldWrap.appendChild(dropdown);

      c.innerHTML = '';
      c.appendChild(fieldWrap);

      this.elements = { stateSelect, input, dropdown, fieldWrap };
    }

    _bindEvents() {
      const { stateSelect, input, dropdown } = this.elements;

      stateSelect.addEventListener('change', () => this._onStateChange());
      input.addEventListener('focus', () => this._openDropdown());
      input.addEventListener('input', () => {
        this.displayedCount = 20;
        this._renderDropdown();
      });

      // Close on outside click
      document.addEventListener('click', (e) => {
        if (!this.elements.fieldWrap.contains(e.target)) {
          this._closeDropdown();
        }
      });
    }

    _onStateChange() {
      const state = this.elements.stateSelect.value;
      this.selectedState = state;
      this.selectedCity = '';
      this.elements.input.value = '';
      this.displayedCount = 20;
      this.filteredCities = state ? (this.data[state] || []) : [];
      if (state) {
        this._openDropdown();
      } else {
        this._closeDropdown();
      }
      this._emit();
    }

    _openDropdown() {
      const state = this.selectedState;
      this.filteredCities = state ? (this.data[state] || []) : this._allCities();
      this._renderDropdown();
      this.elements.dropdown.style.display = 'block';
      this.isOpen = true;
    }

    _closeDropdown() {
      this.elements.dropdown.style.display = 'none';
      this.isOpen = false;
    }

    _allCities() {
      return Object.values(this.data).flat();
    }

    _renderDropdown() {
      const query = this.elements.input.value.trim().toLowerCase();
      const allCities = this.selectedState
        ? (this.data[this.selectedState] || [])
        : this._allCities();

      this.filteredCities = query
        ? allCities.filter(c => c.toLowerCase().includes(query))
        : allCities;

      const shown = this.filteredCities.slice(0, this.displayedCount);
      const hasMore = this.filteredCities.length > this.displayedCount;

      let html = '';
      if (shown.length === 0) {
        html = `<div class="loc-no-results">No cities found</div>`;
      } else {
        html = shown.map(city =>
          `<div class="loc-city-item" data-city="${city}">${city}</div>`
        ).join('');
        if (hasMore) {
          html += `<div class="loc-see-more">Show more cities (${this.filteredCities.length - this.displayedCount} remaining)</div>`;
        }
      }

      this.elements.dropdown.innerHTML = html;

      // City item click
      this.elements.dropdown.querySelectorAll('.loc-city-item').forEach(el => {
        el.addEventListener('click', () => {
          this.selectedCity = el.dataset.city;
          this.elements.input.value = el.dataset.city;
          this._closeDropdown();
          this._emit();
        });
      });

      // See more
      const seeMore = this.elements.dropdown.querySelector('.loc-see-more');
      if (seeMore) {
        seeMore.addEventListener('click', () => {
          this.displayedCount += 20;
          this._renderDropdown();
        });
      }
    }

    _emit() {
      if (typeof this.cfg.onChange === 'function') {
        this.cfg.onChange(this.selectedCity, this.selectedState);
      }
    }

    getValue() {
      return { city: this.selectedCity, state: this.selectedState };
    }
  }

  // ─── CategorySearch Class ─────────────────────────────────────────────────────
  class CategorySearch {
    /**
     * @param {Object} config
     * @param {string} config.containerId
     * @param {Object} config.categoriesData  - { 'Category': ['sub1','sub2'] }
     * @param {function} [config.onChange]    - Callback(category, subcategory)
     * @param {string} [config.placeholder]
     * @param {string} [config.inputClass]
     */
    constructor(config) {
      this.cfg = Object.assign({
        placeholder: 'Category',
        onChange: null,
        inputClass: '',
        categoriesData: {}
      }, config);

      this.selectedCategory = '';
      this.selectedSub = '';
      this.isOpen = false;
      this._render();
      this._bindEvents();
    }

    _render() {
      const c = document.getElementById(this.cfg.containerId);
      if (!c) return;
      c.style.position = 'relative';

      const input = document.createElement('input');
      input.type = 'text';
      input.readOnly = true;
      input.placeholder = this.cfg.placeholder;
      input.className = 'cat-input ' + (this.cfg.inputClass || '');
      input.autocomplete = 'off';

      const chevron = document.createElement('span');
      chevron.className = 'cat-chevron';
      chevron.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>`;

      const dropdown = document.createElement('div');
      dropdown.className = 'cat-dropdown';
      dropdown.style.display = 'none';

      const wrap = document.createElement('div');
      wrap.className = 'cat-wrap';
      wrap.appendChild(input);
      wrap.appendChild(chevron);
      wrap.appendChild(dropdown);

      c.innerHTML = '';
      c.appendChild(wrap);
      this.elements = { input, dropdown, wrap };

      this._renderDropdown();
    }

    _renderDropdown() {
      const cats = Object.keys(this.cfg.categoriesData);
      let html = `<div class="cat-item ${!this.selectedCategory ? 'active' : ''}" data-cat="">All Categories</div>`;
      cats.forEach(cat => {
        const subs = this.cfg.categoriesData[cat];
        html += `<div class="cat-group">
          <div class="cat-item cat-parent ${this.selectedCategory === cat ? 'active' : ''}" data-cat="${cat}">${cat}</div>
          <div class="cat-subs ${this.selectedCategory === cat ? 'open' : ''}">
            ${subs.map(sub => `<div class="cat-sub-item ${this.selectedSub === sub ? 'active' : ''}" data-cat="${cat}" data-sub="${sub}">${sub}</div>`).join('')}
          </div>
        </div>`;
      });
      this.elements.dropdown.innerHTML = html;

      // All categories
      this.elements.dropdown.querySelector('[data-cat=""]').addEventListener('click', () => {
        this.selectedCategory = '';
        this.selectedSub = '';
        this.elements.input.value = '';
        this._closeDropdown();
        this._renderDropdown();
        this._emit();
      });

      // Parent category clicks
      this.elements.dropdown.querySelectorAll('.cat-parent').forEach(el => {
        el.addEventListener('click', (e) => {
          e.stopPropagation();
          const cat = el.dataset.cat;
          if (this.selectedCategory === cat) {
            this.selectedCategory = '';
          } else {
            this.selectedCategory = cat;
            this.selectedSub = '';
          }
          this._renderDropdown();
          this.elements.input.value = this.selectedCategory;
          this._emit();
        });
      });

      // Subcategory clicks
      this.elements.dropdown.querySelectorAll('.cat-sub-item').forEach(el => {
        el.addEventListener('click', (e) => {
          e.stopPropagation();
          this.selectedCategory = el.dataset.cat;
          this.selectedSub = el.dataset.sub;
          this.elements.input.value = `${el.dataset.cat} › ${el.dataset.sub}`;
          this._closeDropdown();
          this._emit();
        });
      });
    }

    _bindEvents() {
      this.elements.input.addEventListener('click', () => {
        this.isOpen ? this._closeDropdown() : this._openDropdown();
      });
      this.elements.wrap.querySelector('.cat-chevron').addEventListener('click', () => {
        this.isOpen ? this._closeDropdown() : this._openDropdown();
      });
      document.addEventListener('click', (e) => {
        if (!this.elements.wrap.contains(e.target)) this._closeDropdown();
      });
    }

    _openDropdown() {
      this.elements.dropdown.style.display = 'block';
      this.isOpen = true;
    }

    _closeDropdown() {
      this.elements.dropdown.style.display = 'none';
      this.isOpen = false;
    }

    _emit() {
      if (typeof this.cfg.onChange === 'function') {
        this.cfg.onChange(this.selectedCategory, this.selectedSub);
      }
    }

    getValue() {
      return { category: this.selectedCategory, subcategory: this.selectedSub };
    }
  }

  window.BizBranches = window.BizBranches || {};
  window.BizBranches.LocationSearch = LocationSearch;
  window.BizBranches.CategorySearch = CategorySearch;

})(window);
