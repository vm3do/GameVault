<?php
    require_once '../Config/db.php';

class Users { 
    private $connection;
    public function __construct($conn) {
      $this->connection = $conn;
    }
  public function addUser($username, $email, $password) {
    $sql = "SELECT id FROM users WHERE username = :username";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute(['username' => $username]);

    if ($stmt->rowCount() > 0) {
        return ['message' => 'Username already taken!'];
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, password, role, status) VALUES (:username, :email, :password, 'user', 'active') ";
    $stmt = $this->connection->prepare($sql);
      try {
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $hashedPassword]);
        return true;
      } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return false; 
      }
      return $stmt;
  }

  public function loginUser($email, $password) {
      try {
          $sql = "SELECT id, email, password, role FROM users WHERE email = :email";
          $stmt = $this->connection->prepare($sql);
          $stmt->execute(['email' => $email]);
          
          if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $row['password'])) {
                    return ['verify' => true, 'user_id' => $row['id'], 'role' => $row['role']];
                } else {
                    return ['verify' => false, 'message' => "Password incorrect"];
                }
        } else {
            return ['verify' => false, 'message' => "This user is not found"];
        }
    } catch(Exception $e) {
        return ['message' => "Error: " . $e->getMessage()];
      }
  }
  public function getAllUsers(){
    try{
        $sql = "SELECT id, username, email, role, status FROM users WHERE role = 'user'";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e) {
      return ['message' => "Error: " . $e->getMessage()];
    }
  }
  public function getUserById(){
    try{
        $sql = "SELECT * FROM users WHERE id =:id ";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e) {
      return ['message' => "Error: " . $e->getMessage()];
    }
  }


  public function addToLibrary($user_id, $game_id){

    try {
        $query = "SELECT * FROM library where game_id = :game_id AND user_id = :user_id;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            ':game_id' => $game_id,
            ':user_id' => $user_id
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            $query = "INSERT INTO library (user_id, game_id) VALUES (:user_id, :game_id);";
            $stmt = $this->connection->prepare($query);
            $stmt->execute([
                ':user_id'=> $user_id,
                ':game_id'=> $game_id
            ]);

            $query = "INSERT INTO history (user_id, game_id) VALUES (:user_id, :game_id);";
            $stmt = $this->connection->prepare($query);
            $stmt->execute([
                ':user_id' => $user_id,
                ':game_id' => $game_id
            ]);

            return true;
        }
        return false;
    }
    catch(PDOException $e) {
        error_log("Error in adding to Lib : " . $e->getMessage());
        return false;
    }

}
public function removeFromLib($game_id){

  try {
      $query = "DELETE FROM library WHERE game_id = :game_id";
      $stmt = $this->connection->prepare($query);
      $stmt->execute([
          ':game_id' => $game_id,
      ]);
      return true;
  }
  catch(PDOException $e) {
      error_log("Error in adding to Lib : " . $e->getMessage());
      return ['Erreur: ' => 'not deleted'];
  }
}

public function getFromHistory($user_id) {
  try {
      $query = "SELECT g.title, h.created_at FROM history h JOIN games g ON h.game_id = g.id WHERE h.user_id = :user_id;";
      $stmt = $this->connection->prepare($query);
      $stmt->execute([':user_id' => $user_id]);

      return $stmt->fetchAll(PDO::FETCH_ASSOC); 
  } 
  catch (PDOException $e) {
    die("Error in backup history games : " . $e->getMessage());
    return false;
  }
}

public static function getLibraryGames($user_id){
  try {
      $db = new Database();
      $conn = $db->connect();
      $query = "SELECT g.id AS game_id, g.title,g.background_url, g.description, g.genre, g.release_date, l.status AS game_status
          FROM library l
          INNER JOIN games g ON l.game_id = g.id
          WHERE l.user_id = :user_id;";

      $stmt = $conn->prepare($query);
      $stmt->execute([
          ':user_id' => $user_id
      ]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
      error_log('Error :' . $e->getMessage());
      return ['false' => 'error'];
}

}
public function addToFavorite($user_id, $game_id) {
  try {
      $query = "SELECT * FROM favorites WHERE game_id = :game_id AND user_id = :user_id;";
      $stmt = $this->connection->prepare($query);
      $stmt->execute([
          ':game_id' => $game_id,
          ':user_id' => $user_id
      ]);

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$row) {
          $query = "INSERT INTO favorites (user_id, game_id) VALUES (:user_id, :game_id);";
          $stmt = $this->connection->prepare($query);
          $stmt->execute([
              ':user_id' => $user_id,
              ':game_id' => $game_id
          ]);

          return true; 
      }
      return false; 
  }
  catch (PDOException $e) {
    die("Error during adding to favorites : " . $e->getMessage());
    return false;
  }
}

public function getFavoriteGames($user_id) {
  try {
      $query = " SELECT g.id AS game_id, g.title,  g.genre,  g.background_url FROM favorites f JOIN games g ON f.game_id = g.id WHERE f.user_id = :user_id;";
      $stmt = $this->connection->prepare($query);
      $stmt->execute([':user_id' => $user_id]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
   catch (PDOException $e) {
    die("Error : " . $e->getMessage());
    return false;
  }
}

public function removeFromFavorite($game_id) {
  try {
      $query = "DELETE FROM favorites WHERE game_id = :game_id;";
      $stmt = $this->connection->prepare($query);
      $stmt->execute([':game_id' => $game_id]);
      return true; 
      }
  catch (PDOException $e) {
    die("Error : " . $e->getMessage());
    return false;
  }

}
}
