<?php
  session_start(); 
  require_once '../Classes/Users.php';

  if (!isset($_SESSION['admin_id']) && !isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$db = new Database();
$pdo = $db->connect();

  $gameHistory = new Users($pdo);

  $games = $gameHistory->getFromHistory($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>History</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/style.css">

</head>
<body class="bg-gray-900 text-white">
  <!-- Header -->
  <header class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
      <!-- Logo -->
      <div class="text-xl font-bold text-violet-accent">VirtualWorld</div>
      <!-- Navigation -->
      <nav class="space-x-4">
        <a href="#" class="hover:text-violet-accent transition">Home</a>
        <a href="#" class="hover:text-violet-accent transition">Library</a>
        <a href="#" class="hover:text-violet-accent transition">Profile</a>
      </nav>
    </div>
  </header>

  <!-- History Section -->
  <section class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Game History</h1>
    <!-- History List -->
    <div class="space-y-4">
      <!-- Game 1 -->
  <?php foreach($games as $game): ?>

      <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-2"><?= $game['title']?></h2>
        <p class="text-gray-400">Added at: <span class="text-violet-accent"><?= $game['created_at']?></span></p>
      </div>

  <?php endforeach; ?>
      <!-- Add more games here -->
    </div>
  </section>
</body>
</html>