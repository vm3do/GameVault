<?php 
  session_start(); 

  require '../Classes/Game.php'; 
  require '../Classes/Users.php';


  if(!isset($_SESSION['admin_id']) && !isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
  }

if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}

$db = new Database();
$pdo = $db->connect();
$user = new Users($pdo);
$Game = new Game($pdo);

if(!isset($_GET['game_id']) || $_GET['game_id'] === "" ){
  header('Location: games.php');
  exit();
}
$game_id = $_GET['game_id'] ?? null;
$gameDetails = $Game->getGameById($game_id);

if (isset($_GET['add_library']) && (isset($_SESSION['user_id']) || isset($_SESSION['admin_id']))) {

    $game_filter = filter_var($_GET['add_library'], FILTER_SANITIZE_NUMBER_INT);

    if ($game_id) {

        $add = $user->addToLibrary($user_id, $game_id);
        
        if ($add) {
          header('Location: gamedetails.php?game_id=' . $game_id . '&status=Game-added');
            exit();
        } else {
          header('Location: gamedetails.php?game_id=' . $game_id . '&status=Game-Not-added');
          exit();
        }
    } 
}
else if (isset($_GET['add_favorate']) && (isset($_SESSION['user_id']) || isset($_SESSION['admin_id']))) {

    $game_filter = filter_var($_GET['add_favorate'], FILTER_SANITIZE_NUMBER_INT);

    if ($game_id) {

        $add = $user->addToFavorite($user_id, $game_id);
        
        if ($add) {
          header('Location: gamedetails.php?game_id=' . $game_id . '&status=Game-added');
            exit();
        } else {
          header('Location: gamedetails.php?game_id=' . $game_id . '&status=Game-Not-added');
          exit();
        }
    } 
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Details</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/style.css">

</head>
<body class="bg-gray-900 text-white">
  <!-- Game Details Container -->
  <div class="flex flex-col min-h-screen p-6">
    <!-- Header -->
    <header class="bg-gray-800 p-4 rounded-lg mb-6">
      <h1 class="text-2xl font-bold">Game Details</h1>
    </header>
    <!-- Game Information Section -->

    <section class="bg-gray-800 p-6 rounded-lg mb-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Game Image -->
        <?php foreach($gameDetails as $game): ?>
        <div>
          <img src="<?php echo $game['background_url'] ?>" alt="Game Image" class="w-full rounded-lg">
        </div>
        <!-- Game Details -->
        <div>
        
          <h2 class="text-2xl font-bold"><?php echo $game['title'] ?></h2>
          <p class="text-gray-400">Release Date: <?php echo $game['release_date']  ?></p>
          <p class="text-gray-400">Genre:  <?php echo $game['genre']  ?></p>
          <p class="text-gray-400">Developer: Game Studio</p>
          <p class="text-gray-400">Rating: ⭐⭐⭐⭐☆</p>
          <p class="text-gray-400 mt-4">
          <?php echo $game['description']  ?>
          </p>
          <?php endforeach; ?>
          <!-- Buttons -->
          <div class="mt-6 flex flex-wrap gap-2">
            <!-- Add to Library (Primary) -->
          <form action="gamedetails.php" method="GET">
            <input type="hidden" name='add_library' value="<?= $game_id; ?>">
            <input type="hidden" name='game_id' value="<?= $game_id; ?>">
            <button type="submit" class="bg-violet-accent px-4 py-2 rounded hover:bg-violet-700 transition">
              Add to Library 
            </button>
          </form> 
            <!-- Add to Favorites (Secondary) -->

          <form action="gamedetails.php" method="GET">
            <input type="hidden" name='add_favorate' value="<?= $game_id; ?>">
            <input type="hidden" name='game_id' value="<?= $game_id; ?>">
            <button type="submit" class="bg-gray-700 px-4 py-2 rounded hover:bg-gray-600 transition">
              Add to Favorites
            </button>
          </form> 
          
            <!-- Access Chat (Icon) -->
            <form action="chat.php" method="POST">
                <input type="hidden" name='user_id' value= "<?= $user_id; ?>">
                <input type="hidden" name='game_id' value= "<?= $game_id; ?>" >
                <button type="submit" name="chat" class="bg-gray-700 p-2 rounded hover:bg-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                </button>
            </form>

              
            </a>
          </div>
        </div>
      </div>
    </section>
    <!-- Screenshots Section -->
    <section class="bg-gray-800 p-6 rounded-lg mb-6">
      <h2 class="text-2xl font-bold mb-4">Screenshots</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <img src="https://via.placeholder.com/400x200" alt="Screenshot 1" class="w-full rounded-lg">
        <img src="https://via.placeholder.com/400x200" alt="Screenshot 2" class="w-full rounded-lg">
        <img src="https://via.placeholder.com/400x200" alt="Screenshot 3" class="w-full rounded-lg">
      </div>
    </section>
    <!-- Add Comment and Rating Section -->
    <section class="bg-gray-800 p-6 rounded-lg mb-6">
      <h2 class="text-2xl font-bold mb-4">Leave a Review</h2>
      <!-- Rating Input -->
      <div class="mb-4">
        <label class="block text-gray-400 mb-2">Your Rating:</label>
        <div class="flex space-x-2">
          <button class="text-yellow-400 hover:text-yellow-300">⭐</button>
          <button class="text-yellow-400 hover:text-yellow-300">⭐</button>
          <button class="text-yellow-400 hover:text-yellow-300">⭐</button>
          <button class="text-yellow-400 hover:text-yellow-300">⭐</button>
          <button class="text-yellow-400 hover:text-yellow-300">⭐</button>
        </div>
      </div>
      <!-- Comment Input -->
      <form>
        <textarea
          placeholder="Write your comment..."
          class="w-full bg-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
          rows="4"
        ></textarea>
        <button
          type="submit"
          class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition mt-4"
        >
          Submit Review
        </button>
      </form>
    </section>
    <!-- Reviews Section -->
    <section class="bg-gray-800 p-6 rounded-lg">
      <h2 class="text-2xl font-bold mb-4">Reviews</h2>
      <!-- Review 1 -->
      <div class="bg-gray-700 p-4 rounded-lg mb-4">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
            <span class="text-sm">U</span>
          </div>
          <div>
            <p class="font-bold">Username</p>
            <p class="text-gray-400">⭐⭐⭐⭐☆</p>
          </div>
        </div>
        <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>
      <!-- Review 2 -->
      <div class="bg-gray-700 p-4 rounded-lg mb-4">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
            <span class="text-sm">U</span>
          </div>
          <div>
            <p class="font-bold">Username</p>
            <p class="text-gray-400">⭐⭐⭐☆☆</p>
          </div>
        </div>
        <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>
      <!-- Add more reviews here -->
    </section>
  </div>
</body>
</html>