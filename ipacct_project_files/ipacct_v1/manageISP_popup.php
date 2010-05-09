<?php

require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('superadmin')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();

$base = new cBase('addISP');
$mess = new cMessage('en');
$tpl = new cReplace;

$tpl->replace('#formaction',$_SERVER['PHP_SELF']);

if(isset($g_id) && $g_id>0)
{
  $p_ispid=$g_id;
  $exec=$base->execute('sel_isporg',array($g_id));
  $rows=$base->fetchAll();
  
  $p_orgname=$rows[0]['orgname'];
  $p_address=$rows[0]['address'];
  $p_city=$rows[0]['city'];
  $p_zipcode=$rows[0]['zipcode'];
  $p_phone=$rows[0]['phone'];
  $p_billinginfo=$rows[0]['billinginfo'];
  $p_contactname=$rows[0]['contactname'];
  $p_email_report=trim($rows[0]['email_report']);
  $p_email_nasadmin=$rows[0]['email_nasadmin'];
  $p_pst_commission=$rows[0]['pst_commission'];
}
elseif($p_loop==1 && $p_ispid!=0)
{
  $input_error=$sec->checkRequiredFields (array('isp name'=>$p_orgname));
  if(strlen($input_error) == 0)
  {
      $param=array( $p_orgname,$p_address,$p_city,$p_zipcode,$p_phone,$p_billinginfo,$p_contactname,$p_email_report,
  			$p_email_nasadmin,$p_pst_commission,$p_ispid);
      $exec=$base->execute('upd_isporg',$param);
      if((int)$exec==0)
      {
        $sec->systemLog(OK);
        $tpl->replace('#message',OK);
        $onload="self.setTimeout('self.close()', 2000); window.opener.location.reload()";
        $tpl->replace('#onload',$onload);
      } else {
        $sec->systemLog(FAIL);
        $tpl->replace('#message',FAIL);
      }
  }
  else {
    $sec->systemLog($input_error);
    $tpl->replace('#message',$input_error);
  }
}


$filename='images/logoisp/logo-'.$p_ispid.'.jpg';
if(file_exists($filename))
    $ispimg=$p_ispid;
else
    $ispimg='default';

$ffill=array(	'#ispid' => $p_ispid,
		'#orgname' => $p_orgname,
		'#address' => $p_address,
		'#phone' => $p_phone,
		'#city' => $p_city,
		'#zipcode' => $p_zipcode,
		'#billinginfo' => $p_billinginfo,
		'#contactname' => $p_contactname,
		'#email_report' => $p_email_report,
		'#email_nasadmin' => $p_email_nasadmin,
		'#ispimg' => $ispimg,
		'#pst_commission' => $p_pst_commission);
$tpl->replace(null,$ffill);


$tpl->render();

?>
