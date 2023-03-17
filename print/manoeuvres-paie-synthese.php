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
$manoeuvres=ListePaieManoeuvreByHebdo($_GET['SEM1'],$_GET['SEM2']);
$i=1;

$pdf->Cell(185,5,ICRISAT,'',1,'C');
$pdf->Cell(185,5,ICRISAT_BP,'TB',1,'C');
$pdf->Cell(95,5,utf8_decode("Localité : SADORE"),'',0,'L');
$pdf->Cell(90,5,'Date : '.date("d/m/Y"),'',1,'R');

$pdf->Cell(185,15,"",'',1,'C');
$pdf->Cell(185,5,BULLETIN_PAIE_MANOEUVRES,'',1,'C');
$pdf->Cell(185,5,"SEMAINE 1: ".date("d/m/Y",strtotime($_GET['SEM1']))." AU  SEMAINE 2: ".date("d/m/Y",strtotime($_GET['SEM2'])),'',1,'C');


$pdf->Cell(15,10,utf8_decode('Mat.'),1,0);         
$pdf->Cell(65,10,utf8_decode('Nom & Prénom'),1,0); 
$pdf->Cell(25,10,utf8_decode('Montant S1'),1,0,"C"); 
$pdf->Cell(25,10,utf8_decode('Montant S2'),1,0,"C");
$pdf->Cell(25,10,utf8_decode('M. Total'),1,0,'C'); 
$pdf->Cell(40,10,utf8_decode('Signature'),1,1,'C'); 
$i=1;
$total1=0;
$total2=0;
foreach($manoeuvres as $m){
    $pdf->Cell(15,15,utf8_decode($m->matriculev),1,0,"C");         
    $pdf->Cell(65,15,utf8_decode($m->nom),1,0); 
    $pdf->Cell(25,15,number_format($m->sem1, 0, ',', ' '),1,0,"R"); 
    $pdf->Cell(25,15,number_format($m->sem2, 0, ',', ' '),1,0,"R");
    $pdf->Cell(25,15,number_format($m->sem1+$m->sem2, 0, ',', ' '),1,0,'R'); 
    $total1+=$m->sem1;
    $total2+=$m->sem2;
    $pdf->Cell(40,15,utf8_decode(""),1,1);
}
$pdf->Cell(80,15,utf8_decode("TOTAL"),1,0); 
$pdf->Cell(25,15,number_format($total1, 0, ',', ' '),1,0,"R"); 
$pdf->Cell(25,15,number_format($total2, 0, ',', ' '),1,0,"R");
$pdf->Cell(25,15,number_format($total1+$total2, 0, ',', ' '),1,0,'R'); 
$pdf->Cell(185,20,"",'',1,'C');

$pdf->Cell(185,20,"",'',1,'C');
$pdf->Cell(95,7,utf8_decode('Chef du Personnel'),"",0,"C");          
$pdf->Cell(90,7,utf8_decode('Chef Comptable'),"",1,"C");
$pdf->Cell(185,15,"Pour acquit le :",'',1,'C');

//$pdf->Cell(160,5,'','T',1);
//$pdf->Cell(290,20,utf8_decode('Arrêté la présente facture à la somme de: ').$nw->ConvNumberLetter($total,0,0).' Francs CFA.',0,1); 

 
$pdf->SetFont('Times','',12);
$pdf->Output();

?>