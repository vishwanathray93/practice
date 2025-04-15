<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
$admin_id = $_SESSION['user_id'];
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Chat - WhatsApp Style</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; background: #e5ddd5; }
        .container { display: flex; height: 90vh; width: 80%; margin: auto; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); }
        .sidebar { width: 30%; background: #fff; overflow-y: auto; padding: 10px; border-right: 1px solid #ddd; }
        .chat { width: 70%; display: flex; flex-direction: column; background: #f8f8f8; }
        .header { padding: 15px; background: #075e54; color: white; }
        .messages { flex: 1; padding: 10px; overflow-y: auto; background: #ece5dd; display: flex; flex-direction: column; }
        .input-area { display: flex; padding: 10px; background: #fff; border-top: 1px solid #ddd; }
        .input-area textarea { flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 20px; }
        .input-area button { padding: 8px 15px; margin-left: 5px; border: none; background: #128c7e; color: white; cursor: pointer; border-radius: 20px; }
        .user-item { padding: 15px; cursor: pointer; border-bottom: 1px solid #ddd; }
        .user-item:hover { background: #f1f1f1; }
        .message { max-width: 60%; padding: 10px; margin: 5px 0; border-radius: 10px; }
        .sent { align-self: flex-end; background: #dcf8c6; text-align: right; }
        .received { align-self: flex-start; background: #fff; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar for users list -->
        <div class="sidebar">
            <h3>Users</h3>
            <div id="user-list">
                <?php
                $users = $conn->query("SELECT id, username FROM users WHERE role = 'user'");
                while ($row = $users->fetch_assoc()) {
                    echo '<div class="user-item" data-id="' . $row['id'] . '">' . $row['username'] . '</div>';
                }
                ?>
            </div>
        </div>

        <!-- Chat Section -->
        <div class="chat">
            <div class="header" id="chat-title">Select a user to chat</div>
            <div class="messages" id="chat-box"></div>
            <div class="input-area">
                <textarea id="message" placeholder="Type a message"></textarea>
                <input type="file" id="file">
                <button onclick="sendMessage()">Send</button>
            </div>
        </div>
    </div>
    <script>
    let userId = <?php echo json_encode($_SESSION['user_id']); ?>; // Get admin's user ID

    
$(".user-item").click(function () {
    selectedUser = $(this).data("id"); // Get data-id from the clicked user
    $("#chat-title").text("Chat with User " + selectedUser);
    loadMessages();
});
let selectedUser = null;
// Function to fetch messages for selected user
function loadMessages() {
    if (!selectedUser) {
        console.error("No user selected!");
        return;
    }

    $.ajax({
        url: "fetch_messages.php",
        type: "POST",
        data: { receiver_id: selectedUser },
        success: function (data) {
            try {
                let messages = JSON.parse(data);
                if (messages.error) {
                    console.error("Error:", messages.error);
                    return;
                }

                $("#chat-box").html("");
                messages.forEach(msg => {
                    let alignment = msg.sender_id == userId ? 'sent' : 'received';
                    let fileLink = msg.file ? `<a href="${msg.file}" target="_blank">[File]</a>` : '';
                    $("#chat-box").append(`<div class="message ${alignment}">${msg.message} ${fileLink}</div>`);
                });
            } catch (e) {
                console.error("Invalid JSON response:", data);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}


// Function to send a message
function sendMessage() {
    if (!selectedUser) {
        alert("Please select a user first!");
        return;
    }

    let formData = new FormData();
    formData.append("message", $("#message").val());
    formData.append("file", $("#file")[0].files[0]);

    formData.append("receiver_id", selectedUser); // Use selectedUser from data-id
alert(selectedUser);
    $.ajax({
        url: "send_message.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function () {
            $("#message").val("");
            loadMessages();
        }
    });
}

// Auto-refresh messages for the selected user
setInterval(loadMessages, 3000);
 </script>
</body>
</html>
