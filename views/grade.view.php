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
					   
					   <table class="table table-striped table-hover" id="TableCodeAnalytique">
					      <thead>
						     <tr>
							 <th><span class="custom-checkbox">
							 <input type="checkbox" id="selectAll">
							 <label for="selectAll"></label></th>
							 <th>Code</th>
							 <th>Libelle Long</th>
							 <th>Liblle Court</th>
                             <th>Type Don</th>
                             <th>Actions</th>
							 </tr>
						  </thead>
						  
						  <tbody>
                          <?php echo GetHtmlCodeAnalytique(38,1) ?>						 
						  
                          </tbody>
                        </table>

					   </div>
					</div>
					

				   <!----edit-modal start--------->
                        <div class="modal" tabindex="-1" id="EditCodeAnalytiqueModal" role="dialog">
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
                                <input type="hidden" class="form-control" id="addPage" name="page" value="1" required>
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" class="form-control" id="addcodlib" name="codlib" required>
                                </div>

                        <div class="form-group">
                            <label>Libelle Long</label>
                            <input type="text" class="form-control" id="Addliblong" name="liblong" required>
                        </div>
                         
                        <div class="form-group">
                            <label>Libelle Court</label>
                            <input class="form-control" id="Addlibcourt" name="libcourt" required></input>
                        </div>

                        <div class="form-group">
                            <label>Type Don</label>
                            <select id="Addtypedon" class="form-control" name="typedon">
                                <option value="">Null</option>
                                <option value=":">:</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="G">G</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="Editsauve_codeanalytique" onclick="EditCodeAnalytique()" name="sauve_codeanalytique"  class="btn btn-success" value="Enregistrer">
                                </div>
                                </div>
                            </div>
                        </div>
                                        <!----edit-modal end--------->	   
                                        
                    <!----delete-modal start--------->
                        <div class="modal fade" tabindex="-1" id="DeleteCodeAnalytiqueModal" role="dialog">
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
                                    <input id="Deletesauve_codeanalytique" onclick="DeleteCodeAnalytique()" class="btn btn-success" name="sauve_codeanalytique" value="Supprimer">
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
        $(".modal-body #Addliblong").val(data.LIBLONG);
        $(".modal-body #Addlibcourt").val(data.LIBCOURT);
        $(".modal-body #Addtypedon").val(data.TYPEDON);
        $(".modal-footer #Editsauve_codeanalytique").val("Modifier");
        $('#EditCodeAnalytiqueModal').modal('show');
    }
    function openmodalAdd() { 
 
        $(".modal-footer #Editsauve_codeanalytique").val("Enregistrer");
        $('#EditCodeAnalytiqueModal').modal('show');
        
    }
    function openmodaldelete(id) {         
        $(".modal-body #idcode").val(id);     
        $('#DeleteCodeAnalytiqueModal').modal('show');        
    } 

    function EditCodeAnalytique(){
        var codlib=document.getElementById("addcodlib").value;
        var liblong=document.getElementById("Addliblong").value;
        var libcourt=document.getElementById("Addlibcourt").value;
        var typedon=document.getElementById("Addtypedon").value;
        var id=document.getElementById("addid").value;
        var codtab=38;
        var page=document.getElementById("addPage").value;
        //addPage
        var sauve_codeanalytique=document.getElementById("Editsauve_codeanalytique").value;
        $.ajax({
            type : "POST",  //type of method
            url  : "code-analytique.php",  //your page
            data : { page:page,codlib : codlib, liblong : liblong,libcourt:libcourt,typedon:typedon,codtab:codtab,
                sauve_codeanalytique:sauve_codeanalytique,id:id},// passing the values
            success: function(res){  
            //do what you want here...
            $('#TableCodeAnalytique').DataTable().destroy();
            $('#TableCodeAnalytique tbody').empty();
            $('#TableCodeAnalytique tbody').append(res);
           // alert(res);
            $('#EditCodeAnalytiqueModal').modal('hide');
            $(".modal-body #addcodlib").val("");
            $(".modal-body #Addliblong").val("");
            $(".modal-body #Addlibcourt").val("");
            $(".modal-body #Addtypedon").val("");
            $("#TableCodeAnalytique").dataTable().ajax.reload();
            }
        }); 
        
     }
    function loaddata(pageid){
        var codtab=38;
        var page=pageid;
        var Request="loadData";
        $(".modal-body #addPage").val(page);
        

        $.ajax({
            type : "POST",  //type of method
            url  : "code-analytique.php",  //your page
            data : { page:page,codtab:codtab,Request:Request},// passing the values
            success: function(res){  
            //do what you want here...
            $('#TableCodeAnalytique tbody').empty();
            $('#TableCodeAnalytique tbody').append(res);

    
           // alert(res);
            }
        }); 
    }
    function DeleteCodeAnalytique(){
        var codlib=document.getElementById("idcode").value;
        var sauve_codeanalytique=document.getElementById("Deletesauve_codeanalytique").value;
        var codtab=38;
        var page=document.getElementById("addPage").value;
        $.ajax({
            type : "POST",  //type of method
            url  : "code-analytique.php",  //your page
            data : { sauve_codeanalytique : sauve_codeanalytique,codlib:codlib,codtab:codtab,page:page},// passing the values
            success: function(res){  
            //do what you want here...
            $('#DeleteCodeAnalytiqueModal').modal('hide');
            $('#TableCodeAnalytique').DataTable().destroy();
            $('#TableCodeAnalytique tbody').empty();
            $('#TableCodeAnalytique tbody').append(res);
            
            $("#TableCodeAnalytique").dataTable().ajax.reload();
            }
        }); 
    }


</script>
