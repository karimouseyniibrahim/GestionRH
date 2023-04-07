<?php
//connexion à la base de données
$db_username = 'root';
$db_password = '123456';
$db_name = 'payroll';
$db_host = 'localhost';
/*
try{
    $db=new PDO("mysql:host=localhost;dbname=".$db_name ,$db_username,$db_password );
}catch(PDOException $e){
    print($e);
}
 
try{
$serverName = "DESKTOP-GLQVAKB"; //serverName\instanceName
$connectionInfo = array( "Database"=>"GestionRH");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
}catch(PDOException $e){
    print($e);
}
*/
phpinfo();
try{
    $db=new PDO("mssql:host=154.66.222.150;dbname=GestionRH ",'GestionRH','GestionRH2023' );
}catch(PDOException $e){
    print($e);
}
