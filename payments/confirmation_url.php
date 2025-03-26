<?php
	require 'processTransactions.class.php';

	$processTransactions = new processTransactions;



	$jsonObject = file_get_contents('php://input');
	// Writting To File
	 $logFile = "M_PESAConfirmationResponse.json";
	 $log = fopen($logFile, "a");
	 fwrite($log, $jsonObject);
	 fclose($log);
 
	$c2bJson = json_decode($jsonObject, true);
	$processTransactions->c2b_process($c2bJson);

	

