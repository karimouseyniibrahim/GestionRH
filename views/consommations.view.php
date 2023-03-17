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
                            <div class="xp-searchbar">

                                    <div class="input-group">
                                        <input type="date" class="form-control" placeholder="Date Arrivée" id="dateArrivee">
                                        <input type="date" class="form-control" placeholder="Date Depart" id="dateDepart">                                       
                                        <div class="input-group-append">
                                            <button class="btn" id="button-addon2" onclick="loadClient()">Go
                                            </button>
                                        </div>
                                    </div>
                                    <p class="text-danger">Min date: <?php echo $IntervalleDate[0]->min_date?> - Max date: <?php echo $IntervalleDate[0]->max_date?></p>

                            </div>
                            
                            <div class="col">
                                <select id="IDHebergement" class="form-control" name="Hebergement" onchange="loadConsommation(this)" >
                                    
                                </select>
                                
                            </div>
                         </div>
					   </div>
					   
					   <table class="table table-striped table-hover" id="TableConsommation">
					      <thead>
						     <tr>
							 <th><span class="custom-checkbox">
							 <input type="checkbox" id="selectAll">
							 <label for="selectAll"></label></th>
							 <th>DESIGNATION</th>
							 <th>NOMBRE</th>
							 <th>PRIX/UNIT</th>
                             <th>Actions</th>
							 </tr>
						  </thead>
						  
						  <tbody>
                          <?php if(count($consommations)): ?>
                            <?php foreach($consommations as $consomme):?>

                                
						      <tr>
                                <th><span class="custom-checkbox">
                                <input type="checkbox" id="checkbox1" name="option[]" value="1">
                                <label for="checkbox1"></label></th>
                                <th><?php echo $consomme->designation ?></th>
                                <th><?php echo $consomme->nombre ?></th>
                                <th><?php echo $consomme->prix_unitaire ?></th> 
                                <th>
                                    <a class="edit" data-toggle="modal" onclick='openmodal(<?php echo json_encode($consomme)?>,<?php echo $consomme->idconsommation ?>)'>
                                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                    </a>
                                    <a class="delete" data-toggle="modal" onclick="openmodaldelete(<?php echo $consomme->idconsommation ?>)">
                                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                    </a>
                                </th>
							 </tr>	
                             <?php endforeach; ?>
                             <?php else: ?>
                            <tr>
                                    <th colspan="7 c">
                                    Il n'existe aucun element de <?php echo $title ?>
                                    </th>
                            </tr>
                        <?php endif; ?>						 
						  </tbody>

					   </table>
                       

					   </div>
					</div>
					
									   <!----add-modal start--------->

                    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="addConsommationModal" role="dialog" aria-labelledby="myLargeModalLabel">
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
                            <label>DESIGNATION</label>
                            <select id="Designation" class="form-control" name="Designation">
                                <?php foreach($boisons as $boison): ?>
                                <option value="<?php echo $boison->idBoison ?>"><?php echo utf8_encode($boison->designation) 	?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>NOMBRE</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                         
                        <div class="form-group">
                            <label>PRIX/UNIT</label>
                            <input class="form-control" id="prix_unitaire" name="prix_unitaire" required></input>
                        </div>
                                                
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <input id="Addsauve_consommations" onclick="addConsommation()" name="sauve_consommations"  class="btn btn-success" value="Enregistrer">
                        </div>
                        </div>
                    </div>
                    </div>
					   <!----edit-modal end--------->
 
				   <!----edit-modal start--------->
                        <div class="modal" tabindex="-1" id="editConsommationModal" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                    
                                    <input type="hidden" id="Eidconsommation" name="idconsommation" class="form-control">
                    
                                    <div class="form-group">
                                        <label>DESIGNATION</label>
                                        <select id="EDesignation" class="form-control" name="Designation">
                                            <?php foreach($boisons as $boison): ?>
                                            <option value="<?php echo $boison->idBoison ?>"><?php echo utf8_encode($boison->designation)	?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>NOMBRE</label>
                                        <input type="text" class="form-control" id="Enombre" name="nombre" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>PRIX/UNIT</label>
                                        <input type="number" class="form-control" id="Eprix_unitaire" name="prix_unitaire" required></input>
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="Editsauve_consommations" onclick="EditConsommation()" name="sauve_consommations"  class="btn btn-success" value="Enregistrer">
                                </div>
                                </div>
                            </div>
                        </div>
                                        <!----edit-modal end--------->	   
                                        
                    <!----delete-modal start--------->
                        <div class="modal fade" tabindex="-1" id="deleteConsommationModal" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Supprimer <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="idconsommation" name="idconsommation" class="form-control">
                                    <p>Êtes-vous sûr de vouloir supprimer cet enregistrement ?</p>
                                    <p class="text-warning"><small>cette action ne peut pas être annulée,</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="Deletesauve_consommations" onclick="DeleteConsommation()" class="btn btn-success" name="sauve_consommations" value="Supprimer">
                                </div>
                                </div>
                            </div>
                        </div>
                    <!----edit-modal end--------->   

			     </div>
			  </div>
		  
		    <!------main-content-end-----------> 
<script type="text/javascript">
    function openmodal(fact,id) {      
        $(".modal-body #Eidconsommation").val(fact.idconsommation);
        $(".modal-body #EDesignation").val(fact.idBoison);
        $(".modal-body #Enombre").val(fact.nombre);
        $(".modal-body #Eprix_unitaire").val(fact.prix_unitaire);
        
        $(".modal-footer #Editsauve_consommations").val("Modifier");
        $('#editConsommationModal').modal('show');
        
    }
    function openmodalAdd() { 
 
        $(".modal-footer #btnSubmit").val("Enregistrer");
        $('#addConsommationModal').modal('show');
        
    }

    function openmodaldelete(id) {         
        $(".modal-body #idconsommation").val(id);     
        $('#deleteConsommationModal').modal('show');        
    }
    function loadClient(){

        var DateArrive = document.getElementById("dateArrivee").value;
        var DateDepart = document.getElementById("dateDepart").value;

        $.ajax({
                type : "POST",  //type of method
                url  : "getData.php?intervalle=1",  //your page
                data : { DateArrive : DateArrive, DateDepart : DateDepart},// passing the values
                success: function(res){  
                //do what you want here...
                var mySelect = document.getElementById("IDHebergement") ;
                mySelect.options.length = 0;
                var data=JSON.parse(res);
                for (var i=0; i<data.length; i++) {    
                    mySelect.options[i+1] = new Option (data[i].nom+' '+data[i].prenom+"/"+data[i].hs_numero,data[i].idfact);
                }  
                
            }
            });
     }

    function loadConsommation(idclient){
        var client=idclient.value;
        $.ajax({
            type : "POST",  //type of method
            url  : "getData.php",  //your page
            data : { client : client, consommation : "consommation"},// passing the values
            success: function(res){  
            //do what you want here...
            $('#TableConsommation tbody').empty();
            $('#TableConsommation tbody').append(res);

            }
        }); 
     }

    function addConsommation(){
        var Designation=document.getElementById("Designation").value;
        var nombre=document.getElementById("nombre").value;
        var prix_unitaire=document.getElementById("prix_unitaire").value;
        var IDHebergement=document.getElementById("IDHebergement").value; 
        var sauve_consommations=document.getElementById("Addsauve_consommations").value; 
        $.ajax({
            type : "POST",  //type of method
            url  : "getData.php",  //your page
            data : { sauve_consommations : sauve_consommations, Designation : Designation,nombre:nombre,
                prix_unitaire:prix_unitaire,IDHebergement:IDHebergement},// passing the values
            success: function(res){  
            //do what you want here...
            $('#TableConsommation tbody').empty();
           $('#TableConsommation tbody').append(res);
           $(".modal-body #Designation").val("");
           $(".modal-body #nombre").val("");
           $(".modal-body #prix_unitaire").val("");
           // alert(res);
            $('#addConsommationModal').modal('hide');
            }
        }); 
    }
    function EditConsommation(){
        var Designation=document.getElementById("EDesignation").value;
        var nombre=document.getElementById("Enombre").value;
        var prix_unitaire=document.getElementById("Eprix_unitaire").value;
        var IDHebergement=document.getElementById("IDHebergement").value;
        var sauve_consommations=document.getElementById("Editsauve_consommations").value;
        var idconsommation=document.getElementById("Eidconsommation").value;
        $.ajax({
            type : "POST",  //type of method
            url  : "getData.php",  //your page
            data : { sauve_consommations : sauve_consommations, Designation : Designation,nombre:nombre,
                prix_unitaire:prix_unitaire,IDHebergement:IDHebergement,idconsommation:idconsommation},// passing the values
            success: function(res){  
            //do what you want here...
            $('#TableConsommation tbody').empty();
            $('#TableConsommation tbody').append(res);
           // alert(res);
            $('#editConsommationModal').modal('hide');
            }
        }); 
        
     }

     function DeleteConsommation(){
        var IDHebergement=document.getElementById("IDHebergement").value;
        var sauve_consommations=document.getElementById("Deletesauve_consommations").value;
        var idconsommation=document.getElementById("idconsommation").value;
        $.ajax({
            type : "POST",  //type of method
            url  : "getData.php",  //your page
            data : { sauve_consommations : sauve_consommations,IDHebergement:IDHebergement,idconsommation:idconsommation},// passing the values
            success: function(res){  
            //do what you want here...
            $('#TableConsommation tbody').empty();
            $('#TableConsommation tbody').append(res);
           // alert(res);
            $('#deleteConsommationModal').modal('hide');
            }
        }); 
     }
</script>
