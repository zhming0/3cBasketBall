<?php
require_once('global.inc.php');
$ret['username']=$U->user();
echo json_encode($ret);
?>