<?php
	$link= mysqli_connect('localhost','root','','cms');
	mysqli_query($link,'set names utf8');
	$sql = "select new_id from cms_news";
	$res = mysqli_query($link,$sql);
	$totalpage=mysqli_num_rows($res);
	$pagelistT=5;
	$mixpage=ceil($totalpage/$pagelistT);
	$page=isset($_GET['page'])?$_GET['page']:1;
	$page=intval($page);
	if ($page<=0) {
		$page=1;
	}
	if ($page>$mixpage) {
		$page=$mixpage;
	}
	$curpage=(intval($page)-1)*$pagelistT;
	$action=isset($_GET['action'])?$_GET['action']:"asc";
	$list=isset($_GET['list'])?$_GET['list']:"new_id";
	$sql = "select * from cms_news order by $list $action limit $curpage,$pagelistT";
	$res = mysqli_query($link,$sql);
	$newArr=array();
	while ($row=mysqli_fetch_assoc($res)) {
		$newArr[] = $row;
	}
	if (isset($_GET['key'])) {
		search();
		if (count($newArr)==0) {
			echo "<script>alert('未找到');window.location='".getSeUrl()."'</script>";
		}
	}
	function pagelistU(){
		global $page;
		if ($page<=0) {
			return $page=1;
		}else{
			return $page-1;
		}
	}
	function pagelistD(){
		global $page;
		global $mixpage;
		if ($page==$mixpage) {
			return $page=$mixpage;
		}else{
			return $page+1;
		}
	}
	function order(){
		if ($GLOBALS['action']=='asc') {
			return "desc";
		}else{
			return "asc";
		}
	}
	function getSeUrl(){
		$url=$_GET;
		unset($url['key']);
		$order=http_build_query($url);
		return empty($order)?'?':'?'.$order;
	}
	function delete(){
		global $mixpage;
		global $pagelistT;
		global $totalpage;
		global $newArr;
		global $link;
		global $list;
		global $action;
		global $curpage;
		global $pagelist;
			$key=$_GET['key'];
			$sql="update cms_news set stauts=0 where new_id=$_GET['mew_id']";
			if (mysqli_query($link,$sql)) {
				$sql="select * from cms_news where stauts=1 order by $list $action limit $curpage,$pagelistT";
				$newArr=array();
				while ($row=mysqli_fetch_assoc($result)) {
					$newArr[] = $row;
				}
				$totalpage=count($result);
				$mixpage=ceil($totalpage/$pagelistT);
			}
	}
	// function getUrl(){
 //      //1. 当前页面根相对路径带参数
 //      $url = $_SERVER['REQUEST_URI'];
 //      print_r($url);
 //      // 2. 拆分路径 parse_url 获得数组
 //      //  $parse['path'] =/code/day06/09_search.php
 //      //  $parse['query'] = keyword=hello&p=2
 //      $parse = parse_url($url);
 //      if(isset($parse['query'])&&$parse['query']!=''){
 //       //3. parse_str 函数获得 $parse['query'] 每个参数组成的数组
 //        parse_str($parse['query'],$param);
 //        unset($param['p']);
 //        //print_r($param);
 //        if($param){
 //           // 有参数
 //           //  $param 数组 转为 字符串参数路径
 //          $url = $parse['path'].'?'.http_build_query($param).'&';
 //        }else{
 //          // 没参数
 //          $url = $parse['path'].'?';
 //        }
 //      }else{
 //          // 没参数
 //          $url = $parse['path'].'?';
 //      }
 //      return $url;
	// }
	function getUrl(){
		$url=$_GET;
		unset($url['page']);
		$order=http_build_query($url);
		return empty($order)?'?':'?'.$order.'&';
	}
	function getPxUrl(){
		$url=$_GET;
		unset($url['list']);
		unset($url['action']);
		$order=http_build_query($url);
		return empty($order)?'?':'?'.$order.'&';
	}
	function pagelist(){
		global $pagelistT;
		global $totalpage;
		global $list;
		global $action;
		global $page;
		$pages=ceil($totalpage/$pagelistT);
		$pagelist='';
		if ($pages<2) {
			return $pagelist='';
		}
		if ($page-3>1&&$page+3<$pages) {
			$pagelist.="&nbsp;<a href='".getUrl()."page=1'>1</a>...";
			for ($i=3; $i >=1 ; $i--) {
					$z=$page-$i;
					$pagelist.="&nbsp;<a href='".getUrl()."page=".$z."'>$z</a>";
			}
			$pagelist.="&nbsp;<a style='color:red;' href='".getUrl()."page=".$page."'>$page</a>";
			for ($j=1; $j <=3 ; $j++) {
					$p=$page+$j;
					$pagelist.="&nbsp;<a href='".getUrl()."page=".$p."'>$p</a>";
			}
			$pagelist.="...&nbsp;<a href='".getUrl()."page=".$pages."'>$pages</a>";
		}else{
		  if ($pages>8) {
			if ($page+3>=$pages) {
				$pagelist.="&nbsp;<a href='".getUrl()."page=1'>1</a>...";
				for ($i=3; $i>=1 ; $i--) {
					$z=$page-$i;
					$pagelist.="&nbsp;<a href='".getUrl()."page=".$z."'>$z</a>";
				}
				$pagelist.="&nbsp;<a style='color:red;' href='".getUrl()."page=".$page."'>$page</a>";
				$yueje=$pages-$page;
				for ($j=1; $j <=$yueje ; $j++) {
					$p=$page+$j;
					$pagelist.="&nbsp;<a href='".getUrl()."page=".$p."'>$p</a>";
				}
			}
			if ($page-3<=1) {
				$yueje=$page-1;
				for ($i=$yueje; $i>=1; $i--) {
						$z=$page-$i;
						$pagelist.="&nbsp;<a href='".getUrl()."page=".$z."'>$z</a>";
				}
				$pagelist.="&nbsp;<a style='color:red;' href='".getUrl()."page=".$page."'>$page</a>";
				for ($j=1; $j <=3; $j++) {
					$p=$page+$j;
					$pagelist.="&nbsp;<a href='".getUrl()."page=".$p."'>$p</a>";
				}
				$pagelist.="...&nbsp;<a href=' href='".getUrl()."page=".$pages."'>$pages</a>";
			}
		}else{
				for ($i=1; $i <=$pages ; $i++) {
				if ($i==$page) {
					$pagelist.="&nbsp;<a style='color:red' href='".getUrl()."page=".$i."'>$i</a>";
				}else{
					$pagelist.="&nbsp;<a href='".getUrl()."page=".$i."'>$i</a>";
				}
			}
		}
	}
	return $pagelist;
	}
	function search(){
		global $mixpage;
		global $pagelistT;
		global $totalpage;
		global $newArr;
		global $link;
			$key=$_GET['key'];
			$sql="select * from cms_news where title like '%{$key}%'";
			$result=mysqli_query($link,$sql);
			$newArr=array();
			while ($row=mysqli_fetch_assoc($result)) {
				$newArr[] = $row;
			}
			$totalpage=count($result);
			$mixpage=ceil($totalpage/$pagelistT);
	}
	?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		function gotoPage(url,totalpage){
			var page=document.getElementById('goPage').value;
			if (page<1) {
				window.location=url+"page=1";
			}else if(page>totalpage){
				window.location=url+"page="+totalpage;
			}else{
				window.location=url+"page="+page;
			}
		}
		function serach(url){
			var key = document.getElementById('key').value;
			if (key=="") {
				return;
			}else{
				window.location=url+"&key="+key;
			}
		}
	</script>
</head>
<body>
	<center>
	<table style="text-align: center;" border="1px">
		<tr>
			<td><a href="<?=getPxUrl()?>&list=new_id&action=<?=order()?>">new_id</a></td>
			<td><a href="<?=getPxUrl()?>&list=menuid&action=<?=order()?>">menuid<a></td>
			<td><a href="<?=getPxUrl()?>&list=title&action=<?=order()?>">title<a></td>
			<td><a href="<?=getPxUrl()?>&list=content&action=<?=order()?>">content<a></td>
			<td><a href="<?=getPxUrl()?>&list=status&action=<?=order()?>">stauts<a></td>
			<td><a href="<?=getPxUrl()?>&list=thumb&action=<?=order()?>">thumb<a></td>
			<td><a href="<?=getPxUrl()?>&list=comefrom&action=<?=order()?>">comefrom<a></td>
			<td><a href="<?=getPxUrl()?>&list=adminid&action=<?=order()?>">adminid<a></td>
			<td><a href="<?=getPxUrl()?>&list=create_time&action=<?=order()?>">create_time<a></td>
			<td><a href="<?=getPxUrl()?>&list=update_time&action=<?=order()?>">update_time<a></td>
			<td><a href="<?=getPxUrl()?>&list=count&action=<?=order()?>">count<a></td>
			<td><a href="#">操作<a></td>
		</tr>
		<?php foreach($newArr as $row) {?>
			<tr>
				<td><?=$row['new_id']?></td>
				<td><?=$row['menuid']?></td>
				<td><?=$row['title']?></td>
				<td><?=$row['content']?></td>
				<td><?=$row['status']?></td>
				<td><?=$row['thumb']?></td>
				<td><?=$row['comefrom']?></td>
				<td><?=$row['adminid']?></td>
				<td><?=$row['create_time']?></td>
				<td><?=$row['update_time']?></td>
				<td><?=$row['count']?></td>
				<td><a onclick="add(<?=$row['new_id']?>)" href="#">添加</a>&nbsp;<a onclick="add(<?=$row['new_id']?>)" href="#">修改</a>&nbsp;<a onclick="add(<?=$row['new_id']?>)" href="#">删除</a></td>
			</tr>
		<?php }?>
		<tr>
			<td colspan="11"><a href="<?=getUrl()?>page=1">首页</a>&nbsp;&nbsp;
			<a href="<?=getUrl()?>page=<?=pagelistU()?>">上一页</a>&nbsp;
			<?=pagelist()?>&nbsp;&nbsp;
			<a href="<?=getUrl()?>page=<?=pagelistD()?>">下二页</a>&nbsp;&nbsp;
			<a href="<?=getUrl()?>page=<?=$mixpage?>">尾页</a></td>
		</tr>
		<tr>
			<td colspan="11">
			请输入跳转页数:
			<input style="width: 25px;" type="text" id="goPage" name="goPage"></input>
			<button onclick="gotoPage('<?=getPxUrl()?>',<?=$mixpage?>)">跳转</button>
			</td>
		</tr>
		<tr>
			<td colspan="11">
			查询数据:
			<input style="width: 25px;" type="text" id="key" name="goPage"></input>
			<button onclick="serach('<?=getSeUrl()?>')">跳转</button>
			</td>
		</tr>
	</table>
	</center>
</body>
</html>