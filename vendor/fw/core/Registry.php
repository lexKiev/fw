<?php

namespace fw;

/**
 * Class Registry for global properties storage
 */
class Registry
{
	use TSingleton;
	
	protected static $properties = array();
	
	/**
	 * Method for getting global property by its name
	 * @param $name
	 * @return mixed|null
	 */
	public function getProperty($name)
	{
		if (isset(self::$properties[$name])) {
			return self::$properties[$name];
		} else {
			return NULL;
		}
		
	}
	
	/**
	 * Method for setting property name and its value to global register
	 * @param $name;
	 * @param $value
	 */
	public function setProperty($name, $value)
	{
		self::$properties[$name] = $value;
	}
	
	/**
	 * Method for getting full list of properties
	 * @return array
	 */
	public function getProperties()
	{
		return self::$properties;
	}
}