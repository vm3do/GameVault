<?php

    require './usersManagement.php';
    require './gameCRUD.php';
    require '../Classes/users.php';

  if (!isset($_SESSION['admin_id'])) {
      header('Location: login.php');
      exit();
  }
  
    $users = new Users($conn);
    $allUsers = $users->getAllUsers();
    
    $allGames = Game::getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>

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
        <p class="text-2xl font-bold"></p>
      </div>
      <!-- Total Users -->
      <div class="bg-gray-800 p-6 rounded-lg">
        <h3 class="text-gray-400">Total Users</h3>
        <p class="text-2xl font-bold"></p>
      </div>
      <!-- Active Chats -->
      <div class="bg-gray-800 p-6 rounded-lg">
        <h3 class="text-gray-400">Active Chats</h3>
        <p class="text-2xl font-bold"></p>
      </div>
    </section>
    <!-- Action Buttons -->
    <section class="bg-gray-800 p-6 rounded-lg mb-6">
      <div class="flex flex-wrap gap-4">
        <!-- Add Game Button -->
        <button
          onclick="openAddGameModal()"
          class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition flex items-center space-x-2"
        >
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
            <?php foreach ($allGames as $game): ?>
            <tr>
              <td class="px-6 py-4"><?php echo $game['title']; ?></td>
              <td class="px-6 py-4"><?php echo $game['genre']; ?></td>
              <td class="px-6 py-4"><?php echo $game['release_date']; ?></td>
              <td class="px-6 py-4">
                <a href="dashboard.php?action=editGame&Id=<?php echo $game['id']; ?>" class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition">Edit</a>
                <a href="dashboard.php?action=deleteGame&Id=<?php echo $game['id']; ?>" class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition ml-2">Delete</a>
              </td>
            </tr>
            <?php endforeach; ?>
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
              <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
              <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-600">
            <?php foreach ($allUsers as $user): ?>
            <tr>
              <td class="px-6 py-4"><?php echo $user['username']; ?></td>
              <td class="px-6 py-4"><?php echo $user['email']; ?></td>
              <td class="px-6 py-4"><?php echo $user['status']; ?></td>
              <td class="px-6 py-4">
            <div class="flex space-x-2">
                <form action="" method="POST">
                  <input type="hidden" name="upgrade" value="<?php echo $user['id']; ?>">
                  <button type="submit" class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition">Upgrade</button>
                </form>
                <?php if($user['status'] == 'active'): ?>
                <form action="" method="POST">
                  <input type="hidden" name="ban" value="<?php echo $user['id']; ?>">
                  <button type="submit" class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition ml-2">Ban</button>
                </form>
                <?php endif; ?>
                <?php if($user['status'] == 'banned'): ?>
                <form action="" method="POST">
                  <input type="hidden" name="unban" value="<?php echo $user['id']; ?>">
                  <button type="submit" class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition ml-2">Unban</button>
                </form>
                <?php endif; ?>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Add Game Modal -->
  <div
    id="addGameModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden"
  >
    <div class="bg-gray-800 p-6 rounded-lg w-full max-w-md mx-4">
      <!-- Modal Header -->
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Add Game</h2>
        <button
          onclick="closeAddGameModal()"
          class="text-gray-400 hover:text-white transition"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <!-- Add Game Form -->
      <form action="dashboard.php" method="POST" id="addGameForm" class="space-y-4 modal-content">
        <!-- Game Title with Fetch Button -->
        <div class="flex items-center gap-2">
          <div class="flex-1">
            <label for="gameTitle" class="block text-sm font-medium text-gray-400">Title</label>
            <input
              type="text"
              id="gameTitle"
              name="gameTitle"
              class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
              required
            />
          </div>
          <button
            type="button"
            id="fetchButton"
            class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition mt-6"
          >
            Fetch
          </button>
        </div>
        <!-- Game Genre -->
        <div>
          <label for="gameGenre" class="block text-sm font-medium text-gray-400">Genre</label>
          <input
            type="text"
            id="gameGenre"
            name="gameGenre"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          />
        </div>
        <!-- Description -->
        <div>
          <label for="description" class="block text-sm font-medium text-gray-400">Description</label>
          <textarea
            id="description"
            name="description"
            rows="4"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          ></textarea>
        </div>
        <!-- Release Date -->
        <div>
          <label for="releaseDate" class="block text-sm font-medium text-gray-400">Release Date</label>
          <input
            type="date"
            id="releaseDate"
            name="releaseDate"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          />
        </div>
        <!-- Image URL -->
        <div>
          <label for="background" class="block text-sm font-medium text-gray-400">Image URL</label>
          <input
            type="url"
            id="background"
            name="background"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          />
        </div>
        <!-- Screenshot 1 -->
        <div>
          <label for="scrshot1" class="block text-sm font-medium text-gray-400">Screenshot 1 URL</label>
          <input
            type="url"
            id="scrshot1"
            name="scrshot1"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          />
        </div>
        <!-- Screenshot 2 -->
        <div>
          <label for="scrshot2" class="block text-sm font-medium text-gray-400">Screenshot 2 URL</label>
          <input
            type="url"
            id="scrshot2"
            name="scrshot2"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          />
        </div>
        <!-- Screenshot 3 -->
        <div>
          <label for="scrshot3" class="block text-sm font-medium text-gray-400">Screenshot 3 URL</label>
          <input
            type="url"
            id="scrshot3"
            name="scrshot3"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          />
        </div>
        <!-- Rating -->
        <div>
          <label for="rating" class="block text-sm font-medium text-gray-400">Rating</label>
          <input
            type="number"
            id="rating"
            name="rating"
            min="0"
            max="10"
            step="0.1"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          />
        </div>
        <!-- Submit Button -->
        <div class="flex justify-end">
          <button
            type="submit"
            name="addGame"
            class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition"
          >
            Add Game
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Update Game Modal -->
  <?php if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] === 'editGame'):
    $game = new Game($conn);
    $gameById = $game->getGameById($_GET['Id']);
  ?>
  <div
  id="updateGameModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center"
  >
    <div class="bg-gray-800 p-6 rounded-lg w-full max-w-md mx-4">
      <!-- Modal Header -->
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Update Game</h2>
        <button
          onclick="closeUpdateGameModal()"
          class="text-gray-400 hover:text-white transition"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <!-- Add Game Form -->
      <form action="dashboard.php" method="POST" class="space-y-4 modal-content">
      <?php if ($gameById) : ?>
        <!-- Game Title with Fetch Button -->
        <div class="flex items-center gap-2">
          <div class="flex-1">
            <label for="gameTitle" class="block text-sm font-medium text-gray-400">Title</label>
            <input
              type="text"
              id="gameTitle"
              name="new_title"
              value="<?php echo $gameById['title']; ?>"
              class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
              required
            />
          </div>
          <button
            type="button"
            id="fetchButton"
            class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition mt-6"
          >
            Fetch
          </button>
        </div>
        <!-- Game Genre -->
        <div>
          <label for="gameGenre" class="block text-sm font-medium text-gray-400">Genre</label>
          <input
            type="text"
            id="gameGenre"
            name="new_genre"
            value="<?php echo $gameById['genre']; ?>"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          />
        </div>
        <!-- Description -->
        <div>
          <label for="description" class="block text-sm font-medium text-gray-400">Description</label>
          <textarea
            name="new_description"
            rows="4"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          ><?php echo $gameById['description']; ?></textarea>
        </div>
        <!-- Release Date -->
        <div>
          <label for="releaseDate" class="block text-sm font-medium text-gray-400">Release Date</label>
          <input
            type="date"
            id="releaseDate"
            name="new_releaseDate"
            value="<?php echo $gameById['release_date']; ?>"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          />
        </div>
        <!-- Image URL -->
        <div>
          <label for="background" class="block text-sm font-medium text-gray-400">Image URL</label>
          <input
            type="url"
            id="background"
            name="new_background"
            value="<?php echo $gameById['background_url']; ?>"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          />
        </div>
        <!-- Screenshot 1 -->
        <div>
          <label for="scrshot1" class="block text-sm font-medium text-gray-400">Screenshot 1 URL</label>
          <input
            type="url"
            id="scrshot1"
            name="new_scrshot1"
            value="<?php echo $gameById['screenshot1_url']; ?>"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          />
        </div>
        <!-- Screenshot 2 -->
        <div>
          <label for="scrshot2" class="block text-sm font-medium text-gray-400">Screenshot 2 URL</label>
          <input
            type="url"
            id="scrshot2"
            name="new_scrshot2"
            value="<?php echo $gameById['screenshot2_url']; ?>"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          />
        </div>
        <!-- Screenshot 3 -->
        <div>
          <label for="scrshot3" class="block text-sm font-medium text-gray-400">Screenshot 3 URL</label>
          <input
            type="url"
            id="scrshot3"
            name="new_scrshot3"
            value="<?php echo $gameById['screenshot3_url']; ?>"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          />
        </div>
        <!-- Rating -->
        <div>
          <label for="rating" class="block text-sm font-medium text-gray-400">Rating</label>
          <input
            type="number"
            id="rating"
            name="new_rating"
            value="<?php echo $gameById['rating']; ?>"
            min="0"
            max="10"
            step="0.1"
            class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white custom-input focus:border-violet-accent focus:ring-violet-accent"
            required
          />
        </div>
        <!-- Submit Button -->
        <div class="flex justify-end">
          <input type="hidden" name="gameId" value="<?php echo $_GET['Id']; ?>">
          <button
            type="submit"
            name="updateGame"
            class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition"
          >
          Save Changes
          </button>
        </div>
      <?php endif; ?>
      </form>
    </div>
  </div>
  <?php endif; ?>

<script src="../addGameScript.js"></script>
  <script>
    const manageUsersModal = document.getElementById("manageUsersModal");
    const addGameModal = document.getElementById("addGameModal");
    const updateGameModal = document.getElementById("updateGameModal");

    function openModal() {
      manageUsersModal.classList.remove("hidden");
    }

    function closeModal() {
      manageUsersModal.classList.add("hidden");
    }

    function openAddGameModal() {
      addGameModal.classList.remove("hidden");
    }

    function closeAddGameModal() {
      addGameModal.classList.add("hidden");
    }

    function closeUpdateGameModal() {
      updateGameModal.classList.add("hidden");
    }
  </script>
</body>
</html>