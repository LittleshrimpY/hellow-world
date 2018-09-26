	<?php 
		require 'header.php';
		$newid=$_GET['new_id'];
		$sql2="select * from cms_news where new_id=$newid";
		$res2=mysqli_query($link,$sql2);
		$row2=mysqli_fetch_assoc($res2);
		$sql3="select * from cms_comment as c inner join cms_users as u on c.user_id=u.user_id where c.new_id=$newid and status=1 order by c.comment_id desc";
		$res3=mysqli_query($link,$sql3);
		$sqlu="update cms_news set count=count+1 where new_id={$newid}";
		mysqli_query($link,$sqlu);
	?>
	<!-- 主题内容开始 -->
	<div class="content clearfix area">
		<div class="left">
			<div class="foucs-info">
				<img src="upload/banner.jpg" width="664"/>
			</div>
			<div class="article">
				<h2><?=$row2['title']?></h2>
				<hr/>
				<div class="content">
					<?=$row2['content']?>
				</div>
				<div class="comments">
			<div class="hd-comment">
			<?php if (isset($_SESSION['username'])&&$_SESSION['username']!=''){
				$sql7="select * from cms_users where user_id={$_SESSION['user_id']}";
				$res7=mysqli_query($link,$sql7);
				$row7=mysqli_fetch_assoc($res7);
			?>
				<img class="thumb" src="./upload/<?=$row7['user_thumb']?>">
			<?php }else{?>
				<img class="thumb" src="./upload/list2.jpeg">
			<?php }?>
				<textarea placeholder="发表你的精彩评论" id="comment-input" class="comment-input"></textarea>
				<button onclick="docomment(<?=$row2['new_id']?>)" class="add-comment-btn">发表</button>
			</div>
			<h5><span>最新评论</span><p></p></h5>
			<ul id="comments-list" class="comments-list">
		<?php while ($row3=mysqli_fetch_assoc($res3)) {
				// $sql4="select * from cms_users where user_id={$row3['user_id']}";
				// $res4=mysqli_query($link,$sql4);
				// $row4=mysqli_fetch_assoc($res4);
				$sql5="select * from cms_reply as r inner join cms_users as u on r.user_id=u.user_id where comment_id={$row3['comment_id']} order by r.reply_id desc";
				$res5=mysqli_query($link,$sql5);
		?>
 	   		<li id="<?=$row3['comment_id']?>" data-id="p2iptfal8tv3" class="comment-li">
 	   		<?php if ($row3['user_thumb']) {?>
      		<img class="thumb" src="./upload/<?=$row3['user_thumb']?>">
			<?php }else{?>
			<img class="thumb" src="./upload/list6.jpeg">
			<?php }?>
  			<div class="comment-box">
      	  	<span class="comment-nickname"><?=$row3['username']?></span>
      	 	<span class="comment-date"><?=date('Y-m-d H:i:s',$row3['create_time'])?></span>
      	 	<?php if (isset($_SESSION['username'])&&$_SESSION['username']!=''&&$_SESSION['user_id']==$row3['user_id']) {?>
      	    <a onclick="deletes(<?=$row3['comment_id']?>)" class="float-right comment-delete">删除</a>
      	    <?php }else{?>
      	    <a style='cursor: pointer;' class="float-right comment-reply">回复</a>
      	    <div class="reply-input" style="height: 120px;display:none;"><textarea id="r<?=$row3['comment_id']?>" placeholder="回复：<?=$row3['username']?>" data-id="p2iorr9r9db4" data-name=""></textarea>
          	<p><button onclick="doreply(<?=$row3['comment_id']?>)" class="add-reply-btn">发表</button></p>
          	</div>
      	    <?php }?>
      	    <a href="javascript:;" class="float-right comment-like cant-like ">0 赞</a>
      		</div>
      		<p><?=$row3['comment_content']?></p>
      		<?php while ($row5=mysqli_fetch_assoc($res5)) {
    //   			$sql6="select * from cms_users where user_id={$row5['user_id']}";
    //   			$res6=mysqli_query($link,$sql6);
				// $row6=mysqli_fetch_assoc($res6);
      		?>
    	    <div class="reply-lists"><span class="arrow-up iconfont icon-up"><?=$row5['username']?></span>
        		<div data-id="p2lzu8al8tv3">
          			<span class="ft_blue can_reply" title="点击回复他"><?=$row5['username']?></span>：<?=$row5['reply_content']?>
        		</div>
      		</div>
      		<?php }?>
          </li>
          <?php }?>
</ul>
<div class="no-comment" style="display: none;"><img src="//staticimg.yidianzixun.com/modules/build/images/no_comment_2-eadb1f6a.png"><p>暂无评论，快来抢沙发！</p></div>
</div>
			</div>
		</div>
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
	<?php
		mysqli_close($link);
	 require 'footer.php'?>