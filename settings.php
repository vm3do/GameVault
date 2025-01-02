<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings</title>
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
  <!-- Settings Container -->
  <div class="flex flex-col min-h-screen p-6">
    <!-- Header -->
    <header class="bg-gray-800 p-4 rounded-lg mb-6">
      <h1 class="text-2xl font-bold">Settings</h1>
    </header>
    <!-- Settings Form -->
    <section class="bg-gray-800 p-6 rounded-lg mb-6">
      <form class="space-y-6">
        <!-- Profile Picture -->
        <div>
          <label class="block text-gray-400 mb-2">Profile Picture</label>
          <div class="flex items-center space-x-4">
            <div class="w-20 h-20 rounded-full bg-gray-700 flex items-center justify-center">
              <span class="text-2xl">U</span>
            </div>
            <input type="file" class="bg-gray-700 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent">
          </div>
        </div>
        <!-- Name -->
        <div>
          <label class="block text-gray-400 mb-2">Name</label>
          <input
            type="text"
            value="Username"
            class="w-full bg-gray-700 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
          />
        </div>
        <!-- Email -->
        <div>
          <label class="block text-gray-400 mb-2">Email</label>
          <input
            type="email"
            value="user@example.com"
            class="w-full bg-gray-700 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
          />
        </div>
        <!-- Password -->
        <div>
          <label class="block text-gray-400 mb-2">Password</label>
          <input
            type="password"
            placeholder="Enter new password"
            class="w-full bg-gray-700 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
          />
        </div>
        <!-- Save Button -->
        <button
          type="submit"
          class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition"
        >
          Save Changes
        </button>
      </form>
    </section>
  </div>
</body>
</html>