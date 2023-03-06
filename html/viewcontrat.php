<table class="table table-striped table-hover" id="TableContrat">
	<thead>
		<tr>				 
                        <th>Fonction</th>
                        <th>Date Debut</th>
                        <th>Date Fin</th>
                        <th>Programme</th>
                        <th>Responsable </th>
                        <th>Budget </th>
                        <th>Actions</th>
		</tr>
	</thead>
						  
	<tbody>
                <?php if(isset($NR_MATISC)): 
                        echo GetHtmlContratByPersonnel($NR_MATISC);
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