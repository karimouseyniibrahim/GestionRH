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
                           <?php 
                            
                                include("html/viewedition-cheques.php");
                           
                           ?>         
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
                                <input type="hidden" class="form-control" id="idBonReglement" name="id">
                                    <div class="row">
                                    <div class="col">
                                            <label>BENEFICIAIRE</label> 
                                            <input type="text" class="form-control" placeholder="LIBELLES" list="list-LIBELLES" id="LIBELLES-datalist">
                                            <datalist id="list-LIBELLES">
                                                <?php foreach(GetFournisseurs() as $code):?>
                                                <option value="<?php echo $code->CODE?>"><?php echo $code->Name?></option>
                                                <?php endforeach;?>
                                            </datalist>
 

                                        <script>
                                            document.addEventListener('DOMContentLoaded', e => {
                                                $('#LIBELLES-datalist').autocomplete()
                                            }, false);
                                        </script>

                                        </div>
                                        <div class="col">
                                            <label>REFERENCES DU REGLEMENT</label>
                                            <input class="form-control" id="MOTIF_BDR"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>MONTANT TTC</label>
                                            <input class="form-control" type="text" id="MONTANT_TTC"/>
                                        </div>  
                                        <div class="col">
                                            <label>MONTANT ISB</label>
                                            <input class="form-control" type="text" id="MONTANT_ISB"/>
                                        </div>   
                                    </div> 
                                    <div class="row">    
                                        <div class="col">
                                            <label>AVANCE</label>
                                            <input class="form-control" type="text" id="AVANCE"/>
                                        </div>        
                                        <div class="col">
                                            <label>TIMBRE</label>
                                            <input class="form-control" type="text" id="TIMBRE"/>
                                        </div>  
                                    </div>      
                                    <div class="row">
                                        <div class="col">
                                            <label>NETAPAYER</label>
                                            <input class="form-control" type="text" id="NETAPAYER"/>
                                        </div>  
                                        <div class="col">
                                            <label>N° CHEQUE</label>
                                            <input class="form-control" type="text" id="CHEQUE"/>
                                        </div> 
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label>DATE_BDR</label>
                                        <input class="form-control" type="text" id="DATE_BDR"/>
                                    </div>  

                                    </div>
 
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="EditSauveBonReglements" onclick="SauveBonReglements()" name="sauve_BonReglements"  class="btn btn-success" value="Enregistrer">
                                </div>
                                </div>
                            </div>
                        </div>


			     </div>
			  </div>
		    <!------main-content-end-----------> 
 

<script type="text/javascript">
function openmodalAdd(){
    $(".modal-footer #EditSauveBonReglements").val("Enregistrer");
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
    $("#idBonReglement").val(data.ID);
    $("#MOTIF_BDR").val(data.MOTIF_BDR);
    $("#MONTANT_TTC").val(data.MONTANT_TTC);
    $("#TIMBRE").val(data.TIMBRE);
    $("#MONTANT_ISB").val(data.MONTANT_ISB);
    $("#AVANCE").val(data.AVANCE);
    $("#NETAPAYER").val(data.NETAPAYER);
    $("#CHEQUE").val(data.CHEQUE);
    $("#DATE_BDR").val(data.DATE_BDR);
    $("#LIBELLES-datalist").val(data.CODE_FR);
    $(".modal-footer #EditSauveBonReglements").val("Modifier");
    $('#EditBonReglements').modal('show');
}

function SauveBonReglements(){
    var id=document.getElementById("idBonReglement").value;
    var MOTIF_BDR=document.getElementById("MOTIF_BDR").value;
    var MONTANT_TTC=document.getElementById("MONTANT_TTC").value;
    var TIMBRE=document.getElementById("TIMBRE").value;
    var MONTANT_ISB=document.getElementById("MONTANT_ISB").value;
    var AVANCE=document.getElementById("AVANCE").value;
    var NETAPAYER=document.getElementById("NETAPAYER").value;
    var CHEQUE=document.getElementById("CHEQUE").value;
    var DATE_BDR=document.getElementById("DATE_BDR").value;
    var LIBELLES=document.getElementById("LIBELLES-datalist").value;
    var SauveBonReglements=document.getElementById("EditSauveBonReglements").value;

        $.ajax({
            type : "POST",  //type of method
            url  : "edition-reglement.php",  //your page
            data : {MOTIF_BDR:MOTIF_BDR,MONTANT_TTC:MONTANT_TTC,MONTANT_ISB:MONTANT_ISB,AVANCE:AVANCE,NETAPAYER:NETAPAYER,CHEQUE:CHEQUE,
                DATE_BDR:DATE_BDR,SauveBonReglements : SauveBonReglements, LIBELLES : LIBELLES,id:id,TIMBRE:TIMBRE},// passing the values
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
    table = $('#TableEditcheque').DataTable(); 
    table.ajax.reload();
}

function openmodaldelete(id){
    $(".modal-body #ideditcheque").val(id);     
    $('#DeleteEditChequeModal').modal('show'); 
}

function DeleteCheques(){

var id=document.getElementById("ideditcheque").value; 
var SauveBonReglements=document.getElementById("DeleteEdit_Cheque").value; 
$.ajax({
    type : "POST",  //type of method
    url  : "edition-reglement.php",  //your page
    data : { SauveBonReglements : SauveBonReglements,id:id},// passing the values
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
