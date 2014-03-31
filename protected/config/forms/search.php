<?php   
return array(
        'search'=>array(
            array('maxlength',10,'Start your search over'),
            array('minlength',1),
            array('regex', "'^[0-9a-zA-Z ]+$'" ) 
        )
        
);

?>