
<?php

if(!isset($_SESSION['user_id'])&& !isset($_SESSION['matricule'])){
    header("Location:connexion.php");
    exit();
}
