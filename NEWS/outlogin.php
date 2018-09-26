<?php
	session_start();
	$brul=$_SERVER['HTTP_REFERER'];
	if (isset($_SESSION['username'])&&$_SESSION['username']!='') {
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		session_destroy();
		header("location:$brul");
	}else {
		header("location:$brul");
	}
	// $_SESSION['username']=null;
	// $_SESSION['user_id']=null;
	// session_destroy();