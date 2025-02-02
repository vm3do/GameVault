<?php

include '../includes/header.php';
require_once '../Classes/User.php';

if (!isset($_SESSION['admin_id']) && !isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$db = new Database();
$pdo = $db->connect();

$games = new User($pdo);

$AllFavorate = $games->getFavoriteGames($_SESSION['user_id']);


if (isset($_POST['remove'])) {
  $games->removeFromFavorite($_POST['remove']);
  header('Location: favorites.php?game-removed');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Favorites</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/style.css">

</head>

<body class="bg-gray-900 text-white">


  <!-- Favorites Section -->
  <section class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Favorites</h1>
    <!-- Favorites List -->
    <div class="space-y-6">

      <?php foreach ($AllFavorate as $favorate): ?>

        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg flex flex-col sm:flex-row">
          <!-- Image -->
          <div class="sm:w-1/3">
            <img src="<?= $favorate['background'] ?>" alt="Game Image" class="w-full h-48 sm:h-full object-cover">
          </div>
          <!-- Content -->
          <div class="p-6 flex-1">
            <h2 class="text-xl font-bold mb-2"><?= $favorate['title'] ?></h2>
            <p class="text-gray-400 mb-4">Genre: <?= $favorate['genre'] ?></p>

            <form action="favorites.php" method="POST">
              <button type=submit name="remove" value="<?= $favorate['game_id'] ?>"
                class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition">Remove from Favorites</button>
            </form>
          </div>
        </div>

      <?php endforeach; ?>
      <!-- Add more games here -->
    </div>
  </section>
</body>

</html>