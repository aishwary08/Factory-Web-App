<?php
 session_start(); 
 if(!isset($_SESSION['user_session']))
 {
  header("Location: index.php");
  exit();
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Data Entry Form</title>
  <link rel="shortcut icon" href="index_fevi.png">
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel ="stylesheet" href="css/user_home.css?v=2">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js"></script>
  <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
  <script src="http://formvalidation.io/vendor/formvalidation/js/formValidation.min.js"></script>
  <script src="http://formvalidation.io/vendor/formvalidation/js/framework/bootstrap.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.js"></script>
  <link href="css/boot.css?v=3" rel="stylesheet">
  
  <style> 
	input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; -moz-appearance: none; appearance: none; margin: 0; } 
	#txt, #datetimepicker1{ width: 50%;  float: left;	} #style_menu{width: 50%; float:right;}
	#txt { font-weight: 100; font-size: 24px; color: #777 }
	.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control { background-color: #fff !important; opacity: 1; }
	.form-group.required .ctrl-label:after { content:" *"; color:red }
	.navbar-toggle.navbar-left { float: left; margin-left: 10px;}
	.container.navc { padding-right: 0; padding-left: 0; 
	input[type="number"] {-moz-appearance: textfield;}
  </style>
</head>
<body>

<div class="container navc">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle navbar-left" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="user_home.php"><?php if(isset($_SESSION['factory'])) echo $_SESSION['factory']; else echo "Factory"; ?></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
		<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu</a>
          <ul class="dropdown-menu">
			<li><a href="user_home.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
			<li><a href="user_home.php#update" onclick="return loadUpload();"><span class="glyphicon glyphicon-pencil"></span>Update</a></li>
			<li><a href="user_home.php#new_style" onclick="return loadStyle();"><span class="glyphicon glyphicon-plus"></span>Add a style</a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>

<div class="container page-header">
	<span id="insert-msg"></span>
	<div class="input-group" id="txt">Data Entry</div>
	<div class="form-group" style="margin-bottom:auto;" id="dateTimePickerDiv">
		<div class='input-group date' id='datetimepicker1'>
			<input type='text' class="form-control" name="data[date]" id="date" autofocus form="data-form"/>
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
		</div>	
	</div>

	<div id="style_menu" class="input-group" style="display:none">
		<select id="styleMenu" class="selectpicker" data-live-search="true">
			<option data-hidden="true" >--Style Number--</option>
		</select>
	</div>

</div>

<div class="container well" id="new-form">
  <form id="data-form" class="form-horizontal">
    <div class="form-group row required">
      <label for="style" class="col-sm-2 col-form-label ctrl-label">Style Number</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="style" placeholder="Style Number" name="data[style]">
      </div>
    </div>
    <div class="form-group row">
      <label for="po" class="col-sm-2 col-form-label">PO Number</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="po" placeholder="Purchase Order Number" name="data[po_no]">
		<i id="ii" class="form-control-feedback glyphicon glyphicon-remove" data-fv-icon-for="data[po_no]" style="display: none;"></i>
		<small id="iitxt" class="help-block" data-fv-validator="integer" data-fv-for="data[po_no]" data-fv-result="VALID" style="display: none;">Please enter a valid number</small>
      </div>
    </div>
	
	<div class="form-group row">
      <label for="color" class="col-sm-2 col-form-label">Color</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="color" placeholder="Color" name="data[color]">
      </div>
    </div>
	
	<div class="form-group row">
      <label for="ord_qty" class="col-sm-2 col-form-label">Ordered Quantity</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="ord_qty" placeholder="Ordered Quantity" name="data[ord_qty]">
      </div>
    </div>
	
    <div class="form-group row">
      <label for="tc" class="col-sm-2 col-form-label">Today's Cutting</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="tc" placeholder="Today's Cutting" name="data[today_cutting]">
      </div>
    </div>

    <div class="form-group row">
      <label for="cut" class="col-sm-2 col-form-label">Cutting</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="cut" placeholder="Cutting" name="data[cutting]">
      </div>
    </div>

    <div class="form-group row">
      <label for="ts" class="col-sm-2 col-form-label">Today's Stitching</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="ts" placeholder="Today's Stitching" name="data[today_stiching]">
      </div>
    </div>
	
    <div class="form-group row">
      <label for="stitch" class="col-sm-2 col-form-label">Stitching</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="stitch" placeholder="Stitching" name="data[stiching]">
      </div>
    </div>
    <div class="form-group row">
      <label for="tsw" class="col-sm-2 col-form-label">Today's Sent Wash</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="tsw" placeholder="Today's Sent Wash" name="data[today_sent_wash]">
      </div>
    </div>
    <div class="form-group row">
      <label for="sfw" class="col-sm-2 col-form-label">Sent For Wash</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="sfw" placeholder="Sent For Wash" name="data[sent_for_wash]">
      </div>
    </div>
    <div class="form-group row">
      <label for="trw" class="col-sm-2 col-form-label">Today's Received Wash</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="trw" placeholder="Today's Received Wash" name="data[today_received_wash]">
      </div>
    </div>
    <div class="form-group row">
      <label for="rfw" class="col-sm-2 col-form-label">Received From Wash</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="rfw" placeholder="Received From Wash" name="data[received_from_wash]">
      </div>
    </div>
    <div class="form-group row">
      <label for="ti" class="col-sm-2 col-form-label">Today's Iron</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="ti" placeholder="Today's Iron" name="data[today_iron]">
      </div>
    </div>
    <div class="form-group row">
      <label for="iron" class="col-sm-2 col-form-label">Iron</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="iron" placeholder="Iron" name="data[iron]">
      </div>
    </div>
    <div class="form-group row">
      <label for="tp" class="col-sm-2 col-form-label">Today's Pack</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="tp" placeholder="Today's Pack" name="data[today_pack]">
      </div>
    </div>
    <div class="form-group row">
      <label for="pack" class="col-sm-2 col-form-label">Packing</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="pack" placeholder="Packing" name="data[packing]">
      </div>
    </div>
    <div class="form-group row">
      <label for="ship" class="col-sm-2 col-form-label">Shipment</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="ship" placeholder="Shipment" name="data[shipment]">
      </div>
    </div>
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <button type="submit" class="btn btn-primary" id="dataEntryButton">Submit</button>
      </div>
    </div>
  </form>
</div>

<script type="text/javascript">

$(document).ready(function() {	
	$.ajax({   
		type: "GET",
		url: "get_style_number.php",             
		dataType: "json",               
		success: function(response){  
			for(var i=0;i<Object.keys(response).length;i++)
			{
				console.log(response[i].style);
				var option = "<option value='"+response[i].style+"'>"+response[i].style+"</option>"; 
				$("#styleMenu").append(option);
				$("#styleMenu").selectpicker("refresh");
			}
		},
		fail: function(response){
			console.log(response);
		}
	});
	
});

$(function() {
  $('.selectpicker').on('change', function(){
    var selected = $(this).find("option:selected").val();
    console.log(selected);
	localStorage.setItem("selected", selected);
	$("#eventTableDiv").css("display", "block");
	$("#eventsTable tbody tr td").html('');
	$("#eventsTable").bootstrapTable('refresh', {url: "fetch_style_data.php?style="+selected});
  });
});

$(function () {
	$('#datetimepicker1').datetimepicker({
		maxDate: moment(),
        format: 'YYYY-MM-DD'
	});
});

$(document).ready(function() {
	 $('#dataEntryButton').on('click', function() {
    $('#data-form').formValidation({
        framework: 'bootstrap',
		live: 'enabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'data[style]': {
                validators: {
                    notEmpty: {
                        message: 'The style number is required'
                    },
                    stringLength: {
                        min: 6,
						message: 'Please enter 6 digit style number'
                    },
					integer: {
                        message: 'Not a valid number',
						thousandsSeparator: '',
                        decimalSeparator: ''
                    },
					callback: {}
                }
            },
			'data[po_no]':{
				validators:{
					notEmpty:{
						message: 'The PO number is required'
					},
					integer: {
                        message: 'Not a valid number'
                    },
					callback: {
						message: "PO Number already exist"
					}
				}
			}
        }
    })
	.off('success.form.fv')
	.on('success.form.fv', function(e) {
		e.preventDefault();
		console.log("hi");

		var $form = $(e.target);
		var bv = $form.data('formValidation');
		
		var result = {};
		$.each($("#data-form").serializeArray(), function() {
			result[this.name] = this.value;
		});

		$.post("insert_data.php", result)
		.success( function(msg) { 
				if(msg == 70)
				{
					console.log("70"+msg);
					bv.updateMessage('data[style]', 'callback', 'Permission denied for style number');
					bv.updateStatus('data[style]', 'INVALID', 'callback');
					$( "#style" ).focus();
				}
				else if(msg=="ok"){
					console.log("ok+data-form"+msg);
					$('#insert-msg').html("<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>Updated !</strong></div>");
					$('#insert-msg').focus();
					setTimeout(function(){ location.reload(); }, 2500);
				}
				else if(msg == 1452){
					console.log("1452"+msg);
					bv.updateMessage('data[style]', 'callback', 'Style number does not exist.');
					bv.updateStatus('data[style]', 'INVALID', 'callback');
					$( "#style" ).focus();
				}
				else if(msg == 1062){
					console.log("1062-data-form"+msg);
					bv.updateStatus('data[po_no]', 'INVALID', 'callback');
					$( "#po" ).focus();
				}
				else{
					console.log("error data-form"+msg);
					$('#insert-msg').html("<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button><strong>Error!</strong></div>");
					$('#insert-msg').focus();
					
				}
		 })
		.fail( function(xhr, status, error) {
			//$("#insert-msg").html("<h4 style='color:rgba(153,0,0,1);' align='right'>Error !</h4>");
			$("#insert-msg").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+"Error reaching server"+' !</div>');
			//$("#insert-msg").fadeOut(2000);
		})
	});
});
});

window.onload = function() {
    var url = document.location.href;
	var div = url.split('#')[1];
	if(div=='update')
		loadUpload();
	else if(div=='new_style')
		loadStyle();
}

function loadUpload () {
	var update = document.getElementById('update');
	var dateTimePicker = document.getElementById('dateTimePickerDiv');
	var mainForm = document.getElementById('new-form');
	var styleForm = document.getElementById('new_style');
	var styleMenu = document.getElementById('style_menu');
	document.getElementById("txt").innerHTML = "Update";
	
	if(dateTimePicker!==null)
		dateTimePicker.style.display='none';
	if(mainForm!=null)
		mainForm.style.display='none';
	if(styleForm!=null)
		styleForm.style.display='none';
	if(styleMenu!=null)
		styleMenu.style.display='block';
	if(update!= null)
		update.style.display='block';
	
	return true;
}

function loadStyle () {
	localStorage.removeItem("selected");
	var update = document.getElementById('update');
	var styleMenu = document.getElementById('style_menu');
	var dateTimePicker = document.getElementById('datetimepicker1');
	var mainForm = document.getElementById('new-form');
	var styleForm = document.getElementById('new_style');
	document.getElementById("txt").innerHTML = "Style";
	
	if(update!== null)
		update.style.display='none';
	if(styleMenu!=null)
		styleMenu.style.display='none';
	if(dateTimePicker!==null)
		dateTimePicker.style.display='none';
	if(mainForm!=null)
		mainForm.style.display='none';
	if(styleForm!==null)
		styleForm.style.display='block';
	return true;
}
	
</script>

<div id="update" style="display:none;">
<?php 
  include "update.html"	;
?>
</div>

<div id="new_style" style="display:none;">
	<div class="container well">
		<form id="style-form" class="form-horizontal">
			<div class="form-group row">
				<label for="style" class="col-sm-2 col-form-label col-form-label-lg">Style Number</label>
				<div class="col-sm-10">
					<input type="number" class="form-control" id="style" placeholder="Style Number" name="style" autofocus>
				</div>
			</div>
			<div class="form-group row">
			  <div class="offset-sm-2 col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
			  </div>
			</div>
		</form>
	</div>
	
	<script>
	$(document).ready(function() {
		$('#style-form').formValidation({
			framework: 'bootstrap',
			live: 'enabled',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				'style': {
					validators: {
						notEmpty: {
							message: 'The style number is required'
						},
						stringLength: {
							min: 6,
							message: 'Please enter 6 digit style number'
						},
						integer: {
							message: 'Not a valid number',
							thousandsSeparator: '',
							decimalSeparator: ''
						},
						callback: {
							message: "Style Number already exist"
						}
					}
				}
			}
			}).on('success.form.fv', function(e) {
				e.preventDefault();

				var $form = $(e.target);
				var bv = $form.data('formValidation');
				
				var result = {};
				$.each($("#style-form").serializeArray(), function() {
					result[this.name] = this.value;
				});
					console.log(result);
				$.post("add_style.php", result)
				.success( function(msg) { 
						if(msg=="ok"){
							console.log("ok style"+msg);
							$('#insert-msg').html("<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>Updated !</strong></div>");
							setTimeout(function(){ location.reload();}, 1500);
						}
						else if(msg == 1062){
							console.log("1062 style"+msg);
							bv.updateStatus('style', 'INVALID', 'callback');
							$( "#po" ).focus();
						}
						else{
							console.log("error"+msg);
							$('#insert-msg').html("<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button><strong>Error!</strong></div>");
						}
				 })
				.fail( function(xhr, status, error) {
					$("#insert-msg").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+"Error reaching server"+' !</div>');
			})
		});
	});
	</script>
</div>


</body>
</html>
