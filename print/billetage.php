<?php
require('functions.php');
include ('chiffreEnLettre.php');

// Instanciation of inherited class
$pdf = new PDF();
$nw = new chiffreEnLettre;
$pdf->AliasNbPages();
$pdf->AddPage();
$total=0;
$mois=getMonthActif();
$i=1;
$reference=isset($_GET['reference'])?$_GET['reference']:1;
$listesB=ListesBilletage($mois->id,$mois->annee);

$pdf->Cell(120,10,'','',1,'L');
$pdf->Cell(0, 5, ICRISAT_CENTRE,'B',1,'C');
$pdf->Cell(0, 5, ICRISAT_BP, 'T', 1,'C');
$pdf->Cell(15,7,utf8_decode(''),'',1,'L');

$pdf->Cell(0, 5, "LISTE NOMINATIVE DU PERSONNEL PAYE AU BILLETAGE", '', 1,'C');
$pdf->Cell(0, 5, "MOIS DE ".$mois->mois.' '.$mois->annee, '', 1,'C');
$pdf->Cell(15,10,utf8_decode(''),'',1,'L');
$pdf->Cell(15,5,utf8_decode('N°'),'LTBR',0,'L');
$pdf->Cell(20,5,utf8_decode('Matric'),'LTBR',0,'L');
$pdf->Cell(95,5,utf8_decode('Nom & Prénom'),'LTBR',0,'L');
$pdf->Cell(30,5,utf8_decode('Salaire Net'),'LTBR',0,'C');
$pdf->Cell(30,5,utf8_decode('Signature'),'LTBR',1,'C');
$pdf->SetFont('Times','',12);
foreach($listesB as $ref){

		$pdf->Cell(15,10,utf8_decode($i++),'LRB',0,'C');
		$pdf->Cell(20,10,utf8_decode($ref->matriculev),'LRB',0,'L');
		$pdf->Cell(95,10,utf8_decode($ref->nom_pre),'LRB',0,'L');
		$pdf->Cell(30,10,utf8_decode($ref->montant),'LRB',0,'R');
		$pdf->Cell(30,10,utf8_decode(''),'LRB',1,'L');
		$total+=$ref->montant;

}
$pdf->SetFont('Times','B',12);
$pdf->Cell(130,10,utf8_decode('TOTAL GENERAL'),'LTBR',0,'C');
$pdf->Cell(30,10,utf8_decode($total),'LTBR',0,'R');
$pdf->Cell(30,10,utf8_decode(''),'LTBR',1,'C');


$pdf->SetFont('Times','',12);
$pdf->Output();
