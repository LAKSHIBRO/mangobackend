@extends('frontend.new_layout')

@section('title', $tourPackage->name . ' | Happy Mango Tours')
@section('description', $tourPackage->short_description)
@section('keywords', 'Happy Mango Tours, Sri Lanka tours, ' . $tourPackage->name . ', ' . $tourPackage->locations)

@section('content')
    <!-- Hero Section with Package Name -->
    <div class="w-full py-24 flex flex-col justify-center items-center gap-5 bg-[#000000aa] bg-blend-multiply bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $tourPackage->image) }}')">
        <div class="text-5xl sm:text-7xl font-black font-pri text-center text-white drop-shadow-lg">{{ $tourPackage->name }}</div>
        <div class="text-xl sm:text-2xl font-bold font-pri text-white flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-[#FF9933] transition">HOME</a>
            <span>-</span>
            <a href="{{ route('tours') }}" class="hover:text-[#FF9933] transition">TOURS</a>
        </div>
    </div>

    <div class="max-w-[2500px] w-full bg-white grow">
        <!-- Tour Navigation and Hero Image Section -->
        <div class="w-full p-5 sm:p-10 bg-white">
            <div class="flex flex-col sm:flex-row gap-8 sm:gap-0 max-w-7xl mx-auto">
                <!-- Left Navigation Menu -->
                <div class="w-full sm:w-1/3 sm:pr-8">
                    <div class="flex flex-col bg-[#FF9933] rounded-lg overflow-hidden shadow-md">
                        <a href="#about" class="py-7 border-b border-white/20 flex px-8 gap-6 items-center text-xl font-bold hover:bg-[#02515A] duration-300 text-white">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('new_frontend/Assets/marker (4).png') }}" alt="About" class="w-6 h-6">
                            </div>
                            <div class="text-lg">ABOUT</div>
                        </a>
                        <a href="#included-excluded" class="py-7 border-b border-white/20 flex px-8 gap-6 items-center text-xl font-bold hover:bg-[#02515A] duration-300 text-white">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('new_frontend/Assets/marker (4).png') }}" alt="Included/Excluded" class="w-6 h-6">
                            </div>
                            <div class="text-lg">INCLUDE AND EXCLUDE</div>
                        </a>
                        <a href="#itinerary" class="py-7 border-b border-white/20 flex px-8 gap-6 items-center text-xl font-bold hover:bg-[#02515A] duration-300 text-white">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('new_frontend/Assets/marker (4).png') }}" alt="Itinerary" class="w-6 h-6">
                            </div>
                            <div class="text-lg">ITINERARY</div>
                        </a>
                        <a href="#location" class="py-7 flex px-8 gap-6 items-center text-xl font-bold hover:bg-[#02515A] duration-300 text-white">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('new_frontend/Assets/marker (4).png') }}" alt="Location" class="w-6 h-6">
                            </div>
                            <div class="text-lg">LOCATION</div>
                        </a>
                    </div>
                </div>

                <!-- Right Main Image -->
                <div class="sm:w-2/3">
                    <img class="w-full h-auto object-cover rounded-lg shadow-lg" src="{{ asset('storage/' . $tourPackage->image) }}" alt="{{ $tourPackage->name }}">
                </div>
            </div>
        </div>

        <div class="w-full bg-white flex flex-col sm:flex-row text-black sm:p-20 pt-0">
            <div class="w-full sm:w-2/3 p-10 flex flex-col gap-8">
                <!-- Tour Title and Price -->
                <div id="about" class="scroll-mt-24">
                    <div class="w-full text-4xl sm:text-6xl font-black font-pri mb-8">
                        {{ $tourPackage->name }}
                    </div>

                    <!-- Price Badge -->
                   <div class="py-4">
                     <div class="text-xl sm:text-3xl"><span class="font-bold">PRICE ${{ number_format($tourPackage->price) }} /</span> {{ $tourPackage->duration }} Days Trip</div>
                   </div>

                    <hr class="my-6 border-gray-200"/>

                    <!-- Tour Features -->
                    <div class="flex flex-col sm:flex-row w-full gap-8 sm:gap-16 py-6">
                        <div class="flex text-lg sm:text-2xl gap-6 items-center">
                            <div class="bg-[#FF9933]/10 p-3 rounded-full shadow-sm">
                                <img src="{{ asset('new_frontend/Assets/calendar-clock.png') }}" alt="Duration" class="w-8 h-8">
                            </div>
                            <div class="text-nowrap text-gray-800">{{ $tourPackage->duration }}</div>
                        </div>
                        <div class="flex text-lg sm:text-2xl gap-6 items-center">
                            <div class="bg-[#02515A]/10 p-3 rounded-full shadow-sm">
                                <img src="{{ asset('new_frontend/Assets/footprint.png') }}" alt="Tour Type" class="w-8 h-8">
                            </div>
                            <div class="text-nowrap  text-gray-800">{{ ucfirst(str_replace('-', ' ', $tourPackage->type)) }}</div>
                        </div>
                        <div class="flex text-lg sm:text-2xl gap-6 items-center">
                            <div class="bg-[#FF9933]/10 p-3 rounded-full shadow-sm">
                                <img src="{{ asset('new_frontend/Assets/team-check-alt.png') }}" alt="Group Size" class="w-8 h-8">
                            </div>
                            <div class="text-nowrap text-gray-800">25 people</div>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200"/>

                    <!-- Short Description -->
                    <div class="my-8 text-xl leading-relaxed text-gray-700">
                        {{ $tourPackage->short_description }}
                    </div>

                    <div class="h-px w-full bg-gray-200 my-10"></div>

                    <!-- About This Tour -->
                    <div class="text-4xl sm:text-5xl font-black font-pri mb-8">About this tour</div>
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! $tourPackage->description !!}
                    </div>
                </div>
                 <span class="w-3/5 h-[1px] bg-black"></span>
                <!-- Included/Excluded Section -->
                <div id="included-excluded" class="scroll-mt-24 mt-12">

                    <div class="text-3xl sm:text-5xl font-black font-pri my-6">Included/Excluded</div>

                    <div class="sm:w-4/5 flex flex-col sm:flex-row gap-8">
                        <!-- Included Items -->
                        <div class="w-full sm:w-1/2">

                            <ul class="space-y-3">
                                @foreach($tourPackage->included as $item)
                                    <li class="flex items-start gap-2 text-base sm:text-lg">

                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Excluded Items -->
                        <div class="w-full sm:w-1/2">

                            <ul class="space-y-3">
                                @foreach($tourPackage->excluded as $item)
                                    <li class="flex items-start gap-2 text-base sm:text-lg">

                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                 <span class="w-3/5 h-[1px] bg-black"></span>
                <!-- Itinerary Section -->
                <div id="itinerary" class="scroll-mt-24 mt-12">
                    <span class="w-3/5 h-[1px] bg-black"></span>
                    <div class="text-3xl sm:text-5xl font-black font-pri my-6">Itinerary</div>

                    <div class="flex flex-col gap-5">
                        @foreach($tourPackage->itinerary as $day)
                            <div class="collapse collapse-arrow bg-base-100 border border-gray-200 text-black rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                <input type="radio" name="my-accordion-2" {{ $loop->first ? 'checked="checked"' : '' }} />
                                <div class="collapse-title">
                                    <div class="flex gap-6 p-4 items-center">
                                        <div class="text-white bg-[#02515A] rounded-full py-2 px-4 font-semibold shadow-sm">DAY {{ sprintf('%02d', $day->day) }}</div>
                                        <div class="text-xl font-medium">{{ $day->location }}</div>
                                    </div>
                                </div>
                                <div class="collapse-content text-base text-wrap">
                                    <div class="w-full p-5 flex flex-col sm:flex-row gap-6 border-t border-gray-200">
                                        @if($day->image)
                                            <div class="w-full sm:w-1/3 mb-4 sm:mb-0">
                                                <img src="{{ asset('storage/' . $day->image) }}" alt="{{ $day->title }}" class="w-full h-auto object-cover rounded-lg shadow-md">
                                            </div>
                                        @endif
                                        <div class="w-full {{ $day->image ? 'sm:w-2/3' : '' }}">
                                            <h4 class="font-bold text-2xl mb-4 text-[#02515A]">{{ $day->title }}</h4>
                                            <div class="prose prose-lg max-w-none text-gray-700">
                                                {!! $day->description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Location Section -->
                <div id="location" class="mb-10 scroll-mt-24 mt-12">
                    <span class="w-3/5 h-[1px] bg-black"></span>
                    <div class="mb-6 mt-6">
                        <div class="text-3xl sm:text-5xl font-black font-pri mb-2">Tour's Location</div>
                        <div class="text-base sm:text-lg text-gray-700 font-medium">{{ $tourPackage->locations }}</div>
                    </div>
                    <div id="google-map" class="w-full h-96 rounded-lg shadow-md"></div>
                </div>
            </div>

            <div class="w-full sm:w-1/3">
                <div class="bg-[#02515A] w-full flex flex-col p-10 sm:p-16 text-white sticky top-24 rounded-lg shadow-lg">
                    <div class="text-4xl sm:text-5xl font-pri font-black mb-2">Inquiry Now</div>
                    <div class="text-lg mb-6">It's time to plan just the perfect vacation!</div>

                    @if(session('success'))
                        <div class="bg-green-600 text-white px-4 py-3 rounded-lg mb-4 flex items-center shadow-md">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-600 text-white px-4 py-3 rounded-lg mb-4 shadow-md">
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
                        <input type="text" name="name" placeholder="Name" class="bg-transparent border-0 border-b border-slate-400 py-3 text-white placeholder-gray-300 focus:border-[#FF9933] focus:ring-0 transition-colors" value="{{ old('name') }}" required>
                        <input type="email" name="email" placeholder="Email" class="bg-transparent border-0 border-b border-slate-400 py-3 text-white placeholder-gray-300 focus:border-[#FF9933] focus:ring-0 transition-colors" value="{{ old('email') }}" required>
                        <input type="tel" name="phone" placeholder="Phone" class="bg-transparent border-0 border-b border-slate-400 py-3 text-white placeholder-gray-300 focus:border-[#FF9933] focus:ring-0 transition-colors" value="{{ old('phone') }}" required>
                        <input type="date" name="date" placeholder="Date" class="bg-transparent border-0 border-b border-slate-400 py-3 text-white placeholder-gray-300 focus:border-[#FF9933] focus:ring-0 transition-colors" value="{{ old('date') }}" required>
                        <input type="number" name="adults" placeholder="Number of adults" class="bg-transparent border-0 border-b border-slate-400 py-3 text-white placeholder-gray-300 focus:border-[#FF9933] focus:ring-0 transition-colors" value="{{ old('adults') }}" required>
                        <input type="number" name="children" placeholder="Number of children (optional)" class="bg-transparent border-0 border-b border-slate-400 py-3 text-white placeholder-gray-300 focus:border-[#FF9933] focus:ring-0 transition-colors" value="{{ old('children') }}">
                        <textarea name="message" placeholder="Message" class="bg-transparent border-0 border-b border-slate-400 py-3 text-white placeholder-gray-300 focus:border-[#FF9933] focus:ring-0 transition-colors resize-y">{{ old('message') }}</textarea>
                        <div class="w-full flex justify-center pt-10">
                            <button type="submit" class="w-full bg-[#FF9933] py-4 rounded-full text-lg font-bold hover:bg-[#e68a2e] transition-colors shadow-md">SEND NOW</button>
                        </div>
                    </form>
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
