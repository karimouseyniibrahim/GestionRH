
<?php

if(isset($_SESSION['user_id'])&& isset($_SESSION['username'])){
    header("Location:index.php");
    exit();
}