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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['dashboard'] = 'Dashboard';
$route['isiqsaurp3i'] = 'isiqsaurp3i';
$route['mahasiswa'] = 'mahasiswa';
$route['mahasiswa/upload'] = 'mahasiswa/form/';
$route['mahasiswa/import'] = 'mahasiswa/import/';
$route['mahasiswa/tambah'] = 'mahasiswa/tambahmhs/';
$route['template_mhs'] = 'mahasiswa/download_template_mhs';

$route['mahasiswa_io'] = 'mahasiswa/index_io';
$route['mahasiswa/upload_io'] = 'mahasiswa/form_io/';
$route['mahasiswa/import_io'] = 'mahasiswa/import_io/';
$route['mahasiswa/tambah_io'] = 'mahasiswa/tambahmhs_io/';
$route['template_mhs_io'] = 'mahasiswa/download_template_mhs_io';

$route['dosen'] = 'dosen';
$route['dosen/upload'] = 'dosen/form';
$route['dosen/import'] = 'dosen/import';
$route['dosen/tambah'] = 'dosen/tambahdosen';
$route['template_dosen'] = 'dosen/download_template';

$route['dosen_tamu'] = 'dosen_tamu';
$route['dosen_tamu/upload'] = 'dosen_tamu/form';
$route['dosen_tamu/import'] = 'dosen_tamu/import';
$route['dosen_tamu/tambah'] = 'dosen_tamu/tambahdosen';
$route['template_dosen_tamu'] = 'dosen_tamu/download_template';

$route['dosen_phd'] = 'dosen_phd';
$route['dosen_phd/upload'] = 'dosen_phd/form';
$route['dosen_phd/import'] = 'dosen_phd/import';
$route['dosen_phd/tambah'] = 'dosen_phd/tambahdosen';
