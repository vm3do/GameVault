<?php

include __DIR__ . '../includes/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="css/style.css"/>
</head>
<body class="bg-gray-900 text-white">

  <div class="gif-container">
    <!-- GIF -->
    <img src="https://media.giphy.com/media/rR7wrU76zfWnf7xBDR/giphy.gif?cid=790b76115u0ccuejezqlkpkyg3qbxpyzpujgx7681ny45osq&ep=v1_gifs_search&rid=giphy.gif&ct=g" alt="Gaming Background">

    <div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-70"></div>

    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center text-white z-10">
      <h1 class="text-6xl font-bold mb-6">Welcome to the Virtual World</h1>

      <a href="pages/games.php" class="bg-violet-accent px-6 py-3 rounded-lg hover:bg-violet-700 transition text-lg">Explore Games</a>
    </div>
  </div>
</body>
</html>