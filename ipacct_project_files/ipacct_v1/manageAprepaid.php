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
  if($g_action=='storn')
  {
    $exec=$base->execute('check_prepacc_storn',array($g_username));
    $row=$base->fetch();
    if($row['datereturn'])
        $hdr->replace('#message',ACC_RET);
    else {
       $exec=$base->execute('check_preplog',array($g_username));
       $check=count($base->fetchAll());
       $exec=$base->execute('check_radacct',array($g_username));
       $check+=count($base->fetchAll());
       if($check > 0) 
          $hdr->replace('#message',ACCUSED);
       $base->begin();
       $roll=$base->execute('del_acc_radcheck',array($g_username));
       if((int)$roll==0) $roll=$base->execute('del_acc_radreply',array($g_username));
       if((int)$roll==0) $roll=$base->execute('del_acc_radacct',array($g_username));
       if((int)$roll==0) $roll=$base->execute('upd_prepacc_storn',array($g_username));
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
  }
  elseif($g_action=='sold')
  {
    $exec=$base->execute('check_prepacc_storn',array($g_username));
    $row=$base->fetch();
    if($row['datestorn'])
        $hdr->replace('#message',ACC_RET);
    else {
      $exec=$base->execute('upd_prepacc_sold',array($g_username));
      if((int)$exec==0)
      {
        $sec->systemLog(OK);
        $hdr->replace('#message',OK);
      } else {
        $sec->systemLog(FAIL);
        $hdr->replace('#message',FAIL);
      }
    }
  }
}
 
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
  $id_isporg=$rows['id_isporg'];

  $top_link='manageSeries.php?action=list&acctype='.$rows['acctype'].'&isporg='.$id_isporg;
  $hdr->replace('#topnav',$top_link);
}

$tpl->duplicate(1,1);
$dopts[$rows['id_usagedefinition']]=$rows['definitionname'];  //no change
$win1="window.open('printCardSeries.php?serid=$serid',null,'width=800,menubar=yes,scrollbars=yes')";
$tpl->replace('#click1',$win1);

$exec=$base->execute('sel_prep_acc_info',array($serid,$serid));

if((int)$exec==0)
{
  $rows=$base->fetchAll();
  foreach($rows as $id => $record)
  {
    $rows[$id]['status'] = 'FREE';

    if($record['lastlogin']) $rows[$id]['lastlogin']=date("H:i:s d/m", strtotime($record['lastlogin']));

    if($record['datesale']) {
       $rows[$id]['datesale']=date("H:i:s d/m", strtotime($record['datesale']));
       $rows[$id]['status'] = 'SOLD';
    }
    if($record['datestorn']) {
       $rows[$id]['datestorn']=date("H:i:s d/m", strtotime($record['datestorn']));
       $rows[$id]['status'] = 'STORN';
    }

    if($record['ind_used']) {
        $rows[$id]['status'] = 'USED/DEL';
    }

    $rows[$id]['sessiontime']=$sec->time2str($record['sessiontime']);
    $rows[$id]['traffic']=$sec->bytes2str($rows[$id]['traffic']);
  }
}

$dopts=$sec->fetchAllowedDefs($acctype,$id_isporg);

if(isset($p_definition) && $p_definition>0)
     $tpl->dropDown('#definition',$dopts,$p_definition,true);
else
     $tpl->dropDown('#definition',$dopts,$rows['id_usagedefinition'],true);

$tpl->loop(2,$rows);

$hdr->render();
$tpl->render();
$ftr->render();

?>
