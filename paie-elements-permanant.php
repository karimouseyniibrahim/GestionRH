<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title="Element Permanant";

if(isset($_POST['sauve_Paiement'])){
    extract($_POST);
   
	if($sauve_Paiement=='Enregistrer'){
		$q=$db->prepare("INSERT INTO   `pay-elements`(`MATRICULEV`, `CODE`, `VALEUR`, `COMPTE`, `NBJOURS`, `mois`, `annee`,	`element`)
		VALUES (:MATRICULEV, :CODE, :VALEUR, :COMPTE, :NBJOURS,:mois,:annee,:element)");
		try{
			$q->execute(array(
				':element'=>$element,
                ':MATRICULEV' => $MATRICULEV,
                ':CODE' => $CODE,
                ':VALEUR' => $VALEUR,
                ':COMPTE' => $COMPTE,
                ':NBJOURS' => GetNbrDayWork(),
                ':mois' => date("m"),
                ':annee' =>date("y")));
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}
       $saved=$q->rowCount();
        if($saved){
            $_SESSION['notification']['message'] = 'Element Permanant enregistrer avec success!';
            $_SESSION['notification']['type'] = "info";
            clear_data_post();
            echo GetHtmlPaiElement($MATRICULEV,$element);
            exit;
        }else{
            set_flash("Element Permanant  non enregistrer", 'danger');
            save_input_data();
        }

	}else if($sauve_Paiement=='Modifier'){
		$q=$db->prepare("UPDATE  `pay-elements` set  `CODE`=:CODE, `VALEUR`=:VALEUR, `COMPTE`=:COMPTE where `id`=:id");
		try{
		$q->execute(array(
            ':id' => $id,
			':CODE' => $CODE,
			':VALEUR' => $VALEUR,
			':COMPTE' => $COMPTE,));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
         echo GetHtmlPaiElement($MATRICULEV,$element);
        exit;
	}else if($sauve_Paiement=='Supprimer'){
        $q=$db->prepare("delete from `pay-elements`  where `id` =:id");
		try{
		$q->execute(array(
			':id'=>$id
        ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
		echo GetHtmlPaiElement($MATRICULEV,$element);
        exit;
    }
}else if(isset($_POST['Request'])){
    extract($_POST);
    if($Request=='loadData'){
        //  echo GetHtmlPaiElement($codtab,(int)$page);
        exit;
    }

}else{ 

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
		  include("views/paie-elements-permanant.view.php");
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
require("partials/footer.php");

}
?>


  
    