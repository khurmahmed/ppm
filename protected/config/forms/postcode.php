<?php   
return array(
        'distance'=>array(
            array('inList',array('25', '50', '100', '400'))
        ),
        'postcode'=>array(
            array('maxlength',7,'This is not a postcode!'),
            array('minlength',1),
            array('regex', "'^[0-9a-zA-Z ]+$'" ) 
        )
        
);

?>