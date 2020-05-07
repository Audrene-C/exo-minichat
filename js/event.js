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

function postMessage(event) {
    //stopper le déroulé classique de l'event POST
    event.preventDefault();

    //recup les données du formulaire
    const nickname = document.querySelector('#nickname');
    const message = document.querySelector('#message');

    //conditionner ces données
    const data = new FormData;
    data.append('nickname', nickname.value);
    data.append('message', message.value);

    //configurer une requête AJAX en POST et envoyer les données
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', 'processing.php?task=write');
    requeteAjax.onload = function() {
        //on vide le champ après avoir envoyé un message
        content.value = '';
        content.focus();
        getMessages();
    }

    document.querySelector('#chat-form').addEventListener('submit', postMessage);
}