<?php
/*
if(!defined('not_empty')){
    function not_empty ($fields=[]){
        if(count($fields)!=0){
            foreach($fields as $field){
                if(empty($_POST[$field]) || trim($_POST[$field])==""){//verification si le champs est vide
                    return false;
                }
            }

            return true;
        }
    }
}


if(!function_exists('e')){
    function e($string){
        if($string){
           return  htmlspecialchars($string);
        }
    }
}
if(!function_exists('get_session')){
    function get_session($key){
        if($key){
            return !empty($_SESSION[$key])
            ? e($_SESSION[$key])
            : null;
        }
    }
}
if(!function_exists('is_logged_in')){
    function is_logged_in(){
        return isset ($_SESSION['user_id']);
    }
}

if(!function_exists('get_input')){
    function get_input($key){
        if(!empty($_SESSION['input'][$key])){
        return e($_SESSION['input'][$key]);
        }
        else{
            return null;
        }
    }
}
*/

function GetNbrDayWork(){
    $m = date("m");
    $y=$date = date("y");
    $compteur=cal_days_in_month(CAL_GREGORIAN,$m, $y);
  
    $week=0;
    for ($i=0; $i <$compteur ; $i++) { 
      # code...
      $week+=date('w', strtotime("$y-$m-$i"))==5?1:0;
      $week+=date('w', strtotime("$y-$m-$i"))==6?1:0;
    }
  
  return ($compteur-$week);
  }

if(!function_exists('clear_data_post')){
    function clear_data_post(){
        $_POST=array();
    }
}


if(!function_exists('set_flash')){
    function set_flash($message,$type='infos'){
        $_SESSION['notification']['message']=$message;
        $_SESSION['notification']['type']=$type;
    }
}

if(!function_exists('redirect')){
    function redirect($page){
        header('Location:'.$page);
        exit();

    }
}
if(!function_exists('save_input_data')){
    function save_input_data(){
        foreach($_POST as $key=>$value){
            $_SESSION['input'][$key]=$value;
        }
    }
}

/*
if(!function_exists('liste_clients')){
    function liste_clients($limit_left,$limit_right){
        global $db;
        $q=$db->prepare("select * from clients limit ".$limit_left.",".$limit_right);     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}
*/
if(!function_exists('ListePayr')){
    function ListePayr(){
        global $db;
        $q=$db->prepare("select * from payr where actif=1 order by program");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('ListeJounalPaie')){
    function ListeJounalPaie($mois,$annee,$program){
        global $db;
        $q=$db->prepare("SELECT `MATRICULEV`, `NOM_PRE`,ACCOUNT,BASE_SAL,LOGEMENT,HEURE_SUP,IND_DIVERS,
        CNSS_ISC,CNSS_EMP, COUT_TOT, RET_ABS, RET_CONGE, RET_DIVERS, RET_TOTAL, SAL_NET  FROM `payr` 
        where mois=:mois and annee=:annee and program=:program ORDER BY MATRICULEV ");     
        $q->execute(array(':mois'=>$mois,':annee'=>$annee,':program'=>$program)); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('ListeJounalPaieHebdo')){
    function ListeJounalPaieHebdo($codeAnalyt,$codact){
        global $db;
        $q=$db->prepare("SELECT p.nom, m.MATRICULEV, `NORM`, `SUPP`, `FERI`, `HRS_TOTAL`, `CFA_TOTAL`, `CODEANAL`, 
        `DEBUTSEM`, `CODACT`, `FINSEM`, `CODELOCA`, `statut`, `retenue`, `SALABASE`, `CNSS_RET`, `CNSS_EMP`, `ANPE`, 
        `SALABRUT`, `NETPAYER`, `GAINCONG`, `DEPENSE`, `COMPTE` FROM `maneouvres_heures` as m 
        INNER JOIN personnelles_manoeuvres as p on m.matriculev=p.matriculev WHERE statut=1 and CODEANAL=:CODEANAL and CODACT=:CODACT");     
        $q->execute(array(':CODEANAL'=>$codeAnalyt,':CODACT'=>$codact)); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getMonthActif')){
    function getMonthActif(){
        global $db;
        $q=$db->prepare("select (m.libelle) as mois,(m.id),annee from payr as p,mois as m 
        where actif=1 and p.mois=m.id group by m.libelle,m.id,annee");     
        $q->execute(); 
        return $q->fetch(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getProgramPByMatricule')){
    function getProgramPByMatricule($matricule){
        global $db;
        $q=$db->prepare("select * from programpersonnelle where matriculev=:matricule");     
        $q->execute(array(":matricule"=>$matricule)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getListeProgramByMonth')){
    function getListeProgramByMonth($mois,$annee){
        global $db;
        $q=$db->prepare("SELECT  PROGRAM,codlib,LIBLONG,LIBCOURT FROM `payr`as p INNER JOIN codeanalytique as c 
        ON p.program=c.codlib where mois=:mois and annee=:annee and codtab=20  group by PROGRAM,LIBLONG,LIBCOURT");     
        $q->execute(array(":mois"=>$mois,"annee"=>$annee)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getListeProgramByHebdomadaire')){
    function getListeProgramByHebdomadaire(){
        global $db;
        $q=$db->prepare("SELECT  codact,codeanal,c.LIBLONG as CHERCHEUR,vc.LIBLONG as PROGRAM,DEBUTSEM,FINSEM,COMPTE FROM `maneouvres_heures`as m 
        INNER JOIN codeanalytique as c ON m.codact=c.codlib INNER JOIN program_name as vc on vc.codlib=m.codeanal 
        where c.codtab=21 and m.statut=1  group by codact,codeanal,c.LIBLONG,vc.LIBLONG ORDER BY m.id");     
        $q->execute(); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getNbreEmployesSalaire')){
    function getNbreEmployesSalaire($mois,$annee){
        global $db;
        $q=$db->prepare("SELECT t.position,t.mois,t.annee,liblong,count(*) as nbr FROM 
        (select matriculev,position,mois,annee from payr group by matriculev,position,mois,annee) as t 
        LEFT join codeanalytique as c on c.codlib=t.position where C.codtab=22 and mois=:mois and annee=:annee  
        group by t.position,t.mois,t.annee,liblong ");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getNouveauPersonnelles')){
    function getNouveauPersonnelles($mois,$annee,$position,$moisP,$anneeP){
        global $db;
        $q=$db->prepare("SELECT * FROM `payr` WHERE not MATRICULEV in (select matriculev from payr where annee=:anneep
         and mois=:moisp and position=:position) and mois =:mois and annee=:annee and position=:position");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee,':position'=>$position,":anneep"=>$anneeP,":moisp"=>$moisP)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getSalaireNetMoisPresent_Anterieur')){
    function getSalaireNetMoisPresent_Anterieur($mois,$annee,$position,$moisP,$anneeP){
        global $db;
        $q=$db->prepare("select sum(present) as Mois_Present,sum(anterieur) as Mois_Anterieur from 
        (SELECT if(mois=:mois,`SAL_NET`,0) as present, if(mois=:moisp,SAL_NET,0) as anterieur FROM `payr` 
        WHERE (mois=:mois or mois=:moisp) and (annee=:annee or annee=:anneep) and position=:position) as MoisP_A ");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee,':position'=>$position,":anneep"=>$anneeP,":moisp"=>$moisP)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getSalaireBaseMoisPresent_Anterieur')){
    function getSalaireBaseMoisPresent_Anterieur($mois,$annee,$position,$moisP,$anneeP){
        global $db;
        $q=$db->prepare("select sum(present) as Mois_Present,sum(anterieur) as Mois_Anterieur from 
        (SELECT if(mois=:mois,`BASE_SAL`,0) as present, if(mois=:moisp,BASE_SAL,0) as anterieur FROM `payr` 
        WHERE (mois=:mois or mois=:moisp) and (annee=:annee or annee=:anneep) and position=:position) as MoisP_A ");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee,':position'=>$position,":anneep"=>$anneeP,":moisp"=>$moisP)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getSalaireBaseMoisPresent_Anterieur1')){
    function getSalaireBaseMoisPresent_Anterieur1($mois,$annee,$position){
        global $db;
        $q=$db->prepare("select sum(present) as Mois_Present from (SELECT p.code, if(p.mois=:mois and p.annee=:annee,p.montant,0) as present 
         FROM `payrrubrique` as p inner join personnelles as ps on p.matriculev=ps.matriculev
        where ps.position=:position and ps.statut='VRAI' and mois =:mois and annee=:annee and p.code=100) as fr ");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee,':position'=>$position)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getRetenuPriver')){
    function getRetenuPriver($mois,$annee,$statut){
        global $db;
        $q=$db->prepare("SELECT r.libelle, p.code, sum(p.montant) retenueP FROM `payrrubrique` as p 
        inner join rubriques as r on p.code=r.code  inner join personnelles as ps on p.matriculev=ps.matriculev
        where ps.statut='VRAI' and mois =:mois and annee=:annee and r.statut =:statut and 
        r.type='R' group by r.libelle, p.code ");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee,":statut"=>$statut)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getRetenuesCNSSEmploye')){
    function getRetenuesCNSSEmploye($mois,$annee){
        global $db;
        $q=$db->prepare("SELECT ca.liblong,sum(c.montant) as montant FROM `cnss` as c inner join codeanalytique as ca 
         on c.position=ca.codlib where ca.codtab=22 and c.mois=:mois and c.annee=:annee group by ca.liblong");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getRetenuesCNSSISC')){
    function getRetenuesCNSSISC($mois,$annee){
        global $db;
        $q=$db->prepare("SELECT ca.liblong,sum(c.montant2) as montant FROM `cnss` as c inner join codeanalytique as ca 
         on c.position=ca.codlib where ca.codtab=22 and c.mois=:mois and c.annee=:annee group by ca.liblong");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getRetenuesCNSSANPE')){
    function getRetenuesCNSSANPE($mois,$annee){
        global $db;
        $q=$db->prepare("SELECT ca.liblong,sum(c.ANPE) as montant FROM `cnss` as c inner join codeanalytique as ca 
         on c.position=ca.codlib where ca.codtab=22 and c.mois=:mois and c.annee=:annee group by ca.liblong");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getCNSSMENSUEL')){
    function getCNSSMENSUEL($mois,$annee){
        global $db;
        $q=$db->prepare("SELECT c.matriculev,numsecur,c.nom,c.prenoms,if(mont_brut>=500000,500000,mont_brut) as brut,
        c.montant,c.montant2,c.anpe,(c.montant2+c.anpe) as isc,(c.montant2+c.anpe+c.montant) as total FROM `personnelles` as p 
        inner join cnss as c on p.matriculev=c.matriculev where statut='vrai'  and mois=:mois and 
        annee=:annee order by p.matriculev");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}
if(!function_exists('getCNSSHebdo')){
    function getCNSSHebdo(){
        global $db;
        $q=$db->prepare("SELECT p.nom, m.MATRICULEV, `CNSS_RET`, `CNSS_EMP`, `ANPE`,  `SALABRUT`, NR_CNSS,FINSEM,DEBUTSEM FROM `maneouvres_heures` as m 
        INNER JOIN personnelles_manoeuvres as p on m.matriculev=p.matriculev WHERE statut=1 ");     
        $q->execute(); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('ListeBulletinPaieManoeuvre')){
    function ListeBulletinPaieManoeuvre(){
        global $db;
        $q=$db->prepare("SELECT  m.MATRICULEV,p.NOM,NR_CNSS,  `NORM`, `SUPP`, `FERI`, `HRS_TOTAL`, `CFA_TOTAL`,  `DEBUTSEM`, `FINSEM`, 
        `CODELOCA`, `statut`, `retenue`,`SALABASE`, `CNSS_RET`,  `SALABRUT`, `NETPAYER`, `GAINCONG` 
        FROM `maneouvres_heures` as m inner join personnelles_manoeuvres as p on m.matriculev=p.matriculev 
        WHERE m.statut=1");     
        $q->execute(); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('ListePaieManoeuvreByHebdo')){
    function ListePaieManoeuvreByHebdo($sem1,$sem2){
        global $db;
        $q=$db->prepare("SELECT p.nom,m.matriculev,sum(if(finsem=:s1,netpayer,0)) as sem1,
        sum(if(finsem=:s2,netpayer,0)) as sem2 FROM `maneouvres_heures` as m 
        inner join personnelles_manoeuvres as p on p.matriculev=m.matriculev 
        where finsem=:s1 or finsem=:s2 group by p.nom,m.matriculev  order by m.matriculev");     
        $q->execute(array(":s1"=>$sem1,":s2"=>$sem2)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('ListesVirement')){
    function ListesVirement($mois,$annee,$ref){
        global $db;
        $q=$db->prepare("SELECT p.matriculev,nom_pre,REL_BANQUE,	NR_COMPTE,sum(pr.sal_net) as montant,
        min(codlib)  FROM `personnelles` as p inner join `codeanalytique` as c on p.REL_BANQUE=c.liblong 
        inner join payr as pr on pr.matriculev=p.matriculev where  codtab=51 and statut='vrai' and 
        pr.mois=:mois and pr.annee=:annee and codlib>0 and liblong=:ref  group by p.matriculev,nom_pre,REL_BANQUE,NR_COMPTE 
        order by codlib,pr.matriculev");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee,":ref"=>$ref)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('ListesBilletage')){
    function ListesBilletage($mois,$annee){
        global $db;
        $q=$db->prepare("SELECT p.matriculev,nom_pre,REL_BANQUE,	NR_COMPTE,sum(pr.sal_net) as montant,
        min(codlib)  FROM `personnelles` as p inner join `codeanalytique` as c on p.REL_BANQUE=c.liblong 
        inner join payr as pr on pr.matriculev=p.matriculev where  codtab=51 and statut='vrai' and 
        pr.mois=:mois and pr.annee=:annee and codlib=0 group by p.matriculev,nom_pre,REL_BANQUE,NR_COMPTE 
        order by codlib,pr.matriculev");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('ListesREFBANQ')){
    function ListesREFBANQ($mois,$annee){
        global $db;
        $q=$db->prepare("SELECT distinct(REL_BANQUE) FROM `personnelles` as p inner join `codeanalytique` as c on p.REL_BANQUE=c.liblong 
        inner join payr as pr on pr.matriculev=p.matriculev where  codtab=51 and statut='vrai' and 
        pr.mois=:mois and pr.annee=:annee and codlib>0 group by p.matriculev,nom_pre,REL_BANQUE,NR_COMPTE 
        order by codlib,pr.matriculev");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getCoutTotal')){
    function getCoutTotal($mois,$annee){
        global $db;
        $q=$db->prepare("SELECT liblong,`POSITION`, sum(`BASE_SAL`+`LOGEMENT`+`HEURE_SUP`+`CNSS_ISC`+`IND_DIVERS`-`RET_CONGE`-`RET_ABS`) as montant 
        FROM `payr` as p inner join codeanalytique as ca on p.position=ca.codlib 
        where ca.codtab=22 and mois=:mois and annee=:annee group by position,liblong");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getLogementMoisPresent_Anterieur')){
    function getLogementMoisPresent_Anterieur($mois,$annee,$position,$moisP,$anneeP){
        global $db;
        $q=$db->prepare("select sum(present) as Mois_Present,sum(anterieur) as Mois_Anterieur from 
        (SELECT if(mois=:mois,`LOGEMENT`,0) as present, if(mois=:moisp,LOGEMENT,0) as anterieur FROM `payr` 
        WHERE (mois=:mois or mois=:moisp) and (annee=:annee or annee=:anneep) and position=:position) as MoisP_A ");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee,':position'=>$position,":anneep"=>$anneeP,":moisp"=>$moisP)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getMoisPresent')){
    function getMoisPresent($mois,$annee,$position,$code){
        global $db;
        $q=$db->prepare("Select sum(present) as Mois_Present from (SELECT  if(p.mois=:mois and p.annee=:annee,p.montant,0) as present 
        FROM `payrrubrique` as p inner join personnelles as ps on p.matriculev=ps.matriculev
       where ps.position=:position and ps.statut='VRAI' and p.mois =:mois and p.annee=:annee and p.code=:code) as fr ");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee,':position'=>$position,":code"=>$code)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getHeurSupMoisPresent_Anterieur')){
    function getHeurSupMoisPresent_Anterieur($mois,$annee,$position,$moisP,$anneeP){
        global $db;
        $q=$db->prepare("select sum(present) as Mois_Present,sum(anterieur) as Mois_Anterieur from 
        (SELECT if(mois=:mois,`HEURE_SUP`,0) as present, if(mois=:moisp,HEURE_SUP,0) as anterieur FROM `payr` 
        WHERE (mois=:mois or mois=:moisp) and (annee=:annee or annee=:anneep) and position=:position) as MoisP_A ");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee,':position'=>$position,":anneep"=>$anneeP,":moisp"=>$moisP)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getIndenDiverseMoisPresent_Anterieur')){
    function getIndenDiverseMoisPresent_Anterieur($mois,$annee,$position,$moisP,$anneeP){
        global $db;
        $q=$db->prepare("select sum(present) as Mois_Present,sum(anterieur) as Mois_Anterieur from 
        (SELECT if(mois=:mois,`IND_DIVERS`,0) as present, if(mois=:moisp,IND_DIVERS,0) as anterieur FROM `payr` 
        WHERE (mois=:mois or mois=:moisp) and (annee=:annee or annee=:anneep) and position=:position) as MoisP_A ");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee,':position'=>$position,":anneep"=>$anneeP,":moisp"=>$moisP)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('getRetAbsenceMoisPresent_Anterieur')){
    function getRetAbsenceMoisPresent_Anterieur($mois,$annee,$position,$moisP,$anneeP){
        global $db;
        $q=$db->prepare("select sum(present) as Mois_Present,sum(anterieur) as Mois_Anterieur from 
        (SELECT if(mois=:mois,`RET_ABS`,0) as present, if(mois=:moisp,RET_ABS,0) as anterieur FROM `payr` 
        WHERE (mois=:mois or mois=:moisp) and (annee=:annee or annee=:anneep) and position=:position) as MoisP_A ");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee,':position'=>$position,":anneep"=>$anneeP,":moisp"=>$moisP)); 

        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('InsertPayrByProgram')){
    function InsertPayrByProgram($data,$program){
        global $db;
       
        $data[":PTM"]=$program->PTM;
        $data[":PROGRAM"]=$program->PROGRAM;
        $data[":ACCOUNT"]=$program->ACCOUNT;
        $data[":PERCENT"]=$program->PERCENT;
        $data[":BASE_SAL"]= round($data[":BASE_SAL"]*$program->PERCENT*0.01);
        $data[":LOGEMENT"]= round($data[":LOGEMENT"]*$program->PERCENT*0.01);
        $data[":HEURE_SUP"]= round($data[":HEURE_SUP"]*$program->PERCENT*0.01);
        $data[":IND_DIVERS"]= round($data[":IND_DIVERS"]*$program->PERCENT*0.01);
        $data[":RET_ABS"]= round($data[":RET_ABS"]*$program->PERCENT*0.01);
        $data[":SAL_BRUT"]= round($data[":SAL_BRUT"]*$program->PERCENT*0.01);
        $data[":CNSS_ISC"]= round($data[":CNSS_ISC"]*$program->PERCENT*0.01);
        $data[":CNSS_EMP"]= round($data[":CNSS_EMP"]*$program->PERCENT*0.01);
        $data[":RET_CONGE"]= round($data[":RET_CONGE"]*$program->PERCENT*0.01);
        $data[":RET_DIVERS"]= round($data[":RET_DIVERS"]*$program->PERCENT*0.01);
        $data[":RET_TOTAL"]=$data[":CNSS_EMP"]+$data[":RET_DIVERS"];
		$data[":SAL_NET"]=$data[":SAL_BRUT"]-$data[":RET_TOTAL"];
        $data[":COUT_TOT"]=$data[":SAL_BRUT"]+$data[":CNSS_ISC"];



        $q=$db->prepare("INSERT INTO `payr`(`MATRICULEV`, `NOM_PRE`, `CODEMPLOI`, `DATEMBAUC`, `FONCTION`, 
		`POSITION`, `DATE_SORT`, `BASE_SAL`, `LOGEMENT`, `HEURE_SUP`, `IND_DIVERS`, `RET_ABS`, `SAL_BRUT`, 
		`CNSS_ISC`, `COUT_TOT`, `CNSS_EMP`, `RET_CONGE`, `RET_DIVERS`, `RET_TOTAL`, `SAL_NET`, 
		`PTM`, `PROGRAM`,  `ACCOUNT`, `T4`, `mois`, `annee`, `actif`, `CATEGORIE`, `NUMSECUR`, `Jour_effect`,`PERCENT`) 
		VALUES (:MATRICULEV,:NOM_PRE,:CODEMPLOI,:DATEMBAUC,:FONCTION,:POSITION,:DATE_SORT,:BASE_SAL,:LOGEMENT,
		:HEURE_SUP,:IND_DIVERS,:RET_ABS,:SAL_BRUT,:CNSS_ISC,:COUT_TOT,:CNSS_EMP,:RET_CONGE,:RET_DIVERS,
		:RET_TOTAL,:SAL_NET,:PTM,:PROGRAM,:ACCOUNT,:T4,:mois,:annee,:actif,:CATEGORIE,:NUMSECUR,:Jour_effect,:PERCENT)");
		$q->execute($data);
		$saved=$q->rowCount();
        
        if($saved){
            return 1;
		}else{
			print_r($data);
            return 0;
		} 

        return 0;
    }
}

if(!function_exists('DeleteDataThisMonth')){
    function DeleteDataThisMonth($mois,$annee){
        global $db;
        $q=$db->prepare("DELETE FROM `payr` WHERE mois=:mois and annee=:annee");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee)); 

        $q=$db->prepare("UPDATE `payr` set actif=0 ");     
        $q->execute(); 

        $q=$db->prepare("DELETE FROM `payrrubrique` WHERE mois=:mois and annee=:annee");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee));
        
        $q=$db->prepare("DELETE FROM `cnss` WHERE mois=:mois and annee=:annee");     
        $q->execute(array(":mois"=>$mois,":annee"=>$annee));
 
    }
}

if(!function_exists('ListePayrById')){
    function ListePayrById($id){
        global $db;
        $q=$db->prepare("select ps.NOM, ps.PRENOMS,ps.CATEGORIE,ps.NUMSECUR,ps.NR_COMPTE,ps.REL_BANQUE, p.*,m.libelle as LibMois,cd.LIBLONG as CADRE from payr as p INNER JOIN mois as m ON p.mois=m.id 
        INNER JOIN codeanalytique AS cd ON cd.CODLIB = p.POSITION 
        INNER JOIN personnelles AS ps ON ps.MATRICULEV = p.MATRICULEV where cd.CODTAB =22 and actif=1 and p.id=:id");     
        $q->execute(array(":id"=>$id)); 
        return $q->fetch(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('ListePayrRubriqueByMatricule')){
    function ListePayrRubriqueByMatricule($matricule,$mois,$annee){
        global $db;
        $q=$db->prepare("select p.*,r.LIBELLE,r.TYPE from payrrubrique as p INNER JOIN rubriques as r
         ON r.CODE = p.code where p.MATRICULEV =:matricule and p.mois=:mois and p.annee=:annee");     
        $q->execute(array(":matricule"=>$matricule,
                            ":mois"=>$mois,
                            ":annee"=>$annee)); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

/*
if(!function_exists('LClients')){
    function LClients(){
        global $db;
        $q=$db->prepare("select idclient, nom,prenom, adresse from clients ");     
        $q->execute(); 
       
        return $q->fetchAll(PDO::FETCH_OBJ);   
        
    }
}
*/
if(!function_exists('LChambres')){
    function LChambres(){
        global $db;
        $q=$db->prepare("SELECT idchambre,libeller,numero,prix,EXTENSION_TELEPHONE,description, type FROM chambres order by type");     
        $q->execute(); 
       
        return $q->fetchAll(PDO::FETCH_OBJ);   
        
    }
}

if(!function_exists('GetRubriqueTypes')){
    function GetRubriqueTypes(){
        global $db;
        $q=$db->prepare("SELECT type FROM rubriques group by type");     
        $q->execute(); 
       
        return $q->fetchAll(PDO::FETCH_OBJ);   
        
    }
}

if(!function_exists('GetRubriques')){
    function GetRubriques($type){
        global $db;
        $q=$db->prepare("SELECT * FROM rubriques where type=:type order by CODE ");     
        $q->execute(array(":type"=>$type)); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('GetContratByPersonnel')){
    function GetContratByPersonnel($matricule){
        global $db;
        $q=$db->prepare("SELECT * FROM contrat where nr_matisc=:matricule ");     
        $q->execute(array(":matricule"=>$matricule)); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('ListePersonnelManoeuvres')){
    function ListePersonnelManoeuvres(){
        global $db;
        $q=$db->prepare("SELECT * FROM personnelles_manoeuvres ");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}
if(!function_exists('GetManoeuvreContratById')){
    function GetManoeuvreContratById($id){
        global $db;
        $q=$db->prepare("SELECT * FROM manoeuvres where id=:id ");     
        $q->execute(array(":id"=>$id)); 
        return $q->fetch(PDO::FETCH_OBJ);   
    }
}


if(!function_exists('GetContratById')){
    function GetContratById($id){
        global $db;
        $q=$db->prepare("SELECT * FROM contrat where id=:id ");     
        $q->execute(array(":id"=>$id)); 
        return $q->fetch(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('GetPersonnelInfos')){
    function GetPersonnelInfos($matricule){
        global $db;
        $q=$db->prepare("SELECT MATRICULEV, NOM, PRENOMS, NOMJFILLE, DATENAIS, LIEUNAIS, NATIONAL,
        liblong FROM `personnelles` as p inner join codeanalytique as c on p.NATIONAL=c.CODLIB 
        where c.CODTAB=31 and matriculev=:matricule");     
        $q->execute(array(":matricule"=>$matricule)); 
        return $q->fetch(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('GetCodeAnalytique')){
    function GetCodeAnalytique($codtab,$LimitLeft,$Limitright){
        global $db;
        $q=$db->prepare("SELECT  MIN( id ) AS id, CODTAB, CODLIB, LIBLONG, LIBCOURT, TYPEDON, LENGTH(CODLIB) AS lib 
        FROM codeanalytique where CODTAB=:codtab GROUP BY codtab, codlib, liblong, libcourt, typedon ORDER BY lib, CODLIB
        limit ".$LimitLeft.",".$Limitright);     
        $q->execute(array(":codtab"=>$codtab,)); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}
if(!function_exists('GetCodeAnalytiqueByActive')){
    function GetCodeAnalytiqueByActive($codtab){
        global $db;
        $q=$db->prepare("SELECT  MIN( id ) AS id, CODTAB, CODLIB, LIBLONG, LIBCOURT, TYPEDON, LENGTH(CODLIB) AS lib 
        FROM codeanalytique where CODTAB=:codtab and statut=1 GROUP BY codtab, codlib, liblong, libcourt, typedon ORDER BY lib, CODLIB");     
        $q->execute(array(":codtab"=>$codtab,)); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}
if(!function_exists('GetProgrammes')){
    function GetProgrammes(){
        global $db;
        $q=$db->prepare("select * from programme");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('GetGPCodeByType')){
    function GetGPCodeByType($type){
        global $db;
        $q=$db->prepare("SELECT * FROM `gp_code` where type=:type");     
        $q->execute(array(":type"=>$type)); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('GetGPPlanComptable')){
    function GetGPPlanComptable(){
        global $db;
        $q=$db->prepare("SELECT * FROM `gp_plan_comptable` ");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('GetContratManoeuvresByCode_Sup')){
    function GetContratManoeuvresByCode_Sup($code,$supp){
        global $db;
        $previous_week = strtotime("-1 week +3 day");
        $start_week = strtotime("last thursday midnight",$previous_week);
        $start_week = date("Y-m-d",$start_week);
        $q=$db->prepare("SELECT  m.*,p.NOM,p.DATE_NAISS FROM `manoeuvres` as m inner join 
        personnelles_manoeuvres as p on p.matriculev=m.matriculev where code_anal=:code and code_supp=:supp and timestampdiff(DAY,:DSem,str_to_date(`FIN_CONT`,'%d/%m/%Y'))>=0 ");     
        $q->execute(array(":code"=>$code,":supp"=>$supp,":DSem"=>$start_week)); 
        return $q->fetchAll(PDO::FETCH_OBJ);   

    }
}

if(!function_exists('GetContratManoeuvresByMatricule')){
    function GetContratManoeuvresByMatricule($matricule){
        global $db;
        $q=$db->prepare("SELECT * FROM `manoeuvres`  where matriculev=:matricule");     
        $q->execute(array(":matricule"=>$matricule)); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('GetEdit_Cheques')){
    function GetEdit_Cheques(){
        global $db;
        $q=$db->prepare("SELECT  * FROM bon_reglement limit 0,900");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('GetFournisseurs')){
    function GetFournisseurs(){
        global $db;
        $q=$db->prepare("SELECT  * FROM fournisseurs ");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('GetPointageManoeuvresByCode_Sup')){
    function GetPointageManoeuvresByCode_Sup($debutSem){
        global $db;
        $q=$db->prepare("SELECT m.matriculev as mt,retenue,m.prix_hor,debut_cont,fin_cont,code_anal,code_supp,m.nom,annee_nais,nr_cnss, h.id,norm,supp,feri,hrs_total,cfa_total,codeanal,debutsem,
        codact,finsem,JEU,JEU_SOIR,JEU_FERI,VEN,VEN_SOIR,VEN_FERI,SAM,SAM_SOIR,SAM_FERI,DIM,DIM_SOIR,DIM_FERI,m.compte,m.localite,
        LUN,LUN_SOIR,LUN_FERI,MAR,MAR_SOIR,MAR_FERI,MER,MER_SOIR,MER_FERI FROM `maneouvres_heures` AS h right join 
        (SELECT p.matriculev,debut_cont,fin_cont,code_anal,code_supp,prix_hor,nom,annee_nais,nr_cnss,compte,localite 
        FROM `manoeuvres` as m1 inner join personnelles_manoeuvres as p on m1.matriculev=p.matriculev) as m 
        on h.matriculev=m.matriculev AND DEBUTSEM=:debutSem where timestampdiff(DAY,:debutSem,str_to_date(`FIN_CONT`,'%d/%m/%Y'))>=0 ");    
        //and CODE_ANAL=:code and CODE_SUPP=:supp 
        //h.codact=m.code_supp and h.codeanal=code_anal and 	
       
        $q->execute(array(":debutSem"=>$debutSem)); 
        //":code"=>$code,":supp"=>$supp,
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}



if(!function_exists('GetCodeAnalytiqueActive')){
    function GetCodeAnalytiqueActive($codtab,$LimitLeft,$Limitright){
        global $db;
        $q=$db->prepare("SELECT  MIN( id ) AS id, CODTAB, CODLIB, LIBLONG, LIBCOURT, TYPEDON, LENGTH(CODLIB) AS lib 
        FROM codeanalytique where CODTAB=:codtab and statut=1 GROUP BY codtab, codlib, liblong, libcourt, typedon ORDER BY lib, CODLIB
        limit ".$LimitLeft.",".$Limitright);     
        $q->execute(array(":codtab"=>$codtab,)); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('GetGrille')){
    function GetGrille(){
        global $db;
        $q=$db->prepare("SELECT  * FROM grille ");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('GetPersonnels')){
    function GetPersonnels($Request){
        global $db;
        $q=$db->prepare("SELECT id,MATRICULEV,NOM,PRENOMS,NATIONAL,SITFAMIL,
        DIVISION,LIEUAFFEC,FONCTION,CODEMPLOI,SOUSDIVIS,DATEMBAUC
        FROM personnelles where statut like '%".$Request."%' ORDER BY MATRICULEV DESc ");     
        $q->execute(); //array(":statut"=>$Request)
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}


if(!function_exists('OnePersonnel')){
    function OnePersonnel($id){
        global $db;
        $q=$db->prepare("select * from personnelles WHERE id = :id");     
        $q->execute(array('id'=>$id)); 
        return $q->fetch(PDO::FETCH_OBJ);          
    }
}
/*
if(!function_exists('count_clients')){
    function count_clients(){
        global $db;
        $q=$db->prepare("SELECT * FROM clients ");     
        $q->execute(); 
       
        return $q->rowCount();   
        
    }
}
*/

if(!function_exists('liste_facturations')){
    function liste_facturations($limit_left,$limit_right){
        global $db;
        $q=$db->prepare("select f.*,c.nom,c.prenom,c.adresse from facturations as f 
        inner join clients as c ON c.idclient=f.idclient limit ".$limit_left.",".$limit_right);     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('Lfacturations')){
    function Lfacturations(){
        global $db;
        $q=$db->prepare("select f.*,c.nom,c.prenom,c.adresse from facturations as f 
        inner join clients as c ON c.idclient=f.idclient ");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('count_facturations')){
    function count_facturations(){
        global $db;
        $q=$db->prepare("SELECT * FROM facturations ");     
        $q->execute(); 
        return $q->rowCount();   
    }
}

if(!function_exists('liste_consommations')){
    function liste_consommations($limit_left,$limit_right){
        global $db;
        $q=$db->prepare("select c.idconsommation, c.nombre,c.prix_unitaire,c.idfact,b.idBoison, b.designation from consommations as c INNER JOIN boisons as b ON b.idBoison=c.designation limit ".$limit_left.",".$limit_right);     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('ConsommationsByID')){
    function ConsommationsByID($IDHebergement){
        global $db;
        $a=$db->prepare("select c.idconsommation, c.nombre,c.prix_unitaire,c.idfact,b.idBoison, b.designation 
        from consommations as c INNER JOIN boisons as b ON b.idBoison=c.designation WHERE idfact=:idfact");  
        $a->execute(
            array(
                ":idfact"=>$IDHebergement
            )
        ); 
        return $a->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('LBoisons')){
    function LBoisons(){
        global $db;
        $q=$db->prepare("select * from boisons ");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('count_consommations')){
    function count_consommations(){
        global $db;
        $q=$db->prepare("SELECT * FROM consommations ");     
        $q->execute(); 
        return $q->rowCount();   
    }
}

if(!function_exists('count_codeAnalytique')){
    function count_codeAnalytique($codtab){
        global $db;
        $q=$db->prepare("SELECT codlib FROM codeanalytique  where codtab=:codtab group by codlib");     
        $q->execute(array(":codtab"=>$codtab)); 
        return $q->rowCount();   
    }
}

if(!function_exists('GetPaiElement')){
    function GetPaiElement($matricule,$type){
        global $db;
        $q=$db->prepare("SELECT p.id,p.MATRICULEV,p.CODE,p.VALEUR,p.VALEUR,r.LIBELLE as LIBELLER,r.TYPE as TYPER,p.COMPTE
        ,r.LIBELLE as LIBELLER,r.TYPE as TYPER FROM `pay-elements` as p INNER JOIN rubriques as r on p.CODE=r.CODE WHERE `MATRICULEV`=:MATRICULEV  AND element=:element ");     
        $q->execute(array(":MATRICULEV"=>$matricule,":element"=>$type)); 
        return $q->fetchAll(PDO::FETCH_OBJ);    
    }
}

if(!function_exists('GetPretEcheance')){
    function GetPretEcheance($id){
        global $db;
        $q=$db->prepare("SELECT num_reference,code_type,num_ordre,p.id,p.MATRICULEV,p.CODE,p.MONTANT_T,p.NBRE_ECHEA,p.PERIODE,p.MONTANT_EC,
        p.DATE_APPEL,p.MONTANT_R,p.DATE_AC,p.PAYE,p.CREDIT,pes.NOM,pes.PRENOMS,pes.SAL_BASE,pes.STATUT,
        FONCTION,CODEMPLOI,DIVISION,SOUSDIVIS,CADRE,CATEGORIE,r.LIBELLE FROM prets as p 
         INNER JOIN PERSONNELLES as pes ON p.MATRICULEV=pes.MATRICULEV
         INNER JOIN rubriques as r ON r.CODE=p.CODE WHERE p.id=:id");     
        $q->execute(array(":id"=>$id)); 
        return $q->fetch(PDO::FETCH_OBJ);    
    }
}

if(!function_exists('GetMois')){
    function GetMois(){
        global $db;
        $q=$db->prepare("SELECT * FROM mois");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);    
    }
}
if(!function_exists('GetPersonnelleActif')){
    function GetPersonnelleActif(){
        global $db;
        $q=$db->prepare("SELECT * FROM `personnelles` where statut='VRAI' ORDER BY matriculev ");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);    
    }
}

if(!function_exists('GetElmentByPersonnelle')){
    function GetElmentByPersonnelle($matricule){
        global $db;
        $q=$db->prepare("SELECT p.compte,p.matriculev,p.code,p.valeur,p.element,p.mois,p.annee,r.type,r.libelle 
        FROM `pay-elements` as p inner join rubriques as r on r.code=p.code where matriculev=:matriculev 
        and not p.code =108");     
        $q->execute(array(':matriculev'=>$matricule)); 
        return $q->fetchAll(PDO::FETCH_OBJ);    
    }
}

if(!function_exists('GetPretsByPersonnelle')){
    function GetPretsByPersonnelle($matricule){
        global $db;
        $q=$db->prepare("SELECT * FROM prets where MATRICULEV=:matricule and statut='E' ");     
        $q->execute(array("matricule"=>$matricule)); 
        return $q->fetchAll(PDO::FETCH_OBJ);    
    }
}

if(!function_exists('GetPrets')){
    function GetPrets(){
        global $db;
        $q=$db->prepare("SELECT p.*, ps.NOM,ps.PRENOMS, r.LIBELLE FROM prets as p 
        INNER JOIN personnelles as ps ON p.MATRICULEV=ps.MATRICULEV 
        INNER JOIN rubriques as r ON r.CODE=p.CODE");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);    
    }
}
if(!function_exists('HebergementDate_Min_Max')){
    function HebergementDate_Min_Max(){
        global $db;
        $q=$db->prepare("SELECT MIN(date_arrivee) as min_date, MAX(date_depart) as max_date FROM facturations ");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);
    }
}

if(!function_exists('GetChequeByID')){
    function GetChequeByID($id){
        global $db;
        $q=$db->prepare("SELECT f.name,b.* FROM bon_reglement as b inner join fournisseurs as f on b.CODE_FR=f.code WHERE id=:id ");     
        $q->execute(array(":id"=>$id)); 
        return $q->fetch(PDO::FETCH_OBJ);
    }
}

if(!function_exists('GetVirementPonctuelsByID')){
    function GetVirementPonctuelsByID($id){
        global $db;
        $q=$db->prepare("SELECT * FROM virement_ponctuel  WHERE id=:id ");     
        $q->execute(array(":id"=>$id)); 
        return $q->fetch(PDO::FETCH_OBJ);
    }
}
/*
if(!function_exists('ClientHebergerInDate')){
    function ClientHebergerInDate($dateArrive,$DateDepart){
        global $db;
        $q=$db->prepare("select f.*,c.nom,c.prenom,c.adresse from facturations as f 
        inner join clients as c ON c.idclient=f.idclient where date_arrivee>=:date_arrivee and date_depart<=:date_depart");     
        $q->execute(array(
            "date_arrivee"=>$dateArrive,
            "date_depart"=>$DateDepart
        )); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('GetConsommationByHebergement')){
    function GetConsommationByHebergement($IDHebergement){
        global $db;
        $a=$db->prepare("select c.idconsommation, c.nombre,c.prix_unitaire,c.idfact,b.idBoison, b.designation 
        from consommations as c INNER JOIN boisons as b ON b.idBoison=c.designation WHERE idfact=:idfact");  
        $a->execute(
            array(
                ":idfact"=>$IDHebergement
            )
        ); 
        $consommations=$a->fetchAll(PDO::FETCH_OBJ);
        $res='';
        foreach($consommations as $consomme):
            $res=$res.'
                <tr>
                <th><span class="custom-checkbox">
                <input type="checkbox" id="checkbox1" name="option[]" value="1">
                <label for="checkbox1"></label></th>
                <th>'. $consomme->designation.'</th>
                <th>'.$consomme->nombre .'</th>
                <th>'.$consomme->prix_unitaire.'</th> 
                <th>
                    <a class="edit" data-toggle="modal" onclick=\'openmodal('.json_encode($consomme).','.$consomme->idconsommation.')\'>
                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                    </a>
                    <a class="delete" data-toggle="modal" onclick="openmodaldelete('.$consomme->idconsommation .')">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                </th>
            </tr>'	;
        endforeach;

        return $res;
    }
}
*/

if(!function_exists('GetHtmlRubriques')){
    function GetHtmlRubriques($type){
        global $db;
        $rubrisques=GetRubriques($type);
        $res='';
        foreach($rubrisques as $rubrique):
            $res=$res.'
                <tr>
                <th><span class="custom-checkbox">
                <input type="checkbox" id="checkbox1" name="option[]" value="1">
                <label for="checkbox1"></label></th>
                <th>'. $rubrique->CODE.'</th>
                <th>'.utf8_encode($rubrique->LIBELLE) .'</th>
                <th>'.$rubrique->STATUT.'</th> 
                <th>
                    <a class="edit" data-toggle="modal" onclick=\'openmodal('.json_encode($rubrique).','.$rubrique->CODE.')\'>
                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                    </a>
                    <a class="delete" data-toggle="modal" onclick="openmodaldelete('.$rubrique->CODE .')">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                </th>
            </tr>'	;
        endforeach;
        return $res;
    }
}

if(!function_exists('GetHtmlCodeAnalytique')){
    function GetHtmlCodeAnalytique($codtab,$page){
        global $db;

        $limit_left=($page-1)*140;
        $limit_right=$page*140;

        $codeAnalytiques=GetCodeAnalytique($codtab,$limit_left,$limit_right);
        $res='';
        foreach($codeAnalytiques as $codeAnalyt):
            $res=$res.'
                <tr>
                <th><span class="custom-checkbox">
                <input type="checkbox" id="checkbox1" name="option[]" value="1">
                <label for="checkbox1"></label></th>
                <th>'. $codeAnalyt->CODLIB.'</th>
                <th>'.utf8_encode($codeAnalyt->LIBLONG) .'</th>
                <th>'.$codeAnalyt->LIBCOURT.'</th> 
                <th>'.$codeAnalyt->TYPEDON.'</th> 
                <th>
                    <a class="edit" data-toggle="modal" onclick=\'openmodal('.json_encode($codeAnalyt).',"'.$codeAnalyt->id.'")\'>
                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                    </a>
                    <a class="delete" data-toggle="modal" onclick="openmodaldelete('.$codeAnalyt->id .')">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                </th>
            </tr>'	;
        endforeach;

        return $res;
    }
}

if(!function_exists('GetHtmlPaiElement')){
    function GetHtmlPaiElement($matricule,$type){
        global $db;

        $elements=GetPaiElement($matricule,$type);
        $res='';
        foreach($elements as $element):
            $res=$res.'
                <tr>
                <th><span class="custom-checkbox">
                <input type="checkbox" id="checkbox1" name="option[]" value="1">
                <label for="checkbox1"></label></th>
                <th>'. $element->CODE.'</th>
                <th>'.utf8_encode($element->TYPER) .'</th>
                <th>'.$element->LIBELLER.'</th> 
                <th>'.$element->VALEUR.'</th> 
                <th>'.$element->COMPTE.'</th> 
                <th>
                    <a class="edit" data-toggle="modal" onclick="openmodal('.$element->id.')">
                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                    </a>
                    <a class="delete" data-toggle="modal" onclick="openmodaldelete('.$element->id .')">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                </th>
            </tr>'	;
        endforeach;
        return $res;
    }
}

if(!function_exists('GetHtmlPersonnels')){
    function GetHtmlPersonnels($page){
        global $db;
        $personnels=GetPersonnels("");
        $res='';
        foreach($personnels as $personne):
            $res=$res.'
                <tr>
                <th>'. $personne->MATRICULEV.'</th>
                <th>'.utf8_encode($personne->NOM) .'</th>
                <th>'.$personne->PRENOMS.'</th>  
                <th>'.$personne->CODEMPLOI.'</th> 
                <th>'.$personne->DIVISION.'</th> 
                <th>'.$personne->SOUSDIVIS.'</th> 
                <th>'.$personne->DATEMBAUC.'</th> 
                <th>
                    <a class="edit" href="personnels.php?action=edit&id='.$personne->id.'")\'>
                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                    </a>
                    <a class="delete" data-toggle="modal" onclick="openmodaldelete('.$personne->id .')">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                </th>
            </tr>'	;
        endforeach;
        return $res;
    }
}

if(!function_exists('GetHtmlPrets')){
    function GetHtmlPrets(){
        global $db;
        $prets=GetPrets();
        $res='';
        foreach($prets as $pret):
            $res=$res.'
                <tr>
                <th>'. $pret->MATRICULEV.'</th>
                <th>'.utf8_encode($pret->NOM) .' '. utf8_encode($pret->PRENOMS) .'</th>
                <th>'.$pret->LIBELLE.'</th>  
                <th>'.$pret->MONTANT_T.'</th> 
                <th>'.$pret->NBRE_ECHEA.'</th> 
                <th>'.$pret->DATE_APPEL.'</th> 
                <th>'.$pret->DATEFIN.'</th> 
                <th>'.$pret->CREDIT.'</th> 
                <th>
                    <a class="edit" data-toggle="modal" onclick=\'openmodal('.json_encode($pret).')\'>
                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                    </a>
                    <a   href="print/pret-echeancier.php?id='.$pret->id.'" target="_blank">
                        <i class="material-icons">library_books</i>
                    </a>
                    <a class="delete" data-toggle="modal" onclick="openmodaldelete('.$pret->id .')">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                </th>
            </tr>'	;
        endforeach;
        return $res;
    }
}

if(!function_exists('GetHtmlPayR')){
    function GetHtmlPayR(){
        global $db;
        $payrs=ListePayr();
        $res='';
        foreach($payrs as $payr):
            $res=$res.'
                <tr>
                <th>'. $payr->MATRICULEV.'</th>
                <th>'.utf8_encode($payr->NOM_PRE) .'</th>
                <th>'.$payr->CODEMPLOI.'</th>  
                <th>'.$payr->DATEMBAUC.'</th>  
                <th>'.$payr->FONCTION.'</th> 
                <th>'.$payr->BASE_SAL.'</th> 
                <th>'.$payr->SAL_BRUT.'</th> 
                <th>'.$payr->CNSS_EMP.'</th> 
                <th>'.$payr->SAL_NET.'</th> 
                <th>
                    <a   href="print/bulletin-paie.php?id='.$payr->id.'" target="_blank">
                        <i class="material-icons">library_books</i>
                    </a> 
                </th>
            </tr>'	;
        endforeach;
        return $res;
    }
}
/*
if(!function_exists('PrintDataHebergement')){
    function PrintDataHebergement($IDHebergement){
        global $db;
        $a=$db->prepare("select cl.nom,cl.prenom,cl.adresse,cl.telephone,f.*,ch.numero as numero_chambre, (
            date_depart - date_arrivee) AS nombres_jours
        from facturations as f 
        inner join clients as cl ON cl.idclient=f.idclient
        INNER JOIN Chambres as ch ON ch.idchambre=f.chambre WHERE f.idfact=:idfact");  
        $a->execute(
            array(
                ":idfact"=>$IDHebergement
            )
        ); 
       return $a->fetchAll(PDO::FETCH_OBJ);
    }
}
*/


if(!function_exists('GetHtmlContratByPersonnel')){
    function GetHtmlContratByPersonnel($matricule){
        global $db;
        $contats=GetContratByPersonnel($matricule);
        $res='';
        foreach($contats as $c):
            $res=$res.'
                <tr>
                <th>'. $c->FONCTION.'</th>
                <th>'.utf8_encode($c->DEBUT) .'</th>
                <th>'.$c->FIN.'</th>  
                <th>'.$c->PROGRAMME.'</th>  
                <th>'.$c->RESPPROG.'</th> 
                <th>'.$c->BUDGET.'</th> 
                <th>
                    <a class="edit" onclick="editContrat('.$c->id.')">
                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                    </a>
                    <a class="delete" data-toggle="modal" onclick="openmodaldelete('.$c->id .')">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                </th>
            </tr>'	;
        endforeach;
        return $res;
    }
}

if(!function_exists('GetHtmlContratManoeuvresByCode_Sup')){
    function GetHtmlContratManoeuvresByCode_Sup($code,$supp){
        global $db;
        $contats=GetContratManoeuvresByCode_Sup($code,$supp);
        $res='';
        foreach($contats as $c):
            $res=$res.'
                <tr>
                <th>'. $c->MATRICULEV.'</th>
                <th>'.utf8_encode($c->NOM) .'</th>
                <th>'.$c->DATE_NAISS.'</th>  
                <th>'.$c->DEBUT_CONT.'</th>  
                <th>'.$c->FIN_CONT.'</th> 
                <th>'.$c->LOCALITE.'</th> 
                <th>'.$c->PRIX_HOR.'</th> 
                <th>
                    <a class="edit" onclick="editContrat('.$c->id.')">
                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                    </a>
                    <a class="delete" data-toggle="modal" onclick="openmodaldelete('.$c->id .')">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                </th>
            </tr>'	;
        endforeach;
        
        return $res;
    }
}

if(!function_exists('GetHtmlContratManoeuvresByMatricule')){
    function GetHtmlContratManoeuvresByMatricule($matricule){
        global $db;
        $contats=GetContratManoeuvresByMatricule($matricule);
        $res='';
        foreach($contats as $c):
            $res=$res.'
                <tr>
                <th>'. $c->CODE_ANAL.'</th>
                <th>'.utf8_encode($c->CODE_SUPP) .'</th>
                <th>'.$c->NUME_LET.'</th>  
                <th>'.$c->DEBUT_CONT.'</th>  
                <th>'.$c->FIN_CONT.'</th> 
                <th>'.$c->LOCALITE.'</th> 
                <th>'.$c->PRIX_HOR.'</th> 
            </tr>'	;
        endforeach;
        
        return $res;
    }
}


if(!function_exists('GetHtmlEdit_Cheque')){
    function GetHtmlEdit_Cheque(){
        global $db;
        $contats=GetEdit_Cheques();
        $res='';
        foreach($contats as $c):
            $res=$res.'
                <tr>
                <th>'. utf8_encode($c->DATE_BDR).'</th>
                <th>'.utf8_encode($c->LIBELLES) .'</th>
                <th>'.$c->CODE_FR.'</th>  
                <th>'.$c->MOTIF_BDR.'</th>  
                <th>'.$c->MONTANT_TTC.'</th> 
                <th>'.$c->CHEQUE.'</th> 
                <th>
                    <a class="edit" onclick="editContrat('.$c->ID.')">
                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                    </a>
                    <a class="delete" data-toggle="modal" onclick="openmodaldelete('.$c->ID .')">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                </th>
            </tr>'	;
        endforeach;
        
        return $res;
    }
}
//GetPointageManoeuvresByCode_Sup
if(!function_exists('GetHtmlPointageManoeuvresByCode_Sup')){
    function GetHtmlPointageManoeuvresByCode_Sup($debutSem){
        global $db;
        $contats=GetPointageManoeuvresByCode_Sup($debutSem);
        $res='';
        foreach($contats as $c):
            $res=$res.'
                <tr>
                <th>'. $c->mt.'</th>
                <th>'.utf8_encode($c->nom) .'</th>
                <th>'.utf8_encode($c->fin_cont) .'</th>
                <th class="text-center">'.($c->norm==null?0:$c->norm).'</th>  
                <th class="text-center">'.($c->supp==null?0:$c->supp).'</th>  
                <th class="text-center">'.($c->feri==null?0:$c->feri).'</th> 
                <th class="text-center">'.($c->hrs_total==null?0:$c->hrs_total).'</th> 
                <th class="text-center">'.($c->prix_hor==null?0:$c->prix_hor).'</th> 
                <th class="text-right">'.($c->cfa_total==null?0:$c->cfa_total).'</th> 
                <th class="text-right">
                    '.($c->norm==null?'<a class="edit" onclick="AddManoeuvreHeures('.$c->mt.','.$c->prix_hor.')">
                        <i class="material-icons" data-toggle="tooltip" title="Add">&#xE147;</i>
                    </a>':'
                    <a class="edit" onclick=\'EditManoeuvreHeures('.json_encode($c).')\'>
                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                    </a>').($c->norm==null?'':'
                    
                    <a class="delete" data-toggle="modal" onclick="openmodaldelete('.$c->id .')">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>').'
                </th>
            </tr>'	;
        endforeach;
        
        return $res;
    }
}

//GetPointageManoeuvresByCode_Sup

if(!function_exists('clear_input_data')){
    function clear_input_data(){
        $_SESSION['input']=array();        
    }
}

if(!function_exists('not_empty')){
    function not_empty ($fields=array()){
        if(count($fields)!=0){
            foreach($fields as $field){
                if(empty($_POST[$field]) || trim($_POST[$field])==""){//verification si le champs est vide
                    return false;
                }
            }
            return true;
        }
    }
}

if(!function_exists('ListeUsers')){
    function ListeUsers(){
        global $db;
        $q=$db->prepare("SELECT u.*, p.NOM,p.PRENOMS,r.name FROM `user` as u 
        INNER JOIN PERSONNELLES as p on u.matricule=p.matriculev INNER JOIN roles as r on u.role=r.id");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('GetHtmlUsers')){
    function GetHtmlUsers(){
        global $db;
        $users=ListeUsers();
        $res='';
        foreach($users as $u):
            $res=$res.'
                <tr>
                <th>'.$u->matricule.'</th>
                <th>'. $u->NOM ." ". $u->PRENOMS.'</th>
                <th>'.$u->name .'</th> 
                <th>'.$u->dacreate.'</th>
                <th>
                    <a class="edit" onclick=\'loaddata('.json_encode($u).')\'>
                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                    </a>
                    <a class="delete" data-toggle="modal" onclick="openmodaldelete('.$u->id .')">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                </th>
            </tr>'	;
        endforeach;
        return $res;
    }
}

if(!function_exists('ListeRoles')){
    function ListeRoles(){
        global $db;
        $q=$db->prepare("SELECT * FROM `roles`");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('MenuNavBar')){
    function MenuNavBar(){
        global $db;
        $q=$db->prepare("SELECT * FROM `menu` where position=2 and parent=0");     
        $q->execute(); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('MenuSideBar')){
    function MenuSideBar($myrole){
        global $db;
        $q=$db->prepare("SELECT * FROM `rolesmenus` as rm inner join menu as m on rm.menu=m.id 
        where position=1 and role=:role");     
        $q->execute(array(":role"=>$myrole)); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('MenuSideBarNiveau1')){
    function MenuSideBarNiveau1($myrole,$parent){
        global $db;
        $q=$db->prepare("SELECT * FROM `rolesmenus` as rm inner join menu as m on rm.menu=m.id 
        where position=2 and role=:role and parent=:parent");     
        $q->execute(array(":role"=>$myrole,":parent"=>$parent)); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('MenuSideBarNiveau2')){
    function MenuSideBarNiveau2($myrole,$parent){
        global $db;
        $q=$db->prepare("SELECT * FROM `rolesmenus` as rm inner join menu as m on rm.menu=m.id 
        where position=3 and role=:role and parent=:parent");     
        $q->execute(array(":role"=>$myrole,":parent"=>$parent)); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}

if(!function_exists('MenuSideBarNiveau2')){
    function MenuSideBarNiveau2($myrole,$parent){
        global $db;
        $q=$db->prepare("SELECT * FROM `rolesmenus` as rm inner join menu as m on rm.menu=m.id 
        where position=3 and role=:role and parent=:parent");     
        $q->execute(array(":role"=>$myrole,":parent"=>$parent)); 
        return $q->fetchAll(PDO::FETCH_OBJ);   
    }
}