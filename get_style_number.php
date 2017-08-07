<?php
session_start();	
$db_host = "mysql.freehostia.com";
$db_name = "aiskum_factory";
$db_user = "aiskum_factory";
$db_pass = "aish9835";

$conn = new mysqli($db_host,$db_user,$db_pass,$db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql ="SELECT Style_Num FROM Style where factory_num=".$_SESSION['user_session']." order by Style_Num";
$result = $conn->query($sql);

$json = array();
$data = array();

if($result){
if ($result->num_rows > 0) {
    // output data of each row
	$i=0;
    while($row=mysqli_fetch_array($result))
	{
		//$data['serial'] = $i++;
		$data['style'] = $row['Style_Num'];
		$json[]=$data;
	}
	
	echo json_encode($json);
}
}
else
	echo "None";

$conn->close();
?>