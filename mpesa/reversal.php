<?php
require "access_token.php";
$access_token = get_access_token();
$url = 'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header


$curl_post_data = array(
  //Fill in the request parameters with valid values
  'Initiator' => 'TestInit613',
  'SecurityCredential' => 'SjnTFeAakocBiR2wZQBUpfsirFTfin0bAf/VcIWcGk+RtLbmeDDjY//eS+vk7iGeUdnSAqRZQlLpINN2WPtNPVPOvJz7qUvHRg4nF9Y864Ygk8eYMBnDV0/WqTTX6VMW+eelBNrcgkZdJaQcolrMYvDXToyFYEo/3kj1guIyiZ8gw/K7G0hzHFwFEPhxRrT5YWTNsHSXkE+P/ay28v8KuSv4faSI94qzyv9gsa6YmhaP5gFUBQF6N7CLRVXYDcIxq7KW7TcrzfE2wwJUgwkozd8ZHc8eV3dqHR1MdyY8bCv7kS8vgkyOGox2WHtkxFsGV9NTlfGNhBiQ7wB8cHpjaQ==',
  'CommandID' => 'TransactionReversal',
  'TransactionID' => 'OAE4D3XWXK',
  'Amount' => '1',
  'ReceiverParty' => '600613',
  'RecieverIdentifierType' => '11',
  'ResultURL' => 'https://amanivehiclesounds.co.ke/payments/reverseresponce.php',
  'QueueTimeOutURL' => 'https://amanivehiclesounds.co.ke/payments/reverseresponce.php',
  'Remarks' => 'Out of Stock',
  'Occasion' => 'Web Purchase'
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;
?>
