<?php 
include '../includes/header.php';
require_once '../Classes/User.php';

  $games = User::getLibraryGames($_SESSION['user_id']);

  $db = new Database();
  $pdo = $db->connect();

  $user = new User($pdo);
  if(isset($_GET['remove'])){
    $user->removeFromLib($_GET['remove']);
    header('Location: profile.php?game-removed');
    exit();
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
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
  <!-- User Profile Container -->
  <div class="flex flex-col min-h-screen p-6">
    <!-- Header -->
    <header class="bg-gray-800 p-4 rounded-lg mb-6">
      <h1 class="text-2xl font-bold">User Profile</h1>
    </header>
    <!-- Profile Section -->
    <section class="bg-gray-800 p-6 rounded-lg mb-6">
      <div class="flex items-center space-x-4">
        <!-- Profile Picture -->
        <div class="w-20 h-20 rounded-full bg-gray-700 flex items-center justify-center">
          <span class="text-2xl">U</span>
        </div>
        <!-- Profile Details -->
        <div class="flex-1">
          <h2 class="text-xl font-bold">Username</h2>
          <p class="text-gray-400">Email: user@example.com</p>
          <p class="text-gray-400">Member since: January 2023</p>
        </div>
        <!-- Settings Icon -->
        <a href="settings.php" class="text-gray-400 hover:text-violet-accent transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </a>
      </div>
    </section>
    <!-- Game Library Section -->
    <section class="bg-gray-800 p-6 rounded-lg mb-6">
      <h2 class="text-2xl font-bold mb-4">Game Library</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Game Card 1 -->
        <?php foreach($games as $game): ?>
          

          <div class="bg-gray-700 rounded-lg overflow-hidden shadow-lg">
          <img src="<?= $game['background']?>" alt="Game Image" class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-bold"><?= $game['title']?></h3>
            <p class="text-gray-400">Genre: <?= $game['genre']?></p>
            <p class="text-gray-400">Status: <span class="text-green-400"><?= $game['game_status']?></span></p>
            <p class="text-gray-400">Rating: ⭐⭐⭐⭐☆</p>
            <div class="mt-4 flex space-x-2">
              <button class="bg-violet-accent px-4 py-2 rounded hover:bg-violet-700 transition">View Details</button>
              <form action="profile.php" method="GET">
                <button type=submit name="remove" value="<?= $game['game_id']?>" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600 transition">Remove</button>
              </form>
            </div>
          </div>
        </div>
          
          
        <?php endforeach; ?>
        <!-- Add more game cards here -->
      </div>
    </section>
  </div>
</body>
</html>