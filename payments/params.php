<?php
	date_default_timezone_set("Africa/Nairobi");


    require 'paymentsAPI.class.php';

    $consumerKey =  'QIi4GKdy4TOqbCTkWB6VMIJ6EpdHYGwg';
    $consumerSecret = 'Kq0iAKSKeLjXEtBe';

    # This class contains the method for simulating the transaction
    $BusninessAPI = new MobilePayments($consumerKey, $consumerSecret);

	$ShortCode = '600613';
	$BusinessShortCode = '174379';
	$Initiator = 'TestInit613';
	$msisdn = '254708374149'; 
	$Timestamp = date('YmdHis');
	$Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
	$Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

	$securityCredential = 'F5TWkQU8Qvd4jJ2K1lByIL+Pqjd+wqXBIDlxAkOqbP3fumaqusfE7LKte+Dk/jDxYavgPoc2ukvD1kQaRQ7DfjIT4zVH95Obrdo9LoCqopRlMujDPO9wfZn+V/ORqWrTj6ZTMflgGGU2bpwTh0BKNM6nym5+KgLYWT0QvPOnUbunUh6gWfjo0ferDvveYwE0YXMtrzbGQyb6IJmPLV1LNyl1Vpq2m5su1ENsPXOQtsm5uZFG5uXIzzP9wr5BPyxkZs7X67DPY6CH2f2oBic8boWjFJKt25QMl6YhKB0RPTA28mYitzjErA+LpcwJisHw/glDARjscmPyMQYZ5NVxvQ==';

	# register url URLs
	$confirmationUrl = 'https://amanivehiclesounds.co.ke/payments/confirmation_url.php';
	$validationUrl = 'https://amanivehiclesounds.co.ke/payments/validation_url.php';

	/* b2b urls */
	$QueueTimeOutURL = 'https://amanivehiclesounds.co.ke/payments/b2b_callback_url.php';
	$B2BResultURL = 'https://amanivehiclesounds.co.ke/payments/b2b_callback_url.php';

	/* b2c urls */
	$B2CResultURL = 'https://amanivehiclesounds.co.ke/payments/b2c_callback_url.php';
	$Occasion = 'https://amanivehiclesounds.co.ke/payments/b2c_callback_url.php';


	/* reverse api urls */
	$reversalResultURL = 'https://amanivehiclesounds.co.ke/payments/reverseresponce.php';


	/* lnmo api urls */
	$lnmoCallBackURL = 'https://amanivehiclesounds.co.ke/payments/callback_url.php';

	/* transaction status api urls */
	$transactionStatusResultURL = 'https://amanivehiclesounds.co.ke/payments/transactionstatus_callback_url.php';

	/* account balance api urls */
	$AccountBalanceResultURL = 'https://amanivehiclesounds.co.ke/payments/balanceresponce.php';
	$AccountBalanceQueueTimeOutURL = 'https://amanivehiclesounds.co.ke/payments/balanceresponce.php';
	
?>