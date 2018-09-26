<?php
	session_start();
	require 'admin/db.php';
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password = md5($password);
	$url = $_GET['url'];
	$sql="select user_id,username from cms_users where username='{$username}' and password='{$password}'";
	$rs = mysqli_query($link,$sql);
	$row = mysqli_fetch_assoc($rs);
	if ($row) {
		$_SESSION['username']=$username;
		$_SESSION['user_id']=$row['user_id'];
	?>
	<script type="text/javascript">
		window.location='index.php';
	</script>
	<?php }else{?>
	<script type="text/javascript">
		alert('登录失败！');
		window.location='login.php';
	</script>
	<?php }?>