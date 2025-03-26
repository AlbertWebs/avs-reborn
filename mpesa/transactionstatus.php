<?php
    $headers = array(
        'Content-Type: application/json; charset=utf-8'
    );

    $consumerKey =  'QIi4GKdy4TOqbCTkWB6VMIJ6EpdHYGwg';
    $consumerSecret = 'Kq0iAKSKeLjXEtBe';

    
    $access_token_url='https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

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


$url = 'https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header



$curl_post_data = array(
  //Fill in the request parameters with valid values
  'Initiator' => 'testapi120',
  'SecurityCredential' => 'fVTTk/J6wkT78gmMghXaKXpmxIxQksfnEaqiFiN0yjtZ6xBZcBwnrVa9jV+gXcZMrsMhkeuTf34w7KrDuhjKW1x6d/zMTF9pq4kAprKGOArNRLTolS6uah95CeZ2v+f1TaTUv+Y+GnL0dwVuFqbAgiYQCFzGQibhB3aDvyOoRgrD8Z2x5N/QM5BO/DOZiEyYk7WrExxrnzd5gi40xgMezYVsWa3FeOH7MFN+iTgszcXgM0O3m+cj6NmBPbZYshGzEMacCulaLocY5WFJhqQzGx69SA7aJ5DDXIfuyiFCykaOClLkcbMxC6GqJ8hepVIXDZKK4GGnW4G12aw9aIHWzQ==',
  'CommandID' => 'TransactionStatusQuery',
  'TransactionID' => 'NEE91H8IZF',
  'PartyA' => '600120',
  'IdentifierType' => '1',
  'ResultURL' => 'http://amanivehiclesounds.co.ke/payments/status_url.php',
  'QueueTimeOutURL' => 'http://amanivehiclesounds.co.ke/payments/status_url.php',
  'Remarks' => 'Checking',
  'Occasion' => 'Designekta Studios'
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;
?>
