<?php
require 'db.php';
$sql="select m.name,c.new_id,c.menuid,c.title,c.content,c.thumb,c.comefrom,c.create_time,c.update_time,c.count from cms_news as c left join cms_menu as m on c.menuid=m.menu_id where c.status=1 order by new_id desc;";
$res=mysqli_query($link,$sql);
$totalData=mysqli_num_rows(mysqli_query($link,'select * from cms_news where status=1'));
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
    <link rel="stylesheet" href="./css/reset.css"/>
</head>
<body>
<?php if ($totalData>0) {?>
	<table>
		<tr>
			<th>新闻标题</th>
			<th>缩略图</th>
			<th>分类</th>
            <th>来源</th>
            <th>发布时间</th>
            <th>更新时间</th>
            <th>点击量</th>
            <th>操作</th>
		</tr>
		<?php
			while ($row = mysqli_fetch_assoc($res)) {?>
		    <tr>
	       	<td><?=$row['title']?></td>
          	<td><img width='100px'src="../upload/<?=$row['thumb']?>"></td>
          	<td><?=$row['name']?></td>
          	<td><?=$row['comefrom']?></td>
          	<td><?=date('Y-M-D h:i:m',$row['create_time'])?></td>
          	<td><?=date('Y-M-D h:i:m',$row['update_time'])?></td>
          	<td><?=$row['count']?></td>
          	<td><a href="editnew.php?new_id=<?=$row['new_id']?>"><img src="images/edit.png"></a><a href="delete.php?new_id=<?=$row['new_id']?>"><img src="images/trash.png"></a></td>
          </tr>
          <?php }?>
        </table>
        <?php }else{?>
        	<p style="text-align: center;font-size: 50px;">没有数据！</p>
        <?php }?>
</body>
</html>