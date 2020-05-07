async function getMessages(url) {
    const response = await fetch(url);
    const result = await response.json();
    const html = result.reverse().map(function(message) {
        return `
            <div>
                <span class="created_at">${message.created_at} </span>
                <span class="nickname">${message.nickname} : </span>
                <span class="message">${message.message}</span>
            </div>
        `
    }).join('');

    const chat = document.querySelector('#chat');
    chat.innerHTML = html;
    chat.scrollTop = chat.scrollHeight;
}

getMessages('./processing.php');