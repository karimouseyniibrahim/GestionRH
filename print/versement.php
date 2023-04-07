<?php
require('functions0.php');
include ('chiffreEnLettre.php');

// Instanciation of inherited class
$format=array(200,200 );
$pdf = new PDF('P','mm',$format);

//$pdf = new FPDF('P','in', [4.1,2.9]);
$nw = new chiffreEnLettre;
$pdf->AliasNbPages();
$pdf->AddPage();
$total=0;
//normal row height=5.
if(isset($_GET['id'])){
    $ovp=GetVirementPonctuelsByID($_GET['id']);
    $nw = new chiffreEnLettre;
    $pdf->Cell(90,19,"",0,1);  
    $pdf->Cell(130,0,"",0,0,"R");  
    $pdf->Cell(0,0,utf8_decode($ovp->titulaire),0,1,"L");  

    $pdf->Cell(88,12,"",0,1);  
    $pdf->Cell(102,1,"",0,0,"R");  
    //implode(' ',$password)
    $pdf->SetFont('Times','',13);
    $pdf->Cell(55,1,implode('  ',str_split($ovp->num_compteDebit)),0,1,"R");
    $pdf->SetFont('Times','',11);
    $pdf->Cell(88,5,"",0,1);  
    $pdf->Cell(47,5,"",0,0,"R");  
    $pdf->Cell(0,5,number_format($ovp->montant, 0, ',', ' '),0,1,"L");
        
    $pdf->Cell(90,3,"",0,1);  
    $pdf->Cell(50,3,"",0,0,"R");  
    $pdf->Cell(0,3,$nw->ConvNumberLetter($ovp->montant)." FCFA",0,1,"L");
    $pdf->SetFont('Times','',12);
    $pdf->Cell(90,7,"",0,1);  
    $pdf->Cell(35,3,"",0,0,"R");  
    $pdf->Cell(0,3,utf8_decode($ovp->nombenf ),0,1,"L");

    $pdf->Cell(90,5,"",0,1);  
    $pdf->Cell(35,3,"",0,0,"R");  
    $pdf->Cell(0,3,utf8_decode($ovp->adresseBeneficiaire ),0,1,"L");

    $pdf->Cell(90,6,"",0,1);  
    $pdf->Cell(40,3,"",0,0,"R");  
    $pdf->Cell(110,3,utf8_decode($ovp->banqueBenf ),0,0,"L");
    $pdf->Cell(0,3,utf8_decode($ovp->codeswift ),0,1,"L");
    $pdf->SetFont('Times','',12);
    $pdf->Cell(92,10,"",0,1);  
    $pdf->Cell(41,3,"",0,0,"R");  
    $pdf->Cell(29,3,implode('   ',str_split($ovp->codebanqueBenf )),0,0,"L");
    $pdf->Cell(31,3,implode('   ',str_split($ovp->codeguicher )),0,0,"L");
    $pdf->Cell(65,3,implode('   ',str_split($ovp->numcomptebenf )),0,0,"L");
    $pdf->Cell(2,3,implode('   ',str_split($ovp->clerib )),0,1,"L");
    $pdf->SetFont('Times','',12);
    $pdf->Cell(90,10,"",0,1);  
    $pdf->Cell(15,3,"",0,0,"R");  
    $pdf->Cell(30,3,utf8_decode($ovp->motif ),0,1,"L");

    $pdf->Cell(90,8,"",0,1);  
    $pdf->Cell(20,3,"",0,0,"R");  
    $pdf->Cell(41,3,utf8_decode("Niamey"),0,0,"L");
    $pdf->Cell(14,3,implode('  ',str_split(date("d",strtotime($ovp->datecreat )))),0,0,"L");
    $pdf->Cell(22,3,implode('  ',str_split(date("m",strtotime($ovp->datecreat )))),0,0,"L");
    $pdf->Cell(12,3,implode('  ',str_split(date("y",strtotime($ovp->datecreat )))),0,0,"L");


}
         

$pdf->SetFont('Times','',12);
$pdf->Output();
?>