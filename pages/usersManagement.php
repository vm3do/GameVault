<?php

  require_once __DIR__ . '/../Config/Db.php';
  $db = new Database();
  $pdo = $db->connect();

  if(isset($_POST['upgrade'])) {
    $userId = $_POST['upgrade'];
    $sql = "UPDATE users SET role = 'admin' WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $userId]);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
  }

  if(isset($_POST['ban'])) {
    $userId = $_POST['ban'];
    $sql = "UPDATE users SET status = 'banned' WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $userId]);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
  }
  if(isset($_POST['unban'])) {
    $userId = $_POST['unban'];
    $sql = "UPDATE users SET status = 'active' WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $userId]);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
  }