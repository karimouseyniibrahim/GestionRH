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
					   
					   <table class="table table-striped table-hover">
					      <thead>
						     <tr>
							 <th><span class="custom-checkbox">
							 <input type="checkbox" id="selectAll">
							 <label for="selectAll"></label></th>
							 <th>Nom</th>
							 <th>Prenom</th>
							 <th>Address</th>
							 <th>Telephone</th>
							 <th>Actions</th>
							 </tr>
						  </thead>
						  
						  <tbody>
                          <?php if(count($clients)): ?>
                            <?php foreach($clients as $client):?>

                                
						      <tr>
                                <th><span class="custom-checkbox">
                                <input type="checkbox" id="checkbox1" name="option[]" value="1">
                                <label for="checkbox1"></label></th>
                                <th><?php echo $client->nom ?></th>
                                <th><?php echo $client->prenom ?></th>
                                <th><?php echo $client->adresse ?></th>
                                <th><?php echo $client->telephone ?></th>
                                <th>
                                    <a class="edit" data-toggle="modal" onclick='openmodal(<?php echo json_encode($client)?>,<?php echo $client->idclient ?>)'>
                                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                    </a>
                                    <a class="delete" data-toggle="modal" onclick="openmodaldelete(<?php echo $client->idclient ?>)">
                                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                    </a>
                                </th>
							 </tr>	
                             <?php endforeach; ?>
                        <?php endif; ?>						 
						  </tbody>

					   </table>
                       <?php if(isset($nbr_pages)): ?>
                            <div class="clearfix">
                                <div class="hint-text">showing <b>5</b> out of <b>20</b></div>
                                <ul class="pagination">
                                    <li class="page-item disabled"><a href="#">Previous</a></li>
                                    <?php for($i=0; $i<$nbr_pages;$i++): ?>
                                        <li class="page-item "><a href="#"class="page-link"><?php echo ($i+1) ?></a></li>
                                    <?php endfor; ?>
                                    <li class="page-item "><a href="#" class="page-link">Next</a></li>
                                </ul>
                            </div>
					   
                        <?php endif; ?>

					   </div>
					</div>
					
									   <!----add-modal start--------->
                <form method="post">
                    <div class="modal fade" tabindex="-1" id="addClient" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajout <?php echo $title?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" class="form-control" id="clientname" name="clientname" required>
                        </div>
                        <div class="form-group">
                            <label>Prenom</label>
                            <input type="text" class="form-control" id="clientlastname" name="clientlastname" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input class="form-control" id="clientAddress" name="clientAddress" required></input>
                        </div>
                        <div class="form-group">
                            <label>Telephone</label>
                            <input type="text" class="form-control" id="clienttelephone" name="clienttelephone" required>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <input type="submit" name="sauve_client"  class="btn btn-success" value="Enregistrer">
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
					   <!----edit-modal end--------->
 
				   <!----edit-modal start--------->
                    <form method="post">
                        <div class="modal" tabindex="-1" id="editClient" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                    
                                    <input type="hidden" id="clientID" name="clientID" class="form-control">
                    
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" class="form-control" id="clientname" name="clientname" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Prenom</label>
                                        <input type="text" class="form-control" id="clientlastname" name="clientlastname" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input class="form-control" id="clientAddress" name="clientAddress" required></input>
                                    </div>
                                    <div class="form-group">
                                        <label>Telephone</label>
                                        <input type="text" class="form-control" id="clienttelephone" name="clienttelephone" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input type="submit" name="sauve_client"  id="btnSubmit" class="btn btn-success" value="Enregistrer">
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                                        <!----edit-modal end--------->	   
                                        
                    <!----delete-modal start--------->
                    <form method="post">
                        <div class="modal fade" tabindex="-1" id="deleteClientModal" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Supprimer <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="clientID" name="clientID" class="form-control">
                                    <p>Êtes-vous sûr de vouloir supprimer cet enregistrement ?</p>
                                    <p class="text-warning"><small>cette action ne peut pas être annulée,</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input type="submit" class="btn btn-success" name="sauve_client" value="Supprimer">
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!----edit-modal end--------->   

			     </div>
			  </div>
		  
		    <!------main-content-end-----------> 
<script type="text/javascript">
    function openmodal(client,id) {      
              $(".modal-body #clientID").val(client.idclient);
               $(".modal-body #clientname").val(client.nom);
               $(".modal-body #clientlastname").val(client.prenom);
               $(".modal-body #clientAddress").val(client.adresse);
               $(".modal-body #clienttelephone").val(client.telephone);  
               $(".modal-footer #btnSubmit").val("Modifier");
              $('#editClient').modal('show');
        
    }
    function openmodalAdd() { 
 
        $(".modal-footer #btnSubmit").val("Enregistrer");
        $('#addClient').modal('show');
        
    }
    function openmodaldelete(id) {       
              /* $(".deleteElement #id").val(id);      */    
              $(".modal-body #clientID").val(id);     
               $('#deleteClientModal').modal('show');        
    }
    function deletedata() {
      /*  var id=$(".deleteElement #id").val();
        var params="medecins="+ id;
        $.ajax({
			url: "medecins.php",
            type: "POST", 
            data:params,
			success: function(res){  

                $.notify({
                    icon: "now-ui-icons ui-1_bell-53",
                    message: "<?=  $title?> supprimer avec success!"

                    }, {
                    type: 'danger',
                    timer: 8000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                    });  
                $("#element"+id).remove();   
                $('#exampleModaldelete').modal('hide');           
			}
        });*/
    }
</script>
