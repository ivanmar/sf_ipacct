<?php

require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('administrator')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();

$base = new cBase('addNAS');
$mess = new cMessage('en');
$tpl = new cReplace;

$tpl->replace('#formaction',$_SERVER['PHP_SELF']);

if($g_id > 0)
{
  $exec = $base->execute('sel_nasinfo',array($g_id));
  $row=$base->fetch();

  $p_shortname = $row['shortname'];
  $p_radsecret = $row['secret'];
  $p_macaddress = $row['pacc_macaddress'];
  $p_connuser = $row['pacc_conn_user'];
  $p_connpass = $row['pacc_conn_pass'];
  $p_adminuser = $row['pacc_admin_user'];
  $p_adminpass = $row['pacc_admin_pass'];
  $p_radlocation = $row['pacc_radlocation'];
  $p_desc = $row['description'];
  $p_ssid = $row['pacc_ssid'];
  $p_adminport = $row['pacc_adminport'];
}

if($p_loop == 1)
{
  $param=array($p_macaddress,$p_shortname,$p_radsecret,$p_ssid,$p_adminport,$p_connuser,$p_connpass,$p_adminuser,$p_adminpass,$p_desc,$p_nasid);
  $exec = $base->execute('upd_nasinfo',$param);

    if((int)$exec==0)
    {
      $sec->systemLog(UPD_OK);
      $tpl->replace('#message',UPD_OK);
      $onload="self.setTimeout('self.close()', 2000); window.opener.location.reload()";
      $tpl->replace('#onload',$onload);
    } else {
      $sec->systemLog(UPD_NO_OK);
      $tpl->replace('#message',UPD_NO_OK);
    }
}

$ffill=array(	'#shortname' => $p_shortname,
		'#radsecret' => $p_radsecret,
		'#connuser' => $p_connuser,
		'#connpass' => $p_connpass,
		'#adminuser' => $p_adminuser,
		'#adminpass' => $p_adminpass,
		'#macaddress' => $p_macaddress,
		'#radlocation' => $p_radlocation,
		'#adminport' => "$p_adminport",
		'#ssid' => $p_ssid,
		'#nasid' => "$g_id",
		'#desc' => $p_desc);
$tpl->replace(null,$ffill);

$tpl->render();

?>
