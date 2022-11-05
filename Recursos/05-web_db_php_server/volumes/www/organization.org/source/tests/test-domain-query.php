<?php

require_once("../domain/connect.php");
require_once("../domain/query.php");


// Debug
if (!count(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)) and DEBUG) {
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

