<?php

session_start();

require('../config/db.php');
require('../includes/functions.php');
require('fpdf-table-auto-wrapping.php');

/*
$col=array('MATRI','NOM ET PRENOM','COMPTE','SALAIRE DE BASE','INDEMN LOGEMT',
'INDEMN HRSUPL','INDEMN DIVERS','CNSS + FNR EMPLOYEUR','CNSS + FNR EMPLOYE',
'COUT TOTAL','RETENUE ABSENCE','RETENUE CONGE','RETENUE DIVERSE',
'TOTAL RETENUE','SALAIRE NET');
$options = array(
	'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
	'destinationfile' => '', //I=inline browser (default), F=local file, D=download
	'paper_size'=>'A4',	//paper size: F4, A3, A4, A5, Letter, Legal
	'orientation'=>'L' //orientation: P=portrait, L=landscape
);

 $ColWidths=array(40,90,50,50,50,50,50,60,60,50,50,50,50,50,50);
 $ColTotal=array(180,50,50,50,50,60,60,50,50,50,50,50,50);
 $listeP=getListeProgramByMonth(2,2023);
 $Matri=array();
 $data=array();
 $totalG=array(0,0,0,0,0,0,0,0,0,0,0,0);
 foreach( $listeP as $program){
    $payrProg=array();
    $prog=array(
        'PROGRAM : '.$program->codlib.' - '.$program->LIBLONG,
        'SECTION : '.$program->LIBCOURT
    );
    $BASE_SAL=0;
    $LOGEMENT=0;$HEURE_SUP=0;$IND_DIVERS=0;$CNSS_ISC=0;$CNSS_EMP=0;$COUT_TOT=0;$RET_ABS=0;
    $RET_CONGE=0;$RET_DIVERS=0;$RET_TOTAL=0;$SAL_NET=0;
    foreach (ListeJounalPaie(2,2023,$program->PROGRAM) as $dat){
    //  print_r($t);
        $Matri[$dat->MATRICULEV]=1;
        array_push($payrProg,array($dat->MATRICULEV,
        $dat->NOM_PRE,
        $dat->ACCOUNT,
        $dat->BASE_SAL,
        $dat->LOGEMENT,
        $dat->HEURE_SUP,
        $dat->IND_DIVERS,
        $dat->CNSS_ISC,
        $dat->CNSS_EMP,
        $dat->COUT_TOT,
        $dat->RET_ABS,
        $dat->RET_CONGE,
        $dat->RET_DIVERS,
        $dat->RET_TOTAL,
        $dat->SAL_NET));
        $i++;
        $BASE_SAL+= $dat->BASE_SAL;
        $LOGEMENT+= $dat->LOGEMENT;
        $HEURE_SUP+= $dat->HEURE_SUP;
        $IND_DIVERS+= $dat->IND_DIVERS;
        $CNSS_ISC+= $dat->CNSS_ISC;
        $CNSS_EMP+= $dat->CNSS_EMP;
        $COUT_TOT+= $dat->COUT_TOT;
        $RET_ABS+= $dat->RET_ABS;
        $RET_CONGE+= $dat->RET_CONGE;
        $RET_DIVERS+= $dat->RET_DIVERS;
        $RET_TOTAL+= $dat->RET_TOTAL;
        $SAL_NET+= $dat->SAL_NET;
         
    }
    $total=array('TOTAL PROGRAMMME-'.$program->codlib,$BASE_SAL,$LOGEMENT,$HEURE_SUP,$IND_DIVERS,$CNSS_ISC,$CNSS_EMP,$COUT_TOT,$RET_ABS,
    $RET_CONGE,$RET_DIVERS,$RET_TOTAL,$SAL_NET);
    $totalG=(array($BASE_SAL+$totalG[0],$LOGEMENT+$totalG[1],$HEURE_SUP+$totalG[2],
    $IND_DIVERS+$totalG[3],$CNSS_ISC+$totalG[4],$CNSS_EMP+$totalG[5],$COUT_TOT+$totalG[6],
    $RET_ABS+$totalG[7],$RET_CONGE+$totalG[8],$RET_DIVERS+$totalG[9],$RET_TOTAL+$totalG[10],$SAL_NET+$totalG[11]));
    array_push($data,array("program"=>$prog,"payr"=>$payrProg,"total"=>$total));

 }


$data=array("data"=>$data,"total"=>array('TOTAL GENERAL',$totalG[0],$totalG[1],$totalG[2],
$totalG[3],$totalG[4],$totalG[5],$totalG[6],$totalG[7],$totalG[8],$totalG[9],$totalG[10],
$totalG[11]),"infos"=>"NOMBRE D'AGENTS TRAITES : ".array_sum($Matri));
$mois=getMonthActif();
$tabel = new FPDF_AutoWrapTable($data,$col,$ColWidths,$ColTotal,JOURNAL_PAIE.$mois->mois." ".$mois->annee." - DATE D'EDITION : ".date("d/m/Y"), $options);
$tabel->printPDF();


*/

$previe=date('Y-m-d', strtotime(date('m')."/".date('d')."/".date('Y')." -1 month" ));

$montant=461447;

$m=round( $montant*0.164,2);
$m1=floor($montant*0.164);
$m2=round($m-$m1,2);
 


echo $m2;
    


 ?>