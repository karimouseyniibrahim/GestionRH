<?php

session_start();

require('../config/db.php');
require('../includes/functions.php');
require('fpdf-table-manoeuvres-billetages.php');


$col=array('MATRI','NOM - PRENOM','SALAIRE NET','10 000','5 000','2 000','1 000','500','200',
'100','50','25','10','5','1');
$options = array(
	'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
	'destinationfile' => '', //I=inline browser (default), F=local file, D=download
	'paper_size'=>'A4',	//paper size: F4, A3, A4, A5, Letter, Legal
	'orientation'=>'L' //orientation: P=portrait, L=landscape
);

 $ColWidths=array(40,120,80,40,40,40,40,40,60,40,60,40,40,40,40);
 $ColTotal=array(160,80,40,40,40,40,40,60,40,60,40,40,40,40);
 $listeP=getListeProgramByHebdomadaire();
 $Matri=array();
 $data=array();
 $DEBUTSEM="";
 $FINSEM="";
 $totalG=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
 foreach( $listeP as $program){
    $payrProg=array();
    $prog=array(
        'PROGRAM : '.$program->codeanal.' ('.$program->PROGRAM.')  - COMPTE : '.$program->COMPTE,
        'CHERCHEUR : '.$program->codact.' ('.$program->CHERCHEUR.')'
    );
    $DEBUTSEM=$program->DEBUTSEM;
    $FINSEM=$program->FINSEM;

    $Tdixmille=0;
    $Tcinqmille=0;
    $Tdeuxmille=0;
    $Tmille=0;
    $Tcinqcent=0;
    $Tdeuxcent=0;
    $Tcent=0;
    $Tcinquante=0;
    $Tvingtcinq=0;
    $Tdix=0;
    $Tcinq=0;
    $Tun=0;
    $SAL_NET=0;
    foreach (ListeJounalPaieHebdo($program->codeanal,$program->codact) as $dat){
    //  print_r($t);
        $dixmille=floor($dat->NETPAYER/10000);
        $cinqmille=floor(($dat->NETPAYER-($dixmille*10000))/5000);
        $deuxmille=floor(($dat->NETPAYER-($dixmille*10000+$cinqmille*5000))/2000);

        $mille=floor(($dat->NETPAYER-($dixmille*10000+$cinqmille*5000+$deuxmille*2000))/1000);
        $cinqcent=floor(($dat->NETPAYER-($dixmille*10000+$cinqmille*5000+$deuxmille*2000+$mille*1000))/500);
        $deuxcent=floor(($dat->NETPAYER-($dixmille*10000+$cinqmille*5000+$deuxmille*2000+$mille*1000+$cinqcent*500))/200);
        $cent=floor(($dat->NETPAYER-($dixmille*10000+$cinqmille*5000+$deuxmille*2000+$mille*1000+$cinqcent*500+$deuxcent*200))/100);
        $cinquante=floor(($dat->NETPAYER-($dixmille*10000+$cinqmille*5000+$deuxmille*2000+$mille*1000+$cinqcent*500+$deuxcent*200+$cent*100))/50);
        $vingtcinq=floor(($dat->NETPAYER-($dixmille*10000+$cinqmille*5000+$deuxmille*2000+$mille*1000+$cinqcent*500+$deuxcent*200+$cent*100+$cinquante*50))/25);
        $dix=floor(($dat->NETPAYER-($dixmille*10000+$cinqmille*5000+$deuxmille*2000+$mille*1000+$cinqcent*500+$deuxcent*200+$cent*100+$cinquante*50+$vingtcinq*25))/10);
        $cinq=floor(($dat->NETPAYER-($dixmille*10000+$cinqmille*5000+$deuxmille*2000+$mille*1000+$cinqcent*500+$deuxcent*200+$cent*100+$cinquante*50+$vingtcinq*25+$dix*10))/5);
        $un=floor(($dat->NETPAYER-($dixmille*10000+$cinqmille*5000+$deuxmille*2000+$mille*1000+$cinqcent*500+$deuxcent*200+$cent*100+$cinquante*50+$vingtcinq*25+$dix*10+$cinq*5)));


        $Matri[$dat->MATRICULEV]=1;
        array_push($payrProg,array($dat->MATRICULEV,
        $dat->nom,
        number_format($dat->NETPAYER, 0, ',', ' '),
        $dixmille,
        $cinqmille,
        $deuxmille,
        $mille,
        $cinqcent,
        $deuxcent,
        $cent,
        $cinquante,
        $vingtcinq,
        $dix,
        $cinq,
        $un));
        $i++;
        $Tdixmille+=$dixmille;
        $Tcinqmille+=$cinqmille;
        $Tdeuxmille+=$deuxmille;
        $Tmille+=$mille;
        $Tcinqcent+=$cinqcent;
        $Tdeuxcent+=$deuxcent;
        $Tcent+=$cent;
        $Tcinquante+=$cinquante;
        $Tvingtcinq+=$vingtcinq;
        $Tdix+=$dix;
        $Tcinq+=$cinq;
        $Tun+=$un;
        $SAL_NET+= $dat->NETPAYER;
         
    }
    $total=array('TOTAL PROGRAMMME-'.$program->codeanal,number_format($SAL_NET, 0, ',', ' '),number_format($Tdixmille, 0, ',', ' '),number_format($Tcinqmille, 0, ',', ' '),number_format($Tdeuxmille, 0, ',', ' '),
    number_format($Tmille, 0, ',', ' '),number_format($Tcinqcent, 0, ',', ' '),number_format($Tdeuxcent, 0, ',', ' '),number_format($Tcent, 0, ',', ' '),number_format($Tcinquante, 0, ',', ' '),
    number_format($Tvingtcinq, 0, ',', ' '),number_format($Tdix, 0, ',', ' '),number_format($Tcinq, 0, ',', ' '),number_format($Tun, 0, ',', ' '));
    $totalG=(array($SAL_NET+$totalG[0],$Tdixmille+$totalG[1],$Tcinqmille+$totalG[2],
    $Tdeuxmille+$totalG[3],$Tmille+$totalG[4],$Tcinqcent+$totalG[5],$Tdeuxcent+$totalG[6],
    $Tcent+$totalG[7],$Tcinquante+$totalG[8],$Tvingtcinq+$totalG[9],$Tdix+$totalG[10],$Tcinq+$totalG[11],$Tun+$totalG[12]));
    array_push($data,array("program"=>$prog,"payr"=>$payrProg,"total"=>$total));

 }


$data=array("data"=>$data,"debut"=>$DEBUTSEM,"fin"=>$FINSEM,
"total"=>array('TOTAL GENERAL',number_format($totalG[0], 0, ',', ' '),number_format($totalG[1], 0, ',', ' '),
number_format($totalG[2], 0, ',', ' '),number_format($totalG[3], 0, ',', ' '),number_format($totalG[4], 0, ',', ' '),
number_format($totalG[5], 0, ',', ' '),number_format($totalG[6], 0, ',', ' '),number_format($totalG[7], 0, ',', ' '),
number_format($totalG[8], 0, ',', ' '),number_format($totalG[9], 0, ',', ' '),number_format($totalG[10], 0, ',', ' '),
$totalG[11],$totalG[12]),"infos"=>"NOMBRE D'AGENTS TRAITES : ".array_sum($Matri));

$tabel = new FPDF_AutoWrapTable($data,$col,$ColWidths,$ColTotal,BILLETAGE_MANOEUVRES.date("m/Y"), $options);
$tabel->printPDF();
//print_r($tab);
    


 ?>