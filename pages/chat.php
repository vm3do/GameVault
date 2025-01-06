<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Custom violet accent */
    .bg-violet-accent {
      background-color: #7c3aed;
    }
    .text-violet-accent {
      color: #7c3aed;
    }
    .border-violet-accent {
      border-color: #7c3aed;
    }
  </style>
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
      <div class="flex items-start space-x-3">
        <!-- Profile Picture -->
        <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
          <span class="text-sm">A</span>
        </div>
        <!-- Message Content -->
        <div>
          <p class="text-sm font-bold">Alice</p>
          <div class="bg-gray-700 p-3 rounded-lg max-w-[70%] mt-1">
            <p class="text-sm">Hello! How can I help you today?</p>
            <span class="text-xs text-gray-400 block mt-1">10:00 AM</span>
          </div>
        </div>
      </div>
      <!-- Message 2 -->
      <div class="flex items-start space-x-3">
        <!-- Profile Picture -->
        <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
          <span class="text-sm">B</span>
        </div>
        <!-- Message Content -->
        <div>
          <p class="text-sm font-bold">Bob</p>
          <div class="bg-gray-700 p-3 rounded-lg max-w-[70%] mt-1">
            <p class="text-sm">Hi! I have a question about my account.</p>
            <span class="text-xs text-gray-400 block mt-1">10:01 AM</span>
          </div>
        </div>
      </div>
      <!-- Add more messages here -->
    </div>
    <!-- Message Input -->
    <div class="bg-gray-800 p-4 rounded-b-lg">
      <form class="flex space-x-2">
        <input
          type="text"
          placeholder="Type your message..."
          class="flex-1 bg-gray-700 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-accent"
        />
        <button
          type="submit"
          class="bg-violet-accent px-4 py-2 rounded-lg hover:bg-violet-700 transition"
        >
          Send
        </button>
      </form>
    </div>
  </div>
</body>
</html>