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
    $pdf->Cell(180,5,ICRISAT,'',1,'C');
    $pdf->Cell(180,5,MAS,'TB',1,'C');
    $pdf->Cell(180,5,utf8_decode(MAS_SUIVI),'TB',1,'C');

if(isset($_GET['id'])){
    $pretDetails=GetPretEcheance($_GET['id']);    

    $i=1;
    if( !empty($pretDetails)){
       // $pdf->Cell(160,0,'',1,1); 
       $pdf->SetFont('Arial','',9);
        $pdf->Cell(80,4,utf8_decode('N° de Reference: '.$pretDetails->num_reference),0,0); //25
        $pdf->Cell(70,4,utf8_decode('Date Octroi: '.$pretDetails->DATE_AC),0,1); 
        $pdf->Cell(80,4,utf8_decode('Code type: '.$pretDetails->code_type),0,0); 
        $pdf->Cell(70,4,utf8_decode('Libellé opération: '.$pretDetails->LIBELLE),0,1);         
        $pdf->Cell(80,4,utf8_decode('Montant: '.round(($pretDetails->MONTANT_T*100)/108)),0,0);         
        $pdf->Cell(40,4,utf8_decode('Taux : '."8%"),0,0);         
        $pdf->Cell(30,4,utf8_decode('Intérêt/Provis.: '.round(($pretDetails->MONTANT_T*8)/108)),0,1); 
        $pdf->Cell(160,4,utf8_decode('Total prêt: '.$pretDetails->MONTANT_T),0,1,'R'); 
        $pdf->Cell(150,4,utf8_decode('Recouvrement du prêt:'),0,1); 
        $pdf->Cell(50,4,utf8_decode('Durée: '.$pretDetails->NBRE_ECHEA),0,0); 
        $pdf->Cell(50,4,utf8_decode('Début: '.$pretDetails->DATE_APPEL),0,0); 
        $pdf->Cell(290,7,utf8_decode('Mensualité (s): '.$pretDetails->MONTANT_EC*$pretDetails->PERIODE),0,1); 
        $pdf->Cell(180,3,"",'T',1,'C');

        $pdf->Cell(180,4,utf8_decode(BENEFICIAIRE),0,1,'C'); 

        $pdf->Cell(50,4,utf8_decode('N°Mle: '.$pretDetails->MATRICULEV),0,0); 
        $pdf->Cell(50,4,utf8_decode('N° d\'ordre: '.$pretDetails->num_ordre),0,0); 
        $pdf->Cell(290,7,utf8_decode('Nom & Prénom (s): '.$pretDetails->NOM.' '. $pretDetails->PRENOMS),0,1); 

        $pdf->Cell(80,4,utf8_decode('Programme: '.$pretDetails->DIVISION),0,0); 
        $pdf->Cell(100,4,utf8_decode('Fonction: '.$pretDetails->CODEMPLOI),0,1); 
        $pdf->Cell(80,4,utf8_decode('Date adhésion: '.""),0,0); 
        $pdf->Cell(100,4,utf8_decode('Salaire de base: '.$pretDetails->SAL_BASE),0,1); 

        $pdf->Cell(180,4,utf8_decode('Approbation: Le bénéficiaire doit porter ici la mention LU ET APPROUVE, dae et signer'),0,1,'R'); 

        $pdf->Cell(180,3,"",'T',1,'C');

        $pdf->Cell(180,4,utf8_decode(ECHEANCIER_RECOUVREMENT),0,1,'C'); 

        
       // $pdf->Cell(290,7,utf8_decode('Nom & Prénom (s): '.$pretDetails->NOM.' '. $pretDetails->PRENOMS),0,1); 
        
        $pdf->Cell(150,0,'',1,1); 
        $pdf->Cell(10,5,utf8_decode('No.'),1,0); //vertically merged cell, height=2x row height=2x5=10
        $pdf->Cell(70,5,utf8_decode('Periode'),1,0); //normal height, but occupy 4 columns (horizontally merged)
        $pdf->Cell(40,5,'Traite',1,0); //vertically merged cell 
        $pdf->Cell(60,5,'Solde',1,1); //vertically merged cell 
        $pdf->SetFont('Arial','',10);
        $solde=0;
        for ($i=0; $i < $pretDetails->NBRE_ECHEA; $i++) { 
            # code...
            $pdf->Cell(10,6,($i+1),'LR',0,'c'); 
            $dt=explode("/",$pretDetails->DATE_APPEL);
            
            if(count($dt)==1){
                $dt1=explode("-",$pretDetails->DATE_APPEL);
                $dt=array($dt1[2],$dt1[1],$dt1[0]);
            }

            $my=($dt[1]+$i)%12==0?12:($dt[1]+$i)%12;
            $EndMonth=cal_days_in_month(CAL_GREGORIAN,$my, $dt[2]);
            if($dt[0]>=$EndMonth){
                $dt=array($EndMonth,$dt1[1],$dt1[0]);
            }
            $newDate = date('d/m/Y', strtotime("$dt[1]/$dt[0]/$dt[2]". ' + '.$i.' months'));
          //$EndMonth=cal_days_in_month(CAL_GREGORIAN,$dt[1], $dt[2]);
            $pdf->Cell(70,6,$newDate,'LR',0);
            $m= date("m");
            $y= date("y");
           
            $Echeancier=date('Y-m-d', strtotime("$m/$dt[0]/$y"));
            $nd = date('Y-m-d', strtotime("$dt[1]/$dt[0]/$dt[2]". ' + '.$i.' months'));
            if(strtotime($nd)<=strtotime($Echeancier)){
                $solde=$pretDetails->MONTANT_EC+$solde;
                $pdf->Cell(40,6,$pretDetails->MONTANT_EC,'LR',0,'R');  
                $pdf->Cell(60,6,$pretDetails->MONTANT_T-$solde,'LR',1,'R');
            }else{
                $pdf->Cell(40,6,"",'LR',0,'R');  
                $pdf->Cell(60,6,"",'LR',1,'R');
            }
            
            $pdf->Cell(180,0,'',1,1);
        }
         
      /*  $pdf->Cell(160,0,'',1,1); 
        $pdf->Cell(10,10,'','LR',0,'c'); 
        $pdf->Cell(125,10,"TOTAL GENERAL",'LR',0,'C');
        $pdf->Cell(25,10,$total,'LR',1,'R');*/
        
    }
}else{
        /*$pdf->Cell(20,10,utf8_decode('N°'),1,0); //vertically merged cell, height=2x row height=2x5=10
        $pdf->Cell(60,10,'Medecin',1,0); //vertically merged cell
        $pdf->Cell(80,10,utf8_decode('Patient'),1,0); //normal height, but occupy 4 columns (horizontally merged)
        $pdf->Cell(30,10,'Date',1,1); //vertically merged cell 
        $pdf->SetFont('Arial','',10);
        //data rows
        $consultations=consultations();
        $i=1;
        foreach($consultations as $consultation){
            $pdf->Cell(20,5,$i++,'LR',0,'c');
            $pdf->Cell(60,5,$consultation->prenomMedecin.' '.$consultation->nomMedecin,'LR',0);
            $pdf->Cell(80,5,$consultation->prenompatient.' '.$consultation->nompatient,'LR',0);
            $pdf->Cell(30,5,$consultation->date,'LR',1);
            
        }*/
    }

        
//$pdf->Cell(160,5,'','T',1);
//$pdf->Cell(290,20,utf8_decode('Arrêté la présente facture à la somme de: ').$nw->ConvNumberLetter($total,0,0).' Francs CFA.',0,1); 

$pdf->Cell(160,5,'','T',1);
$pdf->SetFont('Times','',12);
$pdf->Output();

?>