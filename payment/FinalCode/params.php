<?php
	date_default_timezone_set("Africa/Nairobi");


    require 'paymentsAPI.class.php';

    $consumerKey =  'QIi4GKdy4TOqbCTkWB6VMIJ6EpdHYGwg';
    $consumerSecret = 'Kq0iAKSKeLjXEtBe';

    # This class contains the method for simulating the transaction
    $BusninessAPI = new MobilePayments($consumerKey, $consumerSecret);

	$ShortCode = '600120';
	$BusinessShortCode = '174379';
	$Initiator = 'testapi120';
	$msisdn = '254708374149'; 
	$Timestamp = date('YmdHis');
	$Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
	$Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

	$securityCredential = 'ACNrhORgjFdOjb4zWil90AW5qNZ6JYG7lxFNoldpf0X+RX/AERhRgwty4ttU8ufvFyFYdeGQAP2+cCUkBOcZFjckeCLEwpxAZga7CXrmnLIG4GQOnjWHn/YLKjw0d+TyYB8ouMotCNCRCUHDC5CoIBc+KJRakxabO3QqvWVxg+kIz/NxOZ6QwQF/ICHRMR1gHZ4zumJeCS7MJ1BDxzBbHXQuiXJO7nnjJ99SPAVnMwo2shqY2ytYT4QYDMQOYVs/Nmbqq3Fv4bKXuWiR91ntm9kSx8WAEV0m9h1WZw6U5xwTE1CcfSNd226OtzqdPdEm6/Fjq65SOI0ttvizJL8rxw==';

	# register url URLs
	$confirmationUrl = 'https://amanivehiclesounds.co.ke/payments/confirmation_url.php';
	$validationUrl = 'https://amanivehiclesounds.co.ke/payments/validation_url.php';

	/* b2b urls */
	$QueueTimeOutURL = '';
	$B2BResultURL = '';

	/* b2c urls */
	$B2CResultURL = '';
	$Occasion = '';


	/* reverse api urls */
	$reversalResultURL = 'https://amanivehiclesounds.co.ke/payments/reverseresponce.php';


	/* lnmo api urls */
	$lnmoCallBackURL = 'https://amanivehiclesounds.co.ke/payments/callback_url.php';

	/* transaction status api urls */
	$transactionStatusResultURL = '';

	/* account balance api urls */
	$AccountBalanceResultURL = 'https://amanivehiclesounds.co.ke/payments/balanceresponce.php';
	$AccountBalanceQueueTimeOutURL = 'https://amanivehiclesounds.co.ke/payments/balanceresponce.php';
	
?>