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

if(empty($p_acctype) && empty($g_acctype)) $p_acctype='prepaid';
elseif($g_acctype) $p_acctype=$g_acctype;

$acctype=array('prepaid','postpaid','subscriber');

$opts=$sec->fetchAllowedISP();
$tpl->dropDown('#isporg',$opts,$p_isporg,true);
$tpl->dropDown('#acctype',$acctype,$p_acctype,false);

if($g_action=='del' && $g_id>0)
{
  $check=0;
  $param=array($g_id);
  if($g_acctype=='postpaid') {
    $exec=$base->execute('check_postplog',$param);
    $check=count($base->fetchAll());
  } elseif($g_acctype=='prepaid') {
    $exec=$base->execute('check_preplog',$param);
    $check=count($base->fetchAll());
  }

  if($check == 0) 
  {
    $roll=0;
    $base->begin();
    if((int)$roll==0) $roll.=$base->execute('del_radreply',$param);
    if((int)$roll==0) $roll.=$base->execute('del_radacct',$param);
    if((int)$roll==0) $roll.=$base->execute('del_usergroup',$param);
    if((int)$roll==0) $roll.=$base->execute('del_radcheck',$param);	//must be at the end
    if((int)$roll==0 && $g_acctype=='postpaid') $roll.=$base->execute('del_postpaccount',$param);
    if((int)$roll==0 && $g_acctype=='prepaid')  $roll.=$base->execute('del_prepaccount',$param);
    if((int)$roll==0 && $g_acctype=='subscriber')  $roll.=$base->execute('del_subinfo',$param);
    if((int)$roll==0) $roll.=$base->execute('del_series',$param);

    if((int)$roll==0)
    {
      $base->commit();
      $sec->systemLog(OK);
    } else {
      $base->rollBack();
      $sec->systemLog(FAIL);
    }
  }
  else {
    $sec->systemLog(ACCUSED);
    $hdr->replace('#message',ACCUSED);
  }
}
elseif($g_action=='list')
{
  $p_isporg=$g_isporg;
  $p_acctype=$g_acctype;
}

$param=array($p_isporg,$p_acctype);
$exec=$base->execute('sel_series',$param);

$rows=$base->fetchAll();

foreach($rows as $id => $record)
{
  $rows[$id]['status']='valid';
  $rows[$id]['bgcolor']='green';
  $cr_time=strtotime($record['crdate']);
  $rows[$id]['showcrdate']=date("d/m/Y",$cr_time);

  if($record['limitdaysofvalidity'] > 0)
  {
    $exp_time=strtotime("+$record[limitdaysofvalidity] day",$cr_time);
    $rows[$id]['expiredate']=date("d/m/Y",$exp_time);
    if($exp_time < time())
    {
      $rows[$id]['status']='expired';
      $rows[$id]['bgcolor']='red';
    }
  }
  else {
    $rows[$id]['expiredate']='unlimited';
    $rows[$id]['bgcolor']='orange';
  }
  if($record['pricebillingunit'] > 0)
    $rows[$id]['billing']='yes';
  else
    $rows[$id]['billing']='no';
}

$tpl->loop(1,$rows);

$hdr->render();
$tpl->render();
$ftr->render();

?>
