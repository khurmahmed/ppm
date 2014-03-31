<?php

Doo::loadController('CoreController');
class DashboardController extends CoreController{

    public function index(){            
        
        $client = Doo::loadModel('Client', true);
        $property = Doo::loadModel('Property', true);
        $data['clients'] = $client->getAllDashboard();
        $data['properties'] = $property->getAllDashboard();
        
        $this->_setPage('dashboard_index', $data);
		
    }       

}
?>