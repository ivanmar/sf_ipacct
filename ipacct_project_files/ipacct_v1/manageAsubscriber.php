<?php

require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('administrator')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();
$base = new cBase('manageAccSeries');
$hdr = new cReplace('header');
$tpl = new cReplace;
$ftr = new cReplace('footer');

$session=$sec->getSession('user_info');
include_once('include/common_var');
$mess = new cMessage($s_lang);

if(isset($g_serid) && $g_serid>0)
{
  $serid=$g_serid;

  $tpl->replace('#serid',$serid);

$param=array($base->getGlobal('rad_timelimit'),$base->getGlobal('rad_simuse'),$base->getGlobal('rad_firstvalid'),
             $base->getGlobal('rad_traflimit'),$base->getGlobal('rad_download'),$base->getGlobal('rad_createvalid'),$serid);
$exec=$base->execute('get_definfo',$param);
if((int)$exec==0)
{
  $rows=$base->fetch();
  $rows['showcrdate']=date("d/m/Y", strtotime($rows['crdate']));
  $rows['limittime']=$sec->time2str($rows['limittime']);
  $rows['limittraffic']=$sec->bytes2str($rows['limittraffic']);
  $rows['limitdownloadrate']=$sec->bytes2str($rows['limitdownloadrate']);
  $ffill=array( '#acctype' => $rows['acctype'],
                '#orgname' => $rows['orgname'],
                '#limittime' => $rows['limittime'],
                '#limittraffic' => $rows['limittraffic'],
                '#limitdownloadrate' => $rows['limitdownloadrate'],
                '#showcrdate' => $rows['showcrdate'],
                '#definitionname' => $rows['definitionname'] );
    $tpl->replace(null,$ffill);
    $acctype=trim($rows['acctype']);
    $id_isporg=trim($rows['id_isporg']);
    $id_def=trim($rows['id_usagedefinition']);
  }
  $exec=$base->execute('sel_subs_acc_info',array($serid));

  $top_link='manageSeries.php?action=list&acctype='.$rows['acctype'].'&isporg='.$id_isporg;
  $hdr->replace('#topnav',$top_link);

  if((int)$exec==0)
  {
    $rows=$base->fetchAll();
    foreach($rows as $id => $record)
    {
      if($record['lastlogin'])
        $rows[$id]['lastlogin']=date("H:i:s d/m", strtotime($record['lastlogin']));
      else
        $rows[$id]['lastlogin']='never';

      $rows[$id]['sessiontime']=$sec->time2str($record['sessiontime']);
      $rows[$id]['traffic']=$sec->bytes2str($rows[$id]['traffic']);
	  
      if($record['logsessions']) 
      {
        $rows[$id]['status']='used';
      } else {
        $rows[$id]['status']='unused';
      }
    }
    $tpl->loop(2,$rows);
  }
}

$hdr->render();
$tpl->render();
$ftr->render();

?>
