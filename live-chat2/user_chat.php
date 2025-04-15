<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h3>Welcome, User <?php echo $user_id; ?></h3>
    <a href="logout.php">Logout</a>
    <div id="chat-box"></div>
    <textarea id="message"></textarea>
    <input type="file" id="file">
    <input type="hidden" name="" id="receiver" value="2">
    <button onclick="sendMessage()">Send</button>

    

    <script>
        function loadMessages() {
            $.post("fetch_messages.php", function (data) {
                $("#chat-box").html("");
                let messages = JSON.parse(data);
                messages.forEach(msg => {
                    $("#chat-box").append(`<p>${msg.message} ${msg.file ? '<a href="'+msg.file+'" target="_blank">[File]</a>' : ''}</p>`);
                });
            });
        }

        function sendMessage() {
            let formData = new FormData();
            formData.append("message", $("#message").val());
            formData.append("file", $("#file")[0].files[0]);
            formData.append("receiver_id", $("#receiver").val());

            $.ajax({
                url: "send_message.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function () {
                    loadMessages();
                }
            });
        }

        setInterval(loadMessages, 3000);
        loadMessages();
    </script>
</body>
</html>
