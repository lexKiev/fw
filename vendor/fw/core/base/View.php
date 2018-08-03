<?php

namespace fw\base;

/**
 * Class View recieve data from controller and render requested view
 */
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
		
		//Сhecking if layout passed from controller
		if ($layout === FALSE) { //If strict FALSE passed means no layout render needed (for AJAX etc)
			$this->layout = FALSE;
		} else {
			$this->layout = $layout ?: LAYOUT; //If not strict FALSE - set passed layout, if not passed set default layout from config/init.php
		}
	}
	
	/**
	 * Method for rendering, including template and passing meta and content data to it
	 * @param $meta
	 * @param $data
	 * @throws \Exception
	 */
	public function render($meta, $data)
	{
		if (is_array($data)) extract($data); //if recieved $data is array making each key as independed variable for using in view or template
		$viewFile = APP . DS . 'views' . DS . $this->prefix . $this->controller . DS . $this->view . '.php';
		//including view file and buffering its output
		if (is_file($viewFile)) {
			ob_start();
			require_once $viewFile;
			$content = ob_get_clean();
		} else {
			throw new \Exception("View {$viewFile} not found", 500);
		}
		//including layout, if no layoud passed from controller using default, if strict FALSE passed - processing data without layout template
		if (FALSE !== $this->layout) {
			$layoutFile = APP . DS . 'views' . DS . 'layouts' . DS . $this->layout . '.php';
			if (is_file($layoutFile)) {
				require_once $layoutFile;
			} else {
				throw new \Exception("Layout {$this->layout} not found", 500);
			}
		}
	}
	
	
}