<?php

namespace app\widgets\menu;


use fw\App;
use fw\Cache;

class Menu
{
	protected $data;
	protected $tree;
	protected $menuHtml;
	protected $tpl;
	protected $container = 'ul';
	protected $table = 'category';
	protected $cache = 3600;
	protected $cacheKey = 'LXmenu';
	protected $attrs = [];
	protected $prepend = '';
	
	public function __construct($options = [])
	{
		$this->tpl = __DIR__ . DS . 'menu_tpl' . DS . 'menu.php';
		$this->getOptions($options);
		debug($this->table);
		$this->run();
	}
	
	protected function getOptions($options)
	{
		foreach ($options as $optionKey => $optionValue) {
			if (property_exists($this, $optionKey)) {
				$this->$optionKey = $optionValue;
			}
		}
	}
	
	protected function run()
	{
		$this->menuHtml = Cache::get($this->cacheKey);
		if (!$this->menuHtml) {
			$this->data = App::$app->getProperty('cats');
			if (!$this->data) {
				$this->data = $cats = \R::getAssoc("SELECT * FROM {$this->table}");
			}
		}
		$this->output();
	}
	
	protected function output()
	{
		echo $this->menuHtml;
	}
	
	protected function getTree()
	{
	
	}
	
	protected function getMenuHtml($tree, $tab = '')
	{
	
	}
	
	protected function catToTemplate($category, $tab, $id)
	{
	
	}
	
}