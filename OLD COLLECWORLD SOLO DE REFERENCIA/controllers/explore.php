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
	
	public function phonecard(){
		
		$data['title'] = 'Explore phonecards';
		
		if ( !$_SESSION['init'] ){
			header('Location: '.base_url());
		}
		
		if ( isset($_SESSION['user']) ){
			$this->load->model('user_model');
			$data['notifications'] = $this->user_model->getNotifications();
			
			$usr = $_SESSION['user'];		
	
			$u = $this->user_model->isUser(array('user'=>$usr));
			
			$data['intro_explore'] = $u['intro_explore'];

		}
		
		$this->load->model('phonecard_model');
		$data['countries'] = $this->phonecard_model->get_countries2();
		$data['years'] = $this->phonecard_model->get_years();
		$data['collectibles_count'] = $this->getCollectiblesCount();
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/explore/phonecard', $data);
		$this->load->view('templates/footer', $data);
	
	}
	
	public function explore_p(){
		echo 'hola';
	}
	
	public function get_phonecards_explanation( $country ){
		
		$countries = $this->phonecard_model->get_countries( array('abbreviation'=>$country) );
		$country = $countries[0];
		$first_explanation = '';
		$first_image = '';
		$code_image = '';
		$code_explanation = '';
		$rare_phonecards = $this->phonecard_model->get_rare_phonecards( $country['id_countries'] );
		
		switch( $country['id_countries'] ){
		
		// Venezuela
		case 198:
			$first_title = 'Tarjetas que representan nuestros fuertes!';
			$first_explanation = 'Las tarjetas telefonicas en Venezuela vienen con la creación de la compañia Cantv, de ahi...';
			$first_image = 'img1.jpg';
			$code_title = '¿Cómo clasificamos las tarjetas en Venezuela?';
			$code_explanation = 'Para clasificar las tarjetas telefonicas de Venezuela, se toma como prefijo el diminutivo VEN, seguido por el diminutivo de la compañia que distribuye la tarjeta, para el ejemplo CNV. Luego de estas dos clasificaciones viene la clasificación conjunta del tipo de sistema y el catalogo al que pertenece, en este caso Chip con fecha, y por último el codigo unico dentro de esta clasificación para esta tarjeta.';
			$code_image = 'img2.jpg';
			break;
			
			default:
			return NULL;
			break;
			
		}
		
		$ret = array(
			'first_title' => $first_title,
			'first_explanation' => $first_explanation,
			'first_image' => $first_image,
			'code_title' => $code_title,
			'code_explanation' => $code_explanation,
			'code_image' => $code_image,
			'rare_phonecards' => $rare_phonecards,
			'country' => $country
		);
		
		return $ret;		
	}
	
	public function explore_phonecards( $catalog , $system , $country , $company , $serie , $year , $page , $order = NULL , $no_variations = NULL ){
		
		if ( isset($_SESSION['user']) ){

			$this->load->model('user_model');
		
			$usr = $_SESSION['user'];		
		
			$u = $this->user_model->isUser(array('user'=>$usr));
			
			$data['intro_show_phonecard'] = $u['intro_show_phonecard'];
		}


		//echo $catalog.' | '.$system.' | '.$country.' | '.$company.' | '.$serie.' | '.$year.' | '.$page;
		
		$data['title'] = 'Explore phonecards';
				
		$this->load->model('phonecard_model');
		$explore = $this->phonecard_model->explore_phonecards($catalog,$system,$country,$company,$serie,$year,$page,$order,$no_variations);
		$data['phonecards'] = $explore[1];
		$data['num_rows'] = $explore[0];
		$data['order'] = $order;
		$data['no_variations'] = $no_variations;
		
		$data['catalog'] = $catalog;
		$data['system'] = $system;
		$data['country'] = $country;
		$countries = $this->phonecard_model->get_countries( array('abbreviation'=>$country) );
		$data['country_name'] = $countries[0]['name'];
		
		$data['ref_catalog'] = $this->phonecard_model->get_country_catalog( $countries[0]['id_countries'] );
		
		$data['company'] = $company;
		$companies = $this->phonecard_model->get_phonecards_companies( array('abbreviation'=>$company) );
		$data['company_name'] = $companies[0]['name'];
		
		$data['serie'] = $serie;
		if ( $serie ){
			$series = $this->phonecard_model->get_phonecards_series( array('id_phonecards_series'=>$serie) );
			$data['serie_name'] = $series[0]['name'];
		}
		
		$data['year'] = $year;
		$data['pag'] = $page;
		$data['collectibles_count'] = $this->getCollectiblesCount();
		
		if ( $page == 1 ){
			$data['pc_explanation'] = $this->get_phonecards_explanation($country);
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/explore/show_phonecards', $data);
		$this->load->view('templates/footer', $data);
	}
	
	public function coin(){
		
		$data['title'] = 'Explore coins';
		
		if ( !$_SESSION['init'] ){
			header('Location: '.base_url());
		}
		
		if ( isset($_SESSION['user']) ){
			$this->load->model('user_model');
			$data['notifications'] = $this->user_model->getNotifications();
			
			$usr = $_SESSION['user'];		
	
			$u = $this->user_model->isUser(array('user'=>$usr));
			
			$data['intro_explore'] = $u['intro_explore'];

		}
		
		$this->load->model('coin_model'); 
		$data['collectibles_count'] = $this->getCollectiblesCount();
		
		
		$this->load->model('phonecard_model');
		$data['countries'] = $this->coin_model->get_countries3();
		$data['years'] = $this->coin_model->get_years();
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/explore/coin', $data);
		$this->load->view('templates/footer', $data);
		
	}
	
	public function explore_coin( $catalog, $country, $title, $subtitle, $denomination, $value, $composition, $year, $page, $order = NULL , $no_variations = NULL ){
		
		if ( isset($_SESSION['user']) ){

			$this->load->model('user_model');
		
			$usr = $_SESSION['user'];		
		
			$u = $this->user_model->isUser(array('user'=>$usr));
			
			$data['intro_show_phonecard'] = $u['intro_show_phonecard'];
		}


		//echo $country.' | '.$year;
		
		$data['title'] = 'Explore Coins';
				
		$this->load->model('coin_model');
		
		switch($catalog){
			
			case 'total' : $catalog_num = 0;
			break;
			case 'normal' : $catalog_num = 1;
			break;
			case 'special' : $catalog_num = 2;
			break;
			case 'other' : $catalog_num = 3;
			break;
				
		}
		 
		$explore = $this->coin_model->explore_coins($catalog_num,$country,$title,$subtitle,$denomination,$value,$composition,$year,$page,$order,$no_variations);
		
		$data['coins'] = $explore[1];
		$data['num_rows'] = $explore[0];
		$data['order'] = $order;
		$data['no_variations'] = $no_variations;
		 
		$data['catalog'] = $catalog;
		$data['catalog_num'] = $catalog_num;
		$data['country'] = $country;
		$countries = $this->coin_model->get_countries( array('abbreviation'=>$country) );
		$data['country_name'] = $countries[0]['name'];
		
		$data['titlec'] = $title;	
		if($title!=0){
			$titles = $this->coin_model->get_title( array('id_coins_title'=>$title) );
			$data['title_name'] = $titles['name'];
		}else{
			$data['title_name'] = 'Ninguno';			
		}
		
		$data['subtitle'] = $subtitle;
		if($subtitle!=0){
			$subtitles = $this->coin_model->get_subtitle( array('id_coins_subtitle'=>$subtitle) );
			$data['subtitle_name'] = $subtitles['name'];
		}else{
			$data['subtitle_name'] = 'Ninguno';			
		}
		
		$data['denomination'] = $denomination;	
		if($denomination!=0){
			$denominations = $this->coin_model->get_denomination( array('id_coins_denomination'=>$denomination) );
			$data['denomination_name'] = $denominations['name'];
		}else{
			$data['denomination_name'] = 'Ninguno';			
		}
		
		$data['value'] = $value;
		if($value!=0){
			$values = $this->coin_model->get_value( array('id_coins_value'=>$value) );
			$data['value_name'] = $values['name'];
		}else{
			$data['value_name'] = 'Ninguno';			
		}
		
		$data['composition'] = $composition;
		if($composition!=0){
			$compositions = $this->coin_model->get_composition( array('id_coins_material'=>$composition) );
			$data['composition_name'] = $compositions['name'];
		}else{
			$data['composition_name'] = 'Ninguno';			
		}
		//$data['ref_catalog'] = $this->phonecard_model->get_country_catalog( $countries[0]['id_countries'] );
		 
		$data['year'] = $year;
		$data['pag'] = $page;
		$data['collectibles_count'] = $this->getCollectiblesCount();
		
		/*
		if ( $page == 1 ){
			$data['pc_explanation'] = $this->get_phonecards_explanation($country);
		}
		*/
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/explore/show_coins', $data);
		$this->load->view('templates/footer', $data);
	}
	
	public function banknote(){
		
		$data['title'] = 'Explore banknotes';
		
		if ( !$_SESSION['init'] ){
			header('Location: '.base_url());
		}
		
		if ( isset($_SESSION['user']) ){
			$this->load->model('user_model');
			$data['notifications'] = $this->user_model->getNotifications();
			
			$usr = $_SESSION['user'];		
	
			$u = $this->user_model->isUser(array('user'=>$usr));
			
			$data['intro_explore'] = $u['intro_explore'];

		}
		
		$this->load->model('banknote_model'); 
		$data['collectibles_count'] = $this->getCollectiblesCount();
		
		$data['countries'] = $this->banknote_model->get_countries3();
		$data['years'] = $this->banknote_model->get_years();
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/explore/banknote', $data);
		$this->load->view('templates/footer', $data);
		
	}
	
	public function explore_banknote( $catalog, $country, $title, $subtitle, $denomination, $value, $year, $page, $order = NULL , $no_variations = NULL ){
		
		if ( isset($_SESSION['user']) ){

			$this->load->model('user_model');
		
			$usr = $_SESSION['user'];		
		
			$u = $this->user_model->isUser(array('user'=>$usr));
			
			$data['intro_show_phonecard'] = $u['intro_show_phonecard'];
		}


		//echo $country.' | '.$year;
		
		$data['title'] = 'Explore Banknotes';
				
		$this->load->model('banknote_model');
		switch($catalog){
			
			case 'total' : $catalog_num = 0;
			break;
			case 'normal' : $catalog_num = 1;
			break;
			case 'special' : $catalog_num = 2;
			break;
			case 'other' : $catalog_num = 3;
			break;
				
		}
		 
		$explore = $this->banknote_model->explore_banknotes($catalog_num,$country,$title,$subtitle,$denomination,$value,$year,$page,$order,$no_variations);
		 
		$data['banknotes'] = $explore[1];
		$data['num_rows'] = $explore[0];
		$data['order'] = $order;
		$data['no_variations'] = $no_variations;
		  
		$data['catalog'] = $catalog;
		$data['catalog_num'] = $catalog_num;
		$data['country'] = $country;
		$countries = $this->banknote_model->get_countries( array('abbreviation'=>$country) );
		$data['country_name'] = $countries['name'];
		
		$data['titleb'] = $title;	
		if($title!=0){
			$titles = $this->banknote_model->get_title( array('id_banknotes_title'=>$title) );
			$data['title_name'] = $titles['name'];
		}else{
			$data['title_name'] = 'Ninguno';			
		}
		
		$data['subtitle'] = $subtitle;
		if($subtitle!=0){
			$subtitles = $this->banknote_model->get_subtitle( array('id_banknotes_subtitle'=>$subtitle) );
			$data['subtitle_name'] = $subtitles['name'];
		}else{
			$data['subtitle_name'] = 'Ninguno';			
		}
		
		$data['denomination'] = $denomination;	
		if($denomination!=0){
			$denominations = $this->banknote_model->get_denomination( array('id_banknotes_denomination'=>$denomination) );
			$data['denomination_name'] = $denominations['name'];
		}else{
			$data['denomination_name'] = 'Ninguno';			
		}
		
		$data['value'] = $value;
		if($value!=0){
			$values = $this->banknote_model->get_value( array('id_banknotes_value'=>$value) );
			$data['value_name'] = $values['name'];
		}else{
			$data['value_name'] = 'Ninguno';			
		}
		
		//$data['ref_catalog'] = $this->phonecard_model->get_country_catalog( $countries[0]['id_countries'] );
		 
		$data['year'] = $year;
		$data['pag'] = $page;
		$data['collectibles_count'] = $this->getCollectiblesCount();
		
		/*
		if ( $page == 1 ){
			$data['pc_explanation'] = $this->get_phonecards_explanation($country);
		}
		*/
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/explore/show_banknotes', $data);
		$this->load->view('templates/footer', $data);
	}
	
	
}

