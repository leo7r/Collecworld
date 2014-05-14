
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

| There area two reserved routes:

|

|	$route['default_controller'] = 'welcome';

|

| This route indicates which controller class should be loaded if the

| URI contains no data. In the above example, the "welcome" class

| would be loaded.

|

|	$route['404_override'] = 'errors/page_missing';

|

| This route will tell the Router what URI segments to use if those provided

| in the URL cannot be matched to a valid route.

|

*/

/* Seccion general de Collecworld */
$route['default_controller'] = "welcome/view";
$route['404_override'] = "welcome/view";
$route['loadTranslation'] = "collecworld/loadTranslation";

/* Seccion idioma */
$route['change_language'] = "init/change_language";
$route['switch_language'] = "init/switch_language";

/* Iniciar y Cerrar sesion */
$route['login'] = "login/view";
$route['out'] = "init/logout";
$route['modal_signup'] = "user/modalSignUp";
$route['user_verif'] = "user/userVerif";

/* Seccion Inicio y Test */
$route['init'] = "init/view";
$route['test'] = "init/test";

/* Seccion de ayuda */
$route['help'] = "help";
$route['help/get_started'] = "help/get_started";
$route['help/upload/phonecards'] = "help/phonecards";
$route['help/account'] = "help/account";
$route['help/tools'] = "help/tools";
$route['help/collecworld_community'] = "help/collecworld_community";

/* Seccion subir */
$route['upload'] = "upload/view";
$route['upload/restriction'] = "upload/restriction";
$route['upload/upload_go'] = "upload/upload_go";
$route['upload/upload_coin_go'] = "upload/upload_coin_go";
$route['upload/upload_banknote_go'] = "upload/upload_banknote_go";
$route['upload/crop_imgs'] = "upload/crop_imgs";

/* Seccion editar */
$route['edit/(phonecard|coin|banknote)/(:num)'] = "edit/view/$1/$2";
$route['edit/(phonecard|coin|banknote)/new_image'] = "edit/upload_image/$1/";
$route['edit/(phonecard|coin|banknote)/edit_go'] = "edit/edit_go/$1";
$route['edit/(phonecard|coin|banknote)/crop_imgs'] = "edit/crop_imgs/$1";

/* Seccion Explorar */
$route['explore'] = "explore/phonecard";
$route['explore/(phonecard|coin|banknote)'] = "explore/$1";
$route['explore/phonecard/(dated|undated|not-emmited)/(chip|magnetic-band|optical|remote-memory|induced)/([a-z]+)/([a-z0-9]+)/?([0-9]*)/([a-zA-Z0-9]+)/?([0-9]*)'] = "explore/explore_phonecards/$1/$2/$3/$4/$5/$6/$7";
$route['explore/phonecard/(dated|undated|not-emmited)/(chip|magnetic-band|optical|remote-memory|induced)/([a-z]+)/([a-z0-9]+)/?([0-9]*)/([a-zA-Z0-9]+)/?([0-9]*)/no_variations'] = "explore/explore_phonecards/$1/$2/$3/$4/$5/$6/$7/0/1";
$route['explore/phonecard/(dated|undated|not-emmited)/(chip|magnetic-band|optical|remote-memory|induced)/([a-z]+)/([a-z0-9]+)/?([0-9]*)/([a-zA-Z0-9]+)/?([0-9]*)/(by_catalog|by_reference|by_face_value|by_serie)'] = "explore/explore_phonecards/$1/$2/$3/$4/$5/$6/$7/$8";
$route['explore/phonecard/(dated|undated|not-emmited)/(chip|magnetic-band|optical|remote-memory|induced)/([a-z]+)/([a-z0-9]+)/?([0-9]*)/([a-zA-Z0-9]+)/?([0-9]*)/(by_catalog|by_reference|by_face_value|by_serie)/no_variations'] = "explore/explore_phonecards/$1/$2/$3/$4/$5/$6/$7/$8/1";
$route['explore/coin/(total|normal|special|other)/([a-z]+)/(:num)/(:num)/(:num)/(:num)/([a-z0-9]+)/([a-z0-9]+)/(:num)'] = "explore/explore_coin/$1/$2/$3/$4/$5/$6/$7/$8/$9";
$route['explore/coin/(total|normal|special|other)/([a-z]+)/(:num)/(:num)/(:num)/(:num)/([a-z0-9]+)/([a-z0-9]+)/(:num)/no_variations'] = "explore/explore_coin/$1/$2/$3/$4/$5/$6/$7/$8/0/1";
$route['explore/banknote/(total|normal|special|other)/([a-z]+)/(:num)/(:num)/(:num)/(:num)/([a-z0-9]+)/(:num)'] = "explore/explore_banknote/$1/$2/$3/$4/$5/$6/$7/$8";
$route['explore/banknote/(total|normal|special|other)/([a-z]+)/(:num)/(:num)/(:num)/(:num)/([a-z0-9]+)/(:num)/no_variations'] = "explore/explore_banknote/$1/$2/$3/$4/$5/$6/$7/0/1";

/* Seccion Listados */
$route['export/(pdf|excel)/(:num)/(:num)/(:num)/(:num)/(:num)/(:num)/(:num)/(:num)'] = "export/view/$1/$2/$3/$4/$5/$6/$7/$8/$9";

/* Seccion Eventos */
$route['event/create'] = "event/new_event";
$route['event/create_go'] = "event/create";
$route['event/edit/(:num)'] = "event/edit/$1";
$route['event/edit/edit_go'] = "event/edit_go";
$route['event/(:num)(-[a-zA-Z0-9]*)?'] = "event/view/$1";
$route['event/(:num)(-[a-zA-Z0-9]*)?/invite'] = "event/invite/$1";
$route['event/events_list'] = "event/events_list";

/* Seccion Comercio */
$route['trade/([A-Za-z0-9]+)'] = "trade/select_only_user/$1";
$route['trade/(phonecard|coin|banknote)/(:num)'] = "trade/select/$1/$2";
$route['trade/exchange/([A-Za-z0-9]+)/step_2'] = "trade/exchange_step2/$1";
$route['trade/(buy|exchange)/([A-Za-z0-9]+)'] = "trade/create_only_user/$1/$2";
$route['trade/(buy|exchange)/(phonecard|coin|banknote)/(:num)'] = "trade/create/$1/$2/$3";
$route['trade/(buy|exchange)/(phonecard|coin|banknote)/(:num)/(:num)/([A-Za-z0-9]+)'] = "trade/create/$1/$2/$3/$4/$5";
$route['trade/trade_buy'] = "trade/trade_buy";
$route['trade/trade_exchange'] = "trade/trade_exchange";
$route['trade/trade_details/(:num)'] = "trade/trade_details/$1";

/* Seccion Mi Cuenta */
$route['account'] = "user/viewAccount";

/* Seccion Comparar */
$route['compare/([A-Za-z0-9]+)'] = "compare/view/$1";
$route['compare/([A-Za-z0-9]+)/(phonecards|coins|banknotes|stamps)'] = "compare/view/$1/$2";
$route['compare/([A-Za-z0-9]+)/(phonecards|coins|banknotes|stamps)/(wish|swap|buy|sell)'] = "compare/$2/$1/$3";

/* Seccion Profile Glass */
$route['profile_glass/(:any)'] = "user/profile_glass/$1";

/* Panel */
$route['answer_feedback'] = "panel/answer_feedback";
$route['answer_feedback/send'] = "panel/send_feedback";

/* Seccion Busqueda */
$route['search/phonecards/(:any)/(:num)'] = "search/phonecards/$1/$2";
$route['search/coins/(:any)/(:num)'] = "search/coins/$1/$2";
$route['search/(:any)'] = "search/view/$1";

/* Seccion Feedback */
$route['general_feedback'] = "user/getGeneralFeedback";

/* Seccion usuario */
$route['forgot_password'] = "user/forgot_password";
$route['reset_password/(:num)/(:any)'] = "user/reset_password/$1/$2";
$route['edit_user'] = "user/edit_user";
$route['signup'] = "user/new_user";
$route['signin'] = "user/login";
$route['activate_user/(:num)/(:any)'] = "user/activate_user/$1/$2";
$route['sendFeedback'] = "user/sendFeedback";
$route['(:any)/pdf/(:num)/(:num)/(:num)/(:num)/(:num)/(:num)/(:num)'] = "user/show_phonecard_collection_pdf/$1/$2/$3/$4/$5/$6/$7/$8";
$route['(:any)/xls/(:num)/(:num)/(:num)/(:num)/(:num)/(:num)/(:num)'] = "user/show_phonecard_collection_xls/$1/$2/$3/$4/$5/$6/$7/$8";
$route['(:any)/collection/(:num)/(:num)/(:num)/(:num)/(:num)/(:num)/(:num)'] = "user/show_phonecard_collection/$1/$2/$3/$4/$5/$6/$7/$8";

$route['profile/collection'] = "user/profileCollection";
$route['(:any)'] = "user/view/$1"; // ESTA SIEMPRE DEBE IR DE ULTIMO, SIRVE PARA DIRIGIR A LOS USUARIOS A SU PAGINA


/* End of file routes.php */

/* Location: ./application/config/routes.php */