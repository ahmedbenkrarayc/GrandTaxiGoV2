<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ride History - RideEase</title>
    @vite(['resources/js/livelocation.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #1e293b;
            padding: 20px;
            border-radius: 12px;
            width: 400px;
            max-width: 90%;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-900 to-purple-900 text-white font-sans">

  <header class="p-6 bg-opacity-20 backdrop-blur-md border-b border-white/10">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-3xl font-bold text-white">Ride<span class="text-purple-400">Ease</span></h1>
      <nav class="space-x-6">
        <a href="/driver/history" class="hover:text-purple-300">Reservations</a>
        <a href="/driver/status" class="hover:text-purple-300">Status</a>
        <a href="/driver/ratings" class="hover:text-purple-300">Reviews</a>
      </nav>
    </div>
  </header>

  <main class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
      <h2 class="text-4xl font-bold mb-8 text-center">Ride History</h2>
      <p class="text-center text-gray-300 mb-8">Check all your past and upcoming rides</p>

      <div class="space-y-6">
        @if(Auth::user()->driver)
          @foreach(Auth::user()->driver->reservations as $reservation)
          <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 shadow-lg hover:shadow-xl transform transition-all hover:scale-105">
            <div class="flex justify-between items-center">
              <div>
                <h3 class="text-2xl font-semibold">{{ $reservation->passenger->fname.' '.$reservation->passenger->lname }}</h3> 
                <p class="text-sm text-gray-300">Phone: {{ $reservation->passenger->phone }}</p>
                <p class="text-sm text-gray-300">Status: {{ $reservation->status }}</p>
                <p class="text-sm text-gray-300">Price: {{ $reservation->price }}</p>
                <p class="text-sm text-gray-300">{{ $reservation->trajet->startPlace }} → {{ $reservation->trajet->destination }}</p>
                <p class="text-sm text-gray-300">Date: {{ explode(' ', $reservation->created_at)[0] }} - {{ explode(' ', $reservation->created_at)[1] }}</p>
              </div>
              <div class="flex items-center space-x-4">
                @if($reservation->status == 'pending')
                  <button onclick="openModal('{{ $reservation->id }}')" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-full">
                    Accept
                  </button>
                  <a href="/driver/reservation/reject/{{ $reservation->id }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-full">
                    Reject
                  </a>
                @elseif($reservation->status == 'accepted')
                  <a href="/driver/reservation/finish/{{ $reservation->id }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full">
                    Mark as Finished
                  </a>
                @elseif($reservation->status == 'finished')
                  <a href="/driver/rate/{{ $reservation->id }}" class="text-purple-400 hover:text-purple-300 underline">Add a Rating</a>
                @else
                  <span class="text-gray-500">-</span>
                @endif
              </div>
            </div>
          </div>
          @endforeach
        @endif
      </div>
    </div>
  </main>

  <footer class="p-6 bg-opacity-20 backdrop-blur-md border-t border-white/10 mt-12">
    <div class="container mx-auto text-center">
      <p class="text-gray-300">&copy; 2025 RideEase. All rights reserved.</p>
    </div>
  </footer>

  <div id="acceptModal" class="modal">
    <div class="modal-content">
      <h3 class="text-2xl font-semibold mb-4">Confirm Acceptance</h3>
      <form id="acceptForm" method="POST" action="/driver/reservation/accept/{{ $reservation->id }}">
        @csrf
        <input type="hidden" name="reservation_id" id="reservation_id">
        <div class="mb-4">
          <label for="price" class="block text-sm font-medium text-gray-300">Proposed Price</label>
          <input type="number" name="price" id="price" class="mt-1 block w-full p-2 bg-gray-700 border border-gray-600 rounded-md text-white" required>
        </div>
        <div class="flex justify-end space-x-4">
          <button type="button" onclick="closeModal()" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-full">
            Cancel
          </button>
          <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-full">
            Confirm
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openModal(reservationId) {
      const modal = document.getElementById('acceptModal');
      const form = document.getElementById('acceptForm');
      const reservationIdInput = document.getElementById('reservation_id');

      reservationIdInput.value = reservationId;

      form.action = `/driver/reservation/accept/${reservationId}`;

      modal.style.display = 'flex';
    }

    function closeModal() {
      const modal = document.getElementById('acceptModal');
      modal.style.display = 'none';
    }

    window.onclick = function(event) {
      const modal = document.getElementById('acceptModal');
      if (event.target === modal) {
        closeModal();
      }
    };
  </script>
</body>
</html>
