<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini-chat</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
    <body>

<?php
//on se co à la bdd
include_once './partials/connexion.php';
//on injecte la modale
include './partials/modal-login.php';
//on créé les cookies
include './partials/cookies.php';
?>
    <div class="container-fluid d-flex">
        <div class="row">
            <div class="col-9" id="chat"></div>
            <div class="col-3" >
                <ul id="users_list"></ul>
            </div>
        </div>
    </div>
    
        <form action="processing.php?task=write" method="post" class="container-fluid d-flex">
            <div class="container-fluid d-flex" id="chat-form">    
                <div class="col-4">
                    <label for="nickname">Logged as :</label>
                    <input type="text" name="nickname" id="nickname" value="<?=$_COOKIE["nickname"];?>" required>
                </div>
                <div class="col-7">
                    <label for="message">Your message :</label>
                    <input type="text" name="message" id="message" required>
                </div>
                <input type="submit" value="Send" id="send" class="col-1">
            </div>
        </form>
        
    </div>

    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="./js/event.js?<?=strtotime("now")?>"></script>

    </body>
</html>