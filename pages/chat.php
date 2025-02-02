<?php 

      include __DIR__ . '/../includes/header.php';
      require_once __DIR__ . '/../Config/Db.php';

      $db = new Database();
      $pdo = $db->connect();
      
      require '../Classes/Game.php';
    
      if(isset($_POST['chat']) && isset($_POST['user_id']) && isset($_POST['game_id'])) {
        $_SESSION['gameId'] = $_POST['game_id'];
        $_SESSION['userId'] = $_POST['user_id'];

      }      
      $user_id = $_SESSION['userId'];
      $game_id = $_SESSION['gameId'];

      if(isset($_POST['sendMessage'])) {
        $message = $_POST['message'];
  
        $sql = "INSERT INTO chats (user_id, game_id, message) VALUES (:user_id,:game_id, :message)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $user_id,'game_id' => $game_id, 'message' => $message]);
        header('Location: ' . $_SERVER['PHP_SELF']);
      }
      $game = new Game($pdo);  
      $result = $game->chats($game_id);

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
  <div class="flex flex-col h-screen p-4">
    <header class="bg-gray-800 p-4 rounded-t-lg">
      <h1 class="text-xl font-bold">Chat Room</h1>
    </header>
    <div class="flex-1 bg-gray-800 p-4 overflow-y-auto space-y-4">
      <!-- Message 1 -->
      <?php foreach($result as $row) : ?>
    <?php if ($row['user_id'] == $user_id) : ?>
        <div class="flex items-start space-x-3 justify-end">
            <div>
                <p class="text-sm font-bold text-right"><?php echo $row['username'] ?></p>
                <div class="bg-violet-700 p-3 rounded-lg max-w-[100%] mt-1">
                    <p class="text-sm"><?php echo $row['message'] ?></p>
                    <span class="text-xs text-gray-400 block mt-1"><?php echo $row['time'] ?></span>
                </div>
            </div>
            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                <span class="text-sm"><?php echo $row['username'][0] ?></span>
            </div>
        </div>
    <?php else : ?>
        <div class="flex items-start space-x-3+">
            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                <span class="text-sm"><?php echo $row['username'][0] ?></span>
            </div>
            <div>
                <p class="text-sm font-bold"><?php echo $row['username'] ?></p>
                <div class="bg-gray-700 p-3 rounded-lg max-w-[100%] mt-1">
                    <p class="text-sm"><?php echo $row['message'] ?></p>
                    <span class="text-xs text-gray-400 block mt-1"><?php echo $row['time'] ?></span>
                </div>
            </div>
        </div>
    <?php endif; ?>
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