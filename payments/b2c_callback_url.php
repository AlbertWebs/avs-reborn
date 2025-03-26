<?php
	require 'processTransactions.class.php';

	$processTransactions = new processTransactions;

	$jsonObject = file_get_contents('php://input');
	// Writing The File
	$logFile = "M_PESAConfirmationB2CResponse.json";
    $log = fopen($logFile, "a");
    fwrite($log, $jsonObject);
	fclose($log);
	
	$b2cJsonObject = json_decode($jsonObject);
	if($b2cJsonObject->Result->ResultCode == 0){
		$processTransactions->bc2_process($b2cJsonObject);		
	}
	else{
		echo "Transaction Failed before you knew it";
	}
