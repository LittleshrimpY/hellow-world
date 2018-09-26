<?php
namespace framework;
class runtime
{
	private function load_conf(){
		$GLOBALS['conf'] = require_once("application/conf.php");
	}
	private function dispatch(){
		$s=$GLOBALS['conf']['home'];
		$s=implode('/',$s);
		if (!empty($_GET['s'])&&count(explode('/',$_GET['s']))==2) {
			$s=$_GET['s'];
		}
		list($use,$action) = explode('/',$s);
		define('USER',"$use");
		define('ACTION',"$action");
		$obj = "\\application\\".USER."\\controller\\".USER."Controller";
		$method = new $obj;
		$method->$action();
	}
	public function start(){
		$this->load_conf();
		$this->dispatch();
	}
}
?>