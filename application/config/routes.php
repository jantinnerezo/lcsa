<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//Students
$route['students'] = 'students/index';
$route['students/edit_student/(:any)'] = 'students/edit/$1';
$route['students/view_student/(:any)'] = 'students/view_student/$1/$1';

//Attendance
$route['attendance'] = 'attendance/index';
$route['add_attendance'] = 'attendance/add_attendance';
$route['attendance/view/(:any)'] = 'attendance/view_attendance/$1';
$route['attendance/activate'] = 'attendance/activate';
$route['attendance/deactivate'] = 'attendance/deactivate';
$route['attendance/on_remove/(:any)'] = 'attendance/onremove/$1';
$route['attendance/removed_true'] = 'attendance/remove_attendance';

//Checkers
$route['login'] = 'checkers/login';
$route['logout'] = 'checkers/logout';
$route['checkers'] = 'checkers/index';
$route['checkers/add_checker'] = 'checkers/add_checker';
$route['checkers/edit_checker/(:any)'] = 'checkers/edit_checker/$1';
$route['checkers/remove_checker/(:any)'] = 'checkers/remove_checker/$1/$1';
$route['checkers/remove'] = 'checkers/remove';



//Mobile API routes
$route['mobile_api'] = 'mobile_api/test_connection';
$route['mobile_login'] = 'mobile_api/mobile_login';
$route['mobile_attendance_list'] = 'mobile_api/mobile_attendance_list';
$route['new_attendance'] = 'mobile_api/add_new_attendance';
$route['fetch_id'] = 'mobile_api/fetch_id';
$route['fetch_barcode'] = 'mobile_api/fetch_barcode';
$route['sign_attendance'] = 'mobile_api/sign_attendance';
$route['signed_already'] = 'mobile_api/signed_already';
$route['checked'] = 'mobile_api/checked';
$route['checked_search'] = 'mobile_api/checked_search';
$route['remove_student'] = 'mobile_api/remove_student';



$route['default_controller'] = 'pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
