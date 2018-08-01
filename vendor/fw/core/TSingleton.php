<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 01.08.2018
 * Time: 20:30
 */

namespace fw;

/**
 * Trait for Singleton pattern implementation
 */
trait TSingleton
{
	private static $instance;

	public static function instance(){
		if (self::$instance === NULL){
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	
}