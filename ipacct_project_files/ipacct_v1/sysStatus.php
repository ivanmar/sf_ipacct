<?php


require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('operator')!=LOGIN_PASSED)
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

$opts=$sec->fetchAllowedISP();
$tpl->dropDown('#isporg',$opts,$p_isporg,true);

if($p_loop==0)
{
  $p_isporg=$s_id_isporg;
  $p_logtype='log/ipacct.log';
  $p_lines=10;
}

$logtype=array( "log/ipacct.log" => "Ipacct log",
		"/var/log/radius/radius.log" => "Radius log",
                "/var/log/messages" => "System log" );
                
$tpl->dropDown('#logtype',$logtype,$p_logtype,true);

$lines=array(10,20,30,40,50,100);
$tpl->dropDown('#lines',$lines,$p_lines,false);

$tpl->replace('#param',"isporg=$p_isporg");
$tpl->replace('#log',"log=$p_logtype&lines=$p_lines");
$tpl->replace('#keyword',$p_keyword);

$hdr->replace('#message',$nruser);

$hdr->replace('//blank','ping(10);log(10);');

$hdr->render(false);
$tpl->render();
$ftr->render();

?>
