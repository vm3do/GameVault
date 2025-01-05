<?php 
require_once 'Config/db.php';


Class Game {
  private $connection;
  public function __construct($conn) {
    $this->connection = $conn;
  }
  
  public function addGame($apiId, $title, $description, $imageURL) {
    try{
        $sql = "INSERT INTO games (api_id, title, description, image_url) VALUES (:api_id, :title, :description, :image_url)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['api_id' => $apiId, 'title' => $title, 'description' => $description, 'image_url' => $imageURL]);
        return true;
    }
    catch(PDOException $e) {
       die("Erreur : " . $e->getMessage());
       return false;
    }
  }

  public function getAllGames() {
    try{
        $sql = "SELECT * FROM games";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      catch(PDOException $e) {
        die("Erreur : " . $e->getMessage());
        return false;
      }
  }

  public function deleteGame($id) {
    try{
        $sql = "DELETE FROM games WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
      }
      catch(PDOException $e) {
        die("Erreur : " . $e->getMessage());
        return false;
      }
  }

  public function updateGame($gameId,$newApiId, $newTitle, $newDescription, $newImageURL) {
    try{
        $up_sql = "UPDATE games SET api_id = :api_id, title = :title, description = :description, image_url = :image_url WHERE id = :id";
        $up_stmt = $this->connection->prepare($up_sql);
        $up_stmt->execute(['id' => $gameId, 'api_id' => $newApiId, 'title' => $newTitle, 'description' => $newDescription, 'image_url' => $newImageURL]);
        return true;
    }
    catch(PDOException $e) {
      die("Erreur : " . $e->getMessage());
      return false;
    }

  }

  public function getGameById($id) {
    try{
        $sql = "SELECT * FROM games WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
      }
      catch(PDOException $e) {
        die("Erreur : " . $e->getMessage());
        return false;
      }
  }

}

$db = new Database();
$conn = $db->get_connection();
// Add Game ---------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if( isset($_POST['addGame'])){
    $apiId = $_POST['apiId'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imageURL = $_POST['imageURL'];
    $game = new Game($conn);
    $result = $game->addGame($apiId, $title, $description, $imageURL);
  
    if ($result) {
      header('Location: ' . $_SERVER['PHP_SELF']);
      echo "game added successfully";
    } else {
      echo "game not added";
    }

  }
}
// --------------------------------------------------------------------
// Delete Game ---------------------------------------------------------
if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] === 'deleteGame'){
  $gameId = $_GET['Id'];
  $del_sql = "DELETE FROM games WHERE id = :id";
  $del_stmt = $conn->prepare($del_sql);
  $del_stmt->execute(['id' => $gameId]);

  if ($del_stmt){
    header('Location: ' . $_SERVER['PHP_SELF']);
  } 
}
// --------------------------------------------------------------------
// Update Game ---------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST['updateGame'])){
    $gameId = $_POST['gameId'];
    $new_apiId = $_POST['new_apiId'];
    $new_title = $_POST['new_title'];
    $new_description = $_POST['new_description'];
    $new_imageURL = $_POST['new_imageURL'];

    $game = new Game($conn);  
    $result = $game->updateGame($gameId, $new_apiId, $new_title, $new_description, $new_imageURL);
    if ($result) {
      header('Location: ' . $_SERVER['PHP_SELF']);
    }
  }
}
// --------------------------------------------------------------------
