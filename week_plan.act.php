<?php
require('global.inc.php');
$year=isset($_GET['year'])?$_GET['year']:0;
$month=isset($_GET['month'])?$_GET['month']:0;
date_default_timezone_set('Asia/Chongqing');
$t=time();
if($year==0)
	$year=date('Y',$t);
if($month==0)
	$month=date('m',$t)*1;
$yp=$yn=$year;
$mn=$month+1;
if($mn>12)
{
	$mn=1;
	$yn++;
}
$mp=$month-1;
if($mp<1)
{
	$mp=12;
	$yp--;
}
?>
<style type="text/css">
#calendar{
	background-repeat:no-repeat;
	padding:3px;
	width:550px;
	position:relative;
}
#calendar p,#calendar div,#calendar span{
	display:block;
	margin:0;
	padding:0;
}
#calendar div{
	zoom:1;
	overflow:hidden;
}
#calendar div p,#calendar div span{
	float:left;
	width:68px;
	height:50px;
	line-Height:50px;
	text-align:center;
	border:1px solid #ADF;
	margin:4px;
	font-size:15px;
	background-image:url(./images/whitebg.png);
}
#calendar div p{
	color:#000;
	font-weight:bold;
	cursor:pointer;
}
#calendar span{
	color:#333;
}
#calendar .week{
	background-image:url(./images/leftbg.png);
	margin-bottom:5px;	
}
#calendar .week p{
	color:#FFF;
	background:none;
	border:none;
	padding:1px;
}
#calendar div label{
	display:block;
	padding:5px;
	background-image:url(./images/leftbg.png);	
	color:#FFF;
}
#calendar div:hover span{
	color:#CCC;
}
#detail{
	background:#000;
	color:#FFF;
	position:absolute;
	top:60px;
	bottom:0;
	left:3px;
	opacity:0.85;
	-moz-opacity:0.85;
	filter:alpha(opacity=85);
	width:240px;
}
#detail p{
	padding: 7px;
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
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('#calendar label').hide();
	$('#detail').hide();
	$('#calendar div[class!="week"]').hover(function(){
		$(this).css({background:'#55A'});
		$(this).find('label').css({display:'block'});
	},function(){
		$(this).css({background:'none'});
		$(this).find('label').css({display:'none'});
	});
	$('#calendar div[class!="week"] p').hover(function(){
		$(this).css({borderColor:'#0FA',color:'#FFF'});
		$('#detail').show();
		var left=$(this).position().left;
		var height=$('#calendar').height();
		if(left>200)
			$('#detail').css({left:0,right:'auto',height:height});
		else
			$('#detail').css({left:'auto',right:0,height:height});
	},function(){
		$('#detail').hide();
		$(this).css({borderColor:'#ADF',color:'#000'});
	});
});
</script>
<div id="monthTitle">
	<div style="float:left;position:relative;width:200px;line-height:50px;text-align:center">
		<div class="basketball" style="left:0" onclick="actWeekPlan(<?php echo $yp.','.$mp;?>)">
			<img src="images/left.png"/>
		</div>
		<?php echo $month;?>月
		<div class="basketball" style="right:0" onclick="actWeekPlan(<?php echo $yn.','.$mn;?>)">
			<img src="images/right.png"/>
		</div>
	</div>
	<div style="float:right;position:relative;width:200px;line-height:50px;text-align:center">
		<div class="basketball" style="left:0" onclick="actWeekPlan(<?php echo ($year-1).','.$month;?>)">
			<img src="images/left.png"/>
		</div>
		<?php echo $year;?>年
		<div class="basketball" style="right:0" onclick="actWeekPlan(<?php echo ($year+1).','.$month;?>)">
			<img src="images/right.png"/>
		</div>
	</div>
</div>
<div id="calendar">
	<div class="week">
		<p>日</p>
		<p>一</p>
		<p>二</p>
		<p>三</p>
		<p>四</p>
		<p>五</p>
		<p>六</p>
	</div>
	<?php
	$c=new Calendar($year,$month);
	$c=$c->draw();
	foreach($c as $w)
	{
		echo '<div>';
		foreach($w as $d)
		{
			if($d[1])
				echo '<p title="点击以编辑">'.$d[0].'</p>';
			else
				echo '<span>'.$d[0].'</span>';
		}
		echo '<label>hahahahahahahahahahahah ahahahahahahahahahahahahahahahahahahahahahahahahahahahaha<br/>asdasd</label>';
		echo '</div>';
	}
	?>
	<label id="detail">
		<p>
		hahaha<br/>ahahahahahahahahahah
		</p>
	</label>
</div>