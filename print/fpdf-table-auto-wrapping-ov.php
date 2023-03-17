<?php  
 
/**
 * @author Achmad Solichin
 * @website http://achmatim.net
 * @email achmatim@gmail.com
 */

require_once("../fpdf17/fpdf.php");
require('../includes/constants.php');


 
class FPDF_AutoWrapTable extends FPDF {
  	private $data = array();
    private $edition="";
    private $ColWidths=array();
    private $ColTotal=array();
	private $titleName="";
	private $col=array();
  	private $options = array(
  		'filename' => '',
  		'destinationfile' => '',
  		'paper_size'=>'F4',
  		'orientation'=>'P'
  	);
 //$data,$ColWidths,$ColTotal,ETAT_MENSUELE_CNSS.$mois->mois." ".$mois->annee," - DATE D'EDITION : ".date("d/m/Y")
  	function __construct($data = array(),$col = array(),$ColWidths = array(),$ColTotal = array(),$title,$edition, $options = array()) {
    	parent::__construct();
    	$this->data = $data;
        $this->edition = $edition;
        $this->ColWidths = $ColWidths;
		$this->titleName = $title;
        $this->ColTotal = $ColTotal;
    	$this->options = $options;
		$this->col = $col;
	}
 
	public function rptDetailData () {
		//
		$border = 0;
		$this->AddPage();
		$this->SetAutoPageBreak(true,60);
		$this->AliasNbPages();
		$left = 25;
 
		//header 
		
		$h = 12;
		$left = 40;
		$top = 80;
		#tableheader
		$this->SetFont('Arial','B',12);
            $this->SetWidths($this->ColWidths);
            $this->SetFillColor(200);
			$this->SetAligns(array('L','L',"L",'R','R','R','R'));
            //$this->SetAligns($ColWidths);
			$this->Row($this->col);
			$this->SetFont('Arial','',10);
			$brut=0;
			$montant=0;
			$isc=0;
			$total=0;
        foreach($this->data as $pData){
            $this->Row(array($pData->matriculev,$pData->numsecur,$pData->nom.' '.$pData->prenoms,
			$pData->brut,$pData->montant,$pData->isc,$pData->total));
			$brut+=$pData->brut;
			$montant+=$pData->montant;
			$isc+=$pData->isc;
			$total+=$pData->total;

        }
		$this->SetFont('Arial','B',9);
        $this->SetWidths($this->ColTotal);
        $this->SetFillColor(200);
		$this->SetAligns(array('C','R','R','R','R'));
		$this->Row(array("TOTAL GENERAL",$brut,$montant,$isc,$total));
          
	}
 
	public function printPDF () {
 
		if ($this->options['paper_size'] == "F4") {
			$a = 8.3 * 72; //1 inch = 72 pt
			$b = 13.0 * 72;
			$this->FPDF($this->options['orientation'], "pt", array($a,$b));
		} else {
			$this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
		}
 
	    $this->SetAutoPageBreak(false);
	    $this->AliasNbPages();
	    $this->SetFont("helvetica", "B", 10);
	    //$this->AddPage();
 
	    $this->rptDetailData();
 
	    $this->Output($this->options['filename'],$this->options['destinationfile']);
  	}
 
  	private $widths;
	private $aligns;
 
	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}
 
	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}
 
	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=10*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,10,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}
 
	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}
 
	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}

	function Header()
{
    // Logo
   // $this->Image('../img/logo.jpg',60,10,90);
    // Arial bold 15
    $this->SetFont('Arial','B',11);
    // Move to the right
    $this->Cell(290,10,"",0,1);
   // $this->Cell(80);
    // Title
    $this->SetFont("", "B", 15);
		$this->MultiCell(0, 12, ICRISAT_CENTRE,0,'C');
       
		$this->Cell(0, 1, " ", 1,"B"); 
        $this->Ln(10);
		$this->SetFont("", "B", 12);
		$this->SetX($left); $this->Cell(0, 10, ICRISAT_BP, 0, 1,'C');
		$this->Ln(10);
		$this->Cell(50, 10, $this->titleName, 0, 1,'L');
		$this->Ln(10);
    // Line break
    $this->Ln(5);
}
	function Footer()
	{
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}

} 