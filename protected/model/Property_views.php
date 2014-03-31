<?php

Doo::loadCore('db/DooModel');

class Property_views extends DooModel{
    /**
     * @var int Max length is 11.  primary.
     */
    public $id;
    /**
     * @var int Max length is 11.  primary.
     */
    public $client;

    /**
     * @var int length is 4.
     */
    public $property;    

    /**
     * @var enum (like, offer, reject, unknown)
     */
    public $result;
    
    /**
     * @var datetime.
     */
    public $created;         
    
    public $validator;   
    
    public $_table = 'property_views';
    public $_primarykey = 'id';
    public $_fields = array('id', 'client', 'property', 'result', 'created');
    
    function __construct(){
        parent::$className = __CLASS__;  
        
        Doo::loadHelper('DooValidator');  
        $this->validator = new DooValidator();
    }
    
    function getByPost() {
        $pv = new Property_views;  
        $pv->client = $_POST['client'];
        $pv->property = $_POST['property'];
        return $pv->getOne();    
    }
    
    function add() {
        $pv = new Property_views;
        $pv->client = $_POST['client'];
        $pv->property = $_POST['property'];
        $pv->result = $_POST['result'];
        $pv->created = date('Y/m/d');
        return $pv->insert();    
    } 
    
    function refresh($id) {
        $pv = new Property_views;
        $pv->id = $id;                     
        $pv->result = $_POST['result']; 
        return $pv->update();
    }  
    
    function validateViews() {
        return $this->validator->validate($_POST, 'views');  
    }
    
    function getAllDashboard() {
        $pv = new Property_views; 
        return $pv->relate('Property');    
    }
    
    function deleteView($id) {         
        $pv = new Property_views;     
        $pv->id = $id;
        return $pv->delete();
    } 
} 
?>