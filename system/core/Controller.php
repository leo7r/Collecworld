<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

 * CodeIgniter

 *

 * An open source application development framework for PHP 5.1.6 or newer

 *

 * @package		CodeIgniter

 * @author		ExpressionEngine Dev Team

 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.

 * @license		http://codeigniter.com/user_guide/license.html

 * @link		http://codeigniter.com

 * @since		Version 1.0

 * @filesource

 */



// ------------------------------------------------------------------------



/**

 * CodeIgniter Application Controller Class

 *

 * This class object is the super class that every library in

 * CodeIgniter will be assigned to.

 *

 * @package		CodeIgniter

 * @subpackage	Libraries

 * @category	Libraries

 * @author		ExpressionEngine Dev Team

 * @link		http://codeigniter.com/user_guide/general/controllers.html

 */

class CI_Controller {



	private static $instance;



	/**

	 * Constructor

	 */

	public function __construct()

	{

		self::$instance =& $this;

		

		// Assign all the class objects that were instantiated by the

		// bootstrap file (CodeIgniter.php) to local class variables

		// so that CI can run as one big super object.

		foreach (is_loaded() as $var => $class)

		{

			$this->$var =& load_class($class);

		}



		$this->load =& load_class('Loader', 'core');



		$this->load->initialize();

		

		log_message('debug', "Controller Class Initialized");

	}



	public static function &get_instance()

	{

		return self::$instance;

	}

}

class CW_Controller extends CI_Controller{
	
	var $collectibles_count;
	
	public function __construct(){
		parent::__construct();
		
		@session_start();
		$this->refreshSessionByCookie();
		$this->iniLanguage();
	}
	
	public function getCollectiblesCount(){
		
		$this->load->model('collecworld_model');
		return $this->collecworld_model->getCollectiblesCount();
	}
	
	public function iniLanguage(){
		
		//TRADUCCION
				
		if ( !isset($_SESSION['selected_lang']) && isset($_COOKIE['selected_lang']) ){
			$_SESSION['selected_lang'] = $_COOKIE['selected_lang'];	
		}
		
		if ( isset($_SESSION['selected_lang']) && strlen($_SESSION['selected_lang']) > 0 ){
			$lang = $_SESSION['selected_lang'];	
		}
		else{
			$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		}
		
		switch($lang){
		
		case 'es':
			$lang = 'spanish';
			break;
		case 'other':
			$lang = 'english';
			break;
		default:
			$lang = 'english';
			break;
		}
		
		if($lang == 'english' || $lang == 'spanish'){
			$this->session->set_userdata('language', $lang);
		}	
	}
	
	public function refreshSessionByCookie(){
		if ( !isset($_SESSION['user']) ){
			if ( isset($_COOKIE['user']) ){
				$_SESSION['user'] = $_COOKIE['user'];
				$_SESSION['name'] = $_COOKIE['name'];
				$_SESSION['email'] = $_COOKIE['email'];
				$_SESSION['id_users'] = $_COOKIE['id_users'];
				$_SESSION['status'] = $_COOKIE['status'];
				$_SESSION['img'] = $_COOKIE['img'];
			}
		}	
	}
	
	/*
		Verificacion de si el usuario paso la verificacion
		del landing page.
	*/
	public function landingPageVerification(){
		
		if ( !isset($_SESSION['init']) ){
		
			if ( isset($_COOKIE['init']) ){
				$_SESSION['init'] = $_COOKIE['init'];
			}
			else{
				header('Location: '.base_url());
			}
		}	
	}
	
	/* Obtener las notificaciones del usuario */
	public function getUserNotifications(){
		
		@session_start();
		
		if ( isset($_SESSION['user']) ){
			$this->load->model('user_model');
			return $this->user_model->getNotifications();
		}
	}
	
}

// END Controller class



/* End of file Controller.php */

/* Location: ./system/core/Controller.php */