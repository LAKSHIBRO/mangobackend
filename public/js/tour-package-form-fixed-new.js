/**
 * Tour Package Form JavaScript
 * Handles all functionality for the tour package creation/editing form
 * Last Updated: June 20, 2025
 */

// Current day counter for itinerary (can be overridden by edit mode)
window.dayCounter = 1;

document.addEventListener('DOMContentLoaded', function() {
    // Count existing itinerary days to set the initial counter value if not already set
    if (!window.dayCounter || window.dayCounter === 1) {
        const itineraryContainer = document.getElementById('itineraryContainer');
        if (itineraryContainer) {
            const existingDays = itineraryContainer.querySelectorAll('.itinerary-item');
            if (existingDays && existingDays.length > 0) {
                window.dayCounter = existingDays.length;
            }
        }
    }

    // Initialize TinyMCE
    if (typeof tinymce !== 'undefined') {
        // Main description editor
        tinymce.init({
            selector: '.tinymce',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            height: 400
        });

        // Initialize itinerary description editors
        initTinyMCEForItinerary();
    }

    // Initialize main featured image preview
    initMainImagePreview();

    // Initialize gallery functionality
    initGalleryFunctionality();

    // Initialize included/excluded items functionality
    initIncludedExcludedItems();

    // Initialize itinerary functionality
    initItineraryFunctionality();
});

/**
 * Initialize TinyMCE for itinerary descriptions
 */
function initTinyMCEForItinerary() {
    if (typeof tinymce !== 'undefined') {
        tinymce.init({
            selector: '.itinerary-description',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            height: 200
        });
    }
}

/**
 * Initialize main featured image preview functionality
 */
function initMainImagePreview() {
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.onchange = function(evt) {
            const [file] = this.files;
            if (file) {
                const preview = document.getElementById('imagePreview');
                if (preview) {
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                }
            }
        };
    }
}

/**
 * Initialize gallery images functionality
 */
function initGalleryFunctionality() {
    const galleryContainer = document.getElementById('galleryImagesContainer');
    const addGalleryImageBtn = document.getElementById('addGalleryImage');

    if (galleryContainer && addGalleryImageBtn) {
        // Setup initial gallery image previews
        setupGalleryImagePreviews();

        // Add new gallery image
        addGalleryImageBtn.addEventListener('click', function() {
            const galleryItems = galleryContainer.querySelectorAll('.gallery-item');
            const lastItem = galleryItems[galleryItems.length - 1];
            const newItem = lastItem.cloneNode(true);

            // Clear input values
            const fileInput = newItem.querySelector('.gallery-image-input');
            if (fileInput) {
                fileInput.value = '';
            }

            const captionInput = newItem.querySelector('input[name="gallery_captions[]"]');
            if (captionInput) {
                captionInput.value = '';
            }

            // Reset preview
            const previewImg = newItem.querySelector('.gallery-preview');
            if (previewImg) {
                previewImg.style.display = 'none';
                previewImg.src = '#';
            }

            // Enable remove button
            const removeBtn = newItem.querySelector('.remove-gallery-item');
            if (removeBtn) {
                removeBtn.disabled = false;
            }

            // Add to container
            galleryContainer.appendChild(newItem);

            // Reinitialize preview functionality for the new item
            setupGalleryImagePreviews();

            // Enable all remove buttons if we have more than one gallery item
            updateGalleryRemoveButtons();
        });

        // Remove gallery image (event delegation)
        galleryContainer.addEventListener('click', function(e) {
            if (e.target.closest('.remove-gallery-item')) {
                const button = e.target.closest('.remove-gallery-item');
                const galleryItem = button.closest('.gallery-item');

                // Only remove if we have more than one gallery item
                const galleryItems = galleryContainer.querySelectorAll('.gallery-item');
                if (galleryItems.length > 1) {
                    galleryItem.remove();
                    updateGalleryRemoveButtons();
                }
            }
        });
    }
}

/**
 * Setup gallery image previews
 */
function setupGalleryImagePreviews() {
    const galleryImageInputs = document.querySelectorAll('.gallery-image-input');

    galleryImageInputs.forEach(function(input) {
        input.onchange = function() {
            const [file] = this.files;
            if (file) {
                const galleryItem = this.closest('.gallery-item');
                const preview = galleryItem.querySelector('.gallery-preview');

                if (preview) {
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                }
            }
        };
    });
}

/**
 * Update gallery remove buttons state
 */
function updateGalleryRemoveButtons() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    const buttons = document.querySelectorAll('.remove-gallery-item');

    buttons.forEach(function(button) {
        button.disabled = galleryItems.length <= 1;
    });
}

/**
 * Initialize included/excluded items functionality
 */
function initIncludedExcludedItems() {
    // Add more included items
    const addIncludedItemBtn = document.getElementById('addIncludedItem');
    if (addIncludedItemBtn) {
        addIncludedItemBtn.addEventListener('click', function() {
            addItem('includedItemsContainer', 'included[]', 'Enter included item', '#f0fff4');
        });
    }

    // Add more excluded items
    const addExcludedItemBtn = document.getElementById('addExcludedItem');
    if (addExcludedItemBtn) {
        addExcludedItemBtn.addEventListener('click', function() {
            addItem('excludedItemsContainer', 'excluded[]', 'Enter excluded item', '#fff0f0');
        });
    }

    // Event delegation for removing included/excluded items
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-item')) {
            const button = e.target.closest('.remove-item');
            const container = button.closest('.input-group').parentElement;
            button.closest('.input-group').remove();

            // If only one item remains, disable its remove button
            if (container && container.children.length === 1) {
                const lastButton = container.querySelector('.remove-item');
                if (lastButton) lastButton.disabled = true;
            }
        }
    });

    // Initialize remove buttons state for included items
    const includedContainer = document.getElementById('includedItemsContainer');
    if (includedContainer) {
        const buttons = includedContainer.querySelectorAll('.remove-item');
        buttons.forEach(btn => btn.disabled = includedContainer.children.length <= 1);
    }

    // Initialize remove buttons state for excluded items
    const excludedContainer = document.getElementById('excludedItemsContainer');
    if (excludedContainer) {
        const buttons = excludedContainer.querySelectorAll('.remove-item');
        buttons.forEach(btn => btn.disabled = excludedContainer.children.length <= 1);
    }
}

/**
 * Initialize itinerary functionality
 */
function initItineraryFunctionality() {
    // Add itinerary day button
    const addItineraryDayBtn = document.getElementById('addItineraryDay');
    if (addItineraryDayBtn) {
        addItineraryDayBtn.addEventListener('click', addItineraryDay);
    }

    // Event delegation for removing itinerary days
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-itinerary')) {
            removeItineraryDay(e.target.closest('.remove-itinerary'));
        }
    });

    // Initialize remove buttons state for itinerary days
    const itineraryContainer = document.getElementById('itineraryContainer');
    if (itineraryContainer) {
        const buttons = itineraryContainer.querySelectorAll('.remove-itinerary');
        buttons.forEach(btn => btn.disabled = itineraryContainer.children.length <= 1);
    }
}

/**
 * Add a new item to a container (for included/excluded items)
 */
function addItem(containerId, inputName, placeholder, highlightColor) {
    const container = document.getElementById(containerId);
    if (!container) return;

    const newItem = document.createElement('div');
    newItem.classList.add('input-group', 'mb-3');

    newItem.innerHTML = `
        <input type="text" class="form-control" name="${inputName}" placeholder="${placeholder}" required>
        <button class="btn btn-danger remove-item" type="button">
            <i class="fi fi-rr-trash"></i>
        </button>
    `;

    // Add highlight effect if color is provided
    if (highlightColor) {
        newItem.style.backgroundColor = highlightColor;
        newItem.style.transition = 'background-color 1.5s';
        setTimeout(() => {
            newItem.style.backgroundColor = 'transparent';
        }, 500);
    }

    container.appendChild(newItem);

    // Enable all remove buttons if there's more than one item
    if (container.children.length > 1) {
        const buttons = container.querySelectorAll('.remove-item');
        buttons.forEach(btn => btn.disabled = false);
    }

    // Focus on the new input field
    const inputField = newItem.querySelector('input');
    if (inputField) {
        inputField.focus();
    }
}

/**
 * Add a new itinerary day
 */
function addItineraryDay() {
    // Increment the day counter
    window.dayCounter++;
    const container = document.getElementById('itineraryContainer');
    if (!container) return;

    const newDay = document.createElement('div');
    newDay.classList.add('itinerary-item', 'card', 'mb-4');

    newDay.innerHTML = `
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fi fi-rr-calendar-day me-2"></i> Day ${window.dayCounter}</h5>
            <button type="button" class="btn btn-sm btn-danger remove-itinerary">
                <i class="fi fi-rr-trash"></i> Remove
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <input type="hidden" name="itinerary[${window.dayCounter-1}][day]" value="${window.dayCounter}" class="day-number">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="itinerary[${window.dayCounter-1}][title]" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Location <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="itinerary[${window.dayCounter-1}][location]" required>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea id="itinerary-description-${window.dayCounter}" class="form-control itinerary-description" name="itinerary[${window.dayCounter-1}][description]" rows="4" required></textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">Image (Optional)</label>
                    <input type="file" class="form-control itinerary-image" name="itinerary[${window.dayCounter-1}][image]" accept="image/*">
                </div>
            </div>
        </div>
    `;

    container.appendChild(newDay);

    // Enable all remove buttons
    const buttons = container.querySelectorAll('.remove-itinerary');
    buttons.forEach(btn => btn.disabled = false);

    // Initialize TinyMCE for the new textarea
    setTimeout(function() {
        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                selector: `#itinerary-description-${window.dayCounter}`,
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                height: 200
            });
        }
    }, 100);
}

/**
 * Remove an itinerary day
 */
function removeItineraryDay(button) {
    const container = document.getElementById('itineraryContainer');
    if (!container) return;

    const itineraryItem = button.closest('.itinerary-item');

    // Destroy TinyMCE instance if it exists
    const textarea = itineraryItem.querySelector('.itinerary-description');
    if (textarea && textarea.id && typeof tinymce !== 'undefined' && tinymce.get(textarea.id)) {
        tinymce.get(textarea.id).remove();
    }

    // Remove the item
    itineraryItem.remove();

    // If only one day remains, disable its remove button
    if (container.children.length === 1) {
        const lastButton = container.querySelector('.remove-itinerary');
        if (lastButton) lastButton.disabled = true;
    }

    // Renumber the days
    renumberItineraryDays(container);
}

/**
 * Renumber itinerary days after removing a day
 */
function renumberItineraryDays(container) {
    if (!container) return;

    const days = container.querySelectorAll('.itinerary-item');

    days.forEach((day, index) => {
        const dayNumber = index + 1;
        // Update heading
        const heading = day.querySelector('h5');
        if (heading) {
            heading.innerHTML = `<i class="fi fi-rr-calendar-day me-2"></i> Day ${dayNumber}`;
        }

        // Update hidden day value
        const dayInput = day.querySelector('.day-number');
        if (dayInput) {
            dayInput.value = dayNumber;
        }

        // Update the name attributes to maintain the correct array indexing
        day.querySelectorAll('input, textarea').forEach(input => {
            if (input.name && input.name.includes('itinerary[')) {
                input.name = input.name.replace(/itinerary\[\d+\]/, `itinerary[${index}]`);
            }
        });
    });

    // Update the day counter
    window.dayCounter = days.length;
}

/**
 * Function to initialize edit mode specific functionality
 * This will be called when editing an existing tour package
 */
function initTourPackageEditMode() {
    console.log('Tour Package Edit Mode initialized');

    // Add event listeners for the delete gallery image toggles
    document.querySelectorAll('.delete-gallery-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const card = this.closest('.card');
            const statusText = card.querySelector('.image-status');

            if (statusText) {
                if (this.checked) {
                    statusText.textContent = 'Image will be deleted';
                    statusText.classList.add('text-danger');
                    card.classList.add('opacity-50');
                } else {
                    statusText.textContent = 'Image will be kept';
                    statusText.classList.remove('text-danger');
                    card.classList.remove('opacity-50');
                }
            }
        });
    });
}
