<?php


require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('administrator')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();

$base = new cBase;
$hdr = new cReplace('header');
$tpl = new cReplace;
$ftr = new cReplace('footer');

$hdr->replace('#topnav','#');
$session=$sec->getSession('user_info');
include_once('include/common_var');
$mess = new cMessage($s_lang);

$dbdateform=$base->getGlobal('dbdateform');
$radacct_clean_days = $base->getGlobal('radacct_clean_days');
$stale_clean_days = $base->getGlobal('clean_stale_after_days');

$opts=$sec->fetchAllowedISP();
$tpl->dropDown('#isporg',$opts,$p_isporg,true);

$opts=parse_ini_file(CONFIGDIR.'config'.INI);
if($p_loop==1)
{
	foreach($_POST as $key => $val)
		if(isset($opts[$key]))
			$opts[$key]=$val;
	$tpl->writeConfigFile('config',$opts);
}

foreach($opts as $key => $val)
	$tpl->replace('#'.$key,$val);

$hdr->replace('//blank','status(5)');

$hdr->render();
$tpl->render();
$ftr->render();

?>
