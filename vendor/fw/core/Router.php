<?php

namespace fw;


class Router
{
	protected static $routes = [];
	protected static $route = [];
	
	/**
	 * Method to add new route rule dynamically
	 * @param $pattern
	 * @param array $route
	 */
	public static function add($pattern, $route = [])
	{
		self::$routes[$pattern] = $route;
	}
	
	/**
	 * Method to get all routes
	 * @return array
	 */
	public static function getRoutes()
	{
		return self::$routes;
	}
	
	/**
	 * Method to get current route
	 * @return array
	 */
	public static function getRoute()
	{
		return self::$route;
	}
	
	/**
	 * Dispatching $url by getting controller name,  its method name (action), normalizing it, include and call requested method
	 * Pattern <domain>/<prefix>/<controller>/<action>
	 * @param $url
	 * @throws \Exception
	 */
	public static function dispatch($url)
	{
		//Check if requested URI match some rule in config\routes.php, first match accepted if no match - throw exception
		if (self::matchRoute($url)) {
			$controller = 'app' . DS . 'controllers' . DS . self::$route['prefix'] . self::$route['controller'] . 'Controller'; //getting controller prefix(if exist) and name from requested URI
			if (class_exists($controller)) { //Check controller exist we will include it
				$controllerObject = new $controller(self::$route); //Creating object of requested controller
				$action = self::lowerCamelCase(self::$route['action']).'Action'; //Getting requested action (controller method)
				if (method_exists($controllerObject,$action)){ //Checking if requesed action available and call it
					$controllerObject->$action();
				} else{
					throw new \Exception("Метод {$controller}::{$action} не найден", 404); //Throw exception and 404 page if no action(controller method) found
				}
			} else {
				throw new \Exception("Контроллер {$controller} не найден", 404); //Throw exception and 404 page if no requested controller found
			}
		} else {
			throw new \Exception('Cтраница не найдена', 404); //Throw exception and 404 page if no routing rule match found (matchRoute($url) returned false)
		}
	}
	
	/**
	 * Method for mathing requested URI for present routing rules in config\routes.php
	 * @param $url
	 * @return bool
	 */
	public static function matchRoute($url)
	{
		foreach (self::$routes as $pattern => $route) {
			if (preg_match("#{$pattern}#", $url, $matches)) { //Check if any pattern from rules math URI
				foreach ($matches as $key => $value) { //Forming array with with controller and action after mathing rule
					if (is_string($key)) {
						$route[$key] = $value;
					}
				}
				if (empty($route['action'])) {
					$route['action'] = 'index'; //If no action match from requested URI set default action - index
				}
				if (!isset($route['prefix'])) { //If no prefix match from requested URI set default prefix - empty
					$route['prefix'] = '';
				} else {
					$route['prefix'] .= '\\'; //If prefix found adding seperator \
				}
				$route['controller'] = self::upperCamelCase($route['controller']); //Normalizing controller name
				self::$route = $route;
				return TRUE;
			}
		}
		return FALSE;
	}
	/**
	 * Methods to make controller name to CamelCase and action names to camelCase standart
	 * @param $name
	 * @return mixed
	 */
	//CamelCase
	public static function upperCamelCase($name)
	{
		return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
	}
	
	//camelCase
	public static function lowerCamelCase($name)
	{
		return lcfirst(self::upperCamelCase($name));
	}
	
}