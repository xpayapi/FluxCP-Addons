<?php
require_once 'Flux/LogFile.php';
require_once 'Flux/Config.php';
require_once 'Flux/Error.php';

/**
 * Handles Crypto instant payment notifications.
 */
class Flux_PaymentNotifyRequestCoin {
	/**
	 * Logger class for logging to the Crypto log stored on disk.
	 *
	 * @access private
	 * @var Flux_LogFile
	 */
	private $ppLogFile;

	/**
	 * Set to true after the notification has been verified by Crypto.
	 *
	 * @access private
	 * @var bool
	 */
	private $txnIsValid = false;

	/**
	 * Crypto server name to use for verification.
	 *
	 * @access public
	 * @var string
	 */
	public $ppServer;

	/**
	 * Your currently configured Crypto business email.
	 *
	 * @access public
	 * @var string
	 */
	public $myBusinessEmail;

	/**
	 * Your currently configured currency code.
	 *
	 * @access public
	 * @var string
	 */
	public $myCurrencyCode;

	/**
	 * Crypto's IPN variables organized into a Flux_Config instance.
	 *
	 * @access public
	 * @var Flux_Config
	 */
	public $ipnVariables;

	/**
	 * Crypto's Log Table.
	 *
	 * @access public
	 * @var Flux_Config
	 */
	public $CryptotxnLogTable;

	/**
	 * Transactions log table.
	 *
	 * @access public
	 * @var string
	 */
	public $txnLogTable;

	/**
	 * Account credit balance table.
	 *
	 * @access public
	 * @var string
	 */
	public $creditsTable;

	/**
	 * Auto credit in game CP.
	 *
	 * @access public
	 * @var Flux_Config
	 */
	public $auto_credited_ingame;

	/**
	 * Construct new PaymentNotifyRequest instance from specified IPN variables.
	 *
	 * @param array $ipnPostVars
	 * @access public
	 */
	public function __construct(array $ipnPostVars)
	{
		$this->ppLogFile       = new Flux_LogFile(FLUX_DATA_DIR.'/logs/crypto.log');
		$this->ppServer        = Flux::config('CryptoIpnUrl');
		$this->myBusinessEmail = Flux::config('CryptoBusinessEmail');
		$this->myCurrencyCode  = strtoupper(Flux::config('DonationCurrency'));
		$this->ipnVariables    = new Flux_Config($ipnPostVars);
		$this->CryptotxnLogTable     = Flux::config('FluxTables.invoiceTable');
		$this->creditsTable    = Flux::config('FluxTables.CreditsTable');
		$this->auto_credited_ingame     = Flux::config('auto_credited_ingame');
	}

	/**
	 * Log to PayPal log file. Works like printf().
	 *
	 * @param string $format
	 * @param mixed ...
	 * @return string
	 * @access protected
	 */
	protected function logCrypto()
	{
		$args = func_get_args();
		$func = array($this->ppLogFile, 'puts');
		return call_user_func_array($func, $args);
	}
	
	/**
     * Get user IP.
     * Checks if CloudFlare used to get real IP.
     *
     * @access public
     */
    protected function fetchIP()
    {
        $alt_ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_X_REAL_IP'])) {
            $alt_ip = $_SERVER['HTTP_X_REAL_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $alt_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $alt_ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $alt_ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        }

        return $alt_ip;
    }

	/**
	 * Process transaction.
	 *
	 * @access public
	 */
	public function process()
	{
		$allowed_hosts = Flux::config('CryptoAllowedHosts')->toArray();
		$received_from = gethostbyaddr($this->fetchIP());
		$this->logCrypto('Received notification from %s (%s)', $this->fetchIP(), $received_from);
		if (in_array($received_from, $allowed_hosts) || $this->verifyiprange($received_from)) {
			// process here
			$this->logCrypto('Proceeding to validate the authenticity of the transaction...');

            $data_auto_credit = $this->auto_credited_ingame;
			$data_message = $this->ipnVariables->get('message');
			$data_invoice = $this->ipnVariables->get('invoice');
			$data_order_id = $this->ipnVariables->get('order_id');
			$data_address    = $this->ipnVariables->get('address');
			$data_amount    = $this->ipnVariables->get('amount');
			$data_currency    = $this->ipnVariables->get('currency');
			$data_system    = $this->ipnVariables->get('system');
			$data_url    = $this->ipnVariables->get('url');
			$data_batch    = $this->ipnVariables->get('batch');
			$customArray  = @unserialize(base64_decode((string)$this->ipnVariables->get('custom')));
			$customArray  = $customArray && is_array($customArray) ? $customArray : array();
			$customData   = new Flux_Config($customArray);
			$accountID    = $customData->get('account_id');
			$serverName   = $customData->get('server_name');
			$servGroup = Flux::getServerGroupByName($serverName);
			$invoiceTables    = Flux::config('FluxTables.invoiceTable');

			// Identify transaction number.
			$this->logCrypto('Transaction identified as %s.', $data_order_id);

			$sql = "SELECT id,account_id,invoice,order_id,`address`,amount,amount_in_coin,amount_credits,currency,`url`,`status`,created_at FROM {$servGroup->loginDatabase}.$invoiceTables WHERE order_id = ? LIMIT 1";
			$sth = $servGroup->connection->getStatement($sql);
			$sth->execute(array($data_order_id));
			$invoice = $sth->fetch();
			if ($invoice && $invoice->status==0) {
                $sql = "SELECT id FROM {$servGroup->loginDatabase}.$invoiceTables WHERE order_id = ? AND batch = ? LIMIT 1";
                $sth = $servGroup->connection->getStatement($sql);
                $sth->execute(array($data_order_id,$data_batch));
                $batchid = $sth->fetch();
                if (!$batchid) {
                    if ($data_message == 'SUCCESS' && $data_amount>=$invoice->amount_in_coin) {
                        $this->logCrypto('Payment for txn_id#%s has been completed.', $data_order_id);
                        $rate    = Flux::config('CreditExchangeRate');
                        $amountCredits = floor($invoice->amount / $rate);

                        if($data_auto_credit){
                            $AccRegNumTable = Flux::config('FluxTables.AccRegNumTable');
                            $sql = "SELECT * FROM {$servGroup->loginDatabase}.{$AccRegNumTable} WHERE account_id = ? AND `key` = ?";
                            $sth = $servGroup->connection->getStatement($sql);
                            $sth->execute(array($accountID,"#CASHPOINTS"));
                            $acc_num_reg = $sth->fetch();
                            if(!$acc_num_reg){
                                $sql = "INSERT into {$servGroup->loginDatabase}.{$AccRegNumTable} (account_id, `key`, `value`) VALUES (?, ?, ?)";
                                $sth = $servGroup->connection->getStatement($sql);
                                $sth->execute(array($accountID,"#CASHPOINTS",$amountCredits));
                            }else{
                                $sql = "UPDATE {$servGroup->loginDatabase}.{$AccRegNumTable} SET `value` = `value` + ? WHERE account_id = ? AND `key` = ?";
                                $sth = $servGroup->connection->getStatement($sql);
                                $sth->execute(array($amountCredits,$accountID,"#CASHPOINTS"));
                            }
                        }else{
                            $sql = "SELECT * FROM {$servGroup->loginDatabase}.{$this->creditsTable} WHERE account_id = ?";
                            $sth = $servGroup->connection->getStatement($sql);
                            $sth->execute(array($accountID));
                            $acc = $sth->fetch();
                            if($acc){
                                $this->logCrypto('Updating account credit balance from %s to %s', (int)$acc->balance, $acc->balance + $amountCredits);
                                
                                $res = $servGroup->loginServer->depositCredits($accountID, 0, $amountCredits);
                                if ($res) {
                                    $this->logCrypto('Deposited credits.');
                                }
                                else {
                                    $this->logCrypto('Failed to deposit credits.');
                                }
                            }
                        }
                        $sql = "UPDATE {$servGroup->loginDatabase}.$invoiceTables SET `status` = 1, batch = ? WHERE order_id = ?";
                        $sth = $servGroup->connection->getStatement($sql);
                        $sth->execute(array($data_batch,$data_order_id));
                        die($data_order_id.'|success');
                    }
                }
                else {
                    $this->logCrypto('Failed to credits. Multiple Batch ID %s', $data_batch);
                }
			}
		}
	}

	/*

	*/
	private function verifyiprange($received_from)
	{
		$allowed_hosts = Flux::config('CryptoAllowedHosts')->toArray();
		$ip_long = ip2long ( $received_from );

		for ($i = 0; $i < 72; $i++)
		{
			if(strpos($allowed_hosts[$i], '/') !== false) {
				$ip_arr = explode ( '/' , $allowed_hosts[$i] );

				$network_long = ip2long ( $ip_arr[0] );
		 
				$x = ip2long ( $ip_arr [1]);
				$mask = long2ip ( $x ) == $ip_arr [ 1 ] ? $x : 0xffffffff << ( 32 - $ip_arr [ 1 ]);
			   
				if(( $ip_long & $mask ) == ( $network_long & $mask ))
					return true;
			} else {
				if($allowed_hosts[$i] == $received_from)
					return true;
			}
		}
		return false;
    }
}
?>
