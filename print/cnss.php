<?php
session_start();

require('../config/db.php');
require('../includes/functions.php');
require('fpdf-table-auto-wrapping-cnss.php');

//normal row height=5.
$mois=getMonthActif();



$col=array('NUM MAT','NUM CNSS','NOM ET PRENOM','MONTANT BRUT','RETENUE 5.25%','RET.16.4-0.5-10.15%',
'TOTAL RETENUES');
$options = array(
	'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
	'destinationfile' => '', //I=inline browser (default), F=local file, D=download
	'paper_size'=>'A4',	//paper size: F4, A3, A4, A5, Letter, Legal
	'orientation'=>'P' //orientation: P=portrait, L=landscape
);

 $ColWidths=array(50,50,150,70,70,70,70);
 $ColTotal=array(250,70,70,70,70);
 $data=getCNSSMENSUEL($mois->id,$mois->annee);


//$data=array("data"=>$data,"total"=>array('TOTAL GENERAL',$totalG[0],$totalG[1],$totalG[2],

$tabel = new FPDF_AutoWrapTable($data,$col,$ColWidths,$ColTotal,ETAT_MENSUELE_CNSS.$mois->mois." ".$mois->annee," - DATE D'EDITION : ".date("d/m/Y"), $options);
$tabel->printPDF();