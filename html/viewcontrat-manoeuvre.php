<table class="table table-striped table-hover" id="TableContrat">
	<thead>
		<tr>				 
                        <th>MATRICULE</th>
                        <th>NOM</th>
                        <th>DATE NAIS.</th>
                        <th>DEBUT CONT.</th>
                        <th>FIN CONT. </th>
                        <th>LOCALITE </th>
                        <th>PRIX HOR. </th>
                        <th>ACTIONS</th>
		</tr>
	</thead>
						  
	<tbody>
                <?php if(isset($CODE_ANAL)&&isset($CODE_SUPP)): 
                        echo GetHtmlContratManoeuvresByCode_Sup($CODE_ANAL,$CODE_SUPP);
                        ?>
    
                <?php else: ?>
                        <tr>
                                <th colspan="8 c">
                                    Il n'existe aucun element de <?php echo $title ?>
                                </th>
                        </tr>
                <?php endif; ?>						 
        </tbody>

</table>