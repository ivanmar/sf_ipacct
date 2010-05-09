<?php

require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('administrator')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();

$base = new cBase;
$mess = new cMessage('en');
$tpl = new cReplace;

$tpl->replace('#formaction',$_SERVER['PHP_SELF']);

$session=$sec->getSession('user_info');
$s_id_user=$session['id'];
$s_id_isporg=$session['id_isporg'];
$s_usertype=trim($session['acctype']);

if($g_id > 0)
{
  $param=array($g_id);
  $exec=$base->execute('get_user_info',$param);
  $rows=$base->fetchAll();
  $numrows=count($rows);
  if($numrows==0)
  {
    $sec->systemLog(NOUSER);
    $tpl->replace('#message',NOUSER);
  } elseif($numrows==1)
  {
   $tpl->replace('#username',$rows[0]['username']);
   if($s_id_user!=1 && $g_id==1)
   {
     $sec->systemLog(NOCHANGESYSUSER);
     $tpl->replace('#message',NOCHANGESYSUSER);
   } elseif($s_id_user!=1 && $s_id_isporg != $rows[0]['id_isporg'])
   {
     $sec->systemLog(OTHERISP);
     $tpl->replace('#message',OTHERISP);
   } else
     $tpl->replace('#userid',"$g_id");
  }
}

if($p_loop > 0)
{
  if(trim($p_passnew) == trim($p_passnewre))
  {
    $c_password = md5(trim($p_passnew));
    $param=array($c_password,$p_loop);
    $exec=$base->execute('upd_pass',$param);
    if((int)$exec==0)
    {
      $sec->systemLog(UPD_OK);
      $tpl->replace('#message',UPD_OK);
      $onload="self.setTimeout('self.close()', 3000); window.opener.location.reload()";
      $tpl->replace('#onload',$onload);
    } else {
      $sec->systemLog(UPD_NO_OK);
      $tpl->replace('#message',UPD_NO_OK);
    }
  }
  else {
    $sec->systemLog(PASSNOEQUAL);
    $tpl->replace('#message',PASSNOEQUAL);
  }
}

$tpl->render();

?>
