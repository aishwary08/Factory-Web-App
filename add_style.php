<?php
session_start();	
$db_host = "mysql.freehostia.com";
$db_name = "aiskum_factory";
$db_user = "aiskum_factory";
$db_pass = "aish9835";


$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql ="insert into Style values(".$_POST['style'].",".$_SESSION['user_session'].");";
if (mysqli_query($conn, $sql)) {
	echo "ok";
} 
else {
	echo mysqli_errno($conn);
}
mysqli_close($conn);
?>