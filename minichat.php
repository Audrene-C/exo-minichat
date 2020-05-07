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
?>
    <div class="container-fluid d-flex">

        <div class="row">
            
            <div class="col-9" id="chat"></div>

            <div class="col-3" id="users_list">
                <ul>
                    <?php include './partials/users-list.php'; ?>
                </ul>
            </div>

        </div>

    </div>

    <div class="container-fluid d-flex">

        <div id="login" class="col-3">
            <p>Prochainement, le login</p>
        </div>

        <form action="processing.php?task=write" method="post" class="d-flex col 9">
            <div class="container-fluid d-flex" id="chat-form">    
                <div class="col-4">
                    <label for="nickname">Nickname :</label>
                    <input type="text" name="nickname" id="nickname" value="<?=$_COOKIE["nickname"];?>" required>
                </div>
                <div id="div_message" class="col-7">
                    <label for="message">Your message :</label>
                    <input type="text" name="message" id="message" required>
                </div>
                <input type="submit" value="Send" id="send" class="col-1">
            </div>
        </form>
        
    </div>


<script src="./js/event.js"></script>

    </body>
</html>