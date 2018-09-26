<?php
	session_start();
	date_default_timezone_set('PRC');
	require './admin/db.php';
	$menuid=isset($_GET['menuid'])?$_GET['menuid']:0;
	$sql = 'select menu_id,name from cms_menu where status=1';
	$res = mysqli_query($link,$sql);
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>点资讯</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/reset1.css" />
	<link rel="stylesheet" type="text/css" href="css/index.css" />
	<link rel="stylesheet" type="text/css" href="css/comment.css" />
	<script type="text/javascript" src="ajax/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="ajax/ajax.js"></script>
	<style>
        .article{
        	 padding:10px;
        }
        .article h2{
        	 font:bold 20px 微软雅黑;
        	 padding:10px 0;
        	 text-align: center;
        }
        .article .content{
        	line-height: 24px;
        	font-size:14px;
        }
	</style>
</head>
<body>
	<!-- 头部的快速链接开始 -->
	<div class="head-link clearfix"><!-- 100%背景 -->
	   <div class="area"><!--固定宽度内容居住显示 -->
			<div class="right">
				<!-- <a href="#">合作品牌</a> |
				<a href="#">品牌介绍</a> | -->
				<a href="#">合作代理</a> |
				<a href="#">校园大使</a> |
				<a href="login.php"><?php if (isset($_SESSION['username'])) {?><span style="color: red;">欢迎:<?=$_SESSION['username']?></span><?php }else{?><span style="color: blue;">登　　录</span><?php }?></a> |
				<a href="outlogin.php"><span style="color: blue;">注　　销<span></a>
			</div>
		</div>
	</div>
	<!-- 头部的快速链接结束 -->
	<!-- 头部logo开始 -->
	<div class="logo area clearfix">
		<div class="left">
			<a href="#"><img src="images/logo.png" alt=""/></a>
		</div>
		<div class="right">
			<form>
				<input type="text" class="search-key" placeholder="大家都在搜:美军舰菲商船相撞"/>
				<button class="search-btn">搜索</button>
			</form>
		</div>
	</div>
	<!-- 头部logo结束 -->
	<!-- 头部导航开始 -->
	<div class="navi clearfix"><!-- 背景100% -->
	 	<ul><!-- 固定宽度内容居住显示 -->
	 		<?php
	 			if ($menuid!=0) {?>
	 				<li><a href="index.php">首页</a></li>
	 			<?php while ($row=mysqli_fetch_assoc($res)){?>
	 			<?php if ($menuid==$row['menu_id']){?>
	 				<li class="active"><a href="list.php?menuid=<?=$row['menu_id']?>"><?=$row['name']?></a></li>
	 			<?php }else{?>
	 				<li><a href="list.php?menuid=<?=$row['menu_id']?>"><?=$row['name']?></a></li>
	 			<?php }?>
	 		<?php }}else{?>
	 			<li class="active"><a href="index.php">首页</a></li>
	 			<?php while ($row=mysqli_fetch_assoc($res)){?>
	 				<li><a href="list.php?menuid=<?=$row['menu_id']?>"><?=$row['name']?></a></li>
	 		<?php }?>
	 		<?php }?>
	 	</ul>
	 </div>
	<!-- 头部导航结束 -->