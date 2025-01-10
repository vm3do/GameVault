<?php
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../Classes/User.php';

$db = new Database();
$pdo = $db->connect();

if(isset($_SESSION['admin_id']) || isset($_SESSION['user_id'])){
  if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
  }
  if(isset($_SESSION['admin_id'])){
    $user_id = $_SESSION['user_id'];
  }
  $user = new User($pdo);
  $info = $user->getInfo($user_id);
} else {
  header('Location: login.php');
  exit();
}

if(isset($_GET['update'])){
  $user->updateInfo($_GET['update'], $_GET['username'], $_GET['email'], $_GET['password'] );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings</title>
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
    /* Hide default file input */
    .file-input {
      display: none;
    }
    /* Custom file input button */
    .file-input-label {
      background-color: #7c3aed;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .file-input-label:hover {
      background-color: #6d28d9;
    }
  </style>
</head>
<body class="bg-gray-900 text-white">
  <!-- Settings Container -->
  <div class="flex flex-col min-h-screen p-6">
    <!-- Header -->
    <header class="bg-gray-800 p-4 rounded-lg mb-6">
      <h1 class="text-2xl font-bold">Settings</h1>
    </header>
    <!-- Settings Form -->
    <section class="bg-gray-800 p-6 rounded-lg mb-6">
      <form action="settings.php" method="GET" class="space-y-6">
        <!-- Profile Picture -->
        <div>
          <label class="block text-gray-400 mb-2">Profile Picture</label>
          <div class="flex items-center space-x-4">
            <!-- Profile Picture Circle -->
            <div class="w-20 h-20 rounded-full bg-gray-700 overflow-hidden">
              <img
                src="https://via.placeholder.com/150"
                alt="Profile Picture"
                class="w-full h-full object-cover"
              />
            </div>
            <!-- File Input -->
            <div>
              <input
                type="file"
                id="file-input"
                class="file-input"
                accept="image/*"
              />
              <label for="file-input" class="file-input-label">
                Upload Image
              </label>
            </div>
          </div>
        </div>
        <!-- Name -->
        <div>
          <label class="block text-gray-400 mb-2">Name</label>
          <input
            type="text"
            name="username"
            value="<?= $info['username']?>"
            class="w-full bg-gray-700 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
          />
        </div>
        <!-- Email -->
        <div>
          <label class="block text-gray-400 mb-2">Email</label>
          <input
            type="email"
            name="email"
            value="<?= $info['email']?>"
            class="w-full bg-gray-700 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
          />
        </div>
        <!-- Password -->
        <div>
          <label class="block text-gray-400 mb-2">Password</label>
          <input
            type="password"
            name="password"
            placeholder="Enter new password"
            class="w-full bg-gray-700 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
          />
        </div>
        <!-- Save Button -->
        <button
          type="submit"
          name="update"
          value="<?= $info['id']?>"
          class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition"
        >
          Save Changes
        </button>
      </form>
    </section>
  </div>
</body>
</html>