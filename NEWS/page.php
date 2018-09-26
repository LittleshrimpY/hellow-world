<?php
function getUrl(){
		$url=$_GET;
		unset($url['page']);
		$order=http_build_query($url);
		return empty($order)?'?':'?'.$order.'&';
}
function pagelist(){
		global $pagelistT;
		global $totalpage;
		global $page;
		global $menuid;
		$pages=ceil($totalpage/$pagelistT);
		$pagelist='';
		if ($pages<2) {
			return $pagelist='';
		}
		if ($page-3>1&&$page+3<$pages) {
			$pagelist.="&nbsp;<a style='cursor:pointer' onclick='getNewsAjax(1,".$menuid.")' href='".getUrl()."page=1'>1</a>...";
			for ($i=3; $i >=1 ; $i--) {
					$z=$page-$i;
					$pagelist.="&nbsp;<a style='cursor:pointer' onclick='getNewsAjax(".$z.",".$menuid.")' href='".getUrl()."page=".$z."'>$z</a>";
			}
			$pagelist.="&nbsp;<a onclick='getNewsAjax(".$page.")' style='color:red;cursor:pointer;' href='".getUrl()."page=".$page."'>$page</a>";
			for ($j=1; $j <=3 ; $j++) {
					$p=$page+$j;
					$pagelist.="&nbsp;<a style='cursor:pointer' onclick='getNewsAjax(".$p.",".$menuid.")' href='".getUrl()."page=".$p."'>$p</a>";
			}
			$pagelist.="...&nbsp;<a style='cursor:pointer' onclick='getNewsAjax(".$pages.",".$menuid.")' href='".getUrl()."page=".$pages."'>$pages</a>";
		}else{
		  if ($pages>8) {
			if ($page+3>=$pages) {
				$pagelist.="&nbsp;<a style='cursor:pointer' onclick='getNewsAjax(1,".$menuid.")' href='".getUrl()."page=1'>1</a>...";
				for ($i=3; $i>=1 ; $i--) {
					$z=$page-$i;
					$pagelist.="&nbsp;<a style='cursor:pointer' onclick='getNewsAjax(".$z.",".$menuid.")' href='".getUrl()."page=".$z."'>$z</a>";
				}
				$pagelist.="&nbsp;<a  onclick='getNewsAjax(".$page.",".$menuid.")' style='color:red;cursor:pointer;' href='".getUrl()."page=".$page."'>$page</a>";
				$yueje=$pages-$page;
				for ($j=1; $j <=$yueje ; $j++) {
					$p=$page+$j;
					$pagelist.="&nbsp;<a style='cursor:pointer' onclick='getNewsAjax(".$p.",".$menuid.")' href='".getUrl()."page=".$p."'>$p</a>";
				}
			}
			if ($page-3<=1) {
				$yueje=$page-1;
				for ($i=$yueje; $i>=1; $i--) {
						$z=$page-$i;
						$pagelist.="&nbsp;<a style='cursor:pointer' onclick='getNewsAjax(".$z.",".$menuid.")' href='".getUrl()."page=".$z."'>$z</a>";
				}
				$pagelist.="&nbsp;<a  onclick='getNewsAjax(".$page.")' style='color:red;cursor:pointer;' href='".getUrl()."page=".$page."'>$page</a>";
				for ($j=1; $j <=3; $j++) {
					$p=$page+$j;
					$pagelist.="&nbsp;<a style='cursor:pointer' onclick='getNewsAjax(".$p.",".$menuid.")' href='".getUrl()."page=".$p."'>$p</a>";
				}
				$pagelist.="...&nbsp;<a style='cursor:pointer' onclick='getNewsAjax(".$pages.",".$menuid.")' href=' href='".getUrl()."page=".$pages."'>$pages</a>";
			}
		}else{
				for ($i=1; $i <=$pages ; $i++) {
				if ($i==$page) {
					$pagelist.="&nbsp;<a onclick='getNewsAjax(".$i.",".$menuid.")' style='color:red;cursor:pointer;'>$i</a>";
				}else{
					$pagelist.="&nbsp;<a style='cursor:pointer' onclick='getNewsAjax(".$i.",".$menuid.")'>$i</a>";
				}
			}
		}
	}
	return $pagelist;
	}
	?>