<?php

define("LOGIN_PASSED",0);
define("LOGIN_NOSESSID",1);
define("LOGIN_FORBIDDEN",2);

require_once("cSystem.php");

class cIpacct extends cSystem
{
	private $session;
	private $base;
	
	function __construct()
	{
		$this->session=$this->getSession('user_info');
		$this->base = new cBase("security");
	}
	
	public function fetchAllowedISP()
	{
		$acctype=trim($this->session['acctype']);
		$id_user=$this->session['id'];
		$id_isporg=$this->session['id_isporg'];
		$orgname=trim($this->session['orgname']);
		
		if(($acctype=='administrator')&&($id_user==1))
		{
			$exec=$this->base->execute('get_isp',null);
			$opts=array();
			$rows=$this->base->fetchAll();
			foreach($rows as $index => $record)
			{
				$key=$rows[$index]['id'];
				$val=$rows[$index]['orgname'];
				$opts[$key]=$val;
			}
			return $opts;
		} else return array($id_isporg => $orgname);
	}
		
	function isLoggedIn( $level='operator' )
	{
		if(is_array($this->session))
		{
			$acctype=trim($this->session['acctype']);
			$id_user=trim($this->session['id']);
			if($level=='administrator' && $acctype=='operator')
				return LOGIN_FORBIDDEN;
			elseif($level=='superadmin' && $id_user!=1)
				return LOGIN_FORBIDDEN;
			else return LOGIN_PASSED;
		} else return LOGIN_NOSESSID;
	}

	public function createPassword( $accnum,$users=false )
	{
		$UserPass = array();
		
		for($i=0;$i<$accnum;$i++)
		{	
			for($j=0;$j<1;$j++)
			{
				$consts='bcdfghjkmnprstvz';
				$vowels='aeiou';
				$num=mt_rand(1000, 9999);
				for ($x=0; $x < 4; $x++)
				{
					$const[$x] = substr($consts,mt_rand(0,strlen($consts)-1),1);
					$vow[$x] = substr($vowels,mt_rand(0,strlen($vowels)-1),1);
				}
				$ID = ($const[0].$vow[0].$const[2].$const[1].$const[3].$num);
				
				for($x=0;$x<4;$x++)
				{
					$const[$x] = substr($consts,mt_rand(0,strlen($consts)-1),1);
					$vow[$x] = substr($vowels,mt_rand(0,strlen($vowels)-1),1);
				}
				
				$PASS = mt_rand(1000000, 9999999);
				
				if(is_array($users))
				{
					$key=$users[$i];
					$UserPass[$key] = $PASS;
				} else $UserPass[$ID] = $PASS;
			}
		}
		
		return $UserPass;
	}
	
	public function fetchAllowedDefs( $acctype,$id_isporg=0 )
	{
		$id_sysuser=$this->session['id'];
		if($id_isporg==0)
		  $id_isporg=$this->session['id_isporg'];

		if ($id_isporg=='all' && $id_sysuser==1)
		  $listisp='%';
		else
		  $listisp=$id_isporg;
		$exec=$this->base->execute('get_defs',array($acctype,$listisp));
		
		$opts=array();
		$rows=$this->base->fetchAll();
		foreach($rows as $index => $record)
		{
			$key=$record['id'];
			$val=$record['definitionname'];
			$opts[$key]=$val;
		}
		return $opts;
	}
	
	public function fetchDefInfo( $defid,$type='limit' )
	{
		$param=array($this->base->getGlobal('rad_timelimit'),$this->base->getGlobal('rad_simuse'),$this->base->getGlobal('rad_firstvalid'),
		      $this->base->getGlobal('rad_traflimit'),$this->base->getGlobal('rad_download'),$this->base->getGlobal('rad_createvalid'),$defid);
		$exec=$this->base->execute('get_definfo',$param);
		$rows=$this->base->fetch();
		$opts=array();
		
		if($type=='limit'||$type=='all')
		{
		  $opts['BW']=$this->bytes2str($rows['limitdownloadrate']);
		  $opts['Traffic']=$this->bytes2str($rows['limittraffic']);
		  $opts['Time']=$this->time2str($rows['limittime']);
		  $opts['Usage period']=$rows['limitusageperiod'];
		}
		if($type=='bill'||$type=='all')
		{
		  $opts['MU']=$rows['measureunit'];
		  $opts['BU']=$rows['billingunit'];
		  $opts['Price BU']=$rows['pricebillingunit'];
		  $opts['Price on start']=$rows['priceonstart'];
		}
		return $opts;
	}
	
	public function fetchOrgInfo( $id_isporg=0 )
	{
		if($id_isporg==0) $id_isporg=$this->session['id_isporg'];
		$param=array($id_isporg);
		$exec=$this->base->execute('get_orginfo',$param);
		$rows=$this->base->fetch();
		
		$opts=array();
		$opts['Name']=$rows['orgname'];
		$opts['Address']=$rows['address'];
		$opts['Zipcode']=$rows['zipcode'];
		$opts['City']=$rows['city'];
		
		return $opts;
	}
	
	public function fetchSubOrgInfo( $id_isporg=0,$id_ispsuborg=0 )
	{
		if($id_isporg==0) $id_isporg=$this->session['id_isporg'];
		if($id_ispsuborg==0) $id_ispsuborg=$this->session['id_ispsuborg'];
		$param=array($id_isporg,$id_ispsuborg);
		$exec=$this->base->execute('get_suborginfo',$param);
		$rows=$this->base->fetch();
		
		$opts=array();
		$opts['Name']=$rows['suborgname'];
		$opts['Address']=$rows['address'];
		$opts['City']=$rows['city'];
		$opts['Phone']=$rows['phone'];
		
		return $opts;
	}
	
	public function checkRequiredFields( $fields )
	{
		foreach($fields as $key=>$val)
			if(strlen($val) == 0) 
			{
				return "ERROR - KEY: \"$key\" not filled";
				exit();
			}
		
		return null;
	}
	
	public function systemLog( $mess )
	{
		$logfile=LOGDIR.SYSLOG;
		$dat=date("d.m.y H:i:s");
		$usr=trim($this->session['username']);
		$acc=trim($this->session['acctype']);
		$org=trim($this->session['orgname']);
		$scr=$this->self();
		
		$logstr="$dat $scr:$org.$usr/$acc [$mess]\n";
		
		$this->writeFile($logfile,$logstr,true);
	}

        public function time2str($time)
        {
                $time = floor($time);
                if (!$time)
                        return "0 s";
                $d = $time/86400;
                $d = floor($d);
                if ($d){
                  if($d==1)
                      $str .= "$d day, ";
                  else
                      $str .= "$d days, ";
                  $time = $time % 86400;
                }

                $h = $time/3600;
                $h = floor($h);
                if ($h){
                        $str .= "$h".'h ';
                        $time = $time % 3600;
                }
                $m = $time/60;
                $m = floor($m);
                if ($m){
                        $str .= "$m".'min ';
                        $time = $time % 60;
                }
                if ($time)
                        $str .= "$time".'s';
                $str = ereg_replace(', $','',$str);

                return $str;
        }
        public function get_elapsed_time($time_start,$time_end,$units = 'seconds',$decimals = 2)
        {
                $divider['years']   = ( 60 * 60 * 24 * 365 );
                $divider['months']  = ( 60 * 60 * 24 * 365 / 12 );
                $divider['weeks']   = ( 60 * 60 * 24 * 7 );
                $divider['days']    = ( 60 * 60 * 24 );
                $divider['hours']   = ( 60 * 60 );
                $divider['minutes'] = ( 60 );
                $divider['seconds'] = 1;

                $elapsed_time = ( date("U",strtodate(( $time_end )) - strtodate( $time_start ) ) / $divider[$units] );
                $elapsed_time = sprintf( "%0.{$decimals}f", $elapsed_time );

                return $elapsed_time;
        }
        public function bytes2str($bytes)
        {
                $bytes=floor($bytes);
                if ($bytes > 536870912)
                        $str = sprintf("%5.0f Gb", $bytes/1073741824);
                else if ($bytes > 524288)
                        $str = sprintf("%5.0f Mb", $bytes/1048576);
                else
                        $str = sprintf("%5.0f Kb", $bytes/1024);

                return $str;
        }
        public function checkCIDR($CIDR)
        {
		list($base, $bits) = explode('/', $CIDR);
		list($a, $b, $c, $d) = explode('.', $base);
		if($a < 255 && $b < 255 && $c < 255 && $d < 255 && $bits <=32)
			return 1;
		return 0;
        }

}

?>
