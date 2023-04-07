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
 /*
try{
$serverName = "DESKTOP-GLQVAKB"; //serverName\instanceName
$connectionInfo = array( "Database"=>"GestionRH");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
}catch(PDOException $e){
    print($e);
}
*/

/*
try{
    $db=new PDO("sqlsrv:Server=192.168.0.5\SQLEXPRESS;Database=GestionRH ",'GestionRH','Gestion2023' );

}catch(PDOException $e){
    print($e);
}
*/