<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://internal-apptier-lb-992887380.eu-north-1.elb.amazonaws.com/login_page/register_backend.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true); # that fetch the headder in response 

$response = curl_exec($ch);

// Separate headers and body
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($response, 0, $header_size);
$body = substr($response, $header_size);

// Forward the redirect if present
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($http_code == 302 || $http_code == 301) {
    preg_match('/Location: (.+)/', $headers, $matches);
    if (isset($matches[1])) {
        $redirect_url = trim($matches[1]);
        header("Location: $redirect_url", true, $http_code);
        exit;
    }
}else{
    header("Location: https://www.pexels.com/search/funny/");
    //header("Location: http://WebTier-LB-1783077918.eu-north-1.elb.amazonaws.com");
};



curl_close($ch);

echo $response;
?>
