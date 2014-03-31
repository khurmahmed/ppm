<?php

Doo::loadCore('db/DooModel');

class Client extends DooModel{    
    /**
     * @var int Max length is 11.  primary.
     */
    public $id;

    /**
     * @var int length is 4.
     */
    public $type;

    /**
     * @var int length is 11.
     */
    public $address;

    /**
     * @var varchar Max length is 50.
     */
    public $phone;

    /**
     * @var varchar Max length is 50.
     */
    public $firstname;      

    /**
     * @var varchar Max length is 50.
     */
    public $lastname;

    /**
     * @var varchar Max length is 255.
     */
    public $email;
    
     /**
     * @var datetime.
     */
    public $created;     
    
    public $validator;      
    
    public $_table = 'client';
    public $_primarykey = 'id';
    public $_fields = array('id', 'type', 'address', 'phone', 'firstname', 'lastname', 'email', 'created');
    
    function __construct(){
        parent::$className = __CLASS__;   
        
        Doo::loadHelper('DooValidator');  
        $this->validator = new DooValidator(); 
    }
    
    function getById($id) {
        $client = new Client;
        $client->id = $id;
        return $client->relateMany(array('Client_budget', 'Client_address'));
    }
    
    function getDeleteItems() {
        $client = new Client;
        $client->id = $_POST['client'];
        return $client->relateMany(array('Client_budget', 'Client_address', 'Property_views'));
    }

    function getAll() {
        $client = new Client;
        return $client->relateMany(array('Client_budget', 'Client_address'));
    }
    
    function getAllDashboard() {
        $client = new Client;                                             
        return $client->relateMany(array('Client_budget', 'Client_address'), array('Client_budget'=>array('limit'=>'10', 'custom'=>'ORDER BY created DESC')));  
    }
    
    function getAllIds() {
        $client = new Client;
        return $client->find(array('select'=>'id, firstname, lastname'));
    }
	
    function validateClient() {
        return $this->validator->validate($_POST, 'client');  
    }
       
    function validateClientSearch() {    
        return $this->validator->validate($_POST, 'clientSearch');  
    }
    
    function validateSearch() {
        return $this->validator->validate($_POST, 'search');  
    }    
    
    function validateDelete() {
        return $this->validator->validate($_POST, 'isClient');  
    }
    
    function add($type_id) {
        $client = new Client;
        $client->type = $type_id;
        $client->firstname = $_POST['firstname'];
        $client->lastname = $_POST['lastname'];
        $client->email = $_POST['email'];
        $client->phone = $_POST['phone'];
        $client->created = date('Y/m/d H:i:s');
        return $client->insert();
    }
    
    function refresh($type_id) {
        $client = new Client;   
        $client->id = $_POST['id'];     
        $client->type = $type_id;
        $client->firstname = $_POST['firstname'];
        $client->lastname = $_POST['lastname'];
        $client->email = $_POST['email'];
        $client->phone = $_POST['phone'];  
        $client->created = date('Y/m/d H:i:s');      
        return $client->update();  
    }
    
    function search() {
        $client = new Client;
        $val = $_POST['search'];
        $result = $client->find(array('where'=>'type = ? AND (firstname LIKE ? OR lastname LIKE ?)', 'param'=>array(2, "%$val%", "%$val%")));
        $text = '';
        if($result) {
            foreach($result as $c) {
                $text .= "<li class='result' id='c-$c->id'>$c->firstname $c->lastname</li>";
            }
        }
        return $text;
    }
    
    function searchClient() {
        $client = new Client;
        $val = $_POST['client_search'];
        $result = $client->find(array('where'=>'firstname LIKE ? OR lastname LIKE ? OR phone LIKE ? OR email LIKE ?', 'param'=>array("%$val%", "%$val%","%$val%", "%$val%")));
        $text = '';
        if($result) {
            foreach($result as $c) {
                $text .= "<li class='result' id='c-$c->id'>$c->firstname $c->lastname $c->phone $c->email</li>";
            }
        }
        return $text;
    }
    
    function deleteClient() {
        $c = new Client;       
        $c->id = $_POST['client'];
        return $c->delete();
    } 
} 
?>