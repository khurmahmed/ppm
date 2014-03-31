<?php

$dbmap['Client']['has_one']['Client_budget'] = array('foreign_key'=>'id');
$dbmap['Client_budget']['has_one']['Client'] = array('foreign_key'=>'id');

$dbmap['Client']['has_one']['Client_address'] = array('foreign_key'=>'id');
$dbmap['Client_address']['has_one']['Client'] = array('foreign_key'=>'id');
              
$dbmap['Property']['has_many']['Property_views'] = array('foreign_key'=>'property_id', 'through'=>'property_views_link');
$dbmap['Property_views']['has_many']['Property'] = array('foreign_key'=>'property_views_id', 'through'=>'property_views_link');
  
$dbmap['Client']['has_many']['Property_views'] = array('foreign_key'=>'client_id', 'through'=>'client_views_link');
$dbmap['Property_views']['has_many']['Client'] = array('foreign_key'=>'client_views_id', 'through'=>'client_views_link');
                                        
$dbmap['Property']['has_many']['Property_image'] = array('foreign_key'=>'property_id', 'through'=>'property_image_link');
$dbmap['Property_image']['has_many']['Property'] = array('foreign_key'=>'property_image_id', 'through'=>'property_image_link');

$dbconfig['dev'] = array('localhost', 'ppm', 'root', 'root', 'mysql', true);
$dbconfig['prod'] = array('localhost', 'ppm', 'root', 'root', 'mysql', true);
$dbconfig['db2dev'] = array('localhost', 'postcodes', 'root', 'root', 'mysql', true);
$dbconfig['db2prod'] = array('localhost', 'ppm', 'root', 'root', 'mysql', true);

?>