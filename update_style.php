<?php

// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.
session_start();	
error_reporting(0);
//header('Content-Type: application/json;charset=utf-8"');
$db_host = "mysql.freehostia.com";
$db_name = "aiskum_factory";
$db_user = "aiskum_factory";
$db_pass = "aish9835";

$input = filter_input_array(INPUT_POST);

$result = array();
$result['error'] = FALSE;

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
  $result['error'] = TRUE;
  $result['error_no'] = 'Failed to connect to MySQL: ' . mysqli_connect_error();
  echo json_encode($result);
  exit();
}


if ($input['action'] === 'edit') {
	$col = "UPDATE Factory SET ";
	foreach ($input as $key => $value)
	{
		if($value != "-" && $key!="action" && $key!='po_no' && !empty($value))
		{
			$col = $col.$key."=";
			if(($key == "color"))
			$value = "'$value'";
			$col = $col . $value . ", ";
		}
		//echo $key." : ". $value ."<br>"; 
	}
	$col = substr($col,0,-2);
	$sql = $col." where po_no=".$input['po_no']." and style=".$input['style'];
	if (mysqli_query($conn, $sql)) {
		$result['error'] = FALSE;
		$result['status'] = "ok";
		$result['rows_affected'] = mysqli_affected_rows($conn);
	} else {
		$result['error'] = TRUE;
		$result['err_desc'] = mysqli_error($conn);
		$result['error_no'] = mysqli_errno($conn);

	}
} else if ($input['action'] === 'delete') {
	$sql = "DELETE FROM Factory where po_no=".$input['po_no']." and style=".$input['style'];
    if (mysqli_query($conn, $sql)) {
		$result['error'] = FALSE;
		$result['status'] = "ok";
		$result['rows_affected'] = mysqli_affected_rows($conn);
	} else {
		$result['error'] = TRUE;
		$result['err_desc'] = mysqli_error($conn);
		$result['error_no'] = mysqli_errno($conn);
	}
} 

mysqli_close($conn);
echo json_encode($result);
?>
