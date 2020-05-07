<?php
if(!empty($_POST['nickname'])) {
    setcookie( "nickname", $_POST['nickname'], strtotime( '+2 days' ) );
}
?>