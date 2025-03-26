<?php
 // Response from M-PESA Stream
    $mpesaResponse = file_get_contents('php://input');

    // log the response
    $logFile = "BalanceResponse.json";

 
    $log = fopen($logFile, "a");
    fwrite($log, $mpesaResponse);
    fclose($log);

    echo $response;
