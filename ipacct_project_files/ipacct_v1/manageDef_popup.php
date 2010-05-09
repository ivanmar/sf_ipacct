<?php

require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('administrator')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();

$base = new cBase('addDef');
$mess = new cMessage('en');
$tpl = new cReplace;

$tpl->replace('#formaction',$_SERVER['PHP_SELF']);

if($g_id > 0)
{
  $p_defid=$g_id;

  $param=array($base->getGlobal('rad_timelimit'),$base->getGlobal('rad_simuse'),$base->getGlobal('rad_firstvalid'),
	     $base->getGlobal('rad_traflimit'),$base->getGlobal('rad_download'),$base->getGlobal('rad_createvalid'),
	     $base->getGlobal('rad_upload'),$base->getGlobal('rad_homepage'),$base->getGlobal('rad_idletimeout'), $p_defid);
  $exec=$base->execute('sel_definfo',$param);
  $row=$base->fetch();

  $p_defname = $row['definitionname'];
  $p_orgname = $row['orgname'];
  $p_acctype = $row['acctype'];
  $p_timelimit = $row['limittime'];
  $p_traflimit = $row['limittraffic'];
  $p_download = $row['limitdownloadrate'];
  $p_upload = $row['limituploadrate'];
  $p_firstvalid = $row['limitusageperiod'];
  $p_simuse = $row['simuse'];
  $p_homepage = $row['homepage'];
  $p_idletimeout = $row['idletimeout'];
}

if($p_loop == 1)
{
   $groupname = $p_defid;
   $roll=0;
   $base->begin();

   $roll += $base->execute('del_radgroupcheck',array($p_defid));
   $roll += $base->execute('del_radgroupreply',array($p_defid));


    if($p_simuse > 0)
    {
      $roll+=$base->execute('add_radcheck',array("$groupname",$base->getGlobal('rad_simuse'),':=',"$p_simuse"));
      if((int)$roll!=0) break;
    }
    if($p_timelimit > 0)
    {
      $roll+=$base->execute('add_radcheck',array("$groupname",$base->getGlobal('rad_timelimit'),':=',"$p_timelimit"));
      $roll+=$base->execute('add_radreply',array("$groupname",$base->getGlobal('rad_sesslimit'),':=',"$p_timelimit"));
      if((int)$roll!=0) break;
    }
    if($p_firstvalid > 0) 
    {
      $roll+=$base->execute('add_radcheck',array("$groupname",$base->getGlobal('rad_firstvalid'),':=',"$p_firstvalid"));
      if((int)$roll!=0) break;
    }
    if($p_traflimit > 0)
    {
      $roll+=$base->execute('add_radreply',array("$groupname",$base->getGlobal('rad_traflimit'),'=',"$p_traflimit"));
      if((int)$roll!=0) break;
    }
    if($p_download > 0)
    {
      $roll+=$base->execute('add_radreply',array("$groupname",$base->getGlobal('rad_download'),'=',"$p_download"));
      if((int)$roll!=0) break;
    }
    if($p_upload > 0)
    {
      $roll+=$base->execute('add_radreply',array("$groupname",$base->getGlobal('rad_upload'),'=',"$p_upload"));
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
      $tpl->replace('#message',OK);
      $onload="self.setTimeout('self.close()', 2000); window.opener.location.reload()";
      $tpl->replace('#onload',$onload);
   } else {
     $base->rollBack();
     $sec->systemLog(FAIL);
     $tpl->replace('#message',FAIL);
   }
}


$ffill=array(	'#defname' => $p_defname,
		'#orgname' => $p_orgname,
		'#acctype' => $p_acctype,
		'#timelimit' => "$p_timelimit",
		'#traflimit' => "$p_traflimit",
		'#download' => "$p_download",
		'#upload' => "$p_upload",
		'#firstvalid' => "$p_firstvalid",
		'#simuse' => "$p_simuse",
		'#homepage' => "$p_homepage",
		'#idletimeout' => "$p_idletimeout",
		'#defid' => "$p_defid");
$tpl->replace(null,$ffill);

$tpl->render();

?>
