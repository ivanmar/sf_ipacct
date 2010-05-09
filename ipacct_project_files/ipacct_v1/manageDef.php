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

if($g_isporg>0) $p_isporg=$g_isporg;
elseif($p_loop==0) $p_isporg=$s_id_isporg;

$opts=$sec->fetchAllowedISP();
$tpl->dropDown('#isporg',$opts,$p_isporg,true);

if($g_action=="del" && $g_id>0)
{
  $param=array($g_id);

  $exec=$base->execute('chk_serid',$param);
  $numrows=count($base->fetchAll());
  $exec=$base->execute('chk_postplog',$param);
  $numrows+=count($base->fetchAll());
  if($numrows == 0) {
      $roll=0;
      $base->begin();
      $roll+=$base->execute('del_definition',$param);
      $roll+=$base->execute('del_radusergroup',$param);
      $roll+=$base->execute('del_radgroupreply',$param);
      $roll+=$base->execute('del_radgroupcheck',$param);

    if((int)$roll==0)
      $base->commit();
    else
      $base->rollBack();

  } else {
      $sec->systemLog(ACCSERIES);
      $hdr->replace('#message',ACCSERIES);
   }
}

$param=array($base->getGlobal('rad_timelimit'),$base->getGlobal('rad_simuse'),$base->getGlobal('rad_firstvalid'),
$base->getGlobal('rad_traflimit'),$base->getGlobal('rad_download'),$base->getGlobal('rad_createvalid'),$p_isporg);
$exec=$base->execute('sel_deflist',$param);
$rows=$base->fetchAll();

foreach($rows as $id => $record)
{
  if($record['limittime'])
    $rows[$id]['showtimelimit']=$sec->time2str($record['limittime']);
  else
    $rows[$id]['showtimelimit']='unlimited';
    
  if($record['limittraffic'])
      $rows[$id]['showtrafficlimit']=$sec->bytes2str($record['limittraffic']);
  else
      $rows[$id]['showtrafficlimit']='unlimited';

  if($record['limitdownloadrate'])
    	$rows[$id]['showbwlimit']=$sec->bytes2str($record['limitdownloadrate']);
  else
	$rows[$id]['showbwlimit']='unlimited';

  if($record['limitusageperiod'])
	$rows[$id]['showusageperiod']=round($record['limitusageperiod']/60/60/24) . ' days';
  else
	$rows[$id]['showusageperiod']='unlimited';
}

$tpl->loop(1,$rows);

$hdr->render();
$tpl->render();
$ftr->render();

?>
