<?php

require_once('framework.php');
require_once('include/cMailer.php');
require_once('include/cUpgrade.php');

$sec = new cIpacct();
if($sec->isLoggedIn('administrator')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();

$base = new cBase("ipacctAdmin");
$mail = new cMailer;
$mess = new cMessage('en');
$tpl = new cReplace;

$onload="self.setTimeout('self.close()', 2000); window.opener.location.reload()";

if($g_action == 'rad_res')
{
  $comm = $base->getGlobal('comm_radrestart');
  system($comm,$ret);
  if((int)$ret == 0)
    $tpl->replace('#message',OK_RADRES);
  else
    $tpl->replace('#message',ERR_RADRES);

  $tpl->replace('#onload',$onload);
}
elseif($g_action == 'clean_db')
{
  $radacct_clean_days = $base->getGlobal('radacct_clean_days');
  $stale_clean_days = $base->getGlobal('clean_stale_after_days');

  $del_stale_date=date("$dbdateform",mktime(0,0,0,date("m"),date("d")-$stale_clean_days, date("Y")) );
  $base->execute('del_stale',array($del_stale_date));
  $numrows=$base->rowCount();

  $del_radacct_date=date("$dbdateform",mktime(0,0,0,date("m"),date("d")-$radacct_clean_days, date("Y")) );
  $base->execute('del_radacct',array($del_radacct_date));
  $numrows+=$base->rowCount();

  $base->execute('clean_sess',NULL);
  $numrows+=$base->rowCount();

  $tpl->replace('#message',"$numrows ".RECORDS_CLEANED);
  $tpl->replace('#onload',$onload);
}
elseif($g_action == 'index_db')
{
  $ipacctdb=$base->getGlobal('dbname');
  $exec=$base->execute('indexdb',NULL);
  if((int)$exec==0)
	$tpl->replace('#message',OK_INDEX);
  else
	$tpl->replace('#message',ERR_INDEX);

  $tpl->replace('#onload',$onload);
}
elseif($g_action == 'sys_ver')
{
  $upg=new cUpgrade;
  $status=$upg->getUpgrade();
  $inifile=parse_ini_file(CONFIGDIR."upgrade".INI);
  $version=$inifile['version'];
  $build=$inifile['build'];

  if($status) {
    $message=OK_UPGRADE." $version ($build)";
  }
  else { 
    $message=NO_UPGRADE;
  }
  $sec->systemLog($message);
  $tpl->replace('#message',$message);
  $tpl->replace('#onload',$onload);

} elseif($g_action == 'backup') {

  $dbuser=$sec->getGlobal('dbuser');
  $dbname=$sec->getGlobal('dbname');
  $filename='db-'.date("Y-M-d-H-i-s").'.gz';
  $cmd = "pg_dump -c -Z 9 -D -U $dbuser $dbname > dump/backup/$filename";
  system($cmd,$ret_val);
  if((int)$ret_val == 0)
  {
    	$mail->IsSMTP();                                      // set mailer to use SMTP
	$mail->Host = $base->getGlobal('mailserver');
	$mail->CharSet = "iso-8859-2";
	$mail->From = $base->getGlobal('mailfromaddr');
	$mail->FromName = 'Primus IPACCT';
	$mail->AddAddress($base->getGlobal('email_backup'));
	$mail->AddAttachment("dump/backup/$filename");
	$mail->IsHTML(false);
	$mail->Subject = 'BACKUP-'. $base->getGlobal('mailfromname');
	$mail->Body = "IPACCT backup $filename";
	if(!$mail->Send())
        {
          $errfile=DUMPDIR."mailer.dump";
          $errtext=$mail->ErrorInfo."\n";
          $base->writeFile($errfile,$errtext,true);
          $tpl->replace('#message',ERR_MAIL);
        } else {
	  $cmd="rm dump/backup/$filename";
	  system($cmd,$ret_val);
          $tpl->replace('#message',OK_MAIL);
	}
        $mail->ClearAddresses();
        $tpl->replace('#onload',$onload);
  }
}
else
{
  $tpl->replace('#message',NO_ACTION);
}


$tpl->render();

?>
