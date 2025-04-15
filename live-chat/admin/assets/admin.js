function fetchChats() {
    fetch("manage_chats.php")
        .then(response => response.text())
        .then(data => document.getElementById("chats-container").innerHTML = data);
}

function openChat(chatId) {
    sessionStorage.setItem("chat_id", chatId);
    window.location.href = "chat.php";
}

setInterval(fetchChats, 3000);
