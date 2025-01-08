<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Custom violet accent */
    .bg-violet-accent {
      background-color: #7c3aed;
    }
    .text-violet-accent {
      color: #7c3aed;
    }
    .border-violet-accent {
      border-color: #7c3aed;
    }
  </style>
</head>
<body class="bg-gray-900 text-white">
  <!-- Login Container -->
  <div class="flex flex-col items-center justify-center min-h-screen p-6">
    <!-- Login Card -->
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
      <!-- Login Form -->
      <form class="space-y-6">
        <!-- Email Input -->
        <div>
          <label class="block text-gray-400 mb-2">Email</label>
          <input
            type="email"
            placeholder="Enter your email"
            class="w-full bg-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
          />
        </div>
        <!-- Password Input -->
        <div>
          <label class="block text-gray-400 mb-2">Password</label>
          <input
            type="password"
            placeholder="Enter your password"
            class="w-full bg-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
          />
        </div>
        <!-- Login Button -->
        <button
          type="submit"
          class="w-full bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition"
        >
          Login
        </button>
      </form>
      <!-- Sign Up Link -->
      <p class="text-gray-400 mt-6 text-center">
        Don't have an account? <a href="signup.php" class="text-violet-accent hover:underline">Sign Up</a>
      </p>
    </div>
  </div>
</body>
</html>