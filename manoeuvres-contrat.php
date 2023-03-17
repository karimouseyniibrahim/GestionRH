<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title="Contrat Manoeuvre";

if(isset($_POST['sauve_contrat'])){
    extract($_POST);
   
	if($sauve_contrat=='Enregistrer'){

        //`id`, `IDNBR`, `MATRICULEV`, `DEBUT_CONT`, `FIN_CONT`, `CODELOCA`, `LOCALITE`, `CODE_ANAL`, `TOTAL`, `SUPERVISE`, `PRIX_HOR`, `PROGRAMME`, `NUME_LETT`, `DATE_LETT`, `CODE_SUPP`, `CARTE_ISC`, `statut`
		$q=$db->prepare("INSERT INTO   `manoeuvres`( `MATRICULEV`, `DEBUT_CONT`, `FIN_CONT`, 
        `LOCALITE`, `CODE_ANAL`, `PRIX_HOR`, `NUME_LETT`, `DATE_LETT`, `CODE_SUPP`, `statut`,COMPTE)
		VALUES (:MATRICULEV, :DEBUT_CONT, :FIN_CONT, :LOCALITE,:CODE_ANAL, :PRIX_HOR, :NUME_LETT, :DATE_LETT, :CODE_SUPP, 
        :statut,:COMPTE)");
		try{
			$q->execute(array(
				":MATRICULEV"=>$MATRICULEV, 
                ":DEBUT_CONT"=>date("d/m/Y",strtotime($DEBUT_CONT)), 
                ":FIN_CONT"=>date("d/m/Y",strtotime($FIN_CONT)), 
                ":LOCALITE"=>$LOCALITE,
                ":CODE_ANAL"=>$CODE_ANAL, 
                ":PRIX_HOR"=>325, 
                ":NUME_LETT"=>$NUME_LETT, 
                ":DATE_LETT"=>date("d/m/Y",strtotime($DATE_LETT)), 
                ":CODE_SUPP"=>$CODE_SUPP,  
                ":statut"=>1,
                ":COMPTE"=>$COMPTE));
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}
       $saved=$q->rowCount();
        if($saved){
            $_SESSION['notification']['message'] = 'Contrat enregistrer avec success!';
            $_SESSION['notification']['type'] = "info";
            clear_data_post();
			include('html/viewcontrat-manoeuvre.php');
           // echo GetHtmlPaiElement($MATRICULEV,$element);
            exit;
        }else{
            set_flash("Contrat non enregistrer", 'danger');
            save_input_data();
        }

	}else if($sauve_contrat=='Modifier'){
		$q=$db->prepare("UPDATE  `manoeuvres` set `MATRICULEV`=:MATRICULEV, `DEBUT_CONT`=:DEBUT_CONT, `FIN_CONT`=:FIN_CONT, 
        `LOCALITE`=:LOCALITE, `CODE_ANAL`=:CODE_ANAL, `PRIX_HOR`=:PRIX_HOR, `NUME_LETT`=:NUME_LETT, `DATE_LETT`=:DATE_LETT, 
        `CODE_SUPP`=:CODE_SUPP, `COMPTE`=:COMPTE where `id`=:id");
		try{
		$q->execute(array(
            ':id' => $id,
            ":MATRICULEV"=>$MATRICULEV,
			":DEBUT_CONT"=>date("d/m/Y",strtotime($DEBUT_CONT)), 
            ":FIN_CONT"=>date("d/m/Y",strtotime($FIN_CONT)), 
            ":LOCALITE"=>$LOCALITE,
            ":CODE_ANAL"=>$CODE_ANAL, 
            ":PRIX_HOR"=>325, 
            ":NUME_LETT"=>$NUME_LETT, 
            ":DATE_LETT"=>date("d/m/Y",strtotime($DATE_LETT)), 
            ":CODE_SUPP"=>$CODE_SUPP, 
            ":COMPTE"=>$COMPTE ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		//print_r($_POST)   ; 
        include('html/viewcontrat-manoeuvre.php');
        clear_data_post();   
         
        exit;
	}else if($sauve_contrat=='Supprimer'){
        $q=$db->prepare("delete from `manoeuvres`  where `id` =:id");
		try{
		$q->execute(array(
			':id'=>$id
        ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
		include('html/viewcontrat-manoeuvre.php');
        exit;
    }
}else if(isset($_POST['Request'])){
    extract($_POST);
    if($Request=='infosContrat'){

		echo GetHtmlContratManoeuvresByCode_Sup($code,$supp);
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
		  include("views/manoeuvres-contrat.view.php");
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


  
    