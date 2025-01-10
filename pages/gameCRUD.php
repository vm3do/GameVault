<?php
  require_once __DIR__ . '/../Config/Db.php';
  require __DIR__ . '/../Classes/Game.php';
  
  $db = new Database();
  $pdo = $db->connect();

// Add Game ---------------------------------------------------------

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['addGame'])) {
          $title = $_POST['gameTitle'];
          $description = $_POST['description'];
          $genre = $_POST['gameGenre'];
          $releaseDate = $_POST['releaseDate'];
          $background = $_POST['background'];
          $scrshot1 = $_POST['scrshot1'];
          $scrshot2 = $_POST['scrshot2'];
          $scrshot3 = $_POST['scrshot3'];
          $rating = $_POST['rating'];
      $game = new Game($pdo);
    $result =  $game->addGame($title, $description, $genre, $releaseDate, $background, $scrshot1, $scrshot2, $scrshot3, $rating);
    if($result){
      header('Location: ' . $_SERVER['PHP_SELF']);
      exit;
    }
    else{
      header('Location: dashboard.php?error');
    }
  }
}
// --------------------------------------------------------------------
// Delete Game ---------------------------------------------------------
if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] === 'deleteGame'){
  $gameId = $_GET['Id'];
  $game = new Game($pdo);
  $result = $game->deleteGame($gameId);
  if ($result){
    header('Location: ' . $_SERVER['PHP_SELF']);
  } 
  else {
    echo "game not deleted";
  }
}
// --------------------------------------------------------------------
// Update Game ---------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST['updateGame'])){
    $gameId = $_POST['gameId'];
    $new_title = $_POST['new_title'];
    $new_description = $_POST['new_description'];
    $new_genre = $_POST['new_genre'];
    $new_releaseDate = $_POST['new_releaseDate'];
    $new_background = $_POST['new_background'];
    $new_scrshot1 = $_POST['new_scrshot1'];
    $new_scrshot2 = $_POST['new_scrshot2'];
    $new_scrshot3 = $_POST['new_scrshot3'];
    $new_rating = $_POST['new_rating'];
    echo   $gameId;
    $game = new Game($pdo);  
    $result = $game->updateGame($gameId, $new_title, $new_description, $new_genre, $new_releaseDate, $new_background, $new_scrshot1, $new_scrshot2, $new_scrshot3, $new_rating);
    if ($result){
      header('Location: ' . $_SERVER['PHP_SELF']);
    }
    else {
      echo "game not updated";
    }
  }
}

