<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title="Contrat";

if(isset($_POST['sauve_contrat'])){
    extract($_POST);
   
	if($sauve_contrat=='Enregistrer'){
		$q=$db->prepare("INSERT INTO   `contrat`(`REF`, `DATE`, `NR_MATISC`, `DEBUT`, `FIN`, `SAL_BASE`, `PROGRAMME`, `RESPPROG`, 
		`COMPTE`, `LIEU`, `CODE_BANQ`, `CODE_FONCT`, `NR_COMPTE`, `GRADE`, `POSITION`, `POUR_LOGE`,`NUMASSUR`)
		VALUES (:REF, :DATE, :NR_MATISC, :DEBUT, :FIN, :SAL_BASE, :PROGRAMME, :RESPPROG, :COMPTE, :LIEU, :CODE_BANQ, :CODE_FONCT, :NR_COMPTE, :GRADE, :POSITION, :POUR_LOGE,:NUMASSUR)");
		try{
			$q->execute(array(
				":REF"=>$REF, 
				":DATE"=>$DATE, 
				":NR_MATISC"=>$NR_MATISC, 
				":DEBUT"=>$DEBUT, 
				":FIN"=>$FIN, 
				":SAL_BASE"=>$SAL_BASE, 
				":PROGRAMME"=>$PROGRAMME, 
				":RESPPROG"=>$RESPPROG, 
				":COMPTE"=>$BUDGET, 
				":LIEU"=>$LIEU, 
				":CODE_BANQ"=>$CODE_BANQ, 
				":CODE_FONCT"=>$CODE_FONCT, 
				":NR_COMPTE"=>$NR_COMPTE, 
				":GRADE"=>$GRADE, 
				":POSITION"=>$POSITION, 
				":POUR_LOGE"=>$POUR_LOGE,
				":NUMASSUR"=>$NUMASSUR));
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}
       $saved=$q->rowCount();
        if($saved){
            $_SESSION['notification']['message'] = 'Contrat enregistrer avec success!';
            $_SESSION['notification']['type'] = "info";
            clear_data_post();
			include('html/viewcontrat.php');
           // echo GetHtmlPaiElement($MATRICULEV,$element);
            exit;
        }else{
            set_flash("Contrat non enregistrer", 'danger');
            save_input_data();
        }

	}else if($sauve_contrat=='Modifier'){
		$q=$db->prepare("UPDATE  `contrat` set `REF`=:REF, `DATE`=:DATE, `NR_MATISC`=:NR_MATISC, `DEBUT`=:DEBUT, `FIN`=:FIN, `SAL_BASE`=:SAL_BASE, `PROGRAMME`=:PROGRAMME, `RESPPROG`=:RESPPROG, 
		`COMPTE`=:COMPTE, `LIEU`=:LIEU, `CODE_BANQ`=:CODE_BANQ, `CODE_FONCT`=:CODE_FONCT, `NR_COMPTE`=:NR_COMPTE, `GRADE`=:GRADE, `POSITION`=:POSITION, `POUR_LOGE`=:POUR_LOGE,
		`NUMASSUR`=:NUMASSUR where `id`=:id");
		try{
		$q->execute(array(
            ':id' => $id,
			":REF"=>$REF, 
			":DATE"=>$DATE, 
			":NR_MATISC"=>$NR_MATISC, 
			":DEBUT"=>$DEBUT, 
			":FIN"=>$FIN, 
			":SAL_BASE"=>$SAL_BASE, 
			":PROGRAMME"=>$PROGRAMME, 
			":RESPPROG"=>$RESPPROG, 
			":COMPTE"=>$BUDGET, 
			":LIEU"=>$LIEU, 
			":CODE_BANQ"=>$CODE_BANQ, 
			":CODE_FONCT"=>$CODE_FONCT, 
			":NR_COMPTE"=>$NR_COMPTE, 
			":GRADE"=>$GRADE, 
			":POSITION"=>$POSITION, 
			":POUR_LOGE"=>$POUR_LOGE,
			":NUMASSUR"=>$NUMASSUR));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        include('html/viewcontrat.php');
        exit;
	}else if($sauve_contrat=='Supprimer'){
        $q=$db->prepare("delete from `contrat`  where `id` =:id");
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
    if($Request=='infosContrat'){
		$d=GetPersonnelInfos($matricule);
		$c=GetHtmlContratByPersonnel($matricule);
        //  echo GetHtmlPaiElement($codtab,(int)$page);
		$data=array("infos"=>$d,"contrat"=>$c);
		echo json_encode($data);
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
		  include("views/contrat.view.php");
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


  
    