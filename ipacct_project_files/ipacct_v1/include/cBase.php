<?php

require_once("cSystem.php");

class cBase extends cSystem
{
	private $conn;
	private $stmt;
	private $error = array();
	
        private $Query = array();
	
	public function __construct( $screen=false )
	{	
		parent::__construct();
		if($screen==false) $screen=$this->self();
		
		$queryfile=QUERYDIR.$screen.SQL;
		$this->queryOpenFile($queryfile);
		
		$this->connect();
	}
	
	private function connect()
	{
		$_type=$this->getGlobal("dbtype");
		$_name=$this->getGlobal("dbname");
		$_host=$this->getGlobal("dbhost");
		$_user=$this->getGlobal("dbuser");
		$_pass=$this->getGlobal("dbpass");
		
		if($_host)
			$_conn="$_type:dbname=$_name;host=$_host";
		else
			$_conn="$_type:dbname=$_name";
		
		$attr=PDO::ATTR_ERRMODE;
		$excp=PDO::ERRMODE_EXCEPTION;
		
		try {
			$this->conn = new PDO($_conn,$_user,$_pass);
			$this->conn->setAttribute($attr,$excp);
		} catch(PDOException $e) {
			$this->dumpBaseError(null,null,$e->getMessage());
			die($e->getMessage());
		}
	}
	
	private function queryOpenFile( $queryfile ) 
	{
		$pattern="(#.*\n|\r|\n)";
		foreach(file($queryfile) as $line)
			$chunk.=ereg_replace($pattern," ",$line);
		$chunk=ereg_replace(";$",null,$chunk);
		
                $index=0;
                foreach(split(";",trim($chunk)) as $val)
                {
                        if(ereg("^!",trim($val)))
                        {
                                $chunks=split(" ",trim($val));
				$chunks[0]=trim($chunks[0]);
                                $key=ereg_replace("!",null,$chunks[0]);
                                $val=ereg_replace($chunks[0],null,$val);
                                $this->Query[$key]=trim($val);
                        } else $this->Query[$index++]=trim($val);
                }
	}
	
	public function begin()
	{
		$this->conn->beginTransaction();
	}
	
	public function commit()
	{
		$this->conn->commit();
	}
	
	public function rollBack()
	{
		$this->conn->rollBack();
	}
	
	public function getColumnNames( $key )
	{
		$queryline=split("\n",$this->fetchQuery($key));
		foreach($queryline as $num => $line)
			if(ereg("\?",$line)) $queryline[$num]=null;
		$query=implode(" ",$queryline);
		$exec=$this->executeDirect($query);
		
		if($exec==0)
			return $this->stmt->getColumnMeta(0);
		else
			return $exec;
	}
	
	public function lastInsertId( $seq )
	{
		return $this->conn->lastInsertId($seq);
	}

	public function rowCount()
	{
		return $this->stmt->rowCount();
	}

	public function execute( $key,$param=null )
	{
		return $this->executeDirect($this->Query[$key],$param);
	}
	
	public function executeDirect( $query,$param=null )
	{
		try {
			$this->stmt=$this->conn->prepare($query);
			if(is_array($param))
				$this->stmt->execute($param);
			else
				$this->stmt->execute();
			return 0;
		} catch(PDOException $e) {
			$this->error=$this->stmt->errorInfo();
			$this->dumpBaseError($query,$param,$e->getMessage());
			return $this->error[0];
		}
	}
	
	private function dumpBaseError( $query,$param,$mess )
	{
		$filedump=$this->getGlobal("filedump");
		$now=date("r");
		
		if(is_array($param))
		{
			$i=0;
			foreach(explode("?",$query) as $val)
			if(strlen(trim($val))>0)
				$repquery.=$val.$param[$i++];
		} else $repquery=$query;
		
		$text="$now\n$mess\n\n$repquery\n\n";
		$this->error[3]=nl2br($text);
		
		if($filedump)
		{
			$screen=$this->self();
			$dumpfile=DUMPDIR.$screen.SQL;
			$this->writeFile($dumpfile,$text,true);
		}
	}
	
	public function getError( $index )
	{
		return $this->error[$index];
	}
	
	public function fetch( $method=false )
	{
		if($method)
			return @$this->stmt->fetch(PDO::FETCH_NUM);
		else
			return @$this->stmt->fetch(PDO::FETCH_ASSOC);
	}
		
	public function fetchAll( $method=false )
	{
		if($method)
			return @$this->stmt->fetchAll(PDO::FETCH_NUM);
		else
			return @$this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
		
	public function fetchQuery( $key=false )
	{
		if(strlen($key)>0)
			return $this->Query[$key];
		else
			return $this->Query;
	}
}

?>

