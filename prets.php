<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title="Pret";

if(isset($_POST['sauve_Prets'])){
    extract($_POST);
 
	$d1=explode("-",$DATE_AC);
	$d2=explode("-",$DATEFIN);
	$d3=explode("-",$DATE_APPEL);
	if($sauve_Prets=='Enregistrer'){
		$q=$db->prepare("INSERT INTO   `prets`(`MATRICULEV`, `CODE`, `MONTANT_T`, `NBRE_ECHEA`, `PERIODE`, 
        `MONTANT_EC`, `DATE_APPEL`, `DATE_AC`, `PAYE`, `DMOIS`, `CREDIT`, `DATEFIN`, `VALIDAT`,`num_ordre`,`code_type`,`num_reference`)
		VALUES (:MATRICULEV, :CODE, :MONTANT_T, :NBRE_ECHEA, :PERIODE, :MONTANT_EC, :DATE_APPEL, 
        :DATE_AC, :PAYE, :DMOIS, :CREDIT, :DATEFIN, :VALIDAT,:num_ordre,:code_type,:num_reference)");
		try{
            //MATRICULEV ,CODE,CREDIT,MONTANT_R,NBRE_ECHEA,PAYE,DATE_APPEL,DATE_AC
			
			$q->execute(array( 
				':num_ordre'=>$num_ordre,
				':code_type'=>$code_type,
				':num_reference'=>$num_reference,
                ':PERIODE'=>$PERIODE,
                ':MATRICULEV' => $MATRICULEV,
                ':CODE' => $CODE,
                ':CREDIT' => $CREDIT,
                ':MONTANT_T' => $MONTANT_R,
                ':MONTANT_EC'=>$MONTANT_EC,
                ':NBRE_ECHEA' => $NBRE_ECHEA,
                ':PAYE' => $PAYE,
                ':DATE_AC' => "$d1[2]/$d1[1]/$d1[0]",
                ':DMOIS'=>$DMOIS,
                ':DATEFIN'=>"$d2[2]/$d2[1]/$d2[0]",
				':VALIDAT'=>"O",
                ':DATE_APPEL' =>"$d3[2]/$d3[1]/$d3[0]"));
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}
       $saved=$q->rowCount();
        if($saved){
            $_SESSION['notification']['message'] = 'Element Permanant enregistrer avec success!';
            $_SESSION['notification']['type'] = "info";
            clear_data_post();
            echo GetHtmlPrets();
            exit;
        }else{
            set_flash("Element Permanant  non enregistrer", 'danger');
            save_input_data();
        }

	}else if($sauve_Prets=='Modifier'){
		$q=$db->prepare("UPDATE  `prets` set `MATRICULEV`=:MATRICULEV, `CODE`=:CODE, `MONTANT_T`=:MONTANT_T, 
		`NBRE_ECHEA`=:NBRE_ECHEA, `PERIODE`=:PERIODE, `MONTANT_EC`=:MONTANT_EC, `DATE_APPEL`=:DATE_APPEL, 
		`DATE_AC`=:DATE_AC,`num_ordre`=:num_ordre,`code_type`=:code_type,`num_reference`=:num_reference,`PAYE`=:PAYE, 
		`DMOIS`=:DMOIS, `CREDIT`=:CREDIT, `DATEFIN`=:DATEFIN, `VALIDAT`=:VALIDAT where `id`=:id ");
		try{
		$q->execute(array(
            ':id' => $id,
			':num_ordre'=>$num_ordre,
			':code_type'=>$code_type,
			':num_reference'=>$num_reference,
			':PERIODE'=>$PERIODE,
			':MATRICULEV' => $MATRICULEV,
			':CODE' => $CODE,
			':CREDIT' => $CREDIT,
			':MONTANT_T' => $MONTANT_R,
			':MONTANT_EC'=>$MONTANT_EC,
			':NBRE_ECHEA' => $NBRE_ECHEA,
			':PAYE' => $PAYE,
			':DATE_AC' => "$d1[2]/$d1[1]/$d1[0]",
			':DMOIS'=>$DMOIS,
			':DATEFIN'=>"$d2[2]/$d2[1]/$d2[0]",
			':VALIDAT'=>"O",
			':DATE_APPEL' =>"$d3[2]/$d3[1]/$d3[0]"));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
         echo GetHtmlPrets();
        exit;
	}else if($sauve_Prets=='Supprimer'){
        $q=$db->prepare("delete from `prets`  where `id` =:id");
		try{
		$q->execute(array(
			':id'=>$id
        ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
		echo GetHtmlPrets();
        exit;
    }
}else if(isset($_POST['Request'])){
    extract($_POST);
    if($Request=='loadData'){
        //  echo GetHtmlPaiElement($codtab,(int)$page);
        exit;
    }

}else{ 
require("partials/header.php");?>
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
		  include("views/prets.view.php");
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


  
    