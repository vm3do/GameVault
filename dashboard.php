<?php 
    require './classes/users.php';
    $users = new Users($conn); 
    $allUsers = $users->getAllUsers();

    require './classes/Game.php';
    $games = new Game($conn);
    $allGames = $games->getAllGames();
    
?>   
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
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
  <!-- Admin Dashboard Container -------------------------------------------------------------------------------------------------->
  <div class="flex flex-col min-h-screen p-6">
    <header class="p-4 mb-6 bg-gray-800 rounded-lg">
      <h1 class="text-2xl font-bold">Admin Dashboard</h1>
    </header>
    <!-- Statistics Section ------------------------------------------------------------------------------------------------->
    <section class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3">
      <!-- Total Games -->
      <div class="p-6 bg-gray-800 rounded-lg">
        <h3 class="text-gray-400">Total Games</h3>
        <p class="text-2xl font-bold">120</p>
      </div>
      <!-- Total Users -->
      <div class="p-6 bg-gray-800 rounded-lg">
        <h3 class="text-gray-400">Total Users</h3>
        <p class="text-2xl font-bold">1,234</p>
      </div>
      <!-- Chats -->
      <div class="p-6 bg-gray-800 rounded-lg">
        <h3 class="text-gray-400">Active Chats</h3>
        <p class="text-2xl font-bold">56</p>
      </div>
    </section>
  <!-- ------------------------------------------------------------------------------------------------------------------------ -->
    <section class="p-6 mb-6 bg-gray-800 rounded-lg">
      <div class="flex flex-wrap gap-4">
        <!-- Add Game Button --------------------------------------------------------------------- -->
        <button
          onclick="openAddGameModal()"
          class="flex items-center px-4 py-2 space-x-2 transition rounded-lg bg-violet-accent hover:bg-violet-700"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          <span>Add Game</span>
        </button>
        <!-- Manage Users Button ----------------------------------------------------------------- -->
        <button
          onclick="openModal()"
          class="flex items-center px-4 py-2 space-x-2 transition rounded-lg bg-violet-accent hover:bg-violet-700"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
          <span>Manage Users</span>
        </button>
      </div>
    </section>
  <!-- All Games Added ------------------------------------------------------------------------------------------------------ -->
    <section class="p-6 bg-gray-800 rounded-lg">
      <h2 class="mb-4 text-2xl font-bold">All Games</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full overflow-hidden bg-gray-700 rounded-lg">
          <thead class="bg-gray-600">
            <tr>
              <th class="px-6 py-3 text-sm font-semibold text-left">Title</th>
              <th class="px-6 py-3 text-sm font-semibold text-left">Genre</th>
              <th class="px-6 py-3 text-sm font-semibold text-left">Release Date</th>
              <th class="px-6 py-3 text-sm font-semibold text-left">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-600">  
            <?php foreach ($allGames as $game): ?>
            <tr>
              <td class="px-6 py-4"><?php echo $game['title'] ?></td>
              <td class="px-6 py-4">not yet</td>
              <td class="px-6 py-4">2025-01-05</td>
              <td class="px-6 py-4">
            <div class="flex space-x-2 items-center">  
                    <a href="dashboard.php?action=editGame&Id=<?php echo $game['id']; ?>" class="px-4 py-2 transition rounded-lg bg-violet-accent hover:bg-violet-700" >Edit</a>
                    <a href="dashboard.php?action=deleteGame&Id=<?php echo $game['id']; ?>" class="px-4 py-2 ml-2 transition bg-red-500 rounded-lg hover:bg-red-600" >Delete</a>
            </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>

<!-- Manage Users Modal --------------------------------------------------------------------------------------------------------------->
  <div
    id="manageUsersModal"
    class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-75"
  >
    <div class="w-full max-w-4xl p-6 mx-4 bg-gray-800 rounded-lg">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold">Manage Users</h2>
        <button
          onclick="closeModal()"
          class="text-gray-400 transition hover:text-white"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <!-- Table ------------------------------------------------------------------------>
      <div class="overflow-x-auto">
        <table class="min-w-full overflow-hidden bg-gray-700 rounded-lg">
          <thead class="bg-gray-600">
            <tr>
              <th class="px-6 py-3 text-sm font-semibold text-left">Username</th>
              <th class="px-6 py-3 text-sm font-semibold text-left">Email</th>
              <th class="px-6 py-3 text-sm font-semibold text-left">Status</th>
              <th class="px-6 py-3 text-sm font-semibold text-left">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-600">
          <?php foreach ($allUsers as $user): ?>
            <tr>
              <td class="px-6 py-4"><?php echo $user['username']?></td>
              <td class="px-6 py-4"><?php echo $user['email']?></td>
              <td class="px-6 py-4"><?php echo $user['status']?></td>
              <td class="px-6 py-4">
            <div class="flex space-x-2">
              <form action="" method="POST">
                  <input type="hidden" name="upgrade" value="<?php echo $user['id']?>"> 
                  <button type="submit"  class="px-4 py-2 transition rounded-lg bg-violet-accent hover:bg-violet-700">Upgrade</button>
              </form>
              <?php if($user['status'] == 'active'):?>      
              <form action="" method="POST">
                  <input type="hidden" name="ban" value="<?php echo $user['id']?>">
                  <button type="submit" class="px-4 py-2 ml-2 transition bg-red-500 rounded-lg hover:bg-red-600">Ban</button>
              </form> 
              <?php endif; ?>  
                 
              <?php if($user['status'] == 'banned'):?> 
              <form action="" method="POST">
                  <input type="hidden" name="unban" value="<?php echo $user['id']?>">
                  <button type="submit" class="px-4 py-2 ml-2 transition bg-red-500 rounded-lg hover:bg-red-600">Unban</button>
              </form>   
              <?php endif; ?>  
            </div>         
              <?php endforeach; ?>   
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    <!-- End Table ------------------------------------------------------------------------>
    </div>
  </div>

<!-- Add Game Modal --------------------------------------------------------------------------------------------------------------->
  <div
    id="addGameModal"
    class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-75"
  >
    <div class="w-full max-w-2xl p-6 mx-4 bg-gray-800 rounded-lg">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold">Add New Game</h2>
        <button
          onclick="closeAddGameModal()"
          class="text-gray-400 transition hover:text-white"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <!-- Add Form ------------------------------------------------------------------------------------------------>
      <form action="dashboard.php" method="POST">
        <div class="space-y-4">
          <!-- API Id ---------------------------------------------------------------------------->
          <div>
            <label for="api_id" class="block text-sm font-medium text-gray-400">API ID</label>
            <input
              type="text"
              name="apiId"
              class="w-full px-4 py-2 mt-1 text-white bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500"
              required
            />
          </div>
          <!-- Title ----------------------------------------------------------------------------->
          <div>
            <label for="title" class="block text-sm font-medium text-gray-400">Title</label>
            <input
              type="text"
              name="title"
              class="w-full px-4 py-2 mt-1 text-white bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500"
              required
            />
          </div>
          <!-- Description -->
          <div>
            <label for="description" class="block text-sm font-medium text-gray-400">Description</label>
            <textarea
              name="description"
              rows="3"
              class="w-full px-4 py-2 mt-1 text-white bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500"
              required
            ></textarea>
          </div>
          <!-- Image URL --------------------------------------------------------------------------------->
          <div>
            <label for="image_url" class="block text-sm font-medium text-gray-400">Image URL</label>
            <input
              type="url"
              name="imageURL"
              class="w-full px-4 py-2 mt-1 text-white bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500"
              required
            />
          </div>
          <!-- Add game Button ----------------------------------------------------------------------------->
          <div class="flex justify-end">
            <button
              type="submit"
              name="addGame"
              class="px-4 py-2 transition rounded-lg bg-violet-accent hover:bg-violet-700"
            >
              Add Game
            </button>
          </div>
        </div>
      </form>
  <!-- End Form ------------------------------------------------------------------------------------------------------------->
    </div>
  </div>
<!-- End Add Game Modul ------------------------------------------------------------------------------------------------------------->

<!-- Update Game Modal --------------------------------------------------------------------------------------------------------------->
<?php if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] === 'editGame'):
      $game = new Game($conn);
      $gameById = $game->getGameById($_GET['Id']);
 ?>
  <div
    id="updateGameModal"
    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-75"
  >
    <div class="w-full max-w-2xl p-6 mx-4 bg-gray-800 rounded-lg">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold">Update Game</h2>
        <button
          onclick="closeUpdateGameModal()"
          class="text-gray-400 transition hover:text-white"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <!-- Update Form ------------------------------------------------------------------------------------------------>
      <form action="dashboard.php" method="POST">
        <div class="space-y-4">
        <?php if ($gameById) : ?>
          <!-- API Id ---------------------------------------------------------------------------->
          <div>
            <label for="api_id" class="block text-sm font-medium text-gray-400">API ID</label>
            <input
              type="text"
              name="new_apiId"
              value="<?php echo $gameById['api_id'] ; ?>"
              class="w-full px-4 py-2 mt-1 text-white bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500"
              required
            />
          </div>
          <!-- New Title ----------------------------------------------------------------------------->
          <div>
            <label for="title" class="block text-sm font-medium text-gray-400">Title</label>
            <input
              type="text"
              value="<?php echo $gameById['title'] ; ?>"
              name="new_title"
              class="w-full px-4 py-2 mt-1 text-white bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500"
              required
            />
          </div>
          <!-- New Description ----------------------------------------------------------------------------->
          <div>
            <label for="description" class="block text-sm font-medium text-gray-400">Description</label>
            <textarea
              rows="3"
              name="new_description"
              class="w-full px-4 py-2 mt-1 text-white bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500"
              required
            ><?php echo $gameById['description']; ?>
            </textarea>
          </div>
          <!-- New Image URL --------------------------------------------------------------------------------->
          <div>
            <label for="image_url" class="block text-sm font-medium text-gray-400">Image URL</label>
            <input
              type="url"
              value="<?php echo $gameById['image_url'] ; ?>"
              name="new_imageURL"
              class="w-full px-4 py-2 mt-1 text-white bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500"
              required
            />
          </div>
          <?php endif; ?>
          <!-- Update game Button ----------------------------------------------------------------------------->
          <div class="flex justify-end">
            <input type="hidden" name="gameId" value="<?php echo $_GET['Id']; ?>">
            <button
              type="submit"
              name="updateGame"
              class="px-4 py-2 transition rounded-lg bg-violet-accent hover:bg-violet-700"
            >
             Save Changes
            </button>
  
          </div>
        </div>
      </form>
  <!-- End Form ------------------------------------------------------------------------------------------------------------->
    </div>
  </div>
<!-- End Update Game Modul ------------------------------------------------------------------------------------------------------------->
 <?php endif; ?>
  <script>
    const manageUsersModal = document.getElementById("manageUsersModal");
    const addGameModal = document.getElementById("addGameModal");

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