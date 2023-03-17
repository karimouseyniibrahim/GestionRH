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
							   <a  class="btn btn-success" data-toggle="modal" onclick="openmodal()">
							   <i class="material-icons">&#xE147;</i>
							   <span>Add <?php echo $title ?></span>
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
                                    <input type="text" class="form-control" placeholder="Matricule Personnel" list="list-timezone" id="input-datalist"  onchange="loadContrat(this)">
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
                                    <label>Date de Naissance</label>
                                    <input class="form-control" id="dateNaissance"/>
                                </div>

                                <div class="col">
                                    <label>Lieu Naissance</label>
                                    <input class="form-control" id="lieuNaissance"/>
                                </div>  
                                <div class="col">
                                    <label>Nationalité</label>
                                    <input class="form-control" id="Nationalite"/>
                                </div>                              
                            </div>
					   </div>
					    <div id="block">
                           <?php 
                           if(isset($_GET['editcontrat'])){
                                include("html/editcontrat.php");
                           }else{
                                include("html/viewcontrat.php");
                           }
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
                                    <input type="hidden" id="idElementPaie" name="idElementPaie" class="form-control">
                                    <p>Êtes-vous sûr de vouloir supprimer cet enregistrement ?</p>
                                    <p class="text-warning"><small>cette action ne peut pas être annulée,</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input id="Deletesauve_Contrat" onclick="DeleteElementPaie()" class="btn btn-success" name="sauve_Contrat" value="Supprimer">
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
         // window.open("contrat.php?editcontrat="+document.getElementById("input-datalist").value,"_self").focus(); 
         $.ajax({
            type : "POST",  //type of method
            url  : "html/editcontrat.php",  //your page
            data : { Request : "AddContrat",action:"add"},// passing the values
            success: function(res){  
            $('#block').empty(); 
            $('#block').append(res);

            }
        }); 
    }
    function editContrat(id) { 
         // window.open("contrat.php?editcontrat="+document.getElementById("input-datalist").value,"_self").focus(); 
         var contratId=id;
         $.ajax({
            type : "POST",  //type of method
            url  : "html/editcontrat.php",  //your page
            data : { Request : "AddContrat",contratId:contratId,action:'edit'},// passing the values
            success: function(res){  
            $('#block').empty(); 
            $('#block').append(res);

            }
        }); 
    }

    function sauveContrat(){

        var NR_MATISC=document.getElementById("input-datalist").value;
        var id=document.getElementById("idcontrat").value;
        var REF=document.getElementById("ref").value;
        var DATE=document.getElementById("dateref").value;
        var POSITION=document.getElementById("position").value;
        var CODE_FONCT=document.getElementById("FONCTION").value;
        var DEBUT=document.getElementById("datebut").value;
        var FIN=document.getElementById("datefin").value;
        var GRADE=document.getElementById("grade").value;
        var SAL_BASE=document.getElementById("sal_base").value;
        var PROGRAMME=document.getElementById("Programme").value;
        var LIEU=document.getElementById("LIEUAFFEC").value;
        var BUDGET=document.getElementById("codebudget").value;
        var CODE_BANQ=document.getElementById("REL_BANQUE").value;
        var NR_COMPTE=document.getElementById("NR_COMPTE").value;
        var NUMASSUR=document.getElementById("NUMASSUR").value;
        var POUR_LOGE=document.getElementById("POUR_LOGE").value;
        var sauve_contrat=document.getElementById("Add_contrat").value;
        $.ajax({
            type : "POST",  //type of method
            url  : "contrat.php",  //your page
            data : {id:id, NR_MATISC : NR_MATISC, REF : REF,DATE:DATE,POSITION:POSITION,CODE_FONCT:CODE_FONCT,DEBUT:DEBUT,
                FIN:FIN,GRADE:GRADE,SAL_BASE:SAL_BASE,PROGRAMME:PROGRAMME,LIEU:LIEU,BUDGET:BUDGET,CODE_BANQ:CODE_BANQ,
                NR_COMPTE:NR_COMPTE,NUMASSUR:NUMASSUR,POUR_LOGE:POUR_LOGE,sauve_contrat:sauve_contrat},// passing the values
            success: function(res){  
            //do what you want here...
            $('#block').empty(); 
            $('#block').append(res);
            
            }
        }); 

    }
    function openmodaldelete(id) {         
        $(".modal-body #idElementPaie").val(id);     
        $('#DeleteElementContratModal').modal('show');        
    }
    
    function loadContrat(idPersonnnel){

        var matricule=idPersonnnel.value;
        $.ajax({
            type : "POST",  //type of method
            url  : "contrat.php",  //your page
            data : { matricule : matricule, Request : "infosContrat"},// passing the values
            success: function(res){  
            //do what you want here...
            var dta=JSON.parse(res);
           // alert(res);
            
            $("#PersonalName").val(dta['infos'].NOM+" "+dta['infos'].PRENOMS);
            $("#dateNaissance").val(dta['infos'].DATENAIS);
            $("#lieuNaissance").val(dta['infos'].LIEUNAIS);
            $("#Nationalite").val(dta['infos'].liblong);
            $('#TableContrat tbody').empty(); 
            $('#TableContrat tbody').append(dta['contrat']);

            }
        }); 
     }
   
     function DeleteElementPaie(){
        var NR_MATISC=document.getElementById("input-datalist").value;
        var id=document.getElementById("idElementPaie").value; 
        var sauve_contrat=document.getElementById("Deletesauve_Contrat").value; 
        $.ajax({
            type : "POST",  //type of method
            url  : "contrat.php",  //your page
            data : { sauve_contrat : sauve_contrat,id:id,NR_MATISC:NR_MATISC,element:'P'},// passing the values
            success: function(res){  
            //do what you want here...
            $('#block').empty(); 
            $('#TableContrat tbody').append(res);
           // alert(res);
            $('#DeleteElementContratModal').modal('hide');
            }
        }); 
     }
</script>
