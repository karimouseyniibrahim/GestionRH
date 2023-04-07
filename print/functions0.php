<?php
session_start();
require('../fpdf17/fpdf.php');
require('../config/db.php');
require('../includes/functions.php');
require('../includes/constants.php');
//require('../includes/constants.php');
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
   // $this->Image('../img/logo.jpg',60,10,90);
    // Arial bold 15
    $this->SetFont('Arial','',11);
    // Move to the right
    $this->setY(5);
 //   $this->Cell(290,10,"",0,1);
   // $this->Cell(80);
    // Title
    
    // Line break
    //$this->Ln(5);
}

// Page footer
/*function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}*/
}