<?php
	require 'admin/db.php';
	$username=$_POST['username'];
	$password=$_POST['password'];
	$password1=$_POST['password2'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	if ($_FILES['user_thumb']['error']==0) {
	$filename = $_FILES['user_thumb']['name'];
	$ext = substr($filename,strrpos($filename,'.')+1);
	$filename = md5(time().mt_rand(1000,9999)).'.'.$ext;
	move_uploaded_file($_FILES['user_thumb']['tmp_name'],'./upload/'.$filename);
	}else if($_FILES['user_thumb']['error']==4) {
		$filename='list1.jpeg';
	}
	if ($password=='') {
		die('密码不能为空');
	}elseif (strlen($password)<6||strlen($password)>12) {
		die('密码必须在6-12之间');
	}elseif ($password!=$password1) {
		die('两次密码不一致');
	}
	$password=md5($password);
	$sql="insert cms_users(username,password,phone,email,user_thumb) value('{$username}','{$password}','{$phone}','{$email}','{$filename}')";
	mysqli_query($link,$sql);
	mysqli_close($link);
	header('location:login.php');