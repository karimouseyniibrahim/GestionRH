 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/jquery-3.3.1.min.js"></script>


   
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.6.0/jszip-2.5.0/dt-1.13.1/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/date-1.2.0/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/sr-1.2.0/datatables.min.js"></script>  
<script src="js/bootstrap.min.js"></script> 
 
 <script type="text/javascript">
       $(document).ready(function(){
	      $(".xp-menubar").on('click',function(){
		    $("#sidebar").toggleClass('active');
			$("#content").toggleClass('active');
		  });
		  
		  $('.xp-menubar,.body-overlay').on('click',function(){
		     $("#sidebar,.body-overlay").toggleClass('show-nav');
		  });
		  
	   });

      //TableEditcheque
      $(document).ready(function () {
         $('#TableEditcheque').DataTable(
            {
		      	'processing': true,
		      	'serverSide': true,
		      	'serverMethod': 'post',
		      	'ajax': {
		          	'url':'html/EditionChequeDatatable.php'
		      	},
		      	'columns': [
                  { data: 'DATE_BDR' },
                  { data: 'LIBELLES' },
		         	{ data: 'CODE_FR' },
		         	{ data: 'MOTIF_BDR' },
		         	{ data: 'MONTANT_TTC' },
		         	{ data: 'CHEQUE' },
                  { data: "action", "defaultContent": '' }
		      	]
            }
         );
      });


      $(document).ready(function () {
         $('#TablePersonnels').DataTable();
      });

      $(document).ready(function () {
         $('#TableCodeAnalytique').DataTable();
      });

      /*$(document).ready(function () {
         $('#TableUser').DataTable();
      });*/

      $(document).ready(function () {
         $('#TableRubrique').DataTable(
             {
               dom: 'Bfrtip',
                  buttons: [
                                    {
                                 extend: 'print',
                                 exportOptions: {
                                    columns: ':visible'
                                 }
                              },
                              'csv', 'excel', 'pdf' 
                           ],
                            
            }
         );
      });

      $(document).ready(function () {
         $('#TablePrets').DataTable(
          /*  {
               dom: 'Bfrtip',
                  buttons: [
                                    {
                                 extend: 'print',
                                 exportOptions: {
                                    columns: ':visible'
                                 }
                              },
                              'csv', 'excel', 'pdf','colvis'
                           ],
                           columnDefs: [ {
                                 targets: -1,
                                 visible: false
                           }
               ]
            }*/
         );
      });
      
  </script>

  </body>
  
  </html>


