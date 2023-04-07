<?php
require('functions0.php');
include ('chiffreEnLettre.php');

// Instanciation of inherited class
$format=array(80,175 );
$pdf = new PDF('L','mm',$format);
//$pdf = new FPDF('P','in', [4.1,2.9]);
$nw = new chiffreEnLettre;
$pdf->AliasNbPages();
$pdf->AddPage();
$total=0;
//normal row height=5.
if(isset($_GET['id'])){
    $cheque=GetChequeByID($_GET['id']);
    $nw = new chiffreEnLettre;
        $pdf->Cell(145,5,utf8_decode(str_replace(',00', '',$cheque->NETAPAYER)),0,1,"R");  
        $pdf->Cell(1,8,"",0,1);  
        $pdf->Cell(20,5,"",0,0);       
        $pdf->Cell(125,5,utf8_decode($nw->ConvNumberLetter(str_replace(' ', '',$cheque->NETAPAYER),0,0).' FCFA'),0,1);         
        $pdf->Cell(1,5,"",0,1); 
        $pdf->Cell(20,5,"",0,0); 
        $pdf->Cell(125,5,utf8_decode($cheque->name),0,1,"L"); 
        $pdf->Cell(130,1,"Niamey",0,0,"R"); 
        $pdf->Cell(7,1,"",0,0,"R"); 
        $pdf->Cell(50,1,utf8_decode($cheque->DATE_BDR),0,1); 
        $pdf->Cell(20,20,"",0,1); 
        $pdf->Cell(20,0,"",0,0);
        $pdf->Cell(100,0,utf8_decode("CHEQUE NON ENDOSSABLE"),0,1); 
        

}
         

$pdf->SetFont('Times','',12);
$pdf->Output();
?>