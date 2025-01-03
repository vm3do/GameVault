<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
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
  <!-- Admin Dashboard Container -->
  <div class="flex flex-col min-h-screen p-6">
    <!-- Header -->
    <header class="bg-gray-800 p-4 rounded-lg mb-6">
      <h1 class="text-2xl font-bold">Admin Dashboard</h1>
    </header>
    <!-- Stats Section -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <!-- Total Games -->
      <div class="bg-gray-800 p-6 rounded-lg">
        <h3 class="text-gray-400">Total Games</h3>
        <p class="text-2xl font-bold">120</p>
      </div>
      <!-- Total Users -->
      <div class="bg-gray-800 p-6 rounded-lg">
        <h3 class="text-gray-400">Total Users</h3>
        <p class="text-2xl font-bold">1,234</p>
      </div>
      <!-- Active Chats -->
      <div class="bg-gray-800 p-6 rounded-lg">
        <h3 class="text-gray-400">Active Chats</h3>
        <p class="text-2xl font-bold">56</p>
      </div>
    </section>
    <!-- Action Buttons -->
    <section class="bg-gray-800 p-6 rounded-lg mb-6">
      <div class="flex flex-wrap gap-4">
        <!-- Add Game Button -->
        <button class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition flex items-center space-x-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          <span>Add Game</span>
        </button>
        <!-- Manage Users Button -->
        <button
          onclick="openModal()"
          class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition flex items-center space-x-2"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
          <span>Manage Users</span>
        </button>
      </div>
    </section>
    <!-- Games List Section -->
    <section class="bg-gray-800 p-6 rounded-lg">
      <h2 class="text-2xl font-bold mb-4">All Games</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-700 rounded-lg overflow-hidden">
          <thead class="bg-gray-600">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-semibold">Title</th>
              <th class="px-6 py-3 text-left text-sm font-semibold">Genre</th>
              <th class="px-6 py-3 text-left text-sm font-semibold">Release Date</th>
              <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-600">
            <!-- Game 1 -->
            <tr>
              <td class="px-6 py-4">Game Title 1</td>
              <td class="px-6 py-4">Action</td>
              <td class="px-6 py-4">2023-01-01</td>
              <td class="px-6 py-4">
                <button class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition">Edit</button>
                <button class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition ml-2">Delete</button>
              </td>
            </tr>
            <!-- Game 2 -->
            <tr>
              <td class="px-6 py-4">Game Title 2</td>
              <td class="px-6 py-4">Adventure</td>
              <td class="px-6 py-4">2023-02-01</td>
              <td class="px-6 py-4">
                <button class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition">Edit</button>
                <button class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition ml-2">Delete</button>
              </td>
            </tr>
            <!-- Add more games here -->
          </tbody>
        </table>
      </div>
    </section>
  </div>

  <!-- Manage Users Modal -->
  <div
    id="manageUsersModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden"
  >
    <div class="bg-gray-800 p-6 rounded-lg w-full max-w-4xl mx-4">
      <!-- Modal Header -->
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Manage Users</h2>
        <button
          onclick="closeModal()"
          class="text-gray-400 hover:text-white transition"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <!-- Users Table -->
      <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-700 rounded-lg overflow-hidden">
          <thead class="bg-gray-600">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-semibold">Username</th>
              <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
              <th class="px-6 py-3 text-left text-sm font-semibold">Role</th>
              <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-600">
            <!-- User 1 -->
            <tr>
              <td class="px-6 py-4">JohnDoe</td>
              <td class="px-6 py-4">johndoe@example.com</td>
              <td class="px-6 py-4">User</td>
              <td class="px-6 py-4">
                <button class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition">Upgrade</button>
                <button class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition ml-2">Ban</button>
              </td>
            </tr>
            <!-- User 2 -->
            <tr>
              <td class="px-6 py-4">JaneDoe</td>
              <td class="px-6 py-4">janedoe@example.com</td>
              <td class="px-6 py-4">Admin</td>
              <td class="px-6 py-4">
                <button class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition">Upgrade</button>
                <button class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition ml-2">Ban</button>
              </td>
            </tr>
            <!-- Add more users here -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Script for Modal -->
  <script>
    const modal = document.getElementById("manageUsersModal");

    function openModal() {
      modal.classList.remove("hidden");
    }

    function closeModal() {
      modal.classList.add("hidden");
    }
  </script>
</body>
</html>