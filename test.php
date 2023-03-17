<?php
session_start();
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
}*/
$NR_MATISC=371;
print_r( GetPointageManoeuvresByCode_Sup('2023-03-01'));