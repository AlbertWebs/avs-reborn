<?php
    $headers = array(
        'Content-Type: application/json; charset=utf-8'
    );
    
    $consumerKey =  'abQnSRwAjAlKgMSnIUOjPkTllJLiRFvn';
    $consumerSecret = 'I0ASNDdl8hr8EcY3';

    
    $access_token_url='https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    // $access_token_url='https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

    // Request
    $curl = curl_init($access_token_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    //curl_setopt($ch, CURLOPT_HEADER, TRUE); // Includes the header in the output
    curl_setopt($curl, CURLOPT_HEADER, FALSE); // excludes the header in the output
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ":" . $consumerSecret); // HTTP Basic Authentication
    $result = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $result = json_decode($result);
    $access_token = $result->access_token;


    $balance_url = 'https://api.safaricom.co.ke/mpesa/accountbalance/v1/query';
    

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $balance_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header




    $curl_post_data = array(
    'Initiator' => 'Amanichris57',
    'SecurityCredential' => 'LMj2Sf3PY0RSvGwKfn+BwoRhjfU6gkTCxZN/S7j77vrOFPA7RAGaNroClm3hIgowN3doIPXE9Ov0ZUTr1XfK/HL7hP4ekrc+4PDIoVfBJ67JKhjm/7comeUaOfGwQ6F7Gmzdz7CKg0JaGdk/GqOvuYzOWyyWPli6tKXSrwZLcEBbPiJjPew6bOKT/nEUV9XMvrGQyAml4PM21kkS32QfBWSxVhBicCMAzPiXBaJWQO02CRJxvUJioQaBIPD7UuRXdE22DShHA5ncW/mcWP47y6k/oRwoONOmghcGuvGbmCTg+yCnz5pbvIKaHF54JAXdpxNBCb6DpTJNQOx75VNNdw==',
    'CommandID' => 'AccountBalance',
    'PartyB' => '745467',
    'IdentifierType' => '4',
    'Remarks' => 'Bal',
    'QueueTimeOutURL' => 'https://amanivehiclesounds.co.ke/payments/balanceresponce.php',
    'ResultURL'       => 'https://amanivehiclesounds.co.ke/payments/balanceresponce.php'
    );

    $data_string = json_encode($curl_post_data);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    $curl_response = curl_exec($curl);
    print_r($curl_response);

    echo $curl_response;
    
?>
