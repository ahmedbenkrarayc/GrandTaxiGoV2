<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>
    @vite(['resources/css/app.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpk2gFMPPC-RIfuepXoWJTMmyEpofTgfo&callback=initMap"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Barre de navigation -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-indigo-600">GrandTaxiGo</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="/profile" class="text-indigo-600 hover:text-indigo-800 transition">Mon Profil</a>
                        <a href="/reservations" class="text-indigo-600 hover:text-indigo-800 transition">Mes Réservations</a>
                        <a href="/aide" class="text-indigo-600 hover:text-indigo-800 transition">Aide</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Barre de recherche et localisation -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" placeholder="Rechercher un chauffeur..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <div class="absolute left-3 top-2.5 text-gray-400">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <button id="getLocation" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition flex items-center justify-center">
                        <i class="fas fa-location-dot mr-2"></i>
                        Ma Position
                    </button>
                </div>
            </div>

            <!-- Liste des chauffeurs -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="chauffeursList">
                <!-- Les cartes des chauffeurs seront générées dynamiquement ici -->
            </div>
        </main>
    </div>

    <!-- Modal de réservation -->
    <div id="reservationModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Réserver un trajet</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Point de départ</label>
                        <input type="text" id="depart" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Destination</label>
                        <input type="text" id="destination" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date et heure</label>
                        <input type="datetime-local" id="datetime" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                </div>
                <div class="flex justify-end mt-6 space-x-4">
                    <button id="cancelReservation" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                        Annuler
                    </button>
                    <button id="confirmReservation" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Confirmer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let clientLocation = null;
        let allDrivers = []; 
        let filteredDrivers = []; 

        function fetchDrivers() {
            fetch('/drivers')
                .then(response => response.json())
                .then(data => {
                    allDrivers = data.drivers;
                    if (clientLocation) {
                        filterDriversByDistance();
                    }
                })
                .catch(error => console.error('Error fetching drivers:', error));
        }

        function filterDriversByDistance() {
            const origin = new google.maps.LatLng(clientLocation.lat, clientLocation.lng);
            const destinations = allDrivers.map(driver => new google.maps.LatLng(driver.latitude, driver.longitude));

            const service = new google.maps.DistanceMatrixService();
            service.getDistanceMatrix(
                {
                    origins: [origin],
                    destinations: destinations,
                    travelMode: google.maps.TravelMode.DRIVING,
                },
                (response, status) => {
                    if (status === google.maps.DistanceMatrixStatus.OK) {
                        filteredDrivers = [];

                        for (let i = 0; i < response.rows[0].elements.length; i++) {
                            const distance = response.rows[0].elements[i].distance.value / 1000;
                            if (distance <= 10) {
                                filteredDrivers.push(allDrivers[i]);
                            }
                        }

                        displayDrivers();
                    } else {
                        console.error('Error fetching distance matrix data:', status);
                    }
                }
            );
        }

        function displayDrivers() {
            const container = document.getElementById('chauffeursList');
            container.innerHTML = '';

            filteredDrivers.forEach(driver => {
                const card = document.createElement('div');
                card.className = 'bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105';
                card.innerHTML = `
                    <div class="p-4">
                        <div class="flex items-center space-x-4">
                            <img src="${driver.user.photo}" alt="${driver.user.fname} ${driver.user.lname}" class="w-16 h-16 rounded-full object-cover">
                            <div>
                                <h3 class="text-lg font-semibold">${driver.user.fname} ${driver.user.lname}</h3>
                                <p class="text-gray-600">${driver.user.email}</p>
                                <p class="text-gray-600">${driver.user.phone}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button onclick="ouvrirModal(${driver.id})" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                                Réserver
                            </button>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        document.getElementById('getLocation').addEventListener('click', () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        clientLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        // alert(`Position trouvée ! Latitude: ${clientLocation.lat}, Longitude: ${clientLocation.lng}`);
                        fetchDrivers();
                    },
                    (error) => {
                        alert('Erreur lors de la récupération de la position.');
                    }
                );
            } else {
                alert('La géolocalisation n\'est pas supportée par votre navigateur.');
            }
        });

        // Modal handling
        function ouvrirModal(driverId) {
            const modal = document.getElementById('reservationModal');
            modal.classList.remove('hidden');
        }

        document.getElementById('cancelReservation').addEventListener('click', () => {
            document.getElementById('reservationModal').classList.add('hidden');
        });

        document.getElementById('confirmReservation').addEventListener('click', () => {
            const depart = document.getElementById('depart').value;
            const destination = document.getElementById('destination').value;
            const datetime = document.getElementById('datetime').value;

            if (depart && destination && datetime) {
                alert('Réservation confirmée !');
                document.getElementById('reservationModal').classList.add('hidden');
            } else {
                alert('Veuillez remplir tous les champs.');
            }
        });
    </script>
</body>
</html>
