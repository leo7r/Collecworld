<?php

class Banknote_model extends CI_Model {



	public function __construct(){

		$this->load->database();

	}

	public function get_banknotes( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('banknotes');

		}

		else{

			$query = $this->db->get_where('banknotes', $where );

		}

		

		return $query->result_array();		

	}
	 
	
	public function get_edge( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('banknotes_edge');

		}

		else{

			$query = $this->db->get_where('banknotes_edge', $where );

		}

		

		return $query->result_array();		

	}
	

	public function insert_banknote( $data ){ 

		$country = $this->input->post('country'); 
		$title = $this->input->post('title'); 
		$subtitle = $this->input->post('subtitle');
		$denomination = $this->input->post('denomination');
		$value = $this->input->post('value');
		$circulation = $this->input->post('circulation');
		$issued_on_greg = $this->get_date('date_year_greg','date_month_greg','date_day_greg'); 
		$issued_on_isla = $this->get_date('date_year_isla','date_month_isla','date_day_isla'); 
		$mint_house = $this->input->post('mint_house');
		$printRun = $this->input->post('printRun'); 
		$num_serie = $this->input->post('num_serie');
		$digit_serie = $this->input->post('digit_serie');
		$signature1 = $this->input->post('signature1');
		$signature2 = $this->input->post('signature2');
		$signature3= $this->input->post('signature3');
		$size = $this->input->post('size');
		$size2 = $this->input->post('size2'); 
		$model = $this->input->post('model'); 
		$descriptive_variation = $this->input->post('descriptive_variation'); 
		$ep_g = $this->input->post('ep_g'); 
		$ep_f = $this->input->post('ep_f'); 
		$ep_vf = $this->input->post('ep_vf'); 
		$ep_unc = $this->input->post('ep_unc'); 
		
		$save_info = $this->input->post('saveInfo'); 

		$img_anverse = $data['anverse']; 
		$img_reverse = $data['reverse'];
		
		@session_start(); 
		
		$params = array(

			'id_countries' => $country ,

			'id_banknotes_title' => $title ,

			'id_banknotes_subtitle' => $subtitle ,

			'id_banknotes_denomination' => $denomination ,

			'id_banknotes_value' => $value ,

			'id_banknotes_circulation' => $circulation ,

			'issued_on_gre' => $issued_on_greg ,
			
			'issued_on_isl' => $issued_on_isla ,

			'id_banknotes_mint_house' => $mint_house ,
			
			'print_run' => $printRun ,

			'serie_variation' => $num_serie.'-'.$digit_serie ,

			'size' => $size ,

			'size2' => $size2 ,

			'signature1' => $signature1 ,

			'signature2' => $signature2 ,

			'signature3' => $signature3 ,

			'model' => $model ,

			'ep_g' => $ep_g ,

			'ep_f' => $ep_f ,

			'ep_vf' => $ep_vf ,

			'ep_unc' => $ep_unc ,

			'image_reverse' => $img_reverse , 

			'registration_date' => time() , 

			'status' => 0 ,

			'descriptive_variation' => $descriptive_variation ,

			'user' => $_SESSION['user']  

		);

 
		$params2 = array( 

			'id_countries' => $country ,

			'id_banknotes_title' => $title ,

			'id_banknotes_subtitle' => $subtitle ,

			'id_banknotes_denomination' => $denomination ,

			'id_banknotes_value' => $value ,

			'id_banknotes_circulation' => $circulation ,

			'issued_on_gre' => $issued_on_greg ,
			
			'issued_on_isl' => $issued_on_isla ,

			'id_banknotes_mint_house' => $mint_house ,
			
			'print_run' => $printRun ,

			'serie_variation' => $num_serie.'-'.$digit_serie ,

			'size' => $size ,

			'size2' => $size2 ,

			'signature1' => $signature1 ,

			'signature2' => $signature2 ,

			'signature3' => $signature3 ,

			'model' => $model ,

			'descriptive_variation' => $descriptive_variation ,


		); 

		$isRepeated = $this->db->get_where('banknotes',$params2);

		

		if ( $isRepeated->num_rows() > 0 ){

			$res = $isRepeated->result_array();

			

			return array(false,$res[0]);

		}

		

		$this->db->insert('banknotes',$params);

		

		$query = $this->db->get_where('banknotes',$params);

		$res = $query->result_array();

		

		//$this->set_activity( $res[0]['id_coins'] , $_SESSION['id_users'] , 0 );

		

		return array(true,$res[0]);

	}

	public function update_banknote( $params , $where ){

		

		$this->db->update('banknotes',$params,$where);

		

	} 
	
	public function get_date( $year , $month , $day ){

		

		$date_year = $this->input->post($year);

		if ( !$date_year ){

			return '';

		}

		else{

			$date_month = $this->input->post($month);

			$date_day = $this->input->post($day);

			

			if ( !$date_month )

				$date_month = '01';

			

			if ( !$date_day )

				$date_day = '01';

			

			return $date_year.'/'.$date_month.'/'.$date_day;			

		}

		

	}
	
	
	public function get_countries( $where = NULL ){

		$this->db->order_by('name','asc');

		if ( !$where ){

			$query = $this->db->get('countries');

			return $query->result_array();	

		}else{

			$query = $this->db->get_where('countries', $where );

			return $query->row_array();	

		}
 	
	}
	

	public function get_title( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('banknotes_title');

			return $query->result_array();	

		}

		else{

			$query = $this->db->get_where('banknotes_title', $where );

			return $query->row_array();	

		}			

	}
	
	public function get_title_by_country( $where = NULL ){
 
		$query = $this->db->get_where('banknotes_title', $where );
		return $query->result_array();
 	

	}

	public function get_subtitle( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('banknotes_subtitle');

			return $query->result_array();	

		}

		else{

			$query = $this->db->get_where('banknotes_subtitle', $where );

			return $query->row_array();	

		} 	

	}
	
	public function get_subtitle_by_title( $where = NULL ){
 
		$query = $this->db->get_where('banknotes_subtitle', $where );
		return $query->result_array();
 	

	}
	
	public function get_denomination( $where = NULL ){
 

		if ( !$where ){

			$query = $this->db->get('banknotes_denomination');
			return $query->result_array();	

		}

		else{

			$query = $this->db->get_where('banknotes_denomination', $where );
			return $query->row_array();	 

		}
	

	}
	
	public function get_denomination_by_subtitle( $where ){

		 
		$this->db->select('banknotes_denomination.*',FALSE);

		$this->db->from('banknotes_subtitle_denomination'); 

		$this->db->where('banknotes_subtitle_denomination.id_banknotes_subtitle =', $where); 
		
		$this->db->join('banknotes_denomination','banknotes_denomination.id_banknotes_denomination = banknotes_subtitle_denomination.id_banknotes_denomination','left'); 
		
		$query = $this->db->get();

		return $query->result_array();		

	}
	
	
	public function get_value( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('banknotes_value');

			return $query->result_array();	

		}

		else{

			$query = $this->db->get_where('banknotes_value', $where );

			return $query->row_array();	

		}
 
	}

	public function get_value_by_denomination( $where ){

		 
		$this->db->select('banknotes_value.*',FALSE);

		$this->db->from('banknotes_denomination_value'); 

		$this->db->where('banknotes_denomination_value.id_banknotes_denomination =', $where); 
		
		$this->db->join('banknotes_value','banknotes_value.id_banknotes_value = banknotes_denomination_value.id_banknotes_value','left'); 
		
		$query = $this->db->get();

		return $query->result_array();		

	}
	
	public function get_mint_house( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('banknotes_mint_house');
			return $query->result_array();	

		}

		else{

			$query = $this->db->get_where('banknotes_mint_house', $where );
			return $query->row_array();	

		} 

	}
	
	public function get_mint_house_by_country( $where = NULL ){

		 
			$query = $this->db->get_where('banknotes_mint_house', $where );
			return $query->result_array();	
 
	}
	

	
	public function get_countries3(){ 

		$this->db->select('c.* , COUNT(b.id_countries) as num');

		$this->db->from('countries c , banknotes b');

		$this->db->where('c.id_countries = b.id_countries');

		$this->db->group_by('c.id_countries');

		$this->db->having('num > 0');

		$this->db->order_by('c.name','asc');

		$query = $this->db->get();

		

		return $query->result_array();	

	}
	
	public function get_years(){

		

		$this->db->select('issued_on_gre');

		$this->db->from('banknotes');

		$this->db->where('issued_on_gre !=','');

		$this->db->group_by('issued_on_gre');

		$this->db->order_by('issued_on_gre','desc');

		$query = $this->db->get();

		

		$res = $query->result_array();

		

		$dates = '';

						

		for ($i= 0 ; $i < count($res) ; $i++){

			$date = $res[$i];

			//$date = str_replace("<strong>","",$date);

			$date = explode('/',$date['issued_on_gre']);

			

			if ( strcmp($date[0],'') != 0 and strpos($dates,$date[0]) === false )

				$dates = $date[0].','.$dates;

		}

		

		$dates = substr($dates,0,strlen($dates)-1);

		

		$dates = explode(',',$dates);

		

		return $dates;

	}
	
	public function explore_banknotes( $catalog, $country, $title, $subtitle, $denomination, $value, $year, $page, $order, $no_variations ){ 
		

		$cou = $this->get_countries( array('abbreviation'=>$country) ); 
		
 
		$this->db->select('SQL_CALC_FOUND_ROWS coun.name as country, b.image as image, b.image_reverse as image_reverse, b.id_banknotes as id_banknotes, b.issued_on_gre as issued_on_gre, b.issued_on_isl as issued_on_isl, banknotes_value.name as value, banknotes_denomination.name as denomination, banknotes_subtitle.name as subtitle, banknotes_title.name as title',FALSE);

		$this->db->from('banknotes b , countries coun');  
		
		$this->db->join('banknotes_title','banknotes_title.id_banknotes_title = b.id_banknotes_title','left');
		
		$this->db->join('banknotes_subtitle','banknotes_subtitle.id_banknotes_subtitle = b.id_banknotes_subtitle','left');
		
		$this->db->join('banknotes_denomination','banknotes_denomination.id_banknotes_denomination = b.id_banknotes_denomination','left');
		
		$this->db->join('banknotes_value','banknotes_value.id_banknotes_value = b.id_banknotes_value','left');

		$this->db->where('b.id_countries',$cou['id_countries']);
		 
		
		if($catalog==0){
			
		}else{
			$this->db->where('b.id_banknotes_circulation',$catalog);	
		} 
		
		if(strcmp('allyears',$year)==0){
			
		}else if(strcmp('unknown',$year)==0){
			$this->db->where('b.issued_on_gre','');	
			
		}else{
			$this->db->where('b.issued_on_gre',$year);	
			
		}
		
		if ( $title != 0 ){

			$this->db->where('b.id_banknotes_title',$title);

		}
		
		if ( $subtitle != 0 ){

			$this->db->where('b.id_banknotes_subtitle',$subtitle);

		}
		
		if ( $denomination != 0 ){

			$this->db->where('b.id_banknotes_denomination',$denomination);

		}
		
		if ( $value != 0 ){

			$this->db->where('b.id_banknotes_value',$value);

		}
		 
		
		$this->db->where('b.id_countries = coun.id_countries'); 

		if ( $no_variations == 1 ){

			$this->db->group_by('b.id_banknotes_title , b.id_banknotes_subtitle, b.id_banknotes_denomination, b.id_banknotes_value, b.print_run');

		}

		else{

			$this->db->group_by('b.id_banknotes');

		}

		if ( $order ){
			

			if ( strcmp($order,"by_reference") == 0 ){

				$this->db->order_by('reference','desc');

			}

			elseif( strcmp($order,"by_face_value") == 0 ){

				$this->db->order_by('face_value');

			}

			elseif( strcmp($order,"by_serie") == 0 ){

				$this->db->order_by('Serie');

			}

			elseif( strcmp($order,"by_catalog") == 0 ){

				$this->db->order_by('registration_date , print_run , id_banknotes');

			}		

		}

		else{

			$this->db->order_by('registration_date , print_run , id_banknotes');

		}
 
		if ( strcmp($year,'Unknown') != 0 and strcmp(strtolower($year),'allyears') != 0 ){

			$this->db->like('b.order_date',$year,'after');

		}
		
		if ( $page and $page > 1 ){

			$this->db->limit(12 ,($page-1)*12);

		}

		else{

			$this->db->limit(12,0);

		}

		

		$query = $this->db->get();

		

		//echo $this->db->last_query();

		$nums = $this->db->query('SELECT FOUND_ROWS() AS `Count`');

		$num = $nums->row()->Count;

		

		return array($num,$query->result_array());

	} 

		public function search( $words , $all = false , $page = 0 ){

		$this->db->select('SQL_CALC_FOUND_ROWS bn.*, t.name as title, v.name as value , s.name as subtitle, c.name as Country',FALSE);

		$this->db->from('banknotes bn , banknotes_title t , banknotes_value v , banknotes_subtitle s, countries c');

		$this->db->where('bn.id_banknotes_title = t.id_banknotes_title');

		$this->db->where('bn.id_banknotes_value = v.id_banknotes_value');

		$this->db->where('bn.id_banknotes_subtitle = s.id_banknotes_subtitle');

		$this->db->where('bn.id_countries = c.id_countries');

		for ( $i = 0 ; $i < count($words) ; $i++ ){

			

			$array = array(

				't.name',

				'v.name',

				's.name',

				'c.name',


			);

			

			$wlike = "";

			

			for ( $j = 0 ; $j < count($array) ; $j++ ){

				$wlike = $wlike.$array[$j].' like "%'.$words[$i].'%" OR ';

			}

			

			$wlike = substr($wlike,0,strlen($wlike)-3);

			

			$this->db->where('( '.$wlike.' )');

		}

		

		if ( !$all ){

			//$this->db->group_by('p.name');

			$this->db->order_by(' print_run , title , id_banknotes');

			$this->db->limit(6);

		}

		else{

			$this->db->group_by('bn.id_banknotes');

			$this->db->order_by(' print_run , title  , id_banknotes');

			$this->db->limit(12 ,($page-1)*12);

		}

		

		$query = $this->db->get();

		

		//echo $this->db->last_query();

		

		$nums = $this->db->query('SELECT FOUND_ROWS() AS `Count`');

		$num = $nums->row()->Count;

		

		$result['num'] = $num;

		$result['bns'] = $query->result_array();

		

		

		return $result;

	}

	public function edit_banknote( $data ){

	
		$country = $this->input->post('country');

		$title = $this->input->post('title');
		
		$subtitle = $this->input->post('subtitle');
		
		$denomination = $this->input->post('denomination');

		$value = $this->input->post('value');
 
 
 
		if ( !$country or !$title or !$subtitle or !$value or !$denomination ){

			return array(false,NULL);

		}
	
		$circulation = $this->input->post('circulation');
		$issued_on_greg = $this->get_date('date_year_greg','date_month_greg','date_day_greg'); 
		$issued_on_isla = $this->get_date('date_year_isla','date_month_isla','date_day_isla'); 
		$mint_house = $this->input->post('mint_house');
		$printRun = $this->input->post('printRun'); 
		$num_serie = $this->input->post('num_serie');
		$digit_serie = $this->input->post('digit_serie');
		$signature1 = $this->input->post('signature1');
		$signature2 = $this->input->post('signature2');
		$signature3= $this->input->post('signature3');
		$size = $this->input->post('size');
		$size2 = $this->input->post('size2'); 
		$model = $this->input->post('model'); 
		$descriptive_variation = $this->input->post('descriptive_variation'); 
		$ep_g = $this->input->post('ep_g'); 
		$ep_f = $this->input->post('ep_f'); 
		$ep_vf = $this->input->post('ep_vf'); 
		$ep_unc = $this->input->post('ep_unc'); 


		$id_bn = $this->input->post('id_bn');

		$img_anverse = $data['anverse'];

		$img_reverse = $data['reverse'];

		//$reference = $this->input->post('reference');

				

		$params = array(

			'id_countries' => $country ,

			'id_banknotes_title' => $title ,

			'id_banknotes_subtitle' => $subtitle ,

			'id_banknotes_denomination' => $denomination ,

			'id_banknotes_value' => $value ,

			'id_banknotes_circulation' => $circulation ,

			'issued_on_gre' => $issued_on_greg ,
			
			'issued_on_isl' => $issued_on_isla ,

			'id_banknotes_mint_house' => $mint_house ,
			
			'print_run' => $printRun ,

			'serie_variation' => $num_serie.'-'.$digit_serie ,

			'size' => $size ,

			'size2' => $size2 ,

			'signature1' => $signature1 ,

			'signature2' => $signature2 ,

			'signature3' => $signature3 ,

			'model' => $model ,

			'ep_g' => $ep_g ,

			'ep_f' => $ep_f ,

			'ep_vf' => $ep_vf ,

			'ep_unc' => $ep_unc ,

			'descriptive_variation' => $var3 

		);

		

		@session_start();

		

		if ( isset($data['new_edit']) ){

			$params['user'] = $_SESSION['user'];

		}



		if ( strcmp($img_anverse,"") != 0 ){

			$params['image'] = $img_anverse;

		}

		if ( strcmp($img_reverse,"") != 0 ){

			$params['image_reverse'] = $img_reverse;

		}

		

		$params2 = array( 

			'id_countries' => $country ,

			'id_banknotes_title' => $title ,

			'id_banknotes_subtitle' => $subtitle ,

			'id_banknotes_denomination' => $denomination ,

			'id_banknotes_value' => $value ,

			'id_banknotes_circulation' => $circulation ,

			'issued_on_gre' => $issued_on_greg ,
			
			'issued_on_isl' => $issued_on_isla ,

			'id_banknotes_mint_house' => $mint_house ,
			
			'print_run' => $printRun ,

			'serie_variation' => $num_serie.'-'.$digit_serie ,

			'size' => $size ,

			'size2' => $size2 ,

			'signature1' => $signature1 ,

			'signature2' => $signature2 ,

			'signature3' => $signature3 ,

			'model' => $model ,

			'descriptive_variation' => $var3 

		);
 
		$this->db->where('id_banknotes = '.$data['id_bn']);

		$isRepeated = $this->db->get_where('banknotes',$params2);

		

		if ( $isRepeated->num_rows() > 0 ){

			return -1;

		}

		

		 $this->db->update('banknotes',$params,array( "id_banknotes"=>$id_bn ));

		$this->set_activity ( $id_bn , $_SESSION['id_users'] , 1 );

		

		return 0;

	}

		public function get_activity ( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('activity');

		}

		else{

			$query = $this->db->get_where('activity', $where );

		}

		

		return $query->result_array();	

	}

	public function set_activity ( $id_item , $id_users , $contribution ){

		

		$cont = $this->get_activity( array(

			'id_categories' => 3,

			'id_users' => $id_users,

			'id_item' => $id_item,

			'contribution' => $contribution

		) );

		

		if ( count($cont) == 0 ){

			$params = array(

				'id_categories' => 3,

				'id_item' => $id_item,

				'id_users' => $id_users,

				'date' => time(),

				'contribution' => $contribution

			);

			

			$this->db->insert('activity',$params);

		}

	}


	
}
?>