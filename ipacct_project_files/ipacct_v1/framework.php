<?php

ob_start();
session_start();
$sessid=session_id();

foreach($_POST as $key => $val)
if(!empty($val))
	eval('$p_'.$key."='$val';");
else
	eval('$p_'.$key."=null;");

foreach($_GET as $key => $val)
if(!empty($val))
	eval('$g_'.$key."='$val';");
else
	eval('$g_'.$key."=null;");

require_once("include/cBase.php");
require_once("include/cMessage.php");
require_once("include/cReplace.php");
require_once("include/cIpacct.php");

$datnow=date("l d.m.Y");

?>
