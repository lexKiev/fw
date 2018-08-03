<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 03.08.2018
 * Time: 15:39
 */

namespace fw\base;


class View
{
	public $route;
	public $controller;
	public $model;
	public $view;
	public $prefix;
	public $layout;
	public $data = [];
	public $meta = [];
	
	public function __construct($route, $layout = '', $view = '', $meta)
	{
		$this->route = $route;
		$this->controller = $route['controller'];
		$this->view = $view;
		$this->model = $route['controller'];
		$this->prefix = $route['prefix'];
		$this->meta = $meta;
		
		if ($layout === FALSE) {
			$this->layout = FALSE;
		} else {
			$this->layout = $layout ?: LAYOUT;
		}
	}
	
	
}