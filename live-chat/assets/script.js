function fetchMessages() {
    let chatBox = document.getElementById("chat-box");
    fetch("fetch_messages.php")
        .then(response => response.text())
        .then(data => chatBox.innerHTML = data);
}

function sendMessage() {
    let message = document.getElementById("message").value;
    fetch("send_message.php", {
        method: "POST",
        body: new URLSearchParams({ "message": message }),
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    }).then(() => {
        document.getElementById("message").value = "";
        fetchMessages();
    });
}

setInterval(fetchMessages, 2000);
