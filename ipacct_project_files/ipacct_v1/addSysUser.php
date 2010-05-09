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

$lang=array('en','hr');
$tpl->dropDown('#lang',$lang,$p_plang,false);

if($g_action=='del' && $g_id > 1)
{
  $param=array($g_id);
  $exec=$base->execute('check_user_series',$param);
  $rows=$base->fetchAll();
  $num=count($rows);
  $exec=$base->execute('check_postp_logs',$param);
  $rows=$base->fetchAll();
  $num+=count($rows);
  $exec=$base->execute('check_prep_logs',$param);
  $rows=$base->fetchAll();
  $num+=count($rows);
  if($num==0)
    $exec=$base->execute('del_sysuser',$param);
  else {
    $sec->systemLog(SYSUSERUSED);
    $hdr->replace('#message',SYSUSERUSED);
  }
}

if($p_loop==1 || $p_loop==2)
  $exec=$base->execute('sel_ispsuborg',array($p_isporg));
else
  $exec=$base->execute('sel_ispsuborg',array('1'));
$rows=$base->fetchAll();
$opts=array();
foreach($rows as $index => $record)
{
	$key=$rows[$index]["id"];
	$val=$rows[$index]["suborgname"];
	$opts[$key]=$val;
}
$tpl->dropDown('#ispsuborg',$opts,$p_ispsuborg,true);

if($p_loop==1)
{
  $input_error=$sec->checkRequiredFields (array('username'=>$p_username,'password'=>$p_pass,'isp org'=>$p_isporg,'isp suborg'=>$p_ispsuborg));
  if(strlen($input_error) == 0)
  {
	$param=array($p_isporg,$p_username);
	$exec=$base->execute('check_sameuser',$param);
	$rows=$base->fetchAll();

	if(count($rows)==0)
	{
	  $pass=md5($p_pass);
	  $param=array(	$p_username,$pass,$p_acctype,
	                $p_isporg,$p_fullname,$p_email,
			$p_phone,$p_mobile,$p_ispsuborg,$p_lang );
	  $exec=$base->execute('ins_user',$param);
	  if((int)$exec==0)
	  {
	    $sec->systemLog(OK);
	    $hdr->replace('#message',OK);
	  } else {
	    $sec->systemLog(FAIL);
	    $hdr->replace('#message',FAIL);
	  }
	  $p_pass='';
	}
	else {
	  $sec->systemLog(SAMEUSER);
	  $hdr->replace('#message',SAMEUSER);
	}
  } else  $hdr->replace('#message',$input_error);
}


$opts=$sec->fetchAllowedISP();
$tpl->dropDown('#isporg',$opts,$p_isporg,true);

$opts=array('administrator','operator');
$tpl->dropDown('#acctype',$opts,trim($p_acctype),false);

$ffill=array(	'#username' => $p_username,
		'#password' => $p_pass,
		'#fullname' => $p_fullname,
		'#email' => $p_email,
		'#phone' => $p_phone,
		'#mobile' => $p_mobile);
$tpl->replace(null,$ffill);

$listisp = $s_id_isporg;
$exec=$base->execute('list_sysuser',array($listisp));

$rows=$base->fetchAll();

$tpl->loop(1,$rows);

$hdr->render();
$tpl->render();
$ftr->render();

?>
