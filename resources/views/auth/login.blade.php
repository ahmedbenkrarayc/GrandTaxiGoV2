<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="w-full min-h-screen flex">
    <!-- Left side - Background Image -->
    <div class="hidden lg:block w-1/2 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1572013343866-dfdb9b416810?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"></div>

    <!-- Right side - Full-Width Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-12 bg-white">
      <div class="w-full max-w-lg">
        <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Login</h2>
        @if($errors->any())
        <ul class="mb-4 list-disc">
            @foreach($errors->all() as $error)
                <li class="text-sm text-red-600 space-y-1">{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form method="POST" action="/login" class="w-full">
            @csrf
          <div class="mb-6">
            <label for="email" class="block text-gray-700 mb-2">Email</label>
            <input type="email" name="email" id="email" placeholder="Jane Doe" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
          </div>
          
          <div class="mb-6">
            <label for="password" class="block text-gray-700 mb-2">Password</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
          </div>
          
          <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-md hover:bg-purple-700 transition duration-300 mb-6">
            Log in
          </button>
          
          <div class="relative flex items-center justify-center mb-6">
            <div class="border-t border-gray-300 flex-grow"></div>
            <div class="px-4 text-sm text-gray-500">or</div>
            <div class="border-t border-gray-300 flex-grow"></div>
          </div>
          
          <!-- Social Login Buttons -->
          <div class="space-y-3">
            <button type="button" class="w-full flex items-center justify-center border border-gray-300 py-2 px-4 rounded-md hover:bg-gray-50 transition duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="mr-2">
                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
              </svg>
              Github
            </button>
          </div>
        </form>
        
        <div class="mt-6 text-center">
          <a href="/forgot-password" class="text-purple-600 hover:underline block mb-2">Forgot your password?</a>
          <a href="/register" class="text-purple-600 hover:underline block">Create account</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
