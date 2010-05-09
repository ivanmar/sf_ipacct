<?php

require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('operator')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();

$base = new cBase;
$tpl = new cReplace;

$tpl->replace('#username',$g_user);

$param=array($g_user);
$exec=$base->execute('sel_series',$param);
$rows=$base->fetch();

$id_accseries=$rows['id_accseries'];
$id_isporg=$rows['id_isporg'];
$id_ispsuborg=$rows['id_ispsuborg'];

$param=array($g_user,$id_accseries);
$roll=$base->execute('sel_accinfo',$param);
if((int)$roll==0)
{
  $rows=$base->fetchAll();
  foreach($rows as $id => $record)
  {
    $cr_time=strtotime($record['crdate']);
    $rows[$id]['showcrdate']=date("d/m/Y", $cr_time);
    if($record['limitdaysofvalidity'] > 0) 
    {
      $exp_time=strtotime("+$record[limitdaysofvalidity] day",$cr_time);
      $rows[$id]['expiredate']=date("d/m/Y",$exp_time);
    }
    else $rows[$id]['expiredate']='unlimited';
	  
    $rows[$id]['limittime']=$sec->time2str($record['limittime']*60);
    $rows[$id]['limittraffic']=$sec->bytes2str($rows[$id]['limittraffic']*1024);
    $rows[$id]['limitdownloadrate']=$sec->bytes2str($rows[$id]['limitdownloadrate'] * 1024);
  }
}

$suborginfo=implode("<br>",$sec->fetchSubOrgInfo($id_isporg,$id_ispsuborg));
$tpl->replace('#id',"$id_isporg");
$tpl->replace('#suborginfo',$suborginfo);

$tpl->loop(1,$rows);

$tpl->render();

?>
