document.write("<script type='text/javascript' src='./public/jscript/ajax.js'></script>");
function hiddenhf(){
	document.getElementById("replybox").style.display='none';
	document.getElementById("replyboxCover").style.display='none';
}
function overflowH(){
	document.getElementById("body").style.overflow="hidden";
}
function overflowR(){
	document.getElementById("body").style.overflow="auto";
}
window.onload=function (){
	// comments=document.getElementById("comments");
	// postboxCover=document.getElementById("postboxCover");
	// document.getElementById("hf").onclick=function(){giveTime();overflowH();showly();};
	// postboxCover.onclick=function(){hiddenly();};
	// document.getElementById("postly").onclick=function(){ly();};
	admingetDataAll("","");
}