<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://internal-apptier-lb-992887380.eu-north-1.elb.amazonaws.com/login_page/register_backend.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>
