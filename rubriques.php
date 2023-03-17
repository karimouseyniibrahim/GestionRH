<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title=Rubriques;

if(isset($_POST['sauve_rubriques'])){
    extract($_POST);
   
	if($sauve_rubriques=='Enregistrer'){
		$q=$db->prepare("INSERT INTO   `rubriques`(`CODE`, `LIBELLE`, `TYPE`, `VALEUR`, `STATUT`)
		VALUES (:code, :libelle, :type,:valeur, :statut)");
		try{
			$q->execute(array(
                ':code' => $code,
                ':libelle' => $libelle,
                ':type' => $type,
                ':valeur' => $valeur,
                ':statut' => $statut));
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}
       $saved=$q->rowCount();
        if($saved){
            $_SESSION['notification']['message'] = 'Rubrique enregistrer avec success!';
            $_SESSION['notification']['type'] = "info";
            clear_data_post();
            echo GetHtmlRubriques($type);
            exit;
        }else{
            set_flash("Rubrique  non enregistrer", 'danger');
            save_input_data();
        }

	}else if($sauve_rubriques=='Modifier'){
		$q=$db->prepare("UPDATE `rubriques` set `LIBELLE`=:libelle,`TYPE`=:type, 
        `VALEUR`=:valeur,`STATUT`=:statut  where `CODE`=:code");
		try{
		$q->execute(array(
            ':code' => $code,
			':libelle' => $libelle,
            ':type' => $type,
            ':valeur' => $valeur,
            ':statut' => $statut));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        echo GetHtmlRubriques($type);
        exit;
	}else if($sauve_rubriques=='Supprimer'){
        $q=$db->prepare("delete from `rubriques`  where `CODE`=:code");
		try{
		$q->execute(array(
			':code'=>$code
        ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        echo GetHtmlRubriques($type);
        exit;
    }
}else if(isset($_POST['Request'])){
    extract($_POST);
    if($Request=='Rubrique'){
        echo GetHtmlRubriques($type);

        exit;
    }

}else{ 
$Rubriquestypes=GetRubriqueTypes();
 
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
		  include("views/rubriques.view.php");
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


  
    