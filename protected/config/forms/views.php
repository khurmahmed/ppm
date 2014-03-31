<?php   
return array(
        'result'=>array(
            array('inList',array('like', 'offer', 'unknown', 'reject'))
        ),
        'client'=>array(
            array('dbExist','Client', 'id')
        ),  
        'property'=>array(
            array('dbExist','Property', 'id')
        )
        
);

?>