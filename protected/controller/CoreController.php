<?php                                      

class CoreController extends DooController {
	
//Create session    
protected $_session = null; 
//host shortcut
protected $_host;         

protected $_error = 0;

    function __construct() {
	
        $this->_session = Doo::session("gateplayer");
        
        $this->_host = Doo::conf()->SITE_PATH;   
                       
    } 

    public function _setPage($page, $data = array()) {
                                       
        $data['content'] = $page;      
        $data['error'] = $this->_error;    
        
        $this->renderc('template', $data);
    }    
    
    public function _redirect($url) {
	
        return header('Location: ' . $url);
    }    

    public function _isPost() {
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") return true;
        else return false;
    }
    
    public function _referer() {
        
        return $_SERVER['HTTP_REFERER'];
    }   
}

?>