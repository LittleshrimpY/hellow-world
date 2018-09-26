var time;
var begin=1,orders="id desc";
var adminbegin=1;
var username="",password="";
function loadXMLDocGetTime(url,cfunc,param)
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
function loadXMLDocGet(url,cfunc,param)
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
function loadXMLDocPost(url,cfunc,param)
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

function deletes(id){
	loadXMLDocGet("index.php?s=admin/delete&id="+id,function () {
		if (xmlhttp.readyState==4&&xmlhttp.status==200) {
			if (xmlhttp.responseText=="true") {
				alert("删除成功");
				var number=document.getElementById("totalD").innerHTML;
				document.getElementById('totalD').innerHTML= number-1;
				document.getElementById(id).style.display='none';
			}else{
				alert("删除失败");
			}
		}
	});
}
function reply(id){
	var poster = document.getElementById("user").value;
	var email  = document.getElementById("email").value;
	var ly = document.getElementById("ly").value;
	var hf = document.getElementById("hf").value;
	if (poster==""||email==""||ly==""||hf=="") {
		alert("请输入值");
		return;
	}
	loadXMLDocPost("index.php?s=admin/reply",function () {
		if (xmlhttp.readyState==4&&xmlhttp.status==200) {
			if (xmlhttp.responseText=="true") {
				document.getElementById("replyboxCover").style.display='none';
				document.getElementById("replybox").style.display='none';
				admingetDataAll(begin,orders);
			}else{
				alert("回复失败");
			}
		}
	},"&id="+id+"&poster="+poster+"&email="+email+"&ly="+ly+"&hf="+hf);
}
function ShowReply(id){
	document.getElementById("replyboxCover").style.display="block";
	document.getElementById("replybox").style.display="block";
	loadXMLDocGet("index.php?s=admin/getByID&id="+id,function () {
		var comments="";
		if (xmlhttp.readyState==4&&xmlhttp.status==200) {
			var lyData=JSON.parse(xmlhttp.responseText);
			comments="<ul class=\"userbox\"><li>名称：<li>"
			comments=comments+"<li class=\"user_name\"><input id=\"user\" type=\"text\" name=\"poster\" value="+lyData[0].poster+"></input></li>";
			comments=comments+"<li>邮箱：</li><li class=\"user_email\"><input id=\"email\" type=\"email\" name=\"email\" value="+lyData[0].mail+"></input></li>";
			comments=comments+"<li>留言：</li><textarea id=\"ly\" style=\"resize: none;overflow:hidden;\" name=\"ly\">"+lyData[0].comment+"</textarea>";
			comments=comments+"<li>回复：</li><textarea id=\"hf\" style=\"resize: none;overflow:hidden;\" name=\"ly\">"+lyData[0].reply+"</textarea>";
			comments=comments+"<li class=\"user_post\"><input onclick=\"reply("+lyData[0].id+")\" id=\"postly\" type=\"button\" class=\"post_button\" value=\"发布\"></input><li></ul>";
			document.getElementById("replybox").innerHTML=comments;
		}
	});
}
function ly(){
	var user=document.getElementById("user").value;
	var email=document.getElementById("email").value;
	var ly=document.getElementById("ly").value;
	var arraylt=new Array();
	var comment;
	var check;
	loadXMLDocPost("?s=lyb/add",function () {
		if (xmlhttp.readyState==4&&xmlhttp.status==200) {
			comment=ly.replace(/</g,"&lt");
			comment=comment.replace(/>/g,"&gt");
			if (xmlhttp.responseText=="true") {
				var allLy=document.getElementById("comments").innerHTML;
				var total=document.getElementById("totalD").innerHTML;
				document.getElementById("comments").innerHTML="<li><p>用户名:"+user+"</p><p>"+comment+"</p><p>发布日期："+time+"</p>"+allLy;
				document.getElementById("totalD").innerHTML=parseInt(total)+1;
				hiddenly();
				overflowR();
			}else{
				alert("发表失败");
			}
		}
	},'&poster='+user+'&email='+email+'&ly='+ly);
}
function giveTime(){
			loadXMLDocGetTime("./public/jscript/time.php",function(){
				if (xmlhttp.readyState==4&&xmlhttp.status==200) {
					time=xmlhttp.responseText;
				}
			},"");
		}
function getDataAll(a,b){
		if (a!==""){begin=a;}
		if (b!==""){orders=b;}
		loadXMLDocGet("?s=lyb/getDataAll",function(){
		if (xmlhttp.readyState==4&&xmlhttp.status==200) {
			var lyData = JSON.parse(xmlhttp.responseText);
			if (lyData.color=="id desc") {
				var order="<span class=\"sort\">排序方式:<a onclick=\"getDataAll(begin,'id asc')\" style=\"cursor:pointer;\">正序</a>";
				order=order+"<a onclick=\"getDataAll(begin,'id desc')\" style=\"cursor:pointer;color:blue;\">倒序</a></span>";
			}else{
				var order="<span class=\"sort\">排序方式:<a onclick=\"getDataAll(begin,'id asc')\" style=\"cursor:pointer;color:blue;\">正序</a>";
				order=order+"<a onclick=\"getDataAll(begin,'id desc')\" style=\"cursor:pointer;\">倒序</a></span>";
			}
			var comments="";
			document.getElementById("comment_info").innerHTML="留言数: <span id='totalD'>"+lyData.totalData+"</span>"+order;
			for (var i = 0; i <lyData.data.length; i++){
				comments=comments+"<li><p>用户名:"+lyData.data[i].poster+"</p><p>"+lyData.data[i].comment+"</p><p>发布日期："+lyData.data[i].date+"</p>";
				if (lyData.data[i].reply!="") {
					comments=comments+"<ul class='comment_reply'><li><p>管理员回复:</p><p>"+lyData.data[i].reply+"</p></li></ul>";
				}
			}
			document.getElementById("comments").innerHTML=comments;
			document.getElementById("comments_footer").innerHTML=lyData.pagelist;
		}
	},"&page="+begin+"&order="+orders);
}
function admingetDataAll(a,b){
		if (a!==""){begin=a;}
		if (b!==""){orders=b;}
		loadXMLDocGet("?s=admin/getDataAll",function(){
		if (xmlhttp.readyState==4&&xmlhttp.status==200) {
			var lyData = JSON.parse(xmlhttp.responseText);
			if (lyData.color=="id desc") {
				var order="<span style=\"float:right\">排序方式:<a onclick=\"admingetDataAll(begin,'id asc')\" style=\"cursor:pointer;\">正序</a>";
				order=order+"<a onclick=\"admingetDataAll(begin,'id desc')\" style=\"cursor:pointer;color:blue;\">倒序</a></span>";
			}else{
				var order="<span style=\"float:right\">排序方式:<a onclick=\"admingetDataAll(begin,'id asc')\" style=\"cursor:pointer;color:blue;\">正序</a>";
				order=order+"<a onclick=\"admingetDataAll(begin,'id desc')\" style=\"cursor:pointer;\">倒序</a></span>";
			}
			document.getElementById("comment_info").innerHTML="留言数: <span id='totalD'>"+lyData.totalData+"</span>"+order;
			var comments="";
			for (var i = 0; i <lyData.data.length; i++){
				comments=comments+"<span id="+lyData.data[i].id+"><li>作者:&nbsp;"+lyData.data[i].poster+"&nbsp;邮箱:&nbsp;"+lyData.data[i].mail+"&nbsp;IP:&nbsp;"+lyData.data[i].ip;
				comments=comments+"<span class=\"right\"><a style=\"color: #416fa9;\" onclick=\"ShowReply("+lyData.data[i].id+")\">修改回复</a>&nbsp;<a style=\"color: #416fa9;\" onclick=\"deletes("+lyData.data[i].id+")\">删除</a></span></li><li>留言:&nbsp;"+lyData.data[i].comment+"</li><li><span class=\"right\">";
				comments=comments+"发布时间:"+lyData.data[i].date+"</span>管理员回复:<br/>&nbsp;"+lyData.data[i].reply+"</li></span>";
			}
			document.getElementById("comments").innerHTML=comments;
			document.getElementById("footer").innerHTML=lyData.pagelist;
		}
	},"&page="+begin+"&order="+orders);
}
function dlg(){
	username = document.getElementById("username").value;
	password = document.getElementById("password").value;
	loadXMLDocPost("?s=admin/loginAction",function(){
		if (xmlhttp.readyState==4&&xmlhttp.status==200) {
			if (xmlhttp.responseText!="false") {
				document.getElementById("dlbox").style.display="none";
				document.getElementById("dlboxCover").style.display="none";
				window.location.href="?s=admin/listAll";
			}else{
				alert("登录失败，用户名或密码错误！");
			}
		}
	},"&username="+username+"&password="+password);
}