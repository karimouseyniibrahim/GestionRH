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
                         <div class="row">                            
                            <div class="col">
                                <select id="rubriqueCode" class="form-control" name="code" onchange="loadrubriques(this)" >
                                    <?php foreach($Rubriquestypes as $type): ?>
                                        <option value="<?php echo $type->type ?>"><?php echo utf8_encode($type->type) 	?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                         </div>
					   </div>
					   
					   <table class="table table-striped table-hover" id="TableRubrique">
					      <thead>
						     <tr>
							 <th><span class="custom-checkbox">
							 <input type="checkbox" id="selectAll">
							 <label for="selectAll"></label></th>
							 <th>Code</th>
							 <th>Libelle</th>
							 <th>Statut</th>
                             <th>Actions</th>
							 </tr>
						  </thead>
						  
						  <tbody>
                          <?php echo GetHtmlRubriques('R') ?>						 
						  </tbody>

					   </table>
                       

					   </div>
					</div>
					
									   <!----add-modal start--------->

                    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="addRubriqueModal" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajout <?php echo $title?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
 
                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" class="form-control" id="addCode" name="code" required>
                        </div>

                        <div class="form-group">
                            <label>Libelle</label>
                            <input type="text" class="form-control" id="AddLibelle" name="libelle" required>
                        </div>
                         
                        <div class="form-group">
                            <label>Statut</label>
                            <input class="form-control" id="AddStatut" name="statut" required></input>
                        </div>
                              
                        <div class="form-group">
                            <label>Valeur</label>
                            <select id="AddValeur" class="form-control" name="valeur">
                                <option value="F">C</option>
                                <option value="F">F</option>
                                <option value="F">V</option>
                            </select>
                        </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <input id="Addsauve_rubriques" onclick="addRubrique()" name="sauve_rubriques"  class="btn btn-success" value="Enregistrer">
                        </div>
                        </div>
                    </div>
                    </div>
					   <!----edit-modal end--------->
 
				   <!----edit-modal start--------->
                        <div class="modal" tabindex="-1" id="editRubriqueModal" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                    
                                    <div class="form-group">
                                        <label>Code</label>
                                        <input type="number" class="form-control" id="ECode" name="code" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Libelle</label>
                                        <input type="text" class="form-control" id="ELibelle" name="libelle" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Statut</label>
                                        <input class="form-control" id="EStatut" name="statut" required></input>
                                    </div>
                                        
                                    <div class="form-group">
                                        <label>Valeur</label>
                                        <select id="EValeur" class="form-control" name="valeur">
                                            <option value="F">C</option>
                                            <option value="F">F</option>
                                            <option value="F">V</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="Editsauve_rubriques" onclick="EditRubrique()" name="sauve_rubriques"  class="btn btn-success" value="Enregistrer">
                                </div>
                                </div>
                            </div>
                        </div>
                                        <!----edit-modal end--------->	   
                                        
                    <!----delete-modal start--------->
                        <div class="modal fade" tabindex="-1" id="deleteRubriqueModal" role="dialog">
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
                                    <input id="Deletesauve_rubriques" onclick="DeleteRubrique()" class="btn btn-success" name="sauve_rubriques" value="Supprimer">
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
        $(".modal-body #ECode").val(data.CODE);
        $(".modal-body #ELibelle").val(data.LIBELLE);
        $(".modal-body #EStatut").val(data.STATUT);
        $(".modal-body #Evaleur").val(data.VALEUR);
        $(".modal-footer #Editsauve_rubriques").val("Modifier");
        $('#editRubriqueModal').modal('show');
    }
    function openmodalAdd() { 
 
        $(".modal-footer #Editsauve_rubriques").val("Enregistrer");
        $('#editRubriqueModal').modal('show');
        
    }
    function openmodaldelete(id) {         
        $(".modal-body #idcode").val(id);     
        $('#deleteRubriqueModal').modal('show');        
    } 
    function loadrubriques(type){
        var type=type.value;
        $.ajax({
            type : "POST",  //type of method
            url  : "rubriques.php",  //your page
            data : { type : type, Request : "Rubrique"},// passing the values
            success: function(res){  
            //do what you want here...
            $('#TableRubrique tbody').empty();
            $('#TableRubrique tbody').append(res);

            }
        }); 
     }
    function EditRubrique(){
        var code=document.getElementById("ECode").value;
        var libelle=document.getElementById("ELibelle").value;
        var statut=document.getElementById("EStatut").value;
        var valeur=document.getElementById("EValeur").value;
        var type=document.getElementById("rubriqueCode").value;
        
        var sauve_rubriques=document.getElementById("Editsauve_rubriques").value;
        $.ajax({
            type : "POST",  //type of method
            url  : "rubriques.php",  //your page
            data : { code : code, libelle : libelle,statut:statut,valeur:valeur,type:type,sauve_rubriques:sauve_rubriques},// passing the values
            success: function(res){  
            //do what you want here...
            $('#TableRubrique').DataTable().destroy();
            $('#TableRubrique tbody').empty();
            $('#TableRubrique tbody').append(res);
           // alert(res);
            $('#editRubriqueModal').modal('hide');
            $(".modal-body #ECode").val("");
            $(".modal-body #ELibelle").val("");
            $(".modal-body #EStatut").val("");
            $(".modal-body #Evaleur").val("");
            $("#TableRubrique").dataTable().ajax.reload();
            }
        }); 
        
     }

    function DeleteRubrique(){
        var code=document.getElementById("idcode").value;
        var sauve_rubriques=document.getElementById("Deletesauve_rubriques").value;
        var type=document.getElementById("rubriqueCode").value;
        $.ajax({
            type : "POST",  //type of method
            url  : "rubriques.php",  //your page
            data : { sauve_rubriques : sauve_rubriques,code:code,type:type},// passing the values
            success: function(res){  
            //do what you want here...
            $('#deleteRubriqueModal').modal('hide');
            $('#TableRubrique').DataTable().destroy();
            $('#TableRubrique tbody').empty();
            $('#TableRubrique tbody').append(res);
            // alert(res);
            $("#TableRubrique").dataTable().ajax.reload();
            }
        }); 
    }


</script>
