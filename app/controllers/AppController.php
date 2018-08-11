<?php

namespace app\controllers;

use app\models\AppModel;
use app\widgets\currency\Currency;
use fw\App;
use fw\base\Controller;
use fw\Cache;

/**
 * Global controller class that extending core controller, all application-depended functions should be here
 * all other controllers should extend this one
 */
class AppController extends Controller
{
	public function __construct($route)
	{
		parent::__construct($route);
		new AppModel();
		App::$app->setProperty('currencies', Currency::getCurrencies()); //Getting currencies data from Currency widget to global register
		App::$app->setProperty('active_currency', Currency::getCurrency(App::$app->getProperty('currencies')));
		App::$app->setProperty('cats', self::cacheCategory());//Getting all categories to global register
	}
	
	/**
	 * Method for caching all categories array
     * if no chached data exist it will cache and return it
     * if cache exist it will return it
	 * @return array|bool|mixed
	 */
	public static function cacheCategory()
	{
		$cats = Cache::get('cats');
		if (!$cats) {
			$cats = \R::getAssoc('SELECT * FROM category');
			Cache::set('cats', $cats);
		}
		return $cats;
	}
}