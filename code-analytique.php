<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title='Code Analytique';

$CountData=count_codeAnalytique(20);
$nbr_pages=(int) ($CountData/140)+1;

if(isset($_POST['sauve_codeanalytique'])){
    extract($_POST);
   
	if($sauve_codeanalytique=='Enregistrer'){
		$q=$db->prepare("INSERT INTO   `codeanalytique`(`CODTAB`, `CODLIB`, `LIBLONG`, `LIBCOURT`, `TYPEDON`)
		VALUES (:codtab, :codlib, :liblong, :libcourt, :typedon)");
		try{
			$q->execute(array(
                ':codtab' => $codtab,
                ':codlib' => $codlib,
                ':liblong' => $liblong,
                ':libcourt' => $libcourt,
                ':typedon' => $typedon));
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}
       $saved=$q->rowCount();
        if($saved){
            $_SESSION['notification']['message'] = 'Rubrique enregistrer avec success!';
            $_SESSION['notification']['type'] = "info";
            clear_data_post();
            echo GetHtmlCodeAnalytique($codtab,$page);
            exit;
        }else{
            set_flash("Code Analytique  non enregistrer", 'danger');
            save_input_data();
        }

	}else if($sauve_codeanalytique=='Modifier'){
		$q=$db->prepare("UPDATE `codeanalytique` set `CODTAB`=:codtab, `LIBLONG`=:liblong, `LIBCOURT`=:libcourt, `TYPEDON`=:typedon,`CODLIB`=:codlib where `id`=:id");
		try{
		$q->execute(array(
            ':id' => $id,
            ':codtab' => $codtab,
            ':codlib' => $codlib,
            ':liblong' => $liblong,
            ':libcourt' => $libcourt,
            ':typedon' => $typedon));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        echo GetHtmlCodeAnalytique($codtab,$page);
        exit;
	}else if($sauve_codeanalytique=='Supprimer'){
        $q=$db->prepare("delete from `codeanalytique`  where `id` =:id");
		try{
		$q->execute(array(
			':id'=>$codlib
        ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        echo GetHtmlCodeAnalytique($codtab,$page);
        exit;
    }
}else if(isset($_POST['Request'])){
    extract($_POST);
    if($Request=='loadData'){
          echo GetHtmlCodeAnalytique($codtab,(int)$page);
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
		  include("views/code-analytique.view.php");
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


  
    