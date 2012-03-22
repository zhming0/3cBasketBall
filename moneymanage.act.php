<?php
	require('global.inc.php');
	if (isset($_POST['content']) && isset($_POST['cnt']) && isset($_POST['year']) && isset($_POST['month']) && isset($_POST['day']) && isset($_POST['mode']))
	{
		//add new record
	} 
	$t = time();
	$year=isset($_GET['year'])?ceil($_GET['year']):0;
	if ($year==0)
		$year=date('Y', $t);
	$month=isset($_GET['month'])?ceil($_GET['month']):0;
	if ($month==0)
		$month=date('m', $t)*1;
	$day=isset($_GET['day'])?ceil($_GET['day']):0;
	//if ($day==0)
	//	$day=date('d', $t);
?>
<style type="text/css">
#timeSelect{
	background-repeat:no-repeat;
	text-align:center;	
	padding:3px;
	margin-top: 20px;
	margin-bottom: 20px;
	position:relative;
}
#timeSelect div{
	zoom:1;
}
#timeSelect select {
	padding: 5px;
	width:80px;
	height:30px;
	margin: 4px;
	font-size: 16px;
	border: 1px solid #ccc;
	overflow: hidden;
	background: url("image/selector.jpg") no-repeat right #ddd;
}
#timeSelect select.mode{
	width:120px;
}
#timeSelect .mode {
	text-align: center;
}
#note {
	background-image:url(./images/sticknote.png);
	background-position:0 125px;
	margin: 10px;
	width:125px;
	height:124px;

}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('.year').val('<?php echo $year;?>');
		$('.month').val('<?php echo $month;?>');
		$('.day').val('<?php echo $day;?>');
	});
	$('.year').change(function(){
		alert('year is changed;');
	});
	$('.month').change(function(){
		alert('month is changed;');
	});
	$('.day').change(function(){
		alert('day is changed;');
	});
</script>

<div id="timeSelect">
	<div><select class="year">
		<option value="2010">2010</option>
		<option value="2011">2011</option>
		<option value="2012">2012</option>
	</select>
	年
	<select class="month">
		<option value="0">--</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
	</select>
	月
	<select class="day">
		<option value="0">--</option>
		<?php
			$m = $month+1;
			$y = $year;
			if ($m>12)
			{
				$m = 1;
				$y++;
			}
			$t = mktime(0,0,0, $m, 1, $y)-24*3600;
			$d = date('d', $t);
			for ($i=1; $i<=$d; $i++)
				echo "<option value='$i'>".$i."</option>"; // unsure...
		?>
	</select>
	日
	<select class="mode">
		<option value="0"> 出账&#38;入账 </option>
		<option value="1"> 出账 </option>
		<option value="2"> 入账 </option>
	</select>
	</div>
</div>
<div id = "note">

</div>
