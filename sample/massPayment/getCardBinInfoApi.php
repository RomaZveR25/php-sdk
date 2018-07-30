<?php

header('Content-Type: text/html; charset=UTF-8');

/**
 * Get info from card BIN code
 *
 * @link https://help.unitpay.ru/article/90-bin-check
 */
 
require_once('../../UnitPay.php');

$secretKey  = '2907b9e4a48d9450b6f125b8f184be8a';

$cardNumber = '4276000000000001';

$unitPay = new UnitPay($secretKey);

try {

	$response = $unitPay->api('getBinInfo', [
		'login' => 'example@example.com',
		'bin' => substr($cardNumber, 0, 6),
	]);

	if (isset($response->result)) {
		$cardInfo = $response->result;
		var_dump($cardInfo);
	// If error during api request
	} elseif (isset($response->error->message)) {
		$error = $response->error->message;
		print 'Error: '.$error;
	}

// Oops! Something went wrong.
} catch (Exception $e) {
    print $unitPay->getErrorHandlerResponse($e->getMessage());
}