<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['dashboard'] = 'dashboard';


$route['login'] = 'auth/login';
$route['register']='registers/signup';



$route['user'] = 'admin/user';
$route['user/add'] = 'admin/user/add';
$route['user/insert'] = 'admin/user/insert';
$route['user/delete/(:any)'] = 'admin/user/delete/$1';


$route['profile'] = 'client/profile';



$route['device'] = 'client/device';
$route['device/add'] = 'client/device/add';
$route['device/insert'] = 'client/device/insert';
$route['device/edit/(:any)'] = 'client/device/edit/$1';
$route['device/getToken/(:any)'] = 'client/device/getToken/$1';
$route['device/refreshToken/(:any)'] = 'client/device/getRefreshToken/$1';

$route['api/checknumber'] = 'api/Checknumber';


$route['device/logout/(:any)'] = 'client/device/logoutInstance/$1';

$route['singlenomor'] = 'client/ceknomor';
$route['multinomor'] = 'client/ceknomor/multinomor';
$route['laporan'] = 'client/laporan';
$route['rechecknumber'] = 'client/laporan/rechecknumber';
$route['resetnumber'] = 'client/ceknomor/resetnumber';


$route['billing_panel'] = 'super_admin/transaksi';
$route['billing_panel/add'] = 'super_admin/transaksi/add';

$route['transactions'] = 'admin/transaksi';
$route['billings'] = 'client/transaksi';
// $route['billing/proses/(:any)'] = 'client/transaksi/proses/$1';
$route['billing/invoice/(:any)'] = 'client/transaksi/invoice/$1';

$route['service'] = 'client/service';
$route['service/addUptime'] ='client/service/addUptime';
$route['change_package']='client/service/change_package';
$route['save_change_package/(:any)']='client/service/save_change_package/$1';

$route['setting'] = 'super_admin/setting';


// end guest


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
