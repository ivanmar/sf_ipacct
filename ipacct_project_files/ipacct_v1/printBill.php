<?php

require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('operator')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();

$base = new cBase;
$tpl = new cReplace;

if(strlen($g_s_bill)>0)
{
  $param=array($g_s_bill,$g_s_bill);
  $roll=$base->execute('sel_s_bill',$param);
  $rows=$base->fetchAll();
  $p_isporg=$rows[0]['id_isporg'];
  $p_ispsuborg=$rows[0]['id_ispsuborg'];

  $sumtotalprice=0;
  foreach($rows as $id => $record)
  {
    $rows[$id]['srvstarttime']=date("H:i:s d/m", strtotime($record['srvstarttime']));
    $rows[$id]['srvstoptime']=date("H:i:s d/m", strtotime($record['srvstoptime']));
    $rows[$id]['price']=($record['buspent']*$record['pricebillingunit'])+$record['priceonstart'];
    $sumtotalprice+=$rows[$id]['price'];
    $rows[$id]['price']=number_format($rows[$id]['price'],2,".","");
    if(strlen(trim($record['buspent']))==0)
       $rows[$id]['buspent']='0';
  }
  $sumtotalprice=number_format($sumtotalprice,2,".","");
  $postpinfo=implode("<br>",$sec->fetchSubOrgInfo($p_isporg,$p_ispsuborg));

  $tpl->replace('#id',"$p_isporg");
  $tpl->replace('#postpinfo',$postpinfo);
  $tpl->replace('#sumtotalprice',"$sumtotalprice");
  $tpl->replace('#acctnum',$g_s_bill);
}
$tpl->loop(1,$rows);
$tpl->render();

?>
