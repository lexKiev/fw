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
    protected $class = '';
    protected $table = 'category';
    protected $cache = 3600;
    protected $cacheKey = 'LXmenu';
    protected $attrs = [];
    protected $prepend = '';

    public function __construct($options = [])
    {
        $this->tpl = __DIR__ . DS . 'menu_tpl' . DS . 'menu.php';
        $this->getOptions($options);
        $this->run();
    }

    /**Method for options mapping from array passed to this obj params
     * @param $options
     */
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
        $this->menuHtml = Cache::get($this->cacheKey); //Check if completed HTML menu code in cache
        if (!$this->menuHtml) {
            $this->data = App::$app->getProperty('cats');
            if (!$this->data) {
                $this->data = $cats = \R::getAssoc("SELECT * FROM {$this->table}");
            }
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
            if ($this->cache) {
                Cache::set($this->cacheKey, $this->menuHtml, $this->cache);
            }
        }
        $this->output();
    }

    protected function output()
    {
        $attrs = '';
        if (!empty($this->attrs)) {
            foreach ($this->attrs as $attrKey => $attrValue) {
                $attrs .= " $attrKey = '$attrValue' ";
            }
        }
        echo "<{$this->container} class = '{$this->class}' {$attrs}>";
        echo $this->prepend;
        echo $this->menuHtml;
        echo "</{$this->container}>";
    }

    protected function getTree()
    {
        $tree = [];
        $data = $this->data;
        foreach ($data as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] =& $node;
            } else {
                $data[$node['parent_id']]['childs'][$id] =& $node;
            }
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach ($tree as $id => $category) {
            $str .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab, $id)
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }

}