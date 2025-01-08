<?php 
  session_start(); 
  require '../Classes/Game.php'; 
  require_once '../Config/db.php';
  
  $db = new Database();
  $conn = $db->get_connection();

  $game = new Game($conn);
  
      if(isset($_GET['action']) && $_GET['action'] === 'viewDetails' && isset($_GET['userId'])){
        $userId = $_GET['userId'];
        $_SESSION['user_id'] = $userId;
      }
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://cdn.tailwindcss.com"></script>
  
</head>
<body class="text-white bg-gray-900">
  <!-- User Profile Container -->
  <div class="flex flex-col min-h-screen p-6">
    <!-- Header -->
    <header class="p-4 mb-6 bg-gray-800 rounded-lg">
      <h1 class="text-2xl font-bold">User Profile</h1>
    </header>
    <!-- Profile Section -->
    <section class="p-6 mb-6 bg-gray-800 rounded-lg">
      <div class="flex items-center space-x-4">
        <!-- Profile Picture -->
        <div class="flex items-center justify-center w-20 h-20 bg-gray-700 rounded-full">
          <span class="text-2xl">U</span>
        </div>
        <!-- Profile Details -->
        <div class="flex-1">
          <h2 class="text-xl font-bold">Username</h2>
          <p class="text-gray-400">Email: user@example.com</p>
          <p class="text-gray-400">Member since: January 2023</p>
        </div>
        <!-- Settings Icon -->
        <a href="settings.php" class="text-gray-400 transition hover:text-violet-accent">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </a>
      </div>
    </section>
    <!-- Game Library Section -->
    <section class="p-6 mb-6 bg-gray-800 rounded-lg">
      <h2 class="mb-4 text-2xl font-bold">Game Library</h2>
      <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <!-- Game Card 1 -->
        <div class="overflow-hidden bg-gray-700 rounded-lg shadow-lg">
          <img src="https://via.placeholder.com/400x200" alt="Game Image" class="object-cover w-full h-48">
          <div class="p-4">
            <h3 class="text-lg font-bold">Game Title 1</h3>
            <p class="text-gray-400">Genre: Action</p>
            <p class="text-gray-400">Status: <span class="text-green-400">In Progress</span></p>
            <p class="text-gray-400">Rating: ⭐⭐⭐⭐☆</p>
            <div class="flex mt-4 space-x-2">
            <a href="gamedetails.php?action=gameDetails&userId=<?php echo $_SESSION['user_id']; ?>&gameId=11" class="px-4 py-2 transition rounded bg-violet-accent hover:bg-violet-700">View Details</a>
              <button class="px-4 py-2 transition bg-red-500 rounded hover:bg-red-600">Remove</button>
            </div>
          </div>
        </div>
        <!-- Add more game cards here -->
      </div>
    </section>
  </div>
</body>
</html>