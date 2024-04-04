<?php
if (!defined('FLUX_ROOT')) exit;

$this->loginRequired(Flux::message('LoginToDonate'));
function cFormat($number,$decimal=8){
  return bcdiv(format_amount_with_no_e($number), 1, $decimal)+0;
}
function format_amount_with_no_e($float){
    $parts = explode('E', $float);
    if (count($parts) === 2) {
        $exp = abs(end($parts)) + strlen($parts[0]);
        $decimal = number_format($float, $exp);
        return rtrim($decimal, '.0');
    } else {
        return $float;
    }
}
function cURLPost($url,$params,$headers=null){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  if($headers!=null || !empty($headers)){
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  }
  curl_setopt($ch, CURLOPT_REFERER, $_SERVER['SERVER_NAME']);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
  curl_setopt($ch, CURLOPT_ENCODING, '');
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
  $request = curl_exec($ch);
  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  if($httpCode==200){
    return json_decode($request, true);
  }else{
  }
}

$title = 'Make a Donation using Crypto';
$donationType = false;
$donationAmount = false;
$donationCredits = false;
$session            = Flux::$sessionData;
$customDataArray    = array('server_name' => $session->loginAthenaGroup->serverName, 'account_id' => $session->account->account_id);
$customDataEscaped  = htmlspecialchars(base64_encode(serialize($customDataArray)));

if (count($_POST) && $params->get('setamount')) {
    
	$payment_type  = $params->get('payment_type');

    if(!empty($payment_type)){
        if($payment_type=="bitcoin"){
			$currency_type = "BTC";
            $minimum = Flux::config('MinDonationAmountBTC');
        }elseif($payment_type=="ethereum"){
			$currency_type = "ETH";
            $minimum = Flux::config('MinDonationAmountETH');
        }elseif($payment_type=="litecoin"){
			$currency_type = "LTC";
            $minimum = Flux::config('MinDonationAmountLTC');
        }elseif($payment_type=="dogecoin"){
			$currency_type = "DOGE";
            $minimum = Flux::config('MinDonationAmountDOGE');
        }elseif($payment_type=="dash"){
			$currency_type = "DASH";
            $minimum = Flux::config('MinDonationAmountDASH');
        }elseif($payment_type=="tron"){
			$currency_type = "TRX";
            $minimum = Flux::config('MinDonationAmountTRON');
        }elseif($payment_type=="binancecoin"){
			$currency_type = "BNB";
            $minimum = Flux::config('MinDonationAmountBNB');
        }elseif($payment_type=="tron_trc20" || $payment_type=="binancesmartchain_bep20" || $payment_type=="ethereum_erc20"){
			$currency_type = "USDT";
            $minimum = Flux::config('MinDonationAmountTether');
        }else{
            $minimum = Flux::config('MinDonationAmount');
        }
    }
	$amount  = (float)$params->get('amount');

	if (!$amount || $amount < $minimum) {
		$errorMessage = sprintf('Donation amount for %s must be greater than or equal to %s %s!', strtoupper($payment_type),
			$this->formatCurrency($minimum), Flux::config('DonationCurrency'));
	} else {
		$donationAmount = $amount;
        $donationType = $payment_type;
        $donationCredits = htmlspecialchars(intval($amount / Flux::config('CreditExchangeRate')));

		if($donationType=="tron_trc20" || $donationType=="binancesmartchain_bep20" || $donationType=="ethereum_erc20"){
			$amount_in_coin = $donationAmount;
		}else{
			// get the rate first, from USD to COIN
			$address = "";
			$amount_in_coin = 0;
			$params_string = array(
				'currency_in' => "usd",
				'currency_out' => $currency_type,
			);
			$params_string = json_encode($params_string);
			$url = "https://currency.xpayapi.com/";
			$getjson = cURLPost($url,$params_string);
			if(isset($getjson['error']) && $getjson['error']){
				// do here if error found
				$amount_in_coin = 0;
			}else{
				$getRate = (float)$getjson['data']['value'];
				$amount_in_coin = cFormat(intval($donationAmount / $getRate));
			}
		}

		if($amount_in_coin>0){
			// get the address for invoice USDT TRC20
			require_once 'lib/xpayapi_sci.class.php';
			$secret_keys_and_config = [
				"merchant_id" => Flux::config('merchant_id'),
				"merchant_password" => Flux::config('merchant_password'),
				"config" => [
					"test_mode" => false,
				],
			];
			$system_id = [
				"bitcoin"		=> 20, // BTC
				"ethereum"		=> 21, // ETH
				"litecoin"		=> 22, // LTC
				"dash"			=> 23, // DASH
				"dogecoin"		=> 24, // DOGE
				"binancecoin"	=> 25, // BNB    
				"tron"			=> 26, // TRX
				"tron_trc20"	=> 27, // USDT    
				"binancesmartchain_bep20" => 28, // USDT BEP20
				"ethereum_erc20" => 32, // USDT ERC20
			];

			$invoice_hash = md5(time());
			$order_id = $invoice_hash;
			$comment  = 'User ID: '.$session->account->userid . ' ('.$session->account->account_id.') donate $' . $donationAmount;

			$xPayApi_params = [
				"amount" => $amount_in_coin,
				"system" => strtolower($donationType),
				"currency" => $currency_type,
				"order_id" => $order_id,
				"comment" => $comment,
				"address_callback" => "",
				"custom" => $customDataEscaped,
			];
			$xPayApi = new \xPayApi\xPayApiSCI(
				$secret_keys_and_config["merchant_id"],
				$secret_keys_and_config["merchant_password"],
				$secret_keys_and_config["config"]["test_mode"]
			);
			$res = $xPayApi->createAddress(
				$xPayApi_params["amount"],
				$xPayApi_params["system"],
				$xPayApi_params["currency"],
				$xPayApi_params["order_id"],
				$xPayApi_params["comment"],
				$xPayApi_params["address_callback"],
				$xPayApi_params["custom"]
			);

			if ($res['error']) {
				// do error here
				echo "<pre>";
				print_r($res);
				echo "</pre>";
			} else {
				$invoice_address = $res['data']['address'];
				$redirect_url = '?module=donatecrypto&action=invoice&id='.$res['data']['invoice'];
				
				// add invoice in database
				$values = array($session->account->account_id,$res['data']['invoice'],$res['data']['order_id'],$invoice_address,$donationAmount,$amount_in_coin,$donationCredits,$res['data']['currency'],$res['data']['notif_url'], 0, date('Y-m-d H:i:s'), $customDataEscaped);
				$invoiceTables    = Flux::config('FluxTables.invoiceTable');
				$sql = "INSERT into {$server->loginDatabase}.{$invoiceTables} (account_id, invoice, order_id, `address`, amount, amount_in_coin, amount_credits, currency, `url`, `status`, created_at, `description`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";$sth = $server->connection->getStatement($sql);$sth->execute($values);
				header('Location: ' .$res['data']['pay_link'], true, 303);exit();
			}
		}
	}

}
?>