<?php

class Login extends CI_Controller {



	function __construct(){

		parent::__construct();

		

		if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

		}

	}



	public function view( ){

		

		session_start();

		if ( !$_SESSION['init'] ){

			

			if ( isset($_COOKIE['init']) ){

				$_SESSION['init'] = $_COOKIE['init'];

			}

			else{

				header('Location: '.base_url());

			}

		}

		if ( isset($_SESSION['user']) ){

			header('Location: '.base_url().'index.php/init');

		}

		

		$data['title'] = 'Login / Sign up';

		$this->load->model('phonecard_model');

		$data['countries'] = $this->phonecard_model->get_countries();

		

		$this->load->view('templates/header', $data);

		$this->load->view('pages/login', $data);

		$this->load->view('templates/footer', $data);

	}



}

?>