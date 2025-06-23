@extends('frontend.new_layout')

@section('title', $tourPackage->name . ' | Happy Mango Tours')
@section('description', $tourPackage->short_description)
@section('keywords', 'Happy Mango Tours, Sri Lanka tours, ' . $tourPackage->name . ', ' . $tourPackage->locations)

@section('content')    <!-- Hero Section with Package Name -->
    <div class="w-full py-20 flex flex-col justify-center items-center gap-5 bg-[#000000aa]">
        <div class="text-5xl sm:text-7xl font-black font-pri text-center">{{ $tourPackage->name }}</div>
        <div class="text-xl sm:text-2xl font-black font-pri">HOME - TOURS</div>
    </div>

    <div class="max-w-[2500px] w-full bg-slate-300 grow text-white">
        <!-- Tour Navigation and Hero Image Section -->
        <div class="w-full p-10 bg-white">
            <div class="flex flex-col sm:flex-row gap-5 sm:gap-0">
                <!-- Left Navigation Menu -->
                <div class="w-full sm:w-1/3 sm:p-5">
                    <div class="flex flex-col bg-[#FF9933]">
                        <a href="#about" class="py-10 border-b flex px-15 gap-10 items-center text-xl font-bold hover:bg-[#02515A] duration-300">
                            <div>
                                <img src="{{ asset('new_frontend/Assets/marker (4).png') }}" alt="">
                            </div>
                            <div class="text-lg">ABOUT</div>
                        </a>
                        <a href="#included-excluded" class="py-10 border-b flex px-15 gap-10 items-center text-xl font-bold hover:bg-[#02515A] duration-300">
                            <div>
                                <img src="{{ asset('new_frontend/Assets/marker (4).png') }}" alt="">
                            </div>
                            <div class="text-lg">INCLUDE AND EXCLUDE</div>
                        </a>
                        <a href="#itinerary" class="py-10 border-b flex px-15 gap-10 items-center text-xl font-bold hover:bg-[#02515A] duration-300">
                            <div>
                                <img src="{{ asset('new_frontend/Assets/marker (4).png') }}" alt="">
                            </div>
                            <div class="text-lg">ITINERARY</div>
                        </a>
                        <a href="#location" class="py-10 border-b flex px-15 gap-10 items-center text-xl font-bold hover:bg-[#02515A] duration-300">
                            <div>
                                <img src="{{ asset('new_frontend/Assets/marker (4).png') }}" alt="">
                            </div>
                            <div class="text-lg">LOCATION</div>
                        </a>
                    </div>
                </div>

                <!-- Right Main Image Slider -->
                <div class="sm:w-2/3 sm:p-5">
                    @if($tourPackage->gallery_images && count($tourPackage->gallery_images) > 0)
                        <div class="relative" id="gallerySlider">
                            <!-- Slides -->
                            @foreach($tourPackage->gallery_images as $index => $imagePath)
                                <div class="gallery-slide {{ $index == 0 ? 'active' : '' }}">
                                    <img class="w-full h-[400px] md:h-[500px] object-cover" src="{{ asset('storage/' . $imagePath) }}" alt="{{ $tourPackage->name }} - Gallery Image {{ $index + 1 }}">
                                </div>
                            @endforeach

                            <!-- Navigation Buttons -->
                            @if(count($tourPackage->gallery_images) > 1)
                            <button id="prevSlide" class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 focus:outline-none">
                                &#10094;
                            </button>
                            <button id="nextSlide" class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 focus:outline-none">
                                &#10095;
                            </button>
                            @endif
                        </div>
                    @else
                        <img class="w-full h-[400px] md:h-[500px] object-cover" src="{{ asset('storage/' . $tourPackage->image) }}" alt="{{ $tourPackage->name }}">
                    @endif
                </div>
            </div>
        </div>

<style>
    .gallery-slide {
        display: none;
    }
    .gallery-slide.active {
        display: block;
        animation: fadeIn 0.5s;
    }
    @keyframes fadeIn {
        from { opacity: 0.4; }
        to { opacity: 1; }
    }
</style>

            <div class="w-full bg-white flex flex-col sm:flex-row text-black sm:p-20 pt-0">
                <div class="w-full sm:w-2/3 p-10 flex flex-col gap-8">
                    <!-- Tour Title and Price -->
                    <div id="about" class="scroll-mt-24">
                        <div class="w-full text-4xl sm:text-6xl font-black font-pri mb-4">
                            {{ $tourPackage->name }}
                        </div>

                        <!-- Price Badge -->
                        <div class="bg-[#02515A] text-white inline-block rounded-lg px-4 py-2 mb-6">
                            <span class="text-xl sm:text-3xl font-bold">${{ $tourPackage->price }}</span>
                            <span class="text-lg"> / {{ $tourPackage->duration }}</span>
                        </div>

                        <!-- Tour Features Card -->
                        <div class="bg-gray-50 rounded-lg shadow-md p-6 mb-6">
                            <h3 class="text-xl font-bold mb-4 text-[#02515A]">Tour Details</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <!-- Duration Feature -->
                                <div class="flex items-center gap-4 p-3 bg-white rounded-md shadow-sm border-l-4 border-[#FF9933]">
                                    <div class="bg-[#FF9933] p-3 rounded-full">
                                        <img src="{{ asset('new_frontend/Assets/calendar-clock.png') }}" alt="Duration" class="w-6 h-6">
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Duration</p>
                                        <p class="font-semibold">{{ $tourPackage->duration }}</p>
                                    </div>
                                </div>

                                <!-- Tour Type Feature -->
                                <div class="flex items-center gap-4 p-3 bg-white rounded-md shadow-sm border-l-4 border-[#02515A]">
                                    <div class="bg-[#02515A] p-3 rounded-full">
                                        <img src="{{ asset('new_frontend/Assets/footprint.png') }}" alt="Tour Type" class="w-6 h-6">
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Tour Type</p>
                                        <p class="font-semibold">{{ ucfirst(str_replace('-', ' ', $tourPackage->type)) }}</p>
                                    </div>
                                </div>

                                <!-- Group Size Feature -->
                                <div class="flex items-center gap-4 p-3 bg-white rounded-md shadow-sm border-l-4 border-[#FF9933]">
                                    <div class="bg-[#FF9933] p-3 rounded-full">
                                        <img src="{{ asset('new_frontend/Assets/team-check-alt.png') }}" alt="Group Size" class="w-6 h-6">
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Group Size</p>
                                        <p class="font-semibold">{{ $tourPackage->people_count > 0 ? $tourPackage->people_count . ' People' : 'Varies' }}</p>
                                    </div>
                                </div>

                                <!-- Category Feature -->
                                @if($tourPackage->category)
                                <div class="flex items-center gap-4 p-3 bg-white rounded-md shadow-sm border-l-4 border-[#02515A]">
                                    <div class="bg-[#02515A] p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Category</p>
                                        <p class="font-semibold">{{ $tourPackage->category->name }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <span class="w-3/5 h-[1px] bg-black"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <span class="w-3/5 h-[1px] bg-black"></span>

                            <!-- Short Description -->
                            <div>
                                {{ $tourPackage->short_description }}
                            </div>

                            <span class="w-3/5 h-[1px] bg-black"></span>

                            <!-- About This Tour -->
                            <div class="text-5xl font-black font-pri">About this tour</div>
                            <div>
                                {!! $tourPackage->description !!}
                            </div>
                        </div>

                        <!-- Included/Excluded Section -->
                        <div id="included-excluded" class="scroll-mt-24">
                            <span class="w-3/5 h-[1px] bg-black"></span>
                            <div class="text-3xl sm:text-5xl font-black font-pri mb-6">Included/Excluded</div>

                            <div class="flex flex-col sm:flex-row gap-6 sm:w-4/5">
                                <!-- Included Items -->
                                <div class="w-full sm:w-1/2 bg-green-50 rounded-lg shadow-md p-5">
                                    <h3 class="text-xl font-bold text-green-800 mb-4 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Included
                                    </h3>
                                    <ul class="flex flex-col gap-3 text-sm sm:text-md">
                                        @foreach($tourPackage->included as $item)
                                            <li class="flex items-start">
                                                <span class="text-green-600 mr-2 mt-1">✓</span>
                                                <span>{{ $item }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Excluded Items -->
                                <div class="w-full sm:w-1/2 bg-red-50 rounded-lg shadow-md p-5">
                                    <h3 class="text-xl font-bold text-red-800 mb-4 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Excluded
                                    </h3>
                                    <ul class="flex flex-col gap-3 text-sm sm:text-md">
                                        @foreach($tourPackage->excluded as $item)
                                            <li class="flex items-start">
                                                <span class="text-red-600 mr-2 mt-1">✕</span>
                                                <span>{{ $item }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Itinerary Section -->
                        <div id="itinerary" class="scroll-mt-24">
                            <span class="w-3/5 h-[1px] bg-black"></span>
                            <div class="text-3xl sm:text-5xl font-black font-pri">Itinerary</div>

                            <div class="flex flex-col gap-5">
                                @foreach($tourPackage->itinerary as $day)
                                    <div class="collapse collapse-arrow bg-base-100 border border-base-300 text-black">
                                        <input type="radio" name="my-accordion-2" {{ $loop->first ? 'checked="checked"' : '' }} />
                                        <div class="collapse-title">
                                            <div class="flex gap-10 p-5 items-center">
                                                <button class="text-white bg-[#02515A] rounded-full py-2 px-4">DAY {{ sprintf('%02d', $day->day) }}</button>
                                                <div class="text-xl">{{ $day->location }}</div>
                                            </div>
                                        </div>
                                        <div class="collapse-content text-sm text-wrap">
                                            <div class="w-full p-5 flex flex-col sm:flex-row gap-5 border-t border-slate-600">
                                                @if($day->image)
                                                    <img src="{{ asset('storage/' . $day->image) }}" alt="{{ $day->title }}">
                                                @endif
                                                <div>
                                                    <h4 class="font-bold text-xl mb-2">{{ $day->title }}</h4>
                                                    {!! $day->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Location Section -->
                        <div id="location" class="mb-10 scroll-mt-24">
                            <span class="w-3/5 h-[1px] bg-black"></span>
                            <div class="mb-4"><span class="text-3xl sm:text-5xl font-black font-pri">Tour's Location </span><span class="text-xs sm:text-md">{{ $tourPackage->locations }}</span></div>
                            <div id="google-map" class="w-full h-96 rounded-lg shadow-md"></div>
                        </div>
                    </div>                    <div class="w-full sm:w-1/3">
                        <div class="bg-[#02515A] w-full flex flex-col p-10 sm:p-20 text-white">
                            <div class="text-5xl font-pri font-black">Inquiry Now</div>
                            <div class="py-3">It's time to plan just the perfect vacation!</div>

                            @if(session('success'))
                                <div class="bg-green-600 text-white px-4 py-3 rounded mb-4 flex items-center shadow-md">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>{{ session('success') }}</span>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="bg-red-600 text-white px-4 py-3 rounded mb-4 shadow-md">
                                    <ul class="list-disc list-inside">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('tour.inquire') }}" method="POST" class="flex flex-col gap-5">
                                @csrf
                                <input type="hidden" name="tour_id" value="{{ $tourPackage->id }}">
                                <input type="text" name="name" placeholder="NAME" class="bg-[#00000000] border-0 border-b border-slate-400 py-3 text-white placeholder-gray-300" value="{{ old('name') }}" required>
                                <input type="email" name="email" placeholder="EMAIL" class="bg-[#00000000] border-0 border-b border-slate-400 py-3 text-white placeholder-gray-300" value="{{ old('email') }}" required>
                                <input type="tel" name="phone" placeholder="PHONE" class="bg-[#00000000] border-0 border-b border-slate-400 py-3 text-white placeholder-gray-300" value="{{ old('phone') }}" required>
                                <input type="date" name="date" placeholder="DATE" class="bg-[#00000000] border-0 border-b border-slate-400 py-3 text-white placeholder-gray-300" value="{{ old('date') }}" required>
                                <input type="number" name="adults" placeholder="NUMBER OF ADULTS" class="bg-[#00000000] border-0 border-b border-slate-400 py-3 text-white placeholder-gray-300" value="{{ old('adults') }}" required>
                                <input type="number" name="children" placeholder="NUMBER OF CHILDREN (OPTIONAL)" class="bg-[#00000000] border-0 border-b border-slate-400 py-3 text-white placeholder-gray-300" value="{{ old('children') }}">
                                <textarea name="message" placeholder="MESSAGE" class="bg-[#00000000] border-0 border-b border-slate-400 py-3 text-white placeholder-gray-300">{{ old('message') }}</textarea>
                                <div class="w-full flex justify-center py-20">
                                    <button type="submit" class="w-full bg-[#FF9933] py-3 rounded-full text-md font-bold hover:bg-[#e68a2e] transition-colors">SEND NOW</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Smooth Scroll, Notifications, and Map -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Auto-hide success notification after 5 seconds
            const successAlert = document.querySelector('.bg-green-600');
            if (successAlert) {
                // Scroll to the notification
                successAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });

                // Add click handler to dismiss
                successAlert.addEventListener('click', function() {
                    fadeOut(successAlert);
                });

                // Auto hide after 5 seconds
                setTimeout(() => {
                    fadeOut(successAlert);
                }, 5000);
            }

            // Function to fade out elements
            function fadeOut(element) {
                element.style.transition = 'opacity 0.5s ease';
                element.style.opacity = '0';
                setTimeout(() => {
                    element.style.display = 'none';
                }, 500);
            }

            // Basic Gallery Slider Logic
            const gallerySlider = document.getElementById('gallerySlider');
            if (gallerySlider) {
                const slides = gallerySlider.querySelectorAll('.gallery-slide');
                const prevButton = gallerySlider.querySelector('#prevSlide');
                const nextButton = gallerySlider.querySelector('#nextSlide');
                let currentSlide = 0;

                function showSlide(index) {
                    slides.forEach((slide, i) => {
                        slide.classList.toggle('active', i === index);
                    });
                }

                if (prevButton && nextButton && slides.length > 1) {
                    prevButton.addEventListener('click', () => {
                        currentSlide = (currentSlide > 0) ? currentSlide - 1 : slides.length - 1;
                        showSlide(currentSlide);
                    });

                    nextButton.addEventListener('click', () => {
                        currentSlide = (currentSlide < slides.length - 1) ? currentSlide + 1 : 0;
                        showSlide(currentSlide);
                    });
                }

                // Initialize first slide
                if(slides.length > 0) {
                    showSlide(currentSlide);
                }
            }
        });
    </script>

    <!-- Google Maps Script -->
    @php
        $apiKey = config('services.google.maps_api_key');
    @endphp

    @if($apiKey)
        <script src="https://maps.googleapis.com/maps/api/js?key={{ $apiKey }}&callback=initMap&libraries=places&v=weekly" defer></script>
        <script>
            // Initialize the Google Map
            function initMap() {
                // Get location from tourPackage
                const locationName = "{{ $tourPackage->locations }}, Sri Lanka";
                const mapDiv = document.getElementById("google-map");

                // Create a new map instance
                const map = new google.maps.Map(mapDiv, {
                    zoom: 10,
                    center: { lat: 7.8731, lng: 80.7718 }, // Default to Sri Lanka center
                });

                // Create a geocoder to convert the location name to coordinates
                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({ address: locationName }, (results, status) => {
                    if (status === "OK") {
                        // Center map on the found location
                        map.setCenter(results[0].geometry.location);

                        // Add a marker for the location
                        new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location,
                            title: "{{ $tourPackage->name }}"
                        });
                    } else {
                        console.error(`Geocode failed: ${status}`);
                    }
                });
            }
        </script>
    @else
        <!-- Fallback when no API key is available -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const mapDiv = document.getElementById("google-map");
                mapDiv.innerHTML = `
                    <div class="flex flex-col items-center justify-center h-full bg-gray-100 rounded-lg p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <h3 class="text-lg font-semibold mb-2">Location: {{ $tourPackage->locations }}</h3>
                        <p class="text-gray-600">Google Maps preview is currently unavailable.</p>
                    </div>
                `;
            });
        </script>
    @endif
@endsection
