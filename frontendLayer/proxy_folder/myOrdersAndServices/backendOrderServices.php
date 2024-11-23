
<?php
$userName = $_GET['userName'];  
$backend_url = "http://internal-apptier-lb-992887380.eu-north-1.elb.amazonaws.com/myOrdersAndServices/backendOrderServices.php?ppName=$userName";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $backend_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if(curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    echo $response;
}
curl_close($ch);
?>


