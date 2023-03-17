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
if(isset($_GET['idfact'])){
    $hebergements=PrintDataHebergement($_GET['idfact']);
    $i=1;
    if(count($hebergements)>0){
       // $pdf->Cell(160,0,'',1,1); 

 
        
        //$pdf->Cell(160,15,"HOSPITALITY SERVICE NIF:5017/A",'LR',1,'c'); 
        

        $pdf->Cell(290,5,utf8_decode('Doit:                   '.$hebergements[0]->doit),0,1); //25
        $pdf->Cell(290,5,utf8_decode('Hs numero:       '.trim($hebergements[0]->hs_numero)),0,1); 
        $pdf->Cell(290,5,utf8_decode('Forfait:               '.$hebergements[0]->forfait),0,1); 
        $pdf->Cell(290,5,utf8_decode('Programme:      '.$hebergements[0]->programme),0,1);         
        $pdf->Cell(290,5,utf8_decode('Chambre No:     '.$hebergements[0]->numero_chambre),0,1);         
        $pdf->Cell(290,5,utf8_decode('Date d\'arrivée:   '.$hebergements[0]->date_arrivee),0,1);         
        $pdf->Cell(290,5,utf8_decode('Date de Départ: '.$hebergements[0]->date_depart),0,1); 
        $pdf->Cell(290,5,utf8_decode('Nom & Prnom:  '.$hebergements[0]->nom." ".$hebergements[0]->prenom),0,1); 
        $pdf->Cell(290,20,"",0,1); 
        
       
        $pdf->Cell(150,0,'',1,1); 
        $pdf->Cell(10,10,utf8_decode('No.'),1,0); //vertically merged cell, height=2x row height=2x5=10
        $pdf->Cell(75,10,utf8_decode('DESIGNATION'),1,0); //normal height, but occupy 4 columns (horizontally merged)
        $pdf->Cell(25,10,'NOMBRE',1,0); //vertically merged cell 
        $pdf->Cell(25,10,'PRIX/UNIT',1,0); //vertically merged cell 
        $pdf->Cell(25,10,'PRIX TOTAL',1,1); //vertically merged cell 
        $pdf->SetFont('Arial','',10);
        $consommations=ConsommationsByID($_GET['idfact']);
        $total=$hebergements[0]->nombres_jours*($hebergements[0]->prixUnitaire_chambre+($hebergements[0]->PlusP==1?1500:0));
        $pdf->Cell(10,5,$i++,'LR',0,'c'); 
        $pdf->Cell(75,5,utf8_decode('Frais Hébergement'),'LR',0);
        $pdf->Cell(25,5,$hebergements[0]->nombres_jours,'LR',0,'C');  
        $pdf->Cell(25,5,$hebergements[0]->prixUnitaire_chambre,'LR',0,'R');
        $pdf->Cell(25,5,$total,'LR',1,'R'); 
        foreach($consommations as $consommation){
            $pdf->Cell(10,5,$i++,'LR',0,'c'); 
            $pdf->Cell(75,5,$consommation->designation,'LR',0);
            $pdf->Cell(25,5,$consommation->nombre,'LR',0,'C');  
            $pdf->Cell(25,5,$consommation->prix_unitaire,'LR',0,'R');
            $pdf->Cell(25,5,$consommation->nombre*$consommation->prix_unitaire,'LR',1,'R');
            $total=$total+$consommation->nombre*$consommation->prix_unitaire;
        }
        $pdf->Cell(160,0,'',1,1); 
        $pdf->Cell(10,10,'','LR',0,'c'); 
        $pdf->Cell(125,10,"TOTAL GENERAL",'LR',0,'C');

        $pdf->Cell(25,10,$total,'LR',1,'R');

        
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

        

$pdf->Cell(160,5,'','T',1);
$pdf->Cell(290,20,utf8_decode('Arrêté la présente facture à la somme de: ').$nw->ConvNumberLetter($total,0,0).' Francs CFA.',0,1); 

$pdf->Cell(150,15,utf8_decode('Visiteur'),0,0); 
$pdf->Cell(50,15,utf8_decode('Le Superviseur'),0,1);   
$pdf->Cell(50,15,utf8_decode(''),0,1);   

$pdf->Cell(50,5,utf8_decode('Nom de la Banque: Bank Of Africa-NIGER '),0,1); 
$pdf->Cell(50,5,utf8_decode('Nom du compte : ICRISAT Sahelian Center '),0,1); 
$pdf->Cell(50,5,utf8_decode('Adresse : BP 12404, Niamey, NIGER '),0,1); 
$pdf->Cell(50,5,utf8_decode('Numéro de Compte F, CFA: 01911002830  '),0,1); 
$pdf->Cell(50,5,utf8_decode('Code guichet: 01001 '),0,1); 
$pdf->Cell(50,5,utf8_decode('Code banque: H0038  '),0,1); 
$pdf->Cell(50,5,utf8_decode('RIB: 46  '),0,1); 
$pdf->Cell(50,5,utf8_decode('Swift code: AFRINENI '),0,1); 
$pdf->Cell(50,5,utf8_decode('Intermediary Bank: Citibank N.A '),0,1); 
$pdf->Cell(50,5,utf8_decode('SWIFT Code: CITIUS33 '),0,1); 

$pdf->SetFont('Times','',12);
$pdf->Output();
?>