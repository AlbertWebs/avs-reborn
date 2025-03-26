<?php 
function insert_response($jsonMpesaResponse){
    $dbName = 'amaniveh_updates';
    $dbHost = 'amanivehiclesounds.co.ke';
    $dbUser = 'amaniveh_updates';
    $dbPass = 'USt+${gZ@k=_';
     try {
        $con = new PDO("mysql:dbhost=$dbHost;dbname=$dbName", $dbUser, $dbPass);
     }
     catch(PDOException $e){
        //  Log Error if Connections fail  
			die("Error Connecting ".$e->getMessage());
        }
	# 1.1.1 establish a connection
	try{
		$con = new PDO("mysql:dbhost=$dbHost;dbname=$dbName", $dbUser, $dbPass);
		echo "Connection was successful";
	}
	catch(PDOException $e){
		die("Error Connecting ".$e->getMessage());
	}

	# 1.1.2 Insert Response to Database
	try{
		$insert = $con->prepare("INSERT INTO `mobile_payments`(`TransactionType`, `TransID`, `TransTime`, `TransAmount`, `BusinessShortCode`, `BillRefNumber`, `InvoiceNumber`, `OrgAccountBalance`, `ThirdPartyTransID`, `MSISDN`, `FirstName`, `MiddleName`, `LastName`) VALUES (:TransactionType, :TransID, :TransTime, :TransAmount, :BusinessShortCode, :BillRefNumber, :InvoiceNumber, :OrgAccountBalance, :ThirdPartyTransID, :MSISDN, :FirstName, :MiddleName, :LastName)");
		$insert->execute((array)($jsonMpesaResponse));

		# 1.1.2o Optional - Log the transaction to a .txt or .log file(May Expose your transactions if anyone gets the links, be careful with this. If you don't need it, comment it out or secure it)
		$Transaction = fopen('Transaction.txt', 'a');
		fwrite($Transaction, json_encode($jsonMpesaResponse));
		fclose($Transaction);
	}
	catch(PDOException $e){

		# 1.1.2b Log the error to a file. Optionally, you can set it to send a text message or an email notification during production.
		$errLog = fopen('error.txt', 'a');
		fwrite($errLog, $e->getMessage());
		fclose($errLog);

		# 1.1.2o Optional. Log the failed transaction. Remember, it has only failed to save to your database but M-PESA Transaction itself was successful. 
		$logFailedTransaction = fopen('failedTransaction.txt', 'a');
		fwrite($logFailedTransaction, json_encode($jsonMpesaResponse));
		fclose($logFailedTransaction);
	}
}

function insert_response_reversal($jsonMpesaResponse){
	$dbName = 'amaniveh_new';
    $dbHost = 'amanivehiclesounds.co.ke';
    $dbUser = 'amaniveh';
    $dbPass = 'q7P#v3aX]FY1j5';
     try {
        $con = new PDO("mysql:dbhost=$dbHost;dbname=$dbName", $dbUser, $dbPass);
     }
     catch(PDOException $e){
        //  Log Error if Connections fail  
			die("Error Connecting ".$e->getMessage());
        }
	# 1.1.1 establish a connection
	try{
		$con = new PDO("mysql:dbhost=$dbHost;dbname=$dbName", $dbUser, $dbPass);
		echo "Connection was successful";
	}
	catch(PDOException $e){
		die("Error Connecting ".$e->getMessage());
	}

	# 1.1.2 Insert Response to Database
	try{
		$insert = $con->prepare("INSERT INTO `reverse_transaction`(`TransCompletedTime`, `OriginalTransactionID`, `Charge`, `Amount`, `DebitPartyPublicName`, `DebitAccountBalance`,`CreditPartyPublicName`) VALUES (:TransCompletedTime, :OriginalTransactionID, :Charge, :Amount, :DebitPartyPublicName, :DebitAccountBalance, :CreditPartyPublicName)");
		$insert->execute((array)($jsonMpesaResponse));

		# 1.1.2o Optional - Log the transaction to a .txt or .log file(May Expose your transactions if anyone gets the links, be careful with this. If you don't need it, comment it out or secure it)
		$Transaction = fopen('TransactionReversal.txt', 'a');
		fwrite($Transaction, json_encode($jsonMpesaResponse));
		fclose($Transaction);
	}
	catch(PDOException $e){

		# 1.1.2b Log the error to a file. Optionally, you can set it to send a text message or an email notification during production.
		$errLog = fopen('error.txt', 'a');
		fwrite($errLog, $e->getMessage());
		fclose($errLog);

		# 1.1.2o Optional. Log the failed transaction. Remember, it has only failed to save to your database but M-PESA Transaction itself was successful. 
		$logFailedTransaction = fopen('failedTransaction.txt', 'a');
		fwrite($logFailedTransaction, json_encode($jsonMpesaResponse));
		fclose($logFailedTransaction);
	}
}

function insert_stk_transaction($jsonLNMOMpesaResponse){
	$dbName = 'amaniveh_new';
    $dbHost = 'amanivehiclesounds.co.ke';
    $dbUser = 'amaniveh';
    $dbPass = 'q7P#v3aX]FY1j5';

    
     try {
        $con = new PDO("mysql:dbhost=$dbHost;dbname=$dbName", $dbUser, $dbPass);
     }
     catch(PDOException $e){
        //  Log Error if Connections fail  
			die("Error Connecting ".$e->getMessage());
        }
	# 1.1.1 establish a connection
	try{
		$con = new PDO("mysql:dbhost=$dbHost;dbname=$dbName", $dbUser, $dbPass);
		echo "Connection was successful";
	}
	catch(PDOException $e){
		die("Error Connecting ".$e->getMessage());
	}

	# 1.1.2 Insert Response to Database
	try{
		$insert = $con->prepare("INSERT INTO `lnmo_api_response`(`Amount`, `MpesaReceiptNumber`, `TransactionDate`, `PhoneNumber`) VALUES (:Amount, :MpesaReceiptNumber, :TransactionDate, :PhoneNumber)");
		$insert->execute((array)($jsonLNMOMpesaResponse));
		
		# 1.1.2o Optional - Log the transaction to a .txt or .log file(May Expose your transactions if anyone gets the links, be careful with this. If you don't need it, comment it out or secure it)
		$Transaction = fopen('LNMOTransaction.log', 'a');
		fwrite($Transaction, json_encode($jsonLNMOMpesaResponse));
		fclose($Transaction);
	}
	catch(PDOException $e){
		# 1.1.2b Log the error to a file. Optionally, you can set it to send a text message or an email notification during production.
		$this->error_log($e, $MpesaResponse = $jsonLNMOMpesaCatchResponse);
		
	}
}


// Process Stk
function lnmo_process($lnmoRaw){

		/**
		*
		* Create Transaction Object into php array
		*
		*/

		$lnmoResult = $lnmoRaw->Body->stkCallback->CallbackMetadata->Item;
		$lnmoResult = json_encode($lnmoResult);
		$lnmoResult = json_decode($lnmoResult, TRUE);

		/*
		*
		* Create new array, with required order
		* for inserting to db
		*/

		$requiredData = [];
		foreach ($lnmoResult as $nonreq => $params) {
			foreach ($params as $key => $value) {
				if($value !== 'Balance'){
					$requiredData[] = $value;
				}
			}
		}
		$data = [];

		/**
		*
		* Convert keys to prepared placeholders
		*
		*/

		for($i = 0; $i < count($requiredData); $i+=2){
			$data[':'.$requiredData[$i]] = $requiredData[$i+1];
		}


		/**
		*
		* Call Method to insert to db
		*
		*/
		
		$this->insert_lnmo_transaction($jsonLNMOMpesaResponse = $data);
		return true;
	}


?>