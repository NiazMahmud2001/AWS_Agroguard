
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
        };

        if (mysqli_error($Py_server)){
        echo "Failed to connect to MySQL: ";
        exit();
        };

        $userNames = $_GET['ppName'];
        //echo $$userNames;

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
        //$orders = ["<a href='sdfasdf'>11111111</a>", "<a href='sdfasdf'>33333333333</a>", "<a href='sdfasd'>555555555</a>"];
        //$orders = implode("_", $orders);
        //echo json_encoder($orders);
        //$orders = ["12","23", "34", "45", "56", "67", "78", "89", "90"];
        header('Content-Type: application/json');
        echo json_encode($orders);
        echo $orders;
        $Py_server->close();
    ?>

