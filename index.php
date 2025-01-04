<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
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
    /* GIF background container */
    .gif-container {
      position: relative;
      width: 100%;
      height: 100vh;
      overflow: hidden;
    }
    /* GIF background */
    .gif-container img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
    }
    /* Darker overlay */
    .gif-container::after {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(11, 2, 26, 0.7); /* Darker overlay */
    }
  </style>
</head>
<body class="text-white bg-gray-900">
  <!-- Header -->
  <header class="fixed z-50 w-full bg-transparent backdrop-blur-sm">
    <div class="container flex items-center justify-between p-4 mx-auto">
      <!-- Logo -->
      <div class="text-xl font-bold text-violet-accent">VirtualWorld</div>
      <!-- CTA Buttons -->
      <div class="space-x-4">
        <button class="px-4 py-2 transition rounded-lg bg-violet-accent hover:bg-violet-700" id="toLogin">Login</button>
        <button class="px-4 py-2 transition bg-gray-700 rounded-lg hover:bg-gray-600" id="toSignup">Sign Up</button>
      </div>
    </div>
  </header>

  <!-- GIF Background Section -->
  <div class="gif-container">
    <!-- GIF -->
    <img src="https://media.giphy.com/media/rR7wrU76zfWnf7xBDR/giphy.gif?cid=790b76115u0ccuejezqlkpkyg3qbxpyzpujgx7681ny45osq&ep=v1_gifs_search&rid=giphy.gif&ct=g" alt="Gaming Background">
    <!-- Darker Overlay -->
    <div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-70"></div>
    <!-- Centered Text (Above the overlay) -->
    <div class="absolute z-10 text-center text-white transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
      <h1 class="mb-6 text-6xl font-bold">Welcome to the Virtual World</h1>
      <!-- Explore CTA Button -->
      <button class="px-6 py-3 text-lg transition rounded-lg bg-violet-accent hover:bg-violet-700" id="toGames">
        Explore Games
      </button>
    </div>
  </div>

  <!-- Content Section (Optional) -->
  <section class="py-16 bg-gray-900">
    <div class="container mx-auto text-center">
      <h2 class="mb-4 text-3xl font-bold">Discover More</h2>
      <p class="text-gray-400">Join our community and dive into the ultimate gaming experience.</p>
    </div>
  </section>
  <script>
    document.getElementById("toLogin").addEventListener("click", function() {
      window.location.href = "login.php";
    });
    document.getElementById("toSignup").addEventListener("click", function() {
      window.location.href = "signup.php";
    });
    document.getElementById("toGames").addEventListener("click", function() {
      window.location.href = "games.php";
    });
    
  </script>
</body>
</html>