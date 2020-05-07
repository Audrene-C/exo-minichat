<?php
//on se co à la bdd
include_once './connexion.php';
//on ajoute le random color
include_once '../RandomColor.php/src/RandomColor.php';
use \Colors\RandomColor;

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

if(!empty($_POST['loginPassword']) AND !empty($_POST['loginNickname'])) {
    createUser();
}

function createUser() {
        $loginPassword = htmlspecialchars($_POST['loginPassword']);
        $loginNickname = htmlspecialchars($_POST['loginNickname']);

        global $bdd;
        $reqVerif = $bdd->prepare('SELECT * FROM users WHERE nickname = ?');
        $reqVerif->execute([$loginNickname]);
        $userExists = $reqVerif->fetch(PDO::FETCH_ASSOC);
    
        if ($userExists) {
            echo "<script>alert(\"This nickname is already used\")</script>";
        }
        else {
    
        $insertNewUser = $bdd->prepare('INSERT INTO users SET nickname = :nickname, created_at = NOW(), ip_address = :ip_address, color = :color, password = :password');
                $insertNewUser->execute(array(
                    "nickname" => $loginNickname,
                    "ip_address" => getIp(),
                    "color" => RandomColor::one(),
                    "password" => $loginPassword
                ));
        header('Location: ../minichat.php');
        }
}
?>