		   <!------main-content-start-----------> 
		     
           <div class="main-content">
			     <div class="row">
				    <div class="col-md-12">
					   <div class="table-wrapper">
					     
					   <div class="table-title">
					     <div class="row">
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">Gestion <?php echo $title?></h2>
							 </div>
							 <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							   <a  class="btn btn-success" data-toggle="modal" onclick="openmodalAdd()">
							   <i class="material-icons">&#xE147;</i>
							   <span>Add <?php echo $title?></span>
							   </a>
							   <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal">
							   <i class="material-icons">&#xE15C;</i>
							   <span>Delete</span>
							   </a>
							 </div>
					     </div>
                         
              
					   </div>
					   
					   <table class="table table-striped table-hover" id="TablePrets">
					      <thead>
						     <tr>
							 <th>MATRICULEV</th>
                             <th>NOM & PRENOM</th>
							 <th>LIBELLE</th>
							 <th>MONTANT</th>
                             <th>NBRE_ECHEA</th>
                             <th>DATE_APPEL</th>
                             <th>DATEFIN</th>
                             <th>CREDIT</th>
                             <th>Actions</th>
							 </tr>
						  </thead>
						  <tbody>
                                <?php echo GetHtmlPrets(); ?>						 
						  </tbody>

					   </table>
					   </div>
					</div>
					   <!----edit-modal end--------->
				   <!----edit-modal start--------->
                        <div class="modal" tabindex="-1" id="editPretModal" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                    
                                    <input type="hidden" id="AddId" name="Id" class="form-control">
                                    <div class="row">
                                        <div class="col">
                                            <label>N° Reference</label>
                                            <input type="text" class="form-control" id="AddNum_Reference" name="Num_Reference" required></input>
                                        </div>
                                    
                                        <div class="col">
                                            <label>Type code</label>
                                            <input type="text" class="form-control" id="AddType_code" name="Type_code" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!--div class="col">
                                            <label>Nombre Echance</label>
                                            <input type="number" class="form-control" id="AddNBRE_ECHEA" name="NBRE_ECHEA"  
                                            onchange="CalculMontantEcheance(this)" required></input>
                                        </div-->
                                        <!--div class="col">
                                            <label>Montant Echance</label>
                                            <input type="number" class="form-control" id="AddMONTANT_EC" name="MONTANT_EC" required></input>
                                        </div-->
                                        
                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <label for="input-datalist">Matricule</label>
                                            <input type="text" class="form-control" placeholder="Matricule" list="list-timezone" id="AddMatricule">
                                            <datalist id="list-timezone">
                                                <?php foreach(GetPersonnels("VRAI") as $personnel):?>
                                                <option value="<?php echo $personnel->MATRICULEV?>"><?php echo $personnel->NOM." ".$personnel->PRENOMS?></option>
                                                <?php endforeach;?>
                                            </datalist>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', e => {
                                                $('#AddMatricule').autocomplete()
                                            }, false);
                                        </script>
                                        <div class="col">
                                            <label>Rubrique</label>
                                            <input type="text" class="form-control" placeholder="Rubrique" list="list-rubrique" id="AddCODE">
                                            <datalist id="list-rubrique">
                                                <?php foreach(GetRubriques("G") as $rubrique): ?>
                                                    <option value="<?php echo $rubrique->CODE ?>">
                                                    <?php echo utf8_encode($rubrique->LIBELLE)." (Gain)"?></option>
                                                <?php endforeach; ?>  
                                                <?php foreach(GetRubriques("R") as $rubrique): ?>
                                                    <option value="<?php echo $rubrique->CODE ?>">
                                                    <?php echo utf8_encode($rubrique->LIBELLE)." (Retenu)" 	?></option>
                                                <?php endforeach; ?>                                    
                                            </datalist>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', e => {
                                                    $('#AddCODE').autocomplete()
                                                }, false);
                                            </script>  
                                        </div>  
                                    </div> 
                                    
                                    <div class="row">
                                        <div class="col">
                                            <label>Date d'Accord</label>
                                            <input type="date" class="form-control" id="AddDATE_AC" name="DATE_AC" required></input>
                                        </div>
                                    
                                        <div class="col">
                                            <label>Montant Accordé</label>
                                            <input type="number" class="form-control" id="AddMONTANT_R" name="MONTANT_R" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Nombre Echance</label>
                                            <input type="number" class="form-control" id="AddNBRE_ECHEA" name="NBRE_ECHEA"  
                                            onchange="CalculMontantEcheance(this)" required></input>
                                        </div>
                                        <div class="col">
                                            <label>Montant Echance</label>
                                            <input type="number" class="form-control" id="AddMONTANT_EC" name="MONTANT_EC" required></input>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Periodicité</label>
                                            <input type="number" class="form-control" id="AddPERIODE" name="PERIODE" required></input>
                                        </div>

                                        <div class="col">
                                            <label>Date Premier Appel</label>
                                            <input type="date" class="form-control" id="AddDATE_APPEL" name="DATE_APPEL" 
                                            onchange="CalculDatefin(this)" required></input>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Mois de Paye</label>
                                            <select id="AddPAYE" class="form-control" name="PAYE" >
                                                <?php foreach(GetMois() as $mois): ?>
                                                    <option value="<?php echo $mois->id ?>" 
                                                    <?php echo ($mois->id)==date("m")? "selected":"" ?>>
                                                    <?php echo utf8_encode($mois->libelle) 	?></option>
                                                <?php endforeach; ?>
                                            </select> 
                                        </div>

                                        <div class="col">
                                            <label>Credit au Compte</label>
                                            <input type="text" class="form-control" placeholder="Compte" list="list-compte" id="AddCredit">
                                            <datalist id="list-compte">
                                                <?php foreach(GetCodeAnalytique(50,0,700) as $national): ?>
                                                    <option value="<?php echo $national->CODLIB ?>">
                                                    <?php echo utf8_encode($national->LIBLONG) 	?></option>
                                                <?php endforeach; ?>                                     
                                            </datalist>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', e => {
                                                    $('#AddCredit').autocomplete()
                                                }, false);
                                            </script>  
                                        </div>  
                                    </div>      
                                        <div class="row">
                                            <div class="col">
                                                <label>Date Fin de Pret</label>
                                                <input type="date" class="form-control" id="AddDATEFIN" name="DATEFIN" 
                                                required></input>
                                            </div>

                                            <div class="col">
                                                <label>N° Ordre</label>
                                                <input type="text" class="form-control" id="AddNum_Ordre" name="Num_Ordre" 
                                                required></input>
                                            </div>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="edEditsauve_Prets" onclick="AddPrets()" name="sauve_Prets"  class="btn btn-success" value="Enregistrer">
                                </div>
                                </div>
                            </div>
                        </div>
                                        <!----edit-modal end--------->	   
                    <!----delete-modal start--------->
                        <div class="modal fade" tabindex="-1" id="DeletePretsModal" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Supprimer <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="IdPret" name="IdPret" class="form-control">
                                    <p>Êtes-vous sûr de vouloir supprimer cet enregistrement ?</p>
                                    <p class="text-warning"><small>cette action ne peut pas être annulée,</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="Deletesauve_Prets" onclick="DeletePrets()" class="btn btn-success" name="sauve_Prets" value="Supprimer">
                                </div>
                                </div>
                            </div>
                        </div>
                    <!----edit-modal end--------->  
			     </div>
			  </div>
		    <!------main-content-end-----------> 
<script type="text/javascript">

    function CalculMontantEcheance(nbr){
        var Montant=document.getElementById("AddMONTANT_R").value;
        var result=parseInt(Montant/nbr.value);
        $(".modal-body #AddMONTANT_EC").val(result);
    }

    function CalculDatefin(dateAppel){
        var dt=new Date(dateAppel.value);
        dt.setMonth(document.getElementById("AddNBRE_ECHEA").value);     
        document.getElementById("AddDATEFIN").valueAsDate=(dt);
        
    }

    function openmodal(data) { 
        var d1=data.DATE_AC.split('/');
        var d2=data.DATEFIN.split('/');
        var d3=data.DATE_APPEL.split('/');
        if(d1.length==1){
            var d1=data.DATE_AC.split('-');
            d1=new Array(d1[2],d1[1],d1[0]);
            var d2=data.DATEFIN.split('-');
            d2=new Array(d2[2],d2[1],d2[0]);
            var d3=data.DATE_APPEL.split('-');
            d3=new Array(d3[2],d3[1],d3[0]);
        }
        $(".modal-body #AddNum_Ordre").val(data.num_ordre);
        $(".modal-body #AddType_code").val(data.code_type);
        $(".modal-body #AddNum_Reference").val(data.num_reference);
        $(".modal-body #AddMatricule").val(data.MATRICULEV);

        $(".modal-body #AddCredit").val(data.CREDIT);
        $(".modal-body #AddCODE").val(data.CODE);
        $(".modal-body #AddMONTANT_R").val(data.MONTANT_T);
        $(".modal-body #AddNBRE_ECHEA").val(data.NBRE_ECHEA);
        $(".modal-body #AddPAYE").val(data.PAYE);
        $(".modal-body #AddDATE_AC").val(d1[2]+"-"+d1[1]+"-"+d1[0]);
        $(".modal-body #AddId").val(data.id);
        $(".modal-body #AddDATEFIN").val(d2[2]+"-"+d2[1]+"-"+d2[0]);
        $(".modal-body #AddPERIODE").val(data.PERIODE);
        $(".modal-body #AddMONTANT_EC").val(data.MONTANT_EC); 
        $(".modal-body #AddDATE_APPEL").val(d3[2]+"-"+d3[1]+"-"+d3[0]); 
        $(".modal-footer #edEditsauve_Prets").val("Modifier");

        $('#editPretModal').modal('show');
        
    }
    function openmodalAdd() { 
 
        $(".modal-footer #edEditsauve_Prets").val("Enregistrer");
        $('#editPretModal').modal('show');
        
    }

    function openmodaldelete(id) {         
        $(".modal-body #IdPret").val(id);     
        $('#DeletePretsModal').modal('show');        
    }
    
    function AddPrets(){
        var MATRICULEV=document.getElementById("AddMatricule").value;
        var CREDIT=document.getElementById("AddCredit").value;
        var CODE=document.getElementById("AddCODE").value;
        var MONTANT_R=document.getElementById("AddMONTANT_R").value;
        var NBRE_ECHEA=document.getElementById("AddNBRE_ECHEA").value;
        var PAYE=document.getElementById("AddPAYE").value;
        var DATE_APPEL=document.getElementById("AddDATE_APPEL").value;
        var DATE_AC=document.getElementById("AddDATE_AC").value;        
        var id=document.getElementById("AddId").value; 
        var sauve_Prets=document.getElementById("edEditsauve_Prets").value; 
        var DATEFIN=document.getElementById("AddDATEFIN").value;
        var PERIODE=document.getElementById("AddPERIODE").value; 
        var MONTANT_EC=document.getElementById("AddMONTANT_EC").value;
        var num_ordre=document.getElementById("AddNum_Ordre").value;
        var code_type=document.getElementById("AddType_code").value;
        var num_reference=document.getElementById("AddNum_Reference").value;


        $.ajax({
            type : "POST",  //type of method
            url  : "prets.php",  //your page
            data : {num_ordre:num_ordre,code_type:code_type,num_reference:num_reference,MONTANT_EC:MONTANT_EC,DATEFIN:DATEFIN,PERIODE:PERIODE, id:id,sauve_Prets : sauve_Prets, MATRICULEV : MATRICULEV,CODE:CODE,CREDIT:CREDIT,
                MONTANT_R:MONTANT_R,NBRE_ECHEA:NBRE_ECHEA,PAYE:PAYE,DATE_APPEL:DATE_APPEL,DATE_AC:DATE_AC},// passing the values
            success: function(res){  

            //    alert(res);
            //do what you want here...
            $('#TablePrets').DataTable().destroy();
            $('#TablePrets tbody').empty();
            $('#TablePrets tbody').append(res);
            $('#editPretModal').modal('hide');
            $(".modal-body #AddMatricule").val("");
            $(".modal-body #AddCOMPTE").val("");
            $(".modal-body #AddCODE").val("");
            $(".modal-body #AddMONTANT_R").val("");
            $(".modal-body #AddNBRE_ECHEA").val("");
            $(".modal-body #AddPAYE").val("");
            $(".modal-body #AddDATE_APPEL").val("");
            $(".modal-body #AddDATE_AC").val("");
          // alert(res);
            $("#TablePrets").dataTable().ajax.reload();

            }
        }); 
    }
   
     function DeletePrets(){
        var id=document.getElementById("IdPret").value; 
        var sauve_Prets=document.getElementById("Deletesauve_Prets").value; 
        $.ajax({
            type : "POST",  //type of method
            url  : "prets.php",  //your page
            data : { sauve_Prets : sauve_Prets,id:id},// passing the values
            success: function(res){  
            //do what you want here...
            $('#TablePrets').DataTable().destroy();
            $('#DeletePretsModal').modal('hide');
            $('#TablePrets tbody').empty();
            $('#TablePrets tbody').append(res);
           // alert(res);
            $("#TablePrets").dataTable().ajax.reload();
            }
        }); 
     }
</script>
