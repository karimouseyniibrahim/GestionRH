<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title="Heure Supplementaires";

if(isset($_POST['sauve_Paiement'])){
    extract($_POST);
   
	if($sauve_Paiement=='Enregistrer'){
		$q=$db->prepare("INSERT INTO   `pay-elements`(`MATRICULEV`, `CODE`, `VALEUR`, `HEURE`, `NBJOURS`, `mois`, `annee`,	`element`)
		 VALUES (:MATRICULEV, 103, :VALEUR, :HEURE, :NBJOURS,:mois,:annee,'V')");
		try{
			$q->execute(array(
                ':MATRICULEV' => $MATRICULEV,
                ':VALEUR' => $VALEUR,
                ':HEURE' => $HEURE,
                ':NBJOURS' => GetNbrDayWork(),
                ':mois' => date("m"),
                ':annee' =>date("Y")
                ));
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}
       $saved=$q->rowCount();

	}else if($sauve_Paiement=='Modifier'){
		$q=$db->prepare("UPDATE  `pay-elements` set  `CODE`=103, `VALEUR`=:VALEUR, `HEURE`=:HEURE,mois=:mois,
         annee=:annee,NBJOURS=:NBJOURS,`element`='V' where `id`=:id");
		try{
		$q->execute(array(
            ':id' => $id,
			':VALEUR' => $VALEUR,
            ':NBJOURS' => GetNbrDayWork(),
            ':mois' => date("m"),
            ':annee' =>date("Y"),
			':HEURE' => $HEURE
        ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		//clear_data_post();        
        // echo GetHtmlPaiElement($MATRICULEV,$element);
        //exit;
	}
}

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
		  include("views/heure-supplementaires.view.php");
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
<?php require("partials/footer.php"); ?>


  
    