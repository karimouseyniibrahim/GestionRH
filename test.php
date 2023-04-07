<?php
/*session_start();
require("config/db.php");
require("includes/functions.php");
/*
if(isset($_GET['add'])){
$i=0;
  foreach(array("A","B","C") as $c):
    foreach(range(1,14) as $g):
      $q=$db->prepare("INSERT INTO `codeanalytique`(`CODTAB`, `CODLIB`, `LIBLONG`) 
      VALUES (:codtab,:codlib,:liblong)");
      try{
        $q->execute(array(
                  ':codtab' => 54,
                  ':codlib' => $i++,
                  ':liblong' => $g.'-'.$c));
        }catch(PDOException $e){
          echo "Erreur : " . $e->getMessage();
          die();
        }
    endforeach;
  endforeach;
}*//*
$NR_MATISC=371;
print_r( GetPointageManoeuvresByCode_Sup('2023-03-01'));*/
 /*
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
    echo $_SERVER['REQUEST_URI'];  

    $previous_week = strtotime("0 week +3 day");

$start_week = strtotime("last thursday midnight",$previous_week);
$end_week = strtotime("next wednesday",$start_week);

$start_week = date("Y-m-d",$start_week);
$end_week = date("Y-m-d",$end_week);*/

$previous_week = strtotime("-1 week +3 day");
        $start_week = strtotime("last thursday midnight",$previous_week);
        $start_week = date("Y-m-d",$start_week);
echo $start_week.' ' ;
  ?> 