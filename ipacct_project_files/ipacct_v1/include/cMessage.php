<?php

require_once("cSystem.php");

class cMessage extends cSystem
{
	private $aMess = array();
	
	public function __construct( $lang,$screen=false,$tpl=false )
	{
		parent::__construct();
		if($screen==false) $screen=$this->self();
		$messagefile=MESSAGEDIR.$screen.MSG;
		$globalmess=MESSAGEDIR."global".MSG;
		$this->messageOpenFile($globalmess,$lang);
		$this->messageOpenFile($messagefile,$lang);
		if($tpl) $this->replaceMessage($tpl);
	}
	
	private function messageOpenFile( $messagefile,$lang )
	{
		$path=$this->self(true);
		$full=$path."/".$messagefile;
		
		if(file_exists($full))
		{
			$mess=parse_ini_file($full,true);
			if(!empty($mess))
				foreach($mess[$lang] as $key => $val)
				{
					$this->aMess[$key]=trim($val);
					define(strtoupper($key),trim($val));
				}
		}
	}
	
	public function fetchMessage( $key=null )
	{
		if(isset($key))
			return $this->aMess[$key];
		else
			return $this->aMess;
	}
	
	public function replaceMessage($tpl)
	{
		$mess=array();
		$pref=$this->getGlobal("messpref");
		$suff=$this->getGlobal("messsuff");
		foreach($this->aMess as $var => $val)
		{
			$key=$pref.$var.$suff;
			$mess[$key]=$val;
		}
		$tpl->replace(null,$mess);	
	}
}

