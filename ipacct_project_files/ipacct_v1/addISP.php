<?php

require_once('framework.php');

$sec = new cIpacct();
if($sec->isLoggedIn('superadmin')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();

$base = new cBase;
$hdr = new cReplace('header');
$tpl = new cReplace;
$ftr = new cReplace('footer');

$hdr->replace('#topnav','#');
$session=$sec->getSession('user_info');
include_once('include/common_var');
$mess = new cMessage($s_lang);

$uploaddir = 'images/logoisp/';

if($g_action=='del' && $g_id>1)
{
  $param=array($g_id);
  $exec=$base->execute('check_isp_user',$param);
  $rows=$base->fetchAll();

  if(count($rows)==0)
  {
    $exec=$base->execute('check_isp_def',$param);
    $rows=$base->fetchAll();
    if(count($rows)==0)
    {
      $exec=$base->execute('check_ispsuborg',$param);
      $rows=$base->fetchAll();
      if(count($rows)==0) {
        $exec=$base->execute('del_isp',$param);
	$sec->systemLog(OK);
        $hdr->replace('#message',OK);
      }
      else {
        $sec->systemLog(ISPUSED_SUBORG);
        $hdr->replace('#message',ISPUSED_SUBORG);
      }
    } 
    else {
      $sec->systemLog(ISPUSED_DEF);
      $hdr->replace('#message',ISPUSED_DEF);
    }
   } 
   else {
     $sec->systemLog(ISPUSED_USER);
     $hdr->replace('#message',ISPUSED_USER);
   }
}

elseif($p_loop==1)
{
	$roll=0;
  	$base->begin();

	$str_to_replace = array(" ", ".", ",");
	$str_safe       = array("_", "_", "_");
	$p_radlocation = strtoupper(str_replace($str_to_replace, $str_safe, $p_ispname));

	$param=array(	$p_ispname,$p_address,$p_city,$p_phone,$p_zip,$p_billing,
			$p_contact,$p_email_report,$p_email_nasadmin,$p_pst_commission,$p_radlocation);
	$roll=$base->execute('add_isp',$param);
	if((int)$roll==0)
  	{
	  $lastispid=$base->lastInsertId('acc_isporg_id_seq');
	  $subradlocation=$p_radlocation.'_DEFAULT';
	  $roll=$base->execute('add_ispsuborg',array($lastispid,$subradlocation));
	}
	if((int)$roll==0)
	{
    	  $base->commit();
	  mkdir("/var/www/localhost/htdocs/ipacct/template/isp/$lastispid", 0777);
	  $sec->systemLog(OK);
          $hdr->replace('#message',OK);
  	} else { 
    	  $base->rollBack();
	  $sec->systemLog(FAIL);
          $hdr->replace('#message',FAIL);
	}

  if ($_FILES['logo']['tmp_name'])
  {
     $imgtype=explode('/',$_FILES['logo']['type']);
     $file_ext=trim(mb_strtolower($imgtype[1]));
     $uploadfile = $uploaddir .'logo'.'-'.$lastispid.'.'.'jpg';
     if($file_ext != 'jpg' || $file_ext != 'jpeg')
     {
       $sec->systemLog(IMAGE_JPG);
       $hdr->replace('#message',IMAGE_JPG);
     } else
       move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile);
  }
}

$ffill=array(	'#ispname' => $p_ispname,
		'#address' => $p_address,
		'#city' => $p_city,
		'#zip' => $p_zip,
		'#billing' => $p_billing,
		'#contact' => $p_contact,
		'#email_report' => $p_email_report,
		'#email_nasadmin' => $p_email_nasadmin,
		'#pst_commission' => $p_pst_commission);
$tpl->replace(null,$ffill);

$exec=$base->execute('list_isp',null);
$rows=$base->fetchAll();

foreach($rows as $id=>$record)
{
  $filename='images/logoisp/logo-'.$record['id'].'.jpg';
  if(file_exists($filename))
    $rows[$id]['ispimg']=$record['id'];
  else
    $rows[$id]['ispimg']='default';
}

$tpl->loop(1,$rows);

$hdr->render();
$tpl->render();
$ftr->render();

?>
