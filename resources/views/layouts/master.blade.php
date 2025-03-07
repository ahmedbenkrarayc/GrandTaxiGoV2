<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Booking</title>
    @vite(['resources/css/app.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-900 to-purple-900 text-white font-sans">

  <header class="p-6 bg-opacity-20 backdrop-blur-md border-b border-white/10">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-3xl font-bold text-white">Ride<span class="text-purple-400">Ease</span></h1>
      <nav class="space-x-6">
        <a href="/profile" class="hover:text-purple-300">Mon Profil</a>
        <a href="/reservations" class="hover:text-purple-300">Mes Réservations</a>
        <a href="/aide" class="hover:text-purple-300">Aide</a>
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