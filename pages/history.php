<?php

  include __DIR__ . '/../includes/header.php';
  require_once __DIR__ . '/../Classes/User.php';

  if (!isset($_SESSION['admin_id']) && !isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$db = new Database();
$pdo = $db->connect();

  $gameHistory = new User($pdo);

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