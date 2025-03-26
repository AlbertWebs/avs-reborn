<?php
	require 'processTransactions.class.php';


	$processTransactions = new processTransactions;
	$jsonObject = file_get_contents('php://input');
	// Write To File
	$logFile = "BalanceResponse.json";

 
    $log = fopen($logFile, "a");
    fwrite($log, $jsonObject);
    fclose($log);

	$accBalJson = json_decode($jsonObject);

	if($accBalJson->Result->ResultCode == 0){
		$processTransactions->account_balance($accBalJson);
	}
	else{
		echo "Transaction Failed before you knew it";
	}

