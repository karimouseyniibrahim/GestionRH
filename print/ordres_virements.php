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
$i=0;
$reference=isset($_GET['reference'])?$_GET['reference']:1;
$listesR=ListesREFBANQ($mois->id,$mois->annee);
foreach($listesR as $ref){

		$pdf->Cell(90,7,utf8_decode('Référence : LET/RHI/'.$reference.'/'.$mois->annee),'',0,'L');
		$pdf->Cell(90,7,utf8_decode('Nimaey, le '.date('d/m/Y')),'',1,'R');

		$pdf->Cell(120,10,'','',1,'L');

		$pdf->Cell(120,7,'','',0,'L');
		$pdf->Cell(50,5,utf8_decode('Monsieur le Directeur'),'',1,'L');
		$pdf->Cell(120,7,'','',0,'L');
		$pdf->Cell(50,5,utf8_decode('de la '.$ref->REL_BANQUE),'',1,'L');
		$pdf->Cell(120,7,'','',0,'L');
		$pdf->Cell(50,5,utf8_decode('Niamey, République du Niger'),'',1,'L');
		$pdf->Cell(120,10,'','',1,'L');

		$pdf->Cell(120,7,'Objet : Paiement des salaires du mois de '.$mois->mois." ".$mois->annee,'',1,'L');

		$listOV=ListesVirement($mois->id,$mois->annee,$ref->REL_BANQUE);
		$total=0;
		foreach($listOV as $ov){
			$total+=$ov->montant;
		}
		$pdf->Cell(120,10,'','',1,'L');
		$pdf->SetFont('Times','',12);
		$pdf->Cell(120,10,'Monsieur le Directeur,','',1,'L');
		$pdf->Cell(120,10,'            Je vous prie de bien vouloir trouver ci-joint un ordre de virement de :','',1,'L');
		$pdf->Cell(180,7,$nw->ConvNumberLetter($total,0,0),'',1,'L');
		$pdf->Cell(120,7,'correspondant au virement du mois de '.$mois->mois." ".$mois->annee,'',1,'L');
		$pdf->Cell(120,7,utf8_decode('de nos employés cités ci-dessous dont leur salaires sont domiciliés à la '.$ref->REL_BANQUE),'',1,'L');

		$pdf->Cell(120,10,'','',1,'L');
		$pdf->Cell(90,5,utf8_decode('Nom & Prénom'),'',0,'L');
		$pdf->Cell(70,5,utf8_decode('Numéro de Compte BRUT'),'',0,'L');
		$pdf->Cell(70,5,utf8_decode('Montants'),'',1,'L');
		$pdf->SetFont('Times','',10);
		$total=0;
		foreach($listOV as $ov){
			$pdf->Cell(90,7,utf8_decode($ov->nom_pre),'',0,'L');
			$pdf->Cell(50,7,utf8_decode($ov->NR_COMPTE),'',0,'R');
			$pdf->Cell(40,7,utf8_decode($ov->montant),'',1,'R');
			$total+=$ov->montant;
		}
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(90,7,utf8_decode(''),'',0,'L');
		$pdf->Cell(70,7,utf8_decode(''),'',0,'L');
		$pdf->Cell(25,7,utf8_decode($total),'T',1,'R');
		$pdf->Cell(120,10,'','',1,'L');

		$pdf->Cell(120,7,utf8_decode('            En vous souhaitant bonne reception, veuillez agréer, Monsieur le Directeur,'),'',1,'L');
		$pdf->Cell(120,7,utf8_decode("l'assurance de nos sentiments distingués."),'',1,'L');
		$pdf->Cell(120,10,'','',1,'L');
		$pdf->Cell(200,7,utf8_decode("Prof. HAMIDOU FALALOU"),'',1,'C');
		$pdf->Cell(200,7,utf8_decode("Représentant Résident"),'',1,'C');

		if(count($listesR)>($i+1)){
			$pdf->AddPage();
		}
		$reference++;
		$i++;
}

$pdf->SetFont('Times','',12);
$pdf->Output();
