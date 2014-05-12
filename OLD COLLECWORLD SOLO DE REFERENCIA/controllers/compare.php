<?php

class Compare extends CW_Controller {



	function __construct(){

		parent::__construct();

		

		if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

		}

	}

	public function view( $user , $default_category = NULL ){

		if ( !$_SESSION['init'] ){

			

			if ( isset($_COOKIE['init']) ){

				$_SESSION['init'] = $_COOKIE['init'];

			}

			else{

				header('Location: '.base_url());

			}

		}

		$data['collectibles_count'] = $this->getCollectiblesCount();
		

		if ( isset($_SESSION['user']) ){

			$this->load->model('user_model');

			$data['notifications'] = $this->user_model->getNotifications();

			

			$data['compareTo'] = $this->user_model->isUser( array('user'=>$user) );

			

			if ( $default_category ){

				if ( strcmp($default_category,"phonecards") == 0 ){

					$data['category'] = 1;

				}elseif ( strcmp($default_category,"coins") == 0 ){

					$data['category'] =  2;

				}elseif ( strcmp($default_category,"coins") == 0 ){

					$data['category'] =  3;
				
				}elseif ( strcmp($default_category,"coins") == 0 ){

					$data['category'] =  4;
				}


			}

			else{

				$data['category'] = 0;

			}

			

			$data['title'] = 'Compare to '.$data['compareTo']['name'];

			error_reporting(0);

			

			$this->load->view('templates/header', $data);

			$this->load->view('pages/compare', $data);

			$this->load->view('templates/footer', $data);

			

		}

		else{

			header('Location: '.base_url().'index.php/login');

		}

		

	}

	

	public function phonecards( $user , $method ){

		
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

			$data['not_readed'] = $this->user_model->getUnreadedMessages( $_SESSION['id_users'] );
			$data['collectibles_count'] = $this->getCollectiblesCount();

			

			$data['compareTo'] = $this->user_model->isUser( array('user'=>$user) );

			$data['compare'] = $this->user_model->compare_users( $_SESSION['id_users'] , $data['compareTo']['id_users'] );

			

			$data['title'] = 'Compare to '.$data['compareTo']['name'];

			$data['method'] = $method;

			//error_reporting(0);		

			

			$this->load->view('templates/header', $data);

			$this->load->view('pages/compare/phonecards', $data);

			$this->load->view('templates/footer', $data);

			

		}

	

	}

public function coins( $user , $method ){

		
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

			$data['not_readed'] = $this->user_model->getUnreadedMessages( $_SESSION['id_users'] );
			$data['collectibles_count'] = $this->getCollectiblesCount();

			

			$data['compareTo'] = $this->user_model->isUser( array('user'=>$user) );

			$data['compare'] = $this->user_model->compare_users_coins( $_SESSION['id_users'] , $data['compareTo']['id_users'] );

			

			$data['title'] = 'Compare to '.$data['compareTo']['name'];

			$data['method'] = $method;

			//error_reporting(0);		

			

			$this->load->view('templates/header', $data);

			$this->load->view('pages/compare/coins', $data);

			$this->load->view('templates/footer', $data);

			

		}

	

	}

public function banknotes( $user , $method ){

		
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

			$data['not_readed'] = $this->user_model->getUnreadedMessages( $_SESSION['id_users'] );
			$data['collectibles_count'] = $this->getCollectiblesCount();

			

			$data['compareTo'] = $this->user_model->isUser( array('user'=>$user) );

			$data['compare'] = $this->user_model->compare_users_banknotes( $_SESSION['id_users'] , $data['compareTo']['id_users'] );

			

			$data['title'] = 'Compare to '.$data['compareTo']['name'];

			$data['method'] = $method;

			//error_reporting(0);		

			

			$this->load->view('templates/header', $data);

			$this->load->view('pages/compare/banknotes', $data);

			$this->load->view('templates/footer', $data);

			

		}

	

	}

	public function stamps( $user , $method ){

		
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

			$data['not_readed'] = $this->user_model->getUnreadedMessages( $_SESSION['id_users'] );
			$data['collectibles_count'] = $this->getCollectiblesCount();

			

			$data['compareTo'] = $this->user_model->isUser( array('user'=>$user) );

			$data['compare'] = $this->user_model->compare_users_stamps( $_SESSION['id_users'] , $data['compareTo']['id_users'] );

			

			$data['title'] = 'Compare to '.$data['compareTo']['name'];

			$data['method'] = $method;

			//error_reporting(0);		

			

			$this->load->view('templates/header', $data);

			$this->load->view('pages/compare/stamps', $data);

			$this->load->view('templates/footer', $data);

			

		}

	

	}


}



?>