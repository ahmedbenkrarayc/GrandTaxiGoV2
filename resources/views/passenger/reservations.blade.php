@extends('layouts.master')
@section('title', 'My Reservations')
@section('content')
    
    <main class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-4xl font-bold mb-8 text-center">My reservations</h2>
            <div class="space-y-6">
                @if(Auth::user()->reservations)
                    @foreach(Auth::user()->reservations as $reservation)
                        <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 shadow-lg hover:shadow-xl transform transition-all hover:scale-105">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-2xl font-semibold">Réservation #{{ $reservation->id }}</h3>
                                    <p class="text-sm text-gray-300">Départ: {{ $reservation->trajet->startPlace }}</p>
                                    <p class="text-sm text-gray-300">Destination: {{ $reservation->trajet->destination }}</p>
                                    <p class="text-sm text-gray-300">Prix: {{ $reservation->price }}</p>
                                    <p class="text-sm text-gray-300">Status: {{ $reservation->status }}</p>
                                    <p class="text-sm text-gray-300">Date: {{ $reservation->created_at }}</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    @if($reservation->status == 'pending')
                                        <a href="/reservation/cancel/{{ $reservation->id }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-full">Annuler</a>
                                    @elseif($reservation->status == 'accepted')
                                        <a href="/reservation/details/{{ $reservation->id }}" class="text-purple-400 hover:text-purple-300 underline">Voir détails</a>
                                        <form action="/checkout" method="post">
                                            @csrf
                                            <input type="hidden" name="name" value="{{ $reservation->id }}">
                                            <input type="hidden" name="price" value="{{ $reservation->price }}">
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full">pay</button>
                                        </form>
                                    @elseif($reservation->status == 'finished')
                                    <a href="/passenger/rate/{{ $reservation->id }}" class="text-purple-400 hover:text-purple-300 underline">Ajouter une note</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            @if(!Auth::user()->reservations || count(Auth::user()->reservations) == 0)
            <div class=" bg-white/10 backdrop-blur-md rounded-xl p-6 text-center mt-6">
                <div class="text-gray-300 mb-4">
                    <i class="fas fa-calendar-xmark text-4xl mb-3"></i>
                    <p class="text-lg">Vous n'avez aucune réservation pour le moment.</p>
                </div>
                <a href="/" class="inline-block bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Rechercher un chauffeur</a>
            </div>
            @endif
        </div>
    </main>
@endsection