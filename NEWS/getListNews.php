<?php
	require './admin/db.php';
	require './page.php';
	$page=isset($_GET['page'])?$_GET['page']:1;
	$menuid =isset($_GET['menuid'])?$_GET['menuid']:0;
	if ($_GET['menuid']==0||empty($_GET['menuid'])) {
		$sqlAll="select * from cms_news where status=1";
		$resAll=mysqli_query($link,$sqlAll);
		$totalDataAll=mysqli_num_rows($resAll);
		$totalpage=mysqli_num_rows($resAll);
		$pagelistT=4;
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
		$sqlPage = "select * from cms_news where status=1 limit $curpage,$pagelistT";
		$resPage = mysqli_query($link,$sqlPage);
		$news='';
		$page=pagelist();
	}else{
		$sqlAll="select * from cms_news where status=1 and menuid=$menuid";
		$resAll=mysqli_query($link,$sqlAll);
		$totalDataAll=mysqli_num_rows($resAll);
		$totalpage=mysqli_num_rows($resAll);
		$pagelistT=3;
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
		$sqlPage = "select * from cms_news where status=1 and menuid=$menuid limit $curpage,$pagelistT";
		$resPage = mysqli_query($link,$sqlPage);
		$news='';
		$page=pagelist();
	}
	if($totalDataAll>0){
		while($rowPage=mysqli_fetch_assoc($resPage)){
				$a=($rowPage['create_time']/3600);
				$b=(time()/3600);
				$c=round($b-$a,2);
				$news.="<div class='pic-txt'><a href='#'><img width='160px' height='100px' src='./upload/{$rowPage['thumb']}' alt=''/></a><h3><a href='detail.php?new_id={$rowPage['new_id']}'>{$rowPage['title']}</a></h3><p><span>{$rowPage['comefrom']}</span><span>{$rowPage['count']} 点击量</span><span>{$c}小时前</span></p></div><span style='position: absolute;top:109%;left: 40%;'>{$page}</span>";
			}
	}else{
		$news.="<span style='font-size:50px;display:block;width:100%; text-align:center;float:none'>没有数据</span>";
	}
	echo $news;
	mysqli_close($link);