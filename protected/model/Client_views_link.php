<?php

Doo::loadCore('db/DooModel');

class Client_views_link extends DooModel{
    /**
     * @var int Max length is 11.  index.
     */
    public $client_views_id;

    /**
     * @var int length is 11. index
     */
    public $client_id;     
    
    public $_table = 'client_views_link';
    public $_primarykey = 'client_id';
    public $_fields = array('client_id', 'client_views_id');
    
    function __construct(){
        parent::$className = __CLASS__;
    }        
    
    function add($client_views_id) {
        $c_l = new Client_views_link;
        $c_l->client_id = $_POST['client'];
        $c_l->client_views_id = $client_views_id;
        return $c_l->insert();  
    }  
    
    function deleteLink($id) {
        $c_l = new Client_views_link;       
        $c_l->client_views_id = $id;
        return $c_l->delete();
    } 
} 
?>