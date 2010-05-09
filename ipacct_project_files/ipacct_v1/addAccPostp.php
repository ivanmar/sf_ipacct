<?php
//error_reporting(E_ALL);

require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('administrator')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();
$base = new cBase('addAccount');

$hdr = new cReplace('header');
$tpl = new cReplace;
$ftr = new cReplace('footer');

$hdr->replace('#topnav','#');
$session=$sec->getSession('user_info');
include_once('include/common_var');
$mess = new cMessage($s_lang);

$acc_type='postpaid';

require_once('include/common_addaccount');

if($p_loop==1)
{
  $input_error=$sec->checkRequiredFields (array('accounts'=>$p_accounts,'definition'=>$p_definition,
						'isp org'=>$p_isporg,'postp org'=>$p_ispsuborg,'Radius Location'=>$p_radlocation));
  if($p_accounts > $sec->getGlobal('max_create_acc'))
     $input_error="ERR_MAX_ACC";
  if(strlen($input_error) == 0)
  {
    $accounts=array();
    foreach(split(",",trim($p_accounts)) as $val)
    if(ereg("-",$val))
    {
      $iroom=split("-",trim($val));
      for($i=$iroom[0];$i<=$iroom[1];$i++)
        array_push($accounts,$i);
    } else array_push($accounts,trim($val));

    $roll=0;
    $base->begin();
  
    $param=array( $p_definition,$p_isporg,$p_ispsuborg,$s_id_user,count($accounts),$acc_type,$p_isporg);
    $roll=$base->execute('ins_accseries',$param);
  
    if((int)$roll==0)
    {
      $lastserid=$base->lastInsertId('acc_accseries_id_seq');
      $userpass=$sec->createPassword(count($accounts),$accounts);

      foreach($userpass as $user => $pass)
      {
        $c_user=$p_isporg.'-'.$p_ispsuborg.'-'.$user;
        $param=array( $c_user,$p_isporg,$p_ispsuborg,$lastserid);
        $roll=$base->execute('ins_postpacc',$param);

        $roll+= $base->execute('userpass',array($c_user,$pass,$lastserid));
        if(strlen($p_radlocation)>0 && $p_radlocation!='check_off')
          $roll+=$base->execute('radlocation',array($c_user,$p_radlocation));
        $roll+=$base->execute('usergroup',array($c_user,$p_definition));

        if((int)$roll!=0)
          break;
      }
   }
    
   if((int)$roll==0)
   {
     $base->commit();
     $sec->systemLog(OK);
     $hdr->replace('#message',OK);
   } else {
     $base->rollBack(); 
     $sec->systemLog(FAIL);
     $hdr->replace('#message',FAIL);
   }
  }
  else {
    $sec->systemLog($input_error);
    $hdr->replace('#message',$input_error);
  }
}

$opts=$sec->fetchAllowedISP();
$tpl->dropDown('#isporg',$opts,$p_isporg,true);

$ffill=array('#accounts' => $p_accounts );
$tpl->replace(null,$ffill);

$hdr->render();
$tpl->render();
$ftr->render();

?>
