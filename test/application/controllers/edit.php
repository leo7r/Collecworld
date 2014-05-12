<?php



class Edit extends CW_Controller {



	function __construct(){

		parent::__construct();


	}

	public function view( $category , $id ){

		
		if ( !$_SESSION['init'] ){

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

		else{

			header('Location: '.base_url());

		}

		$data['title'] = 'Edit ';
		$data['collectibles_count'] = $this->getCollectiblesCount();

		$this->load->model($category.'_model');

		//categoria de tarjeta telefonica

		if($category=="phonecard"){


		$pc = $this->phonecard_model->get_phonecard( array("id_phonecards"=> $id) );

		$data['phonecard'] = $pc[0];

		

		$logged = $this->user_model->isUser( array( 'id_users' => $_SESSION['id_users'] ) );

		

		if ( ($logged && $logged['status'] == 2 && (strlen($data['phonecard']['image']) > 0 || strlen($data['phonecard']['image_reverse']) > 0))

			|| $data['phonecard']['status'] == 1 ){

			

			$this->load->view('templates/header', $data);

			$this->load->view('pages/edit/no_edit_phonecard', $data);

			$this->load->view('templates/footer', $data);

			return;

		}

		else{

			$data['countries'] = $this->phonecard_model->get_countries();

			$data['currencies'] = $this->phonecard_model->get_currencies( array( 'id_countries' => $data['phonecard']['id_countries'] ) );

			$comp = $this->phonecard_model->get_phonecards_companies( array("id_phonecards_companies" => $pc[0]['id_phonecards_companies']) );

			$data['companies'] = $comp[0];

			$serie = $this->phonecard_model->get_phonecards_series( array("id_phonecards_series" => $pc[0]['id_phonecards_series']) );

			if ( $serie )

				$data['serie'] = $serie[0];

			else

				$data['serie'] = "";

				

			$data['tag'] =  $this->phonecard_model->get_tags();

			$data['logos'] =  $this->phonecard_model->get_logos();

			

			

			$data['category'] = $category;

			

			$_SESSION['path'] = base_url();

			error_reporting(0);			

			

			$this->load->view('templates/header', $data);

			$this->load->view('pages/edit', $data);

			$this->load->view('templates/footer', $data);	

		}

		//categoria de moneda

		}else if($category=="coin"){		

		$data['coin'] = $this->coin_model->get_coins( array("id_coins"=> $id) ); 		

		$logged = $this->user_model->isUser( array( 'id_users' => $_SESSION['id_users'] ) );

		

		if ( ($logged && $logged['status'] == 2 && (strlen($data['coin']['image']) > 0 || strlen($data['coin']['image_reverse']) > 0))

			|| $data['coin']['status'] == 1 ){

			

			$this->load->view('templates/header', $data);

			$this->load->view('pages/edit/no_edit_coin', $data);

			$this->load->view('templates/footer', $data);

			return;

		}

		else{

			$data['countries'] = $this->coin_model->get_countries();

			$data['tittle'] = $this->coin_model->get_title_by_country( array( 'id_countries' => $data['coin']['id_countries'] ) );

			$data['subtitle'] = $this->coin_model->get_subtitle_by_title( array("id_coins_title" => $data['coin']['id_coins_title']) );
			
			$data['denomination'] = $this->coin_model->get_denomination_by_subtitle( $data['coin']['id_coins_subtitle'] );
			
			$data['value'] = $this->coin_model->get_value_by_denomination( $data['coin']['id_coins_denomination'] );
			
			$data['mint_house'] = $this->coin_model->get_mint_house_by_country( array("id_countries" => $data['coin']['id_countries']) );
			
			$data['composition'] = $this->coin_model->get_composition();
			
			$data['shapes'] = $this->coin_model->get_shape();

			$data['edges'] = $this->coin_model->get_edge();

			$data['designer'] = $this->coin_model->get_designer();
 	

			$data['category'] = $category;

			

			$_SESSION['path'] = base_url();

			error_reporting(0);			

			

			$this->load->view('templates/header', $data);

			$this->load->view('pages/edit', $data);

			$this->load->view('templates/footer', $data);	

		}

		//categoria Banknote

		}else if($category=="banknote"){		

		$cn = $this->banknote_model->get_banknotes( array("id_".$category."s"=> $id) );

		$data[$category] = $cn[0];

		$logged = $this->user_model->isUser( array( 'id_users' => $_SESSION['id_users'] ) );

		

		if ( ($logged && $logged['status'] == 2 && (strlen($data[$category]['image']) > 0 || strlen($data[$category]['image_reverse']) > 0))

			|| $data[$category]['status'] == 1 ){

			

			$this->load->view('templates/header', $data);

			$this->load->view('pages/edit/no_edit_phonecard', $data);

			$this->load->view('templates/footer', $data);

			return;

		}

		else{

			$data['countries'] = $this->banknote_model->get_countries();

			$data['tittle'] = $this->banknote_model->get_title_by_country( array( 'id_countries' => $data[$category]['id_countries'] ) ); 
			
			$data['subtitle'] = $this->banknote_model->get_subtitle_by_title( array("id_".$category."s_title" => $data[$category]['id_'.$category.'s_title']) );
 
			$data['denomination'] = $this->banknote_model->get_denomination_by_subtitle( $data[$category]['id_'.$category.'s_subtitle'] );
			
			$data['value'] = $this->banknote_model->get_value_by_denomination( $data[$category]['id_'.$category.'s_denomination'] );
			
			$data['mint_house'] = $this->banknote_model->get_mint_house_by_country( array("id_countries" => $data[$category]['id_countries']) );
			
 

			$data['category'] = $category;

			

			$_SESSION['path'] = base_url();

			error_reporting(0);			

			

			$this->load->view('templates/header', $data);

			$this->load->view('pages/edit', $data);

			$this->load->view('templates/footer', $data);	

		}

		}	

	}

	

	public function upload_image( $category  ){


		$image_face = $this->input->post('image-face');

		$data['onFinish'] = $this->input->post('onFinish');

		$data['collectibles_count'] = $this->getCollectiblesCount(); 

		//Categoria  Tarjeta telefonica

		if($category=='phonecard'){

		$id_item = $this->input->post('id-pc');

		$this->load->model('phonecard_model');

		$pc = $this->phonecard_model->get_phonecard( array("id_phonecards"=> $id_item) );


		$data['pc'] = $pc[0];


		if ( $image_face == 0 and strcmp($pc[0]['image'],"") != 0 ){

			echo '[error] Image already uploaded';

			return;

		}

		elseif ( $image_face == 1 and strcmp($pc[0]['image_reverse'],"") != 0 ){

			echo '[error] Image already uploaded';

			return;

		}

		

		$config['upload_path'] = './upload/img/';

		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		$rnd = rand(0,1000);

		$r2 = strval(time())+strval($rnd);

		

		$this->load->library('upload', $config);



		if ( ! $this->upload->do_upload('new-image')){

			$new_image = '';

		}

		else{

			$new_image = $this->upload->data();

			

			$file_name = $r2.$new_image['file_ext'];

			rename($new_image['full_path'],$new_image['file_path'].$file_name);

			$new_image = $file_name;

		}

		

		if ( $new_image ){

			

			$data['companies'] = "";

			$data['serie'] = "";

			$data['saveInfo'] = "";

			

			if ( $image_face == 0 ){

				$data['anverse'] = $new_image;

				$data['reverse'] = '';

			}

			elseif ( $image_face == 1 ){

				$data['reverse'] = $new_image;

				$data['anverse'] = '';

			}

			else{

				echo 'error';

				return;

			}



			$data['title'] = 'Crop image for '.$data['pc']['name'];
			

			$this->load->view('templates/header',$data);

			$this->load->view('pages/upload-crop',$data);

			

		}
			//categoria de moneda

		}else if ($category=='coin'){

		$id_item = $this->input->post('id-cn');

		$this->load->model('coin_model');

		$cn = $this->coin_model->get_coins( array("id_coins"=> $id_item) );


		$data['cn'] = $cn[0];


		if ( $image_face == 0 and strcmp($cn[0]['image'],"") != 0 ){

			echo '[error] Image already uploaded';

			return;

		}

		elseif ( $image_face == 1 and strcmp($cn[0]['image_reverse'],"") != 0 ){

			echo '[error] Image already uploaded';

			return;

		}

		

		$config['upload_path'] = './upload/coins/';

		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		$rnd = rand(0,1000);

		$r2 = strval(time())+strval($rnd);

		

		$this->load->library('upload', $config);



		if ( ! $this->upload->do_upload('new-image')){

			$new_image = '';

		}

		else{

			$new_image = $this->upload->data();

			

			$file_name = $r2.$new_image['file_ext'];

			rename($new_image['full_path'],$new_image['file_path'].$file_name);

			$new_image = $file_name;

		}

		

		if ( $new_image ){

			

			$data['companies'] = "";

			$data['serie'] = "";

			$data['saveInfo'] = "";

			

			if ( $image_face == 0 ){

				$data['anverse'] = $new_image;

				$data['reverse'] = '';

			}

			elseif ( $image_face == 1 ){

				$data['reverse'] = $new_image;

				$data['anverse'] = '';

			}

			else{

				echo 'error';

				return;

			}



			$data['title'] = 'Crop image for '.$data['cn']['id_coins'];
			

			$this->load->view('templates/header',$data);

			$this->load->view('pages/upload-coin',$data);

			}
			//categoria Banknote
		} else if ($category=='banknote'){

		$id_item = $this->input->post('id-bn');
 

		$this->load->model('banknote_model');

		$bn = $this->banknote_model->get_banknotes( array("id_banknotes"=> $id_item) );


		$data['bn'] = $bn[0];


		if ( $image_face == 0 and strcmp($bn[0]['image'],"") != 0 ){

			echo '[error] Image already uploaded';

			return;

		}

		elseif ( $image_face == 1 and strcmp($bn[0]['image_reverse'],"") != 0 ){

			echo '[error] Image already uploaded';

			return;

		}

		

		$config['upload_path'] = './upload/banknotes/';

		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		$rnd = rand(0,1000);

		$r2 = strval(time())+strval($rnd);

		

		$this->load->library('upload', $config);



		if ( ! $this->upload->do_upload('new-image')){

			$new_image = '';

		}

		else{

			$new_image = $this->upload->data();

			

			$file_name = $r2.$new_image['file_ext'];

			rename($new_image['full_path'],$new_image['file_path'].$file_name);

			$new_image = $file_name;

		}

		

		if ( $new_image ){

			

			$data['companies'] = "";

			$data['serie'] = "";

			$data['saveInfo'] = "";

			

			if ( $image_face == 0 ){

				$data['anverse'] = $new_image;

				$data['reverse'] = '';

			}

			elseif ( $image_face == 1 ){

				$data['reverse'] = $new_image;

				$data['anverse'] = '';

			}

			else{

				echo 'error';

				return;

			}



			$data['title'] = 'Crop image for '.$data['bn']['id_banknotes'];
			

			$this->load->view('templates/header',$data);

			$this->load->view('pages/upload-banknote',$data);

			

		}

		}

	}


	public function edit_go($category){

		
 

		if($category=='phonecard'){

		$this->load->model('phonecard_model');

		$config['upload_path'] = './upload/img/';

		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		$rnd = rand(0,1000);

		$r2 = strval(time())+strval($rnd);

		

		$pcard = $this->phonecard_model->get_phonecard( array("id_phonecards"=>$this->input->post('id_pc')) );

		$pcard = $pcard[0];

		

		$this->load->library('upload', $config);
		$data['collectibles_count'] = $this->getCollectiblesCount();

		$image_data = array();

		if ( ! $this->upload->do_upload('i_file')){

			$data['anverse'] = '';

		}

		else{
			$data['anverse'] = $this->upload->data();
			$file_name = $r2.$data['anverse']['file_ext'];
			
			$image_data['anverse'] = $this->upload->data();
			$image_data['anverse']['full_path'] = $data['anverse']['file_path'].$file_name;

			rename($data['anverse']['full_path'],$data['anverse']['file_path'].$file_name);

			$data['anverse'] = $file_name;

			

			if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

				@unlink($_SERVER['DOCUMENT_ROOT'].'/upload/img/'.$pcard['image']);

			}

			else{

				@unlink($_SERVER['DOCUMENT_ROOT'].'collecworld/upload/img/'.$pcard['image']);

			}

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

			

			if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

				@unlink($_SERVER['DOCUMENT_ROOT'].'/upload/img/'.$pcard['image_reverse']);

			}

			else{

				@unlink($_SERVER['DOCUMENT_ROOT'].'collecworld/upload/img/'.$pcard['image_reverse']);

			}

		}

		if ( !$this->verif_image_sizes($image_data,1) ){
			header('Location: '.base_url().'index.php/edit/phonecard/'.$pcard['id_phonecards'].'?err=-1');
			return;
		}

		if ( strcmp($pcard['user'],'admin') == 0 ){

			$data['new_edit'] = 'yes';

		}

		

		$data['id_pc'] = $pcard['id_phonecards'];
		
		

		if ( strcmp($data['anverse'],"") == 0 and strcmp($data['reverse'],"") == 0 ){

			

			if ( strcmp($pcard['image'],"") == 0  and strcmp($pcard['image_reverse'],"") == 0 ){

				$done = $this->phonecard_model->edit_phonecard( $data );

				if ( $done == 0){

					header('Location: '.base_url().'index.php/edit/phonecard/'.($this->input->post('id_pc')).'?don=1&onDone='.$this->input->post('onDone'));

				}

				else{

					header('Location: '.base_url().'index.php/edit/phonecard/'.($this->input->post('id_pc')).'?err=1&onDone='.$this->input->post('onDone'));

				}

				

				return;

			}

			else{

				$data['anverse'] = $pcard['image'];

				$data['reverse'] = $pcard['image_reverse'];

			}

		}

		

		$done = $this->phonecard_model->edit_phonecard( $data );

		

		if ( $done == -1 ){

			header('Location: '.base_url().'index.php/edit/phonecard/'.($this->input->post('id_pc')).'?err=1&onDone='.$this->input->post('onDone'));

			return;

		}

		

		$data['pc'] = $pcard;

		

		// Datos que no importan pero que son necesarios para el upload-crop pues sirve para upload y para edit.

		$data['companies'] = "";

		$data['serie'] = "";

		$data['saveInfo'] = "";

		$data['title'] = "Crop images";
		$data['onDone'] = $this->input->post('onDone');

		$this->load->view('templates/header',$data);

		$this->load->view('pages/upload-crop',$data);


		//coin category
	}else if($category=='coin'){

		$this->load->model('coin_model');

		$config['upload_path'] = './upload/coins/';

		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		$rnd = rand(0,1000);

		$r2 = strval(time())+strval($rnd);

		

		$pcard = $this->coin_model->get_coins( array("id_coins"=>$this->input->post('id_cn')) );
	

		$this->load->library('upload', $config);
		$data['collectibles_count'] = $this->getCollectiblesCount();

		$image_data = array();

		if ( ! $this->upload->do_upload('i_file')){

			$data['anverse'] = '';

		}

		else{
			$data['anverse'] = $this->upload->data();
			$file_name = $r2.$data['anverse']['file_ext'];
			
			$image_data['anverse'] = $this->upload->data();
			$image_data['anverse']['full_path'] = $data['anverse']['file_path'].$file_name;

			rename($data['anverse']['full_path'],$data['anverse']['file_path'].$file_name);

			$data['anverse'] = $file_name;

			

			if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

				@unlink($_SERVER['DOCUMENT_ROOT'].'/upload/coins/'.$pcard['image']);

			}

			else{

				@unlink($_SERVER['DOCUMENT_ROOT'].'collecworld/upload/coins/'.$pcard['image']);

			}

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

			

			if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

				@unlink($_SERVER['DOCUMENT_ROOT'].'/upload/coins/'.$pcard['image_reverse']);

			}

			else{

				@unlink($_SERVER['DOCUMENT_ROOT'].'collecworld/upload/coins/'.$pcard['image_reverse']);

			}

		}

		if ( !$this->verif_image_sizes($image_data,2) ){
			header('Location: '.base_url().'index.php/edit/coin/'.$pcard['id_coins'].'?err=-1');
			return;
		}

		if ( strcmp($pcard['user'],'admin') == 0 ){

			$data['new_edit'] = 'yes';

		}

		

		$data['id_cn'] = $pcard['id_coins'];
		  

		if ( strcmp($data['anverse'],"") == 0 and strcmp($data['reverse'],"") == 0 ){

			

			if ( strcmp($pcard['image'],"") == 0  and strcmp($pcard['image_reverse'],"") == 0 ){

				$done = $this->coin_model->edit_coin( $data );

				if ($done == 0){

				header('Location: '.base_url().'index.php/edit/coin/'.($this->input->post('id_cn')).'?don=1&onDone='.$this->input->post('onDone'));

				}

				else{

				header('Location: '.base_url().'index.php/edit/coin/'.($this->input->post('id_cn')).'?err=1&onDone='.$this->input->post('onDone'));

				}

				

				return;

			}

			else{

				$data['anverse'] = $pcard['image'];

				$data['reverse'] = $pcard['image_reverse'];

			}

		}

		

		$done = $this->coin_model->edit_coin( $data );

		

		if ( $done == -1 ){

			header('Location: '.base_url().'index.php/edit/coin/'.($this->input->post('id_cn')).'?err=1&onDone='.$this->input->post('onDone'));

			return;

		}

		

		$data['cn'] = $pcard;

		

		

		

		// Datos que no importan pero que son necesarios para el upload-crop pues sirve para upload y para edit.

		$data['companies'] = "";

		$data['serie'] = "";

		$data['saveInfo'] = "";

		$data['title'] = "Crop images";
		$data['onDone'] = $this->input->post('onDone');

		$this->load->view('templates/header',$data);

		$this->load->view('pages/upload-coin',$data);

		//Category banknote
	}else if($category=='banknote'){

		$this->load->model('banknote_model');

		$config['upload_path'] = './upload/banknotes/';

		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		$rnd = rand(0,1000);

		$r2 = strval(time())+strval($rnd);

		

		$pcard = $this->banknote_model->get_banknotes( array("id_banknotes"=>$this->input->post('id_bn')) );

		$pcard = $pcard[0];

		

		$this->load->library('upload', $config);
		$data['collectibles_count'] = $this->getCollectiblesCount();

		$image_data = array();

		if ( ! $this->upload->do_upload('i_file')){

			$data['anverse'] = '';

		}

		else{
			$data['anverse'] = $this->upload->data();
			$file_name = $r2.$data['anverse']['file_ext'];
			
			$image_data['anverse'] = $this->upload->data();
			$image_data['anverse']['full_path'] = $data['anverse']['file_path'].$file_name;

			rename($data['anverse']['full_path'],$data['anverse']['file_path'].$file_name);

			$data['anverse'] = $file_name;

			

			if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

				@unlink($_SERVER['DOCUMENT_ROOT'].'/upload/banknotes/'.$pcard['image']);

			}

			else{

				@unlink($_SERVER['DOCUMENT_ROOT'].'collecworld/upload/banknotes/'.$pcard['image']);

			}

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

			

			if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

				@unlink($_SERVER['DOCUMENT_ROOT'].'/upload/banknotes/'.$pcard['image_reverse']);

			}

			else{

				@unlink($_SERVER['DOCUMENT_ROOT'].'collecworld/upload/banknotes/'.$pcard['image_reverse']);

			}

		}

		if ( !$this->verif_image_sizes($image_data,3) ){
			header('Location: '.base_url().'index.php/edit/banknote/'.$pcard['id_banknotes'].'?err=-1');
			return;
		}

		if ( strcmp($pcard['user'],'admin') == 0 ){

			$data['new_edit'] = 'yes';

		}

		

		$data['id_bn'] = $pcard['id_banknotes'];
		 

		if ( strcmp($data['anverse'],"") == 0 and strcmp($data['reverse'],"") == 0 ){

			

			if ( strcmp($pcard['image'],"") == 0  and strcmp($pcard['image_reverse'],"") == 0 ){

				$done = $this->banknote_model->edit_banknote( $data );

				if ($done == 0){

				header('Location: '.base_url().'index.php/edit/banknote/'.($this->input->post('id_bn')).'?don=1&onDone='.$this->input->post('onDone'));

				}

				else{

				header('Location: '.base_url().'index.php/edit/banknote/'.($this->input->post('id_bn')).'?err=1&onDone='.$this->input->post('onDone'));

				}

				

				return;

			}

			else{

				$data['anverse'] = $pcard['image'];

				$data['reverse'] = $pcard['image_reverse'];

			}

		}

		

		$done = $this->banknote_model->edit_banknote( $data );

		

		if ( $done == -1 ){

			header('Location: '.base_url().'index.php/edit/banknote/'.($this->input->post('id_bn')).'?err=1&onDone='.$this->input->post('onDone'));

			return;

		}

		

		$data['bn'] = $pcard;

		// Datos que no importan pero que son necesarios para el upload-crop pues sirve para upload y para edit.

		$data['companies'] = "";

		$data['serie'] = "";

		$data['saveInfo'] = "";

		$data['title'] = "Crop images";

		$data['onDone'] = $this->input->post('onDone');

		$this->load->view('templates/header',$data);

		$this->load->view('pages/upload-banknote',$data);


	}

	}

	

	// Image crop
	
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

	

	public function crop_imgs( $category ){

		

		$id = $this->input->post('idPh');

		$onFinish = $this->input->post('onFinish');

		

		$this->load->library("image_moo");

		

		if ( strcmp($this->input->post("img0"),"") != 0 ){

			$this->crop_img("img0","anverse",$category);

		}

		if ( strcmp($this->input->post("img1"),"") != 0 ){

			$this->crop_img("img1","reverse",$category);

		}

		

		if ( $onFinish ){

			header("Location: ".$onFinish);

		}

		else{

			header("Location: ".base_url().'index.php/edit/'.$category.'/'.$id.'?don=1&onDone='.$this->input->post("onDone2"));

		}

	}

	

	private function crop_img( $name , $face,$category  ){

		

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
			if($category=='phonecard'){
			$img_path = $_SERVER['DOCUMENT_ROOT'].'/upload/img/';
			}else {
				$img_path = $_SERVER['DOCUMENT_ROOT'].'/upload/'.$category.'s/';

			}

		}

		else{
			if($category=='phonecard'){

			$img_path = $_SERVER['DOCUMENT_ROOT'].'collecworld/upload/img/';

			}else {

			$img_path = $_SERVER['DOCUMENT_ROOT'].'collecworld/upload/'.$category.'s/';

			}

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

		

		if ( ($img_vertical0) && ($category=='phonecard') ){

			$params['vertical_'.$face] = 1;

		}

		$this->load->model($category.'_model');

		if($category=='phonecard'){

        $this->phonecard_model->update_phonecard( $params , array( 'id_phonecards' => $this->input->post('idPh') ) );

        }else if ($category=='coin'){

        $this->coin_model->update_coin( $params , array( 'id_coins' => $this->input->post('idPh') ) );

		}else if ($category=='banknote'){


        $this->banknote_model->update_banknote( $params , array( 'id_banknotes' => $this->input->post('idPh') ) );

		}

		

	}

	

}