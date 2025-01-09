<?php

  require_once '../Config/db.php';
  $db = new Database();
  $conn = $db->get_connection();

  require '../Classes/users.php';
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
                $_SESSION['admin_id'] = $return['user_id'];
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