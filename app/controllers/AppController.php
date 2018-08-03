<?php

namespace app\controllers;
use app\models\AppModel;
use fw\base\Controller;

/**
 * Global controller class that extending core controller, all application-depended functions should be here
 * all other controllers should extend this one
 */

class AppController extends Controller
{
	public function __construct($route)
	{
		parent::__construct($route);
		new AppModel();
	}
	
}