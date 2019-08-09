<?php
/**
 * @link https://www.github.com/dtsmart/yii2-cart
 * @copyright Copyright (c) 2016 HafidMukhlasin.com
 * @license http://www.yiiframework.com/license/
 */
 
namespace dtsmart\cart;

/**
 * SessionStorage is extended from Storage Class
 * 
 * It's specialty for handling read and write cart data into session
 *
 * Usage:
 * Configuration in block component look like this
 *		'cart' => [
 *			'class' => 'dtsmart\cart\Cart',
 *			'storage' => [
 *				'class' => 'dtsmart\cart\SessionStorage',
 *			]
 *		],
 *
 * @author Hafid Mukhlasin <hafidmukhlasin@gmail.com>
 * @since 1.0
 *
*/

class SessionStorage extends Storage
{
	public function read(Cart $cart)
	{
		$session = \Yii::$app->session;
		if ($session->has($cart->id))
			$this->unserialize($session->get($cart->id),$cart);
	}
	
	public function write(Cart $cart)
	{
		$session = \Yii::$app->session;
		$session->set($cart->id,$this->serialize($cart));
	}
	
	public function lock($drop, Cart $cart)
	{
		// not implemented, only for db
	}
}