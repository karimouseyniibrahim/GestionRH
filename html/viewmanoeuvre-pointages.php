<table class="table table-striped table-hover" id="TablePointage">
	<thead>
		<tr>				 
                        <th>MATRICULE</th>
                        <th>NOM</th>
                        <th>FIN CONT.</th>
                        <th>HEURES NOMALES</th>
                        <th>HEURES SUPPLEMENT.</th>
                        <th>HEURES FERIEES </th>
                        <th>HEURES TOTAL </th>
                        <th>PRIX HOR. </th>
                        <th>MONANT HOR. </th>
                        <th>ACTIONS</th>
		</tr>
	</thead>
						  
	<tbody>
                <?php if(isset($DEBUTSEM)): 
                        echo GetHtmlPointageManoeuvresByCode_Sup($DEBUTSEM);
                        ?>
    
                <?php else: ?>
                        <tr>
                                <th colspan="10 c">
                                    Il n'existe aucun de <?php echo $title ?>
                                </th>
                        </tr>
                <?php endif; ?>						 
        </tbody>

</table>