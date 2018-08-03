<?php

namespace fw\base;

/**
 * This is the base Controller class operating core data and route data and passing it to app/controllers/AppController.php
 * this data is global for all controllers and its belongs to fw core, no application depended actions should be here
 * @package fw\base
 */
abstract class Controller
{
	public $route;
	public $controller;
	public $model;
	public $view;
	public $prefix;
	public $data = [];
	public $meta = [];
	
	public function __construct($route)
	{
		$this->route = $route;
		$this->controller = $route['controller'];
		$this->model = $route['controller'];
		$this->view = $route['action'];
		$this->prefix = $route['prefix'];
	}
	
	/**Method for setting data for passing it to views
	 * @param $data
	 */
	public function set($data){
		$this->data = $data;
	}
	
	/**
	 * Method for setting meta for passing it to views
	 * @param string $title
	 * @param string $descr
	 * @param string $keywords
	 */
	public function setMeta($title ='', $descr = '', $keywords = ''){
		$this->meta['title'] = $title;
		$this->meta['descr'] = $descr;
		$this->meta['keywords'] = $keywords;
	}
}