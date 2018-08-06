<?php
/**
 * Debug function for nice looking variable data output
 * @param $var
 */
function debug($var){
	echo '<pre>'. print_r($var,true).'</pre>';
}

function redirect($http = false){
	if($http){
		$redirect = $http;
	} else{
		$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : BASE_URL;
	}
	header("Location: {$redirect}");
	
	exit();
}
