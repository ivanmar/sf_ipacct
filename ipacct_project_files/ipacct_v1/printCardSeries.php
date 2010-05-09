<?php

require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('administrator')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();

$base = new cBase('manageAccSeries');
$mess = new cMessage('en');
$tpl = new cReplace;

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

$tpl->duplicate(1,ceil(count($rows)/2));

$tpl->loop(2,$rows);

$tpl->render();

?>
