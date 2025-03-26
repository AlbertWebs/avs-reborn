<?php
 require 'config.php';

    header("Content-Type: application/json");

    $response = '{
        "ResultCode": 0, 
        "ResultDesc": "Reversal Completed Successfully"
    }';

    // Response from M-PESA Stream
    $mpesaResponse = file_get_contents('php://input');
    

    // log the response
    $logFile = "M_PESAReverseResponceResponse.txt";

    // Add To Database
    $jsonMpesaResponse = json_decode($mpesaResponse, true); // We will then use this to save to database

    $transaction = array(
            ':DebitAccountBalance'      => $jsonMpesaResponse['DebitAccountBalance'],
            ':Amount'                   => $jsonMpesaResponse['Amount'],
            ':TransCompletedTime'       => $jsonMpesaResponse['TransCompletedTime'],
            ':OriginalTransactionID'    => $jsonMpesaResponse['OriginalTransactionID'],
            ':Charge'                   => $jsonMpesaResponse['Charge'],
            ':CreditPartyPublicName'    => $jsonMpesaResponse['CreditPartyPublicName'],
            ':DebitPartyPublicName'     => $jsonMpesaResponse['DebitPartyPublicName']            
    );

   
 
    $log = fopen($logFile, "a");
    fwrite($log, $mpesaResponse);
    fclose($log);

    
    echo $response;

    insert_response_reversal($transaction);

   
?>
