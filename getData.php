<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");

if(isset($_GET['intervalle'])){
    extract($_POST);
    $q=$db->prepare("select f.*,c.nom,c.prenom,c.adresse from facturations as f 
        inner join clients as c ON c.idclient=f.idclient where date_arrivee>=:date_arrivee and date_depart<=:date_depart");     
        $q->execute(array(
            ":date_arrivee"=>$DateArrive,
            ":date_depart"=>$DateDepart
        )); 
    

    echo json_encode($q->fetchAll(PDO::FETCH_OBJ));
}else if(isset($_POST['consommation'])){
    extract($_POST);
    echo GetConsommationByHebergement($client);

}else if(isset($_POST['sauve_consommations'])){
    extract($_POST);
   
	if($sauve_consommations=='Enregistrer'){
		$q=$db->prepare("INSERT INTO   `consommations`(`designation`, `nombre`, `prix_unitaire`, `idfact`)
		VALUES (:designation, :nombre, :prix_unitaire, :idfact)");
		try{
			$q->execute(array(
				':designation' => $Designation,
				':nombre' => $nombre,
				':prix_unitaire' => $prix_unitaire,
				':idfact' => $IDHebergement));
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}
       $Datasaved=$q->rowCount();
        if($Datasaved){
           //afficher la liste 
           echo GetConsommationByHebergement($IDHebergement);
           
        }else{
            //set_flash("Consommation  non enregistrer", 'danger');

            print_r($_POST);

        }
    }
    else if($sauve_consommations=='Modifier'){
	    $q=$db->prepare("UPDATE `consommations` set `designation`=:designation, `nombre`=:nombre, 
        `prix_unitaire`=:prix_unitaire, `idfact`=:idfact where `idconsommation`=:idconsommation");
		try{
		$q->execute(array(
            ':idconsommation' => $idconsommation,
			':designation' => $Designation,
            ':nombre' => $nombre,
            ':prix_unitaire' => $prix_unitaire,
            ':idfact' => $IDHebergement));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
//print_r($_POST);
      echo GetConsommationByHebergement($IDHebergement);

	} 
    else if($sauve_consommations=='Supprimer'){
        $q=$db->prepare("delete from `consommations`  where `idconsommation`=:idconsommation");
		try{
		$q->execute(array(
			':idconsommation'=>$idconsommation
        ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		echo GetConsommationByHebergement($IDHebergement);
    }
}
exit;