<?php

namespace app\controllers;


use fw\Router;

class PageController
{
	public function viewAction(){
		debug(Router::getRoute());
		echo "<br>";
		debug( Router::getRoutes());
	}
	
}