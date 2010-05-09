<?php

require('framework.php');

$tpl = new cReplace;

$radcmd='sudo ps -ef | grep radiusd | grep -v grep | wc -l';
$dbcmd='sudo ps -ef | grep postgres | grep -v grep | wc -l';
$webcmd='sudo ps -ef | grep apache2 | grep -v grep | wc -l';

$radstatus=exec($radcmd);
$dbstatus=exec($dbcmd);
$webstatus=exec($webcmd);

if($radstatus>0) $radstatus='green'; else $radstatus='red';
if($dbstatus>0) $dbstatus='green'; else $dbstatus='red';
if($webstatus>0) $webstatus='green'; else $webstatus='red';

$tpl->replace('#radstatus',$radstatus);
$tpl->replace('#dbstatus',$dbstatus);
$tpl->replace('#webstatus',$webstatus);

$tpl->render();

?>
