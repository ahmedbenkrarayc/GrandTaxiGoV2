<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - RideEase</title>
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
      <h2 class="text-4xl font-bold mb-8 text-center">Register</h2>

      <!-- Registration Form -->
      <form method="POST" action="/register" enctype="multipart/form-data" class="bg-white/10 backdrop-blur-md rounded-xl p-8 shadow-lg">
        @csrf

        <!-- First Name and Last Name -->
        <div class="grid grid-cols-2 gap-4 mb-6">
          <div>
            <label for="first-name" class="block text-sm font-medium text-gray-300">First Name</label>
            <input
              type="text"
              name="fname"
              id="first-name"
              placeholder="John"
              class="mt-1 block w-full px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
              required
            />
          </div>
          <div>
            <label for="last-name" class="block text-sm font-medium text-gray-300">Last Name</label>
            <input
              type="text"
              name="lname"
              id="last-name"
              placeholder="Doe"
              class="mt-1 block w-full px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
              required
            />
          </div>
        </div>

        <input type="hidden" name="role" value="passenger">

        <!-- Email Input -->
        <div class="mb-6">
          <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            placeholder="example@mail.com"
            class="mt-1 block w-full px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
            required
          />
        </div>

        <!-- Phone Input -->
        <div class="mb-6">
          <label for="phone" class="block text-sm font-medium text-gray-300">Phone</label>
          <input
            type="tel"
            name="phone"
            id="phone"
            placeholder="+1234567890"
            class="mt-1 block w-full px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
            required
          />
        </div>

        <!-- Profile Photo Upload -->
        <div class="mb-6">
          <label for="photo" class="block text-sm font-medium text-gray-300">Profile Photo</label>
          <div class="relative mt-1 border border-white/20 rounded-lg p-2 bg-white/10 flex items-center justify-between">
            <span id="file-name" class="text-gray-300">Choose a file...</span>
            <label for="photo" class="bg-purple-600 text-white px-4 py-2 rounded-lg cursor-pointer hover:bg-purple-700 transition duration-300">Browse</label>
            <input
              type="file"
              name="photo"
              id="photo"
              class="absolute inset-0 opacity-0 w-full h-full cursor-pointer"
              onchange="updateFileName()"
            />
          </div>
        </div>

        <!-- Password Input -->
        <div class="mb-6">
          <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
          <input
            type="password"
            name="password"
            id="password"
            class="mt-1 block w-full px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
            required
          />
        </div>

        <!-- Confirm Password Input -->
        <div class="mb-6">
          <label for="confirm-password" class="block text-sm font-medium text-gray-300">Confirm Password</label>
          <input
            type="password"
            name="password_confirmation"
            id="confirm-password"
            class="mt-1 block w-full px-4 py-2 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
            required
          />
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
            <span>Register</span>
          </button>
        </div>
        <div class="mt-6">
          <a
            href="/auth/google?role=passenger"
            type="button"
            class="w-full bg-white text-gray-800 font-semibold py-3 rounded-full flex items-center justify-center space-x-2 transition-all transform hover:scale-105 shadow-md"
          >
            <img src="https://cdn1.iconfinder.com/data/icons/google-s-logo/150/Google_Icons-09-1024.png" alt="Google Logo" class="h-6 w-6">
            <span>Connect with Google</span>
          </a>
        </div>
      </form>

      <!-- Login Link -->
      <div class="mt-6 text-center">
        <p class="text-sm text-gray-300">Already have an account? <a href="/login" class="text-purple-400 hover:text-purple-300">Log in</a></p>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="p-6 bg-opacity-20 backdrop-blur-md border-t border-white/10 mt-12">
    <div class="container mx-auto text-center">
      <p class="text-gray-300">&copy; 2023 RideEase. All rights reserved.</p>
    </div>
  </footer>

  <script>
    function updateFileName() {
      const fileInput = document.getElementById('photo');
      const fileNameSpan = document.getElementById('file-name');
      fileNameSpan.textContent = fileInput.files.length > 0 ? fileInput.files[0].name : "Choose a file...";
    }
  </script>
</body>
</html>