<?php
require 'db.php';
$new_id=$_GET['new_id'];
$sql="update cms_news set status=1 where new_id=$new_id";
if (mysqli_query($link,$sql)) {
	header('location:flagdel.php');
}else{
	echo "还原失败！";
}