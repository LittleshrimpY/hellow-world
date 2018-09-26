document.write("<script type='text/javascript' src='./public/jscript/ajax.js'></script>");
var postbox,postboxCover,fbly,dl,dlgo;
function showly(){
	postbox.style.display='block';
	postboxCover.style.display='block';
}
function hiddenly(){
	postbox.style.display='none';
	postboxCover.style.display='none';
}
function overflowH(){
	document.getElementById("body").style.overflow="hidden";
}
function overflowR(){
	document.getElementById("body").style.overflow="auto";
}
function showDl(){
	document.getElementById("dlbox").style.display="block";
	document.getElementById("dlboxCover").style.display="block";
	document.getElementById("dlboxCover").onclick=function(){
		document.getElementById("dlbox").style.display="none";
		document.getElementById("dlboxCover").style.display="none";
	}
}
window.onload=function (){
	dlgo=document.getElementById("dl");
	dl=document.getElementById("login");
	postbox=document.getElementById("postbox");
	postboxCover=document.getElementById("postboxCover");
	fbly=document.getElementById("fbly");
	fbly.onclick=function(){giveTime();overflowH();showly()};
	postboxCover.onclick=function(){hiddenly();overflowR()};
	dl.onclick=function(){showDl();overflowH()};
	dlgo.onclick=function(){dlg();overflowR()};
	document.getElementById("postly").onclick=function(){ly();};
	getDataAll("","");
}