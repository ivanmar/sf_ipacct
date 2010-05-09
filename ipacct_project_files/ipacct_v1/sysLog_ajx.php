<?php

require_once('framework.php');

$cmd="cat $g_log | grep \"$g_keyword\" | tail -n $g_lines";

$log=null;
$ptr=popen($cmd,"r");
while(!feof($ptr))
{
	$row=chop(fgets($ptr,4096));
	if(isset($g_keyword))
		$row=ereg_replace($g_keyword,"<b>\\0</b>",$row);
	$log.=nl2br($row."\n");
}
echo $log;
pclose($ptr);

?>
