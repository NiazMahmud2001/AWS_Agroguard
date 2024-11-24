
    <?php 
        // Database connection variables
        $servername = "rds-agroguard.ctkokooiid1w.eu-north-1.rds.amazonaws.com"; // or "127.0.0.1: port number of mysql(not apache)"
        $username = "niazAdmin";        
        $password = "7835e6ef";    
        $dbname = "agroguard";
        
        $Py_server = new mysqli($servername ,$username, $password ,$dbname);
        // Check connection
        if ($Py_server-> connect_errno) {
            echo "Failed to connect to MySQL: " . $Py_server-> connect_error;
            exit();
        }else{
            echo "<br> Successfully connected to the db <br><br>";
    
        if (mysqli_error($Py_server)){
        echo "Failed to connect to MySQL: " . $Py_server-> connect_error;
        exit();
        };
    
        $userNames = $_GET['ppName'];

        $sql_command = "SELECT droneId FROM userReg WHERE `userName`='$userNames';";
        $result_insert = $Py_server -> query($sql_command);
        $rows = mysqli_fetch_row($result_insert);
        $droneName  = explode("-" , $rows[0])[0];
    
        $sqlCommandServices = "SELECT serviceLink , serviceName FROM droneServices WHERE `droneId`='$droneName';"; 
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

