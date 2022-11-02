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
 * Connect to a database.
 * 
 * The class allows to define the connection with a database
 * * __Methods:__ [open, _close_..].
 * 
 * @since 1.0.0
 */
class DataBaseConnection
{
    public $connection_string;
    public $resource;
    public $driver;
    public $type;
    public $error;
    public $state;


    /**
     * DataBaseConnection class constructor.
     */
    public function __construct()
    {
        $this->driver = DRIVER;
        $this->error = False;
        $this->type = $this->prepare();
        $this->connection_string = $this->build();
        $this->state = "Created";
        $this->open();
    }

    /**
     * Connect to a database
     * @return boolean
     */
    function open()
    {
        if (!($this->resource = pg_connect($this->connection_string))) {
            $this->error = DB_ERROR . pg_last_error();
            $this->state = "Close";
            return false;
        } else {
            $this->state = "Open";
            return true;
        }
    }

    /**
     * Build the connection string
     * @return string
     */
    function build()
    {
        if (DRIVER) {
            $driver_string = $this->driver . "_string";
            $connection_string = $GLOBALS[$driver_string];
        }
        return $connection_string;
    }

    /**
     * Configure the connection
     * @return string
     */
    function prepare()
    {
        if (DEBUG) {
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
            return "Debug";
        } else {
            return "Production";
        }
    }

    /**
     * get status of the connection to the database
     * @return string
     */
    function get_state()
    {
        return  $this->state;
    }

    /**
     * get database error
     * @return string
     */
    function get_error()
    {
        return  $this->error;
    }
}



// Debug
if (!count(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)) and DEBUG) {
    $DBC = new DataBaseConnection();
    echo "<br>\n[CONNECTION STATUS]: " . $DBC->get_state() . " " . $DBC->driver . " " . $DBC->type;
    if ($DBC->error) {
        echo "<br>\n[ERROR]: " . $DBC->error;
    } else {
        echo "<br>\n[RESOURCE TYPE]: " . get_resource_type($DBC->resource);
        echo "<br>\n[RESOURCE DUMP]:";
        echo "<br>\n" . var_dump($DBC->resource);
    }
}
