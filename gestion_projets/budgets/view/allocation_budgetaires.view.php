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
					   
					   <table class="table table-striped table-hover" id="TableBudget">
					      <thead>
						     <tr>
							 <th>COMPTE</th>
							 <th>DESCRIPTION</th>
							 <th>NATURE</th>
                             <th>RUBRIQUE</th>
                             <th>MONTANT</th>
                             <th>ANNEE</th>
                             <th>Actions</th>
							 </tr>
						  </thead>

						  <tbody>
                          </tbody>
                        </table>
					   </div>
					</div>
					

				   <!----edit-modal start--------->
                        <div class="modal" tabindex="-1" id="PlanComptableModal" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <input type="hidden" class="form-control" id="addid" name="id" required>
                                <div class="form-group">
                                    <label>COMPTE</label>
                                    <select id="COMPTE" class="form-control" >
                                        <?php foreach(GetGPPlanComptable() as $code): ?>
                                            <option value="<?php echo $code->compte ?>">
                                            <?php echo utf8_encode($code->description)." (".$code->compte.")"	?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>ANNEE</label>
                                    <input type="text" class="form-control" id="ANNEE"required>
                                </div>

                                <div class="form-group">
                                    <label>MONTANT</label>
                                    <input type="NUMBER" class="form-control" id="MONTANT"required>
                                </div>

                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="Sauve_plan_comptable" onclick="SauvePlanComptable()"  class="btn btn-success" value="Enregistrer">
                                </div>
                                </div>
                            </div>
                        </div>
                                        <!----edit-modal end--------->	   
                                        
                    <!----delete-modal start--------->
                        <div class="modal fade" tabindex="-1" id="DeletePlanComptableModal" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Supprimer <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="idcode" name="code" class="form-control">
                                    <p>Êtes-vous sûr de vouloir supprimer cet enregistrement ?</p>
                                    <p class="text-warning"><small>cette action ne peut pas être annulée,</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="DeletesauvePlan_Comptable" onclick="DeleteCodeAnalytique()" class="btn btn-success"  value="Supprimer">
                                </div>
                                </div>
                            </div>
                        </div>
                    <!----edit-modal end--------->   

			     </div>
			  </div>
		  
		    <!------main-content-end-----------> 
<script type="text/javascript">
    function openmodal(data,id) {      
        $(".modal-body #addid").val(data.id);
        $(".modal-body #COMPTE").val(data.compte);
        $(".modal-body #MONTANT").val(data.montant);
        $(".modal-body #ANNEE").val(data.annee); 
        $(".modal-footer #Sauve_plan_comptable").val("Modifier");
        $('#PlanComptableModal').modal('show');
    }
    function openmodalAdd() { 
 
        $(".modal-footer #Sauve_plan_comptable").val("Enregistrer");
        $('#PlanComptableModal').modal('show');
        
    }
    function openmodaldelete(id) {         
        $(".modal-body #idcode").val(id);     
        $('#DeletePlanComptableModal').modal('show');        
    } 

    function SauvePlanComptable(){
    var id=document.getElementById("addid").value;
    var compte=document.getElementById("COMPTE").value;
    var annee=document.getElementById("ANNEE").value;
    var montant=document.getElementById("MONTANT").value; 
    var SauvePlanComptable=document.getElementById("Sauve_plan_comptable").value;
        $.ajax({
            type : "POST",  //type of method
            url  : "allocation_budgetaires.php",  //your page
            data : {SauvePlanComptable : SauvePlanComptable,id:id,compte:compte,annee:annee,
                montant:montant},// passing the values
            success: function(res){  
          refrechData();

           $('#PlanComptableModal').modal('hide');

            }
        }); 
}

function refrechData(){
    table = $('#TableBudget').DataTable(); 
    table.ajax.reload();
}


    function DeleteCodeAnalytique(){
        var id=document.getElementById("idcode").value;
        var SauvePlanComptable=document.getElementById("DeletesauvePlan_Comptable").value;

        $.ajax({
            type : "POST",  //type of method
            url  : "allocation_budgetaires.php",  //your page
            data : { SauvePlanComptable : SauvePlanComptable,id:id},// passing the values
            success: function(res){  
                refrechData();

                $('#DeletePlanComptableModal').modal('hide');
            }
        }); 
    }


</script>
