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
                            
                                include("html/viewversement.php");
                           
                           ?>         
                        </div>
					   </div>
					</div>  
                    <!----delete-modal start--------->
                        <div class="modal fade" tabindex="-1" id="DeleteEditnbrCinqMilleModal" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Supprimer <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="idVersement" name="idVersement" class="form-control">
                                    <p>Êtes-vous sûr de vouloir supprimer cet enregistrement ?</p>
                                    <p class="text-warning"><small>cette action ne peut pas être annulée,</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="DeleteEdit_nbrCinqMille" onclick="DeletenbrCinqMilles()" class="btn btn-success" name="DeleteEdit_nbrCinqMille" value="Supprimer">
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
                                            <label>NUMERO COMPTE</label>
                                            <input class="form-control" type="text" id="numcompte"/>
                                        </div>  
                                        <div class="col">
                                            <label>NOM COMPTE</label>
                                            <input class="form-control" type="text" id="nomBenf"/>
                                        </div> 

                                        <div class="col">
                                            <label>MONTANT</label>
                                            <input class="form-control" type="text" id="montant"/>
                                        </div>  
                                    </div> 

                                    <div class="row">
                                    <div class="col">
                                            <label>NOM DEPOSANT</label> 
                                            <input type="text" class="form-control" id="deposant">

                                        </div>
                                        <div class="col">
                                            <label>MOTIF</label>
                                            <input class="form-control" type="text" id="motif"/>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>10 000</label>
                                            <input class="form-control" type="text" id="nbrDixmille"/>
                                        </div>  
                                        <div class="col">
                                            <label>5 000</label>
                                            <input class="form-control" type="text" id="nbrCinqMille"/>
                                        </div>   
                                       
                                        <div class="col">
                                            <label>2 000</label>
                                            <input class="form-control" type="text" id="nbrDeuxmille"/>
                                        </div>   

                                        <div class="col">
                                            <label>1 000</label>
                                            <input class="form-control" type="text" id="nbrMille"/>
                                        </div>  
                                    </div> 

                                    <div class="row"> 
                                        <div class="col">
                                            <label>500</label>
                                            <input class="form-control" type="text" id="nbrcinqcent"/>
                                        </div>  

                                        <div class="col">
                                            <label>250</label>
                                            <input class="form-control" type="text" id="nbrdeuxcentcinquante"/>
                                        </div> 

                                        <div class="col">
                                            <label>200</label>
                                            <input class="form-control" type="text" id="nbrDeuxCent"/>
                                        </div> 

                                        <div class="col">
                                            <label>100</label>
                                            <input class="form-control" type="text" id="nbrCent"/>
                                        </div>
                                    </div> 

                                    <div class="row"> 
                                        <div class="col">
                                            <label>50</label>
                                            <input class="form-control" type="text" id="nbrCinquante"/>
                                        </div>

                                        <div class="col">
                                            <label>25</label>
                                            <input class="form-control" type="text" id="nbrVingtcinq"/>
                                        </div>

                                        <div class="col">
                                            <label>10</label>
                                            <input class="form-control" type="text" id="nbrDix"/>
                                        </div>

                                        <div class="col">
                                            <label>5</label>
                                            <input class="form-control" type="text" id="nbrCinq"/>
                                        </div>

                                        <div class="col">
                                            <label>1</label>
                                            <input class="form-control" type="text" id="nbrUn"/>
                                        </div>
                                    </div> 


                                    <div class="row">
                                     
                                    <div class="col">
                                        <label>DATE</label>
                                        <input class="form-control" type="DATE" id="datecreate"/>
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
    $("#nomBenf").val("");
    $("#numcompte").val("0");
    $("#montant").val("0");
    $("#deposant").val(""); 
    $("#nbrDixmille").val("0");
    $("#nbrCinqMille").val("0");
    $("#nbrDeuxmille").val("0");
    $("#nbrMille").val("0");
    $("#nbrcinqcent").val("0");
    $("#nbrdeuxcentcinquante").val("0");
    $("#nbrDeuxCent").val("0");
    $("#nbrCent").val("0");
    $("#nbrCinquante").val("0");
    $("#nbrVingtcinq").val("0");
    $("#nbrDix").val("0");
    $("#nbrCinq").val("0");
    $("#nbrUn").val("0");
    $("#motif").val("");
    $("#datecreate").val("");

}

function openmodal(data){
    $("#nomBenf").val(data.nomBenf);
    $("#numcompte").val(data.numcompte);
    $("#montant").val(data.montant);
    $("#deposant").val(data.deposant); 
    $("#nbrDixmille").val(data.nbrDixmille);
    $("#nbrCinqMille").val(data.nbrCinqMille);
    $("#nbrDeuxmille").val(data.nbrDeuxmille);
    $("#nbrMille").val(data.nbrMille);
    $("#nbrcinqcent").val(data.nbrcinqcent);
    $("#nbrdeuxcentcinquante").val(data.nbrdeuxcentcinquante);
    $("#nbrDeuxCent").val(data.nbrDeuxCent);
    $("#nbrCent").val(data.nbrCent);
    $("#nbrCinquante").val(data.nbrCinquante);
    $("#nbrVingtcinq").val(data.nbrVingtcinq);
    $("#nbrDix").val(data.nbrDix);
    $("#nbrCinq").val(data.nbrCinq);
    $("#nbrUn").val(data.nbrUn);
    $("#motif").val(data.motif);
    $("#datecreate").val(data.datecreate);
    $("#idBonReglement").val(data.id);

    $(".modal-footer #EditSauveBonReglements").val("Modifier");
    $('#EditBonReglements').modal('show');
}

function SauveBonReglements(){
    var id=document.getElementById("idBonReglement").value;
    var nomBenf=document.getElementById("nomBenf").value;
    var numcompte=document.getElementById("numcompte").value;
    var montant=document.getElementById("montant").value;
    var deposant=document.getElementById("deposant").value;
    var nbrDixmille=document.getElementById("nbrDixmille").value;
    var nbrCinqMille=document.getElementById("nbrCinqMille").value;
    var nbrDeuxmille=document.getElementById("nbrDeuxmille").value; 
    var nbrMille=document.getElementById("nbrMille").value; 
    var nbrcinqcent=document.getElementById("nbrcinqcent").value; 
    var nbrdeuxcentcinquante=document.getElementById("nbrdeuxcentcinquante").value; 
    var nbrDeuxCent=document.getElementById("nbrDeuxCent").value; 
    var nbrCent=document.getElementById("nbrCent").value; 
    var nbrCinquante=document.getElementById("nbrCinquante").value; 
    var nbrVingtcinq=document.getElementById("nbrVingtcinq").value; 
    var nbrDix=document.getElementById("nbrDix").value; 
    var SauveBonReglements=document.getElementById("EditSauveBonReglements").value;
    var nbrCinq=document.getElementById("nbrCinq").value;
    var nbrUn=document.getElementById("nbrUn").value;
    var motif=document.getElementById("motif").value;
    var datecreate=document.getElementById("datecreate").value;

        $.ajax({
            type : "POST",  //type of method
            url  : "versement.php",  //your page
            data : {nbrUn:nbrUn,nbrCinq:nbrCinq,nbrDix:nbrDix,datecreate:datecreate,motif:motif,nbrMille:nbrMille,nbrcinqcent:nbrcinqcent,
                nbrdeuxcentcinquante:nbrdeuxcentcinquante,nomBenf:nomBenf,numcompte:numcompte,deposant:deposant,nbrDeuxCent:nbrDeuxCent,
                nbrDixmille:nbrDixmille,nbrCinqMille:nbrCinqMille,nbrCent:nbrCent,nbrCinquante:nbrCinquante,nbrVingtcinq:nbrVingtcinq,
                nbrDeuxmille:nbrDeuxmille,SauveBonReglements : SauveBonReglements,id:id,montant:montant},// passing the values
            success: function(res){  
          refrechData();
           $('#EditBonReglements').modal('hide');

            }
        }); 
}

function refrechData(){
    table = $('#TableVersement').DataTable(); 
    table.ajax.reload();
}

function openmodaldelete(id){
    $(".modal-body #idVersement").val(id);     
    $('#DeleteEditnbrCinqMilleModal').modal('show'); 
}

function DeletenbrCinqMilles(){

var id=document.getElementById("idVersement").value; 
var SauveBonReglements=document.getElementById("DeleteEdit_nbrCinqMille").value; 
$.ajax({
    type : "POST",  //type of method
    url  : "versement.php",  //your page
    data : { SauveBonReglements : SauveBonReglements,id:id},// passing the values
    success: function(res){  
    //do what you want here...
    refrechData();
   // alert(res);
    $('#DeleteEditnbrCinqMilleModal').modal('hide');
    }
}); 
}

function Print(id){
    window.open("print/versement.php?id="+id);
}
</script>
