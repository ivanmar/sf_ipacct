<?php

require_once("cSystem.php");

class cReplace extends cSystem
{
	private $ohtml;
	private $rhtml;

	public function __construct( $screen=false )
	{
		if($screen==false) $screen=$this->self();
		$templatefile=TEMPLATEDIR.$screen.TPL;
		$this->ohtml=$this->openFile($templatefile);
		$this->rhtml=$this->ohtml;
	}
	
	public function replaceFirst( $search,$replace,$prefix=null )
	{
		$rhtml=$this->rhtml;
		
		if(is_array($replace))
			foreach($replace as $key => $val)
			{
				$pattern="/$prefix"."$key/";
				$rhtml=preg_replace($pattern,$val,$rhtml,1);
			}
		else {
			$pattern="/$prefix"."$search/";
			$rhtml=preg_replace($pattern,$replace,$rhtml,1);
		}
		
		$this->rhtml=$rhtml;
	}
	
	public function replace( $search,$replace,$prefix=null )
	{
		$rhtml=$this->rhtml;
		
		if(is_array($replace))
			foreach($replace as $key => $val)
			{
				$pattern=$prefix.$key;
				$rhtml=ereg_replace($prefix.$key,$val,$rhtml);
			}
		else {
			$pattern=$prefix.$search;
			$rhtml=ereg_replace($pattern,$replace,$rhtml);
		}
		
		$this->rhtml=$rhtml;
	}

	function replaceTag( $search,$replace,$num=0 )
	{
		$rhtml=$this->rhtml;

		$pattern="[\w\s.=:;#\/?&'\"]*";
		$needle="<".$pattern.$search.$pattern.">";
		
		$anytag="\s*<".$pattern.">";
		
		if($num>0) for($i=0;$i<$num;$i++) $needle.=$anytag;
		
		$rhtml=preg_replace("/$needle/",$replace,$rhtml);

		$this->rhtml=$rhtml;
	}

	public function replaceError( $serial,$error )
	{
		$showerrs=$this->getGlobal("showerrs");
		$pref=$this->getGlobal("messpref");
		$suff=$this->getGlobal("messsuff");
		
		$stag="<error id=\"$serial\">";
		$etag="<\/error>";
		
		$sstrip="^.*$stag";
		$estrip="$etag.*$";
		
		$detail=ereg_replace("($sstrip|$estrip)",null,$this->rhtml);
		$chunk=trim($detail);
		$search=$pref."error".$suff;
		$replace=trim($error);
		$chunk=ereg_replace($search,$replace,$chunk);
		$holder=$stag.$detail.$etag;
		if($error && $showerrs)
			$this->rhtml=ereg_replace($holder,$chunk,$this->rhtml);
		else
			$this->rhtml=ereg_replace($holder,null,$this->rhtml);
	}
	
	public function duplicate( $serial,$num,$main=false )
	{
		if($main)
		{
			$stag="<mainrepeat id=\"$serial\">";
			$etag="<\/mainrepeat>";
		} else {
			$stag="<repeat id=\"$serial\">";
			$etag="<\/repeat>";
		}

		$sstrip="^.*$stag";
		$estrip="$etag.*$";
		
		$detail=ereg_replace("($sstrip|$estrip)",null,$this->rhtml);
		if($num>0)
			for($i=0;$i<$num;$i++)
			{
				$chunk=trim($detail);
				$loop.=$chunk;
			}
		else $loop=null;
		
		$holder=$stag.$detail.$etag;
		$this->rhtml=ereg_replace($holder,$loop,$this->rhtml);
	}
	
	public function loop( $serial,$replace,$prefix=false,$error=false )
	{
		if($error)
			$this->replaceError($serial,$error);
		else
			$this->replaceError($serial,null);
		
		if(!$prefix)
		{
			$pref=$this->getGlobal("dbtplpref");
			$suff=$this->getGlobal("dbtplsuff");
		} else {
			$pref=$prefix;
			$suff=null;
		}
		
		$stag="<repeat id=\"$serial\">";
		$etag="<\/repeat>";
		
		$sstrip="^.*$stag";
		$estrip="$etag.*$";
		
		$detail=ereg_replace("($sstrip|$estrip)",null,$this->rhtml);
		if(count($replace)>0)
			foreach($replace as $record)
			{
				$chunk=trim($detail);
				foreach($record as $key => $val)
				{
					$k=$pref.$key.$suff;
					$v=trim($val);
					$chunk=ereg_replace($k,$v,$chunk);
				}
				$loop.=$chunk;
			}
		else $loop=null;
		
		$holder=$stag.$detail.$etag;
		$this->rhtml=ereg_replace($holder,$loop,$this->rhtml);
	}
	
	public function dropDown( $search,$options,$sel=false,$keys=false )
	{
		foreach($options as $key => $val)
		{
			if($keys)
			{
				if($key==$sel)
				{
					$str.="<option value='$key' selected>";
					$str.=$val;
					$str.="</option>";
				} else $str.="<option value='$key'>$val</option>";
			} else {
				if($val==$sel)
				{
					$str.="<option value='$val' selected>";
					$str.=$val;
					$str.="</option>";
				} else $str.="<option value='$val'>$val</option>";
			}
		}
		
		$this->replace($search,$str);
	}
	
	public function menu( $type )
	{
		$menuconfig=CONFIGDIR.MENU;
		$menu=parse_ini_file($menuconfig,true);
		$val=each($menu[$type]);
		$options=split(',',$val[1]);
		if($type=='administrator')
		{
			$this->duplicate(1,count($menu[$type]),true);
			$this->duplicate(2,count($menu[$type]),true);
			$this->duplicate(3,null,true);
		} else {
			$this->duplicate(1,null,true);
			$this->duplicate(2,null,true);
			$this->duplicate(3,count($menu[$type]),true);
		}

		foreach($menu[$type] as $key => $val)
		{
			$this->replaceFirst('#rel',$key);
			$this->replaceFirst('#subrel',$key);
			$this->replaceFirst('#caption',$key);
			$options=split(',',$val);

			$this->replaceFirst('#mainlink',$options[0]);
			$this->replaceFirst('#num',$key);
			
			$this->duplicate($key,((count($options) -1) / 2 ));

			if($type=='administrator')
			{

				for($i=1;$i<count($options);$i+=2)
				{
					$lnk=$options[$i];
					$linktxt=$options[$i+1];

					$this->replaceFirst('#link',$lnk);
					$this->replaceFirst('#linktxt',$linktxt);

				}
			}
		}
	}
	
	private function clearHashes()
	{
		$this->replace("&#40;","(");
		$this->replace("&#41;",")");
		$this->replace("&#63;","?");
		$this->replace("#[a-z]+",null);
	}
	
	public function contents()
	{
		return $this->rhtml;
	}
	
	public function render( $clear=true )
	{
		if($clear) $this->clearHashes();
		echo $this->contents();
	}
	
	public function reset()
	{
		$this->rhtml=$this->ohtml;
	}
}
