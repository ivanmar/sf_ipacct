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

if($g_action=='del')
{
  $param=array($g_id);
  $exec=$base->execute('check_ispsuborg',$param);
  $rows=$base->fetchAll();
  if(count($rows)==0) {
    $exec=$base->execute('check_ispsuborg_user',$param);
    $rows=$base->fetchAll();
    if(count($rows)==0) {
      $exec=$base->execute('del_ispsuborg',$param);
      $sec->systemLog(OK);
      $hdr->replace('#message',OK);
    }
    else {
      $sec->systemLog(SUBORG_USER);
      $hdr->replace('#message',SUBORG_USER);
    }
  }
  else {
    $sec->systemLog(SUBORGUSED);
    $hdr->replace('#message',SUBORGUSED);
  }
}
elseif($p_loop==1)
{
	$str_to_replace = array(" ", ".", ",");
	$str_safe       = array("_", "_", "_");
	$p_radlocation = strtoupper(str_replace($str_to_replace, $str_safe, $p_suborgname));

	$param=array(	$p_suborgname,$p_isporg,$p_address,
			$p_city,$p_zip,$p_phone,$p_email,$p_contactname,$p_radlocation);
	$exec=$base->execute('add_ispsuborg',$param);
	if((int)$exec==0)
	{
	  $sec->systemLog(OK);
	  $hdr->replace('#message',OK);
	} else {
	  $sec->systemLog(FAIL);
	  $hdr->replace('#message',FAIL);
	}
}

$opts=$sec->fetchAllowedISP();
$tpl->dropDown('#isporg',$opts,$p_isporg,true);

$ffill=array(	'#suborgname' => $p_suborgname,
		'#address' => $p_address,
		'#city' => $p_city,
		'#phone' => $p_phone,
		'#zip' => $p_zip,
		'#contactname' => $p_contactname,
		'#email' => $p_email);
$tpl->replace(null,$ffill);


$listisp = $s_id_isporg;
$exec=$base->execute('list_ispsuborg',array($listisp));
$rows=$base->fetchAll();
$tpl->loop(1,$rows);

$hdr->render();
$tpl->render();
$ftr->render();

?>
