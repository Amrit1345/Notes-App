<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['users/login'] = 'Users/login';
$route['users/register'] = 'Users/register';
$route['home'] = 'Pages/view';

$route['notes'] = 'Notes/index';
$route['notes/add'] = 'Notes/add';
$route['notes/view/(:any)'] = 'Notes/view/$1';
$route['notes/edit/(:any)'] = 'Notes/edit/$1';
$route['notes/delete/(:any)'] = 'Notes/delete/$1';
$route['default_controller'] = 'Pages/view';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
