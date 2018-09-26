<?php 
	function getOrder($filed,$select){
			$pram = $_GET;
			unset($pram['order']);
			$OrdQuary=http_build_query($pram);
			// if(!empty($_GET['order'])){
			// 	$filed=$_GET['order']==$filed?"$filed desc":$filed;
			// }else{
			// 	$filed="$filed desc";
			// }
			if ($select=='z') {
				$filed ="$filed ASC";
			}else{
				$filed ="$filed DESC";
			}
		return ($OrdQuary ? "?$OrdQuary&":"?")."order=$filed";
	}
 ?>