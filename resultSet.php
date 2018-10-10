<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 10/10/2018
 * Time: 1:32 PM
 */

class resultSet
{
    private $_results;

    function __construct($results)
    {
        $this->_results = $results;
    }

    //returns a single row from the result set into a data object
    function getNext($dataObject, $counter)
    {
        //acquires the current row based on the counter
        $row = $this->_results[$counter];

        foreach ($row as $key=>$value)
        {
            $dataObject->$key = $value;

        }
        return $dataObject;
    }

    //finds the number of rows in the current result set
    function rowCount()
    {
        $rowCount = sizeof($this->_results);
        return $rowCount;
    }
}

?>