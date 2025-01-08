<?php 

    require_once '../Config/Db.php';

    class User {

        private $pdo;
        public function __construct($conn){
            $this->pdo = $conn;
        }

        public function addToLibrary($user_id, $game_id){

            try {
                $query = "INSERT INTO library (user_id, game_id) VALUES (:user_id, :game_id);";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute([
                ':user_id' => $user_id,
                ':game_id' => $game_id
                ]);

                return true;
            }
            catch(PDOException $e) {
                error_log("Error : " . $e->getMessage());
                return false;
            }

        }

        public static function getLibraryGames($user_id){
            try {
                $db = new Database();
                $conn = $db->connect();
                $query = "SELECT g.id AS game_id, g.title, g.description, g.genre, g.release_date, l.status AS game_status
                    FROM gamevault_library l
                    INNER JOIN gamevault_games g ON l.game_id = g.id
                    WHERE l.user_id = :user_id;";

                $stmt = $conn->prepare($query);
                $stmt->execute([
                    ':user_id' => $user_id
                ]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                error_log('Error :' . $e->getMessage());
                return false;
            }
        }
        

    }

