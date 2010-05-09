<?php

require_once("cSystem.php");

class cUpgrade extends cSystem
{
	private $local = array();
	private $remote = array();
	private $archiveFiles = array();
	
	private $masterServer = false;
	private $clientServer = false;
	
	private $baseURL;
	private $config;
	
	public function __construct()
	{
		parent::__construct();
		
		$upgradefile=CONFIGDIR.UPGRADE;
		$this->baseURL='http://'.MASTER.'/';
		$this->remoteConfig=$this->baseURL.$upgradefile;
		
		$this->fetchConfig($upgradefile);
		if($this->checkServerType())
			$this->masterServer=true;
		else
			$this->clientServer=true;
	}
		
	public function getUpgrade()
	{
		if($this->clientServer)
		{
			$this->fetchConfig($this->remoteConfig);
			if($this->checkUpgradeDownload())
			{
				$this->fetchRemoteFile();
				$this->installUpgrade();
				$this->writeLocalConfig($this->remote);
				
				return true;
			}
		}
		
		return false;
	}

	public function createList()
	{
		$this->recordTimeStamp("*");
		$this->recordTimeStamp("*/*");
		$this->recordTimeStamp("*/*/*");
		
		return $this->archiveFiles;
	}
	
	public function createArchive( $opts,$archfiles )
	{
		$maxstamp=$this->getSession('maxstamp');
		$this->local['lastchange']=$maxstamp;
		
		foreach($opts as $key => $val)
			$this->local[$key]=$val;
		$this->writeLocalConfig($this->local);
		
		$list=implode(" ",$archfiles);
		$file=$this->local['remotefile'];
		$cmd="tar czf $file $list";
		system($cmd);
	}
	
	private function fetchConfig( $file )
	{
		$content=$this->openFile($file);
		$chunk=split("=|\n",$content);
		
		for($i=0;$i<count($chunk);$i+=2)
		{
			$key=trim($chunk[$i]);
			$val=trim($chunk[$i+1]);
			
			if($file==$this->remoteConfig)
				$this->remote[$key]=$val;
			else
				$this->local[$key]=$val;
		}
	}
		
	private function checkUpgradeDownload()
	{
		if(((int)$this->remote['build']) > ((int)$this->local['build']))
			return true;
		else
			return false;
	}
	
	private function fetchRemoteFile()
	{
		$upgradeFile=$this->baseURL.$this->remote['remotefile'];
		$ch = curl_init($upgradeFile);
		$fp = fopen($this->remote['remotefile'],"w");
		
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);

		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
		
		chmod($this->remote['remotefile'],0755);
	}
	
	private function installUpgrade()
	{
		if($this->remote['postaction']!=null)
		{
			$cmd=$this->remote['postaction'].' '.
			$this->remote['remotefile'];
			
			system($cmd);
			unlink($this->remote['remotefile']);
		}
	}
	
	private function writeLocalConfig( $opts )
	{
		foreach($opts as $key => $val)
		if(strlen($key)>=10)
			$chunk.="$key\t= $val\n";
		else
			$chunk.="$key\t\t= $val\n";
		
		$this->writeFile(CONFIGDIR.UPGRADE,$chunk);
	}

	private function in_exclude( $search )
	{
		$found=0;
		$excludedir=split(",",$this->getGlobal('excludedir'));

		foreach($excludedir as $val)
			if(ereg("^$val",$search)) $found++;
		return $found;
	}

	private function recordTimeStamp( $basedir )
	{
		$initstamp=$this->local['lastchange'];
		
		foreach(glob($basedir) as $file)
		if(!is_dir($file))
		if($this->in_exclude($file)==0)
		{
			$currstamp=filemtime($file);
			if($currstamp > $initstamp)
			{
				$this->setSession('maxstamp',$currstamp);
				array_push($this->archiveFiles,$file);
			}
		}
	}
}
