<?php

require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('operator')!=LOGIN_PASSED)
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

if($p_loop==0 && $g_id==0) {
  $p_startdate=date("Y-m-d");	//default
  $p_enddate=date("Y-m-d");
}

if(isset($g_id) && $g_action=='del')
{
  $username=$_SESSION['search'][0];
  $stamp1=$_SESSION['search'][3];
  $stamp2=$_SESSION['search'][4];
  $tmp_start = split(" ",$stamp1);
  $tmp_end = split(" ",$stamp2);
  $p_startdate = $tmp_start[0];
  $p_enddate = $tmp_end[0];

  $exec=$base->execute('del_record',array($g_id));
  if((int)$exec==0)
  {
    $base->execute('sel_conn',$_SESSION['search']);
    $rows=$base->fetchAll();
    $sec->systemLog(OK);
    $hdr->replace('#message',OK);
  } else {
    $sec->systemLog(FAIL);
    $hdr->replace('#message',FAIL);
  }
}
if($p_loop==1)
{
  if(strlen($p_username) < 3)
  {
    $sec->systemLog(ERRSTR);
    $hdr->replace('#message',ERRSTR);
  }
  else
  {
    $username=$p_username.'%';
    $termcause=$p_termcause.'%';
    $stamp1=$p_startdate.' 00:00:00';
    $stamp2=$p_enddate.' 23:59:59';

    $_SESSION['search']=array($username,$p_isporg,$termcause,$stamp1,$stamp2,$username,$p_isporg,$termcause,$stamp1,$stamp2);
    $exec=$base->execute('sel_conn',$_SESSION['search']);
    $rows=$base->fetchAll();
  }
}

if($s_id_user!=1)
  $tpl->replaceTag('connLogs',null,2);

if(count($rows)>0)
{
  $totaltime = 0;
  $totaltraffic = 0;
  foreach($rows as $id => $record)
    {
      $rows[$id]['acctstarttime']=date("H:i:s d/m",strtotime($record['acctstarttime']));
      $rows[$id]['acctsessiontime']=$sec->time2str($record['acctsessiontime']);
      $rows[$id]['traffic']=$sec->bytes2str($record['traffic']);
      $totaltime+=$record['acctsessiontime'];
      $totaltraffic+=$record['traffic'];
    }
    $hdr->replace('#message',OK);
}
$tpl->loop(1,$rows);

$totaltime=$sec->time2str($totaltime);
$totaltraffic=$sec->bytes2str($totaltraffic);
$tpl->replace('#totaltime',"$totaltime");
$tpl->replace('#totaltraffic',"$totaltraffic");
$tpl->replace('#username',$p_username);

$tpl->replace('#startdate',$p_startdate);
$tpl->replace('#enddate',$p_enddate);

$opts=$sec->fetchAllowedISP();
$tpl->dropDown('#isporg',$opts,$p_isporg,true);

$opts=array( '' => 'no filter',
             'Session-Timeout' => 'session timeout',
             'User-Request' => 'user request',
	          'Login-Incorrect' => 'login incorrect',
	          'Invalid-User' => 'invalid user',
             'Multiple-Logins' => 'simuse error',
	          'NAS-Reboot' => 'nas reboot',
	           'Lost-Carrier' => 'lost carrier');
$tpl->dropDown('#termcause',$opts,$p_termcause,true);


$hdr->render();
$tpl->render();
$ftr->render();

?>
