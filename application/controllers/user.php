<?php

class User extends CW_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	public function getGeneralFeedback(){
		
		$this->load->view('pages/user/feedback/general_feedback');
	}
	
	public function modalSignUp(){
		
		$this->load->model('collecworld_model');
		$data['countries'] = $this->collecworld_model->get_countries();
		
		$this->load->view('pages/user/signup/modal_signup',$data);
	}
	
	public function userVerif(){
		
		$user = $this->input->post('user');
		$this->load->model('user_model');
		
		$usr = $this->user_model->isUser( array('user' => $user) );
		
		echo !$usr;
	}
	
	public function new_user(){

		$data['title'] = "Email verification";

		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$email2 = $this->input->post('email2');
		$usr = $this->input->post('user');
		$pass = $this->input->post('pass');
		$country = $this->input->post('country');

		if ( $name and $email and $usr and $pass and $country and ( strcmp($email,$email2) == 0 ) ){

			$this->load->model('user_model');
			$res = $this->user_model->insertUser( $name , $email , $usr , $pass , $country );

			if ( !$res ){
				header('Location: '.base_url().'index.php/init?err=1');
				return;
			}

			$data['info_user'] = $this->user_model->getUserEmail( $email );
			$this->load->model('phonecard_model');
			//Info Correo
			
			$data['title_email'] = $this->lang->line('bienvenico_colleworld'); 			
			$data['unsuscribe'] = $this->lang->line('por_favor_no_quiero_recibir_mensajes_collecworld'); 			
			$data['send_by'] = $this->lang->line('este_mensaje_es_enviado_por_collecworld_y_entregado_a'); 			
			$data['collecworld_is'] = $this->lang->line('collecworld_es');  			
			$data['confirm_email'] = $this->lang->line('confirma_tu_correo');			
			$data['confirm'] = $this->lang->line('confirmar');  			
			$data['click_one'] = $this->lang->line('selecciona_una_categoria_que_tengas'); 
			$data['an_idea'] = $this->lang->line('una_idea_alguno_que_quieras');  
			$data['phonecards'] = $this->lang->line('tarjetas_telefonicas'); 
			$data['upload_photo'] = $this->lang->line('carga_una_foto_de_perfil'); 
			$data['could_be'] = $this->lang->line('puede_ser_de_ti_o_de_algo');
			$data['upload'] = $this->lang->line('cargar'); 
			$data['just_have'] = $this->lang->line('solo_tienes_que_hacer_click');  
			
			$this->load->library('email');
 
			//ENVIO CORREO CONFIRMACION					

			$config=array(
			'charset'=>'utf-8',
			'wordwrap'=> FALSE,
			'mailtype' => 'html'
			);			

			$this->email->initialize($config);			

			$data['email'] = $email;
			$data['name'] = $name;			

			$mesg = $this->load->view('templates/email/email_confirmation',$data, TRUE);			
			$this->email->from('no-reply@collecworld.com', 'Collecworld');
			$this->email->to($data['email']);  
			$this->email->subject($data['title_email']);
			$this->email->message($mesg);	
			$this->email->send();
			//FIN ENVIO CORREO CONFIRMACION
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