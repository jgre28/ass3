<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 9/10/2018
 * Time: 12:33 PM
 */

class DB
{
    private $_username;
    private $_password;
    private $_host;
    private $_db;
    private $_conn;
    private $_connerr;

    //constructor
    function __construct()
    {
        $this->setParams();
        $this->connDB();
    }

    //Sets the parameters used to connect to the database
    public function setParams()
    {
        $this->_username = "s25099159";
        $this->_password = "monash00";
        $this->_host = "130.194.7.82";
        $this->_db = "s25099159";
    }

    public function connDB()
    {
        //turns off error reporting so potential database connection error can be captured
        error_reporting(E_ERROR);

        $this->_conn = new mysqli($this->_username, $this->_password, $this->_host, $this->_db);

        //turns error reporting back on
        error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

        //assign error number in case where error occurs
        if ($this->_conn->connect_errno) {
            $this->_connerr = $this->_conn->connect_error;
        }
    }

    //returns the connection
    public function getConn()
    {
        return $this->_conn;
    }

    //returns any error that occurred during database connection attempt
    public function getConnErr()
    {
        return $this->_connerr;
    }

    //checks if connection was successful
    public function checkConn()
    {
        if ($this->_connerr) {
            return false;
        } else {
            return true;
        }
    }

}
?>