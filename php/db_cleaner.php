<?php
    
$client_key = $_POST['key'];

//get the server key and check with POSTed client key
$config = parse_ini_file('../r_admin_use/db.ini'); //localhost

$server_key = $config['POST_KEY'];

if ($server_key === $client_key) 
{
        require_once('../php/conn_php_math_db.php');

        //cleaning up database by deleting all records except the last 10 recent records
        $query = "DELETE FROM sensehat_readings WHERE id NOT IN(SELECT * FROM(SELECT id FROM sensehat_readings ORDER BY timestamp DESC LIMIT 10) r)";
        $result = mysqli_query($conn, $query) or die("R_Invalid Error" . mysqli_error($conn));

        mysqli_close($conn);

        echo "Database cleaned after Auth";
    }
    else {
        echo "POST Authentication failed";
    }

?>
