<?php
include __DIR__ .'/../includes/header.php';
require_once __DIR__ . '/../Classes/User.php';
require_once __DIR__ . '/../Classes/Game.php';

if (!isset($_SESSION['admin_id']) && !isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
}
if (isset($_SESSION['admin_id'])) {
  $user_id = $_SESSION['admin_id'];
}

$db = new Database();
$pdo = $db->connect();
$user = new User($pdo);
$Game = new Game($pdo);

if (!isset($_GET['game_id']) || $_GET['game_id'] === "") {
  header('Location: games.php');
  exit();
}
$game_id = $_GET['game_id'] ?? null;
$gameDetails = $Game->getGameById($game_id);

$rating = $Game->getRating($game_id);
$reviews = $Game->getReviews(10);

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
} else if (isset($_GET['add_favorate']) && (isset($_SESSION['user_id']) || isset($_SESSION['admin_id']))) {

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

if(isset($_GET['submit'])){
  $Game->addReview($user_id, $game_id, $_GET['rating'] ?? null, $_GET['comment'] ?? null);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Details</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
  </style>
</head>

<body class="bg-gray-900 text-white">
  <!-- Game Details Container -->
  <div class="flex flex-col min-h-screen p-6">
    <!-- Header -->
    <div class="bg-gray-800 p-4 rounded-lg mb-6">
      <h1 class="text-2xl font-bold">Game Details</h1>
    </div>
    <!-- Game Information Section -->
    <section class="bg-gray-800 p-6 rounded-lg mb-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Game Image -->
        <div>
          <img src="<?= $gameDetails['background'] ?>" alt="Game Image" class="w-full rounded-lg">
        </div>
        <!-- Game Details -->
        <div>
          <h2 class="text-2xl font-bold"><?= $gameDetails['title'] ?></h2>
          <p class="text-gray-400">Release Date: <?= $gameDetails['release_date'] ?></p>
          <p class="text-gray-400">Genre: <?= $gameDetails['genre'] ?></p>
          <!-- <p class="text-gray-400">Developer: Game Studio</p> -->
          <p class="text-gray-400">Rating: 
            <?php $i = 0;
                  while ($i < $rating['average']){
                    echo '<i class="fas fa-star text-yellow-400"></i>';
                    $i++;
                  }
                  $j=0;
                  $diff = 5 - $rating['average'];
                  while ($j < $diff){
                    echo '<i class="fas fa-star text-gray-400"></i>';
                    $j++;
                  }?>
          </p>
          <p class="text-gray-400 mt-4">
            <?= $gameDetails['description'] ?>
          </p>
          <!-- Buttons -->
          <div class="mt-6 flex flex-wrap gap-2">
            <!-- Add to Library (Primary) -->
            <form action="gamedetails.php" method="GET">
              <!-- <input type="hidden" name='add_library' value="<?= $game_id; ?>"> -->
              <input type="hidden" name='game_id' value="<?= $game_id; ?>">
              <button type="submit" name='add_library'
                class="bg-violet-accent px-4 py-2 rounded hover:bg-violet-700 transition">
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

      <!-- Comment Input -->
      <form action="gamedetails.php" method="GET">
        <div class="mb-4">
          <label class="block text-gray-400 mb-2">Your Rating:</label>
          <div class="flex space-x-2">
            <input type="radio" id="star5" name="rating" value="5" class="hidden peer">
            <label for="star5"
              class="text-4xl cursor-pointer text-gray-300 peer-checked:text-yellow-400 transition duration-300">★</label>

            <input type="radio" id="star4" name="rating" value="4" class="hidden peer">
            <label for="star4"
              class="text-4xl cursor-pointer text-gray-300 peer-checked:text-yellow-400 transition duration-300">★</label>

            <input type="radio" id="star3" name="rating" value="3" class="hidden peer">
            <label for="star3"
              class="text-4xl cursor-pointer text-gray-300 peer-checked:text-yellow-400 transition duration-300">★</label>

            <input type="radio" id="star2" name="rating" value="2" class="hidden peer">
            <label for="star2"
              class="text-4xl cursor-pointer text-gray-300 peer-checked:text-yellow-400 transition duration-300">★</label>

            <input type="radio" id="star1" name="rating" value="1" class="hidden peer">
            <label for="star1"
              class="text-4xl cursor-pointer text-gray-300 peer-checked:text-yellow-400 transition duration-300">★</label>
          </div>
        </div>
        <textarea name="comment" placeholder="Write your comment..."
          class="w-full bg-gray-700 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
          rows="4"></textarea>
          <input type="hidden" name="user_id" value="<?= $user_id ?>">
          <input type="hidden" name="game_id" value="<?= $game_id ?>">
        <button type="submit" name="submit" class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition mt-4">
          Submit Review
        </button>
      </form>
    </section>
    <!-- Reviews Section -->
    <section class="bg-gray-800 p-6 rounded-lg">
      <h2 class="text-2xl font-bold mb-4">Reviews</h2>

      <?php foreach($reviews as $review): ?>
          <div class="bg-gray-700 p-4 rounded-lg mb-4">
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center">
              <span class="text-sm">U</span>
            </div>
            <div>
              <p class="font-bold"><?= $review['username']?></p>
              <?php $i = 0;
                  while ($i < $review['rating']){
                    echo '<i class="fas fa-star text-yellow-400"></i>';
                    $i++;
                  }
                  $j=0;
                  $diff = 5 - $review['rating'];
                  while ($j < $diff){
                    echo '<i class="fas fa-star text-gray-400"></i>';
                    $j++;
                  }?>
              </p>
            </div>
          </div>
          <p class="mt-2"><?= $review['comment']?></p>
        </div>
      <?php endforeach; ?>

    </section>
  </div>
</body>

</html>