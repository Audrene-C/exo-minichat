<?php 
include_once './partials/connexion.php';
$req = $bdd->query('SELECT nickname FROM users ORDER BY nickname');
$users = $req->fetchAll(PDO::FETCH_ASSOC);
foreach($users as $user) : ?>
        <li><?= $user['nickname'] ?></li>
<?php endforeach; ?>
