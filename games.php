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
<body class="text-white bg-gray-900">
  <!-- Header -->
  <header class="p-4 bg-gray-800">
    <div class="container flex items-center justify-between mx-auto">
      <!-- Logo -->
      <div class="text-xl font-bold text-violet-accent">VirtualWorld</div>
      <!-- Navigation -->
      <nav class="space-x-4">
        <a href="#" class="transition hover:text-violet-accent">Home</a>
        <a href="#" class="transition hover:text-violet-accent">Library</a>
        <a href="#" class="transition hover:text-violet-accent">Profile</a>
      </nav>
    </div>
  </header>

  <!-- Carousel Section -->
  <section class="container p-6 mx-auto">
    <h2 class="mb-4 text-2xl font-bold">Featured Games</h2>
    <!-- Carousel Container -->
    <div class="overflow-hidden rounded-lg carousel-container">
      <!-- Carousel -->
      <div class="carousel" id="carousel">
        <!-- Game 1 -->
        <div class="carousel-item">
          <div class="overflow-hidden bg-gray-800 rounded-lg shadow-lg">
            <img src="https://via.placeholder.com/1200x400" alt="Game Image" class="object-cover w-full h-64 sm:h-96">
            <div class="p-6">
              <h3 class="mb-2 text-2xl font-bold">Game Title 1</h3>
              <p class="mb-4 text-gray-400">Genre: Action | Release Date: 2023-01-01</p>
              <button class="px-6 py-3 transition rounded-lg bg-violet-accent hover:bg-violet-700">
                Play Now
              </button>
            </div>
          </div>
        </div>
        <!-- Game 2 -->
        <div class="carousel-item">
          <div class="overflow-hidden bg-gray-800 rounded-lg shadow-lg">
            <img src="https://via.placeholder.com/1200x400" alt="Game Image" class="object-cover w-full h-64 sm:h-96">
            <div class="p-6">
              <h3 class="mb-2 text-2xl font-bold">Game Title 2</h3>
              <p class="mb-4 text-gray-400">Genre: Adventure | Release Date: 2023-02-01</p>
              <button class="px-6 py-3 transition rounded-lg bg-violet-accent hover:bg-violet-700">
                Play Now
              </button>
            </div>
          </div>
        </div>
        <!-- Game 3 -->
        <div class="carousel-item">
          <div class="overflow-hidden bg-gray-800 rounded-lg shadow-lg">
            <img src="https://via.placeholder.com/1200x400" alt="Game Image" class="object-cover w-full h-64 sm:h-96">
            <div class="p-6">
              <h3 class="mb-2 text-2xl font-bold">Game Title 3</h3>
              <p class="mb-4 text-gray-400">Genre: RPG | Release Date: 2023-03-01</p>
              <button class="px-6 py-3 transition rounded-lg bg-violet-accent hover:bg-violet-700">
                Play Now
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Carousel Buttons -->
      <button
        class="absolute p-3 transition transform -translate-y-1/2 bg-gray-800 rounded-full top-1/2 left-4 hover:bg-gray-700"
        onclick="prevSlide()"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      <button
        class="absolute p-3 transition transform -translate-y-1/2 bg-gray-800 rounded-full top-1/2 right-4 hover:bg-gray-700"
        onclick="nextSlide()"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>
  </section>

  <!-- Game Listing Section -->
  <section class="container p-6 mx-auto">
    <h2 class="mb-6 text-2xl font-bold">All Games</h2>
    <!-- Game Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
      <!-- Game Card 1 -->
      <div class="overflow-hidden bg-gray-800 rounded-lg shadow-lg">
        <img src="https://via.placeholder.com/400x200" alt="Game Image" class="object-cover w-full h-48">
        <div class="p-4">
          <h2 class="mb-2 text-xl font-bold">Game Title 1</h2>
          <p class="mb-4 text-gray-400">Genre: Action | Release Date: 2023-01-01</p>
          <button class="w-full px-4 py-2 transition rounded-lg bg-violet-accent hover:bg-violet-700">
            View Details
          </button>
        </div>
      </div>
      <!-- Game Card 2 -->
      <div class="overflow-hidden bg-gray-800 rounded-lg shadow-lg">
        <img src="https://via.placeholder.com/400x200" alt="Game Image" class="object-cover w-full h-48">
        <div class="p-4">
          <h2 class="mb-2 text-xl font-bold">Game Title 2</h2>
          <p class="mb-4 text-gray-400">Genre: Adventure | Release Date: 2023-02-01</p>
          <button class="w-full px-4 py-2 transition rounded-lg bg-violet-accent hover:bg-violet-700">
            View Details
          </button>
        </div>
      </div>
      <!-- Add more game cards here -->
    </div>
  </section>

  <!-- Carousel Script -->
  <script>
    const carousel = document.getElementById("carousel");
    let currentIndex = 0;

    function nextSlide() {
      currentIndex = (currentIndex + 1) % 3; // Adjust based on the number of slides
      updateCarousel();
    }

    function prevSlide() {
      currentIndex = (currentIndex - 1 + 3) % 3; // Adjust based on the number of slides
      updateCarousel();
    }

    function updateCarousel() {
      const offset = -currentIndex * 100;
      carousel.style.transform = `translateX(${offset}%)`;
    }
  </script>
</body>
</html>