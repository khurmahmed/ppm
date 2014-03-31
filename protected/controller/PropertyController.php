<?php

Doo::loadController('CoreController');
class PropertyController extends CoreController {

	function index() {
		
        $property = Doo::loadModel('Property', true);
        $data['properties'] = $property->getAll();
        $this->_setPage('property_index', $data);
	}

	function add() {
		
        $this->_setPage('property_add'); 
	}

	function edit() {
		
        $property_id = $this->params['property_id'];
        $property = Doo::loadModel('Property', true);
        $client = Doo::loadModel('Client', true);           
        $data['property'] = $property->getById($property_id);
        
        if($data['property']) {   
            $data['clients'] = $client->getAllIds();                                             
            $this->_setPage('property_edit', $data);
        } else $this->_redirect ('/property');
	}

	function addProperty() {
		
        $p = Doo::loadModel('Property', true);
        $client = Doo::loadModel('Client', true);
        $p_i = Doo::loadModel('Property_image', true);  
        $p_l = Doo::loadModel('Property_image_link', true);   
                                                          
        $validateFail = $p->validateProperty();       
        
        if($validateFail) echo json_encode(array('error'=>$validateFail));
        else { 
            $postcode = $this->getGeoLocation(); 
            
            if(!$postcode) {
                echo json_encode(array('postcode_error'=>'Could not associate postcode'));
                return false;    
            }                                   
            
            $lat = $postcode->Latitude;  
            $long = $postcode->Longitude;   
            
            $property_id = $p->add($lat, $long);          
            $imageLoc = Doo::conf()->SITE_PATH.'static/img/';
            
            if($_POST['images'] > 0 && $property_id) {    
                for($i=0; $i<$_POST['images']; $i++) {      
                    if(isset($_POST['image_'.$i]) && file_exists($imageLoc.$_POST['image_'.$i])) $p_i_id = $p_i->add($property_id, $_POST['image_'.$i]);
                    if($p_i_id) $p_l->add($property_id, $p_i_id);
                }
            } else {
                $p_i_id = $p_i->add($property_id, 'temp.jpg');
                if($p_i_id) $p_l->add($property_id, $p_i_id);
            }       
        
            if($property_id) echo json_encode(array('insert'=>'1'));
            else echo json_encode(array('error'=>'1'));
        } 
	}

	function editProperty() {
		
        $p = Doo::loadModel('Property', true);
        $p_i = Doo::loadModel('Property_image', true);  
        $p_l = Doo::loadModel('Property_image_link', true);    
        $validateFail = $p->validateProperty();
        
        if($validateFail) echo json_encode(array('error'=>$validateFail));
        else {                      
            
            $postcode = $this->getGeoLocation(); 
            
            if(!$postcode) {
                echo json_encode(array('postcode_error'=>'Could not associate postcode'));
                return false;    
            }                                   
            
            $lat = $postcode->Latitude;  
            $long = $postcode->Longitude;
            
            $p->refresh($lat, $long);
            $property_id = $_POST['id']; 
            $property = $p->getById($property_id);
            
            $count = count($property[0]->Property_image);         
            $imageLoc = Doo::conf()->SITE_PATH.'static/img/';
            
            if($_POST['images'] > $count) {    
                for($i=$count; $i<$_POST['images']; $i++) {      
                    if(isset($_POST['image_'.$i]) && file_exists($imageLoc.$_POST['image_'.$i])) $p_i_id = $p_i->add($property_id, $_POST['image_'.$i]);
                    if($p_i_id) $p_l->add($property_id, $p_i_id);
                }
            }              
            
            if($property_id) echo json_encode(array('update'=>'1'));
            else echo json_encode(array('error'=>'1'));
        }
	}

    function saveImage() { 
                                   
        $imageLoc = Doo::conf()->SITE_PATH.'static/img/';
        $property = Doo::loadModel('Property', true);                 
        $file = $_FILES['file'];
        if($file['error'] < 1) {
            $time = time();                                    
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $image_name = $imageLoc.$time;                
            
            if(!$property->validateImage($ext)) $this->_error = 1;
            
            if($this->_error === 0) {
                Doo::loadHelper('DooGdImage');
                $image = new DooGdImage;
                if($image->createThumb($file['tmp_name'], 100, 100, $image_name)) { 
                    $image->createThumb($file['tmp_name'], 600, 400, $image_name.'_medium');
                    $image->createThumb($file['tmp_name'], 1200, 800, $image_name.'_large');
                    echo $time.'.jpg';
                } else echo 2;  
            } else echo 1;        
        }    
    }
    
    function getByDistance() {
        
        $property = Doo::loadModel('Property', true);
          
        $validateFail = $property->validatePostcode();
        
        if($validateFail) {
            echo json_encode(array('error'=>$validateFail));
            return false;    
        }
        
        $distance = $_POST['distance'];
        
        $postcode = $this->getGeoLocation(); 
        if(!$postcode) {
            echo json_encode(array('postcode_error'=>'<li>Could not associate postcode</li>'));
            return false;    
        }                                   
         
        $properties = $property->getAll();
        $lat = $postcode->Latitude;  
        $long = $postcode->Longitude;
        
        $p_array = array();
        $distance_array = array();
        
        foreach($properties as $p) {
            $x = $property->distance($lat, $long, $p->geo_lat, $p->geo_long);
            $x = floor($x);   
            $p_array[] = $p;
            $distance_array[] = $x;   
        }                         
        array_multisort($distance_array, $p_array); 
        
        $text = '';
        $i = 0;
        for($i=0;$i<count($p_array);$i++) { 
            if($distance_array[$i] > $distance) break;
            $a = $p_array[$i]->address_line;
            $d = $distance_array[$i];
            $id = $p_array[$i]->id; 
            $i++;
            $text .= "<a href='/property/edit/$id'><li>$a</li></a>";    
        }
        
        if($i > 0) echo json_encode(array('result'=>$text));
        else echo json_encode(array('error_empty'=>'<li>Sorry none found</li>'));
        
    }   
    
    function getGeoLocation() {
        
        $p = $_POST['postcode'];        
        
        $post = (strlen($p) > 3? substr($p, 0, 3):$p); 
        global $db2; 
        return $postcode = $db2->getOne('Postcodes', array('where'=>'Pcode LIKE ?', 'param'=>array("%$post%")));                                                        
    } 
    
    function search() {
         
        $property = Doo::loadModel('Property', true);
        $validateFail = $property->validateSearch();
         
        if($validateFail) {
            echo json_encode(array('error'=>$validateFail));
            return false;
        }
        
        $result = $property->search();
        if($result) echo json_encode(array('result'=>$result));
        else echo json_encode(array('error_none'=>'<li>Sorry no properties found.</li>'));
    }
    
    function delete() {
        
        $property = Doo::loadModel('Property', true);
        $c_vl = Doo::loadModel('Client_views_link', true); 
        $p_vl = Doo::loadModel('Property_views_link', true); 
        $p_v = Doo::loadModel('Property_views', true);       
        $p_il = Doo::loadModel('Property_image_link', true);     
        $p_i = Doo::loadModel('Property_image', true);
        $validateFail = $property->validateDelete();
        
        if($validateFail) {
            echo json_encode(array('error'=>$validateFail));
            return false;
        }
        
        $result = $property->getDeleteItems();  
        
        if($result) {                 
            if($result[0]->Property_image) {     
                foreach($result[0]->Property_image as $pi) {
                    $p_il->deleteLink($pi->id); 
                    $p_i->deleteImage($pi->id); 
                    $imageLoc = Doo::conf()->SITE_PATH.'static/img/';
                    if(file_exists($imageLoc.$pi->filename)) {
                        $filename = substr($pi->filename, 0, -4);  
                        unlink($imageLoc.$pi->filename);
                        unlink($imageLoc.$filename.'_medium.jpg');   
                        unlink($imageLoc.$filename.'_large.jpg');
                    }
                    $imageLoc = Doo::conf()->SITE_PATH.'static/img/';                  
                }    
            }
            
            if($result[0]->Property_views) {     
                foreach($result[0]->Property_views as $pv) {
                    $c_vl->deleteLink($pv->id);    
                    $p_vl->deleteLink($pv->id); 
                    $p_v->deleteView($pv->id);  
                }    
            }                   
            $property->deleteProperty();
        }         
        echo json_encode(array('id'=>$_POST['property']));                
    
    }
}
?>