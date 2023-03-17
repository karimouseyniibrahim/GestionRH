<?php
session_start();
require("config/db.php");
require("includes/functions.php");
$title=Hebergement;
$limit_right=isset($_GET['page'])?$_GET['page']:1;
if(isset($_POST['sauve_facturation'])){
    extract($_POST);
	if($sauve_facturation=='Enregistrer'){
		$q=$db->prepare("INSERT INTO  `facturations`(`hs_numero`, `forfait`, `programme`, 
        `chambre`, `date_arrivee`, `date_depart`, `doit`, `prixUnitaire_chambre`, 
        `mode_paiement`,`idclient`,`PlusP`)
		VALUES (:hs_numero, :forfait, :programme, :chambre, :date_arrivee, :date_depart, :doit,
        :prixUnitaire_chambre, :mode_paiement, :idclient,:PlusP)");
		try{
			$q->execute(array(
				':hs_numero' => $hsnumero,
				':forfait' => $forfait,
				':programme' => $programme,
				':chambre' => $chambre,
                ':date_arrivee' => $date_arrivee,
                ':date_depart' => $date_depart,
                ':doit' => $doit,
                ':prixUnitaire_chambre' => $prixUnitaire_chambre,
                ':mode_paiement' => $mode_paiement,
                ':idclient' => $IDclient,
                ':PlusP' => isset($personnePlus)?1:0));
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}
       $clientsaved=$q->rowCount();
        if($clientsaved){
            $_SESSION['notification']['message'] = 'Facture enregistrer avec success!';
            $_SESSION['notification']['type'] = "info";
            clear_data_post();
            redirect('facturations.php?page='.$limit_right);
        }else{
            set_flash("Facture non enregistrer", 'danger');
            save_input_data();
        }
	}else if($sauve_facturation=='Modifier'){
		$q=$db->prepare("UPDATE `facturations` set `hs_numero`=:hs_numero, `forfait`=:forfait, `programme`=:programme, 
        `chambre`=:chambre, `date_arrivee`=:date_arrivee, `date_depart`=:date_depart, `doit`=:doit,`PlusP`=:PlusP,
        `prixUnitaire_chambre`=:prixUnitaire_chambre, `mode_paiement`=:mode_paiement,`idclient`=:idclient where `idfact`=:idfact");
		try{
		$q->execute(array(
			':idfact'=>$idfact,
			':hs_numero' => $hsnumero,
            ':forfait' => $forfait,
            ':programme' => $programme,
            ':chambre' => $chambre,
            ':date_arrivee' => $date_arrivee,
            ':date_depart' => $date_depart,
            ':doit' => $doit,
            ':prixUnitaire_chambre' => $prixUnitaire_chambre,
            ':mode_paiement' => $mode_paiement,
            ':idclient' => $IDclient,
            ':PlusP' => isset($personnePlus)?1:0));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
       redirect('facturations.php?page='.$limit_right);
	}else if($sauve_facturation=='Supprimer'){
        $q=$db->prepare("delete from `facturations`  where `idfact`=:idfact");
		try{
		$q->execute(array(
			':idfact'=>$idfact
        ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
       redirect('facturations.php?page='.$limit_right);
    }
}

$Cclient=count_facturations();
$nbr_pages=(int) ($Cclient/20)+1;
$limit_left=($limit_right-1)*20;
$limit_right=$limit_right*20;
$clients=LClients();
$chambres=LChambres();
$factures=liste_facturations($limit_left,$limit_right);
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
		  include("views/facturations.view.php");
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


  
    