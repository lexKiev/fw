<?php

namespace app\widgets\currency;


use fw\App;

class Currency
{
	protected $tpl;
	protected $currencies;
	protected $currency;
	
	public function __construct()
	{
		$this->tpl = __DIR__ . DS . 'currency_tpl' . DS . 'currency.php'; //Template path
		$this->run();
	}
	
	protected function run()
	{
		$this->currencies = App::$app->getProperty('currencies'); //Getting all currencies from global register
		$this->currency = App::$app->getProperty('active_currency'); //Getting active currencies from global register
		echo $this->getHtml();
	}
	
	/**
	 * Rendering HTML widget content
	 * @return string
	 */
	public function getHtml()
	{
		ob_start();
		require_once $this->tpl;
		return ob_get_clean();
	}
	
	/**
	 * Static method for getting currency list from DB
	 * @return array
	 */
	public static function getCurrencies()
	{
		return \R::getAssoc("SELECT code, title, symbol_left, symbol_right, value, base FROM currency ORDER BY base DESC");
	}
	
	/**
	 * Static method for getting active currency, checking if cookie with selected currency is set,
	 * and its correspond available currencies list.
	 * If cookie not set or its incorrect - using default(base) currency .
	 * @param $currencies
	 * @return mixed
	 */
	public static function getCurrency($currencies)
	{
		if (isset($_COOKIE['currency']) && array_key_exists($_COOKIE['currency'], $currencies)) {
			$key = $_COOKIE['currency']; //Using currency from cookie
		} else {
			$key = key($currencies); //Else using base currency
		}
		$currency = $currencies[$key];
		$currency['code'] = $key;
		return $currency;
	}
}