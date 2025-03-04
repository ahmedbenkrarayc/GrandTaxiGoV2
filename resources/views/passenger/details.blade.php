<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de Réservation | GrandTaxiGo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Barre de navigation -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-indigo-600">WSSlni</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="/profile" class="text-indigo-600 hover:text-indigo-800 transition">Mon Profil</a>
                        <a href="/reservations" class="text-indigo-600 hover:text-indigo-800 transition">Mes Réservations</a>
                        <a href="/aide" class="text-indigo-600 hover:text-indigo-800 transition">Aide</a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Détails de la Réservation</h2>
            </div>

            <div class="flex flex-col lg:flex-row gap-6">
                <div class="lg:w-1/2 space-y-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Informations du Chauffeur</h3>
                        <div class="flex items-center space-x-4 mb-4">
                            <img src="{{ asset('/storage/'.$reservation->driver->user->photo) }}" alt="Jean Dupont" class="w-20 h-20 rounded-full object-cover border-2 border-indigo-600">
                            <div>
                                <h4 class="text-xl font-bold">{{ $reservation->driver->user->fname.' '.$reservation->driver->user->lname }}</h4>
                            </div>
                        </div>
                        <div class="space-y-2 pt-3">
                            <p class="text-gray-700"><i class="fas fa-phone-alt mr-2 text-indigo-600"></i>{{ $reservation->driver->user->phone }}</p>
                            <p class="text-gray-700"><i class="fas fa-envelope mr-2 text-indigo-600"></i>{{ $reservation->driver->user->email }}</p>
                        </div>
                    </div>
                    
                    <!-- Carte des détails de la réservation -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Détails du Trajet</h3>
                        
                        <div class="space-y-4">
                            <!-- Status de la réservation -->
                            <div class="bg-green-50 p-3 rounded-lg border border-green-200 flex items-center">
                                <div class="bg-green-500 p-2 rounded-full mr-3">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-green-800">Réservation Confirmée</p>
                                </div>
                            </div>
                            
                            <!-- Trajet -->
                            <div class="flex">
                                <div class="mr-4 relative">
                                    <div class="w-3 h-3 rounded-full bg-indigo-600"></div>
                                    <div class="absolute top-3 bottom-3 left-1.5 w-0.5 bg-gray-300"></div>
                                    <div class="w-3 h-3 rounded-full bg-indigo-600 absolute bottom-0"></div>
                                </div>
                                <div class="space-y-6 flex-1">
                                    <div>
                                        <p class="font-medium">Point de départ</p>
                                        <p class="text-gray-700">{{ $reservation->trajet->startPlace }}</p>
                                        <p class="text-sm text-gray-500">{{ $reservation->updated_at }}</p>
                                    </div>
                                    <div>
                                        <p class="font-medium">Destination</p>
                                        <p class="text-gray-700">{{ $reservation->trajet->destination }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="border-t pt-4 mt-4 flex justify-between">
                                <a href="tel:{{ $reservation->driver->user->phone }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
                                    <i class="fas fa-phone-alt mr-2"></i>
                                    Appeler le chauffeur
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Colonne de droite: Carte Google Maps (vide pour l'instant) -->
                <div class="lg:w-1/2">
                    <div class="bg-white rounded-lg shadow-md h-full min-h-[600px] flex items-center justify-center">
                        <!-- <div class="text-center p-6">
                            <div class="text-gray-400 mb-3">
                                <i class="fas fa-map-marker-alt text-4xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-700">Emplacement du Chauffeur</h3>
                            <p class="text-gray-500 mt-2">La carte de localisation en temps réel sera affichée ici</p>
                            <p class="text-sm text-gray-400 mt-4">Intégration Google Maps API à venir</p>
                        </div> -->
                        <div id="map" class="w-full h-[500px]"></div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpk2gFMPPC-RIfuepXoWJTMmyEpofTgfo&callback=initMap"></script>
    <script>
    let map;
    let driverMarker;
    const driverid = {{ $reservation->driver->id }};

    function initMap() {
        const clientLocation = { lat: {{ $reservation->trajet->latitude }}, lng: {{ $reservation->trajet->longtitude }} }; 

        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: clientLocation,
        });

        new google.maps.Marker({
            position: clientLocation,
            map: map,
            title: "Client Location",
            icon: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png"
        });

        const driverLocation = { lat: 34.0522, lng: -118.2537 };
        driverMarker = new google.maps.Marker({
            position: driverLocation,
            map: map,
            title: "Driver",
            icon: "https://maps.google.com/mapfiles/ms/icons/red-dot.png"
        });

        map.setCenter(clientLocation);

        trackDriver();
    }

    function trackDriver() {
        setInterval(() => {
            fetch(`/driver/location/${driverid}`)
                .then(response => response.json())
                .then(data => {
                    if (data.latitude && data.longitude) {
                        const driverPosition = new google.maps.LatLng(data.latitude, data.longitude);

                        driverMarker.setPosition(driverPosition);
                        map.setCenter(driverPosition);
                    } else {
                        console.error('Invalid data received for driver location:', data);
                    }
                })
                .catch(error => console.error("Error fetching driver location:", error));
        }, 5000);
    }
</script>

</body>
</html>