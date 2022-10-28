<?php

/**
 * ORM FRN  
 * PHP Version 7.0.14
 * @package controllers
 * @author FRN
 * @version 1.0
 * @copyright 2017 FRN
 */

/**
 * Connection 
 * @package class
 * @author FRN
 */
 
class Connection{
	public $server;
	public $user;
	public $pass;
	public $err;
	public $con;
	public $port;
	public $st;
	
	/**
     * Connection Class Constructor.
     */
	function Connection (){
		
		$this->host='192.168.2.205';
		$this->user='centralizada';
		$this->pass='collect2015';
		$this->err="No hay error";
		$this->port=5432;
		$this->connect('vcentralizada');
	}
	
	
	/**
	 * Connect to a database
	 * @param string $db database name
	 * @return boolean
	 */
	function connect($db){
		
		if(!($this->con=pg_connect("host=$this->host port=$this->port dbname=$db user=$this->user password=$this->pass"))){
			$this->err="Error al conectar al servidor";
			return false;
		}else{
			return true;
			//conencted :D			
		}
	}
	
	/**
	 * get database error
	 * @return string
	 */
	function getErr(){
		return  $this->err;
	}
	
	/**
	 * get array from SQL result
	 * @param  postgres_result $result result from postgres::query
	 * @param  integer $t type of return
	 * @return array
	 */
	function getArray($result,$t=1){
		if($t==0)
			return @pg_fetch_array($result);
		elseif($t == 2)
			return @pg_fetch_all($result);
		else {
			$ar=array();
			if($arr=pg_fetch_array($result)){
				$i=0;
				while ( ($f = current($arr)) !== FALSE ) {
					if($t==1){
						if($i%2!=0)
							$ar[key($arr)]=$arr[key($arr)];
					}
					else{
						if($i%2==0)
							$ar[key($arr)]=$arr[key($arr)];
					}
							
					next($arr);
					$i++;
				}
			}
			return 	$ar;
		}
	}
	
	/**
	 * get pg_query from query
	 * @param  string $query
	 * @return pg_result
	 */
	function getQuery($query){
		$ss = @pg_query($this->con,$query);
		
		if(!$ss){
			return NULL;	
		}
		
		return $ss;			
	}
	
	/**
	 * get array from procedure query
	 * @param  string $procedure
	 * @return Array
	 */
	function getProcedure($procedure,$params,$type=0){
		
		if($type == 0){
			
			foreach ($params as $key => $vale) {
  				$params[$key] = '"'.$this->get_string($vale).'"';
			}
			
			$query = "select * from ".$procedure."('{".implode(",",$params)."}')";			
		}else{
			$query = "select * from ".$procedure."(".$params.")";
		}
		
		$this->st = $ss = @pg_query($this->con, $query);
		
		if(!$ss){
			return array(0);	
		}
		
		return pg_fetch_all($ss);			
	}
	
	public function exceuteQuerys($querys,$jump = false){
		
		pg_query("BEGIN");
		
		$i = 1;
		
		foreach ($querys as $query){
			
			$ss = @pg_query($this->con, $query);
			
			if(!$ss){
				
				$error = '(linea '.($jump?$i-1:$i).') '.pg_last_error($this->con);
				pg_query("ROLLBACK");
				return $error;
			}
			
			$i++;
		}
		
		pg_query("COMMIT");
		
		return '1';		
			
	}
	
	
	/**
	 * avoid sql injections
	 * @param  string $value string to convert
	 * @param  string $default default return
	 * @return string
	 */
	function get_string($value) {
		return addslashes(str_ireplace("'","",$value));
	}
	
}
?>