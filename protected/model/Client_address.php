<?php

Doo::loadCore('db/DooModel');

class Client_address extends DooModel{
    /**
     * @var int Max length is 11.  primary.
     */
    public $id;

    /**
     * @var varchar Max length is 10.
     */
    public $postcode;

    /**
     * @var varchar Max length is 100.
     */
    public $city;

    /**
     * @var varchar Max length is 255.
     */
    public $line_1;

    /**
     * @var varchar Max length is 255.
     */
    public $line_2;     
    
    public $_table = 'client_address';
    public $_primarykey = 'id';
    public $_fields = array('id', 'postcode', 'city', 'line_1', 'line_2');
    
    function __construct(){
        parent::$className = __CLASS__;
    }
    
    function getClientById($id) {
        return $this->db()->getOne('Client_address', array('where'=>'id = ?', 'param'=>array($id), 'limit'=>'1'));
    }
    
    function add($client_id) {
        $c_a = new Client_address;
        $c_a->id = $client_id;
        $c_a->postcode = $_POST['postcode'];
        $c_a->city = $_POST['city'];
        $c_a->line_1 = $_POST['line_1'];
        $c_a->line_2 = $_POST['line_2'];
        return $c_a->insert();  
    }
    
    function refresh() {
        $c_a = new Client_address;
        $c_a->id = $_POST['id'];
        $c_a->postcode = $_POST['postcode'];
        $c_a->city = $_POST['city'];
        $c_a->line_1 = $_POST['line_1'];
        $c_a->line_2 = $_POST['line_2'];
        return $c_a->update();  
    }
    
    function deleteClient() {
        $c_a = new Client_address;       
        $c_a->id = $_POST['client'];
        return $c_a->delete();
    }     
} 
?>