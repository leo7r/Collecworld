<?php
class Edit extends CW_Controller {
	
	function __construct(){
		parent::__construct();
	}

	// Funcion que maneja la entrada a Subir articulo
	public function view_phonecard( $id ){
		
		$this->landingPageVerification();
		$data['notifications'] = $this->getUserNotifications();
		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['title'] = 'Edit Phonecard';
			
		if ( isset($_SESSION['user']) ){
			$u = $this->user_model->isUser(array('user'=>$_SESSION['user']));
			//$data['intro_upload'] = $u['intro_upload'];
		}
		
		$this->load->model('collecworld_model');
		$this->load->model('phonecard_model');
		
		$data['categories'] = $this->collecworld_model->get_categories();
		$data['logos'] = $this->phonecard_model->get_logos();
		$data['countries'] = $this->phonecard_model->get_countries();
		$data['logos_list'] = $this->phonecard_model->get_logos();
		$data['prices_list'] = $this->collecworld_model->get_status( 1 );
		$data['tags_list'] = $this->collecworld_model->get_tags();
		
		$pc = $this->phonecard_model->get_phonecard( array('id_phonecards' => $id) );
		$data['phonecard'] = $pc[0];
		
		$data['companies'] = $this->phonecard_model->get_companies( $pc[0]['id_categories_countries'] );		
		$data['denominations'] = $this->collecworld_model->get_currencies( $pc[0]['id_categories_countries'] , 1 );
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/edit/phonecards', $data);
		$this->load->view('templates/footer', $data);		
	}
	
}
?>