<?php

require_once '../Config/Db.php';

class Game
{
    private $pdo;

    public function __construct($conn)
    {
        $this->pdo = $conn;
    }

    public function addGame($title, $description, $genre, $releaseDate, $background, $scrshot1, $scrshot2, $scrshot3, $rating)
    {
        try {
            $sql = "INSERT INTO games (title, description, genre, release_date, background, scrshot1, scrshot2, scrshot3, rating)
                VALUES (:title, :description, :genre, :release_date, :background, :scrshot1, :scrshot2, :scrshot3, :rating)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':genre' => $genre,
                ':release_date' => $releaseDate,
                ':background' => $background,
                ':scrshot1' => $scrshot1,
                ':scrshot2' => $scrshot2,
                ':scrshot3' => $scrshot3,
                ':rating' => $rating
            ]);
            return true;
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function updateGame($gameId, $new_title, $new_description, $new_genre, $new_releaseDate, $new_background, $new_scrshot1, $new_scrshot2, $new_scrshot3, $new_rating)
    {
        try {
            $sql = "UPDATE games SET 
                        title = :title, 
                        description = :description, 
                        genre = :genre, 
                        release_date = :release_date, 
                        background = :background, 
                        scrshot1 = :scrshot1, 
                        scrshot2 = :scrshot2, 
                        scrshot3 = :scrshot3, 
                        rating = :rating
                WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id' => $gameId,
                'title' => $new_title,
                'description' => $new_description,
                'genre' => $new_genre,
                'release_date' => $new_releaseDate,
                'background' => $new_background,
                'scrshot1' => $new_scrshot1,
                'scrshot2' => $new_scrshot2,
                'scrshot3' => $new_scrshot3,
                'rating' => $new_rating,

            ]);
            return true;
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function deleteGame($id)
    {
        try {
            $sql = "DELETE FROM games WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public static function getAll()
    {
        try {
            $db = new Database();
            $conn = $db->connect();
            $sql = "SELECT * FROM games";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function getGameById($id)
    {
        try {
            $sql = "SELECT * FROM games WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    public static function getStats()
    {
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
                'total_Users' => $allUsers['total_users'] ?? 0,
                'total_banned' => $allUsers['banned'] ?? 0
            ];
        } catch (PDOException $e) {
            error_log("Error : " . $e->getMessage());
            return false;
        }

    }

    public function addReview($user_id, $game_id, $rating, $comment)
    {
        try {
            $query = "SELECT * FROM reviews WHERE user_id = :user_id AND game_id = :game_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                'user_id' => $user_id,
                'game_id' => $game_id,
            ]);
            if ($stmt->rowCount() > 0) {
                $query2 = "UPDATE reviews SET rating = :rating, comment = :comment WHERE user_id = :user_id AND game_id = :game_id";
            } else {
                $query2 = "INSERT INTO reviews (user_id, game_id, rating, comment)
                        VALUES (:user_id, :game_id, :rating, :comment)";
            }

            $stmt = $this->pdo->prepare($query2);
            $stmt->execute([
                "user_id" => $user_id,
                "game_id" => $game_id,
                "rating" => $rating,
                "comment" => $comment
            ]);
            return true;

        } catch (PDOException $e) {
            error_log("Erreur adding review " . $e->getMessage());
            return false;
        }
    }

    public function getRating($game_id)
    {
        try {
            $query = "SELECT ROUND(AVG(rating), 0) AS average FROM reviews WHERE game_id = :game_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                "game_id" => $game_id
            ]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getting avg" . $e->getMessage());
            return false;
        }
    }

    public function getReviews($game_id)
    {
        try {
            $query = "SELECT u.username, r.rating, r.comment FROM reviews r INNER JOIN users u ON
            r.user_id = u.id WHERE game_id = :game_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                "game_id" => $game_id
            ]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur Selecting data" . $e->getMessage());
        }
    }

    public function chats($game_id)
    {
        try {
            $sql = "SELECT u.username, c.message, c.time, c.user_id FROM chats c JOIN users u ON c.user_id = u.id WHERE c.game_id = :game_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':game_id' => $game_id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

}