<?php
session_start();
include("../../filters/auth_filter.php");
require("../../config/db.php");
require("../../includes/functions.php");
$title='Allocation Budget Comptable';

$CountData=count_codeAnalytique(20);
$nbr_pages=(int) ($CountData/140)+1;

if(isset($_POST['SauvePlanComptable'])){
    extract($_POST);
   
	if($SauvePlanComptable=='Enregistrer'){
		$q=$db->prepare("INSERT INTO `gp_bugets` (`compte`, `montant`, `annee`) VALUES(:compte,:montant,:annee)");
		try{
			$q->execute(array(
                ':compte' => $compte,
                ':montant' => $montant,
                ':annee' => $annee));
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}
       $saved=$q->rowCount();
        if($saved){
            $_SESSION['notification']['message'] = 'Plan Comptable enregistrer avec success!';
            $_SESSION['notification']['type'] = "info";
            clear_data_post();
           // echo GetHtmlCodeAnalytique($codtab,$page);
            exit;
        }else{
            set_flash("Plan Comptable  non enregistrer", 'danger');
            save_input_data();
        }

	}else if($SauvePlanComptable=='Modifier'){
		$q=$db->prepare("UPDATE `gp_bugets` SET `compte`=:compte,`montant`=:montant,
		`annee`=:annee where `id`=:id");
		try{
		$q->execute(array(
            ':id' => $id,
            ':compte' => $compte,
                ':montant' => $montant,
                ':annee' => $annee));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        //echo GetHtmlCodeAnalytique($codtab,$page);
        exit;
	}else if($SauvePlanComptable=='Supprimer'){
        $q=$db->prepare("delete from `gp_bugets`  where `id` =:id");
		try{
		$q->execute(array(
			':id'=>$id
        ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
      //  echo GetHtmlCodeAnalytique($codtab,$page);
        exit;
    }
}else if(isset($_POST['Request'])){
    extract($_POST);
    if($Request=='loadData'){
          //echo GetHtmlCodeAnalytique($codtab,(int)$page);
        exit;
    }

}else{ 

 
require("../partials/header.php");
?>
<div class="wrapper">
	  <div class="body-overlay"></div>
	 <!-------sidebar--design------------>
	 <?php
     require("../partials/sidebar.php");
     ?>
    <!-------sidebar--design- close----------->
      <!-------page-content start----------->
      <div id="content">
		  <!------top-navbar-start-----------> 
		  <?php
          require("../../partials/nav-bar.php");
          ?>
		  <!------top-navbar-end-----------> 
		  <?php
		  include("view/allocation_budgetaires.view.php");
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
require("../partials/footer1.php");
}
?>


  
    