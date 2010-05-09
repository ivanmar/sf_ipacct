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
$mess = new cMessage($s_lang,0,$tpl);

$tpl->replace('#param',"isporg=$s_id_isporg");

if(($p_loop==0)||(strlen(trim($p_username))==0))
  $tpl->duplicate(1,0);
else 
{
   if($s_usertype=='administrator' && ereg("-",$p_username))
   {
     $c_username=$p_username;
     $tmp_postp=explode('-',$p_username);
     $s_id_ispsuborg=$tmp_postp[1];
   }
   else 
     $c_username=$s_id_isporg.'-'.$s_id_ispsuborg.'-'.$p_username;
}
if($p_loop==1 && strlen($p_username)>0)  //check
{
  $param=array($s_id_isporg,$s_id_ispsuborg,$c_username);
  $exec=$base->execute('sel_check',$param);
  $rows=$base->fetch();
  if($base->rowCount() == 1)
  {
    if($rows['ind_active'])
    {
      $tpl->duplicate(1,1);
      $tpl->replace('#action','deactivate');
      $tpl->replace('#numaction','3');
    } else {
      $tpl->duplicate(1,1);
      $tpl->replace('#action','activate');
      $tpl->replace('#numaction','2');
    }
    $tpl->replace('#username',$p_username);
  }
  else
  {
    $tpl->duplicate(1,0);
    $hdr->replace('#message',NOUSER);
  }
}
elseif($p_loop==2 && strlen($p_username)>0)  //activate
{
  $tpl->duplicate(1,0);
  $param=array($s_id_isporg,$s_id_ispsuborg,$c_username);
  $exec=$base->execute('sel_check',$param);
  $rows=$base->fetch();
  $id_postpaccount=$rows['id'];
  $id_accseries=$rows['id_accseries'];
  $id_definition=$rows['id_usagedefinition'];

  $roll=0;
  $base->begin();
  $param=array(	$id_postpaccount,$s_id_user,$id_definition);
  $roll=$base->execute('ins_postplog',$param);

  if((int)$roll==0)
    $roll=$base->execute('upd_activation',array(1,$c_username));

  if((int)$roll==0)
  {
    $base->commit();
    $sec->systemLog(ACTIVE);
    $hdr->replace('#message',ACTIVE);
  } else {
    $base->rollBack();
    $sec->systemLog(FAILACTIVE);
    $hdr->replace('#message',FAILACTIVE);
  }
  
  $win="window.open('printUser.php?user=$c_username',null,'width=500')";
  $hdr->replace('//blank',"ping(5);".$win);
}
elseif($p_loop==3 && strlen($p_username)>0) //deactivate
{
  $tpl->duplicate(1,0);
  $param=array($s_id_isporg,$s_id_ispsuborg,$c_username);
  $exec=$base->execute('sel_check',$param);
  $rows=$base->fetch();
  $id_postpaccount=$rows['id'];
  $id_accseries=$rows['id_accseries'];
  $s_bill=date("ymdHi")."-$c_username";
  
  $roll=0;
  $base->begin();
  $param=array(  $s_id_user,$s_bill,$c_username,
                 $c_username,$id_postpaccount);
  $roll=$base->execute('upd_postplog',$param);
  
  if((int)$roll==0)
    $roll=$base->execute('upd_activation',array(0,$c_username));

  if((int)$roll==0)
  {
    $pass = mt_rand(1000000, 9999999);
    $param=array($pass,$c_username,$id_accseries);
    $roll=$base->execute('upd_pass',$param);
  }
  if((int)$roll==0)
  {
    $base->commit();
    $sec->systemLog(DEACTIVE);
    $hdr->replace('#message',DEACTIVE);
  } else {
    $base->rollBack();
    $sec->systemLog(FAILDEACTIVE);
    $hdr->replace('#message',FAILDEACTIVE);
  }
  
  $param=array(0,$c_username);
  $roll=$base->execute('upd_activation',$param);
  
  $win="window.open('printBill.php?s_bill=$s_bill',null,'width=800')";
  $hdr->replace('//blank',"ping(5);".$win);
}

$listsuborg=$s_id_ispsuborg;
$exec=$base->execute('sel_billdata',array($s_id_isporg,$listsuborg,$s_id_isporg,$listsuborg));

if((int)$exec==0)
{
  $sumtotalprice = 0;
  $rows=$base->fetchAll();
  foreach($rows as $id => $record)
  {
    if($s_usertype=='administrator')
      $rows[$id]['showusername']=$record['username'];
    else
    {
      $tmp_user=explode('-',$record['username']);
      $rows[$id]['showusername']=$tmp_user[2];
    }
    if(strlen(trim($record['buspent']))==0)
      $rows[$id]['buspent']='0';

    $rows[$id]['totalprice']=($record['buspent']*$record['pricebillingunit'])+$record['priceonstart'];
    $sumtotalprice+=$rows[$id]['totalprice'];
    $rows[$id]['totalprice']=number_format($rows[$id]['totalprice'],2,".","");
  }
}

$tpl->loop(2,$rows);
$sumtotalprice=number_format($sumtotalprice,2,".","");
$tpl->replace('#sumtotalprice',"$sumtotalprice");

$tpl->replace('#orgname',$s_orgname);

$hdr->replace('//blank','ping(5)');

$hdr->render();
$tpl->render();
$ftr->render();

?>
