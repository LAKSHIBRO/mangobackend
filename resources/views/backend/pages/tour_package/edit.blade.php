@extends('backend.app')

@section('content')
<div class="page-header">
    <h1 class="page-title my-auto">Edit Tour Package</h1>
    <div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/admin/dashboard">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/admin/tour-packages">Tour Packages</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <form action="/admin/update-tour-package/{{ $tourPackage->id }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title">Basic Information</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Package Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $tourPackage->name) }}" required>
                            @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label">Package Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="">Select Package Type</option>
                                <option value="tailor-made" {{ old('type', $tourPackage->type) == 'tailor-made' ? 'selected' : '' }}>Tailor Made</option>
                                <option value="round-tour" {{ old('type', $tourPackage->type) == 'round-tour' ? 'selected' : '' }}>Round Tour</option>
                            </select>
                            @error('type')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Price ($) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $tourPackage->price) }}" step="0.01" min="0" required>
                            @error('price')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="duration" class="form-label">Duration <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="duration" name="duration" value="{{ old('duration', $tourPackage->duration) }}" required placeholder="e.g. 7 Days / 6 Nights">
                            @error('duration')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="peoples" class="form-label">Maximum People</label>
                            <input type="number" class="form-control" id="peoples" name="peoples" value="{{ old('peoples', $tourPackage->peoples) }}" placeholder="Maximum number of people" min="1">
                            @error('peoples')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="locations" class="form-label">Locations <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="locations" name="locations" value="{{ old('locations', $tourPackage->locations) }}" required placeholder="e.g. Kandy, Galle, Colombo">
                            @error('locations')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3 d-flex">
                            <div class="form-check me-4">
                                <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1" {{ old('featured', $tourPackage->featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="featured">
                                    Featured
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="active" name="active" value="1" {{ old('active', $tourPackage->active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="active">
                                    Active
                                </label>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="short_description" class="form-label">Short Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="short_description" name="short_description" rows="3" required>{{ old('short_description', $tourPackage->short_description) }}</textarea>
                            @error('short_description')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">Full Description <span class="text-danger">*</span></label>
                            <textarea class="form-control tinymce" id="description" name="description" rows="6">{{ old('description', $tourPackage->description) }}</textarea>
                            @error('description')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="image" class="form-label">Featured Image</label>
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $tourPackage->image) }}" alt="{{ $tourPackage->name }}" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <small class="form-text text-muted">Leave empty to keep the current image.</small>
                            @error('image')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Gallery Images</div>
                    <button type="button" class="btn btn-sm btn-success" id="addGalleryImage">
                        <i class="fi fi-rr-add"></i> Add Image
                    </button>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-3">
                        <i class="fi fi-rr-info-circle me-2"></i>
                        Add or manage multiple images for the tour package gallery. These will be displayed in a slider on the detailed view of the tour.
                    </div>

                    @error('gallery_images')
                    <div class="alert alert-danger py-2 mb-3">{{ $message }}</div>
                    @enderror
                    @error('gallery_images.*')
                    <div class="alert alert-danger py-2 mb-3">{{ $message }}</div>
                    @enderror

                    <!-- Existing Gallery Images -->
                    @if($tourPackage->galleryImages && $tourPackage->galleryImages->count() > 0)
                        <div class="mb-4">
                            <h5 class="mb-3">Current Gallery Images</h5>
                            <div class="row">
                                @foreach($tourPackage->galleryImages as $galleryImage)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100">
                                            <div class="position-relative">
                                                <img src="{{ asset('storage/' . $galleryImage->image_path) }}" class="card-img-top" alt="Gallery Image" style="height: 150px; object-fit: cover;">
                                                <div class="position-absolute top-0 end-0 p-2">
                                                    <div class="form-check form-switch bg-white rounded-pill shadow-sm px-2">
                                                        <input class="form-check-input delete-gallery-toggle" type="checkbox" name="delete_gallery_images[]" value="{{ $galleryImage->id }}" id="delete-gallery-{{ $galleryImage->id }}">
                                                        <label class="form-check-label small" for="delete-gallery-{{ $galleryImage->id }}">Delete</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="card-title fw-bold">Caption</h6>
                                                <input type="text" class="form-control form-control-sm" name="gallery_caption_updates[{{ $galleryImage->id }}]" value="{{ $galleryImage->caption ?? '' }}" placeholder="Enter image caption">
                                            </div>
                                            <div class="card-footer bg-light p-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted image-status">Image will be kept</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- New Gallery Images -->
                    <h5 class="mb-3">Add New Gallery Images</h5>
                    <div id="galleryImagesContainer" class="row">
                        <div class="col-md-4 gallery-item mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Gallery Image</label>
                                        <input type="file" class="form-control gallery-image-input" name="gallery_images[]" accept="image/*">
                                        <div class="form-text">Recommended size: 1200px x 800px</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Caption (Optional)</label>
                                        <input type="text" class="form-control" name="gallery_captions[]" placeholder="Enter image caption">
                                    </div>
                                    <div class="text-center mt-3">
                                        <img class="gallery-preview" src="#" alt="Preview" style="max-width: 100%; max-height: 150px; display: none;">
                                    </div>
                                </div>
                                <div class="card-footer p-2">
                                    <button type="button" class="btn btn-sm btn-danger w-100 remove-gallery-item" disabled>
                                        <i class="fi fi-rr-trash"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Included & Excluded Items</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Included Items</h4>
                            <div id="includedItemsContainer">
                                @foreach($tourPackage->included as $index => $item)
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="included[]" value="{{ $item }}" placeholder="Enter included item" required>
                                    <button class="btn btn-danger remove-item" type="button" {{ count($tourPackage->included) === 1 ? 'disabled' : '' }}>
                                        <i class="fi fi-rr-trash"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success btn-sm" id="addIncludedItem">
                                <i class="fi fi-rr-add"></i> Add Item
                            </button>
                        </div>

                        <div class="col-md-6">
                            <h4>Excluded Items</h4>
                            <div id="excludedItemsContainer">
                                @foreach($tourPackage->excluded as $index => $item)
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="excluded[]" value="{{ $item }}" placeholder="Enter excluded item" required>
                                    <button class="btn btn-danger remove-item" type="button" {{ count($tourPackage->excluded) === 1 ? 'disabled' : '' }}>
                                        <i class="fi fi-rr-trash"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success btn-sm" id="addExcludedItem">
                                <i class="fi fi-rr-add"></i> Add Item
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">Itinerary</div>
                </div>
                <div class="card-body">
                    <div id="itineraryContainer">
                        @foreach($tourPackage->itinerary as $index => $day)
                        <div class="itinerary-item card mb-4">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Day {{ $day->day }}</h5>
                                <button type="button" class="btn btn-sm btn-danger remove-itinerary" {{ count($tourPackage->itinerary) === 1 ? 'disabled' : '' }}>
                                    <i class="fi fi-rr-trash"></i> Remove
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="itinerary[{{$index}}][id]" value="{{ $day->id }}">
                                    <input type="hidden" name="itinerary[{{$index}}][day]" value="{{ $day->day }}" class="day-number">

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="itinerary[{{$index}}][title]" value="{{ $day->title }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Location <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="itinerary[{{$index}}][location]" value="{{ $day->location }}" required>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control itinerary-description" name="itinerary[{{$index}}][description]" rows="4" required>{{ $day->description }}</textarea>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Image</label>
                                        @if($day->image)
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $day->image) }}" alt="Day {{ $day->day }}" class="img-thumbnail" style="max-height: 150px;">
                                        </div>
                                        @endif
                                        <input type="file" class="form-control itinerary-image" name="itinerary[{{$index}}][image]" accept="image/*">
                                        <small class="form-text text-muted">Leave empty to keep the current image.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn btn-success" id="addItineraryDay">
                        <i class="fi fi-rr-add"></i> Add Another Day
                    </button>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-5">
                <a href="/admin/tour-packages" class="btn btn-light">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Tour Package</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/tour-package-form-new.js') }}"></script>
<script>
    // Set the initial day counter for itinerary in edit mode
    document.addEventListener('DOMContentLoaded', function() {
        window.dayCounter = {{ count($tourPackage->itinerary) }};

        // Initialize specific functionality for edit mode
        if (typeof initTourPackageEditMode === 'function') {
            initTourPackageEditMode();
        }
    });
</script>
@endpush

@push('styles')
<style>
    /* Gallery item styles */
    .gallery-item {
        transition: all 0.3s ease;
    }

    .gallery-item .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.07);
        overflow: hidden;
        border-radius: 8px;
        height: 100%;
        transition: all 0.3s ease;
    }

    .gallery-item .card:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        transform: translateY(-3px);
    }

    .gallery-item .card-footer {
        background: none;
        border-top: 1px solid #eee;
    }

    .gallery-preview {
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    /* Add Gallery Image button styling */
    #addGalleryImage {
        background: linear-gradient(135deg, #02515A 0%, #086571 100%);
        border: none;
        box-shadow: 0 2px 8px rgba(2, 81, 90, 0.2);
        transition: all 0.3s ease;
    }

    #addGalleryImage:hover {
        box-shadow: 0 4px 12px rgba(2, 81, 90, 0.3);
        transform: translateY(-1px);
    }

    /* Existing gallery images styling */
    .position-relative img {
        transition: all 0.3s ease;
    }

    .delete-gallery-toggle:checked ~ .position-relative img {
        filter: grayscale(100%);
    }

    .delete-gallery-toggle + label {
        cursor: pointer;
    }

    .form-check.form-switch.bg-white {
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .form-check.form-switch.bg-white:hover {
        opacity: 1;
    }

    .card-footer .image-status {
        font-size: 0.85rem;
    }

    .text-danger {
        color: #dc3545!important;
    }
</style>
@endpush
