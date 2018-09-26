<?php
require './admin/db.php';
$comment_id=$_GET['comment_id'];
$sql="update cms_comment set status=0 where comment_id={$comment_id}";
if (mysqli_query($link,$sql)) {
	echo 'true';
}else{
	echo 'false';
}