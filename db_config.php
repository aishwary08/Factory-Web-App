<?php
 $db_host = "mysql.freehostia.com";
 $db_name = "aiskum_factory";
 $db_user = "aiskum_factory";
 $db_pass = "aish9835";
 
 try{	
  $db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
  $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e){
  echo $e->getMessage();
 }
?>