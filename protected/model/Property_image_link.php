<?php

Doo::loadCore('db/DooModel');

class Property_image_link extends DooModel{
    /**
     * @var int Max length is 11.  index.
     */
    public $property_image_id;

    /**
     * @var int length is 11. index
     */
    public $property_id;     
    
    public $_table = 'property_image_link';
    public $_primarykey = 'property_id';
    public $_fields = array('property_id', 'property_image_id');
    
    function __construct(){
        parent::$className = __CLASS__;
    }        
    
    function add($property_id, $property_image_id) {
        $p_l = new Property_image_link;
        $p_l->property_id = $property_id;
        $p_l->property_image_id = $property_image_id;
        return $p_l->insert();  
    }   
        
    function deleteLink($id) {
        $p_l = new Property_image_link;        
        $p_l->property_image_id = $id;
        return $p_l->delete();
    } 
} 
?>