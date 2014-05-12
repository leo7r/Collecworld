<?php



class Help extends CW_Controller {



	public function __construct(){

		parent::__construct();

	}	

	public function index(){

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

		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['title'] = 'Help Center';

		$this->load->view('templates/header', $data);
		$this->load->view('pages/help',$data);
		$this->load->view('templates/footer', $data);

	}

	

	public function get_started(){


		if ( !$_SESSION['init'] ){

			header('Location: '.base_url());

		}

		

		if ( isset($_SESSION['user']) ){

			$this->load->model('user_model');

			$data['notifications'] = $this->user_model->getNotifications();

		}

			

		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['title'] = 'Help Center - Get Started';

		$this->load->view('templates/header', $data);

		$this->load->view('pages/help/get_started',$data);

		$this->load->view('templates/footer', $data);

	}

	

	public function phonecards(){


		if ( !$_SESSION['init'] ){

			header('Location: '.base_url());

		}

		

		if ( isset($_SESSION['user']) ){

			$this->load->model('user_model');

			$data['notifications'] = $this->user_model->getNotifications();

		}

			

		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['title'] = 'Help Center - Upload Phonecards';


		$this->load->view('templates/header', $data);

		$this->load->view('pages/help/phonecards',$data);

		$this->load->view('templates/footer', $data);

	}

	

	public function account(){


		if ( !$_SESSION['init'] ){

			header('Location: '.base_url());

		}

		

		if ( isset($_SESSION['user']) ){

			$this->load->model('user_model');

			$data['notifications'] = $this->user_model->getNotifications();

		}

			

		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['title'] = 'Help Center - My Account';

	

		$this->load->view('templates/header', $data);

		$this->load->view('pages/help/account',$data);

		$this->load->view('templates/footer', $data);

	}

	

	public function tools(){


		if ( !$_SESSION['init'] ){

			header('Location: '.base_url());

		}

		

		if ( isset($_SESSION['user']) ){

			$this->load->model('user_model');

			$data['notifications'] = $this->user_model->getNotifications();

		}

			

		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['title'] = 'Help Center - Tools';

	

		$this->load->view('templates/header', $data);

		$this->load->view('pages/help/tools',$data);

		$this->load->view('templates/footer', $data);

	}

	

	public function collecworld_community(){

		if ( !$_SESSION['init'] ){

			header('Location: '.base_url());

		}

		

		if ( isset($_SESSION['user']) ){

			$this->load->model('user_model');

			$data['notifications'] = $this->user_model->getNotifications();

		}

			

		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['title'] = 'Help Center - Collecworld Comunnity';

	

		$this->load->view('templates/header', $data);

		$this->load->view('pages/help/collecworld_community',$data);

		$this->load->view('templates/footer', $data);

	}

	

}