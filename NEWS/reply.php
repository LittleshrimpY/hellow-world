<?php
require './admin/db.php';
session_start();
$comment_id=$_POST['comment_id'];
$user_id=$_SESSION['user_id'];
$reply_content=$_POST['reply_content'];
$time=time();
$sql="insert into cms_reply(user_id,comment_id,reply_content,create_time) value('{$user_id}','{$comment_id}','{$reply_content}','{$time}')";
$reply='';
if (mysqli_query($link,$sql)) {
	$sql1="select * from cms_reply as r inner join cms_users as u on r.user_id=u.user_id where comment_id=$comment_id";
	$res1=mysqli_query($link,$sql1);
	while ($row=mysqli_fetch_assoc($res1)) {
    	   $reply.="<div class='reply-lists'><span class='arrow-up iconfont icon-up'>{$row['username']}</span><div data-id='p2lzu8al8tv3'><span class='ft_blue can_reply' title='点击回复他'>{$row['username']}</span>：{$row['reply_content']}</div></div>";
    }
   echo $reply;
}else{
	echo 'false';
}