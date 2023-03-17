<?php
require('functions.php');
include ('chiffreEnLettre.php');

// Instanciation of inherited class
$pdf = new PDF();
$nw = new chiffreEnLettre;
$pdf->AliasNbPages();
$pdf->AddPage();
$total=0;
//normal row height=5.
$manoeuvres=ListeBulletinPaieManoeuvre();
$i=1;
foreach($manoeuvres as $m){
$pdf->Cell(185,5,ICRISAT,'',1,'C');
$pdf->Cell(185,5,ICRISAT_BP,'TB',1,'C');
$pdf->Cell(95,5,utf8_decode("Localité : SADORE"),'',0,'L');
$pdf->Cell(90,5,'Date : '.date("d/m/Y"),'',1,'R');

$pdf->Cell(185,15,"",'',1,'C');
$pdf->Cell(185,5,BULLETIN_PAIE_MANOEUVRES,'',1,'C');
$pdf->Cell(185,5,"SEMAINE DU ".date("d/m/Y",strtotime($m->DEBUTSEM))." AU ".date("d/m/Y",strtotime($m->FINSEM)),'',1,'C');

$pdf->Cell(35,7,utf8_decode('Matricule : '.$m->MATRICULEV),0,0);         
$pdf->Cell(100,7,utf8_decode('Nom & Prénom : '.$m->NOM),0,0); 
$pdf->Cell(60,7,utf8_decode('Numéro CNSS : '.$m->NR_CNSS),0,1); 

$pdf->Cell(185,30,"",'',1,'C');


$pdf->Cell(80,7,utf8_decode('COMPISTION DU SALAIRE'),"TBLR",0,"L");         
$pdf->Cell(30,7,utf8_decode('N.B HEURES'),"TBLR",0,"C"); 
$pdf->Cell(45,7,utf8_decode('COUT HORAIRE'),"TBLR",0,"C"); 
$pdf->Cell(30,7,utf8_decode('MONTANT'),"TBLR",1,"C"); 

$pdf->Cell(80,7,utf8_decode('Nombre heures Normales'),"TBLR",0,"L");         
$pdf->Cell(30,7,utf8_decode(number_format($m->NORM, 0, ',', ' ')),"TBLR",0,"R"); 
$pdf->Cell(45,7,utf8_decode(number_format(($m->CFA_TOTAL/$m->HRS_TOTAL), 0, ',', ' ')),"TBLR",0,"R"); 
$pdf->Cell(30,7,utf8_decode(number_format(($m->CFA_TOTAL/$m->HRS_TOTAL)*$m->NORM, 0, ',', ' ')),"TBLR",1,"R"); 

$pdf->Cell(80,7,utf8_decode('Nombre heures Supplémentaires'),"TBLR",0,"L");         
$pdf->Cell(30,7,utf8_decode(number_format($m->SUPP, 0, ',', ' ')),"TBLR",0,"R"); 
$pdf->Cell(45,7,utf8_decode(number_format(($m->CFA_TOTAL/$m->HRS_TOTAL), 0, ',', ' ')),"TBLR",0,"R"); 
$pdf->Cell(30,7,utf8_decode(number_format(($m->CFA_TOTAL/$m->HRS_TOTAL)*$m->SUPP, 0, ',', ' ')),"TBLR",1,"R"); 

$pdf->Cell(80,7,utf8_decode('Nombre heures Jours Fériés'),"TBLR",0,"L");         
$pdf->Cell(30,7,utf8_decode(number_format($m->FERI, 0, ',', ' ')),"TBLR",0,"R"); 
$pdf->Cell(45,7,utf8_decode(number_format(($m->CFA_TOTAL/$m->HRS_TOTAL), 0, ',', ' ')),"TBLR",0,"R"); 
$pdf->Cell(30,7,utf8_decode(number_format(($m->CFA_TOTAL/$m->HRS_TOTAL)*$m->FERI, 0, ',', ' ')),"TBLR",1,"R"); 

$pdf->Cell(80,7,utf8_decode('Indeminité de Congé'),"TBLR",0,"L");         
$pdf->Cell(30,7,utf8_decode(number_format($m->HRS_TOTAL, 0, ',', ' ')),"TBLR",0,"R"); 
$pdf->Cell(45,7,utf8_decode('27,08'),"TBLR",0,"R"); 
$pdf->Cell(30,7,utf8_decode(number_format($m->GAINCONG, 0, ',', ' ')),"TBLR",1,"R"); 

$pdf->Cell(155,7,utf8_decode('SALAIRE BRUT'),"TBLR",0,"L");          
$pdf->Cell(30,7,utf8_decode(number_format($m->SALABRUT, 0, ',', ' ')),"TBLR",1,"R");

$pdf->Cell(185,20,"",'',1,'C');

$pdf->Cell(155,7,utf8_decode('RETENUES'),"TBLR",0,"L");          
$pdf->Cell(30,7,utf8_decode('MONTANT'),"TBLR",1,"R");

$pdf->Cell(155,7,utf8_decode('Caisse Nationale de Sécurité Sociale'),"TBLR",0,"L");          
$pdf->Cell(30,7,utf8_decode(number_format($m->CNSS_RET, 0, ',', ' ')),"TBLR",1,"R");

$pdf->Cell(155,7,utf8_decode('Autres Retenues sur salaire'),"TBLR",0,"L");          
$pdf->Cell(30,7,utf8_decode(number_format($m->retenue, 0, ',', ' ')),"TBLR",1,"R");

$pdf->Cell(155,7,utf8_decode('TOTAL DES RETENUES'),"TBLR",0,"L");          
$pdf->Cell(30,7,utf8_decode(number_format(($m->CNSS_RET+$m->retenue), 0, ',', ' ')),"TBLR",1,"R");

$pdf->Cell(185,10,"",'',1,'C');

$pdf->Cell(155,7,utf8_decode('NET A PERCEVOIR'),"TBLR",0,"L");          
$pdf->Cell(30,7,utf8_decode(number_format($m->NETPAYER, 0, ',', ' ')),"TBLR",1,"R");

$pdf->Cell(185,20,"",'',1,'C');

$pdf->Cell(95,7,utf8_decode('Chef du Personnel'),"",0,"C");          
$pdf->Cell(90,7,utf8_decode('Chef Comptable'),"",1,"C");
$pdf->Cell(185,30,"Pour acquit le :",'',1,'C');
if($i++<count($manoeuvres)){
$pdf->AddPage();
}

}

//$pdf->Cell(160,5,'','T',1);
//$pdf->Cell(290,20,utf8_decode('Arrêté la présente facture à la somme de: ').$nw->ConvNumberLetter($total,0,0).' Francs CFA.',0,1); 

 
$pdf->SetFont('Times','',12);
$pdf->Output();

?>