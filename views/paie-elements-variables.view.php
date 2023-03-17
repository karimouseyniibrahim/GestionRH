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
                                    <input type="text" class="form-control" id="PersonalName">
                                </div>
                                <div class="col">
                                    <label>Programme</label>
                                    <input class="form-control" id="PersonnalProgramme"/>
                                </div>

                                <div class="col">
                                    <label>Fonction</label>
                                    <input class="form-control" id="PersonnalFonction"/>
                                </div>  
                                <div class="col">
                                    <label>Date Embauche</label>
                                    <input class="form-control" id="PersonnalDateEmbauche"/>
                                </div>                              
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label>Categorie</label>
                                    <input type="text" class="form-control" id="PersonnalCategorie"/>
                                </div>
                                <div class="col">
                                    <label>Jour Ouvrable</label>
                                    <input class="form-control" id="PersonnalJourOuvrable" value="<?php echo GetNbrDayWork();?>"/>
                                </div>            
                            </div>
					   </div>
					   
					   <table class="table table-striped table-hover" id="TableElementPermanant">
					      <thead>
						     <tr>
							 <th><span class="custom-checkbox">
							 <input type="checkbox" id="selectAll">
							 <label for="selectAll"></label></th>
							 <th>CODE</th>
                             <th>TYPE</th>
							 <th>LIBELLE</th>
							 <th>VALEUR</th>
                             <th>COMPTE</th>

                             <th>Actions</th>
							 </tr>
						  </thead>
						  
						  <tbody>
                          <?php if(isset($consommations)): ?>
    
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
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="addPAIEModal" role="dialog" aria-labelledby="myLargeModalLabel">
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
                            <label>Rubrique</label>
                            <input type="text" class="form-control" placeholder="Rubrique" list="list-rubrique" id="AddCODE">
                            <datalist id="list-rubrique">
                                <?php foreach(GetRubriques("G") as $rubrique): ?>
                                    <option value="<?php echo $rubrique->CODE ?>">
                                    <?php echo utf8_encode($rubrique->LIBELLE)." (Gain)"?></option>
                                <?php endforeach; ?>  
                                <?php foreach(GetRubriques("R") as $rubrique): ?>
                                    <option value="<?php echo $rubrique->CODE ?>">
                                    <?php echo utf8_encode($rubrique->LIBELLE)." (Retenu)" 	?></option>
                                <?php endforeach; ?>                                    
                            </datalist>
                            <script>
                                    document.addEventListener('DOMContentLoaded', e => {
                                        $('#AddCODE').autocomplete()
                                    }, false);
                                </script>                             
                        </div>

                        <div class="form-group">
                            <label>Compte</label>
                            <input type="text" class="form-control" placeholder="Compte" list="list-compte" id="AddCOMPTE">
                            <datalist id="list-compte">
                                <?php foreach(GetCodeAnalytique(50,0,700) as $national): ?>
                                    <option value="<?php echo $national->CODLIB ?>">
                                    <?php echo utf8_encode($national->LIBLONG) 	?></option>
                                <?php endforeach; ?>                                    
                            </datalist>
                            <script>
                                    document.addEventListener('DOMContentLoaded', e => {
                                        $('#AddCOMPTE').autocomplete()
                                    }, false);
                                </script>
                        </div>

                        <div class="form-group">
                            <label>Montant</label>
                            <input type="number" class="form-control" id="AddVALEUR" name="valeur" required>
                            <input type="hidden" class="form-control" id="ADDId" name="valeur">
                        </div>                       
                                                
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <input id="Addsauve_PAIEELEMNT" onclick="addPAIEMENT()" name="sauve_Paiement"  class="btn btn-success" value="Enregistrer">
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
                                    <input id="Editsauve_Paiement" onclick="EditConsommation()" name="sauve_Paiement"  class="btn btn-success" value="Enregistrer">
                                </div>
                                </div>
                            </div>
                        </div>
                                        <!----edit-modal end--------->	   
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
    function openmodalAdd() { 
 
        $(".modal-footer #Addsauve_PAIEELEMNT").val("Enregistrer");
        $('#addPAIEModal').modal('show');
        
    }

    function openmodaldelete(id) {         
        $(".modal-body #idElementPaie").val(id);     
        $('#DeleteElementPaie').modal('show');        
    }
    

    function loadElementPermanant(idPersonnnel){

        var matricule=idPersonnnel.value;
        $.ajax({
            type : "POST",  //type of method
            url  : "data/personnels.php",  //your page
            data : { matricule : matricule, infos : "infos", element : "V"},// passing the values
            success: function(res){  
            //do what you want here...
            var dta=JSON.parse(res);
            $("#PersonalName").val(dta['personnel'].NOM+" "+dta['personnel'].PRENOMS);
            $("#PersonnalProgramme").val(dta['personnel'].DIVISION);
            $("#PersonnalFonction").val(dta['personnel'].liblong);
            $("#PersonnalDateEmbauche").val(dta['personnel'].DATEMBAUC);
            $("#PersonnalCategorie").val(dta['personnel'].CATEGORIE); 

           // alert(res);
            $('#TableElementPermanant tbody').empty(); 
            $('#TableElementPermanant tbody').append(dta['pay']);

            }
        }); 
     }

    function addPAIEMENT(){
        var MATRICULEV=document.getElementById("input-datalist").value;
         var COMPTE=document.getElementById("AddCOMPTE").value;
        var CODE=document.getElementById("AddCODE").value;
        var VALEUR=document.getElementById("AddVALEUR").value;
        
        var id=document.getElementById("ADDId").value; 
        var sauve_Paiement=document.getElementById("Addsauve_PAIEELEMNT").value; 
        $.ajax({
            type : "POST",  //type of method
            url  : "paie-elements-permanant.php",  //your page
            data : { id:id,sauve_Paiement : sauve_Paiement, MATRICULEV : MATRICULEV,CODE:CODE,
                VALEUR:VALEUR,COMPTE:COMPTE, element:"V"},// passing the values
            success: function(res){  
            //do what you want here...
            $('#TableElementPermanant tbody').empty();
            $('#TableElementPermanant tbody').append(res);
            $(".modal-body #AddCODE").val("");
            $(".modal-body #AddVALEUR").val("0");
            $(".modal-body #AddCOMPTE").val("");
          // alert(res);
            $('#addPAIEModal').modal('hide');
            }
        }); 
    }
   
     function DeleteElementPaie(){
        var MATRICULEV=document.getElementById("input-datalist").value;
        var id=document.getElementById("idElementPaie").value; 
        var sauve_Paiement=document.getElementById("Deletesauve_Paiement").value; 
        $.ajax({
            type : "POST",  //type of method
            url  : "paie-elements-permanant.php",  //your page
            data : { sauve_Paiement : sauve_Paiement,id:id,MATRICULEV:MATRICULEV, element:"V"},// passing the values
            success: function(res){  
            //do what you want here...
            $('#TableElementPermanant tbody').empty();
            $('#TableElementPermanant tbody').append(res);
           // alert(res);
            $('#DeleteElementPaie').modal('hide');
            }
        }); 
     }
</script>
