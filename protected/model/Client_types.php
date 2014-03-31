<?php

Doo::loadCore('db/DooModel');

class Client_types extends DooModel{
    /**
     * @var int Max length is 11.  primary.
     */
    public $id;

    /**
     * @var varchar Max length is 150.
     */
    public $name;    
    
    public $_table = 'client_types';
    public $_primarykey = 'id';
    public $_fields = array('id', 'name');
    
    function __construct(){
        parent::$className = __CLASS__;
    }
    
    function getById($id) {
        $c_t = new Client_types;
        $c_t->id = $id;
        return $c_t = $c_t->getOne();    
    }
    
    function getByName() {
        $c_t = new Client_types;
        $c_t->name = $_POST['client_type'];
        $c_t = $c_t->getOne();
        if(!empty($c_t->id)) return $c_t->id;
        return false;
    }
    
    
} 
?>