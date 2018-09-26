<?php
require 'db.php';
$new_id=$_GET['new_id'];
$sql="delete from cms_news where new_id=$new_id";
if (mysqli_query($link,$sql)) {
	header('location:listnew.php');
}else{
	echo "删除失败！";
}