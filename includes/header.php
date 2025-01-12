<?php
ob_start();
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

        .bg-violet-accent {
            background-color: #7c3aed;
        }

        .text-violet-accent {
            color: #7c3aed;
        }

        .border-violet-accent {
            border-color: #7c3aed;
        }


        ::-webkit-scrollbar {
            display: none;
        }


        .mobile-menu {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .header-padding {
            padding: 1rem;

        }

        .link-padding {
            padding: 0.5rem;

        }

        .link-hover-effect {
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .link-hover-effect:hover {
            color: #7c3aed;
            background-color: rgba(124, 58, 237, 0.1);
        }
    </style>
</head>

<body class="bg-gray-900 text-white">
    <!-- Header -->
    <header class="bg-gray-800 header-padding w-full">
    <div class="container mx-auto flex justify-center items-center">
        <!-- Logo -->
        <div class="text-xl font-bold text-violet-accent mr-auto">GameVault</div>
        
        <!-- Visible Links (Profile, Games, Dashboard for Admin) -->
        <div class="hidden md:flex space-x-4 mx-auto">
            <?php if (isset($_SESSION['admin_id']) || isset($_SESSION['user_id'])): ?>
                <a href="/gamevault/pages/games.php"
                    class="link-padding link-hover-effect hover:text-violet-accent transition border-b-2 border-violet-accent">Games</a>
                <a href="/gamevault/pages/profile.php"
                    class="link-padding link-hover-effect hover:text-violet-accent transition border-b-2 border-violet-accent">Profile</a>
                <?php if (isset($_SESSION['admin_id'])): ?>
                    <a href="/gamevault/pages/dashboard.php"
                        class="link-padding link-hover-effect hover:text-violet-accent transition border-b-2 border-violet-accent">Dashboard</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        
        <!-- Sign Up and Login Links -->
        <div class="hidden md:flex space-x-24 ml-auto">
            <?php if (!isset($_SESSION['admin_id']) && !isset($_SESSION['user_id'])): ?>
                <a href="/gamevault/pages/signup.php"
                    class="link-padding link-hover-effect hover:text-violet-accent transition border-b-2 border-violet-accent">Sign Up</a>
                <a href="/gamevault/pages/login.php"
                    class="link-padding link-hover-effect hover:text-violet-accent transition border-b-2 border-violet-accent ">Login</a>
            <?php endif; ?>
        </div>
        
        <!-- Hamburger Menu (for all screen sizes) -->
        <button class="text-violet-accent ml-4" onclick="toggleMenu()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
</header>

    <!-- Mobile Menu (hidden by default) -->
    <div class="mobile-menu fixed top-16 right-0 bg-gray-800 w-64 p-4 shadow-lg transform translate-x-full opacity-0 z-40"
        id="mobile-menu">
        <?php if (isset($_SESSION['admin_id'])): ?>
            <!-- Admin Links -->
            <a href="/gamevault/index.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Home</a>
            <a href="/gamevault/pages/games.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Games</a>
            <a href="/gamevault/pages/dashboard.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Dashboard</a>
            <a href="/gamevault/pages/profile.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Profile</a>
            <a href="/gamevault/pages/settings.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Settings</a>
            <a href="/gamevault/pages/favorite.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Favorites</a>
            <a href="/gamevault/pages/logout.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Logout</a>
        <?php elseif (isset($_SESSION['user_id'])): ?>
            <!-- User Links -->
            <a href="/gamevault/index.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Home</a>
            <a href="/gamevault/pages/games.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Games</a>
            <a href="/gamevault/pages/profile.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Profile</a>
            <a href="/gamevault/pages/settings.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Settings</a>
            <a href="/gamevault/pages/favorites.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Favorites</a>
            <a href="/gamevault/pages/logout.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Logout</a>
        <?php else: ?>
            <!-- Visitor Links -->
            <a href="/gamevault/index.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Home</a>
            <a href="/gamevault/pages/games.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Games</a>
            <a href="/gamevault/pages/login.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Login</a>
            <a href="/gamevault/pages/signup.php" class="block py-2 link-hover-effect hover:text-violet-accent transition">Sign Up</a>
        <?php endif;?>
    </div>

    <script>
        function toggleMenu() {
            const mobileMenu = document.getElementById("mobile-menu");
            mobileMenu.classList.toggle("translate-x-full");
            mobileMenu.classList.toggle("opacity-0");
        }
    </script>
</body>

</html>