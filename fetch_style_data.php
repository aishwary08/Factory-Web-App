<?php
$db_host = "mysql.freehostia.com";
$db_name = "aiskum_factory";
$db_user = "aiskum_factory";
$db_pass = "aish9835";


$conn = new mysqli($db_host,$db_user,$db_pass,$db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql ="SELECT * FROM Factory where style='".$_GET['style']."' order by po_no";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row=mysqli_fetch_array($result,MYSQL_ASSOC)) {
		//$rows[] = $row;
		$data[] = $row;
    }
	print json_encode($data);
}
else
	echo "None";

$conn->close();
?>