<?php
    require 'users.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
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
<body class="text-white bg-gray-900">
  <!-- Sign Up Container -->
  <div class="flex flex-col items-center justify-center min-h-screen p-6">
    <!-- Sign Up Card -->
    <div class="w-full max-w-md p-8 bg-gray-800 rounded-lg shadow-lg">
      <h2 class="mb-6 text-2xl font-bold text-center">Sign Up</h2>
      <!-- Sign Up Form -->
      <form class="space-y-6" action="signup.php" method="POST">
        <!-- Name Input -->
        <div>
          <label class="block mb-2 text-gray-400">Name</label>
          <input
            type="text"
            name="username"
            placeholder="Enter your name"
            class="w-full p-3 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
          />
        </div>
        <!-- Email Input -->
        <div>
          <label class="block mb-2 text-gray-400">Email</label>
          <input
            type="email"
            name="email"
            placeholder="Enter your email"
            class="w-full p-3 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
          />
        </div>
        <!-- Password Input -->
        <div>
          <label class="block mb-2 text-gray-400">Password</label>
          <input
            type="password"
            name="password"
            placeholder="Enter your password"
            class="w-full p-3 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
          />
        </div>
      
        <!-- Sign Up Button -->
        <button
          type="submit"
          name="signup"
          class="w-full px-4 py-2 transition rounded-lg bg-violet-accent hover:bg-violet-700"
        >
          Sign Up
        </button>
      </form>
      <!-- Login Link -->
      <p class="mt-6 text-center text-gray-400">
        Already have an account? <a href="login.php" class="text-violet-accent hover:underline">Login</a>
      </p>
    </div>
  </div>
</body>
</html>
