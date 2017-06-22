<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$autoload['packages'] = array();


// проверка на наличие файла конфигурации базы
if (!file_exists(FCPATH . APPPATH . 'config/database.php')) 
{
	die('File not found: <b>application/config/database.php</b>. Please run <a href="install">install MaxSite CMS</a>.');
}

$autoload['libraries'] = array('database', 'session');


$autoload['helper'] = array();


$autoload['config'] = array();


$autoload['model'] = array();
