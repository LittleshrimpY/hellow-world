<?php
	namespace framework;
	class Countroller
	{
		function display(){
			require_once('application/'.USER.'/view/controller/'.ACTION.'.html');
		}
		function succeed($url='',$time=5,$message=""){
			if (empty($url)) {
				if (empty($_SERVER['HTTP_REFERER'])) {
					$url = '/';
				}else{
					$url = $_SERVER['HTTP_REFERER'];
				}
			}
			if (empty($message)) {
				$message='操作成功！';
			}
			require_once('framework/succeed.html');
		}
		function failled($url='',$time=5,$message=""){
			if (empty($url)) {
				if (empty($_SERVER['HTTP_REFERER'])) {
						$url = '/';
				}else{
						$url = $_SERVER['HTTP_REFERER'];
				}
			}
			if (empty($message)) {
				$message='操作失败！';
			}
			require_once('framework/failled.html');
		}
	}
 ?>