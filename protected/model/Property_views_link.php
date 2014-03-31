<?php

Doo::loadCore('db/DooModel');

class Property_views_link extends DooModel{
    /**
     * @var int Max length is 11.  index.
     */
    public $property_views_id;

    /**
     * @var int length is 11. index
     */
    public $property_id;     
    
    public $_table = 'property_views_link';
    public $_primarykey = 'property_id';
    public $_fields = array('property_id', 'property_views_id');
    
    function __construct(){
        parent::$className = __CLASS__;
    }        
    
    function add($property_views_id) {
        $p_l = new Property_views_link;
        $p_l->property_id = $_POST['property'];
        $p_l->property_views_id = $property_views_id;
        return $p_l->insert();  
    }   
    
    function deleteLink($id) {
        $p_l = new Property_views_link;       
        $p_l->property_views_id = $id;
        return $p_l->delete();
    } 
} 
?>