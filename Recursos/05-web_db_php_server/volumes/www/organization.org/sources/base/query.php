<?php

/** 
 * TODO-GNX
 * PHP Version 7.4
 * @package Base
 * @author Giancarlo
 * @version 1.0
 * @copyright 2020 GNC
 */

require_once("../conf.d/conn.php");
require_once("../conf.d/messages.php");


/**
 * Query to a database.
 * 
 * The class allows defining queries to the database
 * * __Methods:__ [execute ..].
 * 
 * @since 1.0.0
 */
class DataBaseQuery
{
	public $clean_query;
	public $name_prepared;
	public $resource;
	public $params;
	public $type;
	public $error;
	public $state;


	/**
	 * Connection Class Constructor.
	 */
	public function __construct($db, string $raw_query, string $query_type = "custom", string $query_name = "my_query", array $query_params = [])
	{
		$this->error = NOT_QUERY_ERROR;
		$this->type = $query_type;
		$this->name = $query_name;
		$this->params = $query_params;
		$this->state = "Created";
		$this->clean_query = $this->prepare($db, $raw_query, $query_name);
		$this->resource = $this->execute($db, $this->clean_query);
	}

	/**
	 * get query error
	 * @return boolean
	 */
	function execute($db, string $query)
	{
		if ($this->type == "defined") {
			if (!($this->resource = pg_execute($db, $this->name_prepared, $this->params))) {
				$this->error = QUERY_ERROR . pg_last_error();
				$this->state = "Lack";
				return false;
			} else {
				$this->state = "Acquired";
				return true;
			}
		} else {
			if (!($this->resource = pg_query($db, $query))) {
				$this->error = QUERY_ERROR . pg_last_error();
				$this->state = "Lack";
				return false;
			} else {
				$this->state = "Acquired";
				return true;
			}
		}
	}

	/**
	 * get query error
	 * @return string
	 */
	function prepare($db, string $raw_query)
	{
		if ($this->type == "prepared") {
			$query = pg_prepare($db, $this->query_name, $raw_query);
		} else {
			$query = pg_escape_literal($raw_query);
		}
		$this->state = "Prepared";
		return $query;
	}

	/**
	 * get status of the query
	 * @return string
	 */
	function get_state()
	{
		return  $this->state;
	}

	/**
	 * get query error
	 * @return string
	 */
	function get_error()
	{
		return  $this->error;
	}


	/**
	 * get array from SQL result
	 * @param  postgres_result $result result from postgres::query
	 * @param  integer $t type of return
	 * @return array
	 */
	function getArray($result, $t = 1)
	{
		if ($t == 0)
			return @pg_fetch_array($result);
		elseif ($t == 2)
			return @pg_fetch_all($result);
		else {
			$ar = array();
			if ($arr = pg_fetch_array($result)) {
				$i = 0;
				while (($f = current($arr)) !== FALSE) {
					if ($t == 1) {
						if ($i % 2 != 0)
							$ar[key($arr)] = $arr[key($arr)];
					} else {
						if ($i % 2 == 0)
							$ar[key($arr)] = $arr[key($arr)];
					}

					next($arr);
					$i++;
				}
			}
			return 	$ar;
		}
	}


	/**
	 * get array from procedure query
	 * @param  string $procedure
	 * @return Array
	 */
	function getProcedure($procedure, $params, $type = 0)
	{

		if ($type == 0) {

			foreach ($params as $key => $vale) {
				$params[$key] = '"' . $this->get_string($vale) . '"';
			}

			$query = "select * from " . $procedure . "('{" . implode(",", $params) . "}')";
		} else {
			$query = "select * from " . $procedure . "(" . $params . ")";
		}

		$this->st = $ss = @pg_query($this->con, $query);

		if (!$ss) {
			return array(0);
		}

		return pg_fetch_all($ss);
	}

	public function exceuteQuerys($querys, $jump = false)
	{

		pg_query("BEGIN");

		$i = 1;

		foreach ($querys as $query) {

			$ss = @pg_query($this->con, $query);

			if (!$ss) {

				$error = '(linea ' . ($jump ? $i - 1 : $i) . ') ' . pg_last_error($this->con);
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
	function get_string($value)
	{
		return addslashes(str_ireplace("'", "", "Is your name O'Reilly?"));
	}
}



// Debug
if (!count(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)) and DEBUG) {
	require_once("./connection.php");
	$dbc = new DataBaseConnection();
	$query = new DataBaseQuery($dbc, "SELECT COUNT(*) FROM [database_tables]");
	echo '[CONNECTION STATUS]: ' . $dbc->get_state() . " " . $dbc->driver . " " . $dbc->type;
	echo "<br>\n";
	echo '[QUERY STATUS]: ' . $query->get_state();

	// echo '[ERROR]: ' . $query->error;
	// echo "<br>\n";
	// echo '[RESOURCE TYPE]: ' . get_resource_type($query->resource);
	// echo "<br>\n";
	// echo var_dump($query->resource);
}
