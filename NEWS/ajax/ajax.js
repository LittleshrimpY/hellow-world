function loadXMLDocGetTime(url,cfunc,param='')
		{
			if (window.XMLHttpRequest)
			{
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=cfunc;
			xmlhttp.open("GET",url+"?w="+Math.random()+param,true);
			xmlhttp.send();
}
function loadXMLDocGet(url,cfunc,param='')
		{
			if (window.XMLHttpRequest)
			{
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=cfunc;
			xmlhttp.open("GET",url+"&w="+Math.random()+param,true);
			xmlhttp.send();
}
function loadXMLDocPost(url,cfunc,param='')
		{
			if (window.XMLHttpRequest)
			{
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=cfunc;
			xmlhttp.open("POST",url+"&a="+Math.random(),true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send(param);
}
function getNewsAjax(page,menuid){
	loadXMLDocGet('getListNews.php?',function(){
			if (xmlhttp.readyState==4&&xmlhttp.status==200) {
				document.getElementById('list-news').innerHTML=xmlhttp.responseText;
			}
	},'&page='+page+'&menuid='+menuid);
}
function docomment(new_id){
	loadXMLDocGet('checkLogin.php?',function(){
			if (xmlhttp.readyState==4&&xmlhttp.status==200) {
				// alert(xmlhttp.responseText);
				if (xmlhttp.responseText=='true') {
					var comment = document.getElementById('comment-input').value;
					loadXMLDocGet('docomment.php?',function(){
						if (xmlhttp.readyState==4&&xmlhttp.status==200) {
							// alert(xmlhttp.responseText);
							if (xmlhttp.responseText!='false') {
							var comments = document.getElementById('comments-list').innerHTML;
							document.getElementById('comments-list').innerHTML=xmlhttp.responseText+comments;
						}
					}
				},"&new_id="+new_id+'&comment='+comment);
			}else{
				alert('请登录！');
				window.location='login.php';
			}
		}
	});
}
function doreply(comment_id){
	loadXMLDocGet('checkLogin.php?',function(){
		if (xmlhttp.readyState==4&&xmlhttp.status==200) {
				// alert(xmlhttp.responseText);
			if (xmlhttp.responseText=='true') {
				var reply_content=document.getElementById('r'+comment_id).value;
			   loadXMLDocPost('reply.php?',function(){
				if (xmlhttp.readyState==4&&xmlhttp.status==200) {
					// alert(xmlhttp.responseText);
					if (xmlhttp.responseText!='false') {
						var re=document.getElementById(comment_id).innerHTML;
						document.getElementById(comment_id).innerHTML=re+xmlhttp.responseText;
					}else{
						alert("回复失败");
					}
				}
			},"&comment_id="+comment_id+"&reply_content="+reply_content);
		}else{
			alert('请登录！');
			window.location='login.php';
		}
	}
  },)
}
function deletes(comment_id){
	loadXMLDocGet('delete.php?',function(){
		if (xmlhttp.readyState==4&&xmlhttp.status==200) {
			if (xmlhttp.responseText=='true') {
				alert('删除成功!');
				document.getElementById(comment_id).style.display='none';
			}else{
				alert('删除失败!');
			}
		}
	},'&comment_id='+comment_id);
}
$(document).ready(function(){
             $('.comment-reply').click(function(){
             	 //$('.reply-input').show(); 错误的
             	 $(this).next().show().parents('.comment-li').siblings().find('.reply-input').hide();
             });
})