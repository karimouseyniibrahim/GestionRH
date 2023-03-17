<?php
session_start();

require('../config/db.php');
require('../includes/functions.php');
require('fpdf-table-manoeuvres-cnss.php');

//normal row height=5.
$mois=getMonthActif();



$col=array('MAT.','N. CNSS','NOM ET PRENOM','MONTANT BRUT','EMPLOYE','CNSS+ANPE');
$options = array(
	'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
	'destinationfile' => '', //I=inline browser (default), F=local file, D=download
	'paper_size'=>'A4',	//paper size: F4, A3, A4, A5, Letter, Legal
	'orientation'=>'P' //orientation: P=portrait, L=landscape
);

 $ColWidths=array(50,70,180,100,70,70);
 $ColTotal=array(300,100,70,70);
 $data=getCNSSHebdo();


//$data=array("data"=>$data,"total"=>array('TOTAL GENERAL',$totalG[0],$totalG[1],$totalG[2],

$tabel = new FPDF_AutoWrapTable($data,$col,$ColWidths,$ColTotal,ETAT_HEBDOMADAIRES_CNSS. date("d/m/Y",strtotime($data[0]->FINSEM)),"Date d'édition : ".date("d/m/Y"), $options);
$tabel->printPDF();