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
    $cheque=GetChequeByID($_GET['id']);
      
        $pdf->Cell(195,5,utf8_decode($cheque->NETAPAYER),0,1,"R");         
        $pdf->Cell(290,5,utf8_decode('Lettrage:   '.$cheque->NETAPAYER),0,1,"C");         
        $pdf->Cell(290,5,utf8_decode('Nom: '.$cheque->name),0,1); 
        $pdf->Cell(290,20,"Lieu",0,1); 
        $pdf->Cell(290,5,utf8_decode('Date:  '.$cheque->DATE_BDR),0,1); 
        

}
         

$pdf->SetFont('Times','',12);
$pdf->Output();
?>