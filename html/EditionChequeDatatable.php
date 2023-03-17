<?php
   // Database dbection
   require("../config/db.php");

   // Reading value
   $draw = $_POST['draw'];
   $row = $_POST['start'];
   $rowperpage = $_POST['length']; // Rows display per page
   $columnIndex = $_POST['order'][0]['column']; // Column index
   $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
   $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
   $searchValue = $_POST['search']['value']; // Search value

   $searchArray = array();

   // Search
   $searchQuery = " ";
   if($searchValue != ''){
      $searchQuery = " AND (MOTIF_BDR LIKE :MOTIF_BDR OR 
           DATE_BDR LIKE :DATE_BDR OR
           LIBELLES LIKE :LIBELLES OR
           MONTANT_TTC LIKE :MONTANT_TTC OR
           CHEQUE LIKE :CHEQUE OR 
           CODE_FR LIKE :CODE_FR ) ";
      $searchArray = array( 
        'DATE_BDR'=>"%$searchValue%",
        'LIBELLES'=>"%$searchValue%",
           'MOTIF_BDR'=>"%$searchValue%",
           'MONTANT_TTC'=>"%$searchValue%",
           'CHEQUE'=>"%$searchValue%",
           'CODE_FR'=>"%$searchValue%"
      );
   }

   // Total number of records without filtering
   $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM bon_reglement ");
   $stmt->execute();
   $records = $stmt->fetch();
   $totalRecords = $records['allcount'];

   // Total number of records with filtering
   $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM bon_reglement WHERE 1 ".$searchQuery);
   $stmt->execute($searchArray);
   $records = $stmt->fetch();
   $totalRecordwithFilter = $records['allcount'];

   // Fetch records
   $stmt = $db->prepare("SELECT * FROM bon_reglement WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

   // Bind values
   foreach ($searchArray as $key=>$search) {
      $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
   }

   $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
   $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
   $stmt->execute();
   $empRecords = $stmt->fetchAll();

   $data = array();

   foreach ($empRecords as $row) {
      $data[] = array(
        "DATE_BDR"=>$row['DATE_BDR'],
        "LIBELLES"=>$row['LIBELLES'],
         "CODE_FR"=>$row['CODE_FR'],
         "MOTIF_BDR"=>$row['MOTIF_BDR'],
         "MONTANT_TTC"=>$row['MONTANT_TTC'],
         "CHEQUE"=>$row['CHEQUE'],
         "action"=>'<button  class="edit" data-toggle="modal" onclick=\'openmodal('.json_encode($row).')\' style="
         padding-right: 0px;padding-left: 0px;border:0px;">
               <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
         </button >
         <button   onclick="onpenPrintcheque('.$row['ID'].')" style="padding-right: 0px;padding-left: 0px;border:0px;">
            <i class="material-icons">library_books</i>
         </button>
         <button class="delete" data-toggle="modal" onclick="openmodaldelete('.$row['ID'] .')" style="
         padding-right: 0px;padding-left: 0px;border:0px;">
            <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
         </button>
         '
      );
   }

   // Response
   $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $data
   );

   echo json_encode($response);