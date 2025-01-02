<?php

require_once 'config/db.php';

class Users { 
  private $connection;
  public function __construct($conn) {
    $this->connection = $conn;
  }
  public function addUser($username, $email, $password) {
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
}

$db = new Database();
$conn = $db->get_connection();

if(isset($_POST['signup'])){
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $user = new Users($conn);
  $user->addUser($username,$email,$password);
  if ($user) {
    header("Location: login.php"); 
    exit(); 
  } 
}  
$error = '';
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new Users($conn);
    $return = $user->loginUser($email, $password);

    if ($return['verify'] == false) {
        $error = $return['message'];
    } 
    else {
        if($return['role'] === 'admin') {
            session_start();
            $_SESSION['user_id'] = $return['user_id'];
            header('Location: dashboard.php');
            exit;
        } 
        else {
            session_start();  
            $_SESSION['user_id'] = $return['user_id'];
            header('Location: profile.php');
            exit;  
        }
  } 
}


