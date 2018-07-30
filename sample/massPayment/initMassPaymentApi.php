<?php

header('Content-Type: text/html; charset=UTF-8');

/**
 * Init Mass Payment
 *
 * @link https://help.unitpay.ru/article/62-masspayment
 */
 
require_once('../../UnitPay.php');

$projectId  = 1;
$secretKey  = '2907b9e4a48d9450b6f125b8f184be8a';

//Make sure its unique string or number and stored in database before request mass payment
$transactionId = '12345';

$unitPay = new UnitPay($secretKey);

try {

	$response = $unitPay->api('massPayment', [
		'login' => 'example@example.com',
		'projectId' => $projectId,
		'transactionId' => $transactionId,
		'purse' => '79991110000',
		'sum' => 10.22,
		'paymentType' => 'qiwi'
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