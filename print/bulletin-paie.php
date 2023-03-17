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



if(isset($_GET['id'])){
    $bulletin=ListePayrById($_GET['id']);
    //$bulletin=GetPretEcheance($_GET['id']);    
    
    $pdf->Cell(180,5,ICRISAT,'',1,'C');
    $pdf->Cell(180,5,BULLETIN_SOLDE." MOIS DE : ".$bulletin->LibMois." ".$bulletin->annee,'TB',1,'C');
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(160,10,'',0,1); 
    $pdf->Cell(50,7,utf8_decode('Programme : '.$bulletin->PROGRAM),0,1); //25
    $pdf->Cell(80,7,utf8_decode('Engament : '.$bulletin->CADRE),0,1); 
    $pdf->Cell(30,7,utf8_decode('Date Entrée : '.$bulletin->DATEMBAUC),0,1); 

    $pdf->Cell(40,7,utf8_decode('Matricule : '.$bulletin->MATRICULEV),0,1);         
    $pdf->Cell(100,7,utf8_decode('Nom & Prénom : '.$bulletin->NOM." ".$bulletin->PRENOMS),0,1); 
    $pdf->Cell(80,7,utf8_decode('Catégorie : '.$bulletin->CATEGORIE),0,1); 

    $pdf->Cell(50,7,utf8_decode('N°CNSS : '.$bulletin->NUMSECUR),0,1); 
    $pdf->Cell(50,7,utf8_decode('Reglement : '.$bulletin->REL_BANQUE),0,0); 
    $pdf->Cell(50,7,utf8_decode('Compte : '.$bulletin->NR_COMPTE),0,1); 

    $pdf->Cell(50,7,utf8_decode('Jour Effect. : '.$bulletin->Jour_effect),0,0); 
    $pdf->Cell(40,7,utf8_decode('H. Sup : '.$bulletin->HEURE_SUP),0,0); 
    $pdf->Cell(40,7,utf8_decode('H. Payees : '.$bulletin->HEURE_SUP),0,0); 
    $pdf->Cell(40,7,utf8_decode('H. Comp : '.$bulletin->HEURE_SUP),0,1); 


    $pdf->Cell(150,0,'',1,1); 
    $pdf->Cell(20,5,utf8_decode('Code'),1,0); 
    $pdf->Cell(70,5,utf8_decode('Designation'),1,0); 
    $pdf->Cell(40,5,'Retenue',1,0); 
    $pdf->Cell(50,5,'Gaine',1,1); 
    $pdf->SetFont('Arial','',10);
    $solde=0;
    foreach(ListePayrRubriqueByMatricule($bulletin->MATRICULEV,$bulletin->mois,$bulletin->annee) as $designation){

        $pdf->Cell(20,5,utf8_decode($designation->code),1,0);
        $pdf->Cell(70,5,utf8_decode($designation->LIBELLE),1,0); 

        if($designation->TYPE==="G"){
            $pdf->Cell(40,5,'',1,0);
            $pdf->Cell(50,5,$designation->montant,1,1,'R'); 
            $solde+=$designation->montant;

        }elseif($designation->TYPE=="R"){
            $pdf->Cell(40,5,$designation->montant,1,0,'R'); 
            $pdf->Cell(50,5,'',1,1); 
        }
    }

    $pdf->Cell(20,5,utf8_decode("200"),1,0);
    $pdf->Cell(70,5,utf8_decode("TOTAL RETENUE"),1,0); 
    $pdf->Cell(40,5,$bulletin->RET_TOTAL,1,0,'R'); 
    $pdf->Cell(50,5,'',1,1); 

    $pdf->Cell(20,5,utf8_decode("201"),1,0);
    $pdf->Cell(70,5,utf8_decode("TOTAL GAIN"),1,0);
    $pdf->Cell(40,5,'',1,0);  
    $pdf->Cell(50,5,$solde,1,1,'R'); 
    
    $pdf->Cell(20,5,utf8_decode("300"),1,0);
    $pdf->Cell(70,5,utf8_decode("SALAIRE NET"),1,0);
    $pdf->Cell(40,5,'',1,0);  
    $pdf->Cell(50,5,$bulletin->SAL_NET,1,1,'R'); 


    $i=1;
    if( !empty($bulletin)){
   
        
    }
}else{
        
    }

        
//$pdf->Cell(160,5,'','T',1);
//$pdf->Cell(290,20,utf8_decode('Arrêté la présente facture à la somme de: ').$nw->ConvNumberLetter($total,0,0).' Francs CFA.',0,1); 

$pdf->Cell(160,5,'','T',1);
$pdf->SetFont('Times','',12);
$pdf->Output();

?>