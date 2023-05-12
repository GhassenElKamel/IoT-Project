<?php
if(empty($_SERVER['CONTENT_TYPE']))
{ 
 $_SERVER['CONTENT_TYPE'] = "application/x-www-form-urlencoded"; 
}
//receiving data in a POST request from IoT device using python's requests library
$temperature = $_POST['temp'];
$pressure = $_POST['pres'];
$humidity = $_POST['humi'];
$client_key = $_POST['key'];

//get the server key and check with POSTed client key
$config = parse_ini_file('../r_admin_use/db.ini'); //localhost
//$config = parse_ini_file('/opt/lampp/htdocs/IoT-Project-Python-PHP-API/r_admin_use/db.ini'); //Online use

$server_key = $config['POST_KEY'];

print_r($_POST);
echo $client_key;
if ($server_key === $client_key) //when authentication passes write to db
{
        require_once('../php/conn_php_math_db.php');
	try {
	
	$query = "INSERT INTO sensehat_readings (timestamp, temperature, pressure, humidity) VALUES ('".date('Y-m-d H:i:s')."', '".$temperature."', '".$pressure."', '".$humidity."')";	
	//writing the received data in the database
	$result = mysqli_query($conn, $query) or die("R_Invalid Error" . mysqli_error($conn));
	echo $result;

        mysqli_close($conn);
	
        echo "POST data written to database after Auth";
	} catch (Exception $e) {
 	   echo "Error: " . $e->getMessage();
	}	

}
    else {
        echo "POST Authentication failed";
    }

?>
