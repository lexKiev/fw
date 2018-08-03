<?php

namespace fw;


class Db
{
	use TSingleton;
	
	protected function __construct()
	{
		$db = require_once CONF . DS . 'config_db.php';
		class_alias('\RedBeanPHP\R', '\R');
		\R::setup($db['dsn'],$db['user'],$db['[password']);
		if (!\R::testConnection()){
			throw new \Exception('No connection to database', 500);
		}
		\R::freeze(TRUE);
		if (DEBUG){
			\R::debug(TRUE,1);
		}
	}
}