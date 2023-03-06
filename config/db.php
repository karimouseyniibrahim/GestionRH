<?php
//connexion à la base de données
$db_username = 'root';
$db_password = '123456';
$db_name = 'payroll';
$db_host = 'localhost';
try{
    $db=new PDO("mysql:host=localhost;dbname=".$db_name ,$db_username,$db_password );
}catch(PDOException $e){
    print($e);
}
 