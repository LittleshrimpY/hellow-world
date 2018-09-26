<?php
	require 'db.php';
	$newid= isset($_GET['new_id'])?$_GET['new_id']:1;
	$sql = "select menu_id,name from cms_menu";
	$arr=mysqli_query($link,$sql);
	$sql2 = "select * from cms_news where new_id=$newid";
	$arr2=mysqli_query($link,$sql2);
	$row2=mysqli_fetch_assoc($arr2);
	?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>新闻修改界面</title>
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
	<form action="update.php" method="post" enctype="multipart/form-data">
	 <table>
	 	<tr>
	 		<th colspan="2">新闻修改界面</th>
	 	</tr>
	 	<tr>
	 		<td>菜单分类</td>
	 		<td>
	 			<select name="menuid">
	 			<?php
	 				while ($row=mysqli_fetch_assoc($arr)) { ?>
	 					<?php if ($row['menu_id']==$row2['menuid']){ ?>
	 						<option value="<?=$row['menu_id']?>" selected='selected'><?=$row['name']?></option>
	 						<?php }else{?>
	 					<option value="<?=$row['menu_id']?>"><?=$row['name']?></option>
	 					<?php }?>
	 			<?php }?>
	 			</select>
	 			<?php mysqli_close($link)?>
	 		</td>
	 	</tr>
	 	<tr>
	 		<td>标题</td>
	 		<td><input type="text" name="title" value="<?=$row2['title']?>"></input><input type="hidden" name="new_id" value="<?=$row2['new_id']?>"></input></td>
	 	</tr>
	 	<tr>
	 		<td>内容</td>
	 		<td><textarea cols='50' rows="10" name="content"><?=$row2['content']?></textarea></td>
	 	</tr>
	 	<tr>
	 		<td>缩略图</td>
	 		<td style="height: 100px;"><input  type="file" name="thumb"><img width="100px" src="../upload/<?=$row2['thumb']?>"></input><input type="hidden" name="backthumb" value="<?=$row2['thumb']?>"></input></td>
	 	</tr>
	 	<tr>
	 		<td>来源</td>
	 		<td><input type="text" name="comefrom" value="<?=$row2['comefrom']?>"></input></td>
	 	</tr>
	 	<tr>
	 		<td colspan="2" style="text-align: center;"><input type="submit" name="button" value="提交"></input></td>
	 	</tr>
	 </table>
	 </form>
</body>
</html>