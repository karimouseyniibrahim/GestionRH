<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title='Personnels';

$CountData=count_codeAnalytique(20);
$nbr_pages=(int) ($CountData/140)+1;

if(isset($_POST['sauve_personnel'])){
    extract($_POST);
   
	if($sauve_personnel=='Enregistrer'){
		$q=$db->prepare("INSERT INTO   `personnelles`(`MATRICULEV`, `NOM`, `PRENOMS`, `NOMJFILLE`, `DATENAIS`, 
        `LIEUNAIS`, `NATIONAL`, `SITFAMIL`, `NBFEMME`, `NBFEMSAL`, `NBENFAN`, `NBENFCNSS`, `DATEMBAUC`, `NUMDECIS`, 
        `CODEMPLOI`, `CORPSBRANC`, `DIVISION`, `SOUSDIVIS`, `LIEUAFFEC`, `POSITION`, `CATEGORIE`, `NUMSECUR`, `DATEAFSEC`, 
        `DATERETRAI`, `NUDECESSA`, `DATEDECESA`, `DATEPEFFE`, `CUMULJPE`, `NIVETUDE1`, `NIVETUDE2`, `DIPLOME1`, `DIPLOME2`, 
        `STAGEPRO1`, `STAGEPRO2`, `DIVERS1`, `DIVERS2`, `SEXE`,`SAL_BASE`, `COMPTE`, `T4`, `STATUT`, `REL_BANQUE`, 
        `NR_COMPTE`, `DATE_S`, `NUMASSUR`, `POUR_LOGE`, `LOGEMENT`)
		VALUES (:MATRICULEV, :NOM, :PRENOMS, :NOMJFILLE, :DATENAIS, :LIEUNAIS, :NATIONAL, :SITFAMIL, :NBFEMME,
        :NBFEMSAL, :NBENFAN, :NBENFCNSS, :DATEMBAUC, :NUMDECIS, :CODEMPLOI, :CORPSBRANC, :DIVISION, :SOUSDIVIS, :LIEUAFFEC,
        :POSITION, :CATEGORIE, :NUMSECUR, :DATEAFSEC, :DATERETRAI, :NUDECESSA, :DATEDECESA, :DATEPEFFE, :CUMULJPE, :NIVETUDE1,
        :NIVETUDE2, :DIPLOME1, :DIPLOME2, :STAGEPRO1, :STAGEPRO2, :DIVERS1, :DIVERS2, :SEXE, :SAL_BASE,
        :COMPTE, :T4, :STATUT, :REL_BANQUE,:NR_COMPTE,:DATE_S,:NUMASSUR,:POUR_LOGE,:LOGEMENT)");
		try{
            $tab=array(
                ":MATRICULEV"=>$MATRICULEV, 
                ":NOM"=>$NOM,
                ":PRENOMS"=>$PRENOMS,
                ":NOMJFILLE"=>$NOMJFILLE,
                ":DATENAIS"=>$DATENAIS,
                ":LIEUNAIS"=>$LIEUNAIS,
                ":NATIONAL"=>$NATIONAL,
                ":SITFAMIL"=>$SITFAMIL,
                ":NBFEMME"=>$NBFEMME,
                ":NBFEMSAL"=>$NBFEMSAL,
                ":NBENFAN"=>$NBENFAN,
                ":NBENFCNSS"=>$NBENFCNSS,
                ":DATEMBAUC"=>$DATEMBAUC,
                ":NUMDECIS"=>$NUMDECIS,
                ":CODEMPLOI"=>$CODEMPLOI,
                ":CORPSBRANC"=>$CORPSBRANC,
                ":DIVISION"=>$DIVISION,
                ":SOUSDIVIS"=>$SOUSDIVIS,
                ":LIEUAFFEC"=>$LIEUAFFEC,
                ":POSITION"=>$CADRE,
                ":CATEGORIE"=>$CATEGORIE,
                ":NUMSECUR"=>$NUMSECUR,
                ":DATEAFSEC"=>$DATEAFSEC,
                ":DATERETRAI"=>$DATERETRAI,
                ":NUDECESSA"=>$NUDECESSA,
                ":DATEDECESA"=>$DATEDECESA,
                ":DATEPEFFE"=>$DATEPEFFE,
                ":CUMULJPE"=>$CUMULJPE,
                ":NIVETUDE1"=>$NIVETUDE1,
                ":NIVETUDE2"=>$NIVETUDE2,
                ":DIPLOME1"=>$DIPLOME1,
                ":DIPLOME2"=>$DIPLOME2,
                ":STAGEPRO1"=>$STAGEPRO1,
                ":STAGEPRO2"=>$STAGEPRO2,
                ":DIVERS1"=>$DIVERS1,
                ":DIVERS2"=>$DIVERS2,
                ":SEXE"=>$SEXE,
                ":SAL_BASE"=>$SAL_BASE,
                ":COMPTE"=>$COMPTE,
                ":T4"=>$T4,
                ":STATUT"=>$STATUT,
                ":REL_BANQUE"=>$REL_BANQUE,
                ":NR_COMPTE"=>$NR_COMPTE, 
                ":DATE_S"=>$DATE_S,
                ":NUMASSUR"=>$NUMASSUR,
                ":POUR_LOGE"=>$POUR_LOGE,
                ":LOGEMENT"=>$LOGEMENT);
			$q->execute($tab);
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}
       $saved=$q->rowCount();
        if($saved){
            $_SESSION['notification']['message'] = 'Rubrique enregistrer avec success!';
            $_SESSION['notification']['type'] = "info";
            clear_data_post();
            redirect("personnels.php");
            exit;
        }else{
            print_r(array_values($tab));
            die();
            set_flash("Code Analytique  non enregistrer", 'danger');
            save_input_data();
        }

	}else if($sauve_personnel=='Modifier'){
		$q=$db->prepare("UPDATE  `personnelles` set `MATRICULEV`=:MATRICULEV, `NOM`=:NOM,
        `PRENOMS`=:PRENOMS, `NOMJFILLE`=:NOMJFILLE, `DATENAIS`=:DATENAIS, `LIEUNAIS`=:LIEUNAIS, `NATIONAL`=:NATIONAL,
        `SITFAMIL`=:SITFAMIL, `NBFEMME`=:NBFEMME, `NBFEMSAL`=:NBFEMSAL, `NBENFAN`=:NBENFAN, `NBENFCNSS`=:NBENFCNSS, 
        `DATEMBAUC`=:DATEMBAUC, `NUMDECIS`=:NUMDECIS,`CODEMPLOI`=:CODEMPLOI, `CORPSBRANC`=:CORPSBRANC, `DIVISION`=:DIVISION, 
        `SOUSDIVIS`=:SOUSDIVIS, `LIEUAFFEC`=:LIEUAFFEC, `POSITION`=:POSITION, `CATEGORIE`=:CATEGORIE, `NUMSECUR`=:NUMSECUR, 
        `DATEAFSEC`=:DATEAFSEC,`DATERETRAI`=:DATERETRAI, `NUDECESSA`=:NUDECESSA, `DATEDECESA`=:DATEDECESA, `DATEPEFFE`=:DATEPEFFE, 
        `CUMULJPE`=:CUMULJPE, `NIVETUDE1`=:NIVETUDE1, `NIVETUDE2`=:NIVETUDE2, `DIPLOME1`=:DIPLOME1, `DIPLOME2`=:DIPLOME2, 
        `STAGEPRO1`=:STAGEPRO1, `STAGEPRO2`=:STAGEPRO2, `DIVERS1`=:DIVERS1, `DIVERS2`=:DIVERS2, `SEXE`=:SEXE,
        `SAL_BASE`=:SAL_BASE, `COMPTE`=:COMPTE,`T4`=:T4, `STATUT`=:STATUT, `REL_BANQUE`=:REL_BANQUE, `NR_COMPTE`=:NR_COMPTE, 
        `DATE_S`=:DATE_S, `NUMASSUR`=:NUMASSUR, `POUR_LOGE`=:POUR_LOGE, `LOGEMENT`=:LOGEMENT
        where `id`=:id");
		try{
		$q->execute(array(
            ':id' => $id,
            ":MATRICULEV"=>$MATRICULEV, 
            ":NOM"=>$NOM,
            ":PRENOMS"=>$PRENOMS,
            ":NOMJFILLE"=>$NOMJFILLE,
            ":DATENAIS"=>$DATENAIS,
            ":LIEUNAIS"=>$LIEUNAIS,
            ":NATIONAL"=>$NATIONAL,
            ":SITFAMIL"=>$SITFAMIL,
            ":NBFEMME"=>$NBFEMME,
            ":NBFEMSAL"=>$NBFEMSAL,
            ":NBENFAN"=>$NBENFAN,
            ":NBENFCNSS"=>$NBENFCNSS,
            ":DATEMBAUC"=>$DATEMBAUC,
            ":NUMDECIS"=>$NUMDECIS,
            ":CODEMPLOI"=>$CODEMPLOI,
            ":CORPSBRANC"=>$CORPSBRANC,
            ":DIVISION"=>$DIVISION,
            ":SOUSDIVIS"=>$SOUSDIVIS,
            ":LIEUAFFEC"=>$LIEUAFFEC,
            ":POSITION"=>$CADRE,
            ":CATEGORIE"=>$CATEGORIE,
            ":NUMSECUR"=>$NUMSECUR,
            ":DATEAFSEC"=>$DATEAFSEC,
            ":DATERETRAI"=>$DATERETRAI,
            ":NUDECESSA"=>$NUDECESSA,
            ":DATEDECESA"=>$DATEDECESA,
            ":DATEPEFFE"=>$DATEPEFFE,
            ":CUMULJPE"=>$CUMULJPE,
            ":NIVETUDE1"=>$NIVETUDE1,
            ":NIVETUDE2"=>$NIVETUDE2,
            ":DIPLOME1"=>$DIPLOME1,
            ":DIPLOME2"=>$DIPLOME2,
            ":STAGEPRO1"=>$STAGEPRO1,
            ":STAGEPRO2"=>$STAGEPRO2,
            ":DIVERS1"=>$DIVERS1,
            ":DIVERS2"=>$DIVERS2,
            ":SEXE"=>$SEXE,
            ":SAL_BASE"=>$SAL_BASE,
            ":COMPTE"=>$COMPTE,
            ":T4"=>$T4,
            ":STATUT"=>$STATUT,
            ":REL_BANQUE"=>$REL_BANQUE,
            ":NR_COMPTE"=>$NR_COMPTE, 
            ":DATE_S"=>$DATE_S,
            ":NUMASSUR"=>$NUMASSUR,
            ":POUR_LOGE"=>$POUR_LOGE,
            ":LOGEMENT"=>$LOGEMENT));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();    
        $saved=$q->rowCount();
        if($saved){    
        redirect('personnels.php?page='.$page);
        }else{
            //die();
            redirect('personnels.php?page='.$page);
        }
	}else if($sauve_personnel=='Supprimer'){
        $q=$db->prepare("delete from `personnelles`  where `id` =:id");
		try{
		$q->execute(array(
			':id'=>$id
        ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		clear_data_post();        
        redirect('personnels.php?page='.$page);

    }
}else if(isset($_POST['Request'])){
    extract($_POST);
    if($Request=='loadData'){
          echo GetHtmlPersonnels($page);
        exit;
    }

}else{ 

 $page=isset($_GET['page'])?$_GET['page']:1;
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
		        include("views/personnels.view.php");
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




  
    