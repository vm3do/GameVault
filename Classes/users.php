<?php

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
}
