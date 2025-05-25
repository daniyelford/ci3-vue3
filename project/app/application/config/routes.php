<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'page';
$route['(:any)'] = function($str){
    $a='';
    switch($str){
        case 'test':
            $a='test';
            break;
        default:
            $a='page/url/$1';
            break;
    }
    return $a;
};
$route['(:any)/(:any)'] = 'page/url/$1/$2';
$route['(:any)/(:any)/(:any)'] = 'page/url/$1/$2/$3';
$route['(:any)/(:any)/(:any)/(:any)'] = 'page/url/$1/$2/$3/$4';
$route['(:any)/(:any)/(:any)/(:any)/(:any)'] = 'page/url/$1/$2/$3/$4/$5';
$route['(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'page/url/$1/$2/$3/$4/$5/$6';
// $route['(:any)']=function($str){
//     $a='';
//     switch($str){
//         case 'logout':
//             $a='users/users/log_out';
//             break;
//         case "home-page":
//             $a='home_page';
//             break;
//         case "map":
//             $a='role/map';
//             break;
//         case "exit_page":
//             $a='role/exit_page';
//             break;
//         case "add_wallet_value":
//             $a='includes/wallet/add_value';
//             break;
//         case "chat":
//             $a='chat/chat/manager';
//             break;
//         case "user_setting":
//             $a='users/dashbord/setting';
//             break;
//         case "company_manager":
//             $a='company/company/manage';
//             break;
//         case "wallet":
//             $a='includes/wallet/index';
//             break;
//         case "remove_wallet_value":
//             $a='includes/wallet/remove_value';
//             break;
//         case "wallet_payment":
//             $a='includes/wallet/wallet_payment';
//             break;
//         case "add_cart":
//             $a='includes/wallet/add_cart';
//             break;
//         case "company_one":
//             $a='company/company/one';
//             break;
//         case "company_users":
//             $a='company/company/users';
//             break;
//         case "company_resume":
//             $a='company/company/company_resume';
//             break;
//         case "user_in_company":
//             $a='company/company/company_user';
//             break;
//         case "all_support":
//             $a='home_page/new_support';
//             break;
//         case "all_pay_request":
//             $a='home_page/all_pay_request';
//             break;
//         case "all_wallet_changeing":
//             $a='home_page/all_wallet_changeing';
//             break;
//         case "all_category_manager":
//             $a='home_page/all_category_manager';
//             break;
//         case "all_company_manager":
//             $a='home_page/all_company_manager';
//             break;
//         case "all_user_manager":
//             $a='home_page/all_user_manager';
//             break;
//         case "all_support_manager":
//             $a='home_page/all_support_manager';
//             break;
//         case "all_product_manager":
//             $a='home_page/all_product_manager';
//             break;
//         case "all_position_manager":
//             $a='home_page/all_position_manager';
//             break;
//         case "company_meet":
//             $a='company/meet/meet/company_meet';
//             break;
//         case "meet_company_manager":
//             $a='company/meet/meet/meet_manager';
//             break;
//         case "company_task":
//             $a='company/task/task/my';
//             break;
//         case "product_company_manager":
//             $a='company/product/product/product_company_manager';
//             break;
//         case "product_company_order_manager":
//             $a='company/product/product/product_company_order_manager';
//             break;
//         case "position_company_reserve_manager":
//             $a='company/position/position/position_company_reserve_manager';
//             break;
//         case "position_company_manager":
//             $a='company/position/position/position_company_manager';
//             break;
//         case "company_position_one":
//             $a='company/position/position/one';
//             break;
//         case "company_position_setting":
//             $a='company/position/position/setting';
//             break;
//         case "company_product_one":
//             $a='company/product/product/one';
//             break;
//         case "company_product_setting":
//             $a='company/product/product/setting';
//             break;
//         case "company_promotions":
//             $a='company/dashbord/promotion';
//             break;
//         case "company_promotion_order":
//             $a='company/dashbord/promotion_order';
//             break;
//         case "search":
//             $a='role/search';
//             break;
//         case "shopping":
//             $a='users/dashbord/shopping';
//             break;
//         case "reserve":
//             $a='users/dashbord/reserve';
//             break;
//         case "resume":
//             $a='users/dashbord/resume';
//             break;
//         case "webauthn_login_options":
//             $a='users/Webauthn/loginOptions';
//             break;
//         case "webauthn_verify_login":
//             $a='users/Webauthn/verifyLogin';
//             break;
//         case "webauthn_register_options":
//             $a='users/Webauthn/registerOptions';
//             break;
//         case "webauthn_verify_register":
//             $a='users/Webauthn/verifyRegister';
//             break;
//         default:
//             $a='role/url/'.$str;
//             break;
//     }
//     return $a;
// };
// $route['(:any)/(:any)']=function($str,$y){
//     $a='';
//     switch($str){
//         case "assets":
//             $a='assets';
//             break;
//         case "category":
//             $a='category';
//             break;
//         case "chat":
//             $a='chat';
//             break;
//         case "company":
//             $a='company';
//             break;
//         case "includes":
//             $a='includes';
//             break;
//         case "chat":
//             $a='chat';
//             break;
//         case "role":
//             $a='role';
//             break;
//         case "product":
//             $a='product/dashbord/change_product_url';
//             break;
//         case "position":
//             $a='product/dashbord/change_position_url';
//             break;
//         case "users":
//             $a='users';
//             break;
//         case "map_category":
//             $a='role/map_category';
//             break;
//         case "manage_all_product":
//             $a='product/product/setting';
//             break;
//         case "show_company":
//             $a='company/company/show';
//             break;
//         case "manage_all_product_detail":
//             $a='product/product/detail_setting';
//             break;
//         case "cart_visit":
//             $a='chat/chat/visit';
//             break;
//         default:
//             $a='role/url_two/'.$str;
//             break;
//     }
//     return $a.DS.$y;
// };
// $route['(:any)/(:any)/(:any)']=function($str,$y,$z){
//     switch($str){
//         case "assets":
//             $a='assets';
//             break;
//         case "category":
//             $a='category';
//             break;
//         case "chat":
//             $a='chat';
//             break;
//         case "company":
//             $a='company';
//             break;
//         case "includes":
//             $a='includes';
//             break;
//         case "product":
//             $a='product';
//             break;
//         case "position":
//             $a='position';
//             break;
//         case "chat":
//             $a='chat';
//             break;
//         case "role":
//             $a='role';
//             break;
//         case "users":
//             $a='users';
//             break;
//         // case "company_product":
//         //     $a='product/dashbord/show_company_product';
//         //     break;
//         // case "company_position":
//         //     $a='product/dashbord/show_company_position';
//         //     break;
//         default:
//             $a='role/url_three/'.$str;
//             break;
//     }
//     return $a.DS.$y.DS.$z;
// };
// $route['(:any)/(:any)/(:any)/(:any)']=function($str,$x,$y,$z){
//         switch($str){
//         case "assets":
//             $a='assets';
//             break;
//         case "category":
//             $a='category';
//             break;
//         case "chat":
//             $a='chat';
//             break;
//         case "company":
//             $a='company';
//             break;
//         case "includes":
//             $a='includes';
//             break;
//         case "product":
//             $a='product';
//             break;
//         case "position":
//             $a='position';
//             break;
//         case "chat":
//             $a='chat';
//             break;
//         case "role":
//             $a='role';
//             break;
//         case "users":
//             $a='users';
//             break;
//         case "company_product":
//             $a='product/dashbord/show_company_product';
//             break;
//         case "company_position":
//             $a='product/dashbord/show_company_position';
//             break;
//         default:
//             $a='role/url_four/'.$str;
//             break;
//     }
//     return $a.DS.$x.DS.$y.DS.$z;
// };
// $route['(:any)/(:any)/(:any)/(:any)/(:any)']=function($str,$x,$y,$z,$w){
//     if($str=="assets"||$str=="category"||$str=="chat"||$str=="company"||$str=="includes"||$str=="product"||$str=="chat"||$str=="role"||$str=="users")
//         return $str.DS.$x.DS.$y.DS.$z.DS.$w;
//     else
//         return 'role/url_five/'.$str.DS.$x.DS.$y.DS.$z.DS.$w;
// };
// $route['(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']=function($str,$x,$y,$z,$w,$s){
//     if($str=="assets"||$str=="category"||$str=="chat"||$str=="company"||$str=="includes"||$str=="product"||$str=="chat"||$str=="role"||$str=="users")
//         return $str.DS.$x.DS.$y.DS.$z.DS.$w.DS.$s;
//     else
//         return 'role/url_six/'.$str.DS.$x.DS.$y.DS.$z.DS.$w.DS.$s;
// };

$route['404_override'] = 'role/err_404';
$route['translate_uri_dashes'] = FALSE;
