<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title="Virement Ponctuel";


if(isset($_POST['SauveBonReglements'])){
    extract($_POST);
   
	if($SauveBonReglements=='Enregistrer'){

        
		$q=$db->prepare("INSERT INTO   `virement_ponctuel`(`titulaire`, `num_compteDebit`, `montant`, `nombenf`, 
        `adresseBeneficiaire`, `banqueBenf`, `codeswift`, `codebanqueBenf`, `codeguicher`, `numcomptebenf`, `clerib`, 
        `motif`, `datecreat`) 
        VALUES (:titulaire,:num_compteDebit,:montant,:nombenf,:adresseBeneficiaire,:banqueBenf,:codeswift,:codebanqueBenf,
        :codeguicher,:numcomptebenf,:clerib,:motif,:datecreat) ");
		try{
           
			$q->execute(array(
				":titulaire"=>$titulaire,
                ":num_compteDebit"=>$num_compteDebit, 
                ":montant"=>$montant, 
                ":nombenf"=>$nombenf, 
                ":adresseBeneficiaire"=>$adresseBeneficiaire, 
                ":banqueBenf"=>$banqueBenf, 
                ":codeswift"=>$codeswift, 
                ":codebanqueBenf"=>$codebanqueBenf, 
                ":codeguicher"=>$codeguicher,  
                ":numcomptebenf"=>$numcomptebenf,
                ":clerib"=>$clerib,
                ":motif"=>$motif,
                ":datecreat"=>$datecreat
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
		$q=$db->prepare("UPDATE   `virement_ponctuel` set `titulaire`=:titulaire, `num_compteDebit`=:num_compteDebit, `montant`=:montant,
         `nombenf`=:nombenf,`adresseBeneficiaire`=:adresseBeneficiaire, `banqueBenf`=:banqueBenf, `codeswift`=:codeswift,
          `codebanqueBenf`=:codebanqueBenf, `codeguicher`=:codeguicher, `numcomptebenf`=:numcomptebenf, `clerib`=:clerib, 
          `motif`=:motif, `datecreat`=:datecreat   where `id`=:id");
		try{

		$q->execute(array(
            ':id' => $id,
			":titulaire"=>$titulaire,
            ":num_compteDebit"=>$num_compteDebit, 
            ":montant"=>$montant, 
            ":nombenf"=>$nombenf, 
            ":adresseBeneficiaire"=>$adresseBeneficiaire, 
            ":banqueBenf"=>$banqueBenf, 
            ":codeswift"=>$codeswift, 
            ":codebanqueBenf"=>$codebanqueBenf, 
            ":codeguicher"=>$codeguicher,  
            ":numcomptebenf"=>$numcomptebenf,
            ":clerib"=>$clerib,
            ":motif"=>$motif,
            ":datecreat"=>$datecreat));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        //include('html/viewmanoeuvre-pointages.php');
        exit;
	}else if($SauveBonReglements=='Supprimer'){
        $q=$db->prepare("delete from virement_ponctuel  where `id` =:id");
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
		  include("views/virement-ponctuels.view.php");
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


  
    