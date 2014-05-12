<?php

class Signup extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function new_user(){
		
		$data['path'] = "//localhost/collecworld/";
		$data['title'] = "Email verification";
		
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$email2 = $this->input->post('email2');
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		$country = $this->input->post('country');
		
		if ( $name and $email and $user and $pass and $country and ( strcmp($email,$email2) == 0 ) ){
			$this->load->model('user_model');
			$this->user_model->insertUser( $name , $email , $user , $pass , $country );
			
			$data['email'] = $email;
			$this->load->view('templates/header',$data);
			$this->load->view('pages/signup-done',$data);
			$this->load->view('templates/footer',$data);	
		}
		else{
			echo 'error';
		}
	}
}