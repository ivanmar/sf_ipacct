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


if($p_loop==0) {
  $p_isporg=$s_id_isporg;
  $p_startdate=date("Y-m-d");	//default
  $p_enddate=date("Y-m-d");
}

if($p_loop==1)
{
  $stamp1=$p_startdate.' 00:00:00';
  $stamp2=$p_enddate.' 23:59:59';

  if($p_billtype=='prepaidsale')
  {
    $acctype='prepaid';
    $param=array( $stamp1,$stamp2,$p_isporg);
    $exec=$base->execute('sel_prep_sale',$param);
  } 
  elseif($p_billtype=='prepaidlog')
  {
    $acctype='prepaid';
    $param=array( $stamp1,$stamp2,$p_isporg);
    $exec=$base->execute('sel_prep_log',$param);
  } 
  elseif($p_billtype=='postpaid')
  {
    $acctype='postpaid';
    $param=array( $stamp1,$stamp2,$p_isporg,$stamp1,$stamp2,$p_isporg);
    $exec=$base->execute('sel_postp',$param);
  }

  if((int)$exec==0)
    $hdr->replace('#message',OK);
  else
    $hdr->replace('#message',FAIL);

  if((int)$exec==0)
  {
    $sumtotalprice = 0;
    $rows=$base->fetchAll();
    foreach($rows as $id => $record)
    {
      $rows[$id]['acctype']=$acctype;
      if($p_billtype=='postpaid')
      {
        $rows[$id]['totalprice']=($record['buspent']*$record['pricebillingunit'])+ ($record['priceonstart']*$record['sessions']);
        if($record['buspent']==0)
          $rows[$id]['buspent']='0';
      }
      elseif($p_billtype=='prepaidsale' || $p_billtype=='prepaidlog')
     {
        $rows[$id]['priceonstart']='0';
	$rows[$id]['billingunit']='1';
        $rows[$id]['totalprice']=$record['buspent']*$record['pricebillingunit'];
      }
      $sumtotalprice+=$rows[$id]['totalprice'];
      $rows[$id]['totalprice']=number_format($rows[$id]['totalprice'],2,",",".");
    }
  }
} 

$tpl->loop(1,$rows);
$sumtotalprice=number_format($sumtotalprice,2,",",".");
$tpl->replace('#sumtotalprice',"$sumtotalprice");

$tpl->replace('#startdate',$p_startdate);
$tpl->replace('#enddate',$p_enddate);

$opts=$sec->fetchAllowedISP();
$tpl->dropDown('#isporg',$opts,$p_isporg,true);
$billtype=array('prepaidlog'=>'prepaid by logs','prepaidsale'=>'prepaid by sale','postpaid'=>'postpaid');
$tpl->dropDown('#billtype',$billtype,$p_billtype,true);

$hdr->render();
$tpl->render();
$ftr->render();

?>
