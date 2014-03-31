<?php

Doo::loadCore('db/DooModel');

class Property extends DooModel{
    /**
     * @var int Max length is 11.  primary.
     */
    public $id;

    /**
     * @var int length is 4.
     */
    public $client;

    /**
     * @var int length is 11.
     */
    public $postcode;

    /**
     * @var varchar Max length is 50.
     */
    public $city;

    /**
     * @var varchar Max length is 50.
     */
    public $country;

    /**
     * @var varchar Max length is 50.
     */
    public $town;

    /**
     * @var varchar Max length is 255.
     */
    public $address_line;
    
     /**
     * @var int 7.
     */
    public $asking_price; 

	/**
     * @var datetime.
     */
    public $geo_lat;

	/**
     * @var float 2,6.
     */
    public $geo_long;

	/**
     * @var float 2,6.
     */
    public $created;     
    
    public $validator;   
    
    public $_table = 'property';
    public $_primarykey = 'id';
    public $_fields = array('id', 'client', 'postcode', 'city', 'country', 'town', 'address_line', 'asking_price', 'geo_lat', 'geo_lat', 'created');
    
    function __construct(){
        parent::$className = __CLASS__;
        
        Doo::loadHelper('DooValidator');  
        $this->validator = new DooValidator();
    }
    
    function getById($id) {
        $property = new Property;
        $property->id = $id;
        return $property->relateMany(array('Property_image'));
    }   
    
    function getDeleteItems() {
        $property = new Property;
        $property->id = $_POST['property'];
        return $property->relateMany(array('Property_image', 'Property_views'));
    }
    
    function search() {
        $property = new Property;
        $val = $_POST['search'];
        $result = $property->relateMany(array('Property_image'), array('Property_image'=>array('where'=>'address_line LIKE ? OR postcode LIKE ?', 'param'=>array("%$val%", "%$val%"))));
        $text = '';                          
        if($result) {
            foreach($result as $p) {
                $text .= "<li class='result' id='p-$p->id'>$p->address_line $p->postcode</li>";
            }
        }       
        return $text;
    }
    
    function getAllIdAddress() {
        $property = new Property;
        return $property->find(array('select'=>'id, address_line'));
        
    }
    
    function getAllDashboard() {
        $property = new Property;                      
        return $property->relateMany(array('Property_views', 'Property_image'));                                          
    }
    
    function getAll() {
        $property = new Property;                        
        return $property->relateMany(array('Property_image'));    
    }
    
    function validateImage($ext) {
        return preg_match('/^(jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF)$/', $ext); 
    }
    
    function validateDelete() {
        return $this->validator->validate($_POST, 'isProperty');  
    }
    
    function add($lat, $long) {
        $property = new Property;
        $property->client = $_POST['client']; 
        $property->postcode = $_POST['postcode'];
        $property->city = $_POST['city'];
        $property->country = $_POST['country'];
        $property->town = $_POST['town'];
        $property->address_line = $_POST['address_line'];
        $property->asking_price = $_POST['asking_price'];
        $property->geo_lat = $lat;
        $property->geo_long = $long;
        $property->created = date('Y/m/d');
        return $property->insert();
    } 
    
    function refresh($lat, $long) {
        $property = new Property;     
        $property->id = $_POST['id'];   
        $property->client = $_POST['client']; 
        $property->postcode = $_POST['postcode'];
        $property->city = $_POST['city'];
        $property->country = $_POST['country'];
        $property->town = $_POST['town'];
        $property->address_line = $_POST['address_line'];
        $property->asking_price = $_POST['asking_price'];
        $property->geo_lat = $lat;
        $property->geo_long = $long;  
        return $property->update();  
    }
    
    function validateProperty() {
        return $this->validator->validate($_POST, 'property');  
    }
    
    function validatePostcode() {
        return $this->validator->validate($_POST, 'postcode');  
    }
    
    function validateSearch() {
        return $this->validator->validate($_POST, 'search');  
    }
    
    function distance($lat1, $lon1, $lat2, $lon2) {

      $theta = $lon1 - $lon2;
      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      $dist = acos($dist);
      $dist = rad2deg($dist);
      $miles = $dist * 60 * 1.1515;  
      return $miles;
    }  
    
    function deleteProperty() {
        $p = new Property;       
        $p->id = $_POST['property'];
        return $p->delete();
    }
} 
?>