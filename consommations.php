<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title=Consommations;
$limit_right=isset($_GET['page'])?$_GET['page']:1;



if(isset($_POST['sauve_consommations'])){
    extract($_POST);
   
	if($sauve_consommations=='Enregistrer'){
		$q=$db->prepare("INSERT INTO   `consommations`(`designation`, `nombre`, `prix_unitaire`, `idfact`)
		VALUES (:designation, :nombre, :prix_unitaire, :idfact)");
		try{
			$q->execute(array(
				':designation' => $Designation,
				':nombre' => $nombre,
				':prix_unitaire' => $prix_unitaire,
				':idfact' => isset($idfact)?$idfact:1));
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}
       $clientsaved=$q->rowCount();
        if($clientsaved){
            $_SESSION['notification']['message'] = 'Consommation enregistrer avec success!';
            $_SESSION['notification']['type'] = "info";
            clear_data_post();
            redirect('consommations.php?page='.$limit_right);
        }else{
            set_flash("Consommation  non enregistrer", 'danger');
            save_input_data();
        }
	}else if($sauve_consommations=='Modifier'){
		$q=$db->prepare("UPDATE `consommations` set `designation`=:designation, `nombre`=:nombre, 
        `prix_unitaire`=:prix_unitaire, `idfact`=:idfact where `idconsommation`=:idconsommation");
		try{
		$q->execute(array(
            ':idconsommation' => $idconsommation,
			':designation' => $Designation,
            ':nombre' => $nombre,
            ':prix_unitaire' => $prix_unitaire,
            ':idfact' => isset($idfact)?$idfact:1));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        redirect('consommations.php?page='.$limit_right);
	}else if($sauve_consommations=='Supprimer'){
        $q=$db->prepare("delete from `consommations`  where `idconsommation`=:idconsommation");
		try{
		$q->execute(array(
			':idconsommation'=>$idconsommation
        ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
       redirect('consommations.php?page='.$limit_right);
    }
}

$Cconsom=count_consommations();
$nbr_pages=(int) ($Cconsom/20)+1;
$limit_left=($limit_right-1)*20;
$limit_right=$limit_right*20;
$factures=Lfacturations();
$boisons=LBoisons();
$IntervalleDate=HebergementDate_Min_Max(); 
require("partials/header.php");
?>
<div class="wrapper">
	  <div class="body-overlay"></div>
	 <!-------sidebar--design------------>
	 <?php
     require("partials/sidebar.php");
     ?>
    <!-------sidebar--design- close----------->
      <!-------page-content start----------->
      <div id="content">
		  <!------top-navbar-start-----------> 
		  <?php
          require("partials/nav-bar.php");
          ?>
		  <!------top-navbar-end-----------> 
		  <?php
		  include("views/consommations.view.php");
		  ?>
		 <!----footer-design------------->
		 <footer class="footer">
		    <div class="container-fluid">
			   <div class="footer-in">
			      <!--p class="mb-0">&copy 2021 Vishweb Design . All Rights Reserved.</p-->
			   </div>
			</div>
		 </footer>
	  </div>
</div>
<!-------complete html----------->
<?php
require("partials/footer.php")
?>


  
    