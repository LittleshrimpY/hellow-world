<?php
	session_start();
	if (!isset($_SESSION['username'])||$_SESSION['username']=='') {
		echo 'false';
	}else{
		echo 'true';
	}