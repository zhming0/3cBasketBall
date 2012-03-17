<?php
require_once('global.inc.php');
if($U->user()===0)
{
	die('<meta charset="utf8"/>请登录后再进入此页面');
}
$c=new Calendar(2012,4);
//$c->draw();
include('./template/index.html');
?>