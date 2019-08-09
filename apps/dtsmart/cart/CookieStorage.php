<?php
/**
 * @link https://www.github.com/dtsmart/yii2-cart
 * @copyright Copyright (c) 2016 HafidMukhlasin.com
 * @license http://www.yiiframework.com/license/
 */
 
namespace dtsmart\cart;

/**
 * CookieStorage is extended from Storage Class
 * 
 * It's specialty for handling read and write cart data into cookie
 *
 * Usage:
 * Configuration in block component look like this
 *		'cart' => [
 *			'class' => 'dtsmart\cart\Cart',
 *			'storage' => [
 *				'class' => 'dtsmart\cart\CookieStorage',
 *			]
 *		],
 *
 * @author Hafid Mukhlasin <hafidmukhlasin@gmail.com>
 * @since 1.0
 *
*/

class CookieStorage extends Storage
{
    public $duration = 3600;
	public function read(Cart $cart)
	{
		$cookies = \Yii::$app->request->cookies;
		if ($cookies->has($cart->id))
        {
            $value = $cookies->getValue($cart->id);
            $this->unserialize($value,$cart);
        }

	}
	
	public function write(Cart $cart)
	{
		$cookies = \Yii::$app->response->cookies;
		$cookies->add(new \yii\web\Cookie([
			'name' => $cart->id,    
			'value' => $this->serialize($cart),
            'expire' => time() + $this->duration
		]));		
			
	}
	
	public function lock($drop, Cart $cart)
	{
		// not implemented, only for db
	}
}