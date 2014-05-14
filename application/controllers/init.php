<?php

class Init extends CW_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(0);
	}
	
	
	/* Funcion para hacer pruebas. Borra la pizarra luego de terminar :) */
	public function test(){

		$data['title'] = 'Test room';

		$this->load->view('templates/header', $data);
		$this->load->view('pages/test',$data);
		$this->load->view('templates/footer', $data);
	}
	
	public function change_language( ){ 
		$this->load->view('pages/goBack');
	}
	
	/* Funcion para guardar en session el idioma seleccionado por el usuario */
	public function switch_language( ){
		 
		$lang =  $this->input->post('lang');
	
		@session_start();
		
		if ( $lang == -1 || strcmp($lang,'-1') == 0 ){
			$_SESSION['selected_lang'] = '';
			setcookie("selected_lang", "", time()+(10 * 365 * 24 * 60 * 60));
		}
		else{ 
			$_SESSION['selected_lang'] = $lang;
			setcookie("selected_lang", $lang, time()+(10 * 365 * 24 * 60 * 60));
		}
		 

	}
	
	/* Funcion para controlar la entrada a la pagina principal */
	public function view(){
	
		/* Esto se deberia hacer siempre para los controladores principales de las paginas */
		$this->landingPageVerification();
		$data['title'] = 'Inicio';
		$data['notifications'] = $this->getUserNotifications();
		$data['collectibles_count'] = $this->getCollectiblesCount();
		

		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		
		if ( $user and $pass ){
			$this->load->model('user_model');

			if ( $this->user_model->login($user,$pass) ){
				header('Location: '.base_url().'init');
			}
			else{
				header('Location: '.base_url().'init?err=0');
			}
		}
		else{		
			$this->load->model('collecworld_model');
			$fbs = $this->collecworld_model->getUnasweredFeedbacks();
			$data['num_feedbacks'] = count($fbs);
			
			$this->load->view('templates/header', $data);
			$this->load->view('pages/init',$data);
			$this->load->view('templates/footer', $data);
		}	

	}
	
	/* Funcion para cerrar la sesion de un usuario actual */
	public function logout(){

		if ( isset($_SESSION['user']) ){
			session_destroy();
			setcookie("user", "", time()-3600);
			setcookie("name", "", time()-3600);
			setcookie("email", "", time()-3600);
			setcookie("id_users", "", time()-3600);
			setcookie("status", "", time()-3600);
			setcookie("img", "", time()-3600);			
			@session_start();
			$_SESSION['init'] = 'antonio';
		}

		header('Location: '.base_url().'init');
	}

}