<?php
    require "access_token.php";
    $access_token = get_access_token();
    $stkHeader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];

    $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    $BusinessShortCode = "174379";
    $Timestamp = date('YmdHis'); 
    $PartyA = '254723014032';
    $CallbackURL = 'https://amanivehiclesounds.co.ke/payments/callback_url.php';
    $AccountReference = 'Designekta Studios';
    $TransactionDescription = 'Designekta Studios';
    $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
    $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);
    $Amount = '1';

   
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $initiate_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $stkHeader); //setting custom header


    $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallbackURL,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDescription
    );

    

    $data_string = json_encode($curl_post_data);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
   
    $curl_response = curl_exec($curl);
    print_r($curl_response);

    echo $curl_response;
 
?>
