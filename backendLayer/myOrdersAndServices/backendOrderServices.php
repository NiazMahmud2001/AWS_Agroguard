<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        // Database connection variables
        define("servername" , "rds-agroguard.ctkokooiid1w.eu-north-1.rds.amazonaws.com");
        define("username" , "niazAdmin");
        define("password" , "7835e6ef");
        define("dbname" , "agroguard");
    
        $Py_server = new mysqli(constant("servername") , constant("username"), constant("password"), constant("dbname"));
    
        if (mysqli_error($Py_server)){
        echo "Failed to connect to MySQL: " . $Py_server-> connect_error;
        exit();
        };
    
        $userNames = $_GET['ppName'];

        $sql_command = "select droneId from userReg where `userName`='$userNames';";
        $result_insert = $Py_server -> query($sql_command);
        $rows = mysqli_fetch_row($result_insert);
        $droneName  = explode("-" , $rows[0])[0];
    
        $sqlCommandServices = "select serviceLink , serviceName from droneServices where `droneId`='$droneName';"; 
        $result_insert = $Py_server -> query($sqlCommandServices);
        $rows = mysqli_fetch_row($result_insert);
    
        $t = 1;
    
        $orders = [];
        while ($rows = mysqli_fetch_row($result_insert)){
            //echo "<a href='$rows[0]' class='servicesOptions'>$t : $rows[1] Link</a>";
            $orders[] = "<a href='$rows[0]' class='servicesOptions'>$t : $rows[1] Link</a>";
            $t++;
        };
        header('Content-Type: application/json');
        echo json_encode($orders);
        $Py_server->close();

    ?>

</body>
</html>
