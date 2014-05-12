<?php

class Coin_model extends CI_Model {



	public function __construct(){

		$this->load->database();

	}

	public function get_coins( $where = NULL ){
 

		if ( !$where ){

			$query = $this->db->get('coins');
			return $query->result_array();

		}

		else{

			$query = $this->db->get_where('coins', $where );
			return $query->row_array();

		} 

	}

	 
	public function get_shape( $where = NULL ){ 

		if ( !$where ){

			$query = $this->db->get('coins_shape');
			return $query->result_array();

		}

		else{

			$query = $this->db->get_where('coins_shape', $where );
			return $query->row_array();
		}

	}

	public function get_title( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('coins_title');
			return $query->result_array();

		}

		else{

			$query = $this->db->get_where('coins_title', $where );
			return $query->row_array();

		}

				

	}
	
	public function get_title_by_country( $where = NULL ){
 
		$query = $this->db->get_where('coins_title', $where );
		return $query->result_array();
 	

	}

	public function get_subtitle( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('coins_subtitle');
			return $query->result_array();

		}

		else{

			$query = $this->db->get_where('coins_subtitle', $where );
			return $query->row_array();

		} 		

	}
	
	public function get_subtitle_by_title( $where = NULL ){
 
		$query = $this->db->get_where('coins_subtitle', $where );
		return $query->result_array();
 	

	}
	
	public function get_denomination( $where = NULL ){
 

		if ( !$where ){

			$query = $this->db->get('coins_denomination');
			return $query->result_array();	

		}

		else{

			$query = $this->db->get_where('coins_denomination', $where );
			return $query->row_array();	 

		}
	

	}
	
	public function get_denomination_by_subtitle( $where ){

		 
		$this->db->select('coins_denomination.*',FALSE);

		$this->db->from('coins_subtitle_denomination'); 

		$this->db->where('coins_subtitle_denomination.id_coins_subtitle =', $where); 
		
		$this->db->join('coins_denomination','coins_denomination.id_coins_denomination = coins_subtitle_denomination.id_coins_denomination','left'); 
		
		$query = $this->db->get();

		return $query->result_array();		

	}
	
	
	
	public function get_value( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('coins_value');
			return $query->result_array();	

		}

		else{

			$query = $this->db->get_where('coins_value', $where );
			return $query->row_array();	

		}	

	}
	
	public function get_value_by_denomination( $where ){

		 
		$this->db->select('coins_value.*',FALSE);

		$this->db->from('coins_denomination_value'); 

		$this->db->where('coins_denomination_value.id_coins_denomination =', $where); 
		
		$this->db->join('coins_value','coins_value.id_coins_value = coins_denomination_value.id_coins_value','left'); 
		
		$query = $this->db->get();

		return $query->result_array();		

	}
	
	public function get_composition( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('coins_material');
			return $query->result_array();	

		}

		else{

			$query = $this->db->get_where('coins_material', $where );
			return $query->row_array();	


		}

	}
	
	public function get_mint_house( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('coins_mint_house');
			return $query->result_array();	

		}

		else{

			$query = $this->db->get_where('coins_mint_house', $where );
			return $query->row_array();	

		} 

	}
	
	public function get_mint_house_by_country( $where = NULL ){

		 
			$query = $this->db->get_where('coins_mint_house', $where );
			return $query->result_array();	
 
	}
	

	public function get_edge( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('coins_edge');
			return $query->result_array();	

		}

		else{

			$query = $this->db->get_where('coins_edge', $where );
			return $query->row_array();	

		}	

	}
	
	public function get_designer( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('coins_designer');
			return $query->result_array();	

		}

		else{

			$query = $this->db->get_where('coins_designer', $where );
			return $query->row_array();	

		}

		

		return $query->result_array();		

	}


	public function insert_coin( $data ){ 

		$country = $this->input->post('country'); 
		$title = $this->input->post('title'); 
		$subtitle = $this->input->post('subtitle');
		$denomination = $this->input->post('denomination');
		$value = $this->input->post('value');
		$circulation = $this->input->post('circulation');
		$issued_on_gre = $this->input->post('date_year_greg'); 
		$issued_on_isl = $this->input->post('date_year_isla'); 
		$mint_house = $this->input->post('mint_house');
		$printRun = $this->input->post('printRun');
		$composition = $this->input->post('composition');
		$shape = $this->input->post('shape');
		if(!$this->input->post('size1')){
			
			$size1 = $this->input->post('size2');
			$size2 = $this->input->post('size3');
		}else{
			
			$size1 = $this->input->post('size1');
			$size2 = '';
		} 
		$weight = $this->input->post('weight');
		$edge = $this->input->post('edge');
		$designer = $this->input->post('designer'); 
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

			'id_coins_title' => $title ,

			'id_coins_subtitle' => $subtitle ,

			'id_coins_denomination' => $denomination ,

			'id_coins_value' => $value ,

			'id_coins_circulation' => $circulation ,

			'issued_on_gre' => $issued_on_gre ,

			'issued_on_isl' => $issued_on_isl ,

			'id_coins_mint_house' => $mint_house ,

			'print_run' => $printRun ,

			'id_coins_designer' => $designer ,

			'id_coins_composition' => $composition ,

			'id_coins_shape' => $shape ,
			
			'id_coins_edge' => $edge ,

			'weight' => $weight ,

			'size' => $size1 ,

			'size2' => $size2 ,

			'image' => $img_anverse ,

			'image_reverse' => $img_reverse , 

			'registration_date' => time() , 

			'status' => 0 ,

			'descriptive_variation' => $descriptive_variation ,
			
			'ep_g' => $ep_g ,
			
			'ep_f' => $ep_f ,
			
			'ep_vf' => $ep_vf ,
			
			'ep_unc' => $ep_unc ,

			'user' => $_SESSION['user']  

		);

 
		$params2 = array( 

			'id_countries' => $country ,

			'id_coins_title' => $title ,

			'id_coins_subtitle' => $subtitle ,

			'id_coins_denomination' => $denomination ,

			'id_coins_value' => $value ,

			'id_coins_circulation' => $circulation ,

			'issued_on_gre' => $issued_on_gre ,

			'issued_on_isl' => $issued_on_isl ,

			'id_coins_mint_house' => $mint_house ,

			'print_run' => $printRun ,

			'id_coins_designer' => $designer ,

			'id_coins_composition' => $composition ,

			'id_coins_shape' => $shape ,
			
			'id_coins_edge' => $edge ,
			
			'weight' => $weight ,

			'size' => $size1 ,

			'size2' => $size2 ,

			'descriptive_variation' => $descriptive_variation ,


		); 

		$isRepeated = $this->db->get_where('coins',$params2);

		

		if ( $isRepeated->num_rows() > 0 ){

			$res = $isRepeated->result_array();

			

			return array(false,$res[0]);

		}

		

		$this->db->insert('coins',$params);

		

		$query = $this->db->get_where('coins',$params);

		$res = $query->result_array();

		

		//$this->set_activity( $res[0]['id_coins'] , $_SESSION['id_users'] , 0 );

		

		return array(true,$res[0]);

	}
	
	public function update_coin( $params , $where ){

		

		$this->db->update('coins',$params,$where);

		

	} 
	

	public function get_countries( $where = NULL ){

		

		$this->db->order_by('name','asc');

		

		if ( !$where ){

			$query = $this->db->get('countries');

		}

		else{

			$query = $this->db->get_where('countries', $where );

		}

		

		return $query->result_array();		

	}

	
	
	public function get_countries3(){

		

		$this->db->select('c.* , COUNT(c.id_countries) as num');

		$this->db->from('countries c , coins co');

		$this->db->where('c.id_countries = co.id_countries');

		$this->db->group_by('c.id_countries');

		$this->db->having('num > 0');

		$this->db->order_by('c.name','asc');

		$query = $this->db->get();

		

		return $query->result_array();	

	}
	
	public function get_years(){

		

		$this->db->select('issued_on_gre');

		$this->db->from('coins');

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
	
	public function explore_coins( $catalog, $country, $title, $subtitle, $denomination, $value, $composition, $year, $page, $order, $no_variations ){ 
		

		$cou = $this->get_countries( array('abbreviation'=>$country) ); 
		
 
		$this->db->select('SQL_CALC_FOUND_ROWS coun.name as country, c.image as image, c.image_reverse as image_reverse, c.id_coins as id_coins, c.issued_on_gre as issued_on_gre, c.issued_on_isl as issued_on_isl, coins_material.name as composition, coins_value.name as value, coins_denomination.name as denomination, coins_subtitle.name as subtitle, coins_title.name as title',FALSE);

		$this->db->from('coins c , countries coun'); 
		
		$this->db->join('coins_title','coins_title.id_coins_title = c.id_coins_title','left');
		
		$this->db->join('coins_subtitle','coins_subtitle.id_coins_subtitle = c.id_coins_subtitle','left');
		
		$this->db->join('coins_denomination','coins_denomination.id_coins_denomination = c.id_coins_denomination','left');
		
		$this->db->join('coins_value','coins_value.id_coins_value = c.id_coins_value','left');
		
		$this->db->join('coins_material','coins_material.id_coins_material = c.id_coins_composition','left');

		$this->db->where('c.id_countries',$cou[0]['id_countries']);

		
		if($catalog==0){
			
		}else{
			$this->db->where('c.id_coins_circulation',$catalog);	
		} 
		
		if(strcmp('allyears',$year)==0){
			
		}else if(strcmp('unknown',$year)==0){
			$this->db->where('c.issued_on_gre','');	
			
		}else{
			$this->db->where('c.issued_on_gre',$year);	
			
		}
		
		if ( $title != 0 ){

			$this->db->where('c.id_coins_title',$title);

		}
		
		if ( $subtitle != 0 ){

			$this->db->where('c.id_coins_subtitle',$subtitle);

		}
		
		if ( $denomination != 0 ){

			$this->db->where('c.id_coins_denomination',$denomination);

		}
		
		if ( $value != 0 ){

			$this->db->where('c.id_coins_value',$value);

		}
		
		if ( $composition != 0 ){

			$this->db->where('c.id_coins_composition',$composition); 

		}
		
		$this->db->where('c.id_countries = coun.id_countries'); 

				

		if ( $no_variations == 1 ){

			$this->db->group_by('c.id_coins_title , c.id_coins_subtitle, c.id_coins_denomination, c.id_coins_value, c.print_run');

		}

		else{

			$this->db->group_by('c.id_coins');

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

				$this->db->order_by(' registration_date , print_run , id_coins');

			}		

		}

		else{

			$this->db->order_by(' registration_date , print_run , id_coins');

		}
 
		if ( strcmp($year,'Unknown') != 0 and strcmp(strtolower($year),'allyears') != 0 ){

			$this->db->like('p.order_date',$year,'after');

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

		$this->db->select('SQL_CALC_FOUND_ROWS co.*, t.name as title, m.name as mint_house , v.name as value , c.name as Country',FALSE);

		$this->db->from('coins co , coins_title t , coins_value v , coins_mint_house m, coins_edge e, coins_shape sh, countries c');

		$this->db->where('co.id_coins_title = t.id_coins_title');

		$this->db->where('co.id_coins_value = v.id_coins_value');

		$this->db->where('co.id_coins_mint_house = m.id_coins_mint_house');

		$this->db->where('co.id_coins_edge = e.id_coins_edge');

		$this->db->where('co.id_coins_shape = sh.id_coins_shape');

		$this->db->where('co.id_countries = c.id_countries');

		for ( $i = 0 ; $i < count($words) ; $i++ ){

			

			$array = array(

				't.name',

				'v.name',

				'm.name',

				'e.name',

				'sh.name',

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

			$this->db->order_by(' print_run , title , id_coins');

			$this->db->limit(6);

		}

		else{

			$this->db->group_by('co.id_coins');

			$this->db->order_by(' print_run , title  , id_coins');

			$this->db->limit(12 ,($page-1)*12);

		}

		

		$query = $this->db->get();

		

		//echo $this->db->last_query();

		

		$nums = $this->db->query('SELECT FOUND_ROWS() AS `Count`');

		$num = $nums->row()->Count;

		

		$result['num'] = $num;

		$result['cns'] = $query->result_array();

		

		

		return $result;

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

	public function edit_coin( $data ){
		
		$country = $this->input->post('country');

		$title = $this->input->post('title');

		$subtitle = $this->input->post('subtitle');

		$denomination = $this->input->post('denomination');

		$value = $this->input->post('value');

		$circulation = $this->input->post('circulation');
 		

		if ( !$country or !$title or !$subtitle or !$denomination or !$value ){

			return array(false,NULL);

		}

		$issued_on_greg = $this->input->post('date_year_greg');
		
		$issued_on_isla = $this->input->post('date_year_isla');
 
		$mint_house = $this->input->post('mint_house');
		
		$printRun = $this->input->post('printRun');		
		
		$composition = $this->input->post('composition');	

		$shape = $this->input->post('shape');

		if(!$this->input->post('size1')){
			
			$size1 = $this->input->post('size2');
			$size2 = $this->input->post('size3');
		}else{
			
			$size1 = $this->input->post('size1');
			$size2 = '';
		} 

		$weight = $this->input->post('weight');

		$edge = $this->input->post('edge');

		$designer = $this->input->post('designer'); 
		
		$descriptive_variation = $this->input->post('var3');  
		
		$ep_g = $this->input->post('ep_g'); 
		
		$ep_f = $this->input->post('ep_f'); 
		
		$ep_vf = $this->input->post('ep_vf'); 
		
		$ep_unc = $this->input->post('ep_unc'); 

		


		$save_info = $this->input->post('saveInfo');

		

		$id_cn = $this->input->post('id_cn');

		$img_anverse = $data['anverse'];

		$img_reverse = $data['reverse'];

		$reference = $this->input->post('reference');

				

		$params = array(

			'id_countries' => $country ,

			'id_coins_title' => $title ,

			'id_coins_subtitle' => $subtitle ,

			'id_coins_denomination' => $denomination ,

			'id_coins_value' => $value ,

			'id_coins_circulation' => $circulation ,

			'issued_on_gre' => $issued_on_greg ,

			'issued_on_isl' => $issued_on_isla ,

			'id_coins_mint_house' => $mint_house ,

			'print_run' => $printRun ,

			'id_coins_designer' => $designer ,

			'id_coins_composition' => $composition ,

			'id_coins_shape' => $shape ,
			
			'id_coins_edge' => $edge ,
			
			'weight' => $weight ,

			'size' => $size1 ,

			'size2' => $size2 ,

			'descriptive_variation' => $descriptive_variation ,
			
			'ep_g' => $ep_g ,
			
			'ep_f' => $ep_f ,
			
			'ep_vf' => $ep_vf ,
			
			'ep_unc' => $ep_unc ,

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

			'id_coins_title' => $title ,

			'id_coins_subtitle' => $subtitle ,

			'id_coins_denomination' => $denomination ,

			'id_coins_value' => $value ,

			'id_coins_circulation' => $circulation ,

			'issued_on_gre' => $issued_on_greg ,

			'issued_on_isl' => $issued_on_isla ,

			'id_coins_mint_house' => $mint_house ,

			'print_run' => $printRun ,

			'id_coins_designer' => $designer ,

			'id_coins_composition' => $composition ,

			'id_coins_shape' => $shape ,
			
			'id_coins_edge' => $edge ,
			
			'weight' => $weight ,

			'size' => $size1 ,

			'size2' => $size2 ,

			'descriptive_variation' => $descriptive_variation ,

		);
 
		$this->db->where('id_coins = '.$data['id_cn']);

		$isRepeated = $this->db->get_where('coins',$params2);

		

		if ( $isRepeated->num_rows() > 0 ){

			return -1;

		}

		

		 $this->db->update('coins',$params,array( "id_coins"=>$id_cn ));

		$this->set_activity ( $id_cn , $_SESSION['id_users'] , 1 );

		

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

			'id_categories' => 2,

			'id_users' => $id_users,

			'id_item' => $id_item,

			'contribution' => $contribution

		) );

		

		if ( count($cont) == 0 ){

			$params = array(

				'id_categories' => 2,

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