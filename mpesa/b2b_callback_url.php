<?php
 // Response from M-PESA Stream
    $mpesaResponse = file_get_contents('php://input');

    // log the response
    $logFile = "M_PESAConfirmationB2BResponse.json";

 
    $log = fopen($logFile, "a");
    fwrite($log, $mpesaResponse);
    fclose($log);

    echo $response;

   
?>
