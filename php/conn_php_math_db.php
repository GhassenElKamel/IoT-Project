<?php
 $config = parse_ini_file('/opt/lampp/htdocs/IoT-Project-Python-PHP-API/r_admin_use/db.ini');
 //print_r($config);
 //print_r($server);

 $server = $config['HOST'];
 $user = $config['USER']; 
 $password = $config['PASSWORD'];
 $database = $config['DB'];


// create connection
$conn = new mysqli($server, $user, $password, $database);

// check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

?>
