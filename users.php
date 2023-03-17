<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title='User';

$CountData=count_codeAnalytique(20);
$nbr_pages=(int) ($CountData/140)+1;

if(isset($_POST['sauve_connexion'])){
    extract($_POST);
   
	if($sauve_connexion=='Enregistrer'){
		$q=$db->prepare("INSERT INTO   `user`(`matricule`, `pwd`, `role`)
		VALUES (:matricule, :pwd, :role)");
		try{
			$q->execute(array(
                ':matricule' => $matricule,
                ':pwd' => sha1($password),
                ':role' => $role));
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}
       $saved=$q->rowCount();
        if($saved){
            $_SESSION['notification']['message'] = 'Utilisateur systeme enregistrer avec success!';
            $_SESSION['notification']['type'] = "info";
            clear_data_post();
            echo GetHtmlUsers();
            exit;
        }else{
            set_flash("Utilisateur systeme non enregistrer", 'danger');
            save_input_data();
        }

	}else if($sauve_connexion=='Modifier'){
		$q=$db->prepare("UPDATE `user` set `matricule`=:matricule, `pwd`=:pwd, `role`=:role where `id`=:id");
		try{
		$q->execute(array(
            ':id' => $id,
            ':matricule' => $matricule,
            ':pwd' => sha1($password),
            ':role' => $role));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        echo GetHtmlUsers();
        exit;
	}else if($sauve_connexion=='Supprimer'){
        $q=$db->prepare("delete from `user`  where `id` =:id");
		try{
		$q->execute(array(
			':id'=>$codlib
        ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        echo GetHtmlUsers();
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
		  include("views/users.view.php");
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


  
    