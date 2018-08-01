<?php
/**
 * Debug function for nice looking variable data output
 * @param $var
 */
function debug($var){
	echo '<pre>'. print_r($var,true).'</pre>';
}