<?php session_start();

//on se co à la bdd
include_once './partials/connexion.php';

//on ajoute le random color
include './RandomColor.php/src/RandomColor.php';
use \Colors\RandomColor;

//on doit déterminer si le GET souhaite récupérer un message ou en écrire un
$task = "";

if(array_key_exists("task", $_GET)) {
    $task = $_GET['task'];
}

if($task == "write") {
    postMessage();
} elseif($task == "list") {
    getUsersList();
} else {
    getMessages();
}

function getUsersList() {
    //on précise la variable $bdd qui était definie à l'extérieur de ma fonction
    global $bdd;
    //on requête la bdd pour avoir tous les users
    $req = $bdd->query('SELECT * FROM users ORDER BY created_at DESC');
    $users = $req->fetchAll(PDO::FETCH_ASSOC);
    //on affiche les données sous forme de JSON
    echo json_encode($users);
}

function getMessages() {
    //on précise la variable $bdd qui était definie à l'extérieur de ma fonction
    global $bdd;
    //on requête la bdd pour avoir les 20 derniers messages
    $req = $bdd->query('SELECT messages.*, users.nickname, users.color FROM messages INNER JOIN users ON messages.user_id = users.id ORDER BY created_at DESC LIMIT 20');
    $messages = $req->fetchAll(PDO::FETCH_ASSOC);
    //on affiche les données sous forme de JSON
    echo json_encode($messages);
}

function getIp() {
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function postMessage() {
    if(!empty($_POST['nickname']) AND !empty($_POST['message'])) {
        $nickname = htmlspecialchars($_POST['nickname']);
        $message = htmlspecialchars($_POST['message']);

        global $bdd;
        $reqVerif = $bdd->prepare('SELECT * FROM users WHERE nickname = ?');
        $reqVerif->execute([$nickname]);
        $userExists = $reqVerif->fetch(PDO::FETCH_ASSOC);

        if ($userExists) {
            $userId = $userExists['id'];
            echo "oui";
        }
        else {
            $insertNewUser = $bdd->prepare('INSERT INTO users SET nickname = :nickname, created_at = NOW(), ip_address = :ip_address, color = :color');
            $insertNewUser->execute(array(
                "nickname" => $nickname,
                "ip_address" => getIp(),
                "color" => RandomColor::one()
            ));
            $userId = $bdd->lastInsertId();
            echo "non";
        }
        
        
        $insertMessage = $bdd->prepare('INSERT INTO messages SET user_id = :user_id, message = :message, ip_address = :ip_address, created_at = NOW()');
        $insertMessage->execute(array(
                    "user_id" => $userId,
                    "message" => $message,
                    "ip_address" => getIp()
                )); echo "donc?";
        
        //on créé le cookie pour récupérer le pseudo
        setcookie( "nickname", $nickname, strtotime( '+2 days' ) );
    
    }
    header('Location: minichat.php');
}



?>