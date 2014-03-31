<?php

Doo::loadController('CoreController');
class ClientController extends CoreController {

	function index() {
		
            $client = Doo::loadModel('Client', true);
            $data['clients'] = $client->getAll();
            if(!$data['clients']) $this->_redirect('/client/add');                                 
            $this->_setPage('client_index', $data);
	}

	function add() {
		                                
            $this->_setPage('client_add');
	}

	function edit() {
            
            $client_id = $this->params['client_id'];
            $client = Doo::loadModel('Client', true);
            $client_type = Doo::loadModel('Client_types', true);
            $data['client'] = $client->getById($client_id);
            
            if($data['client']) {
                $data['type'] = $client_type->getById($data['client'][0]->type);
                $this->_setPage('client_edit', $data);
            } else $this->_redirect ('/client');
	}

	function addClient() {  
            
            $c = Doo::loadModel('Client', true);
            $c_a = Doo::loadModel('Client_address', true);
            $c_t = Doo::loadModel('Client_types', true);
            $c_b = Doo::loadModel('Client_budget', true);
            $validateFail = $c->validateClient();
            
            if($validateFail) echo json_encode(array('error'=>$validateFail));
            else {
                
                $type_id = $c_t->getByName();
                $client_id = false;
                
                if($type_id) {
                    $client_id = $c->add($type_id);
                    $c_a->add($client_id);
                    $c_b->add($client_id);
                }
                
                if($client_id) echo json_encode(array('insert'=>'1'));
                else echo json_encode(array('error'=>'1'));
            }
	}

	function editClient() {

        $c = Doo::loadModel('Client', true);
        $c_a = Doo::loadModel('Client_address', true);
        $c_t = Doo::loadModel('Client_types', true);
        $c_b = Doo::loadModel('Client_budget', true);
        $validateFail = $c->validateClient();
        
        if($validateFail) echo json_encode(array('error'=>$validateFail));
        else {
            
            $type_id = $c_t->getByName();
            
            if($type_id) {            
                $c->refresh($type_id);
                $c_a->refresh();
                $c_b->refresh();  
            }
            
            if($type_id) echo json_encode(array('update'=>'1'));
            else echo json_encode(array('error'=>'1'));
        }
	}
    
    function propertyLink() {
        
        $p_l = Doo::loadModel('Property_views_link', true);
        $c_l = Doo::loadModel('Client_views_link', true);
        $property_views = Doo::loadModel('Property_views', true);
          
        $pv = $property_views->getByPost();    
        $validateFail = $property_views->validateViews();
        $v = null;             
        
        if($pv && empty($validateFail)) {      
             $v = 1;
             $property_views->refresh($pv->id);  
        } else if(empty($validateFail)){ 
             $v = 1;      
             $pv_id = $property_views->add();
             $p_l->add($pv_id);
             $c_l->add($pv_id);
        }
        
        if($v) echo json_encode(array('update'=>'1'));
        else echo json_encode(array('error'=>'1'));
    }
    
    function search() {
        
        $client = Doo::loadModel('Client', true);
        $validateFail = $client->validateSearch();
        
        if($validateFail) {
            echo json_encode(array('error'=>$validateFail));
            return false;
        }
        
        $result = $client->search();
        if($result) echo json_encode(array('result'=>$result));
        else echo json_encode(array('error_none'=>'<li>Sorry no clients found.</li>'));
    }     
    
    function find() {      
        
        $client = Doo::loadModel('Client', true);
        $validateFail = $client->validateClientSearch();
        
        if($validateFail) {
            echo json_encode(array('error'=>$validateFail));
            return false;
        }
        
        $result = $client->searchClient();
        if($result) echo json_encode(array('result'=>$result));
        else echo json_encode(array('error_none'=>'<li>Sorry no clients found.</li>'));   
    }
    
    function delete() {
        
        $client = Doo::loadModel('Client', true);
        $c_vl = Doo::loadModel('Client_views_link', true); 
        $p_vl = Doo::loadModel('Property_views_link', true); 
        $p_v = Doo::loadModel('Property_views', true);      
        $c_a = Doo::loadModel('Client_address', true);        
        $c_b = Doo::loadModel('Client_budget', true);
        $validateFail = $client->validateDelete();
        
        if($validateFail) {
            echo json_encode(array('error'=>$validateFail));
            return false;
        }
        
        $result = $client->getDeleteItems();   
        if($result) {                 
            if($result[0]->Property_views) {     
                foreach($result[0]->Property_views as $pv) {
                    $c_vl->deleteLink($pv->id);    
                    $p_vl->deleteLink($pv->id); 
                    $p_v->deleteView($pv->id);  
                }    
            }
            $c_a->deleteClient();
            $c_b->deleteClient();
            $client->deleteClient();
        }         
        echo json_encode(array('id'=>$_POST['client']));                
    
    }
}
?>