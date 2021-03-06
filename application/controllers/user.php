<?php

class User extends CW_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
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
 
			$res = $this->user_model->insertUser( $name , $email , $usr , $pass , $country );

			if ( !$res ){
				header('Location: '.base_url().'init?err=1');
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
	
	public function view( $user ){  
	
		$this->landingPageVerification();
		$data['collectibles_count'] = $this->getCollectiblesCount(); 
		 /*
		if ( isset($_SESSION['user']) ){

			$data['not_readed'] = $this->user_model->getUnreadedMessages( $_SESSION['id_users'] );

		}
 */
		$data['user'] = $this->user_model->isUser(array('user'=>$user)); 
		 		
		$data['title'] = ucfirst($data['user']['user']); 
		
		if ( isset($_SESSION['user']) )

			$logged = $_SESSION['user'];

		else

			$logged = NULL;
   
		if ( ($data['user']) && (isset($_SESSION['user']))){ 
			
			$this->load->view('templates/header',$data); 

			if ( strcmp($user,$logged) == 0 ){
				
				$data['notifications'] = $this->user_model->getNotifications();
				
				//$data['activity'] = $this->user_model->get_activity( array("id_users" => $_SESSION['id_users']));

				//$data['intro_profile'] = $data['user']['intro_profile'];
				 
				

			}else{	 
				if ( isset($_SESSION['id_users']) ){

					$data['notifications'] = $this->user_model->getNotifications();

					//$data['isFriend'] = $this->user_model->isFriend($_SESSION['id_users'],$u['id_users']);
					
				} 
				 

			}
			
			$this->load->view('pages/user/profile/profile',$data);

			$this->load->view('templates/footer',$data);


		}else{

			header("Location: ".base_url()."login");

		}

	}
	
	public function profileCollection(){ 
		 
		$data['phonecards_list'] = $this->user_model->select_list(array("id_categories" => 1, "id_users" => $_SESSION['id_users']));
	
		$this->load->view('pages/user/profile/collections',$data);
	
	}
	
	public function newList(){ 
		$data['category'] = $this->input->post('category');
		$this->load->view('pages/user/profile/collections_new_list',$data);
	
	}
	
	public function insertList(){ 
		$data['category'] = $this->input->post('category');
		$data['name'] = $this->input->post('name');
		$data['privacy'] = $this->input->post('privacy');
		$data['id_user'] = $this->input->post('id_user');
		
		//verifica que el nombre no este entre las listas por defecto
		$default_list = array("coleccion", "colección", "collection", "deseo", "wish", "intercambio", "exchange", "venta", "sell");
		 
		 if (in_array($data['name'], $default_list)) {
			echo false;
			return; 
		 }
		
		//verifica que la lista no exista
		$list = $this->user_model->select_list(array("id_categories" => $data['category'], "id_users" => $data['id_user'], "name" => $data['name']));
		 
		if($list == false){
			
			//inserta la lista
			$this->user_model->insert_list($data['category'], $data['name'], $data['privacy'], $data['id_user']);
			
			echo true;
			
		}else{
			
			echo false;
			
		}
	
	}
	
	public function viewList(){ 
	 	
		$id_lists = $this->input->post('id_lists');	
		 
		if(is_numeric($id_lists)){ 
		
			$list = $this->user_model->select_list(array("id_lists" => $id_lists));
			$data['list'] = $list[0]; 
			
			$data['list_items'] = $this->user_model->select_list_items_countries(array("id_lists" => $id_lists)); 
			  
		}else{  
		
			$list = $this->user_model->select_list(array("name" => $id_lists));
			
			if($list){
				
				$data['list'] = $list[0];
				$data['list_items'] = $this->user_model->select_list_items_countries(array("id_lists" => $id_lists)); 
				
			}else{
		
				$data['list']['table_name'] = $id_lists;
				$data['list']['id_categories'] = 1; 
				$data['list_items'] = '';
				
				switch($id_lists){
					case 'collection' : $data['list']['name'] = $this->lang->line('coleccion');
					break;
					case 'wish' : $data['list']['name'] = $this->lang->line('deseo');
					break;
					case 'exchange' : $data['list']['name'] = $this->lang->line('intercambio');
					break;
					case 'sell' : $data['list']['name'] = $this->lang->line('venta');
					break;
				}
			}
			
			
		}
		 
		$this->load->view('pages/user/profile/collections_view_list',$data);
	
	}
	
	public function editList(){  
		$data['name'] = $this->input->post('name');
		$data['privacy'] = $this->input->post('privacy');
		$data['id_lists'] = $this->input->post('id_lists');
		$data['id_users'] = $this->input->post('id_users');
		
		//verifica que el nombre no este entre las listas por defecto
		$default_list = array("coleccion", "colección", "collection", "deseo", "wish", "intercambio", "exchange", "venta", "sell");
		 
		 if (in_array($data['name'], $default_list)) {
			echo false;
			return; 
		 }
		
		//verifica que la lista no exista
		$list = $this->user_model->select_list(array("name" => $data['name'], "privacy" => $data['privacy'], "id_users" => $data['id_users']));
		
		if($list == false){ 
		
			//actualiza la lista
			$this->user_model->update_list($data['name'], $data['privacy'], $data['id_lists']);
			
			echo $data['name'];
			
		}else{ 
			echo false;
			
		}
	
	}
	 
	public function listShowCatalogs(){ 
	 	
		$id_lists = $this->input->post('id_lists');	
		$id_countries = $this->input->post('id_countries');	
		
		$data['list_item_cw'] = $this->user_model->select_list_items_countries(array("id_lists" => $id_lists)); 
		$data['list_item_cw'] = $data['list_item_cw'][0];
		 
		$this->load->view('pages/user/profile/collections_view_list_catalogs',$data);
	
	} 
	
	public function listShowCirculations(){ 
	 	
		$id_lists = $this->input->post('id_lists');	
		$id_countries = $this->input->post('id_countries');	
		
		$data['list_items'] = $this->user_model->select_list_items_circulations(array("id_lists" => $id_lists, "id_countries" => $id_countries));  
		 
		$this->load->view('pages/user/profile/collections_view_list_circulations',$data);
	
	}
	
	public function listShowCompanies(){ 
	 	
		$id_lists = $this->input->post('id_lists');	
		$id_countries = $this->input->post('id_countries');	
		$phonecards_circulation = $this->input->post('phonecards_circulation');	
		
		$data['list_items'] = $this->user_model->select_list_items_companies(array("id_lists" => $id_lists, "id_countries" => $id_countries, "phonecards_circulation" => $phonecards_circulation));  
		 
		$this->load->view('pages/user/profile/collections_view_list_companies',$data);
	
	}
	
	public function listShowSystems(){ 
	 	
		$id_lists = $this->input->post('id_lists');	
		$id_countries = $this->input->post('id_countries');	
		$phonecards_circulation = $this->input->post('phonecards_circulation');	
		$id_phonecards_companies = $this->input->post('id_phonecards_companies');	
		
		$data['list_items'] = $this->user_model->select_list_items_systems(array("id_lists" => $id_lists, "id_countries" => $id_countries, "phonecards_circulation" => $phonecards_circulation, "id_phonecards_companies" => $id_phonecards_companies));  		 
		$this->load->view('pages/user/profile/collections_view_list_systems',$data);
	
	}
	
	public function listShowPhonecards( $id_lists, $id_countries, $phonecards_circulation, $id_phonecards_companies, $id_phonecards_systems ){ 
		 
		$this->landingPageVerification();
		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['notifications'] = $this->user_model->getNotifications(); 
		
		$data['title'] = ucfirst($_SESSION['user']).' - Collection';
	
		$this->load->view('templates/header',$data); 
		
		$data['list_items'] = $this->user_model->select_list_items_phonecards_cw(array("id_lists" => $id_lists, "id_countries" => $id_countries, "phonecards_circulation" => $phonecards_circulation, "id_phonecards_companies" => $id_phonecards_companies, "id_phonecards_systems" => $id_phonecards_systems));  		 
		 
					
		$this->load->view('pages/user/profile/collections_view_list_phonecards_cw',$data);

		$this->load->view('templates/footer',$data);
	
	}

}