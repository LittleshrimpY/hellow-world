<?php
require 'db.php';
$menuid=$_POST['menuid'];
$title=$_POST['title'];
$content=$_POST['content'];
$comefrom=$_POST['comefrom'];
$time=time();
if ($_FILES['thumb']['error']==0) {
	$filename = $_FILES['thumb']['name'];
	$ext = substr($filename,strrpos($filename,'.')+1);
	$filename = md5(time().mt_rand(1000,9999)).'.'.$ext;
	move_uploaded_file($_FILES['thumb']['tmp_name'],'../upload/'.$filename);
}
$sql="insert cms_news(menuid,title,content,thumb,comefrom,adminid,create_time,update_time) value('{$menuid}','{$title}','{$content}','{$filename}','{$comefrom}','admin','{$time}','{$time}')";
if (mysqli_query($link,$sql)) {
	header('location:listnew.php');
}else{
	echo "添加失败！";
}