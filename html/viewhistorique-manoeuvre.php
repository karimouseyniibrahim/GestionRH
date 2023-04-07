<table class="table table-striped table-hover" id="TableContrat">
	<thead>
		<tr>				 
                        <th>PROGR</th>
                        <th>PTM</th>
                        <th>N° LETT.</th>
                        <th>DEBUT CONT.</th>
                        <th>FIN CONT. </th>
                        <th>LOCALITE </th>
                        <th>PRIX HOR. </th>
		</tr>
	</thead>
						  
	<tbody>
                <?php if(isset($matriculev)): 
                        echo GetHtmlContratManoeuvresByMatricule($matriculev);
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