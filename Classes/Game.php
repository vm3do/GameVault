<?php

require_once '../Config/Db.php';

class Game {
    private $title;
    private $description;
    private $genre;
    private $releaseDate;
    private $background;  // Main image URL
    private $scrshot1;   // Screenshot 1
    private $scrshot2;   // Screenshot 2
    private $scrshot3;   // Screenshot 3
    private $rating;
    private $pdo;
    private $id;

    // Constructor
    public function __construct($conn) {
        $this->pdo = $conn;
    }

    public function addGame($title, $description, $genre, $releaseDate, $background, $scrshot1, $scrshot2, $scrshot3, $rating) {
        try{
            $sql = "INSERT INTO games (title, description, genre, release_date, background, screenshot1_url, screenshot2_url, screenshot3_url, rating)
                VALUES (:title, :description, :genre, :release_date, :background, :screenshot1_url, :screenshot2_url, :screenshot3_url, :rating)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':genre' => $genre,
                ':release_date' => $releaseDate,
                ':background' => $background,
                ':screenshot1_url' => $scrshot1,
                ':screenshot2_url' => $scrshot2,
                ':screenshot3_url' => $scrshot3,
                ':rating' => $rating
            ]);
            return true;
        }
        catch(PDOException $e) {
            die("Erreur : " . $e->getMessage());
            return false;
        }
        }

    public static function getAll() {
        try{
            $db = new Database();
            $conn = $db->connect();
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

    public static function getstats

}