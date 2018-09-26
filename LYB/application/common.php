<?php 
	function getOrder($filed,$select){
			$pram = $_GET;
			unset($pram['order']);
			unset($pram['ac']);
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
	function getColor($select){
		if (empty($_GET['order'])) {
			$ac ="id ASC";
		}else{
			$ac =$_GET['order'];
		}
		if ($select=='z') {
			if ($ac=="id ASC") {
				$color = "blue";
			}else{
				$color = "#333";
			}
			return $color;
		}else{
			if ($ac=="id DESC") {
				$color = "blue";
			}else{
				$color = "#333";
			}
			return $color;
		}
	}
	function getAddUserLink(){
		$pram = $_GET;
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