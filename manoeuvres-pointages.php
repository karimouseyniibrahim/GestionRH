<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title="Pointage Manoeuvre";

if(isset($_POST['sauve_manoeuvre_heures'])){
    extract($_POST);
   
	if($sauve_manoeuvre_heures=='Enregistrer'){

        //`id`, `IDNBR`, `MATRICULEV`, `DEBUT_CONT`, `FIN_CONT`, `CODELOCA`, `LOCALITE`, `CODE_ANAL`, `TOTAL`, `SUPERVISE`, `PRIX_HOR`, `PROGRAMME`, `NUME_LETT`, `DATE_LETT`, `CODE_SUPP`, `CARTE_ISC`, `statut`
		$q=$db->prepare("INSERT INTO   `maneouvres_heures` (`MATRICULEV`, `JEU`, `JEU_SOIR`, `JEU_FERI`, `VEN`, 
        `VEN_SOIR`, `VEN_FERI`, `SAM`, `SAM_SOIR`, `SAM_FERI`, `DIM`, `DIM_SOIR`, `DIM_FERI`, `LUN`, `LUN_SOIR`, 
        `LUN_FERI`, `MAR`, `MAR_SOIR`, `MAR_FERI`, `MER`, `MER_SOIR`, `MER_FERI`, `NORM`, `SUPP`, `FERI`, 
        `HRS_TOTAL`, `CFA_TOTAL`, `CODEANAL`, `DEBUTSEM`, `CODACT`, `FINSEM`, `statut`,`retenue`,
        `CNSS_RET`, `CNSS_EMP`, `ANPE`, `SALABRUT`, `NETPAYER`, `GAINCONG`,COMPTE,DEPENSE,LOCALITE) 
        VALUES (:MATRICULEV, :JEU, :JEU_SOIR, :JEU_FERI, :VEN, :VEN_SOIR, :VEN_FERI, :SAM, :SAM_SOIR, :SAM_FERI, 
        :DIM, :DIM_SOIR, :DIM_FERI, :LUN, :LUN_SOIR, :LUN_FERI, :MAR, :MAR_SOIR, :MAR_FERI, :MER, :MER_SOIR, 
        :MER_FERI, :NORM, :SUPP, :FERI, :HRS_TOTAL, :CFA_TOTAL, :CODEANAL, :DEBUTSEM, :CODACT, :FINSEM,1,:RETENUE,
        :CNSS_RET,:CNSS_EMP,:ANPE,:SALABRUT,:NETPAYER, :GAINCONG,:COMPTE,:DEPENSE,:LOCALITE)");
		try{
            $SALABASE=($NORM+$SUPP+$FERI)*$prix_hor;
            $GAINCONG=(round(($NORM+$SUPP+$FERI)*27.08,1));
            $SALABRUT=$SALABASE+$GAINCONG;
            $CNSS_RET=round($SALABRUT*0.0525);
            $CNSS_EMP=round($SALABRUT*0.164);
            $ANPE=round($SALABRUT*0.005);
           
            $NETPAYER=$SALABRUT-$CNSS_RET-$RETENUE;
			$q->execute(array(
				":MATRICULEV"=>$MATRICULEV,
                ":JEU"=>$JEU, 
                ":JEU_SOIR"=>$JEU_SOIR, 
                ":JEU_FERI"=>$JEU_FERI, 
                ":VEN"=>$VEN, 
                ":VEN_SOIR"=>$VEN_SOIR, 
                ":VEN_FERI"=>$VEN_FERI, 
                ":SAM"=>$SAM, 
                ":SAM_SOIR"=>$SAM_SOIR, 
                ":SAM_FERI"=>$SAM_FERI, 
                ":DIM"=>$DIM, 
                ":COMPTE"=>$COMPTE,
                ":DEPENSE"=>$DEPENSE,
                ":LOCALITE"=>$LOCALITE,
                ":DIM_SOIR"=>$DIM_SOIR, 
                ":DIM_FERI"=>$DIM_FERI, 
                ":LUN"=>$LUN, 
                ":LUN_SOIR"=>$LUN_SOIR, 
                ":LUN_FERI"=>$LUN_FERI, 
                ":MAR"=>$MAR, 
                ":MAR_SOIR"=>$MAR_SOIR, 
                ":MAR_FERI"=>$MAR_FERI, 
                ":MER"=>$MER, 
                ":MER_SOIR"=>$MER_SOIR, 
                ":MER_FERI"=>$MER_FERI, 
                ":NORM"=>$NORM, 
                ":SUPP"=>$SUPP, 
                ":FERI"=>$FERI, 
                ":HRS_TOTAL"=>($NORM+$SUPP+$FERI), 
                ":CFA_TOTAL"=>($NORM+$SUPP+$FERI)*$prix_hor, 
                ":CODEANAL"=>$CODE_ANAL, 
                ":GAINCONG"=>$GAINCONG,
                ":CNSS_RET"=>$CNSS_RET, 
                ":CNSS_EMP"=>$CNSS_EMP, 
                ":ANPE"=>$ANPE, 
                ":NETPAYER"=>$NETPAYER, 
                ":SALABRUT"=>$SALABRUT, 
                ":DEBUTSEM"=>$DEBUTSEM, 
                ":CODACT"=>$CODE_SUPP, 
                ":FINSEM"=>$FINSEM,
                ":RETENUE"=>$RETENUE));
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}
       $saved=$q->rowCount();
        if($saved){
            $_SESSION['notification']['message'] = 'Contrat enregistrer avec success!';
            $_SESSION['notification']['type'] = "info";
            clear_data_post();
            include('html/viewmanoeuvre-pointages.php');
            exit;
        }else{
            set_flash("Contrat non enregistrer", 'danger');
            save_input_data();
        }

	}else if($sauve_manoeuvre_heures=='Modifier'){
		$q=$db->prepare("UPDATE   `maneouvres_heures` set `MATRICULEV`=:MATRICULEV, `JEU`=:JEU, `JEU_SOIR`=:JEU_SOIR, 
        `JEU_FERI`=:JEU_FERI, `VEN`=:VEN, `VEN_SOIR`=:VEN_SOIR, `VEN_FERI`=:VEN_FERI, `SAM`=:SAM, `SAM_SOIR`=:SAM_SOIR, 
        `SAM_FERI`=:SAM_FERI, `DIM`=:DIM, `DIM_SOIR`=:DIM_SOIR, `DIM_FERI`=:DIM_FERI, `LUN`=:LUN, `LUN_SOIR`=:LUN_SOIR, 
        `LUN_FERI`=:LUN_FERI, `MAR`=:MAR, `MAR_SOIR`=:MAR_SOIR, `MAR_FERI`=:MAR_FERI, `MER`=:MER, `MER_SOIR`=:MER_SOIR, 
        `MER_FERI`=:MER_FERI, `NORM`=:NORM, `SUPP`=:SUPP, `FERI`=:FERI, `HRS_TOTAL`=:HRS_TOTAL, `CFA_TOTAL`=:CFA_TOTAL, 
        `CODEANAL`=:CODEANAL, `DEBUTSEM`=:DEBUTSEM, `CODACT`=:CODACT, `FINSEM`=:FINSEM, statut=1,`retenue`=:RETENUE,
        `CNSS_RET`=:CNSS_RET, `CNSS_EMP`=:CNSS_EMP, `ANPE`=:ANPE, `SALABRUT`=:SALABRUT, `NETPAYER`=:NETPAYER, 
        `GAINCONG`=:GAINCONG,COMPTE=:COMPTE,LOCALITE=:LOCALITE,DEPENSE=:DEPENSE where `id`=:id");
		try{
            $SALABASE=($NORM+$SUPP+$FERI)*$prix_hor;
            $GAINCONG=round(($NORM+$SUPP+$FERI)*27.08);
            $SALABRUT=$SALABASE+$GAINCONG;
            $CNSS_RET=round($SALABRUT*0.0525);
            $CNSS_EMP=round($SALABRUT*0.164);
            $ANPE=round($SALABRUT*0.005);
            $NETPAYER=$SALABRUT-$CNSS_RET-$RETENUE;

		$q->execute(array(
            ':id' => $id,
			":MATRICULEV"=>$MATRICULEV,
            ":JEU"=>$JEU, 
            ":JEU_SOIR"=>$JEU_SOIR, 
            ":JEU_FERI"=>$JEU_FERI, 
            ":VEN"=>$VEN, 
            ":COMPTE"=>$COMPTE,
            ":DEPENSE"=>$DEPENSE,
            ":LOCALITE"=>$LOCALITE,
            ":VEN_SOIR"=>$VEN_SOIR, 
            ":VEN_FERI"=>$VEN_FERI, 
            ":SAM"=>$SAM, 
            ":SAM_SOIR"=>$SAM_SOIR, 
            ":SAM_FERI"=>$SAM_FERI, 
            ":DIM"=>$DIM, 
            ":DIM_SOIR"=>$DIM_SOIR, 
            ":DIM_FERI"=>$DIM_FERI, 
            ":LUN"=>$LUN, 
            ":LUN_SOIR"=>$LUN_SOIR, 
            ":LUN_FERI"=>$LUN_FERI, 
            ":MAR"=>$MAR, 
            ":MAR_SOIR"=>$MAR_SOIR, 
            ":MAR_FERI"=>$MAR_FERI, 
            ":MER"=>$MER, 
            ":MER_SOIR"=>$MER_SOIR, 
            ":MER_FERI"=>$MER_FERI, 
            ":NORM"=>$NORM, 
            ":SUPP"=>$SUPP, 
            ":FERI"=>$FERI, 
            ":HRS_TOTAL"=>($NORM+$SUPP+$FERI), 
            ":CFA_TOTAL"=>($NORM+$SUPP+$FERI)*$prix_hor, 
            ":CODEANAL"=>$CODE_ANAL, 

            ":GAINCONG"=>$GAINCONG,
            ":CNSS_RET"=>$CNSS_RET, 
            ":CNSS_EMP"=>$CNSS_EMP, 
            ":ANPE"=>$ANPE, 
            ":NETPAYER"=>$NETPAYER, 
            ":SALABRUT"=>$SALABRUT, 

            ":DEBUTSEM"=>$DEBUTSEM, 
            ":CODACT"=>$CODE_SUPP, 
            ":FINSEM"=>$FINSEM,
            ":RETENUE"=>$RETENUE));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        include('html/viewmanoeuvre-pointages.php');
        exit;
	}else if($sauve_manoeuvre_heures=='Supprimer'){
        $q=$db->prepare("delete from `maneouvres_heures`  where `id` =:id");
		try{
		$q->execute(array(
			':id'=>$id
        ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
		include('html/viewmanoeuvre-pointages.php');
        exit;
    }
}else if(isset($_POST['Request'])){
    extract($_POST);
    if($Request=='infosPointage'){

        include('html/viewmanoeuvre-pointages.php');
		 
        exit;
    }else if($Request=='valider'){
        $q=$db->prepare("UPDATE  `manoeuvres` set statut=0 where timestampdiff(DAY,:datevalidation,str_to_date(`FIN_CONT`,'%d/%m/%Y'))<=0 and statut=1");
		try{
		$q->execute(array(
            ':datevalidation' => $FINSEM ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
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
		  include("views/manoeuvres-pointages.view.php");
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


  
    