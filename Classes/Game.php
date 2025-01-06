<?php

require_once '../Config/Db.php';

class Game {
    private $id;
    private $title;
    private $description;
    private $genre;
    private $releaseDate;
    private $background;  // Main image URL
    private $scrshot1;   // Screenshot 1
    private $scrshot2;   // Screenshot 2
    private $scrshot3;   // Screenshot 3
    private $rating;

    // Constructor
    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->genre = $data['genre'] ?? null;
        $this->releaseDate = $data['releaseDate'] ?? null;
        $this->background = $data['background'] ?? null;
        $this->scrshot1 = $data['scrshot1'] ?? null;
        $this->scrshot2 = $data['scrshot2'] ?? null;
        $this->scrshot3 = $data['scrshot3'] ?? null;
        $this->rating = $data['rating'] ?? null;
        $this->api_id = $data['api_id'] ?? null;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getDescription() { return $this->description; }
    public function getGenre() { return $this->genre; }
    public function getReleaseDate() { return $this->releaseDate; }
    public function getBackground() { return $this->background; }
    public function getScreenshot1() { return $this->scrshot1; }
    public function getScreenshot2() { return $this->scrshot2; }
    public function getScreenshot3() { return $this->scrshot3; }
    public function getRating() { return $this->rating; }
    public function getApiId() { return $this->api_id; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setTitle($title) { $this->title = $title; }
    public function setDescription($description) { $this->description = $description; }
    public function setGenre($genre) { $this->genre = $genre; }
    public function setReleaseDate($releaseDate) { $this->releaseDate = $releaseDate; }
    public function setBackground($background) { $this->background = $background; }
    public function setScreenshot1($scrshot1) { $this->scrshot1 = $scrshot1; }
    public function setScreenshot2($scrshot2) { $this->scrshot2 = $scrshot2; }
    public function setScreenshot3($scrshot3) { $this->scrshot3 = $scrshot3; }
    public function setRating($rating) { $this->rating = $rating; }

    // Save a new game to the database
    public function save() {
        $db = new Database();
        $pdo = $db->connect();

        $sql = "INSERT INTO games (title, description, genre, release_date, background_url, screenshot1_url, screenshot2_url, screenshot3_url, rating)
                VALUES (:title, :description, :genre, :release_date, :background_url, :screenshot1_url, :screenshot2_url, :screenshot3_url, :rating)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':title' => $this->title,
            ':description' => $this->description,
            ':genre' => $this->genre,
            ':release_date' => $this->releaseDate,
            ':background_url' => $this->background,
            ':screenshot1_url' => $this->scrshot1,
            ':screenshot2_url' => $this->scrshot2,
            ':screenshot3_url' => $this->scrshot3,
            ':rating' => $this->rating
        ]);

        $this->id = $pdo->lastInsertId();
    }

    // Update an existing game in the database
    public function update() {
        $db = new Database();
        $pdo = $db->connect();

        $sql = "UPDATE games SET
                api_id = :api_id,
                title = :title,
                description = :description,
                genre = :genre,
                release_date = :release_date,
                background_url = :background_url,
                screenshot1_url = :screenshot1_url,
                screenshot2_url = :screenshot2_url,
                screenshot3_url = :screenshot3_url,
                rating = :rating
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':api_id' => $this->api_id,
            ':title' => $this->title,
            ':description' => $this->description,
            ':genre' => $this->genre,
            ':release_date' => $this->releaseDate,
            ':background_url' => $this->background,
            ':screenshot1_url' => $this->scrshot1,
            ':screenshot2_url' => $this->scrshot2,
            ':screenshot3_url' => $this->scrshot3,
            ':rating' => $this->rating,
            ':id' => $this->id
        ]);
    }

    // Delete a game from the database
    public function delete() {
        $db = new Database();
        $pdo = $db->connect();

        $sql = "DELETE FROM games WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $this->id]);
    }

    // Fetch all games from the database
    public static function getAll() {
        $db = new Database();
        $pdo = $db->connect();

        $sql = "SELECT * FROM games";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $games = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $games[] = new Game($row);
        }

        return $games;
    }

    // Fetch a single game by ID
    public static function getById($id) {
        $db = new Database();
        $pdo = $db->connect();

        $sql = "SELECT * FROM games WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Game($row) : null;
    }
}