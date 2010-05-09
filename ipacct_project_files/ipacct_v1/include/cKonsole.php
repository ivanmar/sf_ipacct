<?php

define("COMMENTS","(^<!--|-->$)");

require_once("cSystem.php");

class cKonsole extends cSystem
{
	public function __construct() {}
	
        public function getAppPath( $appname=null )
        {
                $apps=FRAMEDIR.DEPLOYDIR.DEPLOY;
		$fullpaths=parse_ini_file($apps);
		
		if(strlen($appname)>0)
			return $fullpaths[$appname];
		else
			return $fullpaths;
        }
	
        public function setAppPath( $appname,$path )
        {
                $apps=FRAMEDIR.DEPLOYDIR.DEPLOY;
		$paths=$this->getAppPath();
		$paths[$appname]=$path;
		ksort($paths);
		foreach($paths as $key => $val)
			$chunk.=$key."\t\t= ".$val."\n";
		$this->writeFile($apps,$chunk);
		
		return $paths;
	}
	
	public function listFiles( $dir,$ext,$fullpath=false )
	{
		$files=array();
		$dir=ereg_replace("/$",null,$dir);
		$ext=ereg_replace("^\.",null,$ext);
		if(!file_exists($dir)) return $files;
		
		foreach(scandir($dir) as $val)
		{
			$full="$dir/$val";
			$info=pathinfo($full);
			if($info["extension"]==$ext)
				if($fullpath)
					array_push($files,$full);
				else
					array_push($files,$info["basename"]);
		}
		
		return $files;
	}
}

?>
