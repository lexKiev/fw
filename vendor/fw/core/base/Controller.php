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
	public $layout;
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
	
	public function getView()
	{
		$viewObject = new View($this->route, $this->layout, $this->view, $this->meta);
		$viewObject->render($this->meta,$this->data);
	}
	
	/**Method for setting data for passing it to views
	 * @param $data
	 */
	public function set($data)
	{
		$this->data = $data;
	}
	
	/**
	 * Method for setting meta for passing it to views
	 * @param string $title
	 * @param string $description
	 * @param string $keywords
	 */
	public function setMeta($title = '', $description = '', $keywords = '')
	{
		$this->meta['title'] = $title;
		$this->meta['description'] = $description;
		$this->meta['keywords'] = $keywords;
	}
}