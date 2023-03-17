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
					   
					   <table class="table table-striped table-hover">
					      <thead>
						     <tr>
							 <th><span class="custom-checkbox">
							 <input type="checkbox" id="selectAll">
							 <label for="selectAll"></label></th>
							 <th>HS NUMERO</th>
							 <th>DOIT</th>
							 <th>Mode Paiement</th>
							 <th>Nom & Prenom</th>
							 <th>Date d'arrivée</th>
                             <th>Actions</th>
							 </tr>
						  </thead>
						  
						  <tbody>
                          <?php if(count($factures)): ?>
                            <?php foreach($factures as $facture):?>

                                
						      <tr>
                                <th><span class="custom-checkbox">
                                <input type="checkbox" id="checkbox1" name="option[]" value="1">
                                <label for="checkbox1"></label></th>
                                <th><?php echo $facture->hs_numero ?></th>
                                <th><?php echo $facture->doit ?></th>
                                <th><?php echo $facture->mode_paiement ?></th>
                                <th><?php echo $facture->nom ." ".$facture->prenom ?></th>
                                <th><?php echo $facture->date_arrivee ?></th>
                                <th>
                                    <a class="edit" data-toggle="modal" onclick='openmodal(<?php echo json_encode($facture)?>,<?php echo $facture->idfact ?>)'>
                                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                    </a>
                                    <a class="delete" data-toggle="modal" onclick="openmodaldelete(<?php echo $facture->idfact ?>)">
                                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                    </a>
                                    <a   href="./print/facturehebergement.php?idfact=<?php echo $facture->idfact ?>" target="_blank">
                                    <i class="material-icons">library_books</i>
                                    </a>
                                </th>
							 </tr>	
                             <?php endforeach; ?>
                             <?php else: ?>
                            <tr>
                                    <th colspan="7 c">
                                    Il n'existe aucun element de <?php echo $title ?>
                                    </th>
                            </tr>
                        <?php endif; ?>						 
						  </tbody>

					   </table>
                       <?php if(isset($nbr_pages)): ?>
                            <div class="clearfix">
                                <div class="hint-text">showing <b>5</b> out of <b>20</b></div>
                                <ul class="pagination">
                                    <li class="page-item disabled"><a href="#">Previous</a></li>
                                    <?php for($i=0; $i<$nbr_pages;$i++): ?>
                                        <li class="page-item "><a href="#"class="page-link"><?php echo ($i+1) ?></a></li>
                                    <?php endfor; ?>
                                    <li class="page-item "><a href="#" class="page-link">Next</a></li>
                                </ul>
                            </div>
					   
                        <?php endif; ?>

					   </div>
					</div>
					
									   <!----add-modal start--------->

                                       
                <form method="post">
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="addFacturation" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajout <?php echo $title?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="row">
                        <div class="col">
                            <label>HS Numero</label>
                            <input type="text" class="form-control" id="hsnumero" name="hsnumero" required>
                        </div>
                        <div class="col">
                            <label>Forfait</label>
                            <input type="text" class="form-control" id="forfait" name="forfait" required>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col">
                            <label>Programme</label>
                            <input class="form-control" id="programme" name="programme" required></input>
                        </div>
                        <div class="col">
                            <label>Mode Paiement</label>
                            <select id="mode_paiement" class="form-control" name="mode_paiement" required>
                                <option value="CASH">CASH</option>
                                <option value="BUDGET">BUDGET</option>
                                <option value="CHEQUE">CHEQUE</option>
                            </select>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col">
                            <label>Doit</label>
                            <input class="form-control" id="doit" name="doit" required></input>
                        </div>
                        <div class="col">
                            <label>Client</label>
                            <select id="IDclient" class="form-control" name="IDclient">
                                <?php foreach($clients as $client): ?>
                                <option value="<?php echo $client->idclient ?>"><?php echo $client->nom.' '.$client->prenom.'/'.$client->adresse?></option>
                                <?php endforeach; ?>
                            </select>    
                        </div>
                        </div>
                        <div class="row">
                        <div class="col">
                            <label>Chambre</label>
                            
                            <select id="chambre" class="form-control" name="chambre" onchange='addprix(this,<?php echo json_encode($chambres)?>);'>
                                <?php foreach($chambres as $chambre): ?>
                                <option value="<?php echo $chambre->idchambre ?>"><?php  echo htmlspecialchars_decode(utf8_decode($chambre->libeller.'/'.$chambre->numero.'/'.$chambre->type))?></option>
                                <?php endforeach; ?>
                            </select>  
                        </div>
                        <div class="col">
                            <label>Prix/Unit Chambre</label>
                            <input type="text" class="form-control" id="prixUnitaire_chambre" name="prixUnitaire_chambre" required>
                            <input type="checkbox" id="personnePlus" name="personnePlus"> 1+P
                        </div>
                        </div>
                        <div class="row">
                        <div class="col">
                            <label>Date arrivée</label>
                            <input type="date" class="form-control" id="date_arrivee" name="date_arrivee" required>
                        </div>
                        <div class="col">
                            <label>Date Depart</label>
                            <input type="date" class="form-control" id="date_depart" name="date_depart" required>
                        </div>
                        </div>
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <input type="submit" name="sauve_facturation"  class="btn btn-success" value="Enregistrer">
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
					   <!----edit-modal end--------->
 
				   <!----edit-modal start--------->
                    <form method="post">
                        <div class="modal" tabindex="-1" id="editfacturation" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                    
                                    <input type="hidden" id="Eidfact" name="idfact" class="form-control">
                    
                                    <div class="row">
                                    <div class="col">
                                        <label>HS Numero</label>
                                        <input type="text" class="form-control" id="Ehsnumero" name="hsnumero" required>
                                    </div>
                                    <div class="col">
                                        <label>Forfait</label>
                                        <input type="text" class="form-control" id="Eforfait" name="forfait" required>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col">
                                        <label>Programme</label>
                                        <input class="form-control" id="Eprogramme" name="programme" required></input>
                                    </div>
                                    <div class="col">
                                        <label>Mode Paiement</label>
                                        
                                        <select id="Emode_paiement" class="form-control" name="mode_paiement">
                                            <option value="CASH">CASH</option>
                                            <option value="BUDGET">BUDGET</option>
                                            <option value="CHEQUE">CHEQUE</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col">
                                        <label>Doit</label>
                                        <input class="form-control" id="Edoit" name="doit" required></input>
                                    </div>
                                    <div class="col">
                                        <label>Client</label>
                                        <select id="EIDclient" class="form-control" name="IDclient" required>
                                            <?php foreach($clients as $client): ?>
                                            <option value="<?php echo $client->idclient ?>"><?php echo $client->nom.' '.$client->prenom.'/'.$client->adresse?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col">
                                        <label>Chambre</label>
                                        <select id="Echambre" class="form-control" name="chambre" onchange='Editprix(this,<?php echo json_encode($chambres)?>);'>
                                            <?php foreach($chambres as $chambre): ?>
                                            <option value="<?php echo $chambre->idchambre ?>"><?php echo $chambre->libeller.'/'.$chambre->numero.'/'.$chambre->type?></option>
                                            <?php endforeach; ?>
                                        </select>  
                                    </div>
                                    <div class="col">
                                        <label>Prix/Unit Chambre</label>
                                        <input type="text" class="form-control" id="EprixUnitaire_chambre" name="prixUnitaire_chambre" required>
                                        <input type="checkbox" id="EpersonnePlus" name="personnePlus"> 1+P
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col">
                                        <label>Date arrivée</label>
                                        <input type="date" class="form-control" id="Edate_arrivee" name="date_arrivee" required>
                                    </div>
                                    <div class="col">
                                        <label>Date Depart</label>
                                        <input type="date" class="form-control" id="Edate_depart" name="date_depart" required>
                                    </div>
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input type="submit" name="sauve_facturation"  id="btnSubmit" class="btn btn-success" value="Enregistrer">
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                                        <!----edit-modal end--------->	   
                                        
                    <!----delete-modal start--------->
                    <form method="post">
                        <div class="modal fade" tabindex="-1" id="deleteFacturationModal" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Supprimer <?php echo $title?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="Didfact" name="idfact" class="form-control">
                                    <p>Êtes-vous sûr de vouloir supprimer cet enregistrement ?</p>
                                    <p class="text-warning"><small>cette action ne peut pas être annulée,</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <input type="submit" class="btn btn-success" name="sauve_facturation" value="Supprimer">
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!----edit-modal end--------->   

			     </div>
			  </div>
		  
		    <!------main-content-end-----------> 
<script type="text/javascript">
    function openmodal(fact,id) {      
        $(".modal-body #Eidfact").val(fact.idfact);
        $(".modal-body #Ehsnumero").val(fact.hs_numero);
        $(".modal-body #Eforfait").val(fact.forfait);
        $(".modal-body #Eprogramme").val(fact.programme);
        $(".modal-body #Echambre").val(fact.chambre);  
		$(".modal-body #Edate_arrivee").val(fact.date_arrivee);  
		$(".modal-body #Edate_depart").val(fact.date_depart);  
		$(".modal-body #Edoit").val(fact.doit);  
		$(".modal-body #EprixUnitaire_chambre").val(fact.prixUnitaire_chambre);  
		$(".modal-body #Emode_paiement").val(fact.mode_paiement);
		$(".modal-body #EIDclient").val(fact.idclient);
        
       document.getElementById("EpersonnePlus").checked=false;
       if(fact.PlusP==1){
        document.getElementById("EpersonnePlus").checked=true;
       }
        $(".modal-footer #btnSubmit").val("Modifier");
        $('#editfacturation').modal('show');
        
    }
    function openmodalAdd() { 
 
        $(".modal-footer #btnSubmit").val("Enregistrer");
        $('#addFacturation').modal('show');
        
    }
    function addprix(id,chambres){

        for (var i=0; i<chambres.length; i++) {    
            if(chambres[i].idchambre==id.value){
                $(".modal-body #prixUnitaire_chambre").val("");
                $(".modal-body #prixUnitaire_chambre").val(chambres[i].prix);
            }
        }        
    }
    function Editprix(id,chambres){

        for (var i=0; i<chambres.length; i++) {    
            if(chambres[i].idchambre==id.value){
                $(".modal-body #EprixUnitaire_chambre").val("");
                $(".modal-body #EprixUnitaire_chambre").val(chambres[i].prix);
            }
        }        
    }
    function openmodaldelete(id) {       
              /* $(".deleteElement #id").val(id);      */    
              $(".modal-body #Didfact").val(id);     
               $('#deleteFacturationModal').modal('show');        
    }
     
</script>
