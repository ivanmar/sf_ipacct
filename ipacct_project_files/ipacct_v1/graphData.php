<?php

//error_reporting(E_ALL);

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

$timestep=array( '#year' => null,
                 '#month' => null,
                 '#day' => null,
                 '#hour' => null);

if($p_loop==0)
{
  $p_isporg=$s_id_isporg;
  $p_startdate=date("Y-m-d");
  $p_enddate=date("Y-m-d");
  $timestep['#month']=' checked';
} else
  $timestep['#'.$p_timestep]=' checked';

if($p_loop==1)
{
  $start=split("-",$p_startdate);
  $end=split("-",$p_enddate);
  $startdate=$start[2].".".$start[1].".".$start[0];
  $enddate=$end[2].".".$end[1].".".$end[0];

  $stamp1=$p_startdate.' 00:00:00';
  $stamp2=$p_enddate.' 23:59:59';

  $winbar='graphShow.php?'.'trafftype='.$p_trafftype.'&type=bar'.'&isporg='.$p_isporg.
			'&timestep='.$p_timestep.
			'&startdate='.$stamp1.'&stopdate='.$stamp2;
  $winpie='graphShow.php?'.'trafftype='.$p_trafftype.'&type=pie'.'&isporg='.$p_isporg.
			'&timestep='.$p_timestep.
			'&startdate='.$stamp1.'&stopdate='.$stamp2;

  require_once ('include/graph/graph_chart_object.php');

  $piechart = open_flash_chart_object( 200, 200, 'http://'. $_SERVER['SERVER_NAME'] .'/'.$winpie );
  $barchart = open_flash_chart_object( '98%', 350, 'http://'. $_SERVER['SERVER_NAME'] .'/'.$winbar );

  $tpl->replace('#piechart',$piechart);
  $tpl->replace('#barchart',$barchart);
}

$tpl->replace('#startdate',$p_startdate);
$tpl->replace('#enddate',$p_enddate);
$tpl->replace(null,$timestep);

$opts=$sec->fetchAllowedISP();
$tpl->dropDown('#isporg',$opts,$p_isporg,true);


$trafftype=array( 'sel_prep_log' => 'prepaid by log',
                  'sel_prep_sale' => 'prepaid by sale',
                  'sel_postp_tr' => 'postpaid by traffic',
                  'sel_postp_tm' => 'postpaid by time');
$tpl->dropDown('#trafftype',$trafftype,$p_trafftype,true);

$hdr->render();
$tpl->render();
$ftr->render();

?>
