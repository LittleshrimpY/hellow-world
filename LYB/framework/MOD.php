<?php
namespace framework;
use framework\DBtools;
		class MOD
		{
			protected $mod;
		 	function __construct()
			{
				$this->mod = DBtools::getInstance($GLOBALS['conf']['db']);
			}
			protected function filter($arr,$func){
				foreach ($arr as $v) {
					if (!isset($_POST[$v])) {
						$_POST[$v] ='';
					}
					$_POST[$v]=$func($_POST[$v]);
				}
			}
		}

 ?>