@extends('layouts.master')
@section('title', 'Review')
@section('content')

  <main class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
      <h2 class="text-4xl font-bold mb-8 text-center">Rate Your Ride</h2>

      <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 shadow-lg mb-8">
        <div class="flex items-center space-x-6">
          <img src="{{ $reservation->passenger->photo }}" alt="Driver" class="w-16 h-16 rounded-full">
          <div>
            <h3 class="text-2xl font-semibold">{{ $reservation->passenger->fname.' '.$reservation->passenger->lname }}</h3>
            <p class="text-sm text-gray-300">4.8 ★</p>
          </div>
        </div>
      </div>

      <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 shadow-lg mb-8">
        <h3 class="text-2xl font-semibold mb-4">Reservation Details</h3>
        <p class="text-sm text-gray-300"><strong>Number:</strong> #{{ $reservation->id }}</p>
        <p class="text-sm text-gray-300"><strong>Start Time:</strong> {{ $reservation->trajet->startDateTime }}</p>
        <p class="text-sm text-gray-300"><strong>Start Place:</strong> {{ $reservation->trajet->startPlace }}</p>
        <p class="text-sm text-gray-300"><strong>Destination:</strong> {{ $reservation->trajet->destination }}</p>
      </div>

      <form method="POST" action="/driver/rate" class="bg-white/10 backdrop-blur-md rounded-xl p-8 shadow-lg">
        @csrf
        <input type="hidden" name="id" value="{{ $reservation->id }}">
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-300">Your Rating</label>
          <div class="flex space-x-2 mt-2">
            <span class="text-2xl cursor-pointer" onclick="rate(1)">&#9733;</span>
            <span class="text-2xl cursor-pointer" onclick="rate(2)">&#9733;</span>
            <span class="text-2xl cursor-pointer" onclick="rate(3)">&#9733;</span>
            <span class="text-2xl cursor-pointer" onclick="rate(4)">&#9733;</span>
            <span class="text-2xl cursor-pointer" onclick="rate(5)">&#9733;</span>
          </div>
          <input type="hidden" id="rating" name="rating" value="0">
        </div>

        <div class="mb-6">
          <label for="comment" class="block text-sm font-medium text-gray-300">Comment</label>
          <textarea
            id="comment"
            name="comment"
            rows="4"
            class="mt-1 block w-full px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
            placeholder="Share your experience..."
            required
          ></textarea>
        </div>

        <div class="mt-8">
          <button
            type="submit"
            class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-full flex items-center justify-center space-x-2 transition-all transform hover:scale-105"
          >
            <i class="fas fa-star"></i>
            <span>Submit Rating</span>
          </button>
        </div>
      </form>
    </div>
  </main>

  <footer class="p-6 bg-opacity-20 backdrop-blur-md border-t border-white/10 mt-12">
    <div class="container mx-auto text-center">
      <p class="text-gray-300">&copy; 2025 RideEase. All rights reserved.</p>
    </div>
  </footer>

  <script>
    function rate(stars) {
      const starElements = document.querySelectorAll('.flex.space-x-2 span');
      const ratingInput = document.getElementById('rating');

      starElements.forEach((star, index) => {
        if (index < stars) {
          star.classList.add('text-yellow-400');
        } else {
          star.classList.remove('text-yellow-400');
        }
      });

      ratingInput.value = stars;
    }
  </script>
  @vite(['resources/js/livelocation.js'])

@endsection
