<?php
 
$route['*']['/'] = array('DashboardController', 'index');

//Client index
$route['*']['/client'] = array('ClientController', 'index');
$route['post']['/client/link'] = array('ClientController', 'propertyLink');
$route['post']['/client/find'] = array('ClientController', 'find');

//Client add
$route['*']['/client/add'] = array('ClientController', 'add');
$route['post']['/client/add'] = array('ClientController', 'addClient');
$route['post']['/client/delete'] = array('ClientController', 'delete');

//Client edit
$route['*']['/client/edit/:client_id'] = array('ClientController', 'edit');
$route['post']['/client/edit'] = array('ClientController', 'editClient');

//Property index
$route['*']['/property'] = array('PropertyController', 'index');
$route['post']['/property/postcode'] = array('PropertyController', 'getByDistance');
$route['post']['/property/search'] = array('PropertyController', 'search');

//Property add
$route['*']['/property/add'] = array('PropertyController', 'add');
$route['post']['/property/add'] = array('PropertyController', 'addProperty');
$route['post']['/property/image/save'] = array('PropertyController', 'saveImage');

//Property edit
$route['*']['/property/edit/:property_id'] = array('PropertyController', 'edit');
$route['post']['/property/edit'] = array('PropertyController', 'editProperty');
?>