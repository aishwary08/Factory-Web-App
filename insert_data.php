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
$sql ="SELECT factory_num FROM Style where Style_Num=".$_POST['data']['style'];
$result = $conn->query($sql);

$flag = false;

if($result){
	if ($result->num_rows > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			if($row['factory_num']==$_SESSION['user_session']){
				$flag = true;
				break;
			}
		}
		if($flag)
		{
			/*print_r($_POST['data']);
			print_r($_POST['data']['style']);*/

			$col = "";
			$val = "";

			foreach ($_POST['data'] as $key => $value)
			{
				if(!empty($value)){
					$col = $col.$key.",";
					if(($key == "color") || ($key == "date") )
						$value = "'$value'";
					$val = $val . $value . ",";
				}
				//echo $key." : ". $value ."<br>"; 
			}
			$col = substr($col,0,-1);
			$val = substr($val,0,-1);
			//echo $col . "<br>" . $val;

			$sql = "INSERT INTO Factory ($col,factory_num) VALUES ($val,".$_SESSION['user_session'].")";

			if (mysqli_query($conn, $sql)) {
				echo "ok";
			} else {
				//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				echo mysqli_errno($conn);
			}
		}
		else
			echo "70";
	}
	else
		echo "1452";
}
else 
	echo "70";

mysqli_close($conn);
?>