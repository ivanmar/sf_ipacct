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
require_once('include/common_var');
$mess = new cMessage($s_lang);

$acc_type='subscriber';

require_once('include/common_addaccount');


if($p_loop==1)
{
  $input_error=$sec->checkRequiredFields (array('username'=>$p_username,'password'=>$p_pass,
						'definition'=>$p_definition,'isp org'=>$p_isporg,'Radius Location'=>$p_radlocation));
  if(strlen($input_error) == 0)
  {
    $roll=0;
    $base->begin();
  
    $param=array( $p_definition,$p_isporg,$p_ispsuborg,$s_id_user,'1',$acc_type,$p_isporg );
    $roll=$base->execute('ins_accseries',$param);

    if((int)$roll==0)
    {
      $lastserid=$base->lastInsertId('acc_accseries_id_seq');
	  $param=array( $p_username,$p_fullname,$p_isporg,$p_address,$p_city,$p_phone,$p_email,$lastserid );
      $roll=$base->execute('ins_subscriber',$param);  
    }
    if((int)$roll==0)
    {
        $roll+= $base->execute('userpass',array($p_username,$p_pass,$lastserid));
        if(strlen($p_radlocation)>0 && $p_radlocation!='check_off')
          $roll+=$base->execute('radlocation',array($p_username,$p_radlocation));
        $roll+=$base->execute('usergroup',array($p_username,$p_definition));

        if((int)$roll!=0)
          break;
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
  else $hdr->replace('#message',$input_error);
}
$arr_isp=$sec->fetchAllowedISP();
$tpl->dropDown('#isporg',$arr_isp,$p_isporg,true);

$ffill=array(  '#address' => $p_address,
               '#city' => $p_city );
$tpl->replace(null,$ffill);

$hdr->render();
$tpl->render();
$ftr->render();

?>
