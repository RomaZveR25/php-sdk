<?php

header('Content-Type: text/html; charset=UTF-8');

/**
 * Get project commissions
 *
 * @link https://help.unitpay.ru/article/149-project-commissions
 */
 
require_once('../../UnitPay.php');

$secretKey  = '2907b9e4a48d9450b6f125b8f184be8a';

$projectId  = 1;

$unitPay = new UnitPay($secretKey);

try {

	$response = $unitPay->api('getCommissions', [
		'projectId' => $projectId,
		'login' => 'example@example.com',
	]);

	if (isset($response->result)) {
		$commissions = $response->result;
		var_dump($commissions);
	// If error during api request
	} elseif (isset($response->error->message)) {
		$error = $response->error->message;
		print 'Error: '.$error;
	}

// Oops! Something went wrong.
} catch (Exception $e) {
    print $unitPay->getErrorHandlerResponse($e->getMessage());
}