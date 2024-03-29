<?php
/**
 * THIS WORK IS COPYRIGHTED
 * Cashshop Log
 * --------------------------------------------------------------------
 * Contact: 
 * Discord: єℓƒιη#9444
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
			'prunes'   => AccountLevel::ANYONE,
			'trusted'  => AccountLevel::NORMAL
		)
	),
	'features' => array(
		// None.
	)
)
?>