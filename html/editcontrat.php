<?php
session_start();
include("../filters/auth_filter.php");
require("../config/db.php");
require("../includes/functions.php");


if(isset($_POST['contratId'])){
    $contrat=GetContratById($_POST['contratId']);
   
}

?> 
                            <div class="row">
                                <div class="col">
                                    <label>Ref. Contrat</label>
                                    <input class="form-control" id="ref" name="ref" 
                                    value="<?php echo isset($contrat)?$contrat->REF:'';?>" required></input>
                                </div>
                                <input type="hidden" id="idcontrat" name="idcontrat" value="<?php echo isset($contrat)?$contrat->id:'' ?>" class="form-control">
                                <div class="col">
                                    <label>Date</label>
                                    <input type="date" class="form-control" id="dateref" name="dateref" 
                                    value="<?php echo isset($contrat)?$contrat->DATE:'' ?>" required/>
                                </div>
                                <div class="col">
                                    <label>POSITION</label>

                                    <select id="position" class="form-control" name="position">
                                        <?php foreach(GetCodeAnalytique(22,0,50) as $national): ?>
                                            <option value="<?php echo $national->CODLIB ?>"
                                            <?php echo isset($contrat)?($national->CODLIB==$contrat->POSITION? "selected":""):'' ?>><?php echo utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>FONCTION</label>
                                    <select id="FONCTION" class="form-control" name="fonction">
                                    <?php foreach(GetCodeAnalytique(39,0,200) as $national): ?>
                                            <option value="<?php echo $national->CODLIB?>"
                                            <?php echo isset($contrat)?($national->CODLIB==$contrat->CODE_FONCT? "selected":""):'' ?>>
                                            <?php  echo  utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Date Debut</label>
                                    <input type="date" class="form-control" id="datebut" name="datebut" 
                                    value="<?php echo isset($contrat)?$contrat->DEBUT:'' ?>" required/>
                                </div>
                                <div class="col">
                                    <label>Date Fin</label>
                                    <input type="date" class="form-control" id="datefin" name="datefin"
                                    value="<?php echo isset($contrat)?$contrat->FIN:'';?>">
                                </div> 
                               
                                <div class="col">
                                    <label>Grade</label>
                                    <select id="grade" class="form-control" name="grade">
                                        <?php foreach(GetCodeAnalytique(54,0,700) as $national): ?>
                                            <option value="<?php echo $national->CODLIB ?>"
                                            <?php echo isset($contrat)?($national->CODLIB==$contrat->GRADE? "selected":""):'' ?>>
                                            <?php echo utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>    

                                <div class="col">
                                    <label>Salaire Base</label>
                                    <input type="number" class="form-control" id="sal_base" name="sal_base"
                                    value="<?php echo isset($contrat)?$contrat->SAL_BASE:'';?>" required>
                                </div>  
                                
                                
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <label>Programme</label>
                                    <select id="Programme" class="form-control" name="Programme">
                                        <?php foreach(GetProgrammes(20,0,600) as $national): ?>
                                            <option value="<?php echo $national->id ?>"
                                            <?php echo isset($contrat)?($national->id==$contrat->PROGRAMME? "selected":""):'' ?>>
                                            <?php echo utf8_encode($national->name_prog.'-'.$national->resprog1.(strlen($national->resprog2)>1?'-'.$national->resprog2:"")) 	?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Lieu Affectation</label>
                                    <select id="LIEUAFFEC" class="form-control" name="LIEUAFFEC">
                                        <?php foreach(GetCodeAnalytique(53,0,50) as $national): ?>
                                            <option value="<?php echo $national->LIBLONG ?>"
                                            <?php echo isset($contrat)?($national->LIBLONG==$contrat->LIEU? "selected":""):'' ?>><?php echo utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div> 

                                <div class="col">
                                    <label>Code Budget</label>
                                    <select id="codebudget" class="form-control" name="codebudget" >
                                        <?php foreach(GetCodeAnalytiqueActive(50,0,200) as $national): ?>
                                            <option value="<?php echo $national->CODLIB ?>" 
                                            <?php echo isset($contrat)?($national->CODLIB==$contrat->COMPTE? "selected":""):'' ?>>
                                            <?php  echo  $national->CODLIB."-".utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select> 
                                </div>
                                
                                 

                            </div>
                            
                            <div class="row">
                                
                            </div>

                            <div class="row">
                                
                               <div class="col">
                                    <label>REL BANQUE</label>
                                    <select id="REL_BANQUE" class="form-control" name="REL_BANQUE">
                                        <?php foreach(GetCodeAnalytique(51,0,50) as $national): ?>
                                            <option value="<?php echo $national->LIBLONG ?>"
                                            <?php echo isset($contrat)?($national->LIBLONG==$contrat->CODE_BANQ? "selected":""):'' ?>>
                                            <?php  echo  utf8_encode($national->LIBLONG) 	?></option>
                                        <?php endforeach; ?>
                                    </select> 

                                </div>
                                
                                <div class="col">
                                    <label>N° Compte</label>
                                    <input type="text" class="form-control" id="NR_COMPTE" name="NR_COMPTE"
                                    value="<?php echo isset($contrat)?$contrat->NR_COMPTE:'';?>">
                                </div>

                                <div class="col">
                                    <label>N° Assurance</label>
                                    <input type="number" class="form-control" id="NUMASSUR" name="NUMASSUR"
                                    value="<?php echo isset($contrat)?$contrat->NUMASSUR:'';?>">
                                </div>
                                <div class="col">
                                    <label>Logement %</label>
                                    <input type="number" class="form-control" id="POUR_LOGE" name="POUR_LOGE" 
                                    value="<?php echo isset($contrat)?$contrat->POUR_LOGE:'';?>" ></input>
                                </div>
                            </div>
                            <div class="row">

                                   
                            </div>
                            <div class="row">

                                <br/>
                                <input id="Add_contrat" name="sauve_contrat"  class="btn btn-success  btn-lg btn-block mt-4"
                                value="<?php echo $_POST['action']=='edit'?'Modifier':'Enregistrer'?>" onclick="sauveContrat()"  />
                                <br/>
                            </div>