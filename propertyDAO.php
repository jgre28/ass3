<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 9/10/2018
 * Time: 11:58 AM
 */


class propertyDAO
{
    private $_propertyID;
    private $_unitNum;
    private $_streetNum;
    private $_street;
    private $_suburb;
    private $_state;
    private $_postcode;
    private $_sellerID;
    private $_listingDate;
    private $_listingPrice;
    private $_saleDate;
    private $_salePrice;
    private $_imageName;
    private $_description;
    private $_propertyType;
    private $_conn;


    //constructor
    function __construct($conn)
    {
        $this->_conn = $conn;
    }






}
?>