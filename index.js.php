var isIE=document.all?1:0;
var time=<?php echo time();?>;
function flash(ur,w,h){
	document.write('<object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" id="obj1" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" border="0" width="'+w+'" height="'+h+'">');
	document.write('<param name="movie" value="'+ur+'">');
	document.write('<param name="quality" value="high"> ');
	document.write('<param name="wmode" value="transparent"> ');
	document.write('<param name="menu" value="false"> ');
	document.write('<embed src="'+ur+'" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" name="obj1" width="'+w+'" height="'+h+'" quality="High" wmode="transparent">');
	document.write('</embed>');
	document.write('</object>');
}




var LOADING='<table><tr><td><img src="images/loading.gif"/></td><td>加载中...</td></tr></table>';

$(document).ready(function(){
	DD_belatedPNG.fix('div,img,p,span,label');
	$('#memberInfo,#loading').html(LOADING);
	$('#loading,#main').hide();
	$.get('member_info.act.php',function(data){
		str='欢迎您： '+data.username+'<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
		'[ <a href="logout.php">退出</a> ] [ <a href="">修改密码</a> ]';
		$('#memberInfo').html(str);
	},'JSON');
	$('#leftBar .itemLabel').addClass('bg');
	actYearPlan();
});

function showLoading(){
	$('#loading').stop(true,true);
	$('#main').stop(true,true);
	$('#loading').fadeIn(500);
	$('#main').fadeOut(500);
}

function hideLoading(){
	$('#loading').stop(true,true);
	$('#main').stop(true,true);
	$('#loading').fadeOut(500);
	$('#main').fadeIn(500);
}

function select(id){
	$('#leftBar .itemLabel').css({backgroundImage:'url(./images/leftbg.png)'});
	$('#'+id).css({backgroundImage:'none'});
}
var proc=0;
function actYearPlan(year){
	if(!year)
		year=0;
	showLoading();
	select('yearPlan');
	if(proc)
		proc.abort();
	proc=$.get('year_plan.act.php',{"t":time++,"year":year},function(data){
		if(data.length==0)
			return;
		proc=0;					// That's weird!
		$('#main').html(data);
		hideLoading();
	});
}

function actMonthPlan(year){
	if(!year)
		year=0;
	showLoading();
	select('monthPlan');
	if(proc)
		proc.abort();
	proc=$.get('month_plan.act.php',{"t":time++,"year":year},function(data){
		if(data.length==0)
			return;
		proc=0;
		$('#main').html(data);
		hideLoading();
	});
}

function actWeekPlan(year,month){
	if(!year)
		year=0;
	if(!month)
		month=0;
	showLoading();
	select('weekPlan');
	if(proc)
		proc.abort();
	proc=$.get('week_plan.act.php',{"t":time++,"year":year,"month":month},function(data){
		if(data.length==0)
			return;
		proc=0;
		$('#main').html(data);
		hideLoading();
	});
}
function actMoneyManage() {
	alert("shit");
}