<?php
	require 'db.php';
	$sql = "select menu_id,name from cms_menu";
	$arr=mysqli_query($link,$sql);
	?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>新闻添加界面</title>
	<script type="text/javascript" src="./js/kindeditor/kindeditor-all.js"></script>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}
		table{
			width: 600px;
			border-collapse: collapse;
			border-spacing: 0;
			border-top: 1px solid #999;
			border-left: 1px solid #999;
			margin: 50px 0 0 50px;
		}
		table th,table td{
			border-right: 1px solid #999;
			border-bottom: 1px solid #999;
			padding: 5px;
		}
	</style>
</head>
<body>
	<form action="doaddnew.php" method="post" enctype="multipart/form-data">
	 <table>
	 	<tr>
	 		<th colspan="2">新闻添加界面</th>
	 	</tr>
	 	<tr>
	 		<td>菜单分类</td>
	 		<td>
	 			<select name="menuid">
	 			<?php
	 				while ($row=mysqli_fetch_assoc($arr)) { ?>
	 					<option value="<?=$row['menu_id']?>"><?=$row['name']?></option>
	 			<?php }?>
	 			</select>
	 			<?php mysqli_close($link)?>
	 		</td>
	 	</tr>
	 	<tr>
	 		<td>标题</td>
	 		<td><input type="text" name="title"></input></td>
	 	</tr>
	 	<tr>
	 		<td>内容</td>
	 		<td><textarea id="editor-content" cols='50' rows="10" name="content"></textarea></td>
	 	</tr>
	 	<tr>
	 		<td>缩略图</td>
	 		<td><input type="file" name="thumb"></input></td>
	 	</tr>
	 	<tr>
	 		<td>来源</td>
	 		<td><input type="text" name="comefrom"></input></td>
	 	</tr>
	 	<tr>
	 		<td colspan="2" style="text-align: center;"><input type="submit" name="button" value="提交"></input></td>
	 	</tr>
	 </table>
	 </form>
	 <script type="text/javascript">
	 	KindEditor.ready(function(K){
	 		window.editor = K.create('#editor-content');
	 	})
	 </script>
</body>
</html>