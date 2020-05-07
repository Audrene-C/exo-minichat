//on fait apparaître notre modale
$('#loginModal').modal('show');

//on récupère et on affiche les messages dans notre chat
async function getMessages(url) {
    const response = await fetch(url);
    const result = await response.json();
    const html = result.reverse().map(function(message) {
        return `
            <div>
                <span class="created_at">${message.created_at} </span>
                <span class="nickname" style="color:${message.color};">${message.nickname} : </span>
                <span class="message">${message.message}</span>
            </div>
        `
    }).join('');
    
    const chat = document.querySelector('#chat');
    chat.innerHTML = html;
    chat.scrollTop = chat.scrollHeight;
}

getMessages('./processing.php');

//on envoie les datas à notre page php pour qu'elle les rentre dans la bdd
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

//on récupère et on affiche les utilisateurs dans notre liste
async function getUsersList(url) {
    const response = await fetch(url);
    const result = await response.json();
    const html = result.reverse().map(function(user) {
        return `
            <li style="color:${user.color};">${user.nickname}</li>
        `
    }).join('');

    const list = document.querySelector('#users_list');
    list.innerHTML = html;
}

getUsersList('./processing.php?task=list');

//on envoie les datas à notre page php pour qu'elle enregistre un nouvel user
function loginUser(event) {
    //stopper le déroulé classique de l'event POST
    event.preventDefault();

    //recup les données du formulaire
    const loginNickname = document.querySelector('#loginNickname');
    const loginPassword = document.querySelector('#loginPassword');

    //conditionner ces données
    const data = new FormData;
    data.append('loginNickname', loginNickname.value);
    data.append('loginPassword', loginPassword.value);

    //configurer une requête AJAX en POST et envoyer les données
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', '../partials/login.php');
    requeteAjax.onload = function() {
        setcookie( "nickname", loginNickname.value, strtotime( '+2 days' ) );
    }

    document.querySelector('#login-form').addEventListener('submit', loginUser);
}