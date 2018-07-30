<?php

header('Content-Type: text/html; charset=UTF-8');

/**
 * Mass Payment status
 *
 * @link https://help.unitpay.ru/article/79-masspayment-status
 */
 
require_once('../../UnitPay.php');

$secretKey  = '2907b9e4a48d9450b6f125b8f184be8a';

//Make sure its unique string or number and stored in database
$transactionId = '12345';

$unitPay = new UnitPay($secretKey);

try {

	$response = $unitPay->api('massPaymentStatus', [
		'login' => 'example@example.com',
		'transactionId' => $transactionId,
	]);

	if (isset($response->result)) {
		// Payout Info
		$payoutInfo = $response->result;
		var_dump($payoutInfo);
	// If error during api request
	} elseif (isset($response->error->message)) {
		$error = $response->error->message;
		print 'Error: '.$error;
	}

// Oops! Something went wrong.
} catch (Exception $e) {
    print $unitPay->getErrorHandlerResponse($e->getMessage());
}