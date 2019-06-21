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
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'welcome';
//$route['404_override'] = '';
//$route['translate_uri_dashes'] = FALSE;

//$route['default_controller'] = 'pages/view';
//$route['(:any)'] = 'pages/view/$1';

$route['bids/download'] = 'bids/download';
$route['bids/secondarycancel'] = 'bids/secondarycancel';
$route['bids/secondarybuy'] = 'bids/secondarybuy';
$route['bids/makebids'] = 'bids/makebids';
$route['bids/index'] = 'bids/index';
$route['bids'] = 'bids';
$route['secondary/download'] = 'secondary/download';
$route['secondary/button'] = 'secondary/button';
$route['secondary/index'] = 'secondary/index';
$route['secondary'] = 'secondary';
$route['investments/download'] = 'investments/download';
$route['investments/button'] = 'investments/button';
$route['investments/index'] = 'investments/index';
$route['investments'] = 'investments';
$route['auctions/auction/(:any)'] = 'auctions/auction/$1';
$route['auctions/index'] = 'auctions/index';
$route['auctions/makebids'] = 'auctions/makebids';
$route['auctions/download'] = 'auctions/download';
$route['auctions'] = 'auctions';
$route['filters/success'] = 'filters/success';
$route['auth/session/bondoora'] = 'auth/session/bondoora';
$route['user/verify'] = 'user/verify';
$route['user/index'] = 'user/index';
$route['user/verify/(:any)'] = 'user/verify/$1';
$route['user/register'] = 'user/register';
$route['user/register/(:any)'] = 'user/register/$1';
$route['user/login'] = 'user/login';
$route['user/index'] = 'user/register';
$route['(:any)'] = 'filters/index/$1';
$route['default_controller'] = 'user/login';


