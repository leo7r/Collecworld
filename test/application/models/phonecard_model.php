<?php

class Phonecard_model extends CI_Model {



	public function __construct(){

		$this->load->database();

	}

	

	public function get_phonecard ( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('phonecards');

		}

		else{

			$query = $this->db->get_where('phonecards', $where );

		}

		

		return $query->result_array();	

	}

	public function get_phonecard_done ( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('phonecards_done');

		}

		else{

			$query = $this->db->get_where('phonecards_done', $where );

		}

		

		return $query->result_array();	

	}

	

	public function get_phonecard_full ( $id ){

		

		$sql = "SELECT p.id_phonecards as id, p.name as name, p.image as image, s.name as serie, c.name as country, pc.name as company FROM phonecards p, phonecards_series s, countries as c, phonecards_companies pc WHERE p.id_phonecards_series = s.id_phonecards_series AND p.id_countries = c.id_countries AND p.id_phonecards_companies = pc.id_phonecards_companies AND p.id_phonecards = ".$id." ORDER BY p.name";

		

		$cursor=mysql_query($sql);

		

		return $datos = mysql_fetch_array($cursor);

		

		

	}

	

	

	public function get_lists( $list ){

		

		$query = $this->db->get_where('lists', $list );

		

		return $query->row_array();

	}

	

	public function get_phonecard_list_user ( $user , $list, $country, $company, $catalog ){

	

		$sql = 'SELECT p.id_phonecards as id, p.name as name , s.name as serie , c.name as country, pc.name as company FROM phonecards p , phonecards_series s, countries as c, phonecards_companies pc WHERE p.id_phonecards_series = s.id_phonecards_series AND p.id_countries = c.id_countries AND p.id_phonecards_companies = pc.id_phonecards_companies AND p.id_phonecards_companies = '.$company.' AND p.id_countries = '.$country.' AND p.id_phonecards IN ( SELECT id_phonecards FROM phonecards_users WHERE id_users = '.$user.' AND id_lists = '.$list.' ) ';


		switch ( $catalog ){

		

		
		case 1:

		

			$sql = $sql.' AND p.order_date <> "Unknown" AND p.not_emmited = 0 AND p.especial = 0';

		

			break;

		

		case 2:

		

			$sql = $sql.' AND p.order_date = "Unknown" AND p.not_emmited = 0 AND p.especial = 0';

		

			break;

		

		case 3:

		

			$sql = $sql.' AND p.not_emmited = 1';

		

			break;

		

		case 4:

		

			$sql = $sql.' AND p.especial = 1';

		

			break;

		

			

		

		}

		

		

		

		$sql = $sql.' ORDER BY p.name';

				

		$cursor=mysql_query($sql);

		

		return $datos = mysql_fetch_array($cursor);

	

	}

		

	

	public function get_currencies( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('currencies');

		}

		else{

			$query = $this->db->get_where('currencies', $where );

		}

		

		return $query->result_array();		

	}

	

	public function get_categories( $where = NULL){

		

		if ( !$where ){

			$query = $this->db->get('categories');

		}

		else{

			$query = $this->db->get_where('categories', $where );

		}

		

		return $query->result_array();

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

	

	public function get_countries2(){

		

		$this->db->select('c.* , COUNT(c.id_countries) as num');

		$this->db->from('countries c , phonecards p');

		$this->db->where('c.id_countries = p.id_countries');

		$this->db->group_by('c.id_countries');

		$this->db->having('num > 0');

		$this->db->order_by('c.name','asc');

		$query = $this->db->get();

		

		return $query->result_array();	

	}

	

		public function get_countries3( $where = NULL ){	

		if ( !$where ){

			$query = $this->db->get('countries');

		}

		else{

			$query = $this->db->get_where('countries', $where );

		}

		

		return $query->result_array();		

	}

	

	public function get_phonecards_companies( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('phonecards_companies');

		}

		else{

			$query = $this->db->get_where('phonecards_companies', $where );

		}

		

		return $query->result_array();		

	}

	

	public function get_phonecards_series( $where = NULL ){

		

		if ( !$where ){

			$query = $this->db->get('phonecards_series');

		}

		else{

			$query = $this->db->get_where('phonecards_series', $where );

		}

		

		return $query->result_array();		

	}

	

	public function get_tags(){

		

		$this->db->order_by('name');

		$query = $this->db->get('tags');

		

		return $query->result_array();		

	}

	

	public function get_logos(){

		

		$query = $this->db->get('phonecards_logos');

		

		return $query->result_array();		

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

	

	public function insert_phonecard( $data ){

		

		$country = $this->input->post('country');

		$currency = $this->input->post('currency');

		$companies = $this->input->post('companies');

		$system = $this->input->post('system');

		$name = $this->input->post('name');
		
		$ep_n = $this->input->post('ep_n');
		
		$ep_uf = $this->input->post('ep_uf');
		
		$ep_ug = $this->input->post('ep_ug');
		
		$ep_ud = $this->input->post('ep_ud');

		

		if ( !$country or !$currency or !$companies or !$system or !$name ){

			return array(false,NULL);

		}

		

		$abbr = $this->companyAbbr($companies);

		

		$companies = $this->get_or_create_company($companies,$country,$abbr);

		$companies = $companies['id_phonecards_companies'];

		

		$not_emmited = $this->input->post('not_emmited');

		if ( strcmp($not_emmited,'on') == 0 ){

			$not_emmited = 1;

		}

		else{

			$not_emmited = 0;

		}



		$especial= $this->input->post('especial');

		if ( strcmp($especial,'on') == 0 ){

			$especial= 1;

		}

		else{

			$especial= 0;

		}

		

		$order_n = $this->input->post('order_n');

		$serie = $this->input->post('serie');

		$serie_n = $this->input->post('serie_n');

		$serie2 = $this->input->post('serie2');

		$serie_n2 = $this->input->post('serie_n2');

		

		if ( $serie ){

			$serie = $this->get_or_create_serie($serie,$companies);

			$serie = $serie['id_phonecards_series'];

			$serie_known = "0";

		}

		elseif ( !$serie and $serie2 ){

			$serie = $this->get_or_create_serie($serie2,$companies);

			$serie = $serie['id_phonecards_series'];

			$serie_known = "1";

		}

		else{

			$serie = $this->get_or_create_serie($serie,$companies);

			$serie = $serie['id_phonecards_series'];

			$serie_known = "0";

		}

		

		if ( !$serie_n and $serie_n2 ){

			$serie_n = $serie_n2;

		}

		

		if ( !$serie_n )

			$serie_n = 0;

		

		$print_run = $this->input->post('printRun');

		$print_run2 = $this->input->post('printRun2');

		$print_run_known = "";

		

		if ( !$print_run ){			

			if ( $print_run2 ){

				$print_run = $print_run2;

				$print_run_known = "1";

			}

			else

				$print_run = 0;

		}

		

		$issued_on = $this->get_date('date_year','date_month','date_day');

		$exp_date = $this->get_date('date_ex_year','date_ex_month','date_ex_day');

		$known_date = $this->get_date('date_known_year','date_known_month','date_known_day');

		

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

		

		$face_value = $this->input->post('faceValue');

		if ( !$face_value )

			$face_value = 0;

		

		$tags = '';

		for ($i=0 ; $i < 4 ; $i++){

			

			$tag = $this->input->post('tag'.$i);

			

			if ( strcmp($tag,'-1') != 0 ){

				$tags = $tags.$tag.',';

			}

			else{

				break;

			}

		}

		$tags = substr($tags,0,strlen($tags)-1);

		

		$var1 = $this->input->post('var1');

		$var2 = $this->input->post('var2');

		$var3 = $this->input->post('var3');

		$est_price = $this->input->post('est_price');

		$save_info = $this->input->post('saveInfo');

		

		$code = $this->phonecardCatalog( $country , $companies , $system , $not_emmited );

		

		$img_anverse = $data['anverse'];

		$img_reverse = $data['reverse'];

		

		@session_start();

		

		$variant_params = array(

			'name' => $name,

			'id_phonecards_series' => $serie ,

			'serie_number' => $serie_n ,

			'id_phonecards_companies' => $companies ,

			'id_countries' => $country ,

			'id_phonecards_systems' => $system ,

			'issued_on' => $issued_on ,

			'exp_date' => $exp_date ,

			'known_date' => $known_date ,

			'face_value' => $face_value ,

			'id_currencies' => $currency ,

			'print_run' => $print_run ,

			'not_emmited' => $not_emmited ,

			'especial' => $especial,
			
			'ep_n' => $ep_n,
			
			'ep_uf' => $ep_uf,
			
			'ep_ug' => $ep_ug,
			
			'ep_ud' => $ep_ud,

			'status' => 1

		);

		

		$isVariant = $this->get_phonecard($variant_params);

		

		if ( count($isVariant) > 0 ){

			return array(false,false);

		}



		$params = array(

			'code' => $code ,

			'name' => $name ,

			'id_phonecards_series' => $serie ,

			'serie_number' => $serie_n ,

			'id_phonecards_companies' => $companies ,

			'id_countries' => $country ,

			'id_phonecards_systems' => $system ,

			'id_variation1' => $var1 ,

			'id_variation2' => $var2 ,

			'issued_on' => $issued_on ,

			'exp_date' => $exp_date ,

			'known_date' => $known_date ,

			'face_value' => $face_value ,

			'id_currencies' => $currency ,

			'print_run' => $print_run ,

			'image' => $img_anverse ,

			'image_reverse' => $img_reverse ,

			'views' => 0 ,

			'registration_date' => time() ,

			'tags' => $tags ,

			'status' => 0 ,

			'descriptive_variation' => $var3 ,

			'user' => $_SESSION['user'] ,

			'not_emmited' => $not_emmited ,

			'especial' => $especial,

			'est_price' => $est_price ,

			'order_date' => $order_date ,

			'serie_known' => $serie_known ,

			'print_run_known' => $print_run_known ,

			'vertical_anverse' => 0 ,

			'vertical_reverse' => 0 ,

			'order_n' => $order_n ,	

		);



		if ( strcmp($system,'1') == 0 ){

			$params2 = array( 

				'name' => $name ,

				'id_phonecards_series' => $serie ,

				'serie_number' => $serie_n ,

				'id_phonecards_companies' => $companies ,

				'id_currencies' => $currency ,

				'order_date' => $order_date ,

				'print_run' => $print_run ,

				'face_value' => $face_value ,

				'exp_date' => $exp_date ,

				'id_countries' => $country ,

				'id_phonecards_systems' => $system ,

				'id_variation1' => $var1 ,

				'id_variation2' => $var2,

				'descriptive_variation' => $var3

				);

		}

		else{

			$params2 = array( 

				'name' => $name ,

				'id_phonecards_series' => $serie ,

				'serie_number' => $serie_n ,

				'id_phonecards_companies' => $companies ,

				'id_currencies' => $currency ,

				'order_date' => $order_date ,

				'print_run' => $print_run ,

				'face_value' => $face_value ,

				'exp_date' => $exp_date ,

				'id_countries' => $country ,

				'id_phonecards_systems' => $system ,

				'descriptive_variation' => $var3

				);

		}

		

		$isRepeated = $this->db->get_where('phonecards',$params2);

		

		if ( $isRepeated->num_rows() > 0 ){

			$res = $isRepeated->result_array();

			

			return array(false,$res[0]);

		}

		

		$this->db->insert('phonecards',$params);

		

		$query = $this->db->get_where('phonecards',$params);

		$res = $query->result_array();

		

		$this->set_activity( $res[0]['id_phonecards'] , $_SESSION['id_users'] , 0 );

		

		return array(true,$res[0]);

	}

	

        public function update_phonecard( $params , $where ){

		

		$this->db->update('phonecards',$params,$where);

		

	} 



	public function edit_phonecard( $data ){

		

		$country = $this->input->post('country');

		$currency = $this->input->post('currency');

		$companies = $this->input->post('companies');

		$system = $this->input->post('system');

		$name = $this->input->post('name');

		

		if ( !$country or !$currency or !$companies or !$system or !$name ){

			return array(false,NULL);

		}

		

		$abbr = $this->companyAbbr($companies);

		

		$companies = $this->get_or_create_company($companies,$country,$abbr);

		$companies = $companies['id_phonecards_companies'];

		

		$not_emmited = $this->input->post('not_emmited');

		if ( strcmp($not_emmited,'on') == 0 ){

			$not_emmited = 1;

		}

		else{

			$not_emmited = 0;

		}



                $especial= $this->input->post('especial');

		if ( strcmp($especial,'on') == 0 ){

			$especial= 1;

		}

		else{

			$especial= 0;

		}

		

		$order_n = $this->input->post('order_n');

		

		$serie = $this->input->post('serie');		

		$serie_n = $this->input->post('serie_n');

		

		$serie2 = $this->input->post('serie2');

		$serie_n2 = $this->input->post('serie_n2');

		$serie_known = "";

		

		if ( !$serie and $serie2 ){

			$serie = $this->get_or_create_serie($serie2,$companies);

			$serie_known = "1";

		}

		else{

			$serie = $this->get_or_create_serie($serie,$companies);

		}

		$serie = $serie['id_phonecards_series'];		

		

		if ( !$serie_n and $serie_n2 ){

				$serie_n = $serie_n2;

			}

		

		if ( !$serie_n )

			$serie_n = 0;

		

		$print_run = $this->input->post('printRun');

		$print_run2 = $this->input->post('printRun2');

		$print_run_known = "";

		

		if ( !$print_run ){			

			if ( $print_run2 ){

				$print_run = $print_run2;

				$print_run_known = "1";

			}

			else

				$print_run = 0;

		}

		

		$issued_on = $this->get_date('date_year','date_month','date_day');

		$exp_date = $this->get_date('date_ex_year','date_ex_month','date_ex_day');

		$known_date = $this->get_date('date_known_year','date_known_month','date_known_day');

		

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

		

		$face_value = $this->input->post('faceValue');

		if ( !$face_value )

			$face_value = 0;

		

		$tags = '';

		for ($i=0 ; $i < 4 ; $i++){

			

			$tag = $this->input->post('tag'.$i);

			

			if ( strcmp($tag,'-1') != 0 ){

				$tags = $tags.$tag.',';

			}

			else{

				break;

			}

		}

		$tags = substr($tags,0,strlen($tags)-1);

		

		$var1 = $this->input->post('var1');

		$var2 = $this->input->post('var2');

		$var3 = $this->input->post('var3');

		$est_price = $this->input->post('est_price');

		$save_info = $this->input->post('saveInfo');

		

		$id_pc = $this->input->post('id_pc');

		$img_anverse = $data['anverse'];

		$img_reverse = $data['reverse'];

		$reference = $this->input->post('reference');

				

		$params = array(

			'name' => $name ,

			'id_phonecards_series' => $serie ,

			'serie_number' => $serie_n ,

			'id_phonecards_companies' => $companies ,

			'id_countries' => $country ,

			'id_phonecards_systems' => $system ,

			'id_variation1' => $var1 ,

			'id_variation2' => $var2 ,

			'issued_on' => $issued_on ,

			'exp_date' => $exp_date ,

			'known_date' => $known_date ,

			'face_value' => $face_value ,

			'id_currencies' => $currency ,

			'print_run' => $print_run ,

			'views' => 0 ,

			'tags' => $tags ,

			'status' => 0 ,

			'descriptive_variation' => $var3 ,

			'not_emmited' => $not_emmited ,

			'especial' => $especial,

			'est_price' => $est_price ,

			'order_date' => $order_date ,

			'serie_known' => $serie_known ,

			'print_run_known' => $print_run_known ,

			'vertical_anverse' => 0 ,

			'vertical_reverse' => 0 ,

			'order_n' => $order_n ,

			'reference' => $reference

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

			'name' => $name ,

			'id_phonecards_series' => $serie ,

			'serie_number' => $serie_n ,

			'id_phonecards_companies' => $companies ,

			'id_currencies' => $currency ,

			'order_date' => $order_date ,

			'print_run' => $print_run ,

			'face_value' => $face_value ,

			'exp_date' => $exp_date ,

			'id_countries' => $country ,

			'id_phonecards_systems' => $system ,

			'descriptive_variation' => $var3

		);

		

		if ( strcmp($system,'1') == 0 ){

			$params2['id_variation1'] = $var1;

			$params2['id_variation2'] = $var2;

		}

		

		$this->db->where('id_phonecards <> '.$data['id_pc']);

		$isRepeated = $this->db->get_where('phonecards',$params2);

		

		if ( $isRepeated->num_rows() > 0 ){

			return -1;

		}

		

		$this->db->update('phonecards',$params,array( "id_phonecards"=>$id_pc ));

		$this->set_activity ( $id_pc , $_SESSION['id_users'] , 1 );

		

		return 0;

	}

	

	/* Create catalog number of a phonecard. */

	function phonecardCatalog( $id_country , $id_company , $system_num , $not_emmited ){

		

		$cou = $this->get_countries(array('id_countries' => $id_country));

		$cou = $cou[0];

		

		$com = $this->get_phonecards_companies(array('id_phonecards_companies' => $id_company));

		$com = $com[0];

		

		switch ( $system_num ){

			case 1:

				$system = 'ch';

				break;

			case 2:

				$system = 'mb';

				break;

			case 3:

				$system = 'op';

				break;

			case 4:

				$system = 'rm';

				break;

			case 5:

				$system = 'in';

				break;

			default:

				return -1;

				break;

		}

		

		$catalog = $cou['abbreviation'].'-'.$com['abbreviation'].'-'.$system.($not_emmited == 0 ? '1':'2').'-';	

		

		$this->db->select('*');

		$this->db->from('phonecards');

		$this->db->like('code',$catalog.'%');

		$query = $this->db->get();

		

		$num = $query->num_rows();

		

		$catalog = $catalog.($num+1);

		return $catalog;

	}

	

	public function get_or_create_serie( $name , $id_company ){

	

		$series = $this->get_phonecards_series(array('name'=>$name , 'id_phonecards_companies'=>$id_company));

		

		if ( count($series) == 0 ){

			

			$this->insert_phonecards_serie($name,$id_company,0);

			$ret = $this->get_phonecards_series(array('name'=>$name , 'id_phonecards_companies'=>$id_company));	

			

			return $ret[0];		

		}

		else{

			return $series[0];

		}

	}

	

	public function insert_phonecards_serie( $name , $id_company , $status ){

		

		$this->db->insert('phonecards_series',array('name'=>$name,'id_phonecards_companies'=>$id_company,'status'=>$status));

		

	}

	

	public function get_or_create_company( $name , $id_country , $abbr ){

	

		$company = $this->get_phonecards_companies(array('name'=>$name , 'id_countries'=>$id_country));

		

		if ( count($company) == 0 ){

			

			$this->insert_phonecards_company($name,$id_country,$abbr);

			$ret = $this->get_phonecards_companies(array('name'=>$name , 'id_countries'=>$id_country , 'abbreviation'=>$abbr));	

			

			return $ret[0];	

		}

		else{

			return $company[0];

		}

	}

	

	public function insert_phonecards_company( $name , $id_country , $abbr ){

		

		$this->db->insert('phonecards_companies',array('name'=>$name,'id_countries'=>$id_country,'abbreviation'=>$abbr));

		

	}

	

		/*

	Create company abbreviation

	@param $company_name : Name of the company

	@return Company abbreviation or null if there's no way to create a abbreviation.

	*/

	function companyAbbr( $company_name ){

				

		$company_name = str_replace(' ', '' , $company_name);

		$abbr = substr($company_name,0,3);

		$i = 3;

		$k = 0;

		

		while ( true ){

		

			if ( ($i-1) == strlen($company_name) ){

				

				$left = substr($company_name,0,1);

				$right = substr($company_name,2);

				$new_name = $left.$right;

				

				if ( strlen($new_name) >= 3 )

					return $this->companyAbbr($new_name);

				else

					return '';

			}

			

			$num = count($this->get_phonecards_companies(array('abbreviation'=>$abbr)));

			

			if ( $num == 0 ){

				

				break;

			}

			else{

				$abbr = substr($company_name,0,2).substr($company_name,$i,1);

				$i = $i+1;

			}

			

		}

		

		return strtolower($abbr);

	}

	

	public function get_years(){

		

		$this->db->select('order_date');

		$this->db->from('phonecards');

		$this->db->where('order_date !=','Unknown');

		$this->db->group_by('order_date');

		$this->db->order_by('order_date','desc');

		$query = $this->db->get();

		

		$res = $query->result_array();

		

		$dates = '';

						

		for ($i= 0 ; $i < count($res) ; $i++){

			$date = $res[$i];

			//$date = str_replace("<strong>","",$date);

			$date = explode('/',$date['order_date']);

			

			if ( strcmp($date[0],'') != 0 and strpos($dates,$date[0]) === false )

				$dates = $date[0].','.$dates;

		}

		

		$dates = substr($dates,0,strlen($dates)-1);

		

		$dates = explode(',',$dates);

		

		return $dates;

	}

	

	public function explore_phonecards( $catalog , $system , $country , $company , $serie , $year , $page , $order , $no_variations ){

		

		// Catalog

		if ( strcmp($catalog,'dated') == 0 ){

			$where0 = 'p.not_emmited = 0 AND p.especial = 0 and p.order_date <> "Unknown"'; 

		}

		elseif ( strcmp($catalog,'undated') == 0 ){

			$where0 = 'p.not_emmited = 0 AND p.especial = 0 and p.order_date = "Unknown"'; 

		}

		elseif ( strcmp($catalog,'not-emmited') == 0 ){

			$where0 = 'p.not_emmited = 1 AND p.especial = 0'; 

		}

		else{

			return;

		}

		

		// System

		if ( strcmp($system,'chip') == 0 ){

			$where1 = 1; 

		}

		elseif ( strcmp($system,'magnetic-band') == 0 ){

			$where1 = 2;

		}

		elseif ( strcmp($system,'optical') == 0 ){

			$where1 = 3; 

		}

		elseif ( strcmp($system,'remote-memory') == 0 ){

			$where1 = 4; 

		}

		elseif ( strcmp($system,'induced') == 0 ){

			$where1 = 5; 

		}

		else{

			return;

		}

		

		$cou = $this->get_countries( array('abbreviation'=>$country) );

		$com = $this->get_phonecards_companies( array('abbreviation'=>$company) );

		

		$this->db->select('SQL_CALC_FOUND_ROWS p.name as Name , ps.name as Serie , p.id_phonecards_systems as System , c.name as Country , pc.name as Company , p.issued_on , p.face_value , p.print_run , p.id_phonecards , p.image , p.image_reverse , p.known_date , p.exp_date , p.code , p.vertical_anverse , p.vertical_reverse , p.serie_number ,p.serie_known',FALSE);

		$this->db->from('phonecards p , phonecards_companies pc , countries c , phonecards_series ps');

		$this->db->where($where0);

		$this->db->where('p.id_phonecards_systems',$where1);

		

		$this->db->where('p.id_countries',$cou[0]['id_countries']);

		$this->db->where('p.id_phonecards_companies',$com[0]['id_phonecards_companies']);

		

		if ( $serie ){

			$this->db->where('ps.id_phonecards_series',$serie);

		}

		

		$this->db->where('p.id_countries = c.id_countries');

		$this->db->where('p.id_phonecards_companies = pc.id_phonecards_companies');

		$this->db->where('p.id_phonecards_series = ps.id_phonecards_series');

				

		if ( $no_variations == 1 ){

			$this->db->group_by('p.id_phonecards_companies , p.name, p.order_date, p.face_value');

		}

		else{

			$this->db->group_by('p.id_phonecards');

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

				$this->db->order_by('order_n , order_date , face_value , print_run , name , serie_number , id_phonecards');

			}		

		}

		else{

			$this->db->order_by('order_n , order_date , face_value , print_run , name , serie_number , id_phonecards');

		}

		

		if ( strcmp($catalog,'dated') == 0 and strcmp($year,'Unknown') != 0 and strcmp(strtolower($year),'allyears') != 0 ){

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

			'id_categories' => 1,

			'id_users' => $id_users,

			'id_item' => $id_item,

			'contribution' => $contribution

		) );

		

		if ( count($cont) == 0 ){

			$params = array(

				'id_categories' => 1,

				'id_item' => $id_item,

				'id_users' => $id_users,

				'date' => time(),

				'contribution' => $contribution

			);

			

			$this->db->insert('activity',$params);

		}

	}

	

	public function search( $words , $all = false , $page = 0 ){

		

		$this->db->select('SQL_CALC_FOUND_ROWS p.* , p.name as Name , p.id_phonecards_systems as System , pc.name as Company , ps.name as Serie , c.name as Country',FALSE);

		$this->db->from('phonecards p , phonecards_series ps , phonecards_companies pc , countries c');

		$this->db->where('p.id_phonecards_series = ps.id_phonecards_series');

		$this->db->where('p.id_phonecards_companies = pc.id_phonecards_companies');

		$this->db->where('p.id_countries = c.id_countries');

		

		for ( $i = 0 ; $i < count($words) ; $i++ ){

			

			$array = array(

				'p.name',

				'ps.name',

				'pc.name',

				'c.name',

				'p.tags',

				'p.code'

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

			$this->db->order_by('order_date , face_value , print_run , name , serie_number , id_phonecards');

			$this->db->limit(6);

		}

		else{

			$this->db->group_by('p.id_phonecards');

			$this->db->order_by('order_date , face_value , print_run , name , serie_number , id_phonecards');

			$this->db->limit(12 ,($page-1)*12);

		}

		

		$query = $this->db->get();

		

		//echo $this->db->last_query();

		

		$nums = $this->db->query('SELECT FOUND_ROWS() AS `Count`');

		$num = $nums->row()->Count;

		

		$result['num'] = $num;

		$result['pcs'] = $query->result_array();

		

		

		return $result;

	}

	

	public function get_rare_phonecards( $id_countries ){
		
		$this->db->select('p.name, p.known_date , p.id_phonecards_systems , p.image , c.name as company , s.name as serie');
		$this->db->from('phonecards p , phonecards_companies c , phonecards_series s');
		$this->db->where('p.id_countries',$id_countries);
		$this->db->where('p.id_phonecards_companies = c.id_phonecards_companies');
		$this->db->where('p.id_phonecards_series = s.id_phonecards_series');
		$this->db->where('(not_emmited = 1 OR especial = 1)');
		$this->db->order_by('order_date');
		$this->db->limit(6);
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function get_country_catalog( $id_countries ){
		
		$query = $this->db->get_where('catalog_code',array('id_countries' => $id_countries, 'id_categories' => 1));
		
		if ( $query->num_rows() > 0 ){
			$catalog = $query->result_array();
			return $catalog[0];
		}
		
		return NULL;
	}
	
	public function get_user_collection( $id_users , $list_id , $id_countries , $id_companies , $system , $catalog , $no_variations , $lack ){
		
		$this->db->select('p.id_phonecards, p.name as name , ps.name as system, pl.name as logo, s.name as serie , c.name as country, pc.name as company , p.issued_on, p.known_date, p.print_run , p.face_value, p.descriptive_variation'.( !$lack ? ', pu.id_phonecards_users':''));
		$this->db->from('phonecards p , phonecards_series s, countries as c, phonecards_companies pc'.( !$lack ? ', phonecards_users pu':''));
		$this->db->join('phonecards_systems ps','p.id_variation1 = ps.id_phonecards_systems','left');
		$this->db->join('phonecards_logos pl','p.id_variation2 = pl.id_phonecards_logo','left');
		$this->db->where('p.id_phonecards_series = s.id_phonecards_series');
		$this->db->where('p.id_countries = c.id_countries');
		$this->db->where('p.id_phonecards_companies = pc.id_phonecards_companies');
		$this->db->where('p.id_variation1 = ps.id_phonecards_systems');
		$this->db->where('p.id_phonecards_companies',$id_companies);
		$this->db->where('p.id_countries', $id_countries);
		$this->db->where('p.id_phonecards_systems',$system);
		
		if ( $lack ){
			$this->db->where('p.id_phonecards NOT IN ( SELECT p.id_phonecards FROM phonecards p , phonecards_series s, countries as c, phonecards_companies pc WHERE p.id_phonecards_series = s.id_phonecards_series AND p.id_countries = c.id_countries AND p.id_phonecards_companies = pc.id_phonecards_companies AND p.id_phonecards_companies = '.$id_companies.' AND p.id_countries = '.$id_countries.' AND p.id_phonecards_systems = '.$system.' AND p.id_phonecards IN ( SELECT id_phonecards FROM phonecards_users WHERE id_users = '.$id_users.' AND id_lists = '.$list_id.' ) )');
		}
		else{
			$this->db->where('pu.id_phonecards = p.id_phonecards');
			$this->db->where('pu.id_users',$id_users);
			$this->db->where('pu.id_lists',$list_id);
			$this->db->where('p.id_phonecards IN ( SELECT id_phonecards FROM phonecards_users WHERE id_users = '.$id_users.' AND id_lists = '.$list_id.' )');
		}
			
		switch ( $catalog ){
			case 1:
				$this->db->where('p.order_date <> "Unknown"');
				$this->db->where('p.not_emmited',0);
				$this->db->where('p.especial',0);
				break;
			case 2:
				$this->db->where('p.order_date = "Unknown"');
				$this->db->where('p.not_emmited',0);
				$this->db->where('p.especial',0);
				break;
			case 3:
				$this->db->where('p.not_emmited',1);
				break;
			case 4:
				$this->db->where('p.especial',1);
				break;
		}
		
		if ( $no_variations ){
			$this->db->group_by('p.id_phonecards_companies , p.name, p.face_value, p.print_run');
		}
		
		$this->db->order_by('p.order_n , p.order_date , p.face_value , p.print_run , p.name , p.serie_number , p.id_phonecards');
				
		$query = $this->db->get();
		
		//echo $this->db->last_query();
		
		return $query->result_array();
	}
	
}
?>