<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation details | RideEase</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #map {
            height: 500px;
            width: 100%;
            border-radius: 12px;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-900 to-purple-900 text-white font-sans">
    <!-- Header -->
    <header class="p-6 bg-opacity-20 backdrop-blur-md border-b border-white/10">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white">Grand<span class="text-purple-400">TaxiGo</span></h1>
            <nav class="space-x-6">
            <a href="/" class="hover:text-purple-300">Find a driver</a>
            <a href="/passenger/history" class="hover:text-purple-300">My reservations</a>
            <a href="/passenger/ratings" class="hover:text-purple-300">Reviews</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Reservation Title -->
            <h2 class="text-4xl font-bold mb-8 text-center">Reservation details</h2>

            <!-- Driver Details -->
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 shadow-lg mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <img src="{{ asset($reservation->driver->user->photo) }}" alt="Driver" class="w-16 h-16 rounded-full">
                    <div>
                        <h3 class="text-2xl font-semibold">{{ $reservation->driver->user->fname.' '.$reservation->driver->user->lname }}</h3>
                        <p class="text-sm text-gray-300">4.8 ★</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2 text-sm text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                    </svg>
                    <span>{{ $reservation->driver->user->phone }}</span>
                </div>
                <div class="mt-4">
                    <a href="tel:{{ $reservation->driver->user->phone }}" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 rounded-full flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        <span>Appeler le chauffeur</span>
                    </a>
                </div>
            </div>

            <!-- Trip Details -->
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 shadow-lg mb-8">
                <h3 class="text-2xl font-semibold mb-4">Détails du Trajet</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        <div>
                            <p class="text-gray-300">De</p>
                            <p class="text-lg font-semibold">{{ $reservation->trajet->startPlace }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <div>
                            <p class="text-gray-300">À</p>
                            <p class="text-lg font-semibold">{{ $reservation->trajet->destination }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 shadow-lg">
                <h3 class="text-2xl font-semibold mb-4">Localisation en Temps Réel du Chauffeur</h3>
                <div id="map"></div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="p-6 bg-opacity-20 backdrop-blur-md border-t border-white/10 mt-12">
        <div class="container mx-auto text-center">
            <p class="text-gray-300">&copy; 2023 GrandTaxiGo. Tous droits réservés.</p>
        </div>
    </footer>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpk2gFMPPC-RIfuepXoWJTMmyEpofTgfo&callback=initMap"></script>
    <script>
        const map = L.map('map').setView([40.7128, -74.0060], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const customIcon = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/128/2776/2776067.png',
            iconSize: [40, 40],
            iconAnchor: [20, 40]
        });

        let personY; // Will store the user's location dynamically
        let personX = [{{ $reservation->driver->latitude }}, {{ $reservation->driver->longitude }}];

        function initializeMap(userLocation) {
            personY = userLocation; // Set personY dynamically

            const markerY = L.marker(personY, { icon: customIcon }).addTo(map).bindPopup("Person Y (You)");
            const markerX = L.marker(personX, { icon: customIcon }).addTo(map).bindPopup("Person X (Driver)");

            let routeControl = L.Routing.control({
                waypoints: [
                    L.latLng(personX),
                    L.latLng(personY)
                ],
                routeWhileDragging: true,
                createMarker: () => null,
            }).addTo(map);

            window.Echo.channel('location')
            .listen('.driver.location.updated', (data) => {
                personX = [data.lat, data.long];
                markerX.setLatLng(personX);
                routeControl.setWaypoints([
                    L.latLng(personX),
                    L.latLng(personY)
                ]);
                map.setView(personX, 13);
            });

            map.setView(personY, 13);
        }

        // Get user location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const userCoords = [position.coords.latitude, position.coords.longitude];
                    initializeMap(userCoords);
                },
                (error) => {
                    console.error("Error getting location:", error);
                    initializeMap([32.2254721, -9.2482839]); // Default fallback
                }
            );
        } else {
            console.error("Geolocation is not supported by this browser.");
            initializeMap([32.2254721, -9.2482839]); // Default fallback
        }
    </script>
</body>
</html>