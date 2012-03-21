<?php
require('global.inc.php');
$year=isset($_GET['year'])?$_GET['year']:0;
date_default_timezone_set('Asia/Chongqing');
$t=time();
$thisyear=date('Y',$t);
$thismonth=date('m',$t)*1;
if($year==0)
	$year=$thisyear;
if(!$D->exist('monthplan'.$thisyear))
{
	$D->set('monthplan'.$thisyear,array('','','','','','','','','','','',''));
}
$mplan=$D->get('monthplan'.$year);
?>
<style type="text/css">
.noteBlock{
	background-image:url(./images/sticknote.png);
	background-position:0 125px;
	width:125px;
	height:124px;
	float:left;
	margin:6px;
	cursor:pointer;
	display:block;
	text-decoration:none;
	color:#222;
}

.noteBlock:hover{
	text-decoration:none;
}

.noteBlock .content{
	font-size:13px;
	height:100px;
	padding:1px;
}
.noteBlock .locked{
	color:#777;
	cursor:default;
}
.noteBlock .content .text{
	padding:3px;
	height:85px;
	overflow:hidden;
}
.noteBlock .content center{
	font-weight:bold;
}
#monthTitle{
	line-height:50px;
	font-weight:bold;
	padding:5px;
	color:#FFF;
	position:relative;
}
#monthTitle .basketball{
	background-image:url(./images/basketball.png);
	width:50px;
	height:50px;
	line-height:50px;
	text-align:center;	
	cursor:pointer;
}
#monthTitle .basketball img{
	margin-top:15px;
	width:20px;
	height:20px;
}
#detail{
	width:530px;
	height:400px;
	position:absolute;
	padding:3px;
	left:560px;
	top:0;
	background:#FFF;
	border:1px solid #555;
	overflow-y:scroll;
}
#frameOuter{
	position:relative;
	overflow:hidden;
	width:560px;
	height:408px;
}
#frameInner{
	position:absolute;
	left:0;
	top:0;
	height:408px;
	width:1200px;
}
#months{
	width:560px;
	height:408px;
}
</style>
<script type="text/javascript">
$(function(){
	var $c=$('.noteBlock');
	$c.hover(function(){
		$(this).css({backgroundPosition:'0 0'});
	},function(){
		$(this).css({backgroundPosition:'0 125px'});
	});
	$('#detail div').hide();
	$('#detail').css({opacity:0.8});
});
function detail(month)
{
	var $c=$('#m'+month);
	$('#frameInner').animate({left:-550},300);
	$('#detail div').hide();
	$('#detail'+month).show();
}
function back()
{
	$('#frameInner').animate({left:0},300);	
}
</script>
<div id="monthTitle">
	<div style="float:left">
		关键字搜索：<input type="text"/> <input type="submit" value="查询">
	</div>
	<div style="float:right;position:relative;width:200px;line-height:50px;text-align:center">
		<div class="basketball" style="left:0" onclick="actMonthPlan(<?php echo $year-1;?>)">
			<img src="images/left.png"/>
		</div>
		<?php echo $year;?>年
		<div class="basketball" style="right:0" onclick="actMonthPlan(<?php echo $year+1;?>)">
			<img src="images/right.png"/>
		</div>
	</div>
</div>
<div id="frameOuter"><div id="frameInner">
	<div id="months">
	<?php
if($mplan===false)
{
	echo '<div style="color:#900;padding:5px;background-image:url(./images/whitebg.png);font-size:20px;">【没有本年度的月计划信息】</div>';
}else
	for($i=1;$i<=12;$i++)
	{
		$ccc='';
		$act=' onclick="detail('.$i.')"';
		if($thisyear<$year||($thisyear==$year&&$i>$thismonth))
		{
			$ccc=' locked';
			$act='';
		}
		echo<<<HTML
		<a class="noteBlock" id="m{$i}" href="javascript:void(0)"{$act}>
			<div class="content{$ccc}">
				<center>{$i}月</center>
				<div class="text">{$mplan[$i-1]}</div>
			</div>
		</a>
HTML;
	}
	?>
	</div>
	<div id="detail">
		<p style="text-align:right;padding:0;margin:0">
			<a href="javascript:void(0)" onclick="back()">[ ←返回 ]</a>
			<a href="javascript:void(0)" onclick="edit()">[ 编辑 ]</a>
		</p>
		<?php
		if($mplan)
		{
		for($i=1;$i<=12;$i++)
		echo<<<html
		<div id="detail{$i}">{$mplan[$i-1]}</div>
html;
		}
		?>
	</div>
</div></div>
