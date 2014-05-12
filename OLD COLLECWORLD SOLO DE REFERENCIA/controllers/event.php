<?php

class Event extends CW_Controller {



	function __construct(){

		parent::__construct();

	}


	public function view( $event_id ){

		
		if ( isset($_SESSION['init']) ){

			

			if ( isset($_COOKIE['init']) ){

				$_SESSION['init'] = $_COOKIE['init'];

			}

			else{

				header('Location: '.base_url());

			}

		}

		

		$this->load->model('user_model');

		$this->load->model('collecworld_model');

		

		$data['notifications'] = $this->user_model->getNotifications();

		$data['event'] = $this->collecworld_model->getEvent($event_id);

		$data['invited'] = $this->collecworld_model->getEventInvited($event_id);
		$data['collectibles_count'] = $this->getCollectiblesCount();

		

		if ( $data['event'] ){

			

			$u_inv = false;

			

			if ( $data['event']['private'] == 1 ){
				
				if ( isset($_SESSION['id_users']) ){
					
					if ( $data['event']['id_users'] == $_SESSION['id_users'] ){
						$u_inv = true;	
					}
					else{
						for ( $i = 0 ; $i < count($data['invited']) ; $i++ ){
							if ( $data['invited'][$i]['id_users'] == $_SESSION['id_users'] ){
								$u_inv = true;
								break;
							}
						}	
					}
				}

			}

			else{

				$u_inv = true;

			}

						

			if ( $u_inv ){

				$data['title'] = 'Event "'.$data['event']['name'].'"';

				$data['comments'] = $this->collecworld_model->getEventComments($event_id);

				

				$this->load->view('templates/header', $data);

				$this->load->view('pages/event/view_event', $data);

				$this->load->view('templates/footer', $data);

			}

			else{
				show_404(base_url().'index.php/event/'.$event_id,false);

			}			

		}

		else{
			show_404(base_url().'index.php/event/'.$event_id,false);

		}

		

	}

	

	public function new_event(){

		
		if ( !$_SESSION['init'] ){

			header('Location: '.base_url());

		}

		

		if ( !isset($_SESSION['id_users']) ){

			header('Location: '.base_url().'index.php/login');

		}else{
			$this->load->model('user_model');

			$data['notifications'] = $this->user_model->getNotifications();
			
			$usr = $_SESSION['user'];		
	
			$u = $this->user_model->isUser(array('user'=>$usr));
			
			$data['intro_create_event'] = $u['intro_create_event'];
		}
		

		$data['title'] = 'Create new event';
		$data['collectibles_count'] = $this->getCollectiblesCount();

				

		$this->load->model('user_model');

		$this->load->model('phonecard_model');

		

		$data['notifications'] = $this->user_model->getNotifications();

		$data['friends'] = $this->user_model->getFriends($_SESSION['id_users']);

		$data['countries'] = $this->phonecard_model->get_countries();

		$data['categories'] = $this->phonecard_model->get_categories();

		

		$this->load->view('templates/header', $data);

		$this->load->view('pages/event/new_event', $data);

		$this->load->view('templates/footer', $data);

		

		

		

	}

	

	public function create(){

		
		if ( !$_SESSION['init'] ){

			header('Location: '.base_url());

		}

		

		if ( !isset($_SESSION['id_users']) ){

			header('Location: '.base_url().'index.php/login');

		}

		$data['collectibles_count'] = $this->getCollectiblesCount();
		

		$name = $this->input->post('name');

		$country = $this->input->post('country');

		$place = $this->input->post('place');

		$date = $this->input->post('date');

		$category = $this->input->post('category');

		$description = $this->input->post('description');

		$invited = $this->input->post('friends');

		$private = $this->input->post('private');

				

		$this->load->model('collecworld_model');

		$this->load->model('phonecard_model');

		$done = $this->collecworld_model->createEvent($name,$country,$place,$date,$category,$description,$invited,$private);

		$invited_info = $this->collecworld_model->getEventInvited($done);

		$this->load->library('email');
		

		for( $i=0; $i<count($invited_info); $i++ ){


			if($invited_info[$i]['email_event']==1){


				//ENVIO CORREO CONFIRMACION					

				$config=array(

				'charset'=>'utf-8',

				'wordwrap'=> FALSE,

				'mailtype' => 'html'

				);

				

				$this->email->initialize($config);

				
				// cargo informacion que va a estar en el correo

				$data['email'] = $_SESSION['email'];

				$data['name'] = $_SESSION['name'];

				$data['image'] = $_SESSION['img'];

				$data['user'] = $_SESSION['user'];

				$data['name_event'] = $name;

				$data['place_event'] = $place;
				
				$data['category'] = $category;

				$data['date_event'] = $date;

				$data['description_event'] = $description;

				$data['id_event'] = $done;
				 
				$country_name = $this->phonecard_model->get_countries3( array("id_countries" => $country));
				$country_name = $country_name[0];
				
				$data['country'] = $country_name['name'];
				 
				switch($category){
				
					case 1 : $data['category'] = $this->lang->line('tarjetas_telefonicas');
					break;
					
				}		
				 
				
				// traduzco el correo
				
				$data['title_email'] = $this->lang->line('has_sido_invitado_a_un_evento_nuevo');
				
				$data['has_invited'] = $this->lang->line('te_ha_invitado_a_un_evento');  
				
				$data['know_details'] = $this->lang->line('conocer_detalles_del_evento');  
				
				$data['view_more'] = $this->lang->line('ver_mas');  
				
				$data['unsuscribe'] = $this->lang->line('por_favor_no_quiero_recibir_mensajes_collecworld');  
				
				$data['send_by'] = $this->lang->line('este_mensaje_es_enviado_por_collecworld_y_entregado_a');  
				
				$data['namet'] = $this->lang->line('nombre');  
				
				$data['datet'] = $this->lang->line('fecha');  
				
				$data['placet'] = $this->lang->line('lugar');  
				
				$data['countryt'] = $this->lang->line('pais'); 
				
				$data['categoryt'] = $this->lang->line('event_categoria'); 
								
				$data['descriptiont']  = $this->lang->line('descripcion');  
				

				$mesg = $this->load->view('templates/email/event_invitation',$data, TRUE);	

				

				$this->email->from('no-reply@collecworld.com', 'Collecworld');

				$this->email->to($invited_info[$i]['email']);  

				

				$this->email->subject($data['title_email']);

				$this->email->message($mesg);	

				

				$this->email->send();

				//FIN ENVIO CORREO CONFIRMACION

			}

			

		}

		if ( $done ){

			header('Location: '.base_url().'index.php/event/'.$done);

		}

		else{

			header('Location: '.base_url().'index.php/event/create?err=0');

		}

	}

	

	public function edit( $event_id ){

		
		if ( !$_SESSION['init'] ){

			header('Location: '.base_url());

		}

		

		if ( !isset($_SESSION['id_users']) ){

			header('Location: '.base_url().'index.php/login');

		}

		
		$data['collectibles_count'] = $this->getCollectiblesCount();

		$this->load->model('user_model');

		$this->load->model('collecworld_model');

		$this->load->model('phonecard_model');

		

		$data['notifications'] = $this->user_model->getNotifications();

		$data['event'] = $this->collecworld_model->getEvent($event_id);

		$data['countries'] = $this->phonecard_model->get_countries();

		$data['categories'] = $this->phonecard_model->get_categories();

		

		if ( $data['event'] ){

			$data['title'] = 'Edit "'.$data['event']['name'].'"';

			

			$this->load->view('templates/header', $data);

			$this->load->view('pages/event/edit_event', $data);

			$this->load->view('templates/footer', $data);

		}

		else{

			show_404(base_url().'index.php/event/'.$event_id,false);

		}

		

	}

	

	public function edit_go(){

		if ( !$_SESSION['init'] ){

			header('Location: '.base_url());

		}

		

		if ( !isset($_SESSION['id_users']) ){

			header('Location: '.base_url().'index.php/login');

		}

		
		$data['collectibles_count'] = $this->getCollectiblesCount();

		$name = $this->input->post('name');

		$country = $this->input->post('country');

		$place = $this->input->post('place');

		$date = $this->input->post('date');

		$category = $this->input->post('category');

		$description = $this->input->post('description');

		$id_event = $this->input->post('id_event');

		$private = $this->input->post('private');

		

		$this->load->model('collecworld_model');

		$done = $this->collecworld_model->editEvent($id_event,$name,$country,$place,$date,$category,$description,$private);

		

		if ( $done ){

			header('Location: '.base_url().'index.php/event/'.$id_event);

		}

		else{

			header('Location: '.base_url().'index.php/edit/event/'.$id_event.'?err=0');

		}

		

	}

	

	public function invite( $id_event ){


		$data['collectibles_count'] = $this->getCollectiblesCount();
		$this->load->model('collecworld_model');
		$this->load->model('user_model');

		$data['event'] = $this->collecworld_model->getEvent($id_event);


		$friends = $this->input->post('friends');

		$this->collecworld_model->event_invite($id_event , $friends);	
		
		for($i=0; $i<count($friends); $i++){
			
		$info = $this->user_model->getUser($friends[$i]);	
		
		$info=$info[0];
		
		
		$this->load->model('phonecard_model');
		$country_info = $this->phonecard_model->get_countries( array("id_countries" => $info['id_countries']));
		$country_info = $country_info[0];
		
		switch($country_info['language']){

		case 1 : include $_SERVER['DOCUMENT_ROOT']."/lang/email/email_es.php"; break;
		
		default : include $_SERVER['DOCUMENT_ROOT']."/lang/email/email_en.php"; break;
			
		}	
		
		$data['title_email'] = $title_emaile;	
		
		$data['has_invited'] = $has_invited;
		
		$data['know_details'] = $know_details;
		
		$data['unsuscribe'] = $unsuscribe;
		
		$data['send_by'] = $send_by;
		
		$data['namet'] = $name;
		
		$data['datet'] = $date;
		
		$data['placet'] = $place;
		
		$data['descriptiont']  = $description;
		
		$data['countryt'] = $country;
		
		$data['categoryt'] = $category;

		
		
		
		
		$this->load->library('email');

		
		if($info['email_event']==1){

			

				//ENVIO CORREO CONFIRMACION					

				$config=array(

				'charset'=>'utf-8',

				'wordwrap'=> FALSE,

				'mailtype' => 'html'

				);

				

				$this->email->initialize($config);

				$data['email'] = $_SESSION['email'];

				$data['name'] = $_SESSION['name'];

				$data['image'] = $_SESSION['img'];

				$data['user'] = $_SESSION['user'];

				$data['name_event'] = $data['event']['name'];

				$data['place_event'] = $data['event']['place'];

				$data['date_event'] = $data['event']['date'];

				$data['description_event'] = $data['event']['description'];

				$data['id_event'] = $data['event']['id_events'];
				
				$country_name = $this->phonecard_model->get_countries3( array("id_countries" => $data['event']['id_countries']));
				$country_name = $country_name[0];
				
				$data['country'] = $country_name['name'];
				
				$category_name = $this->phonecard_model->get_categories( array("id_categories" => $data['event']['id_categories']));
				$category_name = $category_name[0];
				
				$data['category'] = $category_name['name'];

				
				$mesg = $this->load->view('templates/email/event_invitation',$data, TRUE);	

				

				$this->email->from('no-reply@collecworld.com', 'Collecworld');

				$this->email->to($info['email']);  

				

				$this->email->subject($title_emaile);

				$this->email->message($mesg);	

				

				$this->email->send();

				//FIN ENVIO CORREO CONFIRMACION

			}
		
		
		
		}


		header('Location: '.base_url().'index.php/event/'.$id_event);

	}

	

	public function events_list(){

		
		if ( !isset($_SESSION['id_users']) ){

			header('Location: '.base_url().'index.php/login');

		}else{
			
			$this->load->model('user_model');

			$data['notifications'] = $this->user_model->getNotifications();
		
			$usr = $_SESSION['user'];		
	
			$u = $this->user_model->isUser(array('user'=>$usr));
			
			$data['intro_event'] = $u['intro_event'];
			
		}

		

		$data['title'] = 'Events list';
		$data['collectibles_count'] = $this->getCollectiblesCount();

		

		$this->load->model('user_model');
		$this->load->model('collecworld_model');
		$this->load->model('phonecard_model');

		$data['notifications'] = $this->user_model->getNotifications();
		$data['logged_user'] = $this->user_model->isUser( array( "id_users" => $_SESSION['id_users'] ) );
		
		$timestamp = strtotime(date('d F Y',time()));
		
		$data['country_events'] = $this->collecworld_model->getEvents('e.id_countries = '.$data['logged_user']['id_countries'].' AND e.date >= '.$timestamp);
		$data['other_events'] = $this->collecworld_model->getEvents('e.id_countries <> '.$data['logged_user']['id_countries'].' AND e.date >= '.$timestamp);
		$data['categories'] = $this->phonecard_model->get_categories();


		$this->load->view('templates/header', $data);
		$this->load->view('pages/event/events_list', $data);
		$this->load->view('templates/footer', $data);
	}

	

}

?>