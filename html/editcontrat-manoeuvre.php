<?php
session_start();
include("../filters/auth_filter.php");
require("../config/db.php");
require("../includes/functions.php");


if(isset($_POST['contratId'])){
    $contrat=GetManoeuvreContratById($_POST['contratId']);
   
}

?> 

<div class="row">
    <div class="col">
        <label>NUME LETT.</label>
        <input type="text" class="form-control" id="NUME_LETT" name="NUME_LETT" 
        value="<?php echo $contrat->NUME_LETT ?>" required/>
    </div>
    <div class="col">
        <label>DATE LETT.</label>
        <input type="date" class="form-control" id="DATE_LETT" name="DATE_LETT" onchange="addDebutContrat(this)" 
        value="<?php  $d=explode("/",$contrat->DATE_LETT); echo "$d[2]-$d[1]-$d[0]";?>">
    </div> 

    <!--div class="col">
        <label>CARTE ISC</label>
        <input type="number" class="form-control" id="CARTE_ISC" name="CARTE_ISC"
        value="<?php echo $contrat->CARTE_ISC;?>" required>
    </div-->  

    <div class="col">
        <label>MATRICULE</label>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="MATRICULE" value="<?php echo $contrat->MATRICULEV ?>" list="list-matricule" id="matricule-datalist">
            <datalist id="list-matricule">
                <?php foreach(ListePersonnelManoeuvres() as $p):?>
                <option value="<?php echo $p->MATRICULEV?>"  >
                <?php echo $p->MATRICULEV." ".$p->NOM."-".$p->CARTE_NAT?></option>
                <?php endforeach;?>
            </datalist>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', e => {
                $('#matricule-datalist').autocomplete()
            }, false);
        </script>
    </div>
    
</div>

<div class="row">

    <input type="hidden" id="idcontrat" name="idcontrat" value="<?php echo $contrat->id ?>" class="form-control">
    <div class="col">
        <label>DEBUT CONT. </label>
        <input type="date" class="form-control" id="DEBUT_CONT" name="DEBUT_CONT" 
        value="<?php $d=explode("/",$contrat->DEBUT_CONT); echo "$d[2]-$d[1]-$d[0]"; ?>" required/>
    </div>
    <div class="col">
        <label>FIN CONT.</label>
        <input type="date" class="form-control" id="FIN_CONT" name="FIN_CONT"
        value="<?php $d=explode("/",$contrat->FIN_CONT); echo "$d[2]-$d[1]-$d[0]";?>">
    </div> 
        
    <div class="col">
        <label>LOCALITE</label>
        <select id="LIEUAFFEC" class="form-control" name="LOCALITE">
            <?php foreach(GetCodeAnalytique(53,0,50) as $national): ?>
                <option value="<?php echo $national->LIBLONG ?>"
                <?php echo $national->LIBLONG==$contrat->LOCALITE? "selected":"" ?>><?php echo utf8_encode($national->LIBLONG) 	?></option>
            <?php endforeach; ?>
        </select>
    </div> 
</div>


<div class="row">

    <br/>
    <input id="Add_contrat" name="sauve_contrat"  class="btn btn-success  btn-lg btn-block mt-4"
    value="<?php echo $_POST['action']=='edit'?'Modifier':'Enregistrer'?>" onclick="sauveContrat()"  />
    <br/>
</div>