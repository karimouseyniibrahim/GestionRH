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
					   
					   <table class="table table-striped table-hover" id="TableUser">
					      <thead>
						     <tr>
                                <th>Matricule</th>
                                <th>Nom & Prenom</th>
                                <th>Role</th>
                                <th>Date Create</th>
                                <th>Actions</th>
							 </tr>
						  </thead>
						  
						  <tbody>
                          <?php echo GetHtmlUsers() ?>						 
						  
                          </tbody>
                        </table>
					   </div>
					</div>
					

				   <!----edit-modal start--------->
                        <div class="modal" tabindex="-1" id="EditUser" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <input type="hidden" class="form-control" id="addid" name="id">
                                <input type="hidden" class="form-control" id="addPage" name="page" value="1" required>
                                <div class="form-group">
                                    <label>Matricule</label>
                                    <input type="text" class="form-control" name="matricule" placeholder="Utilisateur Systeme" list="list-timezone" id="input-datalist">
                                    <datalist id="list-timezone">
                                        <?php foreach(GetPersonnels("VRAI") as $personnel):?>
                                        <option value="<?php echo $personnel->MATRICULEV?>"><?php echo $personnel->NOM." ".$personnel->PRENOMS?></option>
                                        <?php endforeach;?>
                                         
                                    </datalist>
                                </div>

                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="password" class="form-control" id="AddPassword" name="password" required>
                        </div>
                       

                        <div class="form-group">
                            <label>Rôle</label>
                            <select id="Addrole" class="form-control" name="role">
                                <?php foreach(ListeRoles() as $r): ?>
                                    <option value="<?php echo $r->id ?>">
                                    <?php  echo  utf8_encode($r->name) 	?></option>
                                <?php endforeach; ?>
                               
                            </select>
                        </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="Editsauve_user" onclick="EditUsers()" name="sauve_connexion"  class="btn btn-success" value="Enregistrer">
                                </div>
                                </div>
                            </div>
                        </div>
                                        <!----edit-modal end--------->	   
                                        
                    <!----delete-modal start--------->
                        <div class="modal fade" tabindex="-1" id="DeleteUserModal" role="dialog">
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
                                    <input id="Deletesauve_connexion" onclick="DeleteCodeAnalytique()" class="btn btn-success" name="sauve_connexion" value="Supprimer">
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
        $(".modal-body #addcodlib").val(data.CODLIB);
        $(".modal-body #AddPassword").val(data.password);
        $(".modal-body #Addlibcourt").val(data.LIBCOURT);
        $(".modal-body #Addrole").val(data.role);
        $(".modal-footer #Editsauve_user").val("Modifier");
        $('#EditUser').modal('show');
    }
    function openmodalAdd() { 
 
        $(".modal-footer #Editsauve_user").val("Enregistrer");
        $('#EditUser').modal('show');
        
    }
    function openmodaldelete(id) {         
        $(".modal-body #idcode").val(id);     
        $('#DeleteUserModal').modal('show');        
    } 

    function EditUsers(){
        var password=document.getElementById("AddPassword").value;
        var matricule=document.getElementById("input-datalist").value;
        var role=document.getElementById("Addrole").value;
        var id=document.getElementById("addid").value;

        //addPage
        var sauve_connexion=document.getElementById("Editsauve_user").value;
        $.ajax({
            type : "POST",  //type of method
            url  : "users.php",  //your page
            data : { password : password,matricule:matricule,role:role,sauve_connexion:sauve_connexion,id:id},// passing the values
            success: function(res){  
            //do what you want here...
            $('#TableUser').DataTable().destroy();
            $('#TableUser tbody').empty();
            $('#TableUser tbody').append(res);
           // alert(res);
            $('#EditUser').modal('hide');
            $(".modal-body #addcodlib").val("");
            $(".modal-body #AddPassword").val("");
            $(".modal-body #Addlibcourt").val("");
            $(".modal-body #Addrole").val("");
            $("#TableUser").dataTable().ajax.reload();
            }
        }); 
        
     }
    function loaddata(data){
   
       // $(".modal-body #addPage").val(da);
       $(".modal-body #AddPassword").val(data.pwd);
       $(".modal-body #input-datalist").val(data.matricule);
       $(".modal-body #Addrole").val(data.role)
       $(".modal-body #addid").val(data.id);
       $(".modal-footer #Editsauve_user").val("Modifier");
        $('#EditUser').modal('show');
        
    }
    function DeleteCodeAnalytique(){
        var codlib=document.getElementById("idcode").value;
        var sauve_connexion=document.getElementById("Deletesauve_connexion").value;
        var codtab=21;
        var page=document.getElementById("addPage").value;
        $.ajax({
            type : "POST",  //type of method
            url  : "users.php",  //your page
            data : { sauve_connexion : sauve_connexion,codlib:codlib},// passing the values
            success: function(res){  
            //do what you want here...
            $('#DeleteUserModal').modal('hide');
            $('#TableUser').DataTable().destroy();
            $('#TableUser tbody').empty();
            $('#TableUser tbody').append(res);
            
            $("#TableUser").dataTable().ajax.reload();
            }
        }); 
    }


</script>
