<?php

class Explore extends CW_Controller {

	function __construct(){
		parent::__construct();
		
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
		
		$data['collectibles_count'] = $this->getCollectiblesCount();

		$data['title'] = 'Explore';
		
		$_SESSION['path'] = base_url();
		
		$this->load->model('phonecard_model');
		$data['categories'] = $this->phonecard_model->get_categories();
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/explore', $data);
		$this->load->view('templates/footer', $data);
		
	}
	
	
	public function explore_phonecards($countries=NULL ,$catalog=NULL  ,  $companies=NULL, $serie=NULL, $system=NULL,$circulations=NULL , $year=NULL , $page=NULL , $order =NULL, $no_variations=NULL){
		
		if ( isset($_SESSION['user']) ){

			$this->load->model('user_model');
		
			$usr = $_SESSION['user'];		
		
			$u = $this->user_model->isUser(array('user'=>$usr));
			
			$data['intro_show_phonecard'] = $u['intro_show_phonecard'];
		}


		//echo $catalog.' | '.$system.' | '.$country.' | '.$company.' | '.$serie.' | '.$year.' | '.$page;
		
		$data['title'] = 'Explore phonecards';
				
		$this->load->model('phonecard_model');
		$explore = $this->phonecard_model->explore_phonecards();
		$data['phonecards'] = $explore[1];
		$data['num_rows'] = $explore[0];
		$data['order'] = $order;
		$data['no_variations'] = $no_variations;
		
		$data['countries'] = $this->phonecard_model->get_countries(); 
 		
 		$data['catalogs'] = $this->phonecard_model->get_catalogs(); 

		$data['catalog'] = $catalog;
		$data['system'] = $system;
		$data['year'] = $year;
		$data['pag'] = $page;
		$data['collectibles_count'] = $this->getCollectiblesCount();
		
		if ( $page == 1 ){
			$data['pc_explanation'] = $this->get_phonecards_explanation($country);
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/phonecards/show_phonecards', $data);
		$this->load->view('templates/footer', $data);
	}
	
	
	
	
}

