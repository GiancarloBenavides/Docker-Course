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
	public $raw_query;
	public $name_prepared;
	public $db_resource;
	public $result;
	public $params;
	public $type;
	public $error;
	public $state;


	/**
	 * Connection Class Constructor.
	 */
	public function __construct($db, string $raw_query, string $query_type = "custom", string $query_name = "my_query", array $query_params = [])
	{
		$this->error = false;
		$this->type = $query_type;
		$this->name = $query_name;
		$this->params = $query_params;
		$this->db_resource = $db;
		$this->raw_query = $raw_query;
		$this->state = "Created";
		$this->clean_query = $this->prepare($raw_query);
		$this->execute();
	}

	/**
	 * get query error
	 * @return boolean
	 */
	function execute()
	{
		if ($this->type == "defined") {
			if (!($this->result = pg_execute($this->db_resource, $this->name_prepared, $this->params))) {
				$this->error = QUERY_ERROR . pg_last_error();
				$this->state = "Lack";
			} else {
				$this->state = "Acquired";
			}
		} else {
			if (!($this->result = pg_query($this->db_resource, "{$this->clean_query}"))) {
				$this->error = QUERY_ERROR . pg_last_error();
				$this->state = "Lack";
			} else {
				$this->state = "Acquired";
			}
		}
	}

	/**
	 * get query error
	 * @return string
	 */
	function prepare(string $raw_query)
	{
		if ($this->type == "prepared") {
			$query = pg_prepare($this->db_resource, $this->query_name, $raw_query);
		} else {
			$query = pg_escape_string($raw_query);
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
	function define($name, $query)
	{
		pg_prepare($this->db_resource, $name, $query);



		$array = array();
		while ($row = pg_fetch_array($this->result)) {

			$array[key($row)] = $row[key($row)];
		}
	}


	/**
	 * get array from SQL result
	 * @param  postgres_result $result result from postgres::query
	 * @param  integer $t type of return
	 * @return array
	 */
	function get_data()
	{
		if ($this->result) {
			$array = array();
			while ($row = pg_fetch_array($this->result)) {
				$array[key($row)] = $row[key($row)];
			}
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
	$query_raw = "SELECT now();";
	$qc = new DataBaseQuery($dbc->resource, $query_raw);
	echo "<br>\n" . '[CONNECTION STATUS]: ' . $dbc->get_state() . " " . $dbc->driver . " " . $dbc->type;
	if ($dbc->get_state() == "Open") {
		echo "<br>\n" . '[QUERY STATUS]: ' . $qc->get_state();
		if ($qc->error) {
			echo "<br>\n" . '[ERROR]: ' . $query->error;
		} else {
			echo "<br>\n" . '[RESOURCE TYPE]: ' . get_resource_type($qc->result);
			echo "<br>\n" . '[RESULT]: ' . pg_fetch_row($qc->result)[0];
		}
	}
}
