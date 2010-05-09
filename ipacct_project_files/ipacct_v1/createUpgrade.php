<?php

require_once('framework.php');
require_once('include/cUpgrade.php');

$sec = new cIpacct();
if($sec->isLoggedIn('superadmin')!=LOGIN_PASSED)
	header('Location: login.php');
ob_end_flush();

$upg = new cUpgrade;
$mess = new cMessage('en');
$hdr = new cReplace('header');
$tpl = new cReplace;
$ftr = new cReplace('footer');

$hdr->replace('#topnav','#');
$session=$sec->getSession('user_info');
include_once('include/common_var');

$rootdir=dirname(__FILE__);

if($p_loop==0)
{
	$build_pref=date("Ymd");
	if(substr($build,0,8)==$build_pref)
	{
		$build_suff=(int)substr($build,8);
		$build_suff++;
		if(strlen($build_suff)<2) $build_suff='0'.$build_suff;
	} else $build_suff='00';

	$p_numbuild=$build_pref.$build_suff;
	$p_numversion=$version;
	$p_tarname=CONFIGDIR."upgrade-$p_numbuild.tgz";
	
	$p_files=null;
	$change=$upg->createList();
	foreach($change as $val)
		if(file_exists($rootdir.'/'.$val))
			$p_files.=$val."\n";
}

if($p_loop==1)
{
	$opts=array( 'build' => $p_numbuild,
		     'version' => $p_numversion,
		     'remotefile' => $p_tarname,
		     'postaction' => $p_postaction);
	$archfiles=split("\r\n",$p_files);
	$upg->createArchive($opts,$archfiles);
	$messtxt=UPG_READY." (version $p_numversion/build $p_numbuild)";
	$hdr->replace('#message',$messtxt);
	$sec->systemLog($messtxt);
}

if(($p_loop==2) && is_dir($p_fname))
{
	chdir(realpath($p_fname));
	if(realpath($p_fname)==$rootdir)
		$dircontent=$upg->scanDir($rootdir,0);
	else
		$dircontent=$upg->scanDir($rootdir,1);
} else $dircontent=$upg->scanDir($rootdir,0);

$files=split("\n",chop($p_files));

$tpl->dropDown('#fname',$dircontent,$p_fname,true);
$tpl->dropDown('#archive',$files,null,false);

$tpl->replace('#files',$p_files);
$tpl->replace('#numbuild',$p_numbuild);
$tpl->replace('#numversion',$p_numversion);
$tpl->replace('#tarname',$p_tarname);

$opts=array('tar xzf' => 'Extract','exec' => 'Execute');
$tpl->dropDown('#postaction',$opts,$p_postaction,true);

$hdr->render();
$tpl->render();
$ftr->render();

?>
