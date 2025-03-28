document.addEventListener('DOMContentLoaded', function() {
    const productCards = document.querySelectorAll('.product-card');
    const applyFiltersBtn = document.getElementById('apply-filters');
    const resetFiltersBtn = document.getElementById('reset-filters');
    const minPriceInput = document.getElementById('min-price');
    const maxPriceInput = document.getElementById('max-price');
    const minPriceSlider = document.getElementById('price-range-min');
    const maxPriceSlider = document.getElementById('price-range-max');
    const productTypeCheckboxes = document.querySelectorAll('input[name="product-type"]');
    const productGrid = document.querySelector('.product-grid');
    const sliderTrack = document.querySelector('.slider-track');

    // Get the maximum price from all products to set the slider max value
    let maxProductPrice = 0;
    productCards.forEach(card => {
        const price = parsePrice(card.dataset.price);
        maxProductPrice = Math.max(maxProductPrice, price);
    });
    
    // Set slider max value based on highest product price (rounded up to nearest 100)
    const sliderMax = Math.ceil(maxProductPrice / 100) * 100;
    minPriceSlider.max = sliderMax;
    maxPriceSlider.max = sliderMax;
    
    // Initialize slider values
    minPriceSlider.value = 0;
    maxPriceSlider.value = sliderMax;

    // Set placeholders
    minPriceInput.setAttribute('placeholder', '0');
    maxPriceInput.setAttribute('placeholder', sliderMax.toString());

    function updateSliderTrack() {
        if (!sliderTrack) return;
        
        const percent1 = (minPriceSlider.value / sliderMax) * 100;
        const percent2 = (maxPriceSlider.value / sliderMax) * 100;
        
        sliderTrack.style.background = `linear-gradient(to right, 
            #ddd ${percent1}%, 
            #7abb7e ${percent1}%, 
            #7abb7e ${percent2}%, 
            #ddd ${percent2}%)`;
    }

    // Update track initially
    updateSliderTrack();

    // Apply filters when the button is clicked
    if (applyFiltersBtn) {
        applyFiltersBtn.addEventListener('click', applyFilters);
    }

    // Reset filters when reset button is clicked
    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener('click', resetFilters);
    }

    function parsePrice(priceStr) {
        // Remove currency symbol, thousand separators, and convert comma to dot
        return parseFloat(priceStr.replace('€', '').replace(',', '.')) || 0;
    }

    function formatPrice(value) {
        // Format number to have max 2 decimal places and use dot as decimal separator
        return parseFloat(value).toFixed(2);
    }

    // Update inputs and track when sliders change
    if (minPriceSlider) {
        minPriceSlider.addEventListener('input', function() {
            const minValue = parseInt(this.value);
            const maxValue = parseInt(maxPriceSlider.value);
            
            if (minValue > maxValue) {
                this.value = maxValue;
                minPriceInput.value = maxValue.toString();
            } else {
                minPriceInput.value = minValue.toString();
            }
            
            updateSliderTrack();
            applyFilters();
        });
    }

    if (maxPriceSlider) {
        maxPriceSlider.addEventListener('input', function() {
            const maxValue = parseInt(this.value);
            const minValue = parseInt(minPriceSlider.value);
            
            if (maxValue < minValue) {
                this.value = minValue;
                maxPriceInput.value = minValue.toString();
            } else {
                maxPriceInput.value = maxValue.toString();
            }
            
            updateSliderTrack();
            applyFilters();
        });
    }

    function applyFilters() {
        // Get price values, default to min/max possible values if not specified
        const minPrice = minPriceInput.value ? parseFloat(minPriceInput.value) : 0;
        const maxPrice = maxPriceInput.value ? parseFloat(maxPriceInput.value) : sliderMax;
        
        // Update sliders if input values change
        if (minPriceSlider && minPrice !== parseFloat(minPriceSlider.value)) {
            minPriceSlider.value = minPrice;
            updateSliderTrack();
        }
        
        if (maxPriceSlider && maxPrice !== parseFloat(maxPriceSlider.value)) {
            maxPriceSlider.value = maxPrice;
            updateSliderTrack();
        }

        const selectedTypes = Array.from(productTypeCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        let visibleCount = 0;

        productCards.forEach(card => {
            const price = parsePrice(card.dataset.price);
            const type = card.dataset.type;
            
            const matchesPrice = price >= minPrice && price <= maxPrice;
            const matchesType = selectedTypes.length === 0 || selectedTypes.includes(type);

            if (matchesPrice && matchesType) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Remove existing no-products message if it exists
        const existingMessage = document.querySelector('.no-products');
        if (existingMessage) {
            existingMessage.remove();
        }

        // Add no-products message if no products are visible
        if (visibleCount === 0 && productGrid) {
            const message = document.createElement('div');
            message.className = 'no-products';
            message.innerHTML = '<p>No products match your filter criteria.</p>';
            productGrid.appendChild(message);
        }
    }

    function resetFilters() {
        if (minPriceInput) minPriceInput.value = '';
        if (maxPriceInput) maxPriceInput.value = '';
        if (minPriceSlider) minPriceSlider.value = 0;
        if (maxPriceSlider) maxPriceSlider.value = sliderMax;
        
        updateSliderTrack();

        // Uncheck all product type checkboxes
        productTypeCheckboxes.forEach(cb => cb.checked = false);

        // Show all products
        productCards.forEach(card => card.style.display = '');

        // Remove no products message if it exists
        const noProductsMessage = document.querySelector('.no-products');
        if (noProductsMessage) {
            noProductsMessage.remove();
        }
    }

    // Add input validation for price fields
    if (minPriceInput) {
        minPriceInput.addEventListener('focus', function() {
            if (this.value === '') this.value = '0';
        });

        minPriceInput.addEventListener('blur', function() {
            if (this.value === '0' || this.value === '') {
                this.value = '';
            }
        });

        minPriceInput.addEventListener('input', function() {
            // Remove any non-numeric characters except decimal point
            let value = this.value.replace(/[^\d.]/g, '');
            
            // Ensure only one decimal point
            const decimalPoints = value.match(/\./g);
            if (decimalPoints && decimalPoints.length > 1) {
                value = value.replace(/\.(?=.*\.)/g, '');
            }

            // Limit to 2 decimal places
            const parts = value.split('.');
            if (parts[1] && parts[1].length > 2) {
                parts[1] = parts[1].substring(0, 2);
                value = parts.join('.');
            }

            // Prevent empty or invalid values
            if (value === '' || value === '.') value = '0';

            this.value = value;
            
            // Update slider value (rounded to nearest integer)
            if (minPriceSlider) {
                minPriceSlider.value = Math.round(parseFloat(value) || 0);
                updateSliderTrack();
            }
            
            applyFilters();
        });
    }

    if (maxPriceInput) {
        maxPriceInput.addEventListener('focus', function() {
            if (this.value === '') this.value = sliderMax.toString();
        });

        maxPriceInput.addEventListener('blur', function() {
            if (this.value === sliderMax.toString() || this.value === '') {
                this.value = '';
            }
        });

        maxPriceInput.addEventListener('input', function() {
            // Remove any non-numeric characters except decimal point
            let value = this.value.replace(/[^\d.]/g, '');
            
            // Ensure only one decimal point
            const decimalPoints = value.match(/\./g);
            if (decimalPoints && decimalPoints.length > 1) {
                value = value.replace(/\.(?=.*\.)/g, '');
            }

            // Limit to 2 decimal places
            const parts = value.split('.');
            if (parts[1] && parts[1].length > 2) {
                parts[1] = parts[1].substring(0, 2);
                value = parts.join('.');
            }

            // Prevent empty or invalid values
            if (value === '' || value === '.') value = sliderMax.toString();

            this.value = value;
            
            // If min price is set, ensure max price is not lower
            if (minPriceInput.value && parseFloat(this.value) < parseFloat(minPriceInput.value)) {
                this.value = minPriceInput.value;
            }

            // Update slider value (rounded to nearest integer)
            if (maxPriceSlider) {
                maxPriceSlider.value = Math.round(parseFloat(value) || sliderMax);
                updateSliderTrack();
            }

            applyFilters();
        });
    }
});