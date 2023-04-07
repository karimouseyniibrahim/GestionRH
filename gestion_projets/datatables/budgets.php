<?php
   // Database dbection
   require("../../config/db.php");

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
      $searchQuery = " AND (
           compte LIKE :compte OR 
           montant LIKE :montant OR
           annee LIKE :annee ) ";
      $searchArray = array( 
        'b.compte'=>"%$searchValue%",
        'montant'=>"%$searchValue%",
        'annee'=>"%$searchValue%"
      );
   }

   // Total number of records without filtering
   $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM gp_bugets ");
   $stmt->execute();
   $records = $stmt->fetch();
   $totalRecords = $records['allcount'];

   // Total number of records with filtering
   $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM gp_bugets WHERE 1 ".$searchQuery);
   $stmt->execute($searchArray);
   $records = $stmt->fetch();
   $totalRecordwithFilter = $records['allcount'];

   // Fetch records
   $stmt = $db->prepare("SELECT b.*,p.description,p.Nature,p.Rubrique FROM gp_bugets as b inner join gp_plan_comptable as p on b.compte=p.compte WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
        "compte"=>$row['compte'],
        "description"=>$row['description'],
        "Rubrique"=>$row['Rubrique'],
        "Nature"=>$row['Nature'],
        "montant"=>$row['montant'],
        "annee"=>$row['annee'],
         
         "action"=>'<button  class="edit" data-toggle="modal" onclick=\'openmodal('.json_encode($row).')\' style="
         padding-right: 0px;padding-left: 0px;border:0px;">
               <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
         </button >
         <button class="delete" data-toggle="modal" onclick="openmodaldelete('.$row['id'] .')" style="
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