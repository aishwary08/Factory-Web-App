<?php
 session_start();
 require_once 'db_config.php';

 if(isset($_POST['btn-login']))
 {
  $user_email = trim($_POST['username']);
  $user_password = trim($_POST['password']);
  
  $password = md5($user_password);
 
 try
  { 
   $stmt = $db_con->prepare("SELECT * FROM Credentials WHERE username=:email");
   $stmt->execute(array(":email"=>$user_email));
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $count = $stmt->rowCount();
   
 
   if(md5($row['password'])==$password){
    
    echo "ok"; // log in
    $_SESSION['user_session'] = $row['factory_num'];
   }
   else{
    echo "401"; // wrong details 
   }
    
  }
  catch(PDOException $e){
   echo $e->getMessage();
  }
 }

?>