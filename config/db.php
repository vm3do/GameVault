<?php

class Database {
  private $dsn = "mysql:host=localhost;dbname=GameVault";
  private $user = "root";
  private $pass = "";

  public function connect() {
      try {
          $pdo = new PDO($this->dsn, $this->user, $this->pass);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
          // echo "You are connect";
          return $pdo;
      } catch (PDOException $e) {
          die("Connexion failed: " . $e->getMessage());
      }
  }
  public function get_connection() {
      return $this->connect();
  }
}
