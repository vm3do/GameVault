<?php
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../Classes/Game.php';

$games = Game::getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Listing</title>
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
    /* Carousel container */
    .carousel-container {
      position: relative;
      overflow: hidden;
    }
    /* Carousel */
    .carousel {
      display: flex;
      transition: transform 0.5s ease-in-out;
    }
    /* Carousel item */
    .carousel-item {
      flex: 0 0 100%;
      width: 100%;
    }
  </style>
</head>
<body class="bg-gray-900 text-white">
  <!-- Carousel Section -->
  <section class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Featured Games</h2>
    <!-- Carousel Container -->
    <div class="carousel-container rounded-lg overflow-hidden">
      <!-- Carousel -->
      <div class="carousel" id="carousel">
        <!-- Game 1 -->
        <div class="carousel-item">
          <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
            <img src="https://via.placeholder.com/1200x400" alt="Game Image" class="w-full h-64 sm:h-96 object-cover">
            <div class="p-6">
              <h3 class="text-2xl font-bold mb-2">Game Title 1</h3>
              <p class="text-gray-400 mb-4">Genre: Action | Release Date: 2023-01-01</p>
              <button class="bg-violet-accent px-6 py-3 rounded-lg hover:bg-violet-700 transition">
                Play Now
              </button>
            </div>
          </div>
        </div>
        <!-- Game 2 -->
        <div class="carousel-item">
          <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
            <img src="https://via.placeholder.com/1200x400" alt="Game Image" class="w-full h-64 sm:h-96 object-cover">
            <div class="p-6">
              <h3 class="text-2xl font-bold mb-2">Game Title 2</h3>
              <p class="text-gray-400 mb-4">Genre: Adventure | Release Date: 2023-02-01</p>
              <button class="bg-violet-accent px-6 py-3 rounded-lg hover:bg-violet-700 transition">
                Play Now
              </button>
            </div>
          </div>
        </div>
        <!-- Game 3 -->
        <div class="carousel-item">
          <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
            <img src="https://via.placeholder.com/1200x400" alt="Game Image" class="w-full h-64 sm:h-96 object-cover">
            <div class="p-6">
              <h3 class="text-2xl font-bold mb-2">Game Title 3</h3>
              <p class="text-gray-400 mb-4">Genre: RPG | Release Date: 2023-03-01</p>
              <button class="bg-violet-accent px-6 py-3 rounded-lg hover:bg-violet-700 transition">
                Play Now
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Carousel Buttons -->
      <button
        class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-gray-800 p-3 rounded-full hover:bg-gray-700 transition"
        onclick="prevSlide()"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      <button
        class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-gray-800 p-3 rounded-full hover:bg-gray-700 transition"
        onclick="nextSlide()"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>
  </section>

  <!-- Game Listing Section -->
  <section class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">All Games</h2>
    <!-- Game Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <?php foreach ($games as $game): ?>
        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
            <img src="<?= $game['background'] ?>" alt="Game Image" class="w-full h-48 object-cover">
            <div class="p-4">
                <h2 class="text-xl font-bold mb-2"><?= $game['title'] ?></h2>
                <p class="text-gray-400 mb-4">Genre: <?= $game['genre'] ?> | Release Date: <?= $game['release_date'] ?></p>
                <a href="gamedetails.php?game_id=<?= $game['id'] ?>" class="block bg-violet-accent w-full px-4 py-2 rounded-lg hover:bg-violet-700 transition text-center">
                    View Details
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
    <!--  -->
      <!-- Add more game cards here -->
    </div>
  </section>

  <!-- Carousel Script -->
  <script>
    const carousel = document.getElementById("carousel");
    let currentIndex = 0;

    function nextSlide() {
      currentIndex = (currentIndex + 1) % 3;
      updateCarousel();
    }

    function prevSlide() {
      currentIndex = (currentIndex - 1 + 3) % 3;
      updateCarousel();
    }

    function updateCarousel() {
      const offset = -currentIndex * 100;
      carousel.style.transform = `translateX(${offset}%)`;
    }
  </script>
</body>
</html>