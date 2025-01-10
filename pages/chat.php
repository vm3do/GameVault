<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header</title>
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
    /* Hide scrollbar */
    ::-webkit-scrollbar {
      display: none;
    }
    /* Smooth transition for mobile menu */
    .mobile-menu {
      transition: opacity 0.3s ease, transform 0.3s ease;
    }
  </style>
</head>
<body class="bg-gray-900 text-white">
  <!-- Header -->
  <header class="bg-gray-800 p-4 fixed w-full z-50">
    <div class="container mx-auto flex justify-between items-center">
      <!-- Logo -->
      <div class="text-xl font-bold text-violet-accent">VirtualWorld</div>
      <!-- Visible Links (Profile, Games, Dashboard for Admin) -->
      <div class="hidden md:flex space-x-4">
        <?php if (isset($_SESSION['admin_id']) || isset($_SESSION['user_id'])): ?>
          <a href="games.php" class="hover:text-violet-accent transition border-b-2 border-violet-accent">Games</a>
          <a href="profile.php" class="hover:text-violet-accent transition border-b-2 border-violet-accent">Profile</a>
          <?php if (isset($_SESSION['admin_id'])): ?>
            <a href="dashboard.php" class="hover:text-violet-accent transition border-b-2 border-violet-accent">Dashboard</a>
          <?php endif; ?>
        <?php endif; ?>
      </div>
      <!-- Hamburger Menu (for all screen sizes) -->
      <button class="text-violet-accent" onclick="toggleMenu()">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </header>

  <!-- Mobile Menu (hidden by default) -->
  <div class="mobile-menu fixed top-16 right-0 bg-gray-800 w-64 p-4 shadow-lg transform translate-x-full opacity-0 z-40" id="mobile-menu">
    <?php if (isset($_SESSION['admin_id'])): ?>
      <!-- Admin Links -->
      <a href="index.php" class="block py-2 hover:text-violet-accent transition">Home</a>
      <a href="games.php" class="block py-2 hover:text-violet-accent transition">Games</a>
      <a href="dashboard.php" class="block py-2 hover:text-violet-accent transition">Dashboard</a>
      <a href="profile.php" class="block py-2 hover:text-violet-accent transition">Profile</a>
      <a href="settings.php" class="block py-2 hover:text-violet-accent transition">Settings</a>
      <a href="favorites.php" class="block py-2 hover:text-violet-accent transition">Favorites</a>
      <a href="logout.php" class="block py-2 hover:text-violet-accent transition">Logout</a>
    <?php elseif (isset($_SESSION['user_id'])): ?>
      <!-- User Links -->
      <a href="index.php" class="block py-2 hover:text-violet-accent transition">Home</a>
      <a href="games.php" class="block py-2 hover:text-violet-accent transition">Games</a>
      <a href="profile.php" class="block py-2 hover:text-violet-accent transition">Profile</a>
      <a href="settings.php" class="block py-2 hover:text-violet-accent transition">Settings</a>
      <a href="favorites.php" class="block py-2 hover:text-violet-accent transition">Favorites</a>
      <a href="logout.php" class="block py-2 hover:text-violet-accent transition">Logout</a>
    <?php else: ?>
      <!-- Visitor Links -->
      <a href="index.php" class="block py-2 hover:text-violet-accent transition">Home</a>
      <a href="games.php" class="block py-2 hover:text-violet-accent transition">Games</a>
      <a href="login.php" class="block py-2 hover:text-violet-accent transition">Login</a>
      <a href="signup.php" class="block py-2 hover:text-violet-accent transition">Sign Up</a>
    <?php endif; ?>
  </div>

  <!-- Script for Mobile Menu Toggle -->
  <script>
    function toggleMenu() {
      const mobileMenu = document.getElementById("mobile-menu");
      mobileMenu.classList.toggle("translate-x-full");
      mobileMenu.classList.toggle("opacity-0");
    }
  </script>
</body>
</html>