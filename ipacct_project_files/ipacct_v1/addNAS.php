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

if($p_loop==0) $p_isporg=$s_id_isporg;

$base->execute('sel_ispsuborg',array($p_isporg));
$rows=$base->fetchAll();
$arr_suborg=array();
foreach($rows as $record)
{
	$id=$record['id'];
	$name=$record['suborgname'];
	$arr_suborg[$id]=$name;
}
$tpl->dropDown('#ispsuborg',$arr_suborg,$p_ispsuborg,true);

$arr_radloc=array();
if($s_id_user==1)
  $arr_radloc[]='universe';
$base->execute('sel_radloc_isp',array($p_isporg));
$row=$base->fetch();
$arr_radloc[]=$row['radlocation'];
$base->execute('sel_radloc_sub',array($p_isporg));
$rows=$base->fetchAll();
foreach($rows as $record)
	$arr_radloc[]=$record['radlocation'];

$tpl->dropDown('#radlocation',$arr_radloc,$p_radlocation,false);

if($g_action=="del")
{
  $param=array($g_id);
  $exec=$base->execute('del_nas',$param);
  if((int)$exec==0) 
  {
    $sec->systemLog(OK_DEL);
    $hdr->replace('#message',OK_DEL);
  }
}
elseif($p_loop==1)
{

  if(ip2long($p_nasipdns))
      $real_nasip=$p_nasipdns;
  elseif(checkdnsrr($p_nasipdns,'A'))
      $real_nasip=gethostbyname($p_nasipdns);
  else
      $skip='true';


  if(!$skip)
  {
    $param=array($p_nasipdns,$p_shortname,$p_radsecret,$p_isporg,$p_ispsuborg,$p_nasvendor,
		 $p_connuser,$p_connpass,$p_adminuser,$p_adminpass,$p_desc,$real_nasip,
		 $p_macaddress,$p_ssid,$p_radlocation,$p_adminport);
    $exec=$base->execute('add_nas',$param);
    if((int)$exec==0)
    {
      $sec->systemLog(OK_ADD);
      $hdr->replace('#message',OK_ADD);
    }
  } else
     $hdr->replace('#message',ERR_INPUT);
}


$opts=$sec->fetchAllowedISP();
$tpl->dropDown('#isporg',$opts,$p_isporg,true);

$nasvendor=array('chillispot','cisco','other');
$tpl->dropDown('#nasvendor',$nasvendor,$p_nasvendor,false);

$ffill=array(	'#nasipdns' => $p_nasipdns,
		'#shortname' => $p_shortname,
		'#radsecret' => $p_radsecret,
		'#connuser' => $p_connuser,
		'#connpass' => $p_connpass,
		'#adminuser' => $p_adminuser,
		'#adminpass' => $p_adminpass,
		'#macaddress' => $p_macaddress,
		'#adminport' => $p_adminport,
		'#ssid' => $p_ssid,
		'#desc' => $p_desc);
$tpl->replace(null,$ffill);

$exec=$base->execute('list_nas',NULL);
$rows=$base->fetchAll();

$tpl->loop(5,$rows);

$hdr->render();
$tpl->render();
$ftr->render();

?>
