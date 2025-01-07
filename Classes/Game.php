<?php 

class Game {
  private $title;
  private $description;
  private $genre;
  private $releaseDate;
  private $background;  
  private $scrshot1; 
  private $scrshot2;   
  private $scrshot3;  
  private $rating;
  private $pdo;

  public function __construct($conn) {
      $this->pdo = $conn;
    }
  public function addGame($title, $description, $genre, $releaseDate, $background, $scrshot1, $scrshot2, $scrshot3, $rating) {
    try{
      $sql = "INSERT INTO games (title, description, genre, release_date, background_url, screenshot1_url, screenshot2_url, screenshot3_url, rating)
      VALUES (:title, :description, :genre, :release_date, :background_url, :screenshot1_url, :screenshot2_url, :screenshot3_url, :rating)";
      $stmt = $this->pdo->prepare($sql);

      $stmt->execute([
        'title' => $title,
        'description' => $description,
        'genre' => $genre,
        'release_date' => $releaseDate,
        'background_url' => $background,
        'screenshot1_url' => $scrshot1,
        'screenshot2_url' => $scrshot2,
        'screenshot3_url' => $scrshot3,
        'rating' => $rating
      ]);
      return true;
    }
    catch(PDOException $e){
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  public function updateGame($gameId, $new_title, $new_description, $new_genre, $new_releaseDate, $new_background, $new_scrshot1, $new_scrshot2, $new_scrshot3, $new_rating) {
    try {
      $sql = "UPDATE games SET 
                    title = :title, 
                    description = :description, 
                    genre = :genre, 
                    release_date = :release_date, 
                    background_url = :background_url, 
                    screenshot1_url = :screenshot1_url, 
                    screenshot2_url = :screenshot2_url, 
                    screenshot3_url = :screenshot3_url, 
                    rating = :rating
            WHERE id = :id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([
      'id' => $gameId,
      'title' => $new_title,
      'description' => $new_description,
      'genre' => $new_genre,
      'release_date' => $new_releaseDate,
      'background_url' => $new_background,
      'screenshot1_url' => $new_scrshot1,
      'screenshot2_url' => $new_scrshot2,
      'screenshot3_url' => $new_scrshot3,
      'rating' => $new_rating,

      ]);
      return true;
    }
    catch(PDOException $e) {
      die("Erreur : " . $e->getMessage());
      return false;
    }
  }

  public function deleteGame($id) {
    try{
        $sql = "DELETE FROM games WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
      }
      catch(PDOException $e) {
        die("Erreur : " . $e->getMessage());
        return false;
      }
  }

  public static function getAllGames() {
    try{
      $db = new Database();
      $conn = $db->get_connection();
      $sql = "SELECT * FROM games";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e) {
      die("Erreur : " . $e->getMessage());
      return false;
    }
  }

  public function getGameById($id) {
    try{
      $sql = "SELECT * FROM games WHERE id = :id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([':id' => $id]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e) {
      die("Erreur : " . $e->getMessage());
      return false;
    }  
  }

  public function chats() {
    try{
        $sql = "SELECT u.username, c.message, c.time FROM chats c JOIN users u ON c.user_id = u.id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }
      catch (PDOException $e) {
          die("Erreur : " . $e->getMessage());
          return false;
      }
  }
}

