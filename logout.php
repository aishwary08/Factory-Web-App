<?php
 session_start();

 if(!isset($_SESSION['user_session']))
 {
  header("Location: index.php");
  exit();
 }
 unset($_SESSION['user_session']);
 unset($_SESSION['factory']);
 $_SESSION['message'] = "Logout Successfully";
 header('Location:index.php');
?>
<!--
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login Form using jQuery Ajax and PHP MySQL</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style> .alert {  width:40%; word-wrap: break-word ;  } </style>
</head>

<body>
<div class="container">
    <div class='alert alert-success'>
		<button class='close' data-dismiss='alert'>&times;</button>
			<strong>Logout Successfully</strong> 
    </div>
</div>

</body>
</html>
-->
