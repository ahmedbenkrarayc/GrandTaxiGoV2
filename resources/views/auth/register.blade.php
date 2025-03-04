<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="w-full min-h-screen flex">
    <div class="hidden lg:block w-1/2 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1572013343866-dfdb9b416810?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"></div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-12 bg-white">
      <div class="w-full max-w-lg">
        <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Register</h2>
        @if($errors->any())
        <ul class="mb-4 list-disc">
            @foreach($errors->all() as $error)
                <li class="text-sm text-red-600 space-y-1">{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <form method="POST" action="/register" enctype="multipart/form-data" class="w-full">
          @csrf
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="first-name" class="block text-gray-700 mb-2">First Name</label>
              <input type="text" name="fname" id="first-name" placeholder="John" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
            <div>
              <label for="last-name" class="block text-gray-700 mb-2">Last Name</label>
              <input type="text" name="lname" id="last-name" placeholder="Doe" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
          </div>

          <div class="mt-4">
            <label for="role" class="block text-gray-700 mb-2">Role</label>
            <select name="role" id="role" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="" disabled selected>Are you a</option>
                <option value="driver">🚕Driver</option>
                <option value="passenger">👦Passenger</option>
            </select>
          </div>

          <div class="mt-4">
            <label for="email" class="block text-gray-700 mb-2">Email</label>
            <input type="email" name="email" id="email" placeholder="example@mail.com" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
          </div>

          <div class="mt-4">
            <label for="phone" class="block text-gray-700 mb-2">Phone</label>
            <input type="tel" name="phone" id="phone" placeholder="+1234567890" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
          </div>

          <div class="mt-4">
            <label for="photo" class="block text-gray-700 mb-2">Profile Photo</label>
            <div class="relative border border-gray-300 rounded-md p-2 bg-white flex items-center justify-between">
              <span id="file-name" class="text-gray-500">Choose a file...</span>
              <label for="photo" class="bg-purple-600 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-purple-700 transition duration-300">Browse</label>
              <input type="file" name="photo" id="photo" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" onchange="updateFileName()">
            </div>
          </div>

          <div class="mt-4">
            <label for="password" class="block text-gray-700 mb-2">Password</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
          </div>

          <div class="mt-4">
            <label for="confirm-password" class="block text-gray-700 mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" id="confirm-password" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
          </div>

          <button type="submit" class="w-full bg-purple-600 text-white py-3 mt-6 rounded-md hover:bg-purple-700 transition duration-300">
            Register
          </button>
        </form>

        <div class="mt-6 text-center">
          <a href="#" class="text-purple-600 hover:underline block">Already have an account? Log in</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    function updateFileName() {
      const fileInput = document.getElementById('photo');
      const fileNameSpan = document.getElementById('file-name');
      fileNameSpan.textContent = fileInput.files.length > 0 ? fileInput.files[0].name : "Choose a file...";
    }
  </script>
</body>
</html>
