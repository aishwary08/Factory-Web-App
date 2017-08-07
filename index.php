<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>  
  <title>Login</title>
  <link rel="shortcut icon" href="login_fevi.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

  <link rel ="stylesheet" href="css/index.css?v=2">
</head>
<body>
  <div class="wrapper">	
    <form class="form-signin" method="post" id="login-form">   
		<div class="page-header" id="txt">Welcome to Factory</div>    
		<h2 class="form-signin-heading">Login</h2>
		<div class="form-group row">
			<div class="col-sm-12">
				<input type="text" class="form-control" name="username" placeholder="User ID" required="" autofocus="" />
			</div>
		</div>
	  	<div class="form-group row">
			<div class="col-sm-12">
				<input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
			</div>
		</div>
		
		<div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary btn-block" name="btn-login" id="btn-login" style='border: none;outline:none'>
				<span class="glyphicon glyphicon-log-in"></span> &nbsp; Login
			</button> 
        </div>  
		<div id="error">
        </div>
    </form>
	<h4 id="logout-msg" style="color:rgba(153,0,0,1);" align="center"><?php if (isset($_SESSION['message'])) {echo $_SESSION['message']; unset($_SESSION['message']); session_destroy();}?></h4>
  </div>
 <script>
 $("#logout-msg").fadeOut(3000);
 
 $('document').ready(function()
{ 
     /* validation */
  $("#login-form").validate({
      rules:
   {
   password: {
   required: true,
   },
   username: {
            required: true
            },
    },
       messages:
    {
            password:{
                      required: "Please enter your password"
                     },
            user_email: "Please enter your email address",
       },
    submitHandler: submitForm 
       });  
    /* validation */
    
    /* login submit */
    function submitForm()
    {  
   var data = $("#login-form").serialize();
    
   $.ajax({
    
   type : 'POST',
   url  : 'login.php',
   data : data,
   beforeSend: function()
   { 
    $("#error").fadeOut();
    $("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp;');
   },
   success :  function(response)
   {      
	if(response=="ok"){
		$("#btn-login").html('&nbsp; Signing In ...');
		setTimeout(' window.location.href = "call_home.php"; ',1000);
     }
	else if(response == "401"){
		 $("#error").fadeIn(1000, function(){      
			$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign"></span> &nbsp; '+"Username/Password is incorrect"+' !</div>');
			$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
		});
	}
    else
	{
		$("#error").fadeIn(1000, function(){      
			$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign"></span> &nbsp; '+"Error"+' !</div>');
			$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
		});
    }
   },
   error: function(response){
		$("#error").fadeIn(1000, function(){      
		$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-exclamation-sign"></span> &nbsp; '+"Error reaching server"+' !</div>');
           $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
        });
	 }
   });
    return false;
  }
    /* login submit */
});
</script>
 </body>
</html>