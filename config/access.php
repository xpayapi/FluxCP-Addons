<?php
/**
 * THIS WORK IS COPYRIGHTED
 * Payment Gateway Crypto https://xPayapi.com
 * --------------------------------------------------------------------
 * Contact: 
 * Discord: xpayapi
 */
return array(
	'modules' => array(
		'donatecrypto' => array(
			'index'    => AccountLevel::ANYONE,
			'notify'   => AccountLevel::ANYONE,
			'clear'    => AccountLevel::ANYONE,
			'update'   => AccountLevel::ANYONE,
			'complete' => AccountLevel::ANYONE,
			'debug'    => AccountLevel::ANYONE,
			'history'  => AccountLevel::NORMAL,
			'cancel'   => AccountLevel::ANYONE,
			'invoice'   => AccountLevel::ANYONE,
			'process'   => AccountLevel::ANYONE,
			'prunes'   => AccountLevel::ANYONE,
			'trusted'  => AccountLevel::NORMAL
		)
	),
	'features' => array(
		// None.
	)
);
?>