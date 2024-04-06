<?php
/**
 * THIS WORK IS COPYRIGHTED
 * Payment Gateway Crypto https://xPayapi.com
 * --------------------------------------------------------------------
 * Contact: 
 * Discord: xpayapi
 */
return array(
	'MinDonationAmountBTC'	=> 10, // Minimum Bitcoin amount.
	'MinDonationAmountETH'	=> 10, // Minimum Ethereum amount.
	'MinDonationAmountLTC'	=> 5, // Minimum Litecoin amount.
	'MinDonationAmountDOGE'	=> 5, // Minimum Dogecoin amount.
	'MinDonationAmountDASH'	=> 5, // Minimum Dash amount.
	'MinDonationAmountBNB'		=> 5, // Minimum BNB amount.
	'MinDonationAmountShibaBEP20' => 5, // Minimum Shiba BEP20 amount.
	'MinDonationAmountTRON'		=> 5, // Minimum Tron amount.
	'MinDonationAmountTETHER'	=> 5, // Minimum Tether amount.
    
	'auto_credited_ingame'				=> '1', // 0 to disable automatic credits to in game CP, if set to 0 then you need a NPC to exchange Web Credits to In Game CP
	'merchant_id'				=> '', // get from https://xpayapi.com
	'merchant_password'			=> '', // get from https://xpayapi.com
	'CryptoIpnUrl'				=> 'https://api.xpayapi.com/',
	'CryptoBusinessEmail'		=> 'youremail@gmail.com',	'CryptoAllowedHosts'        => array(
		'xpayapi.com',
		'api.xpayapi.com',
		'103.134.152.4',
		'103.134.152.4/24',
	),

	'MenuItems'		=> array(
		'DonationsLabel'		=> array(
			'Donate Crypto'		=> array('module' => 'crypto'),
		),
	),
	'SubMenuItems' => array(
		'crypto' => array(
			'history'  => 'Donation History',
		),
	),

	'FluxTables'		=> array(
		'invoiceTable'			=> 'crypto_invoice',
    )
);
?>