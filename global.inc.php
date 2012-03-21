<?php

date_default_timezone_set('Asia/Chongqing');
require_once('hash.inc.php');
require_once('user.inc.php');
require_once('calendar.inc.php');
require_once('data.inc.php');
$U=new User;
$H=new Hash;
$D=new Data($H->encode($U->user()));
?>