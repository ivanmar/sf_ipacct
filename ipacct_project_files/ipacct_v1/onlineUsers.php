<?php


require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('administrator')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();

$base = new cBase;
$mess = new cMessage('en');

$hdr = new cReplace('header');
$tpl = new cReplace;
$ftr = new cReplace('footer');

$hdr->replace('#topnav','#');
$session=$sec->getSession('user_info');
include_once('include/common_var');

$hdr->replace("//blank","refresh(5)");

if($p_loop==0) $p_isporg=$s_id_isporg;

if(isset($g_id) && $g_action=='del')
  $exec=$base->execute('del_record',array($g_id));
else
  $_SESSION['isp']= $p_isporg;


$tmp_isp=$_SESSION['isp'];

$opts=$sec->fetchAllowedISP();
$tpl->dropDown('#isporg',$opts,$tmp_isp,true);
$tpl->replace('#param',"isporg=$p_isporg");
$tpl->replace('#message',NRUSER.' 0');

$hdr->render();
$tpl->render();
$ftr->render();

?>
