<?php
//error_reporting(E_ALL);
//print_r ($_SESSION['user_info']);

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
require_once('include/common_var');
$mess = new cMessage($s_lang);

$acc_type='prepaid';

require_once('include/common_addaccount');

if($p_loop==1)
{
  $input_error=$sec->checkRequiredFields (array('accounts'=>$p_accounts,'definition'=>$p_definition,
						'isp org'=>$p_isporg,'isp suborg'=>$p_ispsuborg,'Radius Location'=>$p_radlocation));
  if($p_accounts > $sec->getGlobal('max_create_acc'))
     $input_error="ERR_MAX_ACC";
  if(strlen($input_error) == 0)
  {
    $roll=0;
    $base->begin();
  
    $param=array( $p_definition,$p_isporg,$p_ispsuborg,$s_id_user,$p_accounts,$acc_type,$p_isporg);
    $roll=$base->execute('ins_accseries',$param);

    if((int)$roll==0)
    {
      $lastserieid=$base->lastInsertId('acc_accseries_id_seq');
      $userpass=$sec->createPassword($p_accounts);

      $i=1;  //s_card control

      foreach($userpass as $user => $pass)
      {
	$j = sprintf("%04d", $i);
        $s_card=$lastserieid.'-'."$j";
        $param=array( $user,$p_isporg,$p_ispsuborg,$lastserieid,$s_card,$p_ind_ondemand);
        $roll=$base->execute('ins_prepacc',$param);

        $roll+= $base->execute('userpass',array($user,$pass,$lastserieid));
        if(strlen($p_radlocation)>0 && $p_radlocation!='check_off')
          $roll+=$base->execute('radlocation',array($user,$p_radlocation));
        $roll+=$base->execute('usergroup',array($user,$p_definition));

        if((int)$roll!=0)
          break;

       $i++;
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

$ffill=array('#accounts' => $p_accounts);
$tpl->replace(null,$ffill);

$hdr->render();
$tpl->render();
$ftr->render();

?>
