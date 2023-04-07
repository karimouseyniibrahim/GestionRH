<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title="Personnels";


if(isset($_POST['SauvePersonnels'])){
    extract($_POST);
   
	if($SauvePersonnels=='Enregistrer'){
 
        
		$q=$db->prepare("INSERT INTO   `personnelles_manoeuvres`(`MATRICULEV`, `NOM`, `ANNEE_NAIS`, `NR_CNSS`, 
        `SEXE`, `LIEUNAISS`, `DATE_NAISS`, `CARTE_NAT`, `DATE_CART`, `LIEU_CART`, `CARTE_ISC`)
        VALUES (:MATRICULEV,:NOM, :ANNEE_NAIS, :NR_CNSS, :SEXE, :LIEUNAISS, :DATE_NAISS, :CARTE_NAT, :DATE_CART, :LIEU_CART, :CARTE_ISC) ");
		
         try{
           
			$q->execute(array(
                ":MATRICULEV"=>$MATRICULE,
                ":NOM"=>$NOM, 
                ":ANNEE_NAIS"=>date("Y",strtotime($DATE_NAISS)), 
                ":NR_CNSS"=>$NR_CNSS, 
                ":SEXE"=>$SEXE, 
                ":LIEUNAISS"=>$LIEUNAISS, 
                ":DATE_NAISS"=>date("d/m/Y",strtotime($DATE_NAISS)), 
                ":CARTE_NAT"=>$CARTE_NAT, 
                ":DATE_CART"=>date("d/m/Y",strtotime($DATE_CART)), 
                ":CARTE_NAT"=>$CARTE_NAT, 
                ":DATE_CART"=>$DATE_CART, 
                ":LIEU_CART"=>$LIEU_CART, 
                ":CARTE_ISC"=>$CARTE_ISC
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

	}else if($SauvePersonnels=='Modifier'){
		$q=$db->prepare("UPDATE   `personnelles_manoeuvres` set `MATRICULEV`=:MATRICULEV, `NOM`=:NOM, `ANNEE_NAIS`=:ANNEE_NAIS, `NR_CNSS`=:NR_CNSS, 
        `SEXE`=:SEXE, `LIEUNAISS`=:LIEUNAISS, `DATE_NAISS`=:DATE_NAISS, `CARTE_NAT`=:CARTE_NAT, `DATE_CART`=:DATE_CART, 
        `LIEU_CART`=:LIEU_CART, `CARTE_ISC`=:CARTE_ISC where `id`=:id");
		try{

		$q->execute(array(
            ":id"=>$id,
            ":MATRICULEV"=>$MATRICULE,
            ":NOM"=>$NOM, 
            ":ANNEE_NAIS"=>date("Y",strtotime($DATE_NAISS)), 
            ":NR_CNSS"=>$NR_CNSS, 
            ":SEXE"=>$SEXE, 
            ":LIEUNAISS"=>$LIEUNAISS, 
            ":DATE_NAISS"=>date("d/m/Y",strtotime($DATE_NAISS)), 
            ":CARTE_NAT"=>$CARTE_NAT, 
            ":DATE_CART"=>date("d/m/Y",strtotime($DATE_CART)), 
            ":LIEU_CART"=>$LIEU_CART, 
            ":CARTE_ISC"=>$CARTE_ISC));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        //include('html/viewmanoeuvre-pointages.php');
        exit;
	}else if($SauvePersonnels=='Supprimer'){
        $q=$db->prepare("delete from `personnelles_manoeuvres`  where `id` =:id");
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
		  include("views/personnels-manoeuvres.view.php");
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


  
    