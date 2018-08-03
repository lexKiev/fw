<?php

namespace fw;


class App
{
	public static $app;
	
	public function __construct()
	{
		$query = trim($_SERVER['QUERY_STRING'], '/'); //getting URI for routing
		
		session_start();
		
		self::$app = Registry::instance();// container for global register
		$this->getProperties(); //pulling all properties from config/properties.php to global register
		new ErrorHandler();
		Router::dispatch($query); // pass requested URI to router
	}
	
	/**
	 * Method to put all properties from config/properties.php to global register
	 */
	protected function getProperties()
	{
		$properties = require_once CONF . DS . 'properties.php';
		if (!empty($properties)) {
			foreach ($properties as $propertyName => $propertyValue) {
				self::$app->setProperty($propertyName, $propertyValue);
			}
		}
	}
}