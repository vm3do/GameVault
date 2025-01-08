<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
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
  <!-- Sign Up Container -->
  <div class="flex flex-col items-center justify-center min-h-screen p-6">
    <!-- Sign Up Card -->
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold mb-6 text-center">Sign Up</h2>
      <!-- Sign Up Form -->
      <form class="space-y-6">
        <!-- Name Input -->
        <div>
          <label class="block text-gray-400 mb-2">Name</label>
          <input
            type="text"
            placeholder="Enter your name"
            class="w-full bg-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
          />
        </div>
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
        <!-- Confirm Password Input -->
        <div>
          <label class="block text-gray-400 mb-2">Confirm Password</label>
          <input
            type="password"
            placeholder="Confirm your password"
            class="w-full bg-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
          />
        </div>
        <!-- Sign Up Button -->
        <button
          type="submit"
          class="w-full bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition"
        >
          Sign Up
        </button>
      </form>
      <!-- Login Link -->
      <p class="text-gray-400 mt-6 text-center">
        Already have an account? <a href="login.php" class="text-violet-accent hover:underline">Login</a>
      </p>
    </div>
  </div>
</body>
</html>