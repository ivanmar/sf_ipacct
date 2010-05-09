<?php

//error_reporting(E_ALL);

require_once('framework.php');

$base = new cBase;
$mess = new cMessage('en');
$sec = new cIpacct();

$hdr = new cReplace('header');
$tpl = new cReplace;
$ftr = new cReplace('footer');

$hdr->replace('#date',$datnow);
$hdr->replace('#username',null);
$tpl->replace('#formaction',$_SERVER['PHP_SELF']);
$hdr->replace('#version',$base->getGlobal('version'));

$exec=$base->execute('get_isp');
$opts=array();
$rows=$base->fetchAll();
foreach($rows as $index => $record)
{
        $key=$rows[$index]['id'];
        $val=$rows[$index]['orgname'];
        $opts[$key]=$val;
}
$tpl->dropDown('#isporg',$opts,$p_isporg,true);

if($g_action=='logout')
{
  $sec->systemLog(LOGGEDOFF);
  session_unset();
  session_destroy();
}
elseif($p_loop==1)
{
  if(trim($p_username)=='sysadmin')
  {
    $param=array($p_username);
    $exec=$base->execute('get_user_info_adm',$param);
  }
  else {
    $param=array($p_isporg,$p_username);
    $exec=$base->execute('get_user_info',$param);
  }
  $rows=$base->fetchAll();
  $numrows=count($rows);
  if($numrows==0)
    $hdr->replace('#message',USER);
  elseif($numrows==1)
  {
    $s_userid=$rows[0]['id'];
    $s_username=trim($rows[0]['username']);
    $s_acctype=trim($rows[0]['acctype']);
    $s_isporg=$rows[0]['id_isporg'];
    $s_orgname=trim($rows[0]['orgname']);
    $s_ispsuborg=$rows[0]['id_ispsuborg'];
    $s_suborgname=$rows[0]['suborgname'];
    $s_lang=$rows[0]['lang'];
    $s_email_nasadmin=$rows[0]['email_nasadmin'];
    $q_password=$rows[0]['pass'];
    if($s_userid==1)
    {
      $exec=$base->execute('get_orgname_adm',array($p_isporg));
      $rows=$base->fetch();
      $s_orgname=trim($rows['orgname']);
      $s_isporg=$p_isporg;
    }

    $session=array();
    $session['id']=$s_userid;
    $session['username']=$s_username;
    $session['acctype']=$s_acctype;
    $session['id_isporg']=$s_isporg;
    $session['id_ispsuborg']=$s_ispsuborg;
    $session['orgname']=$s_orgname;
    $session['suborgname']=$s_suborgname;
    $session['lang']=$s_lang;
    $session['email_nasadmin']=$s_email_nasadmin;
    $session['session_start']=date("H:i:s  d/m");
    $base->setSession('user_info',$session);
    $sec=new cIpacct;

    if(md5($p_password)==$q_password)
    {
      $sec->systemLog(LOGGEDIN);
      if($s_acctype == 'administrator')
        header('Location: sysStatus.php');
      elseif($s_acctype == 'operator') 
        header('Location: operatorUser.php');
    } 
    else {
      $hdr->replace('#message',PASS);
      $sec->systemLog(PASS);
    }
  }
} 
else 
   $hdr->replace('#message',LOGIN);

$hdr->duplicate(1,null,true);
$hdr->duplicate(2,null,true);

$hdr->render();
$tpl->render();
$ftr->render();

?>
