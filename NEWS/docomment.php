<?php
	require 'admin/db.php';
	session_start();
	date_default_timezone_set('PRC');
	if (!isset($_SESSION['username'])||$_SESSION['username']=='') {
		echo 'false';
	}else{
		$username=$_SESSION['username'];
		$user_id =$_SESSION['user_id'];
		$new_id = $_GET['new_id'];
		$comment =$_GET['comment'];
		$date= time();
		$sql="insert into cms_comment(user_id,new_id,comment_content,create_time) value('{$user_id}','{$new_id}','{$comment}','{$date}')";
		$res = mysqli_query($link,$sql);
		$comments='';
		if ($res) {
			$sql3="select * from cms_comment as c inner join cms_users as u on c.user_id=u.user_id where c.new_id=$new_id and status=1 and comment_id=(select MAX(comment_id) from cms_comment)";
			// echo $sql3;exit;
			$res3=mysqli_query($link,$sql3);
			$row3=mysqli_fetch_assoc($res3);
			$sql1="select * from cms_reply as r inner join cms_users as u on r.user_id=u.user_id where comment_id={$row3['comment_id']}";
			$res1=mysqli_query($link,$sql1);
			$date=date('Y-m-d H:i:s',$row3['create_time']);
			$comments.="<li id='{$row3['comment_id']}' data-id='p2iptfal8tv3' class='comment-li'><div class='comment-box'>";
			if ($row3['user_thumb']){
      			$comments.="<img class='thumb' src='./upload/{$row3['user_thumb']}'/>";
			}else{
				$comment.="<img class='thumb' src='./upload/list6.jpeg'>";
			}
      	  		$comments.="<span class='comment-nickname'>{$row3['username']}</span><span class='comment-date'>{$date}</span>";
      	 	if (isset($_SESSION['username'])&&$_SESSION['username']!=''&&$_SESSION['user_id']==$row3['user_id']){
      	    	$comments.="<a onclick='deletes({$row3['comment_id']})' class='float-right comment-delete'>删除</a>";
      	    }else{
      	    	$comments.="<a style='cursor: pointer;' class='float-right comment-reply'>回复</a><div class='reply-input' style='height: 120px;display:none;'><textarea id='r{$row3['comment_id']}' placeholder='回复：{$row3['username']}' data-id='p2iorr9r9db4' data-name=''></textarea><p><button onclick='doreply({$row3['comment_id']})' class='add-reply-btn'>发表</button></p></div>";
      	    }
      	    $comments.="<a href='javascript:;' class='float-right comment-like cant-like '>0 赞</a></div><p>{$row3['comment_content']}</p>";
      		while ($row=mysqli_fetch_assoc($res1)) {
    	    	$comments.="<div class='reply-lists'><span class='arrow-up iconfont icon-up'>{$row['username']}</span><div data-id='p2lzu8al8tv3'><span class='ft_blue can_reply' title='点击回复他'>{$row['username']}</span>：{$row['reply_content']}</div></div>";
      		}
          	$comments.="</li>";
          	echo $comments;
		}else{
			echo 'false';
		}
	}