<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $userNames = $_GET['ppName'];  
        $backend_url = "http://internal-apptier-lb-992887380.eu-north-1.elb.amazonaws.com/myOrdersAndServices/backendOrderServices.php?ppName=".$userNames;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $backend_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        } else {
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        curl_close($ch);
    ?>
</body>
</html>
