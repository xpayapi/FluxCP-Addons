<?php
if (!defined('FLUX_ROOT')) exit;

require_once 'Flux/PaymentNotifyRequestCoin.php';
if (count($_POST)) {
	$request = new Flux_PaymentNotifyRequestCoin($_POST);
	$request->process();
}
exit;
?>
