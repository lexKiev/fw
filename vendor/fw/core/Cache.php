<?php

namespace fw;


class Cache
{
	use TSingleton;
	
	public function set($key,$data,$seconds = 3600){
		if ($seconds){
			$content['data'] = $data;
			$content['end_time'] = time() + $seconds;
			if (file_put_contents(CACHE . DS . md5($key) . '.txt', serialize($content))){
				return TRUE;
			} else{
				return FALSE;
			}
		}
	}
	
	public function get($key){
		$file = CACHE . DS . md5($key) . '.txt';
		if (file_exists($file)){
			$content = unserialize(file_get_contents($file));
			if (time() <= $content['end_time']) {
				return $content;
			}
			unlink($file);
		}
		return FALSE;
	}
	
	public function delete($key){
		$file = CACHE . DS . md5($key) . '.txt';
		if (file_exists($file)){
			unlink($file);
		}
	}
	
	
	
}