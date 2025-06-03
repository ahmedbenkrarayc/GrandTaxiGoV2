@extends('layouts.master')
@section('title', 'Home')
@section('content')
<main class="container mx-auto px-4 py-12">
  <div class="text-center mb-12">
    <h2 class="text-5xl font-bold mb-4">Book Your Ride in Seconds</h2>
      <p class="text-lg text-gray-300">Find the nearest drivers and enjoy a seamless ride experience.</p>
    </div>
    
    <div class="flex justify-center mb-12">
      <button id="getLocation" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-8 rounded-full shadow-lg transform transition-all hover:scale-105 flex items-center space-x-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span>Track My Location</span>
      </button>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="chauffeursList"></div>
  </main>
@endsection

@section('scripts')
  <script>
    let clientLocation = null;
    let allDrivers = [];

    function fetchDrivers() {
        fetch('/drivers')
            .then(response => response.json())
            .then(data => {
                allDrivers = data.drivers;
                if (clientLocation) filterDriversByDistance();
            })
            .catch(error => console.error('Error fetching drivers:', error));
    }

    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radius of the Earth in km
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                  Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                  Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c; // Distance in km
    }

    function filterDriversByDistance() {
        const filteredDrivers = allDrivers.map(driver => {
            const distance = calculateDistance(clientLocation.lat, clientLocation.lng, driver.latitude, driver.longitude);
            return { ...driver, distance };
        }).filter(driver => driver.distance <= 10); //km
        displayDrivers(filteredDrivers);
    }

    function displayDrivers(drivers) {
        const container = document.getElementById('chauffeursList');
        container.innerHTML = '';
        drivers.forEach(driver => {
            const card = document.createElement('div');
            card.className = 'bg-white/10 backdrop-blur-md rounded-xl p-6 shadow-lg hover:shadow-xl transform transition-all hover:scale-105';
            card.innerHTML = `
                <div class="flex items-center space-x-4 mb-4">
                    <img src="${driver.user.photo}" alt="${driver.user.fname} ${driver.user.lname}" class="w-12 h-12 rounded-full">
                    <div>
                        <h3 class="text-xl font-semibold">${driver.user.fname} ${driver.user.lname}</h3>
                        <p class="text-sm text-gray-300">${driver.user.email}</p>
                        <p class="text-sm text-gray-300">${driver.user.phone ?? ''}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2 text-sm text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>${driver.distance.toFixed(2)} km away</span>
                </div>
                <div class="mt-4">
                    <a href="/reservation/create/${driver.id}" class="w-full text-center block bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 rounded-full">Réserver</a>
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
                    fetchDrivers();
                },
                () => alert('Erreur lors de la récupération de la position.')
            );
        } else {
            alert('La géolocalisation n\'est pas supportée par votre navigateur.');
        }
    });
  </script>
  @endsection