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

$acctype=array('','prepaid','postpaid','subscriber');
$mu=array('kb','min','card');
$timeunit=array(1 => 'minutes',60 => 'hours',1440 => 'days');
$trafunit=array(1 => 'kB',1024 => 'MB',1048576 => 'GB');

if($p_isporg==0) $p_isporg=$s_id_isporg;
if($p_loop==0) $p_idletimeout = 600;

if($p_loop==1)
{
  $input_error=$sec->checkRequiredFields(array('def name'=>$p_defname,'acc type'=>$p_acctype,'isp org'=>$p_isporg));

  if(strlen($input_error) == 0)
  {
    $roll=0;
    $base->begin();

    $param=array( $p_defname,$p_acctype,$p_isporg,$p_unit,$p_bunit,$p_bprice,$p_oprice);
    $roll += $base->execute('add_def',$param);
    $groupname = $base->lastInsertId('acc_usagedefinition_id_seq'); 
     
    if($p_simuse > 0)
    {
      $roll+=$base->execute('add_radcheck',array("$groupname",$base->getGlobal('rad_simuse'),':=',"$p_simuse"));
      if((int)$roll!=0) break;
    }
    if($p_timelimit > 0)
    {
      $r_timelimit=$p_timelimit*$p_timeunit * 60;
      $roll+=$base->execute('add_radcheck',array("$groupname",$base->getGlobal('rad_timelimit'),':=',"$r_timelimit"));
      $roll+=$base->execute('add_radreply',array("$groupname",$base->getGlobal('rad_sesslimit'),':=',"$r_timelimit"));
      if((int)$roll!=0) break;
    }
    if($p_firstvalid > 0) 
    {
      $r_firstvalid = $p_firstvalid * 86400;
      $roll+=$base->execute('add_radcheck',array("$groupname",$base->getGlobal('rad_firstvalid'),':=',"$r_firstvalid"));
      if((int)$roll!=0) break;
    }
//    if($p_createvalid > 0)
//    {
//      $r_createvalid = date('Y-m-d', mktime(0,0,0,date("m"),date("d")+$p_createvalid,date("Y"))) . 'T00:00:00';
//     $roll+=$base->execute('add_radreply',array("$groupname",$base->getGlobal('rad_createvalid'),':=',"$r_createvalid"));
//      if((int)$roll!=0) break;
//    }
    if($p_traflimit > 0)
    {
      $r_traflimit=$p_traflimit*$p_trafunit * 1024;
      $roll+=$base->execute('add_radreply',array("$groupname",$base->getGlobal('rad_traflimit'),'=',"$r_traflimit"));
      if((int)$roll!=0) break;
    }
    if($p_download > 0)
    {
      $r_download=$p_download * 1024;
      $roll+=$base->execute('add_radreply',array("$groupname",$base->getGlobal('rad_download'),'=',"$r_download"));
      if((int)$roll!=0) break;
    }
    if($p_upload > 0)
    {
      $r_upload=$p_upload * 1024;
      $roll+=$base->execute('add_radreply',array("$groupname",$base->getGlobal('rad_upload'),'=',"$r_upload"));
      if((int)$roll!=0) break;
    }

    if(strlen($p_homepage) > 0)
    {
      $roll+=$base->execute('add_radreply',array("$groupname",$base->getGlobal('rad_homepage'),':=',"$p_homepage"));
      if((int)$roll!=0) break;
    }
    if($p_idletimeout > 0)
    {
      $roll+=$base->execute('add_radreply',array("$groupname",$base->getGlobal('rad_idletimeout'),':=',"$p_idletimeout"));
      if((int)$roll!=0) break;
    }

    $roll+=$base->execute('add_radreply',array("$groupname",$base->getGlobal('rad_updateinterval'),':=',$base->getGlobal('updateinterval')));
    
    if((int)$roll==0)
    {
    	$base->commit();
	$sec->systemLog(OK);
	$hdr->replace('#message',OK);
    } else {
	$base->rollBack();
	$sec->systemLog(FAIL);
	$hdr->replace('#message',FAIL);
    }
  }
  else {
      $sec->systemLog($input_error);
      $hdr->replace('#message',$input_error);
  }
} 
elseif($p_loop==2)
{
  if(trim($p_acctype)=='prepaid')
  {
    $mu=array('card');
    $p_bunit='1';
    $bunit_ro='readonly';
    $p_oprice='0';
    $oprice_ro='readonly';
  }
  elseif(trim($p_acctype)=='postpaid')
    $mu=array('kb','min');
  elseif(trim($p_acctype)=='subscriber')
    $mu=array('kb','min');
}

$opts=$sec->fetchAllowedISP();
$tpl->dropDown('#isporg',$opts,$p_isporg,true);

$tpl->dropDown('#acctype',$acctype,$p_acctype,false);
$tpl->dropDown('#timeunit',$timeunit,$p_timeunit,true);
$tpl->dropDown('#trafunit',$trafunit,$p_trafunit,true);

$ffill=array(	'#defname' => "$p_defname",
		'#timelimit' => "$p_timelimit",
		'#traflimit' => "$p_traflimit",
		'#download' => "$p_download",
		'#upload' => "$p_upload",
		'#firstvalid' => "$p_firstvalid",
		'#createvalid' => "$p_createvalid",
		'#homepage' => "$p_homepage",
		'#simuse' => "$p_simuse",
		'#idletimeout' => "$p_idletimeout",
		'#bunit' => "$p_bunit",
		'#bprice' => "$p_bprice",
		'#oprice' => "$p_oprice",
		'#robunit' => "$bunit_ro",
		'#rooprice' => "$oprice_ro");
$tpl->replace(null,$ffill);

$tpl->dropDown('#unit',$mu,$p_unit,false);

$hdr->render();
$tpl->render();
$ftr->render();

?>


