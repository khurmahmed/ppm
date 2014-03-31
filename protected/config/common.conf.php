<?php

error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('Asia/Kuala_Lumpur');


//For framework use. Must be defined. Use full absolute paths and end them with '/'      eg. /var/www/project/
$config['SITE_PATH'] = realpath('..').'/ppm/';
//$config['PROTECTED_FOLDER'] = 'protected/';
$config['BASE_PATH'] = realpath('..').'/ppm/dooframework/';

//for production mode use 'prod'
$config['APP_MODE'] = 'dev';

//----------------- optional, if not defined, default settings are optimized for production mode ----------------
//if your root directory is /var/www/ and you place this in a subfolder eg. 'app', define SUBFOLDER = '/app/'

$config['SUBFOLDER'] = str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\','/',$config['SITE_PATH']));
if(strpos($config['SUBFOLDER'], '/')!==0){
	$config['SUBFOLDER'] = '/'.$config['SUBFOLDER'];
}
$config['APP_URL'] = 'http://'.$_SERVER['HTTP_HOST'].$config['SUBFOLDER'];
$config['AUTOROUTE'] = TRUE;
$config['DEBUG_ENABLED'] = TRUE;

$config['ERROR_404_ROUTE'] = '/error';
