<?php

session_start();

require('../config/db.php');
require('../includes/functions.php');
require('fpdf-table-manoeuvres.php');


$col=array('MATRI','NOM - PRENOM','S.H','H.NORM','H.SUPP','H.FERI','H.TOTALES','CONGE','SAL.BRUT',
'CNSS+ANPE','COUT TOTAL','CNSS(5.25)','R.DIVRS','T.RETENUE','NET A PAYER');
$options = array(
	'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
	'destinationfile' => '', //I=inline browser (default), F=local file, D=download
	'paper_size'=>'A4',	//paper size: F4, A3, A4, A5, Letter, Legal
	'orientation'=>'L' //orientation: P=portrait, L=landscape
);

 $ColWidths=array(40,120,40,40,40,40,40,40,60,40,60,40,40,40,120);
 $ColTotal=array(200,40,40,40,40,40,60,40,60,40,40,40,120);
 $listeP=getListeProgramByHebdomadaire();
 $Matri=array();
 $data=array();
 $DEBUTSEM="";
 $FINSEM="";
 $totalG=array(0,0,0,0,0,0,0,0,0,0,0,0);
 foreach( $listeP as $program){
    $payrProg=array();
    $prog=array(
        'PROGRAM : '.$program->codeanal.' ('.$program->PROGRAM.')  - COMPTE : '.$program->COMPTE,
        'CHERCHEUR : '.$program->codact.' ('.$program->CHERCHEUR.')'
    );
    $DEBUTSEM=$program->DEBUTSEM;
    $FINSEM=$program->FINSEM;
    $SUPP=0;
    $NORM=0;$FERI=0;$HRS_TOTAL=0;$GAINCONG=0;$SALABRUT=0;$COUT_TOT=0;$CNSS_ANPE=0;
    $CNSS_RET=0;$RET_DIVERS=0;$RET_TOTAL=0;$SAL_NET=0;
    foreach (ListeJounalPaieHebdo($program->codeanal,$program->codact) as $dat){
    //  print_r($t);
        $Matri[$dat->MATRICULEV]=1;
        array_push($payrProg,array($dat->MATRICULEV,
        $dat->nom,
        number_format(($dat->CFA_TOTAL/$dat->HRS_TOTAL), 0, ',', ' '),
        number_format($dat->NORM, 0, ',', ' '),
        number_format($dat->SUPP, 0, ',', ' '),
        number_format($dat->FERI, 0, ',', ' '),
        number_format($dat->HRS_TOTAL, 0, ',', ' '),
        number_format($dat->GAINCONG, 0, ',', ' '),
        number_format($dat->SALABRUT, 0, ',', ' '),
        number_format(($dat->CNSS_EMP+$dat->ANPE), 0, ',', ' '),
        number_format(($dat->SALABRUT+$dat->CNSS_EMP+$dat->ANPE), 0, ',', ' '),
        number_format($dat->CNSS_RET, 0, ',', ' '),
        number_format( $dat->retenue, 0, ',', ' '),
        number_format(($dat->retenue+$dat->CNSS_RET), 0, ',', ' '),
        number_format($dat->NETPAYER, 0, ',', ' ')));
        $i++;
        $SUPP+= $dat->SUPP;
        $NORM+= $dat->NORM;
        $FERI+= $dat->FERI;
        $HRS_TOTAL+= $dat->HRS_TOTAL;
        $GAINCONG+= $dat->GAINCONG;
        $SALABRUT+= $dat->SALABRUT;
        $COUT_TOT+= $dat->SALABRUT+$dat->CNSS_EMP+$dat->ANPE;
        $CNSS_ANPE+= $dat->CNSS_EMP+$dat->ANPE;
        $CNSS_RET+= $dat->CNSS_RET;
        $RET_DIVERS+= $dat->retenue;
        $RET_TOTAL+= $dat->retenue+$dat->CNSS_RET;
        $SAL_NET+= $dat->NETPAYER;
         
    }
    $total=array('TOTAL PROGRAMMME-'.$program->codeanal,number_format($NORM, 0, ',', ' '),number_format($SUPP, 0, ',', ' '),number_format($FERI, 0, ',', ' '),number_format($HRS_TOTAL, 0, ',', ' '),
    number_format($GAINCONG, 0, ',', ' '),number_format($SALABRUT, 0, ',', ' '),number_format($CNSS_ANPE, 0, ',', ' '),number_format($COUT_TOT, 0, ',', ' '),number_format($CNSS_RET, 0, ',', ' '),
    number_format($RET_DIVERS, 0, ',', ' '),number_format($RET_TOTAL, 0, ',', ' '),number_format($SAL_NET, 0, ',', ' '));
    $totalG=(array($NORM+$totalG[0],$SUPP+$totalG[1],$FERI+$totalG[2],
    $HRS_TOTAL+$totalG[3],$GAINCONG+$totalG[4],$SALABRUT+$totalG[5],$CNSS_ANPE+$totalG[6],
    $COUT_TOT+$totalG[7],$CNSS_RET+$totalG[8],$RET_DIVERS+$totalG[9],$RET_TOTAL+$totalG[10],$SAL_NET+$totalG[11]));
    array_push($data,array("program"=>$prog,"payr"=>$payrProg,"total"=>$total));

 }


$data=array("data"=>$data,"debut"=>$DEBUTSEM,"fin"=>$FINSEM,
"total"=>array('TOTAL GENERAL',number_format($totalG[0], 0, ',', ' '),number_format($totalG[1], 0, ',', ' '),
number_format($totalG[2], 0, ',', ' '),number_format($totalG[3], 0, ',', ' '),number_format($totalG[4], 0, ',', ' '),
number_format($totalG[5], 0, ',', ' '),number_format($totalG[6], 0, ',', ' '),number_format($totalG[7], 0, ',', ' '),
number_format($totalG[8], 0, ',', ' '),number_format($totalG[9], 0, ',', ' '),number_format($totalG[10], 0, ',', ' '),
$totalG[11]),"infos"=>"NOMBRE D'AGENTS TRAITES : ".array_sum($Matri));

$tabel = new FPDF_AutoWrapTable($data,$col,$ColWidths,$ColTotal,JOURNAL_MANOEUVRES.date("m/Y"), $options);
$tabel->printPDF();
//print_r($tab);
    


 ?>