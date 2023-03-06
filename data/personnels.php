<?php

session_start();
require("../config/db.php");
require("../includes/functions.php");

if(isset($_POST['matricule'])&&isset($_POST['infos'])){
    extract($_POST);

    $q=$db->prepare("SELECT c.liblong,p.* FROM `personnelles` as p RIGHT JOIN codeanalytique as c ON p.CODEMPLOI=c.CODLIB WHERE c.CODTAB=38 and p.MATRICULEV=:MATRICULEV");  
    $param=array(":MATRICULEV"=>$matricule);   
        $q->execute($param); 

        $data=array(
            "personnel"=>$q->fetch(PDO::FETCH_OBJ),
            "pay"=>GetHtmlPaiElement($matricule,$element)
        );
    echo json_encode($data);
    exit;
}else if(isset($_POST['ElementP'])&&isset($_POST['id'])){
    extract($_POST);
    $data=$db->prepare("SELECT * FROM `pay-elements` WHERE `id`=:id AND `element`=:element");     
        $data->execute(array(":id"=>$id,":element"=>$element)); 
        echo json_encode($data->fetch(PDO::FETCH_OBJ));
        exit();
} 