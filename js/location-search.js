/**
 * BizBranches Location Search Widget
 * Custom state → city hierarchical dropdown (no native <select>)
 * Usage: new BizBranches.LocationSearch(config)
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

  // ─── Helper: position a fixed dropdown below a trigger element ───────────────
  function positionDropdown(dropdown, triggerEl) {
    const rect = triggerEl.getBoundingClientRect();
    dropdown.style.top  = (rect.bottom + 6) + 'px';
    dropdown.style.left = '12px';
    dropdown.style.right = '12px';
  }

  // ─── LocationSearch Class ────────────────────────────────────────────────────
  class LocationSearch {
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
      this.stateOpen = false;
      this.cityOpen  = false;
      this.data   = {};
      this.states = [];
      this.filteredCities = [];
      this.filteredStates = [];

      this._init();
    }

    async _init() {
      this.data   = await loadCitiesData();
      this.states = Object.keys(this.data).sort();
      this._render();
      this._bindEvents();

      if (this.cfg.initialState) {
        this.selectedState = this.cfg.initialState;
        this._updateStateTrigger();
        if (this.cfg.initialCity) {
          this.elements.cityInput.value = this.cfg.initialCity;
          this.selectedCity = this.cfg.initialCity;
        }
      }
    }

    _render() {
      const c = document.getElementById(this.cfg.containerId);
      if (!c) return;
      c.style.position = 'relative';

      // ── State trigger button ──────────────────────────────────────
      const stateTrigger = document.createElement('div');
      stateTrigger.className = 'loc-state-btn';
      stateTrigger.innerHTML = `
        <span class="loc-state-label">All States</span>
        <svg class="loc-state-chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>`;

      // ── State dropdown ────────────────────────────────────────────
      const stateDropdown = document.createElement('div');
      stateDropdown.className = 'loc-dropdown loc-state-dropdown';
      stateDropdown.style.display = 'none';
      // Render state list
      this._renderStateDropdown(stateDropdown);

      // ── City search input ─────────────────────────────────────────
      const cityInput = document.createElement('input');
      cityInput.type = 'text';
      cityInput.placeholder = this.cfg.placeholder;
      cityInput.className = 'loc-city-input ' + (this.cfg.inputClass || '');
      cityInput.autocomplete = 'off';

      // Pin icon
      const icon = document.createElement('span');
      icon.className = 'loc-pin-icon';
      icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>`;

      const inputWrap = document.createElement('div');
      inputWrap.className = 'loc-input-wrap';
      inputWrap.appendChild(icon);
      inputWrap.appendChild(cityInput);

      // ── City dropdown ─────────────────────────────────────────────
      const cityDropdown = document.createElement('div');
      cityDropdown.className = 'loc-dropdown loc-city-dropdown';
      cityDropdown.style.display = 'none';

      // ── Field wrapper ─────────────────────────────────────────────
      const fieldWrap = document.createElement('div');
      fieldWrap.className = 'loc-field-wrap';
      fieldWrap.appendChild(stateTrigger);
      fieldWrap.appendChild(stateDropdown);
      fieldWrap.appendChild(inputWrap);
      fieldWrap.appendChild(cityDropdown);

      c.innerHTML = '';
      c.appendChild(fieldWrap);

      this.elements = { stateTrigger, stateDropdown, cityInput, cityDropdown, fieldWrap, icon };
    }

    _renderStateDropdown(dropdown) {
      const states = this.states;
      let html = `<div class="loc-city-item loc-state-item" data-state="">All States</div>`;
      html += states.map(s =>
        `<div class="loc-city-item loc-state-item" data-state="${s}">${s}</div>`
      ).join('');
      dropdown.innerHTML = html;

      dropdown.querySelectorAll('.loc-state-item').forEach(el => {
        el.addEventListener('mousedown', (e) => {
          e.preventDefault();
          const state = el.dataset.state;
          this.selectedState = state;
          this.selectedCity  = '';
          this.elements.cityInput.value = '';
          this.displayedCount = 20;
          this._updateStateTrigger();
          this._closeStateDropdown();
          if (state) {
            this._openCityDropdown();
          } else {
            this._closeCityDropdown();
          }
          this._emit();
        });
      });
    }

    _updateStateTrigger() {
      const label = this.elements.stateTrigger.querySelector('.loc-state-label');
      if (label) label.textContent = this.selectedState || 'All States';
    }

    _bindEvents() {
      const { stateTrigger, stateDropdown, cityInput, cityDropdown, fieldWrap } = this.elements;

      // State trigger toggle
      stateTrigger.addEventListener('click', (e) => {
        e.stopPropagation();
        if (this.stateOpen) {
          this._closeStateDropdown();
        } else {
          this._closeCityDropdown();
          this._openStateDropdown();
        }
      });

      // City input focus → open city dropdown
      cityInput.addEventListener('focus', () => {
        this._closeStateDropdown();
        this._openCityDropdown();
      });

      cityInput.addEventListener('input', () => {
        this.displayedCount = 20;
        this._renderCityDropdown();
      });

      // Close on outside click
      document.addEventListener('click', (e) => {
        if (!fieldWrap.contains(e.target) &&
            !stateDropdown.contains(e.target) &&
            !cityDropdown.contains(e.target)) {
          this._closeStateDropdown();
          this._closeCityDropdown();
        }
      });
    }

    // ── State dropdown open/close ─────────────────────────────────
    _openStateDropdown() {
      const d = this.elements.stateDropdown;
      d.style.display = 'block';
      this.stateOpen = true;
      if (window.innerWidth < 768) {
        positionDropdown(d, this.elements.stateTrigger);
      }
      this.elements.stateTrigger.querySelector('.loc-state-chevron').style.transform = 'rotate(180deg)';
    }

    _closeStateDropdown() {
      this.elements.stateDropdown.style.display = 'none';
      this.stateOpen = false;
      const chev = this.elements.stateTrigger.querySelector('.loc-state-chevron');
      if (chev) chev.style.transform = '';
    }

    // ── City dropdown open/close ──────────────────────────────────
    _openCityDropdown() {
      this._renderCityDropdown();
      const d = this.elements.cityDropdown;
      d.style.display = 'block';
      this.cityOpen = true;
      if (window.innerWidth < 768) {
        positionDropdown(d, this.elements.cityInput);
      }
    }

    _closeCityDropdown() {
      this.elements.cityDropdown.style.display = 'none';
      this.cityOpen = false;
    }

    _allCities() {
      return Object.values(this.data).flat();
    }

    _renderCityDropdown() {
      const query = this.elements.cityInput.value.trim().toLowerCase();
      const allCities = this.selectedState
        ? (this.data[this.selectedState] || [])
        : this._allCities();

      this.filteredCities = query
        ? allCities.filter(c => c.toLowerCase().includes(query))
        : allCities;

      const shown   = this.filteredCities.slice(0, this.displayedCount);
      const hasMore = this.filteredCities.length > this.displayedCount;

      let html = '';
      if (shown.length === 0) {
        html = `<div class="loc-no-results">No cities found</div>`;
      } else {
        html = shown.map(city =>
          `<div class="loc-city-item" data-city="${city}">${city}</div>`
        ).join('');
        if (hasMore) {
          html += `<div class="loc-see-more">Show more (${this.filteredCities.length - this.displayedCount} remaining)</div>`;
        }
      }

      const d = this.elements.cityDropdown;
      d.innerHTML = html;

      d.querySelectorAll('.loc-city-item').forEach(el => {
        el.addEventListener('mousedown', (e) => {
          e.preventDefault();
          this.selectedCity = el.dataset.city;
          this.elements.cityInput.value = el.dataset.city;
          this._closeCityDropdown();
          this._emit();
        });
      });

      const seeMore = d.querySelector('.loc-see-more');
      if (seeMore) {
        seeMore.addEventListener('mousedown', (e) => {
          e.preventDefault();
          this.displayedCount += 20;
          this._renderCityDropdown();
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

      this.elements.dropdown.querySelector('[data-cat=""]').addEventListener('click', () => {
        this.selectedCategory = '';
        this.selectedSub = '';
        this.elements.input.value = '';
        this._closeDropdown();
        this._renderDropdown();
        this._emit();
      });

      this.elements.dropdown.querySelectorAll('.cat-parent').forEach(el => {
        el.addEventListener('click', (e) => {
          e.stopPropagation();
          const cat = el.dataset.cat;
          this.selectedCategory = (this.selectedCategory === cat) ? '' : cat;
          this.selectedSub = '';
          this._renderDropdown();
          this.elements.input.value = this.selectedCategory;
          this._emit();
        });
      });

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
        if (!this.elements.wrap.contains(e.target) && !this.elements.dropdown.contains(e.target)) {
          this._closeDropdown();
        }
      });
    }

    _openDropdown() {
      this.elements.dropdown.style.display = 'block';
      this.isOpen = true;
      if (window.innerWidth < 768) {
        positionDropdown(this.elements.dropdown, this.elements.input);
      }
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
