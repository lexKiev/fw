<?php

use fw\Router;

/**
 * User custom rules (has priority over default)
 */
//put custom rules before default
Router::add('^product/(?P<alias>[a-z0-9-]+)/?$',['controller' => 'Product', 'action' => 'view']); //default controller and method if request string is empty




/**
 * Default route rules
 */
Router::add('^adm$',['controller' => 'Main', 'action' => 'index', 'prefix' => 'adm']);
Router::add('^adm/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$',['prefix' => 'adm']);

Router::add('^$',['controller' => 'Main', 'action' => 'index']); //default controller and method if request string is empty
Router::add('^(?P<controller>[a-z-0-9]+)/?(?P<action>[a-z-0-9]+)?$');

