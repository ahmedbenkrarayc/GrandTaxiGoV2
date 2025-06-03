<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - RideEase</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex h-screen">
    <aside class="w-64 bg-gradient-to-b from-blue-900 to-purple-900 text-white">
      <div class="p-6">
        <h1 class="text-2xl font-bold">Ride<span class="text-purple-400">Ease</span></h1>
      </div>
      <nav class="mt-6">
        <a href="/admin/dashboard" class="block py-2 px-6 hover:bg-white/10">Dashboard</a>
        <a href="/admin/dashboard/drivers" class="block py-2 px-6 hover:bg-white/10">Manage Drivers</a>
        <a href="/admin/dashboard/passengers" class="block py-2 px-6 hover:bg-white/10">Manage Passengers</a>
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="block py-2 px-6 hover:bg-white/10">Logout</button>
        </form>
      </nav>
    </aside>
    <main class="flex-1 p-8 overflow-y-auto">
        @yield('content')
    </main>
  </div>

</body>
</html>