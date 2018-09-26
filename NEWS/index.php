<?php require 'header.php';
	require 'page.php';
	$sqlAll="select * from cms_news where status=1";
	$resAll=mysqli_query($link,$sqlAll);
	$totalDataAll=mysqli_num_rows($resAll);
	//page
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
	$sqlPage = "select * from cms_news limit $curpage,$pagelistT";
	$resPage = mysqli_query($link,$sqlPage);
?>
	<!-- 主题内容开始 -->
	<div class="content clearfix area">
		<div class="left">
			<div class="foucs-info">
				<img src="upload/banner.jpg" width="664"/>
			</div>
			<div id="list-news" class="list-news">
			<?php if($totalDataAll>0) {?>
				<?php while($rowPage=mysqli_fetch_assoc($resPage)) {?>
				<div class="pic-txt">
					<a href="#"><img width='160px' height="100px" src="./upload/<?=$rowPage['thumb']?>" alt=""/></a>
					<h3>
					   <a href="detail.php?new_id=<?=$rowPage['new_id']?>"><?=$rowPage['title']?></a>
					</h3>
					<p>
					  <span><?=$rowPage['comefrom']?></span><span><?=$rowPage['count']?> 点击量</span><span><?php $a=($rowPage['create_time']/3600);$b=(time()/3600);echo round($b-$a,2);?>小时前</span>
					</p>
					<span style="position: absolute;top:1030px;left: 40%;"><?=pagelist()?></span>
				</div>
				<?php }?>
				<?php }else{
					echo "<span style='float:none;font-size:50px;display:block;width:100%; text-align:center;'>没有数据</span>";
				}?>
			</div>
		</div>
		<?php mysqli_close($link);?>
		<div class="right">
			<div class="hot-news">
				<div class="pic-txt2 noneline">
					<a href="#">
						<img src="upload/radius1.jpeg" alt=""/>
					</a>
					<h3><a href="#">父女被狼群围困,忠犬解救!这一幕太感人......</a></h3>
					<p><span>488评论</span><span>3天前</span></p>
				</div>
				<div class="pic-txt2">
					<a href="#">
						<img src="upload/radius2.jpeg" alt=""/>
					</a>
					<h3><a href="#">父女被狼群围困,忠犬解救!这一幕太感人......</a></h3>
					<p><span>488评论</span><span>3天前</span></p>
				</div>
				<div class="pic-txt2">
					<a href="#">
						<img src="upload/radius3.jpeg" alt=""/>
					</a>
					<h3><a href="#">父女被狼群围困,忠犬解救!这一幕太感人......</a></h3>
					<p><span>488评论</span><span>3天前</span></p>
				</div>
			</div>
			<!-- 板块标题 -->
			<div class="title">
				<h3>热文排行</h3>
			</div>
			<!-- 新闻列表 -->
			<ul class="list1">
				<li><i class="blue">1</i><a href="#">总资产14亿美元,特朗普还没有女婿富裕</a></li>
				<li><i class="red">2</i><a href="#">总资产14亿美元,特朗普还没有女婿富裕</a></li>
				<li><i class="orange">3</i><a href="#">总资产14亿美元,特朗普还没有女婿富裕</a></li>
				<li><i>4</i><a href="#">总资产14亿美元,特朗普还没有女婿富裕</a></li>
				<li class="noline"><i>5</i><a href="#">总资产14亿美元,特朗普还没有女婿富裕</a></li>
			</ul>
			<!-- 板块标题 -->
			<div class="title">
				<h3>热门视频</h3>
			</div>
			<div class="hot-vido">
				<div class="pic-txt3">
					<a href="#">
						<img src="upload/hot1.jpeg" alt=""/>
					</a>
					<h3><a href="#">父女被狼群围困,忠犬解救!这一幕太感人......</a></h3>
					<p><span>488评论</span><span>3天前</span></p>
				</div>
				<div class="pic-txt3">
					<a href="#">
						<img src="upload/hot1.jpeg" alt=""/>
					</a>
					<h3><a href="#">父女被狼群围困,忠犬解救!这一幕太感人......</a></h3>
					<p><span>488评论</span><span>3天前</span></p>
				</div>
				<div class="pic-txt3">
					<a href="#">
						<img src="upload/hot1.jpeg" alt=""/>
					</a>
					<h3><a href="#">父女被狼群围困,忠犬解救!这一幕太感人......</a></h3>
					<p><span>488评论</span><span>3天前</span></p>
				</div>
			</div>
		</div>
	</div>
	<!-- 主题内容结束 -->
	<?php require 'footer.php'?>