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

if($p_loop==1 && $p_serid>0)  //add single
{
  $exec=$base->execute('sale_get_user',array($p_serid));
  $rows=$base->fetch();
  $username=trim($rows['username']);
  if(($base->rowCount())==1) {
    $exec=$base->execute('sale_upd_preplog',array($s_id_user,$username));
    if((int)$exec==0)
    {
      $sec->systemLog(OK_SOLD);
      $hdr->replace('#message',OK_SOLD);
    } else {
      $sec->systemLog(ERR_SOLD);
      $hdr->replace('#message',ERR_SOLD);
    }
  } else $hdr->replace('#message',ERR_INPUT);
}
elseif($p_loop==2 && strlen($p_scard)>0)  //storn
{
  $p_scard=trim($p_scard);
  $exec=$base->execute('check_card',array($s_id_isporg,$p_scard));
  $rows=$base->fetch();
  $username=trim($rows['username']);
  if(($base->rowCount())==1) {
    $base->begin();
    $roll=$base->execute('storn_del_radcheck',array($username));
    if((int)$roll==0) $roll=$base->execute('storn_del_radreply',array($username));
    if((int)$roll==0) $roll=$base->execute('storn_upd_preplog',array($username));
    if((int)$roll==0)
    {
      $base->commit();
      $sec->systemLog(OK_DEL);
      $hdr->replace('#message',OK_DEL);
    } else {
      $base->rollBack();
      $sec->systemLog(ERR_DEL);
      $hdr->replace('#message',ERR_DEL);
    }
  } else $hdr->replace('#message',ERR_INPUT);
}
$param=array($s_id_isporg,$s_id_ispsuborg);
$exec=$base->execute('sel_accounts',$param);
$rows=$base->fetchAll();
$tpl->loop(1,$rows);

$exec=$base->execute('saled_cards',$param);
$rows=$base->fetchAll();
foreach($rows as $id=>$record)
  $rows[$id]['showdatesale']=date("d/m/y H:i ",strtotime($record['datesale']));
$tpl->loop(2,$rows);


$hdr->render();
$tpl->render();
$ftr->render();

?>
