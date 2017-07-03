<?php
    ini_set('display_errors',1);
    error_reporting(E_ALL);

    $servername = "fsm-reporting.cv4wlkii5dud.eu-west-1.rds.amazonaws.com";
	$username = "readonly";
	$password = "";
	$databasename = "ch4-qton-com";

    $connection = new mysqli($servername, $username, $password, $databasename);

    if ($connection->connect_error){
        die("Database connection failed: " . mysqli_connect_error());
    }
    
    $statement = "SELECT status, COUNT(*) as count FROM jobstatus GROUP BY status";
    $result = mysqli_query($connection, $statement);

    if (mysqli_num_rows($result) > 0) {
            $array[] = ['status', 'count'];
       foreach($result as $row){
         $array[] = [$row['status'],$row['count']];
       }
       echo json_encode($array, JSON_NUMERIC_CHECK);

       
    }

    mysqli_close($connection);
    


?>

