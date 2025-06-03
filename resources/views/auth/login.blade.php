<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - RideEase</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-900 to-purple-900 text-white font-sans">

  <!-- Header -->
  <header class="p-6 bg-opacity-20 backdrop-blur-md border-b border-white/10">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-3xl font-bold text-white">Ride<span class="text-purple-400">Ease</span></h1>
      <nav class="space-x-6">
        <a href="#" class="hover:text-purple-300">Home</a>
        <a href="#" class="hover:text-purple-300">Login</a>
        <a href="#" class="hover:text-purple-300">Contact</a>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container mx-auto px-4 py-12">
    <div class="max-w-md mx-auto">
      <!-- Page Title -->
      <h2 class="text-4xl font-bold mb-8 text-center">Login</h2>

      <!-- Display Errors -->
      @if($errors->any())
        <div class="mb-6 bg-red-500 p-4 rounded-lg text-white">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Login Form -->
      <form method="POST" action="/login" class="bg-white/10 backdrop-blur-md rounded-xl p-8 shadow-lg">
        @csrf
        <!-- Email Input -->
        <div class="mb-6">
          <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            class="mt-1 block w-full px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
            placeholder="Enter your email"
            required
          />
        </div>

        <!-- Password Input -->
        <div class="mb-6">
          <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            class="mt-1 block w-full px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
            placeholder="Enter your password"
            required
          />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mb-6">
          <div class="flex items-center">
            <input
              type="checkbox"
              id="rememberMe"
              name="rememberMe"
              class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-white/20 rounded"
            />
            <label for="rememberMe" class="ml-2 text-sm text-gray-300">Remember me</label>
          </div>
          <a href="#" class="text-sm text-purple-400 hover:text-purple-300">Forgot password?</a>
        </div>

        <!-- Submit Button -->
        <div class="mt-8">
          <button
            type="submit"
            class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-full flex items-center justify-center space-x-2 transition-all transform hover:scale-105"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
            </svg>
            <span>Login</span>
          </button>
        </div>
        <div class="mt-6">
          <a
            href="/auth/google"
            type="button"
            class="w-full bg-white text-gray-800 font-semibold py-3 rounded-full flex items-center justify-center space-x-2 transition-all transform hover:scale-105 shadow-md"
          >
            <img src="https://cdn1.iconfinder.com/data/icons/google-s-logo/150/Google_Icons-09-1024.png" alt="Google Logo" class="h-6 w-6">
            <span>Connect with Google</span>
          </a>
        </div>
        <div class="mt-6 text-center">
          <p class="text-sm text-gray-300">Don't have an account? <a href="/register" class="text-purple-400 hover:text-purple-300">Sign up</a></p>
        </div>
      </form>
    </div>
  </main>

  <!-- Footer -->
  <footer class="p-6 bg-opacity-20 backdrop-blur-md border-t border-white/10 mt-12">
    <div class="container mx-auto text-center">
      <p class="text-gray-300">&copy; 2025 RideEase. All rights reserved.</p>
    </div>
  </footer>

</body>
</html>
