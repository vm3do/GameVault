<?php

require_once '../Config/Db.php';

class Game {
    
    private $pdo;

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

    

    public static function getStats() {
        try {
            $db = new Database();
            $conn = $db->connect();
            $totalGames = "SELECT COUNT(*) as total_games FROM games";
            $totalUsers = "SELECT COUNT(*) as total_users, SUM(CASE WHEN status = 'banned' THEN 1 ELSE 0 END) as banned FROM users";

            $stmt_1 = $conn->prepare($totalGames);
            $stmt_2 = $conn->prepare($totalUsers);

            $stmt_1->execute();
            $stmt_2->execute();

            $allGames = $stmt_1->fetch(PDO::FETCH_ASSOC);
            $allUsers = $stmt_2->fetch(PDO::FETCH_ASSOC);

            return [
                'total_Games' => $allGames['total_games'] ?? 0,
                'total_Users' => $allUers['total_users'] ?? 0,
                'total_banned' => $allUers['banned'] ?? 0
            ];
        } catch (PDOException $e) {
            error_log("Error : " . $e->getMessage());
            return false;
        }

    }

}