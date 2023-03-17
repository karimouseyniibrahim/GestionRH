<?php
session_start();
include("filters/auth_filter.php");
require("config/db.php");
require("includes/functions.php");
$title=Clients;
$limit_right=isset($_GET['page'])?$_GET['page']:1;

if(isset($_POST['sauve_client'])){

	extract($_POST);
	if($sauve_client=='Enregistrer'){

 
		$q=$db->prepare("INSERT INTO `clients`(`nom`, `prenom`, `adresse`, `telephone`) 
		VALUES (:nom, :prenom, :adresse, :telephone)");
		try{
			$q->execute(array(
				':nom' => $clientname,
				':prenom' => $clientlastname,
				':adresse' => $clientAddress,
				':telephone' => $clienttelephone));
			}catch(PDOException $e){
				echo "Erreur : " . $e->getMessage();
				die();
			}
       $clientsaved=$q->rowCount();
	   
        if($clientsaved){
        
            $_SESSION['notification']['message'] = 'Client enregistrer avec success!';
            $_SESSION['notification']['type'] = "info";
            clear_data_post();
            
            redirect('clients.php?page='.$limit_right);
        }else{
            set_flash("Client non enregistrer", 'danger');
            save_input_data();
        }

	}else if($sauve_client=='Modifier'){

		$q=$db->prepare("UPDATE `clients` set `nom`=:nom, `prenom`=:prenom, `adresse`=:adresse, `telephone`=:telephone where `idclient`=:idclient");
		try{
		$q->execute(array(
			':idclient'=>$clientID,
			':nom' => $clientname,
			':prenom' => $clientlastname,
			':adresse' => $clientAddress,
			':telephone' => $clienttelephone));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		
		clear_data_post();        
       redirect('clients.php?page='.$limit_right);
	}else if($sauve_client=='Supprimer'){
        $q=$db->prepare("delete from `clients`  where `idclient`=:idclient");
		try{
		$q->execute(array(
			':idclient'=>$clientID
        ));
		}catch(PDOException $e){
			echo "Erreur : " . $e->getMessage();
			die();
		}
		
		clear_data_post();        
       redirect('clients.php?page='.$limit_right);
    }
}







$Cclient=count_clients();
$nbr_pages=(int) ($Cclient/20)+1;

$limit_left=($limit_right-1)*20;
$limit_right=$limit_right*20;
$clients=liste_clients($limit_left,$limit_right);







require("partials/header.php");

?>

<div class="wrapper">
     
	  <div class="body-overlay"></div>
	 
	 <!-------sidebar--design------------>
	 <?php
     require("partials/sidebar.php");
     ?>
	 
    <!-------sidebar--design- close----------->

      <!-------page-content start----------->
   
      <div id="content">
	     
		  <!------top-navbar-start-----------> 
		     
		  <?php
          require("partials/nav-bar.php");
          ?>
		  <!------top-navbar-end-----------> 
		 
		  <?php
		  include("views/index.view.php");
		  ?>
		 <!----footer-design------------->
		 
		 <footer class="footer">
		    <div class="container-fluid">
			   <div class="footer-in">
			      <!--p class="mb-0">&copy 2021 Vishweb Design . All Rights Reserved.</p-->
			   </div>
			</div>
		 </footer>
		 
	  </div>
   
</div>

<!-------complete html----------->

<?php
require("partials/footer.php")
?>


  
    