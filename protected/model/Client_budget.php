<?php

Doo::loadCore('db/DooModel');

class Client_budget extends DooModel{
    /**
     * @var int Max length is 11.  primary.
     */
    public $id;

    /**
     * @var int is 7.
     */
    public $from;

    /**
     * @var int is 7.
     */
    public $to;     
    
    public $_table = 'client_budget';
    public $_primarykey = 'id';
    public $_fields = array('id', 'from', 'to');
    
    function __construct(){
        parent::$className = __CLASS__;
    }
    
    function getClientById($id) {
        return $this->db()->getOne('Client_budget', array('where'=>'id = ?', 'param'=>array($id), 'limit'=>'1'));
    }
    
    function add($client_id) {
        $c_b = new Client_budget;
        $c_b->id = $client_id;
        $c_b->from = $_POST['min_price'];
        $c_b->to = $_POST['max_price'];
        return $c_b->insert();
    }
    
    function refresh() {
        $c_b = new Client_budget;  
        $c_b->id = $_POST['id'];        
        $c_b->from = $_POST['min_price'];
        $c_b->to = $_POST['max_price'];  
        return $c_b->update();  
    }
    
    function deleteClient() {
        $c_b = new Client_budget;       
        $c_b->id = $_POST['client'];
        return $c_b->delete();
    } 
} 
?>