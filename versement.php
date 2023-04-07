<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title="Virement Ponctuel";


if(isset($_POST['SauveBonReglements'])){
    extract($_POST);
   
	if($SauveBonReglements=='Enregistrer'){

        
		$q=$db->prepare("INSERT INTO    `versement`(`deposant`, `motif`, `nomBenf`, `numcompte`, `nbrDixmille`, 
        `nbrCinqMille`, `nbrDeuxmille`, `nbrMille`, `nbrcinqcent`, `nbrdeuxcentcinquante`, `nbrDeuxCent`, `nbrCent`, 
        `nbrCinquante`, `nbrVingtcinq`, `nbrDix`, `nbrCinq`, `nbrUn`, `datecreate`, `montant`)
          VALUES (:deposant,:motif,:nomBenf,:numcompte,:nbrDixmille,:nbrCinqMille,:nbrDeuxmille,:nbrMille,:nbrcinqcent,
        :nbrdeuxcentcinquante,:nbrDeuxCent,:nbrCent,:nbrCinquante,:nbrVingtcinq,:nbrDix,:nbrCinq,:nbrUn,:datecreate,:montant)");
		try{
			$q->execute(array(
				":deposant"=>$deposant,
                ":motif"=>$motif, 
                ":montant"=>$montant, 
                ":nomBenf"=>$nomBenf, 
                ":numcompte"=>$numcompte, 
                ":nbrDixmille"=>$nbrDixmille, 
                ":nbrCinqMille"=>$nbrCinqMille, 
                ":nbrDeuxmille"=>$nbrDeuxmille, 
                ":nbrMille"=>$nbrMille,  
                ":nbrcinqcent"=>$nbrcinqcent,
                ":nbrdeuxcentcinquante"=>$nbrdeuxcentcinquante,
                ":nbrDeuxCent"=>$nbrDeuxCent,
                ":nbrCent"=>$nbrCent,
                ":nbrCinquante"=>$nbrCinquante,
                ":nbrVingtcinq"=>$nbrVingtcinq,
                ":nbrDix"=>$nbrDix,
                ":nbrCinq"=>$nbrCinq,
                ":nbrUn"=>$nbrUn,
                ":datecreate"=>$datecreate
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
		$q=$db->prepare("UPDATE   `versement` set `deposant`=:deposant, `motif`=:motif, `nomBenf`=:nomBenf, `numcompte`=:numcompte, `nbrDixmille`=:nbrDixmille, 
        `nbrCinqMille`=:nbrCinqMille, `nbrDeuxmille`=:nbrDeuxmille, `nbrMille`=:nbrMille, `nbrcinqcent`=:nbrcinqcent, `nbrdeuxcentcinquante`=:nbrdeuxcentcinquante, `nbrDeuxCent`=:nbrDeuxCent, `nbrCent`=:nbrCent, 
        `nbrCinquante`=:nbrCinquante, `nbrVingtcinq`=:nbrVingtcinq, `nbrDix`=:nbrDix, `nbrCinq`=:nbrCinq, `nbrUn`=:nbrUn, `datecreate`=:datecreate, `montant`=:montant  where `id`=:id");
		try{

		$q->execute(array(
            ':id' => $id,
			":deposant"=>$deposant,
            ":motif"=>$motif, 
            ":montant"=>$montant, 
            ":nomBenf"=>$nomBenf, 
            ":numcompte"=>$numcompte, 
            ":nbrDixmille"=>$nbrDixmille, 
            ":nbrCinqMille"=>$nbrCinqMille, 
            ":nbrDeuxmille"=>$nbrDeuxmille, 
            ":nbrMille"=>$nbrMille,  
            ":nbrcinqcent"=>$nbrcinqcent,
            ":nbrdeuxcentcinquante"=>$nbrdeuxcentcinquante,
            ":nbrDeuxCent"=>$nbrDeuxCent,
            ":nbrCent"=>$nbrCent,
            ":nbrCinquante"=>$nbrCinquante,
            ":nbrVingtcinq"=>$nbrVingtcinq,
            ":nbrDix"=>$nbrDix,
            ":nbrCinq"=>$nbrCinq,
            ":nbrUn"=>$nbrUn,
            ":datecreate"=>$datecreate));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        //include('html/viewmanoeuvre-pointages.php');
        exit;
	}else if($SauveBonReglements=='Supprimer'){
        $q=$db->prepare("delete from versement  where `id` =:id");
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
		  include("views/versement.view.php");
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


  
    