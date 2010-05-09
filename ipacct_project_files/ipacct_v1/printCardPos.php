<?php

require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('administrator')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();

$base = new cBase;

if(strlen($g_s_card)>0)
{
  $exec=$base->execute('get_cardinfo',array($g_s_card));
  $rows=$base->fetch();
  $id_isporg=$rows['id_isporg'];

  $topts=array();
  $topts['#Traffic_limit']=trim($sec->bytes2str($rows['limittraffic']*1024));
  $topts['#Time_limit']=trim($sec->time2str($rows['limittime']*60));
  $topts['#Card_price']=number_format($rows['pricebillingunit'],2,",","");

  $tpl = new cReplace("isp/$id_isporg/posCard");

  $tpl->replace('#orgname',$rows['orgname']);
  $tpl->replace('#suborgname',$rows['suborgname']);
  $tpl->replace('#Ser_id',"$rows[id_accseries]");
  $tpl->replace('#username',$rows['username']);
  $tpl->replace('#password',$rows['password']);

  $tpl->replace(null,$topts);
}

$tpl->render();
?>
