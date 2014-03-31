<?php   
return array(
        'firstname'=>array(                                      
            array('maxlength',50),
            array('minlength',5),
            array('alpha')                               
        ), 
        'lastname'=>array(                                      
            array('maxlength',50,'This is way too long!'),
            array('minlength',5),
            array('alpha')                               
        ), 
        'email'=>array(                                      
            array('email'),
            array('maxlength',80,'This is way too long!'),
            array('minlength',6)                          
        ),
        'phone'=>array(
            array('maxlength',13,'This is way too long!'),
            array('minlength',11),
            array('digit')                         
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
        'line_1'=>array(
            array('minlength',4)                            
        ),                          
        'line_2'=>array(                                      
            array('minlength',4)                            
        ),
        'client_type' => array(),
        'min_price' => array(
            array('minlength',5),
            array('maxlength',6),
            array('digit')
        ),
        'max_price' => array(
            array('minlength',5),
            array('maxlength',6),
            array('digit')
        )
);

?>