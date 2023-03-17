<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title="Edition Cheque";


if(isset($_POST['SauveBonReglements'])){
    extract($_POST);
   
	if($SauveBonReglements=='Enregistrer'){

        
		$q=$db->prepare("INSERT INTO   `bon_reglement`(`DATE_BDR`, `CODE_FR`, `MOTIF_BDR`, 
        `MONTANT_TTC`, `MONTANT_ISB`, `AVANCE`, `TIMBRE`, `NETAPAYER`, `TYPE`,`CHEQUE`) 
        VALUES (:DATE_BDR,:CODE_FR,:MOTIF_BDR,:MONTANT_TTC,:MONTANT_ISB,:AVANCE,:TIMBRE,:NETAPAYER,:TYPE,:CHEQUE) ");
		try{
           
			$q->execute(array(
				":DATE_BDR"=>$DATE_BDR,
                ":CODE_FR"=>$LIBELLES, 
                ":MOTIF_BDR"=>$MOTIF_BDR, 
                ":MONTANT_TTC"=>$MONTANT_TTC, 
                ":MONTANT_ISB"=>$MONTANT_ISB, 
                ":AVANCE"=>$AVANCE, 
                ":TIMBRE"=>$TIMBRE, 
                ":TYPE"=>"CHEQUE", 
                ":NETAPAYER"=>$NETAPAYER,  
                ":CHEQUE"=>$CHEQUE
            ));
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}

       $saved=$q->rowCount();

        if($saved){
            $_SESSION['notification']['message'] = 'Contrat enregistrer avec success!';
            $_SESSION['notification']['type'] = "info";
            clear_data_post();
           // include('html/viewmanoeuvre-pointages.php');
            exit;
        }else{
            set_flash("Contrat non enregistrer", 'danger');
            save_input_data();
        }

	}else if($SauveBonReglements=='Modifier'){
		$q=$db->prepare("UPDATE   `bon_reglement` set `DATE_BDR`=:DATE_BDR,  `CODE_FR`=:CODE_FR, 
        `MOTIF_BDR`=:MOTIF_BDR, `MONTANT_TTC`=:MONTANT_TTC, `MONTANT_ISB`=:MONTANT_ISB, `AVANCE`=:AVANCE, `TIMBRE`=:TIMBRE, 
        `NETAPAYER`=:NETAPAYER, `TYPE`=:TYPE,`CHEQUE`=:CHEQUE where `id`=:id");
		try{

		$q->execute(array(
            ':id' => $id,
			":DATE_BDR"=>$DATE_BDR,
            ":CODE_FR"=>$LIBELLES, 
            ":MOTIF_BDR"=>$MOTIF_BDR, 
            ":MONTANT_TTC"=>$MONTANT_TTC, 
            ":MONTANT_ISB"=>$MONTANT_ISB, 
            ":AVANCE"=>$AVANCE, 
            ":TIMBRE"=>$TIMBRE, 
            ":TYPE"=>"CHEQUE", 
            ":NETAPAYER"=>$NETAPAYER,  
            ":CHEQUE"=>$CHEQUE));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        //include('html/viewmanoeuvre-pointages.php');
        exit;
	}else if($SauveBonReglements=='Supprimer'){
        $q=$db->prepare("delete from `bon_reglement`  where `id` =:id");
		try{
		$q->execute(array(
			':id'=>$id
        ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
		//include('html/viewmanoeuvre-pointages.php');
        exit;
    }
}else if(isset($_POST['Request'])){
    

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
		  include("views/edition-reglement.view.php");
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
require("partials/footer1.php");

}
?>


  
    