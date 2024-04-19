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
		'crypto' => array(
			'index'    => AccountLevel::ANYONE,
			'notify'   => AccountLevel::ANYONE,
			'update'   => AccountLevel::ANYONE,
			'complete' => AccountLevel::ANYONE,
			'history'  => AccountLevel::NORMAL,
			'cancel'   => AccountLevel::ANYONE,
			'invoice'   => AccountLevel::ANYONE,
			'process'   => AccountLevel::ANYONE,
			'trusted'  => AccountLevel::NORMAL
		)
	),
	'features' => array(
		// None.
	)
);
?>