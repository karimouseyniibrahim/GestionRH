<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title="Bulletin Paie";


if(isset($_GET['calcule'])){
    extract($_GET);
	
	$data=array();

	$personnelles=GetPersonnelleActif();
	foreach($personnelles as $personnel){
		$datap= array();
		$datap[":NOM_PRE"]=$personnel->NOM.' '.$personnel->PRENOMS;
		$datap[":actif"]=1;
		$datap[":Jour_effect"]=GetNbrDayWork();
		$datap[":MATRICULEV"]=$personnel->MATRICULEV;
		$datap[":CODEMPLOI"]=$personnel->CODEMPLOI;
		$datap[":DATEMBAUC"]=$personnel->DATEMBAUC;
		$datap[":FONCTION"]=$personnel->FONCTION;
		$datap[":POSITION"]=$personnel->POSITION;
		$datap[":DATE_SORT"]=$personnel->DATE_SORT;
		$datap[":PTM"]=$personnel->DIVISION;
		$datap[":PROGRAM"]=$personnel->SOUSDIVIS;
		$datap[":CATEGORIE"]=$personnel->CATEGORIE;
		$datap[":NUMSECUR"]=$personnel->NUMSECUR;
		$datap[":ACCOUNT"]=$personnel->COMPTE;
		$datap[":T4"]=$personnel->T2;
		$dataR=array();

		$cnss=array();
		$cnss[":NOM"]=$personnel->NOM;
		$cnss[":PRENOMS"]=$personnel->PRENOMS;
		$cnss[":MATRICULEV"]=$personnel->MATRICULEV;

		$datap[":LOGEMENT"]=0;
		$datap[":IND_DIVERS"]=0;
		$datap[":HEURE_SUP"]=0;

		$datap[":RET_ABS"]=0;
		$datap[":RET_CONGE"]=0;
		$datap[":RET_DIVERS"]=0;

		$datap[":mois"]=date("m");
		$datap[":annee"]=date("Y");

		$cnss[":MOIS"]=date("m");
		$cnss[":ANNEE"]=date("Y");
		$cnss[":NBRE_JOURS"]=GetNbrDayWork();
		
		DeleteDataThisMonth(date("m"),date("Y"));
		$elements=GetElmentByPersonnelle($personnel->MATRICULEV);
		$payrrubrique=array();

		$i=0;
		foreach($elements as $element){
			if($element->code==100){
				$datap[":BASE_SAL"]=$element->valeur;
			}elseif($element->code==106){
				$datap[":LOGEMENT"]=$element->valeur;
			}
			elseif($element->code==107){
				$datap[":IND_DIVERS"]=$element->valeur;
			}
			elseif($element->code==103){
				$datap[":HEURE_SUP"]=$element->valeur;
			}
			elseif($element->code==4100){
				$datap[":RET_CONGE"]=$element->valeur;
			}
			elseif($element->code==3900){
				$datap[":RET_ABS"]=$element->valeur;
			}else{
				$datap[":RET_DIVERS"]=$datap[":RET_DIVERS"]+$element->valeur;
			}

			$payrrubrique[$i]=(array(
				":code"=>$element->code, 
				":montant"=>$element->valeur, 
				":mois"=> date("m"),
				":annee"=> date("Y"), 
				":matriculev"=>$element->matriculev, 
				":compte"=>$element->compte
			));
			$i++;
		}
		//$datap[":BASE_SAL"]=$datap[":BASE_SAL"]-$datap[":RET_ABS"];

		$prets=GetPretsByPersonnelle($personnel->MATRICULEV);
		foreach($prets as $pret){
			$datap[":RET_DIVERS"]=$datap[":RET_DIVERS"]+$pret->MONTANT_EC;
			$payrrubrique[$i]=(array(
				":code"=>$pret->CODE, 
				":montant"=>$pret->MONTANT_EC, 
				":mois"=> date("m"),
				":annee"=> date("Y"), 
				":matriculev"=>$pret->MATRICULEV, 
				":compte"=>$pret->CREDIT
			));
			$i++;
		}

		$datap[":SAL_BRUT"]=$datap[":LOGEMENT"]+$datap[":IND_DIVERS"]+$datap[":BASE_SAL"]+$datap[":HEURE_SUP"]-$datap[":RET_ABS"];

		
		$datap[":CNSS_EMP"]=$datap[":SAL_BRUT"]>=500000?26250:round ($datap[":SAL_BRUT"]*0.0525);
		$datap[":COUT_TOT"]=$datap[":SAL_BRUT"]+$datap[":CNSS_ISC"];

		$payrrubrique[$i]=(array(
			":code"=>3700, 
			":montant"=>$datap[":CNSS_EMP"], 
			":mois"=> date("m"),
			":annee"=> date("Y"), 
			":matriculev"=>$personnel->MATRICULEV, 
			":compte"=>"3442"
		));

			//  `RETSAL`, 
		$cnss[":MONT_BRUT"]=$datap[":SAL_BRUT"];
		$cnss[":MONTANT"]=$datap[":CNSS_EMP"];
		$cnss[":POSITION"]=$personnel->POSITION;

		$m=round( $datap[":SAL_BRUT"]*0.164,2);
		$m1=floor($datap[":SAL_BRUT"]*0.164);
		$m2=round($m-$m1,2);

		$a=round( $datap[":SAL_BRUT"]*0.005,2);
		$a1=floor($datap[":SAL_BRUT"]*0.005);
		$a2=round($a-$a1,2);
		
		$cnss[":MONTANT2"]=$datap[":SAL_BRUT"]>=500000?82000:($m2>=0.5?round($datap[":SAL_BRUT"]*0.164):floor($datap[":SAL_BRUT"]*0.164));
		$cnss[":ANPE"]=$datap[":SAL_BRUT"]>=500000?2500:($a2>=0.5?round($datap[":SAL_BRUT"]*0.005):floor($datap[":SAL_BRUT"]*0.005));
		$val=floor($datap[":SAL_BRUT"]*0.169);
		$tca=$cnss[":ANPE"]+$cnss[":MONTANT2"];
		$datap[":CNSS_ISC"]=$datap[":SAL_BRUT"]>=500000?84500:($val==$tca?floor($datap[":SAL_BRUT"]*0.169):round($datap[":SAL_BRUT"]*0.169));

		/*$cnss[":T1"]=$cnss[":ANPE"]+$cnss[":MONTANT2"];
		$cnss[":T2"]=$datap[":CNSS_ISC"];
		$cnss[":a2"]=$a2;
		$cnss[":m2"]=$m2;
		*/

		$datap[":RET_TOTAL"]=$datap[":CNSS_EMP"]+$datap[":RET_DIVERS"];
		$datap[":SAL_NET"]=$datap[":SAL_BRUT"]-$datap[":RET_TOTAL"];

		//$datap["payrrubrique"]=$payrrubrique;
		//$datap["cnss"]=$cnss;
		/*
		"personnel"=>$datap,
			"payrrubrique"=>$payrrubrique,
		*/
		$data[$personnel->MATRICULEV]=array(
			"personnel"=>$datap,
			"payrrubrique"=>$payrrubrique,
			"cnss"=>$cnss	
		);

	}

	//print_r($data);
	$countP=0;
	$countCnss=0;
	$countR=0;
	foreach($data as $d){
		
		//print_r($d["personnel"][":MATRICULEV"]);
		foreach(getProgramPByMatricule($d["personnel"][":MATRICULEV"]) as $program){
			$countP=$countP+InsertPayrByProgram($d["personnel"],$program);
			//print_r($program);
		}	

		$c=$db->prepare("INSERT INTO `cnss`(`MATRICULEV`, `NOM`, `PRENOMS`, `ANNEE`, `MOIS`, `NBRE_JOURS`, 
		`MONT_BRUT`, `MONTANT`, `POSITION`, `MONTANT2`, `ANPE`) 
		VALUES (:MATRICULEV,:NOM,:PRENOMS,:ANNEE,:MOIS,:NBRE_JOURS,:MONT_BRUT,:MONTANT,:POSITION,:MONTANT2,:ANPE)");
		$c->execute($d['cnss']);

		$savedC=$c->rowCount();
        if($savedC){
			$countCnss++;
		}else{
			print_r($d['cnss']);
		}

		foreach($d['payrrubrique'] as $rubrique){
			$r=$db->prepare("INSERT INTO `payrrubrique`( `code`, `montant`, `mois`, `annee`, `matriculev`, `compte`) 
			VALUES (:code,:montant,:mois,:annee,:matriculev,:compte)");
			$r->execute($rubrique);
			$savedR=$r->rowCount();
			if($savedR){
				$countR++;
			}else{
				print_r($rubrique);
			}
		}
 
		
	}

	print_r(array("Payr"=>$countP,"CNSS"=>$countCnss,"payrrubrique"=>$countR));
	exit();

}

if(isset($_POST['sauve_Prets'])){
    extract($_POST);
 
	$d1=explode("-",$DATE_AC);
	$d2=explode("-",$DATEFIN);
	$d3=explode("-",$DATE_APPEL);
	if($sauve_Prets=='Enregistrer'){
		$q=$db->prepare("INSERT INTO `payr`(`MATRICULEV`, `B`, `NOM_PRE`, `CODEMPLOI`, `DATEMBAUC`, 
		`FONCTION`, `POSITION`, `DATE_SORT`, `BASE_SAL`, `LOGEMENT`, `HEURE_SUP`, `IND_DIVERS`, `RET_ABS`, 
		`SAL_BRUT`, `CNSS_ISC`, `COUT_TOT`, `CNSS_EMP`, `RET_CONGE`, `RET_DIVERS`, `RET_TOTAL`, `SAL_NET`, 
		`RETSAL`, `PTM`, `PROGRAM`, `PERCENT`, `ACCOUNT`, `T4`, `mois`, `annee`, `actif`, `CATEGORIE`, 
		`NUMSECUR`, `Jour_effect`) 
		VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19],[value-20],[value-21],[value-22],[value-23],[value-24],[value-25],[value-26],[value-27],[value-28],[value-29],[value-30],[value-31],[value-32],[value-33],[value-34])");
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
		  include("views/bulletin-paie.view.php");
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


  
    