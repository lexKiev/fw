<?php

namespace app\controllers;


class MainController extends AppController
{
	public function IndexAction()
	{
		$brands = \R::find('brand', 'LIMIT 3');
		$popularItems = \R::find('product', "hit = '1' AND status = '1' LIMIT 8");
		$this->setMeta('LX Watches', 'Best Watches for fuckers');
		$this->set(compact('brands', 'popularItems'));
	}
}