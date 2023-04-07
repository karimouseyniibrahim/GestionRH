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
							   
							 </div>
					     </div>
                         <div class="col">
                                
                         </div>
                        <div class="row mt-4">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Matricule" list="list-matricule" id="matricule-datalist">
                                        <datalist id="list-matricule">
                                        <?php foreach(ListePersonnelManoeuvres() as $p):?>
                                            <option value="<?php echo $p->MATRICULEV?>"  >
                                        <?php echo $p->MATRICULEV." ".$p->NOM."-".$p->CARTE_NAT?></option>
                                        <?php endforeach;?>
                                        </datalist>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', e => {
                                            $('#matricule-datalist').autocomplete()
                                        }, false);
                                    </script>
                                </div>

                                <div col="col">
                                        <a onclick="loadContrat()" class="btn btn-primary">
                                            <i class="material-icons">search</i>Charger
                                        </a>
                                </div>
                                                         
                            </div>
					   </div>
					    <div id="block">
                           <?php 
                                include("html/viewhistorique-manoeuvre.php");
                           ?>         
                        </div>
					   </div>
					</div>  
                    <!----delete-modal start--------->
                        <div class="modal fade" tabindex="-1" id="DeleteElementContratModal" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Supprimer <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="IdContrat" name="IdContrat" class="form-control">
                                    <p>Êtes-vous sûr de vouloir supprimer cet enregistrement ?</p>
                                    <p class="text-warning"><small>cette action ne peut pas être annulée,</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="Deletesauve_Contrat" onclick="DeleteContrat()" class="btn btn-success" name="sauve_Contrat" value="Supprimer">
                                </div>
                                </div>
                            </div>
                        </div>
                    <!----edit-modal end--------->  
			     </div>
			  </div>
		    <!------main-content-end-----------> 
<script type="text/javascript">

    function openmodal() { 
         // window.open("contrat.php?editcontrat-manoeuvre="+document.getElementById("input-datalist").value,"_self").focus(); 
         $.ajax({
            type : "POST",  //type of method
            url  : "html/editcontrat-manoeuvre.php",  //your page
            data : { Request : "AddContrat"},// passing the values
            success: function(res){  
            $('#block').empty(); 
            $('#block').append(res);

            }
        }); 
    }
     
    function editContrat(id) { 
         // window.open("contrat.php?editcontrat-manoeuvre="+document.getElementById("input-datalist").value,"_self").focus(); 
         var contratId=id;
         $.ajax({
            type : "POST",  //type of method
            url  : "html/editcontrat-manoeuvre.php",  //your page
            data : { Request : "AddContrat",contratId:contratId,action:'edit'},// passing the values
            success: function(res){  
            $('#block').empty(); 
            $('#block').append(res);

            }
        }); 
    }
    function addDebutContrat(dat){
        $("#DEBUT_CONT").val(dat.value);
    }
    function sauveContrat(){
        var MATRICULEV=document.getElementById("matricule-datalist").value;
        var id=document.getElementById("idcontrat").value;
        var DEBUT_CONT=document.getElementById("DEBUT_CONT").value;
        var FIN_CONT=document.getElementById("FIN_CONT").value;
        var LOCALITE=document.getElementById("LIEUAFFEC").value;
        var CODE_ANAL=document.getElementById("CodeAnalytique-datalist").value;
        var NUME_LETT=document.getElementById("NUME_LETT").value;
        var DATE_LETT=document.getElementById("DATE_LETT").value;
        var CODE_SUPP=document.getElementById("Chercheur-datalist").value;
        //var CARTE_ISC=document.getElementById("CARTE_ISC").value;
        var COMPTE=document.getElementById("Compte-datalist").value;
        var sauve_contrat=document.getElementById("Add_contrat").value; 

        $.ajax({
            type : "POST",  //type of method
            url  : "manoeuvres-contrat.php",  //your page
            data : {id:id,COMPTE:COMPTE, MATRICULEV : MATRICULEV,DEBUT_CONT:DEBUT_CONT, FIN_CONT : FIN_CONT,CODE_ANAL:CODE_ANAL,LOCALITE:LOCALITE,
                NUME_LETT:NUME_LETT,DATE_LETT:DATE_LETT,CODE_SUPP:CODE_SUPP,sauve_contrat:sauve_contrat},// passing the values
            success: function(res){  
            //do what you want here...
            $('#block').empty(); 
            $('#block').append(res);
            
            }
        }); 

    }

    
    function openmodaldelete(id) {         
        $(".modal-body #IdContrat").val(id);     
        $('#DeleteElementContratModal').modal('show');        
    }
    
    function loadContrat(){
        var matricule=document.getElementById("matricule-datalist").value;
        
        $.ajax({
            type : "POST",  //type of method
            url  : "historiques-manoeuvres.php",  //your page
            data : { matricule : matricule, Request : "infosContrat"},// passing the values
            success: function(res){  

           // alert(res);
            $('#TableContrat tbody').empty(); 
            $('#TableContrat tbody').append(res);

            }
        }); 
     }
  
     function DeleteContrat(){

        var CODE_SUPP=document.getElementById("Chercheur-datalist").value;
        var CODE_ANAL=document.getElementById("CodeAnalytique-datalist").value;
        var id=document.getElementById("IdContrat").value; 
        var sauve_contrat=document.getElementById("Deletesauve_Contrat").value; 
        $.ajax({
            type : "POST",  //type of method
            url  : "manoeuvres-contrat.php",  //your page
            data : { sauve_contrat : sauve_contrat,id:id,CODE_SUPP:CODE_SUPP,CODE_ANAL:CODE_ANAL},// passing the values
            success: function(res){  
            //do what you want here...
            $('#block').empty(); 
            $('#block').append(res);
           // alert(res);
            $('#DeleteElementContratModal').modal('hide');
            }
        }); 
     }
</script>
