<?php

require_once 'Config/db.php';

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

$db = new Database();
$conn = $db->get_connection();

$error = '';

if(isset($_POST['signup'])){
  $username = htmlspecialchars(trim($_POST['username']));
  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['password']));

  if(empty($username) || empty($email) || empty($password)) {
    $error = "All fields are required!";
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Email form is not valid!";
  }
  elseif (strlen($password) < 6) {
    $error = "Password must be at least 6 characters";
  }
  else{
    $user = new Users($conn);
    $return = $user->addUser($username,$email,$password);
    if (isset($return['message'])) {
      $error = $return['message']; 
    }
    else {
      header("Location: login.php"); 
      exit(); 
  }
    
  }
}  

if(isset($_POST['login'])){
  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['password']));

  if (empty($email) || empty($password)) {
      $error = "All field are required!";
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = "email form is not valid!";
  }
  else {
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
}


if(isset($_POST['upgrade'])) {
    $userId = $_POST['upgrade'];
    $sql = "UPDATE users SET role = 'admin' WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $userId]);
}

if(isset($_POST['ban'])) {
    $userId = $_POST['ban'];
    $sql = "UPDATE users SET status = 'banned' WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $userId]);
}
if(isset($_POST['unban'])) {
    $userId = $_POST['unban'];
    $sql = "UPDATE users SET status = 'active' WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $userId]);
}