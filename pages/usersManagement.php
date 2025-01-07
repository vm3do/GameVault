<?php

  require_once '../Config/db.php';
  $db = new Database();
  $conn = $db->get_connection();

  if(isset($_POST['upgrade'])) {
    $userId = $_POST['upgrade'];
    $sql = "UPDATE users SET role = 'admin' WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $userId]);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
  }

  if(isset($_POST['ban'])) {
    $userId = $_POST['ban'];
    $sql = "UPDATE users SET status = 'banned' WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $userId]);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
  }
  if(isset($_POST['unban'])) {
    $userId = $_POST['unban'];
    $sql = "UPDATE users SET status = 'active' WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $userId]);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
  }