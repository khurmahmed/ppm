<?php

Doo::loadCore('db/DooModel');

class Postcodes extends DooModel{
    /**
     * @var int Max length is 11.  index.
     */
    public $Postcode_ID;

    /**
     * @var tinytext
     */
    public $Pcode;     
    
    /**
     * @var var length is 15.
     */
    public $Grid_N;
    
    /**
     * @var var length is 15. 
     */
    public $Grid_E;
    
    /**
     * @var var length is 15. 
     */
    public $Latitude;
    
    /**
     * @var var length is 15. 
     */
    public $Longitude;
    
    public $_table = 'postcodes';
    public $_primarykey = 'Postcode_ID';
    public $_fields = array('Postcode_ID', 'Pcode', 'Grid_n', 'Grid_E', 'Latitude', 'Longitude');
    
    function __construct(){
        parent::$className = __CLASS__;
    } 
} 
?>