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
                               
							 </div>
					     </div>
                          
					   </div>



					    <div id="block">
                        <table class="table table-striped table-hover" id="TablePersManoeuvres">
                            <thead>
                                <tr>				 
                                                <th>MAT.</th>
                                                <th>NOM</th>
                                                <th>DATE NAISS.</th>
                                                <th>LIEU NAISS.</th>
                                                <th>NR CNSS</th>
                                                <th>CARTE NAT.</th> 
                                                <th>CARTE ISC</th> 
                                                
                                                <th>ACTION</th> 
                                </tr>
                            </thead>

                        </table>        
                        </div>
					   </div>
					</div>  
                    <!----delete-modal start--------->
                        <div class="modal fade" tabindex="-1" id="DeleteEditChequeModal" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Supprimer <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="ideditcheque" name="ideditcheque" class="form-control">
                                    <p>Êtes-vous sûr de vouloir supprimer cet enregistrement ?</p>
                                    <p class="text-warning"><small>cette action ne peut pas être annulée,</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="DeleteEdit_Cheque" onclick="DeleteCheques()" class="btn btn-success" name="DeleteEdit_Cheque" value="Supprimer">
                                </div>
                                </div>
                            </div>
                        </div>
                    <!----edit-modal end--------->  


                    <div class="modal" tabindex="-1" id="EditBonReglements" role="dialog">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit <?php echo $title?> </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <input type="hidden" class="form-control" id="idPersonnel" name="id">
                                    <div class="row">
                                        <div class="col">
                                            <label>MATRICULE</label> 
                                            <input type="text" class="form-control" placeholder="MATRICULE"  id="MATRICULE">
                                        </div>
                                        <div class="col">
                                            <label>NOM & PRENOM</label>
                                            <input type="text" class="form-control" id="NOM"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>DATE NAISS.</label>
                                            <input TYPE="DATE" class="form-control" type="text" id="DATE_NAISS"/>
                                        </div>  
                                        <div class="col">
                                            <label>LIEU NAISS.</label>
                                            <input class="form-control" type="text" id="LIEUNAISS"/>
                                        </div>   
                                        <div class="col">
                                            <label>SEXE</label>
                                            <select id="SEXE" class="form-control" name="SEXE">
                                                <?php foreach(GetCodeAnalytique(48,0,50) as $national): ?>
                                                    <option value="<?php echo $national->LIBLONG ?>"><?php echo utf8_encode($national->LIBLONG) 	?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div> 
                                    </div> 
                                    <div class="row">    
                                        <div class="col">
                                            <label>N° CNSS</label>
                                            <input class="form-control" type="text" id="NR_CNSS"/>
                                        </div>        
                                        <div class="col">
                                            <label>CARTE ISC</label>
                                            <input class="form-control" type="text" id="CARTE_ISC"/>
                                        </div>  
                                    </div>      
                                    <div class="row">
                                        <div class="col">
                                            <label>CARTE NAT.</label>
                                            <input class="form-control" type="text" id="CARTE_NAT"/>
                                        </div>  
                                        <div class="col">
                                            <label>DATE CART.</label>
                                            <input  TYPE="DATE" class="form-control" type="text" id="DATE_CART"/>
                                        </div> 
                                        <div class="col">
                                            <label>LIEU CARTE</label>
                                            <input  TYPE="TEXT" class="form-control" type="text" id="LIEU_CART"/>
                                        </div>
                                    </div>  

                                    </div>
 
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="EditSauvePersonnels" onclick="SauvePersonnels()"   class="btn btn-success" value="Enregistrer">
                                </div>
                                </div>
                            </div>
                        </div>


			     </div>
			  </div>
		    <!------main-content-end-----------> 
 

<script type="text/javascript">
function openmodalAdd(){
    $(".modal-footer #EditSauvePersonnels").val("Enregistrer");
    initialisation();
        $('#EditBonReglements').modal('show');
}
function initialisation(){
    $("#MOTIF_BDR").val("");
    $("#MONTANT_TTC").val("0");
    $("#TIMBRE").val("0");
    $("#MONTANT_ISB").val("0");
    $("#AVANCE").val("0");
    $("#NETAPAYER").val("0");
    $("#CHEQUE").val("0");
    $("#DATE_BDR").val();
}

function openmodal(data){
    $("#idPersonnel").val(data.id);
    $("#MATRICULE").val(data.MATRICULEV);
    $("#NOM").val(data.NOM);
    var dn=data.DATE_NAISS.split('/');
    $("#DATE_NAISS").val(dn[2]+"-"+dn[1]+"-"+dn[0]);
    $("#LIEUNAISS").val(data.LIEUNAISS);
    $("#SEXE").val(data.SEXE);
    $("#NR_CNSS").val(data.NR_CNSS);
    $("#CHEQUE").val(data.CHEQUE);
    $("#CARTE_ISC").val(data.CARTE_ISC);
    $("#CARTE_NAT").val(data.CARTE_NAT);  
    var dc=data.DATE_CART.split('/');
    $("#DATE_CART").val(dc[2]+"-"+dc[1]+"-"+dc[0]);  
    $("#LIEU_CART").val(data.LIEU_CART);  

    $(".modal-footer #EditSauvePersonnels").val("Modifier");
    $('#EditBonReglements').modal('show');
}

function SauvePersonnels(){
    var id=document.getElementById("idPersonnel").value;
    var MATRICULE=document.getElementById("MATRICULE").value;
    var NOM=document.getElementById("NOM").value;
    var DATE_NAISS=document.getElementById("DATE_NAISS").value;
    var LIEUNAISS=document.getElementById("LIEUNAISS").value;
    var SEXE=document.getElementById("SEXE").value;
    var NR_CNSS=document.getElementById("NR_CNSS").value;
    var CARTE_ISC=document.getElementById("CARTE_ISC").value;
    var CARTE_NAT=document.getElementById("CARTE_NAT").value;
    var DATE_CART=document.getElementById("DATE_CART").value;
    var LIEU_CART=document.getElementById("LIEU_CART").value;
    
    var SauvePersonnels=document.getElementById("EditSauvePersonnels").value;

        $.ajax({
            type : "POST",  //type of method
            url  : "personnels-manoeuvres.php",  //your page
            data : {LIEU_CART:LIEU_CART,MATRICULE:MATRICULE,NOM:NOM,DATE_NAISS:DATE_NAISS,LIEUNAISS:LIEUNAISS,SEXE:SEXE,NR_CNSS:NR_CNSS,
                CARTE_ISC:CARTE_ISC,SauvePersonnels : SauvePersonnels, CARTE_NAT : CARTE_NAT,id:id,DATE_CART:DATE_CART},// passing the values
            success: function(res){  
          // alert(res);
          // $("#TableEditcheque").ajax.reload( null, false );
          refrechData();
          // dataTable.ajax.reload();
           $('#EditBonReglements').modal('hide');

            }
        }); 
}

function refrechData(){
    table = $('#TablePersManoeuvres').DataTable(); 
    table.ajax.reload();
}

function openmodaldelete(id){
    $(".modal-body #ideditcheque").val(id);     
    $('#DeleteEditChequeModal').modal('show'); 
}

function DeleteCheques(){

var id=document.getElementById("ideditcheque").value; 
var SauvePersonnels=document.getElementById("DeleteEdit_Cheque").value; 
$.ajax({
    type : "POST",  //type of method
    url  : "personnels-manoeuvres.php",  //your page
    data : { SauvePersonnels : SauvePersonnels,id:id},// passing the values
    success: function(res){  
    //do what you want here...
    refrechData();
   // alert(res);
    $('#DeleteEditChequeModal').modal('hide');
    }
}); 
}

function onpenPrintcheque(id){
    window.open("print/edit-cheque.php?id="+id);
}
</script>
