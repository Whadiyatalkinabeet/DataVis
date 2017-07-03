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

    $startDate = '2013-06-12-00:00:00';
    $endDate = '2013-06-12-15:00:00';

    $statement = mysqli_prepare($connection, "SELECT status, COUNT(*) FROM jobstatus WHERE received >= (?) AND received <= (?) GROUP BY status");
    mysqli_stmt_bind_param($statement, 'ss', $startDate, $endDate);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $status, $count);

   $array[] = ['status', 'count'];
    while(mysqli_stmt_fetch($statement)){
        $array[] = [$status,$count];
    }

    echo json_encode($array, JSON_NUMERIC_CHECK);
   
    
    mysqli_stmt_close($statement);
    
  

    mysqli_close($connection);
    


?>