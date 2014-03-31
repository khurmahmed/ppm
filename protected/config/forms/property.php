<?php   
return array(
        'client'=>array(                                      
            array('dbExist','Client', 'id')                              
        ),     
        'postcode'=>array(      
            array('maxlength',80,'This is way too long!'),
            array('minlength',6),
            array('regex', "'^[0-9a-zA-Z ]+$'" )                         
        ),
        'city'=>array(                                      
            array('maxlength',100,'This is way too long!'),
            array('minlength',3),
            array('alpha')                               
        ), 
        'country'=>array(                                      
            array('maxlength',100,'This is way too long!'),
            array('minlength',2),
            array('alpha')                               
        ), 
        'town'=>array(                                      
            array('maxlength',100,'This is way too long!'),
            array('minlength',3),
            array('alpha')                               
        ),  
        'address_line'=>array(
            array('minlength',4)                            
        ),     
        'asking_price'=>array(
            array('minlength',5),
            array('maxlength',6),
            array('digit')                             
        )
);

?>