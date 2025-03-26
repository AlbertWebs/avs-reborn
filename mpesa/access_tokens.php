<?php
function get_access_token(){

	date_default_timezone_set("Africa/Nairobi");
    


    $consumerKey =  's7AHpPSYx2rB8rpT7GQbKufpu81KlL1F'; 
    $consumerSecret = 'SmL3Vw8Jh1KSlvIB'; 

    $headers = array(
        'Content-Type: application/json; charset=utf-8'
    );
    $url='https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    


    // Request
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    //curl_setopt($ch, CURLOPT_HEADER, TRUE); // Includes the header in the output
    curl_setopt($curl, CURLOPT_HEADER, FALSE); // excludes the header in the output
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ":" . $consumerSecret); // HTTP Basic Authentication
    $result = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $result = json_decode($result);
    $access_token = $result->access_token;

    return $access_token;


    curl_close($curl);


	# register url URLs
	// $confirmationUrl = 'http://amanivehiclesounds.co.ke/prototype/public/cart/checkout/payments/confirmation_url.php';
	// $validationUrl = 'http://amanivehiclesounds.co.ke/prototype/public/cart/checkout/payments/validation_url.php';
}



?>