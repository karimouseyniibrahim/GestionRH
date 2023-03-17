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
							 <!--div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							   <a  class="btn btn-success" data-toggle="modal" onclick="openmodalAdd()">
							   <i class="material-icons">&#xE147;</i>
							   <span>Add <?php echo $title?></span>
							   </a>
							   <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal">
							   <i class="material-icons">&#xE15C;</i>
							   <span>Delete</span>
							   </a>
							 </div-->
					     </div>
                         <div class="col">
                                <div class="form-group">
                                    <label for="input-datalist">Matricule</label>
                                    <input type="text" class="form-control" placeholder="Matricule Personnel" list="list-timezone" id="input-datalist"  onchange="loadElementPermanant(this)">
                                    <datalist id="list-timezone">
                                        <?php foreach(GetPersonnels("VRAI") as $personnel):?>
                                        <option value="<?php echo $personnel->MATRICULEV?>"><?php echo $personnel->NOM." ".$personnel->PRENOMS?></option>
                                        <?php endforeach;?>
                                    </datalist>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', e => {
                                        $('#input-datalist').autocomplete()
                                    }, false);
                                </script>
                         </div>
                        <div class="row">
                                <div class="col">
                                    <label>NOM & PRENOM</label>
                                    <input type="text" class="form-control" id="PersonalName" disabled>
                                </div>
                                <div class="col">
                                    <label>Programme</label>
                                    <input class="form-control" id="PersonnalProgramme" disabled/>
                                </div>

                                <div class="col">
                                    <label>Fonction</label>
                                    <input class="form-control" id="PersonnalFonction" disabled/>
                                </div>  
                                <div class="col">
                                    <label>Date Embauche</label>
                                    <input class="form-control" id="PersonnalDateEmbauche" disabled/>
                                </div>                              
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label>Categorie</label>
                                    <input type="text" class="form-control" id="PersonnalCategorie" disabled/>
                                </div>
                                <div class="col">
                                    <label>Jour Ouvrable</label>
                                    <input class="form-control" id="PersonnalJourOuvrable" value="<?php echo GetNbrDayWork();?>" disabled/>
                                </div>
                                
                                <div class="col">
                                    <label>Salaire Base</label>
                                    <input class="form-control" id="Salbase" type="text" disabled/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Heures à Payer</label>
                                    <input type="number" class="form-control" id="AddHEURE" name="valeur" onchange="calculMontantSupp(this)" required> 
                                </div>

                                <div class="col">
                                    <label>Montant à Payer</label>
                                    <input type="number" class="form-control" id="AddVALEUR" name="valeur" required>
                                    <input type="hidden" class="form-control" id="ADDId" name="valeur">
                                </div>   
                                <div class="col">
                                <label><?php echo $title?></label>
                                    <input    id="Addsauve_PAIEELEMNT" onclick="addPAIEMENT()" name="sauve_Paiement" 
                                     class="btn btn-warning" value="Enregistrer">
                                </div> 
                            </div>
					   </div>
					   
					   </div>
					</div>
                 
                    <!----delete-modal start--------->
                        <div class="modal fade" tabindex="-1" id="DeleteElementPaie" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Supprimer <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="idElementPaie" name="idElementPaie" class="form-control">
                                    <p>Êtes-vous sûr de vouloir supprimer cet enregistrement ?</p>
                                    <p class="text-warning"><small>cette action ne peut pas être annulée,</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="Deletesauve_Paiement" onclick="DeleteElementPaie()" class="btn btn-success" name="sauve_Paiement" value="Supprimer">
                                </div>
                                </div>
                            </div>
                        </div>
                    <!----edit-modal end--------->  
			     </div>
			  </div>
		    <!------main-content-end-----------> 
<script type="text/javascript">

    function calculMontantSupp(heure){
        sal=parseInt(document.getElementById("Salbase").value);
        var m=Math.round((sal*1.5)*heure.value/173);
        $("#AddVALEUR").val(m);
    }
    function openmodal(id) { 
  
        $(".modal-footer #Addsauve_PAIEELEMNT").val("Modifier");
        var id=id;
        $.ajax({
            type : "POST",  //type of method
            url  : "data/personnels.php",  //your page
            data : { id : id, ElementP : "ElementP",element:"V"},// passing the values
            success: function(res){  
            //do what you want here...
            
            var dta=JSON.parse(res);
           // alert(res);
            $(".modal-body #AddCODE").val(dta.CODE);
            $(".modal-body #AddVALEUR").val(dta.VALEUR);
            $(".modal-body #AddCOMPTE").val(dta.COMPTE);
            $(".modal-body #ADDId").val(dta.id);  
            $('#addPAIEModal').modal('show');
            }
        }); 
        
    }
    
    function loadElementPermanant(idPersonnnel){

        var matricule=idPersonnnel.value;
        $.ajax({
            type : "POST",  //type of method
            url  : "data/personnels.php",  //your page
            data : { matricule : matricule, supp : "infos", element : "V"},// passing the values
            success: function(res){  
            //do what you want here...
            var dta=JSON.parse(res);
            $("#PersonalName").val(dta['personnel'].NOM+" "+dta['personnel'].PRENOMS);
            $("#PersonnalProgramme").val(dta['personnel'].DIVISION);
            $("#PersonnalFonction").val(dta['personnel'].liblong);
            $("#PersonnalDateEmbauche").val(dta['personnel'].DATEMBAUC);
            $("#PersonnalCategorie").val(dta['personnel'].CATEGORIE); 
            $("#Salbase").val(dta['personnel'].valeur); 

            if(dta['supp']){
            $("#AddHEURE").val(dta['supp'].HEURE);
            $("#AddVALEUR").val(dta['supp'].VALEUR);
            $("#ADDId").val(dta['supp'].id);

            
                $("#Addsauve_PAIEELEMNT").val("Modifier");
            }else{
                $("#Addsauve_PAIEELEMNT").val("Enregistrer");
                $("#AddHEURE").val("0");
                $("#AddVALEUR").val("0");
                $("#ADDId").val("");
            }

            }
        }); 
     }

    function addPAIEMENT(){
        var MATRICULEV=document.getElementById("input-datalist").value;
        var VALEUR=document.getElementById("AddVALEUR").value;
        var HEURE=document.getElementById("AddHEURE").value;
        
        var id=document.getElementById("ADDId").value; 
        var sauve_Paiement=document.getElementById("Addsauve_PAIEELEMNT").value; 
        $.ajax({
            type : "POST",  //type of method
            url  : "heure-supplementaires.php",  //your page
            data : { HEURE:HEURE,id:id,sauve_Paiement : sauve_Paiement, MATRICULEV : MATRICULEV,
                VALEUR:VALEUR, element:"V"},// passing the values
            success: function(res){  
                alert("Heure Supplementaire Enregistrer");
            }
        }); 
    }

</script>
