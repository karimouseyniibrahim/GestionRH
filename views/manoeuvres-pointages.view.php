		   <!------main-content-start-----------> 
		     
           <div class="main-content">
			     <div class="row">
				    <div class="col-md-12">
					   <div class="table-wrapper">
					     
					   <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">Gestion <?php echo $title?></h2>
							 </div>
                        </div>
					     <div class="row">
						    
							 <div class="col-sm-12 p-0 flex justify-content-lg-end justify-content-center">
                               
                               <a  class="btn btn-success"  href="print/bielletage-manoeuvre.php" target="_blank">
							        <span>Bielletage</span>
							   </a>

                               <a  class="btn btn-success"  href="print/salaire-hebdomadaire.php" target="_blank">
							        <span>Sal. Hebdomadaire</span>
							   </a>

                               <a  class="btn btn-success" href="print/cnss-manoeuvres.php" target="_blank">
							        <span>CNSS. Hebdomadaire</span>
							   </a>

                               <a  class="btn btn-success" href="print/billetin-manoeuvres.php" target="_blank">
							        <span>Billetin. Paie</span>
							   </a>

                               <a  class="btn btn-success" onclick="openpaiement()" target="_blank">
							        <span>Paie Sal. Hebdo.</span>
							   </a>

                               <!--a  class="btn btn-success" onclick="validatedata()" target="_blank">
							        <span>Valider Sal.</span>
							   </a-->

							 </div>
					     </div>
                         <div class="col">
                                
                         </div>

                         <div class="row">
                            <div class="col-md-10">
                        <div class="row mt-4">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Code Analytique" list="list-CodeAnalytique" id="CodeAnalytique-datalist">
                                        <datalist id="list-CodeAnalytique">
                                            <?php foreach(GetCodeAnalytiqueByActive(20) as $code):?>
                                            <option value="<?php echo $code->CODLIB?>"><?php echo $code->CODLIB." ".$code->LIBLONG?></option>
                                            <?php endforeach;?>
                                        </datalist>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', e => {
                                            $('#CodeAnalytique-datalist').autocomplete()
                                        }, false);
                                    </script>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Chercheur" list="list-Chercheur" id="Chercheur-datalist" >
                                        
                                        <datalist id="list-Chercheur">
                                            <?php foreach(GetCodeAnalytiqueByActive(21) as $code):?>
                                            <option value="<?php echo $code->CODLIB?>"><?php echo $code->CODLIB." ".$code->LIBLONG?></option>
                                            <?php endforeach;?>
                                        </datalist>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', e => {
                                            $('#Chercheur-datalist').autocomplete()
                                        }, false);
                                    </script>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Depense Budget" list="list-Compte" id="depense-datalist" >
                                        
                                        <datalist id="list-depense">
                                            <?php foreach(GetCodeAnalytiqueByActive(50) as $code):?>
                                            <option value="<?php echo $code->CODLIB?>"><?php echo $code->CODLIB." ".$code->LIBLONG?></option>
                                            <?php endforeach;?>
                                        </datalist>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', e => {
                                            $('#Chercheur-datalist').autocomplete()
                                        }, false);
                                    </script>
                                </div>
                                <div col="col">
                                        <!--a onclick="loadmanoeuvrepointage()" class="btn btn-primary">
                                            <i class="material-icons">search</i>Charger
                                        </a-->
                                </div>
                                                         
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="date" class="form-control" placeholder="DEBUT SEMAINE" onchange="addDateFinSemain(this)" id="DEBUTSEM">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="date" class="form-control" placeholder="FIN SEMAINE" id="FINSEM">
                                    </div>
                                </div>                        
                            </div>
                                    </div>
                            <div class="d-grid gap-2 col-2 mx-auto">
                                        <a onclick="loadmanoeuvrepointage()" class="btn btn-primary btn-lg btn-block mt-4">
                                            <i class="material-icons">search</i>Charger
                                        </a>
                                    </div>
                                    </div>
					   </div>
					    <div id="block">
                           <?php 
                           if(isset($_GET['editcontrat-manoeuvre'])){
                                include("html/editcontrat-manoeuvre-manoeuvre.php");
                           }else{
                                include("html/viewmanoeuvre-pointages.php");
                           }
                           ?>         
                        </div>
					   </div>
					</div>  
                    <!----delete-modal start--------->
                        <div class="modal fade" tabindex="-1" id="DeleteElementContratModal" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Supprimer <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="idmanoeuvreheures" name="idmanoeuvreheures" class="form-control">
                                    <p>Êtes-vous sûr de vouloir supprimer cet enregistrement ?</p>
                                    <p class="text-warning"><small>cette action ne peut pas être annulée,</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="Deletesauve_manoeuvre_heures" onclick="DeleteHeuresManoeuvre()" class="btn btn-success" name="sauve_manoeuvre_heures" value="Supprimer">
                                </div>
                                </div>
                            </div>
                        </div>
                    <!----edit-modal end--------->  


                    <div class="modal" tabindex="-1" id="EditManoeuvresHeures" role="dialog">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit <?php echo $title?> (<input type="text" class="col-3 text-center btn btn-outline-info" value="552222" id="MATRICULEV" disabled>)</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <input type="hidden" class="form-control" id="idmanoeuvreheures" name="id">
                                <input type="hidden" class="form-control" id="addMATRICULEV" name="MATRICULEV" required>
                                <input type="hidden" class="form-control" id="prix_hor" name="prix_hor" required>
                                <input type="hidden" class="form-control" id="localite">
                                <input type="hidden" class="form-control" id="compte" >
                                
                                <div class="input-group">
                                    <span class="input-group-text">HEURE</span>
                                    <input type="text" class="form-control" placeholder="JEUDI" disabled>
                                    <input type="text" class="form-control" placeholder="VENDREDI" disabled>
                                    <input type="text" class="form-control" placeholder="SAMEDI" disabled>
                                    <input type="text" class="form-control" placeholder="DIMANCHE" disabled>
                                    <input type="text" class="form-control" placeholder="LUNDI" disabled>
                                    <input type="text" class="form-control" placeholder="MARDI" disabled>
                                    <input type="text" class="form-control" placeholder="MERCREDI" disabled>
                                    <input type="text" class="form-control" placeholder="TOTAL" disabled> 
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">NORM</span>
                                    <input type="number" class="form-control text-center" id="JEU" value="0" onchange="calculTotalH()" required/>
                                    <input type="number" class="form-control text-center" id="VEN" value="0" onchange="calculTotalH()" required/>
                                    <input type="number" class="form-control text-center btn-warning" id="SAM" value="0" onchange="calculTotalH()" required/>
                                    <input type="number" class="form-control text-center btn-warning" id="DIM" value="0" onchange="calculTotalH()" required/>
                                    <input type="number" class="form-control text-center" id="LUN" value="0" onchange="calculTotalH()" required/>
                                    <input type="number" class="form-control text-center" id="MAR" value="0" onchange="calculTotalH()" required/>
                                    <input type="number" class="form-control text-center" id="MER" value="0" onchange="calculTotalH()" required/>
                                    <input type="number" class="form-control text-center btn-success" id="TOTALNORM" value="0" disabled>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">SUPPL</span>
                                    <input type="number" class="form-control text-center" id="JEU_SOIR" value="0" onchange="calculTotalSUPPH()" required/>
                                    <input type="number" class="form-control text-center" id="VEN_SOIR" value="0" onchange="calculTotalSUPPH()" required/>
                                    <input type="number" class="form-control text-center btn-warning" id="SAM_SOIR" value="0" onchange="calculTotalSUPPH()" required/>
                                    <input type="number" class="form-control text-center btn-warning" id="DIM_SOIR" value="0" onchange="calculTotalSUPPH()" required/>
                                    <input type="number" class="form-control text-center" id="LUN_SOIR" value="0" onchange="calculTotalSUPPH()" required/>
                                    <input type="number" class="form-control text-center" id="MAR_SOIR" value="0" onchange="calculTotalSUPPH()" required/>
                                    <input type="number" class="form-control text-center" id="MER_SOIR" value="0" onchange="calculTotalSUPPH()" required/>
                                    <input type="number" class="form-control text-center btn-success" id="TOTAL_SOIR" value="0" disabled>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">FERIEE</span>
                                    <input type="number" class="form-control text-center" id="JEU_FERI" value="0" onchange="calculTotalFeriH()" required/>
                                    <input type="number" class="form-control text-center" id="VEN_FERI" value="0" onchange="calculTotalFeriH()" required/>
                                    <input type="number" class="form-control text-center btn-warning" id="SAM_FERI" value="0" onchange="calculTotalFeriH()" required/>
                                    <input type="number" class="form-control text-center btn-warning" id="DIM_FERI" value="0" onchange="calculTotalFeriH()" required/>
                                    <input type="number" class="form-control text-center" id="LUN_FERI" value="0" onchange="calculTotalFeriH()" required/>
                                    <input type="number" class="form-control text-center" id="MAR_FERI" value="0" onchange="calculTotalFeriH()" required/>
                                    <input type="number" class="form-control text-center" id="MER_FERI" value="0" onchange="calculTotalFeriH()" required/>
                                    <input type="number" class="form-control text-center btn-success" id="TOTAL_FERI" value="0" disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">TOTAL</span>
                                    <input type="number" class="form-control text-center btn-primary" id="JEU_T" value="0" disabled/>
                                    <input type="number" class="form-control text-center btn-primary" id="VEN_T" value="0" disabled>
                                    <input type="number" class="form-control text-center btn-primary" id="SAM_T" value="0" disabled>
                                    <input type="number" class="form-control text-center btn-primary" id="DIM_T" value="0" disabled>
                                    <input type="number" class="form-control text-center btn-primary" id="LUN_T" value="0" disabled>
                                    <input type="number" class="form-control text-center btn-primary" id="MAR_T" value="0" disabled>
                                    <input type="number" class="form-control text-center btn-primary" id="MER_T" value="0" disabled>
                                    <input type="number" class="form-control text-center btn-success" id="TOTAL_T" value="0" disabled>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">RETENUE</span>
                                    <input type="number" class="form-control text-center btn-danger" id="RETENUE" value="0"/>
                                </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="Editsauve_manoeuvre_heures" onclick="sauveManoeuvreHeures()" name="sauve_manoeuvre_heures"  class="btn btn-success" value="Enregistrer">
                                </div>
                                </div>
                            </div>
                        </div>


			     </div>
			  </div>
		    <!------main-content-end-----------> 
 

<script type="text/javascript">

function calculTotalH(){

     JEU=document.getElementById("JEU").value;
     VEN=document.getElementById("VEN").value;
     SAM=document.getElementById("SAM").value;
     DIM=document.getElementById("DIM").value;
     LUN=document.getElementById("LUN").value;
     MAR=document.getElementById("MAR").value;
     MER=document.getElementById("MER").value;
     TN=parseInt(parseInt(JEU)+parseInt(VEN)+parseInt(SAM)+parseInt(DIM)+parseInt(LUN)+parseInt(MAR)+parseInt(MER));
    $("#TOTALNORM").val(TN);

    var JEU_SOIR=document.getElementById("JEU_SOIR").value;
    var VEN_SOIR=document.getElementById("VEN_SOIR").value;
    var SAM_SOIR=document.getElementById("SAM_SOIR").value;
    var DIM_SOIR=document.getElementById("DIM_SOIR").value;
    var LUN_SOIR=document.getElementById("LUN_SOIR").value;
    var MAR_SOIR=document.getElementById("MAR_SOIR").value;
    var MER_SOIR=document.getElementById("MER_SOIR").value;
    var TS=parseInt(parseInt(JEU_SOIR)+parseInt(VEN_SOIR)+parseInt(SAM_SOIR)+parseInt(DIM_SOIR)+parseInt(LUN_SOIR)+parseInt(MAR_SOIR)+parseInt(MER_SOIR));
    $("#TOTAL_SOIR").val(TS);

    var JEU_FERI=document.getElementById("JEU_FERI").value;
    var VEN_FERI=document.getElementById("VEN_FERI").value;
    var SAM_FERI=document.getElementById("SAM_FERI").value;
    var DIM_FERI=document.getElementById("DIM_FERI").value;
    var LUN_FERI=document.getElementById("LUN_FERI").value;
    var MAR_FERI=document.getElementById("MAR_FERI").value;
    var MER_FERI=document.getElementById("MER_FERI").value;
    var TF=parseInt(parseInt(JEU_FERI)+parseInt(VEN_FERI)+parseInt(SAM_FERI)+parseInt(DIM_FERI)+parseInt(LUN_FERI)+parseInt(MAR_FERI)+parseInt(MER_FERI));
    $("#TOTAL_FERI").val(TF);

    var JEU_T=parseInt(parseInt(JEU)+parseInt(JEU_SOIR)+parseInt(JEU_FERI));
    var VEN_T=parseInt(parseInt(VEN)+parseInt(VEN_SOIR)+parseInt(VEN_FERI));
    var SAM_T=parseInt(parseInt(SAM)+parseInt(SAM_SOIR)+parseInt(SAM_FERI));
    var DIM_T=parseInt(parseInt(DIM)+parseInt(DIM_SOIR)+parseInt(DIM_FERI));
    var LUN_T=parseInt(parseInt(LUN)+parseInt(LUN_SOIR)+parseInt(LUN_FERI));
    var MAR_T=parseInt(parseInt(MAR)+parseInt(MAR_SOIR)+parseInt(MAR_FERI));
    var MER_T=parseInt(parseInt(MER)+parseInt(MER_SOIR)+parseInt(MER_FERI));
    $("#JEU_T").val(JEU_T);
    $("#VEN_T").val(VEN_T);
    $("#SAM_T").val(SAM_T);
    $("#DIM_T").val(DIM_T);
    $("#LUN_T").val(LUN_T);
    $("#MAR_T").val(MAR_T);
    $("#MER_T").val(MER_T);
    $("#TOTAL_T").val(TN+TS+TF);

}
function calculTotalFeriH(){
    calculTotalH();
}

function calculTotalSUPPH(){
    calculTotalH();
}

function AddManoeuvreHeures(matricule,prix_hor) {         
        $(".modal-body #addMATRICULEV").val(matricule);
        $(".modal-body #prix_hor").val(prix_hor);
        $("#MATRICULEV").val(matricule);     
        $("#Editsauve_manoeuvre_heures").val("Enregistrer");
        $("#JEU").val(0);
        $("#VEN").val(0);
        $("#SAM").val(0);
        $("#DIM").val(0);
        $("#LUN").val(0);
        $("#MAR").val(0);
        $("#MER").val(0);
        $("#JEU_SOIR").val(0);
        $("#VEN_SOIR").val(0);
        $("#SAM_SOIR").val(0);
        $("#DIM_SOIR").val(0);
        $("#LUN_SOIR").val(0);
        $("#MAR_SOIR").val(0);
        $("#MER_SOIR").val(0);
        $("#JEU_FERI").val(0);
        $("#VEN_FERI").val(0);
        $("#SAM_FERI").val(0);
        $("#DIM_FERI").val(0);
        $("#LUN_FERI").val(0);
        $("#MAR_FERI").val(0);
        $("#MER_FERI").val(0);
        $("#RETENUE").val(0);
        calculTotalH();
        $('#EditManoeuvresHeures').modal('show');        
    }
function EditManoeuvreHeures(d){
 
    $("#Editsauve_manoeuvre_heures").val("Modifier");
    $("#idmanoeuvreheures").val(d.id);
    $("#JEU").val(d.JEU);
    $("#VEN").val(d.VEN);
    $("#SAM").val(d.SAM);
    $("#DIM").val(d.DIM);
    $("#LUN").val(d.LUN);
    $("#MAR").val(d.MAR);
    $("#MER").val(d.MER);
    $("#JEU_SOIR").val(d.JEU_SOIR);
    $("#VEN_SOIR").val(d.VEN_SOIR);
    $("#SAM_SOIR").val(d.SAM_SOIR);
    $("#DIM_SOIR").val(d.DIM_SOIR);
    $("#LUN_SOIR").val(d.LUN_SOIR);
    $("#MAR_SOIR").val(d.MAR_SOIR);
    $("#MER_SOIR").val(d.MER_SOIR);
    $("#JEU_FERI").val(d.JEU_FERI);
    $("#VEN_FERI").val(d.VEN_FERI);
    $("#SAM_FERI").val(d.SAM_FERI);
    $("#DIM_FERI").val(d.DIM_FERI);
    $("#LUN_FERI").val(d.LUN_FERI);
    $("#MAR_FERI").val(d.MAR_FERI);
    $("#MER_FERI").val(d.MER_FERI);
    $("#RETENUE").val(d.retenue);
    $("#localite").val(d.localite);
    $("#compte").val(d.compte);
    calculTotalH();
    $(".modal-body #addMATRICULEV").val(d.mt);
    $(".modal-body #prix_hor").val(d.prix_hor);
    $("#MATRICULEV").val(d.mt);     
    $('#EditManoeuvresHeures').modal('show');    
}

function addDateFinSemain(debut){
    var dt=new Date(debut.value);
    dt.setDate(dt.getDate()+6);
    var options = { year: 'numeric', month: 'numeric', day: 'numeric' };
    $('#FINSEM').val(dt.toLocaleDateString("fr-CA", options));
}
    function openmodal() { 
         // window.open("contrat.php?editcontrat-manoeuvre="+document.getElementById("input-datalist").value,"_self").focus(); 
         $.ajax({
            type : "POST",  //type of method
            url  : "html/editcontrat-manoeuvre.php",  //your page
            data : { Request : "AddContrat"},// passing the values
            success: function(res){  
            $('#block').empty(); 
            $('#block').append(res);

            }
        }); 
    }
     
    function editContrat(id) { 
         // window.open("contrat.php?editcontrat-manoeuvre="+document.getElementById("input-datalist").value,"_self").focus(); 
         var contratId=id;
         $.ajax({
            type : "POST",  //type of method
            url  : "html/editcontrat-manoeuvre.php",  //your page
            data : { Request : "AddContrat",contratId:contratId,action:'edit'},// passing the values
            success: function(res){  
            $('#block').empty(); 
            $('#block').append(res);

            }
        }); 
    }

    function sauveManoeuvreHeures(){
        var MATRICULEV=document.getElementById("addMATRICULEV").value;
        var id=document.getElementById("idmanoeuvreheures").value;
        var JEU=document.getElementById("JEU").value;
        var VEN=document.getElementById("VEN").value;
        var SAM=document.getElementById("SAM").value;
        var DIM=document.getElementById("DIM").value;
        var LUN=document.getElementById("LUN").value;
        var MAR=document.getElementById("MAR").value;
        var MER=document.getElementById("MER").value;
        var JEU_SOIR=document.getElementById("JEU_SOIR").value;
        var VEN_SOIR=document.getElementById("VEN_SOIR").value;
        var SAM_SOIR=document.getElementById("SAM_SOIR").value;
        var DIM_SOIR=document.getElementById("DIM_SOIR").value;
        var LUN_SOIR=document.getElementById("LUN_SOIR").value;
        var MAR_SOIR=document.getElementById("MAR_SOIR").value;
        var MER_SOIR=document.getElementById("MER_SOIR").value;
        var JEU_FERI=document.getElementById("JEU_FERI").value;
        var VEN_FERI=document.getElementById("VEN_FERI").value;
        var SAM_FERI=document.getElementById("SAM_FERI").value;
        var DIM_FERI=document.getElementById("DIM_FERI").value;
        var LUN_FERI=document.getElementById("LUN_FERI").value;
        var MAR_FERI=document.getElementById("MAR_FERI").value;
        var MER_FERI=document.getElementById("MER_FERI").value;
        var TOTAL_T=document.getElementById("TOTAL_T").value;
        var FERI=document.getElementById("TOTAL_FERI").value;
        var SUPP=document.getElementById("TOTAL_SOIR").value;
        var NORM=document.getElementById("TOTALNORM").value;
        var CODE_SUPP=document.getElementById("Chercheur-datalist").value;
        var CODE_ANAL=document.getElementById("CodeAnalytique-datalist").value;
        var DEBUTSEM=document.getElementById("DEBUTSEM").value;
        var FINSEM=document.getElementById("FINSEM").value;
        var prix_hor=document.getElementById("prix_hor").value;
        var RETENUE=document.getElementById("RETENUE").value;
        var COMPTE=document.getElementById("compte").value;
        var DEPENSE=document.getElementById("depense-datalist").value;
        var LOCALITE=document.getElementById("localite").value;
        var sauve_manoeuvre_heures=document.getElementById("Editsauve_manoeuvre_heures").value; 
        $.ajax({
            type : "POST",  //type of method
            url  : "manoeuvres-pointages.php",  //your page
            data : {COMPTE:COMPTE,DEPENSE:DEPENSE,LOCALITE:LOCALITE,RETENUE:RETENUE,id:id, MATRICULEV : MATRICULEV,JEU:JEU, VEN : VEN,SAM:SAM,DIM:DIM,LUN:LUN,MAR:MAR,MER:MER,
                JEU_SOIR:JEU_SOIR,VEN_SOIR:VEN_SOIR,SAM_SOIR:SAM_SOIR,DIM_SOIR:DIM_SOIR,LUN_SOIR:LUN_SOIR,MAR_SOIR:MAR_SOIR,MER_SOIR:MER_SOIR,
                JEU_FERI:JEU_FERI,VEN_FERI:VEN_FERI,SAM_FERI:SAM_FERI,DIM_FERI:DIM_FERI,LUN_FERI:LUN_FERI,MAR_FERI:MAR_FERI,MER_FERI:MER_FERI,
                TOTAL_T:TOTAL_T,FERI:FERI,SUPP:SUPP,NORM:NORM,CODE_SUPP:CODE_SUPP,CODE_ANAL:CODE_ANAL,DEBUTSEM:DEBUTSEM,FINSEM:FINSEM,
                sauve_manoeuvre_heures:sauve_manoeuvre_heures,prix_hor:prix_hor},// passing the values
            success: function(res){  
            //do what you want here..
            $('#TablePointage').DataTable().destroy();
            $('#block').empty(); 
            $('#block').append(res);
            //$('#TablePointage').DataTable();
            $('#EditManoeuvresHeures').modal('hide'); 
            $("#TablePointage").dataTable().ajax.reload();
               
            
            }
        }); 

    }
    
    function openmodaldelete(id) {         
        $(".modal-body #idmanoeuvreheures").val(id);     
        $('#DeleteElementContratModal').modal('show');        
    }
    
    function loadmanoeuvrepointage(){
        //var CODE_SUPP=document.getElementById("Chercheur-datalist").value;
       // var CODE_ANAL=document.getElementById("CodeAnalytique-datalist").value;
        var DEBUTSEM=document.getElementById("DEBUTSEM").value;
        //DEBUTSEM
        $.ajax({
            type : "POST",  //type of method
            url  : "manoeuvres-pointages.php",  //your page
            data : { DEBUTSEM:DEBUTSEM, Request : "infosPointage"},// passing the values
            success: function(res){  

           // alert(res);
           
           $('#block').empty(); 
            $('#block').append(res);
            $('#TablePointage').DataTable();
            $("#TablePointage").dataTable().ajax.reload();
            }
        }); 
     }
  
     function DeleteHeuresManoeuvre(){

        var CODE_SUPP=document.getElementById("Chercheur-datalist").value;
        var CODE_ANAL=document.getElementById("CodeAnalytique-datalist").value;
        var DEBUTSEM=document.getElementById("DEBUTSEM").value;
        var FINSEM=document.getElementById("FINSEM").value;
        
        var id=document.getElementById("idmanoeuvreheures").value; 
        var sauve_manoeuvre_heures=document.getElementById("Deletesauve_manoeuvre_heures").value; 
        $.ajax({
            type : "POST",  //type of method
            url  : "manoeuvres-pointages.php",  //your page
            data : { DEBUTSEM:DEBUTSEM,FINSEM:FINSEM,sauve_manoeuvre_heures : sauve_manoeuvre_heures,id:id,CODE_SUPP:CODE_SUPP,CODE_ANAL:CODE_ANAL},// passing the values
            success: function(res){  
            //do what you want here...
            $('#TablePointage').DataTable().destroy();
            $('#block').empty(); 
            $('#block').append(res);
           // alert(res);
            $('#DeleteElementContratModal').modal('hide');

            $("#TablePointage").dataTable().ajax.reload();
            }
        }); 
     }

     function openpaiement(){
        var DEBUTSEM=document.getElementById("DEBUTSEM").value;
        var FINSEM=document.getElementById("FINSEM").value;
        window.open("print/manoeuvres-paie-synthese.php?SEM1="+DEBUTSEM+"&SEM2="+FINSEM);
     }

     function validatedata(){
        var FINSEM=document.getElementById("FINSEM").value;

        $.ajax({
            type : "POST",  //type of method
            url  : "manoeuvres-pointages.php",  //your page
            data : { FINSEM : FINSEM, Request : "valider"},// passing the values
            success: function(res){  
                alert("salut");
            }
        }); 
     }
</script>
