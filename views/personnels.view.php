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
							   <a  class="btn btn-success" href="personnels.php?action=add">
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
					   <?php 
                        if(isset($_GET['action'])):
                            extract($_GET);
                            if($action=="edit"):
                                $personnel=OnePersonnel($id);
                            endif;
                            if($action=="edit"||$action="add"): ?>
                           <form method="POST">

                           <input type="hidden"  value="<?php echo $_GET['id'] ?>"  name="id"/>
                            <div class="row">
                                <div class="col">
                                        <label>Matricule</label>
                                        <input type="number" class="form-control" id="MATRICULEV" 
                                        value="<?php echo $personnel->MATRICULEV;?>" name="MATRICULEV" required/>
                                </div>
                                <div class="col">
                                    <label>Nom</label>
                                    <input type="text" class="form-control" id="NOM" name="NOM" 
                                    value="<?php echo $personnel->NOM;?>"required/>
                                </div>
                                <div class="col">
                                    <label>Prenom</label>
                                    <input class="form-control" id="PRENOMS" name="PRENOMS" 
                                    value="<?php echo $personnel->PRENOMS;?>"required/></input>
                                </div>

                                <div class="col">
                                    <label>Non Jeun Fille</label>
                                    <input type="text" class="form-control" id="NOMJFILLE" name="NOMJFILLE"
                                    value="<?php echo $personnel->NOMJFILLE;?>"/>
                                </div>                                
                            </div>   
                            
                            <div class="row">
                                <div class="col">
                                    <label>Date Naissance</label>
                                    <input type="text" class="form-control" id="DATENAIS" name="DATENAIS" 
                                    value="<?php echo $personnel->DATENAIS;?>" required>
                                </div>
                                <div class="col">
                                    <label>Lieu Naissance</label>
                                    <input class="form-control" id="LIEUNAIS" name="LIEUNAIS" 
                                    value="<?php echo $personnel->LIEUNAIS;?>" required></input>
                                </div>

                                <div class="col">
                                    <label>Nationalité</label>

                                    <select id="NATIONAL" class="form-control" name="NATIONAL">
                                        <?php foreach(GetCodeAnalytique(31,0,50) as $national): ?>
                                            <option value="<?php echo $national->CODLIB ?>"  <?php echo $national->CODLIB==$personnel->NATIONAL? "selected":"" ?>><?php echo utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>  
                                <div class="col">
                                    <label>Sexe</label>
                                    <select id="SEXE" class="form-control" name="SEXE">
                                        <?php foreach(GetCodeAnalytique(48,0,50) as $national): ?>
                                            <option value="<?php echo $national->LIBLONG ?>"  <?php echo $national->LIBLONG==$personnel->SEXE? "selected":"" ?>><?php echo utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>                              
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label>Situation Famillial</label>
                                    <select id="SITFAMIL" class="form-control" name="SITFAMIL">
                                        <?php foreach(GetCodeAnalytique(32,0,50) as $national): ?>
                                            <option value="<?php echo $national->CODLIB ?>"
                                            <?php echo $national->CODLIB==$personnel->SITFAMIL? "selected":"" ?>><?php echo utf8_encode($national->LIBLONG) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Nbr Femme</label>
                                    <input type="number" class="form-control" id="NBFEMME" name="NBFEMME" 
                                    value="<?php echo $personnel->NBFEMME;?>" ></input>
                                </div>

                                <div class="col">
                                    <label>Nbr Femme Salariée</label>
                                    <input type="number" class="form-control" id="NBFEMSAL" name="NBFEMSAL"
                                    value="<?php echo $personnel->NBFEMSAL;?>"/>
                                </div>   
                                <div class="col">
                                    <label>Nbr Enfant</label>
                                    <input type="number" class="form-control" id="NBENFAN" name="NBENFAN"
                                    value="<?php echo $personnel->NBENFAN;?>"/>
                                </div>  
                                <div class="col">
                                    <label>Nbr Enfant CNSS</label>
                                    <input type="number" class="form-control" id="NBENFCNSS" name="NBENFCNSS"
                                    value="<?php echo $personnel->NBENFCNSS;?>"/>
                                </div>                                
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label>Date Embauche</label>
                                    <input type="text" class="form-control" id="DATEMBAUC" name="DATEMBAUC" 
                                    value="<?php echo $personnel->DATEMBAUC ?>" required/>
                                </div>
                                <div class="col">
                                    <label>DATE_S</label>
                                    <input type="text" class="form-control" id="DATE_S" name="DATE_S"
                                    value="<?php echo $personnel->DATE_S;?>">
                                </div> 
                                <div class="col">
                                    <label>Numero Decision</label>
                                    <input class="form-control" id="NUMDECIS" name="NUMDECIS" 
                                    value="<?php echo $personnel->NUMDECIS;?>" required></input>
                                </div>

                                <div class="col">
                                    <label>Code Emploi</label>

                                    <select id="CODEMPLOI" class="form-control" name="CODEMPLOI">
                                        <?php foreach(GetCodeAnalytique(38,0,700) as $national): ?>
                                            <option value="<?php echo $national->CODLIB ?>"
                                            <?php echo $national->CODLIB==$personnel->CODEMPLOI? "selected":"" ?>>
                                            <?php echo utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div> 
                                <div class="col">
                                    <label>Corps Branc</label>
                                    <select id="CORPSBRANC" class="form-control" name="CORPSBRANC">
                                        <?php foreach(GetCodeAnalytique(18,0,700) as $national): ?>
                                            <option value="<?php echo $national->CODLIB ?>"
                                            <?php echo $national->CODLIB==$personnel->CORPSBRANC? "selected":"" ?>>
                                            <?php echo utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>                                
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <label>Division</label>
                                    <select id="DIVISION" class="form-control" name="DIVISION">
                                        <?php foreach(GetCodeAnalytique(19,0,600) as $national): ?>
                                            <option value="<?php echo $national->CODLIB ?>"
                                            <?php echo $national->CODLIB==$personnel->DIVISION? "selected":"" ?>>
                                            <?php echo utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Sous-Division</label>
                                    <select id="SOUSDIVIS" class="form-control" name="SOUSDIVIS">
                                        <?php foreach(GetCodeAnalytique(20,0,600) as $national): ?>
                                            <option value="<?php echo $national->CODLIB ?>"
                                            <?php echo $national->CODLIB==$personnel->SOUSDIVIS? "selected":"" ?>>
                                            <?php echo utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Lieu Affectation</label>
                                    <select id="LIEUAFFEC" class="form-control" name="LIEUAFFEC">
                                        <?php foreach(GetCodeAnalytique(53,0,50) as $national): ?>
                                            <option value="<?php echo $national->LIBLONG ?>"
                                            <?php echo $national->LIBLONG==$personnel->LIEUAFFEC? "selected":"" ?>><?php echo utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div> 
                                <div class="col">
                                    <label>POSITION</label>

                                    <select id="CADRE" class="form-control" name="CADRE">
                                        <?php foreach(GetCodeAnalytique(22,0,50) as $national): ?>
                                            <option value="<?php echo $national->CODLIB ?>"
                                            <?php echo $national->CODLIB==$personnel->POSITION? "selected":"" ?>><?php echo utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select>
                                   
                                </div>
                                
                                <div class="col">
                                    <label>Categorie</label>

                                    <select id="CATEGORIE" class="form-control" name="CATEGORIE">
                                        <?php foreach(GetGrille() as $grille): ?>
                                            <option value="<?php echo $grille->CAT_ECHEL ?>"
                                            <?php echo $grille->CAT_ECHEL==$personnel->CATEGORIE? "selected":"" ?>>
                                            <?php  echo $grille->CAT_ECHEL."-". utf8_encode($grille->SAL_BASE) 	?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label>N° Secur</label>
                                    <input type="text" class="form-control" id="NUMSECUR" name="NUMSECUR"
                                    value="<?php echo $personnel->NUMSECUR;?>" required>
                                </div>
                                <div class="col">
                                    <label>Date Af SEC</label>
                                    <input type="text" class="form-control" id="DATEAFSEC" name="DATEAFSEC"
                                    value="<?php echo $personnel->DATEAFSEC;?>" required></input>
                                </div>

                                <div class="col">
                                    <label>Date Retraite</label>
                                    <input type="text" class="form-control" id="DATERETRAI" name="DATERETRAI"
                                    value="<?php echo $personnel->DATERETRAI;?>">
                                </div> 
                                <div class="col">
                                    <label>NUDECESSA</label>
                                    <input type="number" class="form-control" id="NUDECESSA" name="NUDECESSA"
                                    value="<?php echo $personnel->NUDECESSA;?>">
                                </div>
                                
                                <div class="col">
                                    <label>DATEDECESA</label>
                                    <input type="text" class="form-control" id="DATEDECESA" name="DATEDECESA"
                                    value="<?php echo $personnel->DATEDECESA;?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label>DATEPEFFE</label>
                                    <input type="text" class="form-control" id="DATEPEFFE" name="DATEPEFFE"
                                    value="<?php echo $personnel->DATEPEFFE;?>" required>
                                </div>
                                <div class="col">
                                    <label>CUMULJPE</label>
                                    <input type="number" class="form-control" id="CUMULJPE" name="CUMULJPE"
                                    value="<?php echo $personnel->CUMULJPE;?>" required></input>
                                </div>

                                <div class="col">
                                    <label>NIVETUDE1</label>
                                    <input type="text" class="form-control" id="NIVETUDE1" name="NIVETUDE1"
                                    value="<?php echo $personnel->NIVETUDE1;?>">
                                </div> 
                                <div class="col">
                                    <label>NIVETUDE2</label>
                                    <input type="text" class="form-control" id="NIVETUDE2" name="NIVETUDE2"
                                    value="<?php echo $personnel->NIVETUDE2;?>">
                                </div>
                                
                                <div class="col">
                                    <label>DIPLOME1</label>
                                    <input type="text" class="form-control" id="DIPLOME1" name="DIPLOME1"
                                    value="<?php echo $personnel->DIPLOME1;?>">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <label>DIPLOME2</label>
                                    <input type="text" class="form-control" id="DIPLOME2" name="DIPLOME2" 
                                    value="<?php echo $personnel->DIPLOME2;?>">
                                </div>
                                <div class="col">
                                    <label>STAGEPRO1</label>
                                    <input type="text" class="form-control" id="STAGEPRO1" name="STAGEPRO1"
                                    value="<?php echo $personnel->STAGEPRO1;?>" ></input>
                                </div>

                                <div class="col">
                                    <label>STAGEPRO2</label>
                                    <input type="text" class="form-control" id="STAGEPRO2" name="STAGEPRO2"
                                    value="<?php echo $personnel->STAGEPRO2;?>">
                                </div> 
                                <div class="col">
                                    <label>DIVERS1</label>
                                    <input type="text" class="form-control" id="DIVERS1" name="DIVERS1"
                                    value="<?php echo $personnel->DIVERS1;?>">
                                </div>
                                
                                <div class="col">
                                    <label>DIVERS2</label>
                                    <input type="text" class="form-control" id="DIVERS2" name="DIVERS2"
                                    value="<?php echo $personnel->DIVERS2;?>">
                                </div>
                            </div>
                            
                            <div class="row">
                                
                               <div class="col">
                                    <label>SAL_BASE</label>
                                    <input type="number" class="form-control" id="SAL_BASE" name="SAL_BASE"
                                    value="<?php echo $personnel->SAL_BASE;?>" required>
                                </div> 
                                <div class="col">
                                    <label>COMPTE</label>
                                    <input type="number" class="form-control" id="COMPTE" name="COMPTE"
                                    value="<?php echo $personnel->COMPTE;?>">
                                </div> 
                                <div class="col">
                                    <label>Code Budget</label>
                                    <select id="T4" class="form-control" name="T4" >
                                        <?php foreach(GetCodeAnalytique(49,0,200) as $national): ?>
                                            <option value="<?php echo $national->CODLIB ?>" 
                                            <?php echo $national->CODLIB==$personnel->T4? "selected":"" ?>>
                                            <?php  echo  $national->CODLIB."-".utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select> 
                                </div>

                                <div class="col">
                                    <label>STATUT</label>
                                    <select id="STATUT" class="form-control" name="STATUT" >
                                        <?php foreach(GetCodeAnalytique(63,0,200) as $national): ?>
                                            <option value="<?php echo $national->CODLIB ?>" 
                                            <?php echo $national->CODLIB==$personnel->STATUT? "selected":"" ?>>
                                            <?php  echo  $national->CODLIB."-".utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select> 
                                    
                                </div>
                            </div>

                            <div class="row">
                                
                               <div class="col">
                                    <label>REL BANQUE</label>
                                    <select id="REL_BANQUE" class="form-control" name="REL_BANQUE">
                                        <?php foreach(GetCodeAnalytique(51,0,50) as $national): ?>
                                            <option value="<?php echo $national->LIBLONG ?>"
                                            <?php echo $national->LIBLONG==$personnel->REL_BANQUE? "selected":"" ?>>
                                            <?php  echo  utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select> 

                                </div>
                                
                                <div class="col">
                                    <label>NR_COMPTE</label>
                                    <input type="text" class="form-control" id="NR_COMPTE" name="NR_COMPTE"
                                    value="<?php echo $personnel->NR_COMPTE;?>">
                                </div>
                            </div>

                            <div class="row">
                                <!--div class="col">
                                    <label>FONCTION</label>
                                    <select id="FONCTION" class="form-control" name="FONCTION">
                                        <?php foreach(GetCodeAnalytique(39,0,200) as $national): ?>
                                            <option value="<?php echo $national->LIBLONG ?>"
                                            <?php echo $national->LIBLONG==$personnel->FONCTION? "selected":"" ?>>
                                            <?php  echo  utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select> 
                                </div-->
                                
                                <!--div class="col">
                                    <label>GENRE</label>
                                    <input type="text" class="form-control" id="GENRE" name="GENRE"
                                    value="<?php echo $personnel->GENRE;?>">
                                </div> 
                               
                                
                                <div class="col">
                                    <label>CODEDEP</label>
                                    <input type="text" class="form-control" id="CODEDEP" name="CODEDEP"
                                    value="<?php echo $personnel->CODEDEP;?>">
                                </div-->
                            </div>
                            
                            <div class="row">

                            </div>

                            <div class="row">
                                <div class="col">
                                    <label>NUMASSUR</label>
                                    <input type="number" class="form-control" id="NUMASSUR" name="NUMASSUR"
                                    value="<?php echo $personnel->NUMASSUR;?>">
                                </div>
                                <div class="col">
                                    <label>POUR_LOGE</label>
                                    <input type="number" class="form-control" id="POUR_LOGE" name="POUR_LOGE" 
                                    value="<?php echo $personnel->POUR_LOGE;?>" ></input>
                                </div>

                                <div class="col">
                                    <label>LOGEMENT</label>
                                    <input type="number" class="form-control" id="LOGEMENT" name="LOGEMENT"
                                    value="<?php echo $personnel->LOGEMENT;?>">
                                </div> 
                               
                            </div>

                            <div class="row">

                                <br/>
                                <input id="Add_Personnel" type="submit" name="sauve_personnel"  class="btn btn-success  btn-lg btn-block mt-4"
                                value="<?php echo $_GET['action']=='edit'?'Modifier':'Enregistrer'?>"/>
                                <br/>
                            </div>
                                   
                               
                            </div>
                        </form>
                            
                        <?php endif;?>
                       <?php else : ?>
					   <table class="table table-striped table-hover" id="TablePersonnels">
					      <thead>
						     <tr>
							 <th>MATRICULEV</th>
							 <th>NOM</th>
                             <th>PRENOMS</th> 
                             <th>FONCTION</th> 
                             <th>DIVISION</th>
                             <th>SOUSDIVIS</th>
                             <th>DATEMBAUC</th>
                             <th>Actions</th>
							 </tr>
						  </thead>
						  
						  <tbody>
                          <?php echo GetHtmlPersonnels($page) ?>						 
						  
                          </tbody>
                        </table>
                        <?php endif;?>

					   </div>
					</div>
		  
		    <!------main-content-end-----------> 

<!----delete-modal start--------->
<form method="post">
    <div class="modal fade" tabindex="-1" id="deletePersonnelModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Supprimer <?php echo $title?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idPersonnel" name="id" class="form-control">
                <p>Êtes-vous sûr de vouloir supprimer cet enregistrement ?</p>
                <p class="text-warning"><small>cette action ne peut pas être annulée,</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <input type="submit" class="btn btn-success" name="sauve_personnel" value="Supprimer">
            </div>
            </div>
        </div>
    </div>
</form>
<!----edit-modal end--------->   

<script type="text/javascript">

    function openmodaldelete(id) {       
        /* $(".deleteElement #id").val(id);      */    
        $(".modal-body #idPersonnel").val(id);     
        $('#deletePersonnelModal').modal('show');        
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
            $('#TablePersonnels tbody').empty();
            $('#TablePersonnels tbody').append(res);
            // alert(res);
            $('#DeleteCodeAnalytiqueModal').modal('hide');
            }
        }); 
    }

</script>
