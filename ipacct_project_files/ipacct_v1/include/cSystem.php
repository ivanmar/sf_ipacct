<?php

define("PHP",".php");
define("TPL",".tpl");
define("SQL",".sql");
define("MSG",".msg");
define("INI",".ini");
define("LOG",".log");
define("PNG",".png");

define("MASTER","ipacct.primusnet.hr");

define("FRAMEDIR","/var/www/localhost/htdocs/ipacct/konsole/");
define("TEMPLATEDIR","template/");
define("QUERYDIR","query/");
define("DUMPDIR","dump/");
define("LOGDIR","log/");
define("GRAPHDIR","images/graph/");
define("MESSAGEDIR","message/");
define("CONFIGDIR","config/");
define("INCLUDEDIR","include/");
define("DEPLOYDIR","apps/");

define("CONFIG","config.ini");
define("UPGRADE","upgrade.ini");
define("MENU","menu.ini");
define("DEPLOY","deploy.ini");

define("SYSLOG","ipacct.log");

class cSystem
{
	public function __construct()
	{
		$installfile=CONFIGDIR.CONFIG;
		$this->installOpenFile($installfile);
		$upgradefile=CONFIGDIR.UPGRADE;
		$this->installOpenFile($upgradefile);
	}
	
	private function installOpenFile( $installfile )
	{
		foreach(parse_ini_file($installfile) as $var => $val)
			$this->setGlobal($var,$val);
	}
	
	public function openFile( $filename )
	{
		$url=ereg('^http://',$filename);
		
		if($url==0)
		{
			if(file_exists($filename))
				return trim(implode(null,file($filename)));
			else
				return null;
		} else return trim(implode(null,file($filename)));
	}
	
	public function writeFile( $filename,$chunk,$append=false )
	{
		if($append)
			$ptr=fopen($filename,"a");
		else
			$ptr=fopen($filename,"w");
		fwrite($ptr,$chunk);
		fclose($ptr);
	}

	public function writeConfigFile( $fname,$opts )
	{
		$chunk=null;

		foreach($opts as $key => $val)
		{
			if(strlen($key)<=6)
				$chunk.="$key\t\t\t= $val\n";
			if((strlen($key)>6)&&(strlen($key)<=15))
				$chunk.="$key\t\t= $val\n";
			if(strlen($key)>15)
				$chunk.="$key\t= $val\n";
		}

		$this->writeFile(CONFIGDIR.$fname.INI,$chunk);
	}
	
	public function scanDir( $rootdir,$parent )
	{
		$dirs=array();
		$files=array();
		
		if($parent) $dirs[realpath("../")]="../";
		$excludedir=split(",",$this->getGlobal('excludedir'));
		
		foreach(glob("*") as $fname)
		{
			$val=ereg_replace("$rootdir/",null,realpath($fname));

			if(is_file($fname))
				$files[$val]=$val;
			if(is_dir($fname))
			if(!in_array($val,$excludedir))
				$dirs["$val/"]="$val/";
		}

		return array_merge($dirs,$files);
	}

        public function checkServerType()
        {
                $server=$_SERVER["SERVER_NAME"];
                if($server==MASTER)
                        return true;
                else return false;
        }

	public function getGlobal( $var=false )
	{
		if($var)
			return $GLOBALS[$var];
		else
			return $GLOBALS;
	}
	
	public function setGlobal( $var,$val )
	{
		$GLOBALS[$var]=$val;
	}
	
	public function getSession( $var=false )
	{
		if($var)
			return $_SESSION[$var];
		else
			return $_SESSION;
	}
	
	public function setSession( $var,$val )
	{
		if(isset($_SESSION[$var])) unset($_SESSION[$var]);
		$_SESSION[$var]=$val;
	}
	
	public function extractFileName( $filename )
	{
		return ereg_replace("\..*$",null,$filename);
	}
	
	public function self( $full=null )
	{
		$filename=$_SERVER["SCRIPT_FILENAME"];
		if(isset($full))
			return dirname($filename);
		else
			return basename($this->extractFileName($filename));
	}
	
}

?>
