<?php



class Trade extends CW_Controller{ 

	public function __construct(){

		parent:: __construct();

		
		@session_start();

		if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

		}

		if ( !$_SESSION['init'] ){

			

			if ( isset($_COOKIE['init']) ){

				$_SESSION['init'] = $_COOKIE['init'];

			}

			else{

				header('Location: '.base_url());

			}

		}

	}	

	public function select( $category=NULL, $trade_article=NULL){

		$data['collectibles_count'] = $this->getCollectiblesCount();
		$this->load->model('user_model');

		$usr = $_SESSION['user'];		

		$u = $this->user_model->isUser(array('user'=>$usr));

		if ( $u ){
			$data['title']='Select Trade Type';

			$data['user0'] = $u;

			$data['activity'] = $this->user_model->get_activity( array("id_users" => $_SESSION['id_users']));

			$data['notifications'] = $this->user_model->getNotifications();

			$data['category'] = $category;

			$data['trade_article'] = $trade_article;
			$this->load->view('templates/header',$data);
			$this->load->view('pages/trade/select',$data);
			$this->load->view('templates/footer',$data);
		}

		else{

			header("Location: ".base_url()."index.php/init");

		}

	}

	

	public function select_only_user ( $trade_user ){

		$data['collectibles_count'] = $this->getCollectiblesCount();
		$this->load->model('user_model');
		$usr = $_SESSION['user'];		

		$u = $this->user_model->isUser(array('user'=>$usr));

		if ( $u ){
			$data['title']='Select Trade Type';
			$data['user0'] = $u;
			$data['activity'] = $this->user_model->get_activity( array("id_users" => $_SESSION['id_users']));
			$data['notifications'] = $this->user_model->getNotifications();
			$data['trade_user'] = $this->user_model->isUser(array('user'=>$trade_user));
			$this->load->view('templates/header',$data);
			$this->load->view('pages/trade/select',$data);	
			$this->load->view('templates/footer',$data);

		}

		else{

			header("Location: ".base_url()."index.php/init");

		}
	}
	
	public function create( $type, $category, $trade_article, $trade_users_id = NULL , $trade_user=NULL ){

		$data['collectibles_count'] = $this->getCollectiblesCount();
		$this->load->model('user_model');

		$usr = $_SESSION['user'];		

		$u = $this->user_model->isUser(array('user'=>$usr));
	
		if (strcmp( $type , 'exchange') == 0 ){
			
			$data['intro_exchange'] = $u['intro_exchange'];
	
		}else{
			
			$data['intro_buy'] = $u['intro_buy'];
			
		}

		if ( $u ){
			
			$data['title']= ucwords($type);
			$data['user0'] = $u;
			$data['activity'] = $this->user_model->get_activity( array("id_users" => $_SESSION['id_users']));
			$data['notifications'] = $this->user_model->getNotifications();

			if ( $trade_user ){
				$data['trade_user'] = $this->user_model->isUser(array('user'=>$trade_user));

			}
			$data['type'] = $type;
			$data['category'] = $category;
			$data['trade_article'] = $trade_article;
			$data['trade_users_id'] = $trade_users_id;
			
			$this->load->view('templates/header',$data);
			$this->load->view('pages/trade/trade',$data);
			$this->load->view('templates/footer',$data);
		}

		else{
			header("Location: ".base_url()."index.php/init");
		}

	}

	public function create_only_user ( $type, $trade_user ){

		$data['collectibles_count'] = $this->getCollectiblesCount();
		$this->load->model('user_model');

		$usr = $_SESSION['user'];

		$u = $this->user_model->isUser(array('user'=>$usr));

		if (strcmp( $type , 'exchange') == 0 ){
			
			$data['intro_exchange'] = $u['intro_exchange'];
	
		}else{
			
			$data['intro_buy'] = $u['intro_buy'];
			
		}
		if ( $u ){
			$data['title']= ucwords($type);
			$data['user0'] = $u;
			$data['activity'] = $this->user_model->get_activity( array("id_users" => $_SESSION['id_users']));
			$data['notifications'] = $this->user_model->getNotifications();
			$data['type'] = $type;
			$data['trade_user'] = $this->user_model->isUser(array('user'=>$trade_user));
			
			$this->load->view('templates/header',$data);
			$this->load->view('pages/trade/trade',$data);
			$this->load->view('templates/footer',$data);
		}

		else{
			header("Location: ".base_url()."index.php/init");

		}
	}

	

	public function exchange_step2( $trade_user ){
		
		$data['collectibles_count'] = $this->getCollectiblesCount();
		$this->load->model('user_model');

		

		$usr = $_SESSION['user'];

		$u = $this->user_model->isUser(array('user'=>$usr));

		

		if ( $u ){

			

			$type = 'exchange';

			$selected_items1 = $this->input->post('selected_items');

			$category = $this->input->post('category');

			

			$data['title']= ucwords($type);

			$data['user0'] = $u;

			

			

			$data['activity'] = $this->user_model->get_activity( array("id_users" => $_SESSION['id_users']));

			$data['notifications'] = $this->user_model->getNotifications();

			

			$data['type'] = $type;

			$data['trade_user'] = $this->user_model->isUser(array('user'=>$trade_user));

			$data['step'] = "2";

			$data['selected_items1'] = $selected_items1;

			

			if ( $category == 1 ) 

				$data['category'] = 'phonecard';

			

			$this->load->view('templates/header',$data);

			$this->load->view('pages/trade/trade',$data);

			$this->load->view('templates/footer',$data);

		}

		else{

			header("Location: ".base_url()."index.php/init");

		}

	}

	

	public function trade_buy(){

		$data['collectibles_count'] = $this->getCollectiblesCount();
		
		$this->load->model('phonecard_model');

		$this->load->model('coin_model');

		$category = (int) $this->input->post('category');

		$trade_user = (int) $this->input->post('trade_user');

		$id_user = (int) $this->input->post('id_user');

		$selected_items = $this->input->post('selected_items');

		

		$done = FALSE;

	
			$this->load->model('trade_model');
			$done = $this->trade_model->new_buy( $category , $id_user , $trade_user , $selected_items );
			

		
		$this->load->model('user_model');
		$user_info = $this->user_model->isUser(array("id_users" => $trade_user));
		
		$this->load->library('email');
		
		if($user_info['email_trade']==1){


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
				
				$data['trade_id'] = $done;
				
				$data['email_send'] = $user_info['email'];
				
				
				$category_name = $this->phonecard_model->get_categories( array("id_categories" => $category));
				$category_name = $category_name[0];
				
				$data['category'] = $category_name['name'];
				
				$selected_items_array = explode(',',$selected_items);
				
				for($i=0; $i<count($selected_items_array); $i++){
					
				$data['items'][$i] = $this->phonecard_model->get_phonecard_full( $selected_items_array[$i] );
					
				} 
				 
				// traduzco el correo
				
				$data['request_buy'] = $this->lang->line('te_ha_solicitado_una_compra');   
				
				$data['wants_buy'] = $this->lang->line('quiere_comprarte_estos_articulos'); 
				
				$data['phonecards'] = $this->lang->line('tarjetas_telefonicas'); 
				
				$data['view_more'] = $this->lang->line('ver_mas');  
				
				$data['know_more'] = $this->lang->line('conocer_detalles_del_comercio');  
				
				$data['unsuscribe'] = $this->lang->line('por_favor_no_quiero_recibir_mensajes_collecworld');  
				
				$data['send_by'] = $this->lang->line('este_mensaje_es_enviado_por_collecworld_y_entregado_a');  
								

				$mesg = $this->load->view('templates/email/buy_request',$data, TRUE);	

				

				$this->email->from('no-reply@collecworld.com', 'Collecworld');

				$this->email->to($user_info['email']);  

				

				$this->email->subject($data['name'].' '.$data['request_buy']);

				$this->email->message($mesg);	

				

				$this->email->send();

				//FIN ENVIO CORREO CONFIRMACION

			}
			

		if ( $done ){

			$data['title']= 'Trade done';

			

			$this->load->model('user_model');

			$data['activity'] = $this->user_model->get_activity( array("id_users" => $_SESSION['id_users']));

			$data['notifications'] = $this->user_model->getNotifications();

			$data['trade_user'] = $this->user_model->isUser(array('id_users'=>$trade_user));

			$data['trade_id'] = $done;

			

			$this->load->view('templates/header',$data);

			$this->load->view('pages/trade/trade_done',$data);

			$this->load->view('templates/footer',$data);

		}

	}

	

	public function trade_exchange(){

		$data['collectibles_count'] = $this->getCollectiblesCount();
		$this->load->model('phonecard_model');	

		$category = (int) $this->input->post('category');

		$trade_user = (int) $this->input->post('trade_user');

		$id_user = (int) $this->input->post('id_user');

		$selected_items = $this->input->post('selected_items');

		$selected_items1 = $this->input->post('selected_items1');

		

		$done = FALSE;

		

		switch( $category ){

		

		case 1:

			

			$this->load->model('trade_model');

			$done = $this->trade_model->new_exchange( $category , $id_user , $trade_user , $selected_items , $selected_items1 );

			break;

		

		}

		$this->load->model('user_model');
		$user_info = $this->user_model->isUser(array("id_users" => $trade_user));
		
		$this->load->library('email');
		
		if($user_info['email_trade']==1){


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
				
				$data['trade_id'] = $done;
				
				$data['email_send'] = $user_info['email'];
				
				
				$category_name = $this->phonecard_model->get_categories( array("id_categories" => $category));
				$category_name = $category_name[0];
				
				$data['category'] = $category_name['name'];
				
				$selected_items_array = explode(',',$selected_items);
				
				for($i=0; $i<count($selected_items_array); $i++){
					
				$data['items'][$i] = $this->phonecard_model->get_phonecard_full( $selected_items_array[$i] );
					
				}
				
				$selected_items_array1 = explode(',',$selected_items1);
				
				for($i=0; $i<count($selected_items_array1); $i++){
					
				$data['items1'][$i] = $this->phonecard_model->get_phonecard_full( $selected_items_array1[$i] );
					
				}
			 
				$this->load->model('phonecard_model'); 
				
				// traduzco el correo
				
				$data['request_exchange'] = $this->lang->line('te_ha_solicitado_un_intercambio'); 
				
				$data['wants_give'] = $this->lang->line('quiere_darte_estos_articulos'); 
				
				$data['in_exchange'] = $this->lang->line('a_cambio_de_estos_articulos_tuyos');  
								
				$data['phonecards'] = $this->lang->line('tarjetas_telefonicas'); 
				
				$data['view_more'] = $this->lang->line('ver_mas');  
				
				$data['know_more'] = $this->lang->line('conocer_detalles_del_comercio');  
				
				$data['unsuscribe'] = $this->lang->line('por_favor_no_quiero_recibir_mensajes_collecworld');  
				
				$data['send_by'] = $this->lang->line('este_mensaje_es_enviado_por_collecworld_y_entregado_a');  
								

				$mesg = $this->load->view('templates/email/exchange_request',$data, TRUE);	

				

				$this->email->from('no-reply@collecworld.com', 'Collecworld');

				$this->email->to($user_info['email']);  

				

				$this->email->subject($data['name'].' '.$data['request_exchange']);

				$this->email->message($mesg);	

				

				$this->email->send();

				//FIN ENVIO CORREO CONFIRMACION

			}

		if ( $done ){

			$data['title']= 'Trade done';

			

			$this->load->model('user_model');

			$data['activity'] = $this->user_model->get_activity( array("id_users" => $_SESSION['id_users']));

			$data['notifications'] = $this->user_model->getNotifications();

			$data['trade_user'] = $this->user_model->isUser(array('id_users'=>$trade_user));

			$data['trade_id'] = $done;

			

			$this->load->view('templates/header',$data);

			$this->load->view('pages/trade/trade_done',$data);

			$this->load->view('templates/footer',$data);

		}	

	}

	

	public function trade_details( $id_trade ){

		$data['collectibles_count'] = $this->getCollectiblesCount();
		
		if ( !isset($_SESSION['id_users']) ){
			echo 'Log in';
			return;
		}

		$this->load->model('user_model');
		$this->load->model('trade_model');
		
		$data['title'] = 'Trade details';
		$data['notifications'] = $this->user_model->getNotifications();
		$data['trade'] = $this->trade_model->getTrade($id_trade);
		$data['to_user'] = $this->user_model->isUser(array('id_users'=>$data['trade']['id_trade_users']));
		$data['trade_user'] = $this->user_model->isUser(array('id_users'=>$data['trade']['id_users']));
		$data['trade_users'] = $this->trade_model->get_rates( $data['trade']['id_trade'] );

		if ( $data['to_user']['id_users'] == $_SESSION['id_users'] ){

			$data['not_rated'] = $this->trade_model->not_rated( $data['trade']['id_trade'] , $data['trade_user']['id_users'] );

		}
		else{

			if ( $data['trade_user']['id_users'] == $_SESSION['id_users'] ){

				$data['not_rated'] = $this->trade_model->not_rated( $data['trade']['id_trade'] , $data['to_user']['id_users'] );

			}

			else{

				return;

			}

		}

		$items = $this->trade_model->getTradeItems($id_trade);
		$data['items0'] = $items['items0'];

		if ( $data['trade']['type'] == 2 ){

			$data['items1'] = $items['items1'];

		}

		$this->load->view('templates/header',$data);
		$this->load->view('pages/trade/trade_details.php',$data);
		$this->load->view('templates/footer',$data);
	}

	

}