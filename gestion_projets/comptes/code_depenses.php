<?php
session_start();
include("../../filters/auth_filter.php");
require("../../config/db.php");
require("../../includes/functions.php");
$title='Plan Comptable';

$CountData=count_codeAnalytique(20);
$nbr_pages=(int) ($CountData/140)+1;

if(isset($_POST['SauvePlanComptable'])){
    extract($_POST);
   
	if($SauvePlanComptable=='Enregistrer'){
		$q=$db->prepare("INSERT INTO `gp_plan_analytique`(`compte`, `description`, `Nature`, `Rubrique`) 
		VALUES(:compte,:description,:Nature,:Rubrique)");
		try{
			$q->execute(array(
                ':compte' => $compte,
                ':description' => $description,
                ':Nature' => $Nature,
                ':Rubrique' => $Rubrique));
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
		$q=$db->prepare("UPDATE `gp_plan_analytique` SET `compte`=:compte,`description`=:description,
		`Nature`=:Nature,`Rubrique`=:Rubrique where `id`=:id");
		try{
		$q->execute(array(
            ':id' => $id,
            ':compte' => $compte,
			':description' => $description,
			':Nature' => $Nature,
			':Rubrique' => $Rubrique));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        //echo GetHtmlCodeAnalytique($codtab,$page);
        exit;
	}else if($SauvePlanComptable=='Supprimer'){
        $q=$db->prepare("delete from `gp_plan_analytique`  where `id` =:id");
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
		  include("view/code_depenses.view.php");
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


  
    