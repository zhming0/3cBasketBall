<?php
	require('global.inc.php');
	if (isset($_POST['content']) && isset($_POST['cnt']) && isset($_POST['year']) && isset($_POST['month']) && isset($_POST['day']))
	{
		//add new record
	} 
	$t = time();
	$year=isset($_GET['year'])?ceil($_GET['year']):data('Y', $t);
	$month=isset($_GET['month'])?ceil($_GET['month']):data('m', $t)*1;
	$day=isset($_GET['day'])?ceil($_GET['day']):data('d', $t);
?>
<style type="type/css">

</style>
<script type="text/javascript">
</script>