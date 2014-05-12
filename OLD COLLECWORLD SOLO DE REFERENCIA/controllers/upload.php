<?php
class Upload extends CW_Controller {

	function __construct(){
		parent::__construct();
	}

	public function view(){
		
		$data['collectibles_count'] = $this->getCollectiblesCount();
		
		if ( !isset($_SESSION['init']) || !isset($_SESSION['user']) ){
			
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
			$usr = $_SESSION['user'];
	
			$u = $this->user_model->isUser(array('user'=>$usr));
			
			$data['intro_upload'] = $u['intro_upload'];
		}
		
		$data['title'] = 'Upload';
		error_reporting(0);
		
		$this->load->model('phonecard_model');
		$this->load->model('coin_model');
		$data['categories'] = $this->phonecard_model->get_categories();
		
		$_SESSION['shapes'] = $this->coin_model->get_shape();
		$_SESSION['edges'] = $this->coin_model->get_edge();
		$_SESSION['designer'] = $this->coin_model->get_designer();
		$_SESSION['composition'] = $this->coin_model->get_composition();
		$_SESSION['countries'] = $this->phonecard_model->get_countries();
		$_SESSION['tags'] = $this->phonecard_model->get_tags();
		$_SESSION['logos'] = $this->phonecard_model->get_logos();
				
		$this->load->view('templates/header', $data);
		$this->load->view('pages/upload', $data);
		$this->load->view('templates/footer', $data);
		
	}
	
	public function upload_go(){
		
		
		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['title'] = 'Crop images for '.$this->input->post('name');
				
		$config['upload_path'] = './upload/img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$rnd = rand(0,1000);
		$r2 = strval(time())+strval($rnd);
		
		$this->load->library('upload', $config);
		
		$image_data = array();

		if ( ! $this->upload->do_upload('i_file')){
			$data['anverse'] = '';
		}
		else{
			$data['anverse'] = $this->upload->data();
			$file_name = $r2.$data['anverse']['file_ext'];
			
			$image_data['anverse'] = $this->upload->data();
			$image_data['anverse']['full_path'] = $data['anverse']['file_path'].$file_name;
			//echo var_dump($data['anverse']);
			//return;
			
			rename($data['anverse']['full_path'],$data['anverse']['file_path'].$file_name);
			$data['anverse'] = $file_name;
		}
		
		$rnd = rand(0,1000);
		$r2 = strval(time())+strval($rnd);
		
		if ( ! $this->upload->do_upload('i_file_r')){
			$data['reverse'] = '';
		}
		else{
			$data['reverse'] = $this->upload->data();
			$file_name = $r2.'_2'.$data['reverse']['file_ext'];
			
			$image_data['reverse'] = $this->upload->data();
			$image_data['reverse']['full_path'] = $data['reverse']['file_path'].$file_name;
			
			rename($data['reverse']['full_path'],$data['reverse']['file_path'].$file_name);
			$data['reverse'] = $file_name;
		}
		
		if ( (!$this->verif_image_sizes($image_data,1))&&$_SESSION['status']==1 ){
			$country = $this->input->post('country');	
			$currency = $this->input->post('currency');	
			$companies = $this->input->post('companies');	
			$system = $this->input->post('system');	
			$name = $this->input->post('name');
			
			header('Location: '.base_url().'index.php/upload/?cat=1&err=-1&cou='.$country.'&cur='.$currency.'&com='.$companies.'&sys='.$system.'&nam='.$name);
			return;
		}
		
		$this->load->model('phonecard_model');
		$pc = $this->phonecard_model->insert_phonecard( $data );
		echo "<script src='/javascripts/application.js' type='text/javascript' charset='utf-8' async defer> alert('".$pc[0]."')</script>";
		if ( $pc[0] ){
			
			if ( strcmp($data['anverse'],"") == 0 && strcmp($data['reverse'],"") == 0 && !$this->input->post('saveInfo') ){
				header('Location: '.base_url().'index.php/upload/?cat=1&don='.$pc[1]['id_phonecards']);
			}
			else{
				$data['pc'] = $pc[1];
				$data['companies'] = $this->input->post('companies');
				$data['serie'] = $this->input->post('serie');
				$data['saveInfo'] = $this->input->post('saveInfo');
								
				$this->load->view('templates/header',$data);
				$this->load->view('pages/upload-crop',$data);
			}
			
		}
		else{
			if ( $pc[1] ){
				$modif = 'cat=1&err='.$pc[1]['id_phonecards'].'&cur='.$pc[1]['id_currencies'].'&sys='.$pc[1]['id_phonecards_systems'];
				$modif = $modif.'&com='.$this->input->post('companies').'&ser='.$this->input->post('serie').'&cou='.$pc[1]['id_countries'];
			}
			else{
				
				if ( isset($_SESSION['user']) ){
					$this->load->model('user_model');
					$data['notifications'] = $this->user_model->getNotifications();
				}
				
				$this->load->view('templates/header',$data);
				$this->load->view('pages/upload/no_upload_phonecard',$data);
				$this->load->view('templates/footer',$data);
				return;
			}
			
			@unlink('./upload/img/'.$data['anverse']);
			@unlink('./upload/img/'.$data['reverse']);
			header('Location: '.base_url().'index.php/upload/?'.$modif);
		}		
	}
	
	
	public function upload_coin_go(){ 

		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['title'] = 'Crop images for coin';
		
		$config['upload_path'] = './upload/coins/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$rnd = rand(0,1000);
		$r2 = strval(time())+strval($rnd);
		
		$this->load->library('upload', $config);
		
		$image_data = array();

		if ( ! $this->upload->do_upload('i_file')){
			$data['anverse'] = '';
		}
		else{
			$data['anverse'] = $this->upload->data();
			$file_name = $r2.$data['anverse']['file_ext'];
			
			$image_data['anverse'] = $this->upload->data();
			$image_data['anverse']['full_path'] = $data['anverse']['file_path'].$file_name;
			//echo var_dump($data['anverse']);
			//return;
			
			rename($data['anverse']['full_path'],$data['anverse']['file_path'].$file_name);
			$data['anverse'] = $file_name;
		}
		
		$rnd = rand(0,1000);
		$r2 = strval(time())+strval($rnd);
		
		if ( ! $this->upload->do_upload('i_file_r')){
			$data['reverse'] = '';
		}
		else{
			$data['reverse'] = $this->upload->data();
			$file_name = $r2.'_2'.$data['reverse']['file_ext'];
			
			$image_data['reverse'] = $this->upload->data();
			$image_data['reverse']['full_path'] = $data['reverse']['file_path'].$file_name;
			
			rename($data['reverse']['full_path'],$data['reverse']['file_path'].$file_name);
			$data['reverse'] = $file_name;
		}

		if ( !$this->verif_image_sizes($image_data,2) ){
			$country = $this->input->post('country');	
			$title = $this->input->post('title');	
			$subtitle = $this->input->post('subtitle');	
			$denomination = $this->input->post('denomination');	
			$value = $this->input->post('value');
			$circulation = $this->input->post('circulation');
			
			header('Location: '.base_url().'index.php/upload/?cat=2&err=-1&cou='.$country.'&ti='.$title.'&st='.$subtitle.'&de='.$denomination.'&value='.$value.'&circulation='.$circulation);
			return;
		}
		
		 
		$this->load->model('coin_model');
		$pc = $this->coin_model->insert_coin( $data );
		
		if ( $pc[0] ){
						
			if ( strcmp($data['anverse'],"") == 0 && strcmp($data['reverse'],"") == 0 && !$this->input->post('saveInfo') ){
				header('Location: '.base_url().'index.php/upload/?cat=2&don='.$pc[1]['id_coins']);
			}
			else{
				$data['cn'] = $pc[1];
				$data['title'] = $this->input->post('title');
				$data['subtitle'] = $this->input->post('subtitle');
				$data['saveInfo'] = $this->input->post('saveInfo');
								
				$this->load->view('templates/header',$data);
				$this->load->view('pages/upload-coin',$data);
			}
			
		}
		else{
			
			if ( $pc[1] ){
				$modif = 'cat=2&err='.$pc[1]['id_coins'].'&cur='.$pc[1]['id_currencies'].'&sys='.$pc[1]['id_phonecards_systems'];
				$modif = $modif.'&com='.$this->input->post('companies').'&ser='.$this->input->post('serie').'&cou='.$pc[1]['id_countries'];
			}
			else{
				
				if ( isset($_SESSION['user']) ){
					$this->load->model('user_model');
					$data['notifications'] = $this->user_model->getNotifications();
				}
				
				$this->load->view('templates/header',$data);
				$this->load->view('pages/upload/no_upload_phonecard',$data);
				$this->load->view('templates/footer',$data);
				return;
			}
			
			@unlink('./upload/coins/'.$data['anverse']);
			@unlink('./upload/coins/'.$data['reverse']);
			header('Location: '.base_url().'index.php/upload/?'.$modif);
			
			
		}		 
	}
	
	public function upload_banknote_go(){
		
		$config['upload_path'] = './upload/banknotes/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$rnd = rand(0,1000);
		$r2 = strval(time())+strval($rnd);
		
		$this->load->library('upload', $config);
		
		$image_data = array();

		if ( ! $this->upload->do_upload('i_file')){
			$data['anverse'] = '';
		}
		else{
			$data['anverse'] = $this->upload->data();
			$file_name = $r2.$data['anverse']['file_ext'];
			
			$image_data['anverse'] = $this->upload->data();
			$image_data['anverse']['full_path'] = $data['anverse']['file_path'].$file_name;
			//echo var_dump($data['anverse']);
			//return;
			
			rename($data['anverse']['full_path'],$data['anverse']['file_path'].$file_name);
			$data['anverse'] = $file_name;
		}
		
		$rnd = rand(0,1000);
		$r2 = strval(time())+strval($rnd);
		
		if ( ! $this->upload->do_upload('i_file_r')){
			$data['reverse'] = '';
		}
		else{
			$data['reverse'] = $this->upload->data();
			$file_name = $r2.'_2'.$data['reverse']['file_ext'];
			
			$image_data['reverse'] = $this->upload->data();
			$image_data['reverse']['full_path'] = $data['reverse']['file_path'].$file_name;
			
			rename($data['reverse']['full_path'],$data['reverse']['file_path'].$file_name);
			$data['reverse'] = $file_name;
		}

		if ( !$this->verif_image_sizes($image_data,3) ){
			$country = $this->input->post('country');	
			$currency = $this->input->post('currency');	
			$companies = $this->input->post('companies');	
			$system = $this->input->post('system');	
			$name = $this->input->post('name');
			
			header('Location: '.base_url().'index.php/upload/?cat=3&err=-1&cou='.$country.'&cur='.$currency.'&com='.$companies.'&sys='.$system.'&nam='.$name);
			return;
		}
				 
		$this->load->model('banknote_model');
		$pc = $this->banknote_model->insert_banknote( $data );

		if ( $pc[0] ){
			
			header('Location: '.base_url().'index.php/upload/?cat=3&don='.$pc[1]['id_banknotes']);
			
			if ( strcmp($data['anverse'],"") == 0 && strcmp($data['reverse'],"") == 0 && !$this->input->post('saveInfo') ){
				header('Location: '.base_url().'index.php/upload/?cat=3&don='.$pc[1]['id_banknotes']);
			}
			else{
				$data['pc'] = $pc[1];
				$data['companies'] = $this->input->post('companies');
				$data['serie'] = $this->input->post('serie');
				$data['saveInfo'] = $this->input->post('saveInfo');
								
				$this->load->view('templates/header',$data);
				$this->load->view('pages/upload-banknote',$data);
			}
			
		}
		else{
			
			if ( $pc[1] ){
				$modif = 'cat=1&err='.$pc[1]['id_phonecards'].'&cur='.$pc[1]['id_currencies'].'&sys='.$pc[1]['id_phonecards_systems'];
				$modif = $modif.'&com='.$this->input->post('companies').'&ser='.$this->input->post('serie').'&cou='.$pc[1]['id_countries'];
			}
			else{
				
				if ( isset($_SESSION['user']) ){
					$this->load->model('user_model');
					$data['notifications'] = $this->user_model->getNotifications();
				}
				
				$this->load->view('templates/header',$data);
				$this->load->view('pages/upload/no_upload_phonecard',$data);
				$this->load->view('templates/footer',$data);
				return;
			}
			
			@unlink('./upload/img/'.$data['anverse']);
			@unlink('./upload/img/'.$data['reverse']);
			header('Location: '.base_url().'index.php/upload/?'.$modif);
			
			
		}		 
	}
	
	public function verif_image_sizes( $image_data, $category ){

		if($category==1){
		$verif = false;
		$min_width = 305;
		$min_height = 194;
		}else if ($category==2){
		$verif = false;
		$min_width = 150;
		$min_height = 150;
		}else if ($category==3){
		$verif = false;
		$min_width = 305;
		$min_height = 194;
	}

		if ( isset($image_data['anverse']) ){
			if ( $image_data['anverse']['image_width'] > $image_data['anverse']['image_height'] ){
				
				if ( $image_data['anverse']['image_width'] >= $min_width && $image_data['anverse']['image_height'] >= $min_height ){
					$verif = true;	
				}					
			}
			else{
				if ( $image_data['anverse']['image_width'] >= $min_height && $image_data['anverse']['image_height'] >= $min_width ){
					$verif = true;	
				}
			}
		}
		else{
			$verif = true;
		}
		
		if ( isset($image_data['reverse']) ){
			if ( $image_data['reverse']['image_width'] > $image_data['reverse']['image_height'] ){
				
				if ( !$image_data['reverse']['image_width'] >= $min_width || !$image_data['reverse']['image_height'] >= $min_height ){
					$verif = false;	
				}
			}
			else{
				
				if ( $image_data['reverse']['image_width'] < $min_height || $image_data['reverse']['image_height'] < $min_width ){
					$verif = false;	
				}
				
			}
		}
		
		if ( !$verif ){
			
			if ( isset($image_data['anverse']) ){
				unlink($image_data['anverse']['full_path']);
			}
			
			if ( isset($image_data['reverse']) ){
				unlink($image_data['reverse']['full_path']);
			}
		}
		
		return $verif;
	}
	
	public function crop_imgs(){
				
		$id = $this->input->post('idPh');
		$cat = $this->input->post('cat');
		$this->load->library("image_moo");
		
		if ( strcmp($this->input->post("img0"),"") != 0 ){
			$this->crop_img("img0","anverse");
		}
		if ( strcmp($this->input->post("img1"),"") != 0 ){
			$this->crop_img("img1","reverse");
		}

		header("Location: ".base_url().'index.php/upload/?cat='.$cat.'&'.$this->input->post('onDone'));
	}
	
	private function crop_img( $name , $face  ){
		
		$img0 = $this->input->post($name);
		
		$x_img0 = $this->input->post('x_'.$name);
		if ( strcmp($x_img0,"") == 0 ){
			$x_img0 = "0";
		}
		
		$y_img0 = $this->input->post('y_'.$name);
		if ( strcmp($y_img0,"") == 0 ){
			$y_img0 = "0";
		}
		
		$w_img0 = $this->input->post('w_'.$name);
		$h_img0 = $this->input->post('h_'.$name);
		
		$img_vertical0 = $w_img0 < $h_img0;
		
		$img0_w = 610;
		$img0_h = 388;
		
		if ( $img_vertical0 ){
			$img0_w = 388;
			$img0_h = 610;
		}

		$ext = explode(".",$img0);
		$ext = '.'.$ext[count($ext)-1];

		$rnd = rand(0,9999);
		$img_name = strval($rnd).'-'.$this->input->post('namePc').'_'.$face.$ext;
		
		if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
			$img_path = $_SERVER['DOCUMENT_ROOT'].'/upload/img/';
		}
		else{
			$img_path = $_SERVER['DOCUMENT_ROOT'].'collecworld/upload/img/';
		}
		
		$this->image_moo
			->load($img_path.$img0)
			->crop($x_img0,$y_img0,$x_img0+$w_img0,$y_img0+$h_img0)
			->save_pa("t_","",TRUE);
			
		$this->image_moo
			->load($img_path.'t_'.$img0)
			->stretch( $img0_w, $img0_h )
			->save($img_path.$img_name,TRUE);
		
		@unlink($img_path.'t_'.$img0);
		@unlink($img_path.$img0);

		$params = array();
		$params['image'.( strcmp($face,"reverse") == 0 ? "_reverse" : "" )] = $img_name;
		
		if ( $img_vertical0 ){
			$params['vertical_'.$face] = 1;
		}

		$this->load->model('phonecard_model');
        $this->phonecard_model->update_phonecard( $params , array( 'id_phonecards' => $this->input->post('idPh') ) );
		
	}

	public function restriction(){
		//Validacion de Privilegios de Bloquear un Catalogo de tajetas telefonicas 
		$country = $this->input->post('country');
		$companies = $this->input->post('companies');
		$system = $this->input->post('system');
		$not_emmited = $this->input->post('not_emmited');

		$this->load->model('phonecard_model');

		$abbr = $this->phonecard_model->companyAbbr($companies);

		$companies = $this->phonecard_model->get_or_create_company($companies,$country,$abbr);

		$companies = $companies['id_phonecards_companies'];

		$issued_on = $this->phonecard_model->get_date('date_year','date_month','date_day');

		$exp_date = $this->phonecard_model->get_date('date_ex_year','date_ex_month','date_ex_day');

		$known_date = $this->phonecard_model->get_date('date_known_year','date_known_month','date_known_day');

		

		if ( $issued_on ){

			$order_date = $issued_on;

		}

		else{

			if ( $known_date ){

				$order_date = $known_date;

			}

			else{

				if ( $exp_date ){
					
					$kdate = date("Y/m/d", strtotime("-6 months", strtotime($exp_date)));
					$known_date = $kdate;
					$order_date = $known_date;
				}

				else{

					$order_date = 'Unknown';

				}

			}

		}

		if($order_date=="Unknown"){
			$order_date1=0;
		}else{
			$order_date1=1;
		}

		if ($not_emmited==false){
			$restriction= array(
			'id_countries' => $country, 
			'id_phonecards_companies' => $companies,
			'id_phonecards_systems' => $system,
			'order_date' => $order_date1
			);
		}else{
			$restriction= array(
			'id_countries' => $country, 
			'id_phonecards_companies' => $companies,
			'id_phonecards_systems' => $system,
			'not_emmited' => $not_emmited
			);
		}
		
		if($this->phonecard_model->get_phonecard_done($restriction)){
			$datos="This catalog is locked";
		}else{
			$datos="";
		}

		echo json_encode($datos);
	}

}
?>