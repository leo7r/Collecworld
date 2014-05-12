<?php

class Panel extends CW_Controller {

	function __construct(){

		parent::__construct();
		
	}	

	public function answer_feedback(){
		
		if ( $_SESSION['status'] != 1 ){
			header('Location: '.base_url());
			return;
		}
		
		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['title'] = "Answer feedback";
		
		
		$this->load->model('collecworld_model');
		$data['feedbacks'] = $this->collecworld_model->getUnasweredFeedbacks();
		
		$this->load->view('templates/header', $data);
		$this->load->view('pages/panel/answer_feedback', $data);
		$this->load->view('templates/footer', $data);
	}
	
	public function send_feedback(){
		
		if ( $_SESSION['status'] != 1 ){
			header('Location: '.base_url());
			return;
		}
		
		$user = $this->input->post('user');
		$answer = $this->input->post('answer');
		$fb_id = $this->input->post('feedback_id');
		
		$this->load->model('collecworld_model');
		$this->collecworld_model->answerFeedback( $user , $answer , $fb_id );
		
		header('Location: '.base_url().'index.php/answer_feedback');
	}
	
}