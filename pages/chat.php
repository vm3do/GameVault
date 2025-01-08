<?php 
      session_start(); 
      require_once '../Config/db.php';
      $db = new Database();
      $conn = $db->get_connection();
      
      require '../Classes/Game.php';
 
      if(isset($_GET['action']) && $_GET['action'] === 'chat' && isset($_GET['gameId']) && isset($_GET['userId'])){
        $_SESSION['gameId'] = $_GET['gameId'];
        $_SESSION['userId'] = $_GET['userId'];
      }
      if(isset($_POST['sendMessage'])) {
        $message = $_POST['message'];
  
        $sql = "INSERT INTO chats (user_id, game_id, message) VALUES (:user_id,:game_id, :message)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $_SESSION['userId'],'game_id' => $_SESSION['gameId'], 'message' => $message]);
        header('Location: ' . $_SERVER['PHP_SELF']);
      }
      $game = new Game($conn);  
      $result = $game->chats($_SESSION['userId'] );

  

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Chat</title>
  <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-900 text-white">
  <!-- Chat Container -->
  <div class="flex flex-col h-screen p-4">
    <!-- Chat Header -->
    <header class="bg-gray-800 p-4 rounded-t-lg">
      <h1 class="text-xl font-bold">Chat Room</h1>
    </header>
    <!-- Chat History -->
    <div class="flex-1 bg-gray-800 p-4 overflow-y-auto space-y-4">
      <!-- Message 1 -->
       <?php foreach($result as $row) : ?>
      <div class="flex items-start space-x-3">
        <!-- Profile Picture -->
        <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
          <span class="text-sm"><?php echo $row['username'][0] ?></span>
        </div>
        <!-- Message Content -->
        <div>
          <p class="text-sm font-bold"><?php echo $row['username'] ?></p>
          <div class="bg-gray-700 p-3 rounded-lg max-w-[100%] mt-1">
            <p class="text-sm"><?php echo $row['message'] ?></p>
            <span class="text-xs text-gray-400 block mt-1"><?php echo $row['time'] ?></span>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <!-- Message Input -->
    <div class="bg-gray-800 p-4 rounded-b-lg">
      <form class="flex space-x-2" action="chat.php" method="POST">
        <input
          type="text"
          name="message"
          placeholder="Type your message..."
          class="flex-1 bg-gray-700 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
        />
        <button
          type="submit"
          name="sendMessage"
          class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition"
        >
          Send
        </button>
      </form>
    </div>
  </div>
</body>
</html>