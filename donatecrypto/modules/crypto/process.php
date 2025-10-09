<?php
if (!defined('FLUX_ROOT')) exit;


if (count($_REQUEST)) {
    $getres = $_REQUEST;
    unset($_REQUEST);
    require_once 'Flux/PaymentNotifyRequestCoin.php';
    if (count($getres)) {
        $request = new Flux_PaymentNotifyRequestCoin($getres);
        $request->process();
    }
    $getres = json_decode(file_get_contents('php://input'), true);
}
if (isset($_POST) || count($_POST)) {
    $getres = $_POST;
    unset($_POST);
    require_once 'Flux/PaymentNotifyRequestCoin.php';
    if (count($getres)) {
        $request = new Flux_PaymentNotifyRequestCoin($getres);
        $request->process();
    }
    $getres = json_decode(file_get_contents('php://input'), true);
}
?>
