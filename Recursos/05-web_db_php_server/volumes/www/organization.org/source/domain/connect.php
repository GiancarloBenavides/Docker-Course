<?php

/** 
 * TODO-GNX
 * PHP Version 7.4
 * @package Base
 * @author Giancarlo
 * @version 1.0
 * @copyright 2020 GNC
 */

require_once("../config/messages.php");


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
        $databases = include("../config/databases.php");
        $this->error = False;
        $this->driver = $databases->driver;
        $this->type = $databases->debug;
        $this->prepare();
        $this->connection_string = $this->build($databases);
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
        } else {
            $this->state = "Open";
        }
    }

    /**
     * Build the connection string
     * @return string
     */
    function build(object $databases)
    {
        if ($this->driver) {
            $host = "host=" . $databases->host;
            $port = "port=" . $databases->port;
            $user = "user=" . $databases->user;
            $pass = "password=" . $databases->pass;
            $name = "dbname=" . $databases->name;
            $connection_string = implode(" ", array($host, $port, $user, $pass, $name));
        }
        $this->state = "Created";
        return $connection_string;
    }

    /**
     * Configure the connection
     * @return string
     */
    function prepare()
    {
        if ($this->type) {
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
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
