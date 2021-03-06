<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|    example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|    https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|    $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|    $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|    $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:    my-controller/index    -> my_controller/index
|        my-controller/my-method    -> my_controller/my_method
*/
$route['default_controller'] = 'entry';

$route['entry/update_form/(:any)'] = 'entry/edit_form/$1';
$route['entry/create_form'] = 'entry/edit_form';
$route['entry/update/(:any)'] = 'entry/edit/$1';
$route['entry/create'] = 'entry/edit';
$route['entry/delete/(:any)'] = 'entry/delete/$1';
$route['entry/(:any)'] = 'entry/view/$1';
$route['entry'] = 'entry/index';

$route['category/update_form/(:any)'] = 'entry_category/edit_form/$1';
$route['category/create_form'] = 'entry_category/edit_form';
$route['category/update/(:any)'] = 'entry_category/edit/$1';
$route['category/create'] = 'entry_category/edit';
$route['category/delete/(:any)'] = 'entry_category/delete/$1';
$route['category/(:any)'] = 'entry_category/view/$1';
$route['category'] = 'entry_category/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
