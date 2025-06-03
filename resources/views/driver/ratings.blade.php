@extends('layouts.master')
@section('title', 'Ratings')
@section('content')
  <main class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">

      <h2 class="text-4xl font-bold mb-8 text-center">Ratings and Reviews</h2>

      <div class="space-y-6">
        @foreach($reservations as $reservation)
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 shadow-lg">
          <div class="flex items-center space-x-4 mb-4">
            <img src="{{ $reservation->driver->user->photo }}" alt="User" class="w-10 h-10 rounded-full">
            <div>
              <h3 class="text-xl font-semibold">{{ $reservation->passenger->fname.' '.$reservation->passenger->lname }}</h3>
              <div class="flex items-center space-x-1 text-yellow-400">
                <i class="fas fa-star"></i>
                <span class="text-sm text-gray-300 ml-2">{{ $reservation->ratings[0]->rate }}</span>
              </div>
            </div>
          </div>
          <p class="text-gray-300">
            "{{ $reservation->ratings[0]->comment }}"
          </p>
        </div>
        @endforeach
      </div>
    </div>
  </main>
  @vite(['resources/js/livelocation.js'])

@endsection