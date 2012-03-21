<?php
require('global.inc.php');
if(isset($_POST['content'])&&isset($_POST['year']))
{
	$D->set('yearplan'.$_POST['year'],array('content'=>$_POST['content']));
	die('ok');
}
$year=isset($_GET['year'])?ceil($_GET['year']):0;
date_default_timezone_set('Asia/Chongqing');
$thisyear=date('Y',time());
if($year==0){
	$year=$thisyear;
}
if(!$D->exist('yearplan'.$thisyear))
{
	$D->set('yearplan'.$thisyear,array('content'=>''));
}
$list=$D->find('yearplan');
natsort($list);
$list=array_reverse($list);
$plan=$D->get('yearplan'.$year);
?>
<style type="text/css">
#calendar .head{
	background-image:url(./images/calendar_topbg.png);
	background-repeat:no-repeat;
	height:85px;
	line-height:85px;
	text-align:center;
	font-size:25px;
	font-weight:bold;
	color:#330;
}
#calendar .body{
	background-image:url(./images/calendar_bodybg.png);
	background-repeat:repeat-y;
}
#calendar .foot{
	background-image:url(./images/calendar_footbg.png);
	background-repeat:no-repeat;
	height:120px;
}
#calendar .body .content{
	float:left;
	padding:1px 5px;
	width:400px;
	margin-left:3px;
}
#calendar .body .list{
	width:100px;
	float:left;
	margin-left:20px;
}
#calendar .body .list .item{
	color:#777;
	border-bottom:1px dashed #AAA;
	text-align:center;
	cursor:pointer;
}
#calendar .body .list .item:hover{
	color:#333;
	border-bottom:1px dashed #777;
}
#calendar .foot .tools{
	margin:7px;
	border-top:1px dashed #7C7;
	padding:5px;
	width:400px;
	
}
#calendar .body .content textarea{
	width:390px;
	resize:none;
}
</style>
<script type="text/javascript">
function edit()
{
	var $c=$('#calendar .body .content');
	var item=$('#editBtn')[0];
	$(item).html('保存');
	item.onclick=function(){
		$(item).html('请稍候...');
		$c.attr('contentEditable','false');
		$c.css({background:'none'});
		item.onclick='';
		$.post('year_plan.act.php',{'year':<?php echo $year;?>,'content':$c.html()},function(data){
			if(data=='ok')
			{
				item.onclick=edit;
				$(item).html('编辑');
			}
		});
	};
	$c.attr('contentEditable','true');
	$c.css({background:'#FFF'});
	$c.focus();
}
function empty()
{
	$('#calendar .body .content').html('');
	edit();
}
</script>
<div id="calendar">
	<div class="head">
		<?php echo $year;?>年计划
	</div>
	<div class="body">
		<div class="content"><?php echo $plan['content'];?></div>
		<div class="list">
			<?php
				foreach($list as $f)
				{
					echo<<<HTML
			<div class="item" onclick="actYearPlan({$f})">{$f}年</div>
HTML;
				}
			?>
		</div>
	</div>
	<div class="foot">
		<div class="tools">
			[ <a href="javascript:void(0)" onclick="edit();" id="editBtn">编辑</a> ]
			[ <a href="javascript:void(0)" onclick="empty();">清空</a> ]
		</div>
	</div>
</div>