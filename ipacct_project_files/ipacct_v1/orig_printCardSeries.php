<?php

error_reporting(E_ALL);
require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('administrator')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();

$base = new cBase('manageAccSeries');
$mess = new cMessage('en');

$param=array($base->getGlobal('rad_timelimit'),$base->getGlobal('rad_simuse'),$base->getGlobal('rad_firstvalid'),
             $base->getGlobal('rad_traflimit'),$base->getGlobal('rad_download'),$base->getGlobal('rad_createvalid'),$g_serid);
$exec=$base->execute('get_definfo',$param);
$rows=$base->fetch();

$id_isporg=$rows['id_isporg'];

$topts=array();
$topts['#BW']=$sec->bytes2str($rows['limitdownloadrate']);
$topts['#Traffic_limit']=trim($sec->bytes2str($rows['limittraffic']));
$topts['#Time_limit']=trim($sec->time2str($rows['limittime']));
$topts['#Expire_date']=date("d/m/Y",strtotime($rows['crdate'])+$rows['limitdaysofvalidity']);
$topts['#Card_price']=number_format($rows['pricebillingunit'],2,",","");

$exec=$base->execute('get_userpass',array($g_serid));
$rows=$base->fetchAll();

$crd = new cReplace("isp/$id_isporg/printSingleCard");
$tbl = new cReplace("printCardGrid");

$tbl->duplicate(1,ceil(count($rows)/5));

foreach($rows as $record)
{
//  $crd->replace(null,$topts);

  $crd->replace('#username',$record['username']);
  $crd->replace('#password',$record['password']);
  $crd->replace('#s_card',$record['s_card']);
  $tbl->replaceFirst('#card',$crd->contents());
  $crd->reset();
}
$tbl->replace('#card',null);
$tbl->replace('#id',"$id_isporg");

$tbl->render(false);

?>
