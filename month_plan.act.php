<?php
require('global.inc.php');
$year=isset($_GET['year'])?$_GET['year']:0;
$t=time();
if($year==0)
	$year=date('Y',$t);
$mplan=$D->get('monthplan2012');
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
}

.noteBlock .content{
	font-size:13px;
	height:100px;
	padding:1px;
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
	background-image:url(./images/whitebg.png);	
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
$(function(){
	$('.noteBlock').hover(function(){
		$(this).css({backgroundPosition:'0 0'});
	},function(){
		$(this).css({backgroundPosition:'0 125px'});
	});
});
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
<?php
for($i=1;$i<=12;$i++)
{
echo<<<HTML
	<div class="noteBlock">
		<div class="content">
			<center>{$i}月</center>
			<div class="text">{$mplan[$i-1]}</div>
		</div>
	</div>
HTML;
}
?>