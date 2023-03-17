<?php
require('functions.php');
include ('chiffreEnLettre.php');

// Instanciation of inherited class
$pdf = new PDF('P','mm','A4');
$nw = new chiffreEnLettre;
$pdf->AliasNbPages();
$pdf->AddPage();
$total=0;
//normal row height=5.

$pdf->Cell(190,5,ICRISAT,'',1,'C');
$mois=getMonthActif();
$pdf->Cell(190,5,ELEMENT_SALAIRES." : ".$mois->mois." ".$mois->annee,'TB',1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(90,5,'',0,0); 
$pdf->Cell(30,5,utf8_decode('Mois présent'),0,0); //25
$pdf->Cell(20,5,'',0,0); 
$pdf->Cell(70,5,utf8_decode('Mois anterieur'),0,1); 
$pdf->Cell(190,2,'','T',1,1); 

$total1=0;
$total2=0;
foreach(getNbreEmployesSalaire($mois->id,$mois->annee) as $nbr){
    $pdf->Cell(90,5,"Nombre d'employees ".$nbr->liblong,0,0); 
    
    $pdf->Cell(30,5,utf8_decode(number_format($nbr->nbr, 0, ',', ' ')),0,0,'R'); //25
    $pdf->Cell(20,5,'',0,0); 
    $pdf->Cell(30,5,utf8_decode(number_format($nbr->nbr2, 0, ',', ' ')),0,1,'R'); 
    $total1+=$nbr->nbr;
}
    $pdf->Cell(90,5,"TOTAL",0,0,"C"); 
   
    $pdf->Cell(30,5,utf8_decode( number_format($total1, 0, ',', ' ')),'TB',0,'R'); //25
    $pdf->Cell(20,5,'',0,0); 
    $pdf->Cell(30,5,utf8_decode( number_format($total2, 0, ',', ' ')),'TB',1,'R'); 

    $pdf->Cell(90,5,"",0,1,"L"); 
    $pdf->Cell(90,5,"Variance",0,0,"L"); 
    $pdf->Cell(30,5,'',0,0,'R'); //25
    $pdf->Cell(20,5,'Nbre',0,0,"C");
    $pdf->Cell(30,5,utf8_decode("Montant"),0,1,'R'); 
    $previe=date('Y-m-d', strtotime(date('m')."/".date('d')."/".date('Y')." -1 month" ));
    $pdf->Cell(100,5,'Nouveau(X) Permanent(s)',0,1); 
    $nbr=0;
    $montant=0;
    foreach(getNouveauPersonnelles(date("m"),date("Y"),1,date('m', strtotime($previe)),date('Y', strtotime($previe))) as $newsP){
       
        $pdf->Cell(90,5,$newsP->NOM_PRE,0,0,"L"); 

        $pdf->Cell(30,5,utf8_decode(number_format($newsP->BASE_SAL, 0, ',', ' ')),'B',0,'R'); //25
        $nbr++;
        $montant+=$newsP->BASE_SAL;
    }
    $pdf->Cell(20,5,'',0,1); 
    $pdf->Cell(90,5,"",0,0,"L"); 
    $pdf->Cell(30,5,'',0,0); 
    $pdf->Cell(20,5,utf8_decode($nbr),'B',0,'R'); //25
    
    $pdf->Cell(30,5,utf8_decode(number_format($montant, 0, ',', ' ')),'B',1,'R');


    $pdf->Cell(100,5,'Depart(X) Permanent(s)',0,1); 
    $nbr=0;
    $montant=0;
    foreach(getNouveauPersonnelles(date('m', strtotime($previe)),date('Y', strtotime($previe)),1,date("m"),date("Y")) as $newsP){
        $pdf->Cell(90,5,$newsP->NOM_PRE,0,0,"L"); 
        
        $pdf->Cell(30,5,utf8_decode(number_format($newsP->BASE_SAL, 0, ',', ' ')),'B',1,'R'); //25
        $nbr++;
        $montant-=$newsP->BASE_SAL;
    }

    $pdf->Cell(20,5,'',0,1); 


    $pdf->Cell(90,5,"",0,0,"L"); 
    $pdf->Cell(30,5,'',0,0); 
    $pdf->Cell(20,5,utf8_decode($nbr),'B',0,'R'); //25
    
    $pdf->Cell(30,5,utf8_decode(number_format($montant, 0, ',', ' ')),'B',1,'R'); 

    //
    $pdf->Cell(20,5,'',0,1); 
    $pdf->Cell(100,5,'Nouveau(X) Contractuel(s)',0,1); 
        
    $nbr=0;
    $montant=0;
    foreach(getNouveauPersonnelles(date("m"),date("Y"),2,date('m', strtotime($previe)),date('Y', strtotime($previe))) as $newsP){
        $pdf->Cell(90,5,$newsP->NOM_PRE,0,0,"L"); 
       
        $pdf->Cell(30,5,utf8_decode( number_format($newsP->BASE_SAL, 0, ',', ' ')),'B',0,'R'); //25
        $nbr++;
        $montant+=$newsP->BASE_SAL;
    }

    $pdf->Cell(20,5,'',0,1); 

    $pdf->Cell(90,5,"",0,0,"L"); 
    $pdf->Cell(30,5,'',0,0); 
    $pdf->Cell(20,5,utf8_decode($nbr),'B',0,'R'); //25
    
    $pdf->Cell(30,5,utf8_decode(number_format($montant, 0, ',', ' ')),'B',1,'R'); 

    $pdf->Cell(100,5,'Depart(X) Contractuel(s)',0,1); 
    $nbr=0;
    $montant=0;
    foreach(getNouveauPersonnelles(date('m', strtotime($previe)),date('Y', strtotime($previe)),2,date("m"),date("Y")) as $newsP){
        $pdf->Cell(90,5,$newsP->NOM_PRE,0,0,"L"); 
        $pdf->Cell(30,5,utf8_decode(number_format($newsP->BASE_SAL, 0, ',', ' ')),'B',0,'R'); //25
        
        $nbr++;
        $montant-=$newsP->BASE_SAL;
    }

    $pdf->Cell(20,5,'',0,1); 


    $pdf->Cell(90,5,"",0,0,"L"); 
    $pdf->Cell(30,5,'',0,0); 
    $pdf->Cell(20,5,utf8_decode($nbr),'B',0,'R'); //25
    
    $pdf->Cell(30,5,utf8_decode(number_format($montant, 0, ',', ' ')),'B',1,'R'); 

    $montantP=0;
    $montantA=0;
    foreach(getSalaireNetMoisPresent_Anterieur(date("m"),date("Y"),1,date('m', strtotime($previe)),date('Y', strtotime($previe))) as $newsP){
        $pdf->Cell(90,5,"Salaires net a payer employes Permanents",0,0,"L"); 
       
        $pdf->Cell(30,5,utf8_decode( number_format($newsP->Mois_Present, 0, ',', ' ')),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode(""),0,0,'R'); //25
        
        $pdf->Cell(30,5,utf8_decode(number_format($newsP->Mois_Anterieur, 0, ',', ' ')),0,1,'R'); //25
        $montantA+=$newsP->Mois_Anterieur;
        $montantP+=$newsP->Mois_Present;
    }

    foreach(getSalaireNetMoisPresent_Anterieur(date("m"),date("Y"),2,date('m', strtotime($previe)),date('Y', strtotime($previe))) as $newsP){
        $pdf->Cell(90,5,"Salaires net a payer employes Contractuels",0,0,"L"); 
        $pdf->Cell(30,5,utf8_decode( number_format($newsP->Mois_Present, 0, ',', ' ')),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode(""),0,0,'R'); //25
        
        $pdf->Cell(30,5,utf8_decode(number_format($newsP->Mois_Anterieur, 0, ',', ' ')),0,1,'R'); //25
        $montantA+=$newsP->Mois_Anterieur;
        $montantP+=$newsP->Mois_Present;
    }
 
    $pdf->Cell(90,5,"Total",0,0,"C"); 
    $pdf->Cell(30,5,utf8_decode($montantP),'B',0,'R'); //25
    $pdf->Cell(20,5,'',0,0,"C");
    $pdf->Cell(30,5,utf8_decode($montantA),'B',1,'R'); 

    $montantP=0;
    $montantA=0;
    
    //$pdf->AddPage();

    $pdf->Cell(90,5,"(1) Tableau comparatif",0,1,"L"); 

    $pdf->Cell(80,5,"",0,0,"L"); 
    $pdf->Cell(30,5,'Mois Present','B',0); 
    $pdf->Cell(20,5,utf8_decode("Mois anterieur"),'B',0,'R'); //25
    $pdf->Cell(20,5,utf8_decode('Variation'),'B',1,'R'); 
    $variation=0;
    foreach(getSalaireBaseMoisPresent_Anterieur(date("m"),date("Y"),1,date('m', strtotime($previe)),date('Y', strtotime($previe))) as $newsP){
        $pdf->Cell(90,5,"Salaires Base (P)",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur-$newsP->Mois_Present),0,1,'R'); //25
        $montantA+=$newsP->Mois_Anterieur;
        $montantP+=$newsP->Mois_Present;
        $variation+=$newsP->Mois_Anterieur-$newsP->Mois_Present;
    }
    foreach(getSalaireBaseMoisPresent_Anterieur(date("m"),date("Y"),2,date('m', strtotime($previe)),date('Y', strtotime($previe))) as $newsP){
        $pdf->Cell(90,5,"Salaires Base (C)",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur-$newsP->Mois_Present),0,1,'R'); //25
        $montantA+=$newsP->Mois_Anterieur;
        $montantP+=$newsP->Mois_Present;
        $variation+=$newsP->Mois_Anterieur-$newsP->Mois_Present;
    }
    foreach(getLogementMoisPresent_Anterieur(date("m"),date("Y"),1,date('m', strtotime($previe)),date('Y', strtotime($previe))) as $newsP){
        $pdf->Cell(90,5,"Logement",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur-$newsP->Mois_Present),0,1,'R'); //25
        $montantA+=$newsP->Mois_Anterieur;
        $montantP+=$newsP->Mois_Present;
        $variation+=$newsP->Mois_Anterieur-$newsP->Mois_Present;
    }

    foreach(getHeurSupMoisPresent_Anterieur(date("m"),date("Y"),1,date('m', strtotime($previe)),date('Y', strtotime($previe))) as $newsP){
        $pdf->Cell(90,5,"Heures Supplementaires (P)",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur-$newsP->Mois_Present),0,1,'R'); //25
        $montantA+=$newsP->Mois_Anterieur;
        $montantP+=$newsP->Mois_Present;
        $variation+=$newsP->Mois_Anterieur-$newsP->Mois_Present;
    }
    foreach(getHeurSupMoisPresent_Anterieur(date("m"),date("Y"),2,date('m', strtotime($previe)),date('Y', strtotime($previe))) as $newsP){
        $pdf->Cell(90,5,"Heures Supplementaires (C)",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur-$newsP->Mois_Present),0,1,'R'); //25
        $montantA+=$newsP->Mois_Anterieur;
        $montantP+=$newsP->Mois_Present;
        $variation+=$newsP->Mois_Anterieur-$newsP->Mois_Present;
    }

    foreach(getIndenDiverseMoisPresent_Anterieur(date("m"),date("Y"),1,date('m', strtotime($previe)),date('Y', strtotime($previe))) as $newsP){
        $pdf->Cell(90,5,"Indemnites Divers (P)",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur-$newsP->Mois_Present),0,1,'R'); //25
        $montantA+=$newsP->Mois_Anterieur;
        $montantP+=$newsP->Mois_Present;
        $variation+=$newsP->Mois_Anterieur-$newsP->Mois_Present;
    }
    foreach(getIndenDiverseMoisPresent_Anterieur(date("m"),date("Y"),2,date('m', strtotime($previe)),date('Y', strtotime($previe))) as $newsP){
        $pdf->Cell(90,5,"Indemnites Divers (C)",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur-$newsP->Mois_Present),0,1,'R'); //25
        $montantA+=$newsP->Mois_Anterieur;
        $montantP+=$newsP->Mois_Present;
        $variation+=$newsP->Mois_Anterieur-$newsP->Mois_Present;
    }

    foreach(getRetAbsenceMoisPresent_Anterieur(date("m"),date("Y"),1,date('m', strtotime($previe)),date('Y', strtotime($previe))) as $newsP){
        $pdf->Cell(90,5,"Retenus Absence (P)",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur-$newsP->Mois_Present),0,1,'R'); //25
        $montantA+=$newsP->Mois_Anterieur;
        $montantP+=$newsP->Mois_Present;
        $variation+=$newsP->Mois_Anterieur-$newsP->Mois_Present;
    }
    foreach(getRetAbsenceMoisPresent_Anterieur(date("m"),date("Y"),2,date('m', strtotime($previe)),date('Y', strtotime($previe))) as $newsP){
        $pdf->Cell(90,5,"Retenus Absence  (C)",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur),0,0,'R'); //25
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Anterieur-$newsP->Mois_Present),0,1,'R'); //25
        $montantA+=$newsP->Mois_Anterieur;
        $montantP+=$newsP->Mois_Present;
        $variation+=$newsP->Mois_Anterieur-$newsP->Mois_Present;
    }

    $pdf->Cell(90,5,"",0,0,"L"); 
    $pdf->Cell(20,5,utf8_decode($montantP),0,0,'R'); //25
    $pdf->Cell(20,5,utf8_decode($montantA),0,0,'R'); //25
    $pdf->Cell(20,5,utf8_decode($variation),0,1,'R'); //25

    $pdf->Cell(90,5,"(2) Tableau comparatif",0,1,"L"); 

    $pdf->Cell(90,5,"",0,0,"L"); 
    $pdf->Cell(20,5,'ICRISAT CORE',0,1); 
    $total2=0;
    foreach(getSalaireBaseMoisPresent_Anterieur1(date("m"),date("Y"),1) as $newsP){
        $pdf->Cell(90,5,"Salaire de Base (P)",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,1,'R'); //25
        $total2+=$newsP->Mois_Present;
    }
    foreach(getSalaireBaseMoisPresent_Anterieur1(date("m"),date("Y"),2) as $newsP ){
       $pdf->Cell(90,5,"Salaire de Base (C)",0,0,"L"); 
       $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,1,'R'); //25
       $total2+=$newsP->Mois_Present;
    }

    foreach(getMoisPresent(date("m"),date("Y"),1,106) as $newsP ){
        $pdf->Cell(90,5,"Logement ",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,1,'R'); //25
        $total2+=$newsP->Mois_Present;
     }

     foreach(getMoisPresent(date("m"),date("Y"),1,103) as $newsP ){
        $pdf->Cell(90,5,"Heures Supplementaires (P) ",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,1,'R'); //25
        $total2+=$newsP->Mois_Present;
     }

     foreach(getMoisPresent(date("m"),date("Y"),2,103) as $newsP ){
        $pdf->Cell(90,5,"Heures Supplementaires (C) ",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,1,'R'); //25
        $total2+=$newsP->Mois_Present;
     }

     foreach(getMoisPresent(date("m"),date("Y"),1,107) as $newsP ){
        $pdf->Cell(90,5,"Indmnites Divers (P) ",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,1,'R'); //25
        $total2+=$newsP->Mois_Present;
     }

     foreach(getMoisPresent(date("m"),date("Y"),2,107) as $newsP ){
        $pdf->Cell(90,5,"Indmnites Divers (C) ",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode($newsP->Mois_Present),0,1,'R'); //25
        $total2+=$newsP->Mois_Present;
     }

     foreach(getMoisPresent(date("m"),date("Y"),1,3900) as $newsP ){
        $pdf->Cell(90,5,"Retenues Absence (P) ",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode(-$newsP->Mois_Present),0,1,'R'); //25
        $total2-=$newsP->Mois_Present;
     }

     foreach(getMoisPresent(date("m"),date("Y"),2,3900) as $newsP ){
        $pdf->Cell(90,5,"Retenues Absence (C) ",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode(-$newsP->Mois_Present),0,1,'R'); //25
        $total2-=$newsP->Mois_Present;
     }

     foreach(getMoisPresent(date("m"),date("Y"),1,4100) as $newsP ){
        $pdf->Cell(90,5,"Retenues Conge (P) ",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode(-$newsP->Mois_Present),0,1,'R'); //25
        $total2-=$newsP->Mois_Present;
     }

     foreach(getMoisPresent(date("m"),date("Y"),2,4100) as $newsP ){
        $pdf->Cell(90,5,"Retenues Conge (C) ",0,0,"L"); 
        $pdf->Cell(20,5,utf8_decode(-$newsP->Mois_Present),0,1,'R'); //25
        $total2-=$newsP->Mois_Present;
     }
     $CoutTotal=$total2;
     $pdf->Cell(90,5,"",0,0,"L"); 
     $pdf->Cell(20,5,utf8_decode($total2),0,1,'R'); //25

     $pdf->Cell(90,5,"RETENUES CHEANCIERS PRIVES",0,0,"L"); 
     $pdf->Cell(20,5,utf8_decode(""),0,1,'R'); //25
     $total2=0;
     foreach(getRetenuPriver(date("m"),date("Y"),'PARTICULIER') as $newsP ){
        $pdf->Cell(90,5,$newsP->libelle,0,0,"L"); 
        $pdf->Cell(20,5,$newsP->code,0,0,"R"); 
        $pdf->Cell(30,5,utf8_decode($newsP->retenueP),0,1,'R'); //25
        $total2+=$newsP->retenueP;
     }
     $pdf->Cell(90,5,"",0,0,"L"); 
     $pdf->Cell(20,5,"",0,0,"R"); 
     $pdf->Cell(30,5,utf8_decode($total2),"TB",1,'R'); //25

     $pdf->Cell(90,5,"RETENUES ISC",0,0,"L"); 
     $pdf->Cell(20,5,utf8_decode(""),0,1,'R'); //25
     $total2=0;
     foreach(getRetenuPriver(date("m"),date("Y"),'ICRISAT') as $newsP ){
        $pdf->Cell(90,5,$newsP->libelle,0,0,"L"); 
        $pdf->Cell(20,5,$newsP->code,0,0,"R"); 
        $pdf->Cell(30,5,utf8_decode($newsP->retenueP),0,1,'R'); //25
        $total2+=$newsP->retenueP;
     }
     $pdf->Cell(90,5,"",0,0,"L"); 
     $pdf->Cell(20,5,"",0,0,"R"); 
     $pdf->Cell(30,5,utf8_decode($total2),"TB",1,'R'); //25

     $pdf->Cell(90,5,"",0,1,"L"); 
     $pdf->Cell(90,5,"RETENUES CNSS + FOND NATIONAL DE RETRAITE",0,0,"L"); 
     $pdf->Cell(20,5,utf8_decode(""),0,1,'R'); //25
     $total2=0;
     foreach(getRetenuesCNSSEmploye(date("m"),date("Y")) as $newsP ){
        $pdf->Cell(90,5,'CNSS 5.25% '.$newsP->liblong,0,0,"L"); 
        $pdf->Cell(20,5,$newsP->montant,0,1,"R");  
        $total2+=$newsP->montant;
     }
     $pdf->Cell(90,5,"FNR EMPLOYE",0,0,"L"); 
     $pdf->Cell(20,5,"",0,0,"R"); 
     $pdf->Cell(30,5,utf8_decode($total2),"TB",1,'R'); //25


     $pdf->Cell(90,5,"",0,1,"L"); 
     $pdf->Cell(90,5,"CONTRIBUTION ISC: SECURITE SOCIAL + ANPE + FOND NATIONAL DE RETRAITE",0,0,"L"); 
     $pdf->Cell(20,5,utf8_decode(""),0,1,'R'); //25
     $total2=0;
     foreach(getRetenuesCNSSISC(date("m"),date("Y")) as $newsP ){
        $pdf->Cell(90,5,'CNSS 16.4% '.$newsP->liblong,0,0,"L"); 
        $pdf->Cell(20,5,$newsP->montant,0,1,"R");  
        $total2+=$newsP->montant;
     }
     foreach(getRetenuesCNSSANPE(date("m"),date("Y")) as $newsP ){
        $pdf->Cell(90,5,'ANPE 0.5% '.$newsP->liblong,0,0,"L"); 
        $pdf->Cell(20,5,$newsP->montant,0,1,"R");  
        $total2+=$newsP->montant;
     }
     $pdf->Cell(90,5,"FNR EMPLOYEUR",0,0,"L"); 
     $pdf->Cell(20,5,"",0,0,"R"); 
     $pdf->Cell(30,5,utf8_decode($total2),"TB",1,'R'); //25
     $CoutTotal+=$total2;
     $pdf->Cell(90,5,"COUT TOTAL",0,0,"L"); 
     $pdf->Cell(20,5,"",0,0,"R"); 
     $pdf->Cell(30,5,utf8_decode($CoutTotal),"B",1,'R'); //25
     

     $total2=0;
     $pdf->Cell(20,7,"",0,1,"R");
     foreach(getCoutTotal(date("m"),date("Y")) as $newsP ){
        $pdf->Cell(90,5,$newsP->liblong,0,0,"L"); 
        $pdf->Cell(20,5,$newsP->montant,0,1,"R");  
        $total2+=$newsP->montant;
     }

     $pdf->Cell(90,5,"COUT TOTAL",0,0,"L"); 
     $pdf->Cell(20,5,"",0,0,"R"); 
     $pdf->Cell(30,5,utf8_decode($total2),"B",1,'R'); //25

if(isset($_GET['id'])){
    $bulletin=ListePayrById($_GET['id']);
    //$bulletin=GetPretEcheance($_GET['id']);    
    
 
    $pdf->SetFont('Arial','B',12);
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
    $pdf->Cell(50,5,$bulletin->SAL_NET,1,1,'R'); 
    
    $pdf->Cell(20,5,utf8_decode("300"),1,0);
    $pdf->Cell(70,5,utf8_decode("SALAIRE NET"),1,0);
    $pdf->Cell(40,5,'',1,0);  
    $pdf->Cell(50,5,$bulletin->SAL_NET,1,1,'R'); 


    
}else{
         
    }

//$pdf->Cell(190,5,'','T',1);
$pdf->SetFont('Times','',12);
$pdf->Output();

?>