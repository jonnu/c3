<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
*/

$route['default_controller'] 			= 'page';
$route['404_override'] 					= 'page';

$route['sitemap\.([a-zA-Z.]+)']			= 'page/sitemap/generate/$1';

/* TEMP ROUTES */
$route['gallery'] = 'image/gallery';//special-projects/(technical-equipment|training)'] = 'product/route/$1';
$route['gallery/([^/]+)'] = 'image/gallery/display/$1';
/* END NASTY TEMP ROUTES :( */

/* Administration */
$route['admin']							= 'admin/main';
$route['admin/(settings)']				= 'admin/$1';
$route['admin/(settings)/(:any)']		= '$2/admin/$1';
$route['admin/(login|logout)']			= 'admin/gateway/$1';
$route['admin/([^/]+)/(:any)']			= '$1/admin/$2';
$route['admin/([^/]+)/?']				= '$1/admin/index';