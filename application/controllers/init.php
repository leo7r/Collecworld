<?php



class Init extends CW_Controller {



	public function __construct(){

		parent::__construct();
		
	}

	public function change_language( ){
		//header('Location: '.base_url().'index.php/init');
		$this->load->view('pages/goBack');
	}

	public function test(){

	

		$data['title'] = 'Test room';

	

		$this->load->view('templates/header', $data);

		$this->load->view('pages/test',$data);

		$this->load->view('templates/footer', $data);

	}

	

	public function view(){


		if ( !isset($_SESSION['init']) ){
		
			

			if ( isset($_COOKIE['init']) ){

				$_SESSION['init'] = $_COOKIE['init'];

			}

			else{

				header('Location: '.base_url());

			}

		}

		

		if ( isset($_SESSION['user']) ){

			$this->load->model('user_model');

			$data['notifications'] = $this->user_model->getNotifications();

		}

		

		error_reporting(0);

		

		$data['title'] = 'Home';
		$data['collectibles_count'] = $this->getCollectiblesCount();

		

		$user = $this->input->post('user');

		$pass = $this->input->post('pass');

		

		if ( $user and $pass ){

			

			$this->load->model('user_model');

			

			if ( $this->user_model->login($user,$pass) ){

				header('Location: '.base_url().'index.php/init');

			}

			else{

				header('Location: '.base_url().'index.php/init?err=0');

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

		

		header('Location: '.base_url().'index.php/init');

	}

}