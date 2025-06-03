<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - RideEase</title>
    @vite(['resources/css/app.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        #map {
          height: 500px;
          width: 100%;
          border-radius: 12px;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-900 to-purple-900 text-white font-sans">

  <header class="p-6 bg-opacity-20 backdrop-blur-md border-b border-white/10">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-3xl font-bold text-white">Ride<span class="text-purple-400">Ease</span></h1>
      <nav class="space-x-6">
        @guest
          <a href="/login" class="hover:text-purple-300">Login</a>
          <a href="/register/driver" class="hover:text-purple-300">Register driver</a>
          <a href="/register/passenger" class="hover:text-purple-300">Register passenger</a>
        @endguest
        @if(auth()->check() && auth()->user()->hasRole('passenger'))
          <a href="/" class="hover:text-purple-300">Find a driver</a>
          <a href="/passenger/history" class="hover:text-purple-300">My reservations</a>
          <a href="/passenger/ratings" class="hover:text-purple-300">Reviews</a>
        @endif
        @if(auth()->check() && auth()->user()->hasRole('driver'))
          <a href="/driver/history" class="hover:text-purple-300">Reservations</a>
          <a href="/driver/status" class="hover:text-purple-300">Status</a>
          <a href="/driver/ratings" class="hover:text-purple-300">Reviews</a>
        @endif
      </nav>
    </div>
  </header>

  @yield('content')

  <footer class="p-6 bg-opacity-20 backdrop-blur-md border-t border-white/10 mt-12">
    <div class="container mx-auto text-center">
      <p class="text-gray-300">&copy; 2025 RideEase. All rights reserved.</p>
    </div>
  </footer>

  @yield('scripts')
</body>
</html>