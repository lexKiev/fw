<?php

namespace app\controllers;

use fw\App;

/**
 * Class CurrencyController for changing currency and recalculating prices
 * @package app\controllers
 */
class CurrencyController extends AppController
{
	public function changeAction(){
		
		$currency = !empty($_GET['curr']) ? $_GET['curr'] : null;
		
		if ($currency) {
			$curr = App::$app->getProperty("currencies");
			//$curr = $curr['UAH'];
			//$curr = \R::findOne('currency', 'code = ?', [$currency]);
			if(!empty($curr)){
				setcookie('currency', $currency, time() + 3600*24*7, '/');
			}
		}
		header("Location: https://www.google.com.ua/");
		redirect();
	}
}