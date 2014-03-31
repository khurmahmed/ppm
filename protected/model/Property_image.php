<?php

Doo::loadCore('db/DooModel');

class Property_image extends DooModel{
    /**
     * @var int Max length is 11.  primary.
     */
    public $id;

    /**
     * @var int length is 4.
     */
    public $order;

    /**
     * @var int length is 11.
     */
    public $property;

    /**
     * @var varchar Max length is 36.
     */
    public $filename;
    
    /**
     * @var datetime.
     */
    public $created;     
    
    public $_table = 'property_image';
    public $_primarykey = 'id';
    public $_fields = array('id', 'order', 'property', 'filename', 'created');
    
    function __construct(){
        parent::$className = __CLASS__;
    }       
    
    function add($property, $filename) {
        $p_i = new Property_image;
        $p_i->property = $property;
        $p_i->filename = $filename;   
        $p_i->created = date('Y/m/d');
        return $p_i->insert();
    }
    
    function deleteImage($id) {
        $p_i = new Property_image;        
        $p_i->id = $id;
        return $p_i->delete();
    } 
} 
?>