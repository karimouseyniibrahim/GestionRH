<?php
session_start();
include("filters/guest_filter.php");
require("config/db.php");
require("includes/functions.php");
$title='Connexion';


if(isset($_POST['btn_connexion'])){

    //verification des champs saisie
    
    if(not_empty(array('matricule','pwd'))){
  
      extract($_POST);

      $q=$db->prepare("select * from user WHERE matricule = :matricule AND pwd = :password");
  
      $q->execute(array(':matricule' => $matricule,
                  ':password' => sha1($pwd)));
                  
      $userhasfound=$q->rowCount();
 
      if($userhasfound){
        $user=$q->fetch(PDO::FETCH_OBJ);
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['role'] = $user->role;
        $_SESSION['pwd'] = $user->pwd;
        clear_input_data();
        redirect('index.php');
      }else{
       set_flash('Conbinaison Username/Password Incorrect', 'danger');
        save_input_data();
      }
  
    }else{
      
    }
  
  }else{
  
    clear_input_data();
  
  }
include("views/connexion.view.php");