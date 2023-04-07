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
                            
                                include("html/viewvirement-ponctuels.php");
                           
                           ?>         
                        </div>
					   </div>
					</div>  
                    <!----delete-modal start--------->
                        <div class="modal fade" tabindex="-1" id="DeleteEditcodeswiftModal" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Supprimer <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="idVirementPonctuels" name="idVirementPonctuels" class="form-control">
                                    <p>Êtes-vous sûr de vouloir supprimer cet enregistrement ?</p>
                                    <p class="text-warning"><small>cette action ne peut pas être annulée,</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="DeleteEdit_codeswift" onclick="Deletecodeswifts()" class="btn btn-success" name="DeleteEdit_codeswift" value="Supprimer">
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
                                            <label>NUMERO COMPTE DEBIT</label>
                                            <input class="form-control" type="text" id="num_compteDebit"/>
                                        </div>  
                                        <div class="col">
                                            <label>NOM COMPTE DEBIT</label>
                                            <input class="form-control" type="text" id="titulaire"/>
                                        </div> 

                                        <div class="col">
                                            <label>MONTANT DEBIT</label>
                                            <input class="form-control" type="text" id="montant"/>
                                        </div>  
                                    </div> 

                                    <div class="row">
                                    <div class="col">
                                            <label>NOM BENEFICIAIRE</label> 
                                            <input type="text" class="form-control" id="nombenf">

                                        </div>
                                        <div class="col">
                                            <label>ADRESSE</label>
                                            <input class="form-control" id="adresseBeneficiaire"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>BANQUE</label>
                                            <input class="form-control" type="text" id="banqueBenf"/>
                                        </div>  
                                        <div class="col">
                                            <label>CODE SWIFT OU BIC</label>
                                            <input class="form-control" type="text" id="codeswift"/>
                                        </div>   
                                    </div> 
                                    <div class="row">    
                                        <div class="col">
                                            <label>CODE BANQUE</label>
                                            <input class="form-control" type="text" id="codebanqueBenf"/>
                                        </div>        
                                        <div class="col">
                                            <label>CODE GUICHE</label>
                                            <input class="form-control" type="text" id="codeguicher"/>
                                        </div>  
 
                                        <div class="col">
                                            <label>NUMERO COMPTE</label>
                                            <input class="form-control" type="text" id="numcomptebenf"/>
                                        </div>  
                                        <div class="col">
                                            <label>CLE RIB</label>
                                            <input class="form-control" type="text" id="clerib"/>
                                        </div> 
                                    </div> 
                                    <div class="row">
                                    <div class="col">
                                        <label>MOTIF</label>
                                        <input class="form-control" type="text" id="motif"/>
                                    </div>  

                                    <div class="col">
                                        <label>DATE</label>
                                        <input class="form-control" type="DATE" id="datecreat"/>
                                    </div>  
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
    $("#titulaire").val("");
    $("#num_compteDebit").val("0");
    $("#montant").val("0");
    $("#nombenf").val("0");
    $("#adresseBeneficiaire").val("0");
    $("#banqueBenf").val("0");
    $("#codeswift").val("0");
    $("#codebanqueBenf").val();
    $("#codeguicher").val();
    $("#numcomptebenf").val();
    $("#clerib").val();
    $("#codebanmotifqueBenf").val();
    $("#datecreat").val();

}

function openmodal(data){
    $("#idBonReglement").val(data.id);
    $("#titulaire").val(data.titulaire);
    $("#num_compteDebit").val(data.num_compteDebit);
    $("#montant").val(data.montant);
    $("#nombenf").val(data.nombenf);
    $("#adresseBeneficiaire").val(data.adresseBeneficiaire);
    $("#banqueBenf").val(data.banqueBenf);
    $("#codeswift").val(data.codeswift);
    $("#codebanqueBenf").val(data.codebanqueBenf);
    $("#codeguicher").val(data.codeguicher);
    $("#motif").val(data.motif);
    $("#numcomptebenf").val(data.numcomptebenf);
    $("#clerib").val(data.clerib);
    $("#codebanmotifqueBenf").val(data.codebanmotifqueBenf);
    $("#datecreat").val(data.datecreat);


    $(".modal-footer #EditSauveBonReglements").val("Modifier");
    $('#EditBonReglements').modal('show');
}

function SauveBonReglements(){
    var id=document.getElementById("idBonReglement").value;
    var titulaire=document.getElementById("titulaire").value;
    var num_compteDebit=document.getElementById("num_compteDebit").value;
    var montant=document.getElementById("montant").value;
    var nombenf=document.getElementById("nombenf").value;
    var adresseBeneficiaire=document.getElementById("adresseBeneficiaire").value;
    var banqueBenf=document.getElementById("banqueBenf").value;
    var codeswift=document.getElementById("codeswift").value;
    var codebanqueBenf=document.getElementById("codebanqueBenf").value; 
    var SauveBonReglements=document.getElementById("EditSauveBonReglements").value;

    var codeguicher=document.getElementById("codeguicher").value;
    var numcomptebenf=document.getElementById("numcomptebenf").value;
    var clerib=document.getElementById("clerib").value;
    var motif=document.getElementById("motif").value;
    var datecreat=document.getElementById("datecreat").value;

        $.ajax({
            type : "POST",  //type of method
            url  : "virement-ponctuels.php",  //your page
            data : {datecreat:datecreat,motif:motif,codeguicher:codeguicher,numcomptebenf:numcomptebenf,
                clerib:clerib,titulaire:titulaire,num_compteDebit:num_compteDebit,nombenf:nombenf,adresseBeneficiaire:adresseBeneficiaire,
                banqueBenf:banqueBenf,codeswift:codeswift,
                codebanqueBenf:codebanqueBenf,SauveBonReglements : SauveBonReglements,id:id,montant:montant},// passing the values
            success: function(res){  
          refrechData();
           $('#EditBonReglements').modal('hide');

            }
        }); 
}

function refrechData(){
    table = $('#TableVirement').DataTable(); 
    table.ajax.reload();
}

function openmodaldelete(id){
    $(".modal-body #idVirementPonctuels").val(id);     
    $('#DeleteEditcodeswiftModal').modal('show'); 
}

function Deletecodeswifts(){

var id=document.getElementById("idVirementPonctuels").value; 
var SauveBonReglements=document.getElementById("DeleteEdit_codeswift").value; 
$.ajax({
    type : "POST",  //type of method
    url  : "virement-ponctuels.php",  //your page
    data : { SauveBonReglements : SauveBonReglements,id:id},// passing the values
    success: function(res){  
    //do what you want here...
    refrechData();
   // alert(res);
    $('#DeleteEditcodeswiftModal').modal('hide');
    }
}); 
}

function Print(id){
    window.open("print/virement-ponctuels.php?id="+id);
}
</script>
