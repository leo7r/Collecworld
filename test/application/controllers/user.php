<?php

class User extends CW_Controller {
	
	public function __construct(){

		parent::__construct();

		

		if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

		}

	}

	public function viewAccount(){

		

		$usr = $_SESSION['user'];

		

		header("Location: ".base_url()."index.php/".$usr);

	}
	
	public function view( $usr ){
 
		if ( !isset($_SESSION['init']) ){

			

			if ( isset($_COOKIE['init']) ){

				$_SESSION['init'] = $_COOKIE['init'];

			}

			else{

				header('Location: '.base_url());

			}

		}

				

		$this->load->model('user_model');
		$data['collectibles_count'] = $this->getCollectiblesCount();

		

		if ( isset($_SESSION['user']) ){

			$data['not_readed'] = $this->user_model->getUnreadedMessages( $_SESSION['id_users'] );

		}

		
		$u = $this->user_model->isUser(array('user'=>$usr));

		$data['title'] = $u['name'];


		if ( isset($_SESSION['user']) )

			$logged = $_SESSION['user'];

		else

			$logged = NULL;

		

		if ( ($u) && (isset($_SESSION['user']))){

			$data['user'] = $u;

			

			$this->load->view('templates/header',$data);

			

			if ( strcmp($usr,$logged) == 0 ){

				$data['activity'] = $this->user_model->get_activity( array("id_users" => $_SESSION['id_users']));

				$data['notifications'] = $this->user_model->getNotifications();

				$data['intro_profile'] = $u['intro_profile'];
				

				$this->load->view('pages/account',$data);

			} 

			else{				
				
		
				$this->user_model->profile_glass($u['id_users'],$_SESSION['id_users']);
				if ( isset($_SESSION['id_users']) ){

					$data['notifications'] = $this->user_model->getNotifications();

					$data['isFriend'] = $this->user_model->isFriend($_SESSION['id_users'],$u['id_users']);
					
				}
				
				$this->load->view('pages/user',$data);


			}

			$this->load->view('templates/footer',$data);


		}

		else{

			header("Location: ".base_url()."index.php/login");

		}

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

	

	public function activate_user($id , $user, $type){

		

		$data['title'] = "User Activation";

		

		$this->load->model('user_model');

		$data['user']=$this->user_model->getUser($id);

		

		if($data['user']){

			

			foreach($data['user'] as $userinfo){

				$data['user'] = $userinfo['user'];

				$data['id'] = $userinfo['id_users'];

			}

		

			if(($data['id']==$id) && ($data['user']==$user)){

				

				$this->user_model->activateUser($id);

				

				switch($type){

				

				case '1' : {

				

				$this->load->view('templates/header',$data);

				$this->load->view('pages/user_activation',$data);

				$this->load->view('templates/footer',$data);



				} break;

				

				case '2' : {

				

				header('Location: '.base_url().'index.php/explore/phonecard');

				

				} break;

				

				case '3' : {

				

				header('Location: '.base_url().'index.php/'.$data['user'].'#sec=9');

				

				} break;

				

				}

			

			}else{

				

				$this->load->view('templates/header',$data);

				$this->load->view('pages/user_activation_error',$data);

				$this->load->view('templates/footer',$data);

			

			}

		}else{

			

				$this->load->view('templates/header',$data);

				$this->load->view('pages/user_activation_error',$data);

				$this->load->view('templates/footer',$data);

			

			

		}

		

		

	}

	

	public function login(){

		

		$usr = $this->input->post('user');

		$pass = $this->input->post('pass');

		

		if ( $usr and $pass ){

			

			$this->load->model('user_model');

			

			if ( $this->user_model->login($usr,$pass) ){

				?>

                	<script>

					 history.back();

					</script>

                <?php

			}

			else{

				header('Location: '.base_url().'index.php/init?err=0');

			}

		}

		

	}

	

	public function edit_user(){


		$config['upload_path'] = './users/img/';

		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		

		$this->load->library('upload', $config);

		$this->load->model('user_model');



		if ( ! $this->upload->do_upload('image')){

			$data['user_img'] = '';

			//echo $this->upload->display_errors();

			//return;

		}

		else{

			$data['user_img'] = $this->upload->data();

			@session_start();

			$file_name = $_SESSION['user'].$data['user_img']['file_ext'];

			

			$usr = $this->user_model->isUser(array('user'=>$_SESSION['user']));

			unlink($data['user_img']['file_path'].$usr['image']);

			rename($data['user_img']['full_path'],$data['user_img']['file_path'].$file_name);

			

			$config['image_library'] = 'gd2';

			$config['source_image']	= $data['user_img']['file_path'].$file_name;

			$config['width'] = 210;

			$config['height'] = 210;

			

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			

			$data['user_img'] = $file_name;

		}

		

		if ( $this->user_model->edit_user( $data ) ){

			header('Location: '.base_url().'index.php/'.$_SESSION['user'].'#don=1');

		}

		else{

			header('Location: '.base_url().'index.php/init');

		}

	}

	

	public function sendFeedback(){

		

		$text = $this->input->post('feedback-content-in');

		$usr = $this->input->post('fb-user');

		$email = $this->input->post('email');

		$feel = $this->input->post('feel');

		$about = $this->input->post('about');

		

				

		$config['upload_path'] = './feedback/';

		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		

		$this->load->library('upload', $config);



		if ( ! $this->upload->do_upload('feedback-file')){

			$file = '';

		}

		else{

			$file = $this->upload->data();

			

			$rnd = rand(0,1000);

			$file_name = strval(time())+strval($rnd).$file['file_ext'];

			$new_file = $file['file_path'].$file_name;

			

			rename($file['full_path'],$new_file);

		}

		

		if ( !isset($file_name) )

			$file_name = '';

		

		$this->load->model('user_model');

		$this->user_model->sendFeedback($usr,$text,$file_name,$email,$feel,$about);

		

		header('Location: '.$this->input->post('onFinish').'?info='.$this->lang->line('comentario_enviado') );

	}
	
	public function forgot_password(){
		
			$data['email'] = $this->input->post('email');  
			$data['send'] = 0;
			
			$this->load->model('user_model');
			$data['collectibles_count'] = $this->getCollectiblesCount();
			 
			
			if($data['email']){ 
				
				$data['user'] = $this->user_model->isUser(array('email'=>$data['email']));
				
				if(!$data['user']){ 
					$data['send'] = 0; 
				}else{  
				
					$data['send'] = 1;
				
					$this->load->library('email'); 
				
					$data['title_email'] = $this->lang->line('solicitud_cambio_contrasena');	 
					$data['unsuscribe'] = $this->lang->line('por_favor_no_quiero_recibir_mensajes_collecworld');  
					$data['send_by'] = $this->lang->line('este_mensaje_es_enviado_por_collecworld_y_entregado_a');  
					$data['change'] = $this->lang->line('cambiar');  
					$data['change_password'] = $this->lang->line('cambiar_contrasena'); 
					$data['make_request'] = $this->lang->line('has_realizado_solicitud'); 
					$data['request_change_password'] = $this->lang->line('recibido_solicitud_cambio_contrasena'); 
					$data['you_dont_request_change_password'] = $this->lang->line('no_solicitaste_cambio_contrasena'); 
					 
					//ENVIO CORREO CONFIRMACION					
		
					$config=array( 
					'charset'=>'utf-8', 
					'wordwrap'=> FALSE, 
					'mailtype' => 'html' 
					);
		 
					$this->email->initialize($config);  
					$mesg = $this->load->view('templates/email/reset_password',$data, TRUE);	
		
					$this->email->from('no-reply@collecworld.com', 'Collecworld');
		
					$this->email->to($data['email']);  
		 
					$this->email->subject('te mando tu contraseña');
		
					$this->email->message($mesg);	
		
					$this->email->send();
		
					//FIN ENVIO CORREO CONFIRMACION
					
				}
			}
			
			$data['title'] = $this->lang->line('restablecer_contrasena');
			
			$this->load->view('templates/header',$data);
	
			$this->load->view('pages/forgot_password/forgot_password.php',$data);
	
			$this->load->view('templates/footer',$data);
		
		
	}
	
	public function reset_password($id, $user){
		
		
		$this->load->model('user_model');
		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['user'] = $this->user_model->isUser(array('id_users'=>$id , 'user'=>$user));
		
		if($data['user']){
			$data['title'] = $this->lang->line('escoge_nueva_contrasena');
			
			$send = $this->input->post('send');
			$pass = $this->input->post('pass');
			$pass2 = $this->input->post('pass2');
			
			if($send){
				if(($pass) && ($pass2)){
					
					if(strlen($pass)>=6){ 
					
						if(strcmp($pass, $pass2)==0){
							
							$res = $this->user_model->change_password($data['user']['id_users'],$pass);
							 
							if($res==true){
								
								$data['ok'] =1;
								
							}else{
								
								$data['error'] = 4;
								
							}
							
						}else{
							
							$data['error'] = 3;
							
						}
					}else{
						
						$data['error'] = 2;
						
					}
						
				}else{
					
					$data['error'] = 1;
				}
			}
				
			$this->load->view('templates/header',$data);
	
			$this->load->view('pages/forgot_password/reset_password.php',$data);
	
			$this->load->view('templates/footer',$data);
		}else{ 

			header('Location: '.base_url().'index.php/init');
			
		}
	}
	
	public function show_phonecard_collection( $user , $list_id , $id_countries , $id_companies , $system , $catalog , $no_variations = 0 , $lack = 0 ){
		
		//echo $user.' | '.$list_id.' | '.$country_id.' | '.$company_id.' | '.$system.' | '.$catalog;
		
		$data['title'] = 'Collection';
		$data['c_user'] = $user;
		$data['c_list'] = $list_id;
		$data['c_country'] = $id_countries;
		$data['c_company'] = $id_companies;
		$data['c_system'] = $system;
		$data['c_catalog'] = $catalog;
		$data['c_no_variations'] = $no_variations;
		$data['c_lack'] = $lack;
		
		$this->load->model('user_model');
		$this->load->model('phonecard_model');
		
		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['notifications'] = $this->user_model->getNotifications();
		
		$u = $this->user_model->isUser(array('user'=>$user));
		
		$data['country'] = $this->phonecard_model->get_countries(array('id_countries'=>$id_countries));
		$data['country'] = $data['country'][0];
		$data['company'] = $this->phonecard_model->get_phonecards_companies(array('id_phonecards_companies'=>$id_companies));
		$data['company'] = $data['company'][0];
		$data['phonecards'] = $this->phonecard_model->get_user_collection( $u['id_users'] , $list_id , $id_countries , $id_companies , $system , $catalog , $no_variations , $lack );
				
		$this->load->view('templates/header',$data);	
		$this->load->view('pages/account/collection.php',$data);
		$this->load->view('templates/footer',$data);
		
	}

		public function show_phonecard_collection_pdf( $user , $list_id , $id_countries , $id_companies , $system , $catalog , $no_variations = 0 , $lack = 0 ){
		
		$data['title'] = 'Collection';
		$data['c_user'] = $user;
		$data['c_list'] = $list_id;
		$data['c_country'] = $id_countries;
		$data['c_company'] = $id_companies;
		$data['c_system'] = $system;
		$data['c_catalog'] = $catalog;
		$data['c_no_variations'] = $no_variations;
		$data['c_lack'] = $lack;
		
		$this->load->model('user_model');
		$this->load->model('phonecard_model');
		
		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['notifications'] = $this->user_model->getNotifications();
		
		$u = $this->user_model->isUser(array('user'=>$user));
		
		$data['country'] = $this->phonecard_model->get_countries(array('id_countries'=>$id_countries));
		$data['country'] = $data['country'][0];
		$data['company'] = $this->phonecard_model->get_phonecards_companies(array('id_phonecards_companies'=>$id_companies));
		$data['company'] = $data['company'][0];
		$data['phonecards'] = $this->phonecard_model->get_user_collection( $u['id_users'] , $list_id , $id_countries , $id_companies , $system , $catalog , $no_variations , $lack );
		
		$this->load->helper(array('dompdf', 'file'));
     // page info here, db calls, etc.   
     $html= $this->load->view('pages/pdf/collection.php', $data,true);
     $html=utf8_decode($html);
     pdf_create($html, 'xyz');		
	}
	public function show_phonecard_collection_xls( $user , $list_id , $id_countries , $id_companies , $system , $catalog , $no_variations = 0 , $lack = 0 ){
		
		$data['title'] = 'Collection';
		$data['c_user'] = $user;
		$data['c_list'] = $list_id;
		$data['c_country'] = $id_countries;
		$data['c_company'] = $id_companies;
		$data['c_system'] = $system;
		$data['c_catalog'] = $catalog;
		$data['c_no_variations'] = $no_variations;
		$data['c_lack'] = $lack;
		
		$this->load->model('user_model');
		$this->load->model('phonecard_model');
		
		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['notifications'] = $this->user_model->getNotifications();
		
		$u = $this->user_model->isUser(array('user'=>$user));
		
		$data['country'] = $this->phonecard_model->get_countries(array('id_countries'=>$id_countries));
		$data['country'] = $data['country'][0];
		$data['company'] = $this->phonecard_model->get_phonecards_companies(array('id_phonecards_companies'=>$id_companies));
		$data['company'] = $data['company'][0];
		$query = $this->phonecard_model->get_user_collection( $u['id_users'] , $list_id , $id_countries , $id_companies , $system , $catalog , $no_variations , $lack );
		
			$this->load->helper('php-excel');

		   $fields = ( $field_array[] = array ("Nombre", "Tipo de sistema", "Logo","Fecha de emisión ","Tiraje","Valor Nominal (precio)","Variante descriptiva") );
		  
		   for ( $i = 0 ; $i < count($query) ; $i++ ){  

		   	if(strlen($query[$i]['issued_on']) != 0 ){
			 $date=$query[$i]['issued_on'];
			}else{
			 $date=$query[$i]['known_date'];
			}

		         $data_array[] = array( $query[$i]['name'], $query[$i]['system'],$query[$i]['logo'],$date,$query[$i]['print_run'],$query[$i]['face_value'],$query[$i]['descriptive_variation']);
		         }
		   $xls = new Excel_XML;
		   $xls->addArray ($field_array);
		   $xls->addArray ($data_array);
		   $xls->generateXML ( "archiveXls" );	

	}


	public function profile_glass($usr){

		//echo "<script>alert('".$usr."');</script>";


			if ( !isset($_SESSION['init']) ){

			

			if ( isset($_COOKIE['init']) ){

				$_SESSION['init'] = $_COOKIE['init'];

			}

			else{

				header('Location: '.base_url());

			}

		}

		$this->load->model('user_model');
		$data['collectibles_count'] = $this->getCollectiblesCount();

		

		if ( isset($_SESSION['user']) ){

			$data['not_readed'] = $this->user_model->getUnreadedMessages( $_SESSION['id_users'] );

		}

		$u = $this->user_model->isUser(array('user'=>$usr));

		$data['title'] = $u['name'];


		if ( isset($_SESSION['user']) )

			$logged = $_SESSION['user'];

		else

			$logged = NULL;

		if ( ($u) && (isset($_SESSION['user'])&&($_SESSION['user']==$usr))){

			$data['user'] = $u;
	


				$data['activity'] = $this->user_model->get_activity( array("id_users" => $_SESSION['id_users']));

				$data['notifications'] = $this->user_model->getNotifications();

				$data['intro_profile'] = $u['intro_profile'];


			
		}

		else{

			header("Location: ".base_url()."index.php/init");

		}

		$users_profile=$this->user_model->get_profile_glass(array('u.user'=>$usr));

		$data['users_num']=$users_profile['num'];

		$data['users_profile']=$users_profile['users'];

		$this->load->view('templates/header',$data);	

		$this->load->view('pages/profile_glass',$data);	
		
		$this->load->view('templates/footer',$data);

	}

		public function user_administration(){

		//echo "<script>alert('".$usr."');</script>";


			if ( !isset($_SESSION['init']) ){

			

			if ( isset($_COOKIE['init']) ){

				$_SESSION['init'] = $_COOKIE['init'];

			}

			else{

				header('Location: '.base_url());

			}

		}

		$this->load->model('user_model');
		$data['collectibles_count'] = $this->getCollectiblesCount();

		

		if ( isset($_SESSION['user']) ){

			$data['not_readed'] = $this->user_model->getUnreadedMessages( $_SESSION['id_users'] );

		}

		$u = $this->user_model->isUser(array('user'=>$usr));

		$data['title'] = $u['name'];


		if ( isset($_SESSION['user']) )

			$logged = $_SESSION['user'];

		else

			$logged = NULL;

		if ( ($u) && (isset($_SESSION['user'])&&($_SESSION['user']==$usr))){

			$data['user'] = $u;
	


				$data['activity'] = $this->user_model->get_activity( array("id_users" => $_SESSION['id_users']));

				$data['notifications'] = $this->user_model->getNotifications();

				$data['intro_profile'] = $u['intro_profile'];


			
		}

		else{

			header("Location: ".base_url()."index.php/init");

		}

		$users_profile=$this->user_model->get_profile_glass(array('u.user'=>$usr));

		$data['users_num']=$users_profile['num'];

		$data['users_profile']=$users_profile['users'];

		$this->load->view('templates/header',$data);	

		$this->load->view('pages/profile_glass',$data);	
		
		$this->load->view('templates/footer',$data);

	}

}