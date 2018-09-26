<?php
require 'db.php';
$new_id=$_POST['new_id'];
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
}elseif ($_FILES['thumb']['error']==4) {
	$filename=$_POST['backthumb'];
}
$sql="update cms_news set menuid='{$menuid}',title='{$title}',content='{$content}',thumb='{$filename}',adminid=1,comefrom='{$comefrom}',update_time='{$time}' where new_id=$new_id";
if (mysqli_query($link,$sql)) {
	header('location:listnew.php');
}else{
	echo "添加失败！";
}