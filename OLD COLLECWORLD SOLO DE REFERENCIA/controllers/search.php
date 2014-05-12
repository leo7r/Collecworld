<?php



class Search extends CW_Controller {



	function __construct(){

		parent::__construct();

	}	

	public function view( $query ){
		$data['collectibles_count'] = $this->getCollectiblesCount();


		if ( !$_SESSION['init'] ){

			

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

		

		$data['title'] = 'Search '.$query;

		$data['query'] =  str_replace('+',' ',$query);

		$words = explode('+',$query);

		

		$this->load->model('phonecard_model');

		$this->load->model('user_model');

		$this->load->model('coin_model');

		$this->load->model('banknote_model');


		$pcs = $this->phonecard_model->search($words);

		$data['phonecards'] = $pcs['pcs'];

		$data['phonecards_num'] = $pcs['num'];

		
		$cns = $this->coin_model->search($words);

		$data['coins'] = $cns['cns'];

		$data['coins_num'] = $cns['num'];


		$bns = $this->banknote_model->search($words);

		$data['banknotes'] = $bns['bns'];

		$data['banknotes_num'] = $bns['num'];

		
		$ures = $this->user_model->search($words);

		$data['users'] = $ures['search'];

		$data['users_recomended'] = $ures['recomended'];


		


		

		if ( isset($_SESSION['id_users']) )

			$data['logged'] = $this->user_model->isUser(array( 'id_users' => $_SESSION['id_users'] ));

		

		$this->load->view('templates/header', $data);

		$this->load->view('pages/search', $data);

		$this->load->view('templates/footer', $data);

		

	}

	

	public function phonecards( $query , $page ){

		if ( !$_SESSION['init'] ){

			header('Location: '.base_url());

		}

		$data['collectibles_count'] = $this->getCollectiblesCount();
		

		if ( isset($_SESSION['user']) ){

			$this->load->model('user_model');

			$data['notifications'] = $this->user_model->getNotifications();

		}

		

		$data['title'] = 'Search phonecards / '.$query;

		$data['query'] =  str_replace('+',' ',$query);

		$words = explode('+',$query);

		

		$this->load->model('phonecard_model');

		$pcs = $this->phonecard_model->search($words,true, $page);

		$data['phonecards'] = $pcs['pcs'];

		$data['num_rows'] = $pcs['num'];

		$data['pag'] = $page;

		

		$this->load->view('templates/header', $data);

		$this->load->view('pages/search/phonecards', $data);

		$this->load->view('templates/footer', $data);

	}

		public function coins( $query , $page ){

		if ( !$_SESSION['init'] ){

			header('Location: '.base_url());

		}

		$data['collectibles_count'] = $this->getCollectiblesCount();
		

		if ( isset($_SESSION['user']) ){

			$this->load->model('user_model');

			$data['notifications'] = $this->user_model->getNotifications();

		}

		

		$data['title'] = 'Search coins / '.$query;

		$data['query'] =  str_replace('+',' ',$query);

		$words = explode('+',$query);

		

		$this->load->model('coin_model');

		$cns = $this->coin_model->search($words,true, $page);

		$data['coins'] = $cns['cns'];

		$data['coins_num'] = $cns['num'];

		$data['pag'] = $page;

		

		$this->load->view('templates/header', $data);

		$this->load->view('pages/search/coins', $data);

		$this->load->view('templates/footer', $data);

	}




}