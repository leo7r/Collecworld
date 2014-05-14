<?php
class User_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function login( $user , $pass ){
		
		$this->db->where('status >= 0');
		//$query = $this->db->get_where('users', array('user' => $user , 'password' => 'Md5("'.$pass.'")') );
		$query = $this->db->get_where('users', array('user' => $user) );
		
		if ( $query->num_rows() > 0 ){
			
			$res = $query->result_array();
        	$res = $res[0];
		
			@session_start();
			$_SESSION['user'] = $res['user'];
			$_SESSION['name'] = $res['name'];
			$_SESSION['email'] = $res['email'];
			$_SESSION['id_users'] = (int) $res['id_users'];
			$_SESSION['status'] = $res['status'];
			$_SESSION['img'] = $res['image'];
			
			setcookie("user", $res['user'], time()+(3600*10));
			setcookie("name", $res['name'], time()+(3600*10));
			setcookie("email", $res['email'], time()+(3600*10));
			setcookie("id_users", $res['id_users'], time()+(3600*10));
			setcookie("status", $res['status'], time()+(3600*10));
			setcookie("img", $res['image'], time()+(3600*10));
			
			return true;
		}
		
		return false;
	}
	
	public function login_nopass( $id , $user ){
		
		$query = $this->db->get_where('users', array('user' => $user , 'id_users' => $id) );
		
		if ( $query->num_rows() > 0 ){
			
			$res = $query->result_array();
        	$res = $res[0];
		
			@session_start();
			$_SESSION['user'] = $res['user'];			
			$_SESSION['name'] = $res['name'];
			$_SESSION['email'] = $res['email'];
			$_SESSION['id_users'] = (int) $res['id_users'];
			$_SESSION['status'] = $res['status'];
			$_SESSION['img'] = $res['image'];
			
			setcookie("user", $res['user'], time()+(3600*10));
			setcookie("name", $res['name'], time()+(3600*10));
			setcookie("email", $res['email'], time()+(3600*10));
			setcookie("id_users", $res['id_users'], time()+(3600*10));
			setcookie("status", $res['status'], time()+(3600*10));
			setcookie("img", $res['image'], time()+(3600*10));
			
			return true;
		}
		
		return false;
	}
	
	public function get_activity ( $where = NULL , $limit = 12 ){
		
		$this->db->order_by("date","desc");
		
		if ( $where ){
			$query = $this->db->get_where('activity', $where , $limit );
			return $query->result_array();
		}
		else{
			$query = $this->db->get('activity',$limit);
			return $query->result_array();
		}
		
	}
	
	public function getUnreadedMessages( $id_user ){
		
		$query = $this->db->get_where('message', array('id_receiver' => $id_user , 'readed' => 0 ) );
		
		return $query->num_rows();
	}
	
	public function isUser( $where ){
		
		$this->db->select("users.* , countries.name as Country");
		$this->db->from("users , countries");
		$this->db->where('countries.id_countries = users.id_countries');
		$this->db->where($where);
		$query = $this->db->get();
		
		if ( $query->num_rows() == 1 ){
			$res = $query->row_array();
			
			/*$this->db->where('id_users = '.$res['id_users']);
			$this->db->where('calification = 1');
			$query2 = $this->db->get('trade_users');
			
			
			$this->db->where('id_users = '.$res['id_users']);
			$query3 = $this->db->get('trade_users');
			
			$res['num_trades'] = $query3->num_rows();
			$res['good_trades'] = $query2->num_rows();*/
			
			return $res;
		}
		else{
			return false;
		}
	}
	
	public function isFriend( $id_users1 , $id_users2 ){
		
		$this->db->where('id_users1',$id_users1);
		$this->db->where('id_users2',$id_users2);
		$query = $this->db->get('friends');
		
		if ( $query->num_rows() == 0 ){
			$this->db->where('id_users1',$id_users2);
			$this->db->where('id_users2',$id_users1);
			$query = $this->db->get('friends');
			
			if ( $query->num_rows() == 0 ){
				$ret = NULL;
			}
			else{
				$res = $query->result_array();
				$ret['friends'] = $res[0];
				$ret['request'] = 2;
			}
		}
		else{
			$res = $query->result_array();
			$ret['friends'] = $res[0];
			$ret['request'] = 1;
		}
		
		return $ret;
	}
	
	public function getFriends( $id_users ){
		
		$this->db->select('u.*');
		$this->db->from('friends f , users u');
		$this->db->where('f.status = 1');
		$this->db->where('(f.id_users1 = '.$id_users.' AND u.id_users = f.id_users2) OR (f.id_users2 = '.$id_users.' AND u.id_users = f.id_users1)');
		$query = $this->db->get();
				
		if ( $query->num_rows() > 0 ){
			return $query->result_array();
		}
		
		return NULL;
	}
	
	public function insertUser( $name , $email , $user , $pass , $country ){
		
		$this->db->where('user',$user);
		$this->db->or_where('email',$email); 
		$query = $this->db->get('users');
		
		if ( $query->num_rows() > 0 ){
			return false;
		}
		
		$params = array(
			'name' => $name,
			'email' => $email,
			'user' => $user,
			'password' => 'Md5("'.$pass.'")',
			'id_countries' => $country,
			'status' => -1
		);
		
		return $this->db->insert('users',$params);		
	}
	
	public function activateUser ( $id ){
		
		$params = array(
               'status' => 0,
            );
		
		$this->db->where('id_users', $id);
		$this->db->update('users', $params); 
		
		
	}
	
	public function getUser($id){
			
			$this->db->where('id_users',$id);
			$query = $this->db->get('users');
			
			if ( $query->num_rows() > 0 )
				return $query->result_array();
	}
	
	public function getUserEmail($email){
			
			$this->db->where('email',$email);
			$query = $this->db->get('users');
			
			if ( $query->num_rows() > 0 )
				return $query->row_array();
	}
	
	public function edit_user( $data ){
		
		$img = $data['user_img'];
		
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$gender = $this->input->post('gender');
		$day = $this->input->post('day');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$email = $this->input->post('email');
		$country = $this->input->post('country');
		$pass1 = $this->input->post('pass1');
		$pass2 = $this->input->post('pass2');
		$id_currencies = $this->input->post('default_currency');
		$about = $this->input->post('about');
		
		$usr = $this->isUser(array('id_users'=>$id));
		
		$params = array(
			"name" => $name,
			"email" => $email,
			"id_countries" => $country,
			"gender" => $gender,
			"date_born_day" => $day,
			"date_born_month" => $month,
			"date_born_year" => $year,
			"about" => $about,
			"id_currencies" => $id_currencies
		);
		
		if ( strcmp($pass1,"") != 0 and strcmp($pass1,$pass2) == 0 ){
			$params["password"] = $pass1;
		}
		
		if ( strcmp($img,"") != 0 ){
			$params["image"] = $img;
			@session_start();
			$_SESSION['img'] = $img;
		}
		
		return $this->db->update('users',$params,array("id_users"=>$id));
	}
	
	public function compare_users( $id_user1 , $id_user2 ){
 		
		// Wish - Sell, Swap
 		$this->db->select('p.*, cou.name as Country , pc.name as Company , ps.name as Serie , p.id_phonecards_systems as System , p.name as Name, pu2.id_phonecards_users as id_phonecards_users');
		$this->db->from('phonecards_users pu1 , phonecards_users pu2 , phonecards p , countries cou , phonecards_companies pc , phonecards_series ps');
		$this->db->where('p.id_countries = cou.id_countries');
		$this->db->where('p.id_phonecards_series = ps.id_phonecards_series');
		$this->db->where('p.id_phonecards_companies = pc.id_phonecards_companies');
		$this->db->where('p.id_phonecards = pu1.id_phonecards');
		$this->db->where('pu1.id_users',$id_user1);
		$this->db->where('pu2.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 2');
		$this->db->where('(pu2.id_lists = 3 OR pu2.id_lists = 5)');
		$this->db->where('pu1.id_phonecards = pu2.id_phonecards');
		$this->db->group_by('pu1.id_phonecards');
		
		$query = $this->db->get();
		$ret['wish'] = $query->result_array();
		
		// user2 Swap
		$this->db->select('p.* , cou.name as Country , pc.name as Company , ps.name as Serie , p.id_phonecards_systems as System , p.name as Name');
		$this->db->from('phonecards_users pu1, phonecards p , countries cou , phonecards_companies pc , phonecards_series ps');
		$this->db->where('p.id_countries = cou.id_countries');
		$this->db->where('p.id_phonecards_series = ps.id_phonecards_series');
		$this->db->where('p.id_phonecards_companies = pc.id_phonecards_companies');
		$this->db->where('p.id_phonecards = pu1.id_phonecards');
		$this->db->where('pu1.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 3');
		$this->db->group_by('pu1.id_phonecards');
		
		$query = $this->db->get();
		$ret['swap'] = $query->result_array();
		
		// Buy - Sell
		$this->db->select('p.* , cou.name as Country , pc.name as Company , ps.name as Serie , p.id_phonecards_systems as System , p.name as Name');
		$this->db->from('phonecards_users pu1 , phonecards_users pu2 , phonecards p , countries cou , phonecards_companies pc , phonecards_series ps');
		$this->db->where('p.id_countries = cou.id_countries');
		$this->db->where('p.id_phonecards_series = ps.id_phonecards_series');
		$this->db->where('p.id_phonecards_companies = pc.id_phonecards_companies');
		$this->db->where('p.id_phonecards = pu1.id_phonecards');
		$this->db->where('pu1.id_users',$id_user1);
		$this->db->where('pu2.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 2');
		$this->db->where('pu2.id_lists = 5');
		$this->db->where('pu1.id_phonecards = pu2.id_phonecards');
		$this->db->group_by('pu1.id_phonecards');
		
		$query = $this->db->get();
		$ret['buy'] = $query->result_array();
		
		// Sell - Buy
		$this->db->select('p.* , cou.name as Country , pc.name as Company , ps.name as Serie , p.id_phonecards_systems as System , p.name as Name');
		$this->db->from('phonecards_users pu1 , phonecards_users pu2 , phonecards p , countries cou , phonecards_companies pc , phonecards_series ps');
		$this->db->where('p.id_countries = cou.id_countries');
		$this->db->where('p.id_phonecards_series = ps.id_phonecards_series');
		$this->db->where('p.id_phonecards_companies = pc.id_phonecards_companies');
		$this->db->where('p.id_phonecards = pu1.id_phonecards');
		$this->db->where('pu1.id_users',$id_user1);
		$this->db->where('pu2.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 5');
		$this->db->where('pu2.id_lists = 2');
		$this->db->where('pu1.id_phonecards = pu2.id_phonecards');
		$this->db->group_by('pu1.id_phonecards');
		
		$query = $this->db->get();
		$ret['sell'] = $query->result_array();
		
		return $ret;
	}
	
		public function compare_users_coins( $id_user1 , $id_user2 ){
 		
		// Wish - Sell, Swap
 		$this->db->select('c.* , coun.name as Country , ct.name as title, cv.name as value, pu2.id_coins_users as id_coins_users');
		$this->db->from('coins_users pu1 , coins_users pu2 , coins c , countries coun, coins_title ct, coins_value cv, coins_subtitle cst');
		$this->db->where('c.id_countries = coun.id_countries'); 
		$this->db->where('c.id_coins_title = ct.id_coins_title'); 
		$this->db->where('c.id_coins_value = cv.id_coins_value');
		$this->db->where('c.id_coins_subtitle = cst.id_coins_subtitle');  
		$this->db->where('c.id_coins = pu1.id_coins');
		$this->db->where('pu1.id_users',$id_user1);
		$this->db->where('pu2.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 2');
		$this->db->where('(pu2.id_lists = 3 OR pu2.id_lists = 5)');
		$this->db->where('pu1.id_coins = pu2.id_coins');
		$this->db->group_by('pu1.id_coins');
		
		$query = $this->db->get();
		$ret['wish'] = $query->result_array();
		
		// user2 Swap
 		$this->db->select('c.* , coun.name as Country , ct.name as title, cv.name as value');
		$this->db->from('coins_users pu1 , coins_users pu2 , coins c , countries coun, coins_title ct, coins_value cv, coins_subtitle cst');
		$this->db->where('c.id_countries = coun.id_countries'); 
		$this->db->where('c.id_coins_title = ct.id_coins_title'); 
		$this->db->where('c.id_coins_value = cv.id_coins_value');
		$this->db->where('c.id_coins_subtitle = cst.id_coins_subtitle');  
		$this->db->where('c.id_coins = pu1.id_coins');
		$this->db->where('pu2.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 3');
		$this->db->group_by('pu1.id_coins');
		
		$query = $this->db->get();
		$ret['swap'] = $query->result_array();
		
		// Buy - Sell
 		$this->db->select('c.*, coun.name as Country , ct.name as title, cv.name as value');
		$this->db->from('coins_users pu1 , coins_users pu2 , coins c , countries coun, coins_title ct, coins_value cv, coins_subtitle cst');
		$this->db->where('c.id_countries = coun.id_countries'); 
		$this->db->where('c.id_coins_title = ct.id_coins_title'); 
		$this->db->where('c.id_coins_value = cv.id_coins_value');
		$this->db->where('c.id_coins_subtitle = cst.id_coins_subtitle');  
		$this->db->where('c.id_coins = pu1.id_coins');
		$this->db->where('pu1.id_users',$id_user1);
		$this->db->where('pu2.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 2');
		$this->db->where('pu2.id_lists = 5');
		$this->db->where('pu1.id_coins = pu2.id_coins');
		$this->db->group_by('pu1.id_coins');
		
		$query = $this->db->get();
		$ret['buy'] = $query->result_array();
		
		// Sell - Buy
 		$this->db->select('c.*, coun.name as Country , ct.name as title, cv.name as value');
		$this->db->from('coins_users pu1 , coins_users pu2 , coins c , countries coun, coins_title ct, coins_value cv, coins_subtitle cst');
		$this->db->where('c.id_countries = coun.id_countries'); 
		$this->db->where('c.id_coins_title = ct.id_coins_title'); 
		$this->db->where('c.id_coins_value = cv.id_coins_value');
		$this->db->where('c.id_coins_subtitle = cst.id_coins_subtitle');  
		$this->db->where('c.id_coins = pu1.id_coins');
		$this->db->where('pu1.id_users',$id_user1);
		$this->db->where('pu2.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 5');
		$this->db->where('pu2.id_lists = 2');
		$this->db->where('pu1.id_coins = pu2.id_coins');
		$this->db->group_by('pu1.id_coins');
		
		$query = $this->db->get();
		$ret['sell'] = $query->result_array();
		
		return $ret;
	}

		public function compare_users_banknotes( $id_user1 , $id_user2 ){
 		
		// Wish - Sell, Swap
 		$this->db->select('b.* , coun.name as Country , bt.name as title, bv.name as value, pu2.id_banknotes_users as id_banknotes_users');
		$this->db->from('banknotes_users pu1 , banknotes_users pu2 , banknotes b , countries coun, banknotes_title bt, banknotes_value bv, banknotes_subtitle bst');
		$this->db->where('b.id_countries = coun.id_countries'); 
		$this->db->where('b.id_banknotes_title = bt.id_banknotes_title'); 
		$this->db->where('b.id_banknotes_value = bv.id_banknotes_value');
		$this->db->where('b.id_banknotes_subtitle = bst.id_banknotes_subtitle');  
		$this->db->where('b.id_banknotes = pu1.id_banknotes');
		$this->db->where('pu1.id_users',$id_user1);
		$this->db->where('pu2.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 2');
		$this->db->where('(pu2.id_lists = 3 OR pu2.id_lists = 5)');
		$this->db->where('pu1.id_banknotes = pu2.id_banknotes');
		$this->db->group_by('pu1.id_banknotes');
		
		$query = $this->db->get();
		$ret['wish'] = $query->result_array();
		
		// user2 Swap
 		$this->db->select('b.* , coun.name as Country , bt.name as title, bv.name as value');
		$this->db->from('banknotes_users pu1 , banknotes_users pu2 , banknotes b , countries coun, banknotes_title bt, banknotes_value bv, banknotes_subtitle bst');
		$this->db->where('b.id_countries = coun.id_countries'); 
		$this->db->where('b.id_banknotes_title = bt.id_banknotes_title'); 
		$this->db->where('b.id_banknotes_value = bv.id_banknotes_value');
		$this->db->where('b.id_banknotes_subtitle = bst.id_banknotes_subtitle');  
		$this->db->where('b.id_banknotes = pu1.id_banknotes');
		$this->db->where('pu2.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 3');
		$this->db->group_by('pu1.id_banknotes');
		
		$query = $this->db->get();
		$ret['swap'] = $query->result_array();
		
		// Buy - Sell
 		$this->db->select('b.*, coun.name as Country , bt.name as title, bv.name as value');
		$this->db->from('banknotes_users pu1 , banknotes_users pu2 , banknotes b , countries coun, banknotes_title bt, banknotes_value bv, banknotes_subtitle bst');
		$this->db->where('b.id_countries = coun.id_countries'); 
		$this->db->where('b.id_banknotes_title = bt.id_banknotes_title'); 
		$this->db->where('b.id_banknotes_value = bv.id_banknotes_value');
		$this->db->where('b.id_banknotes_subtitle = bst.id_banknotes_subtitle');  
		$this->db->where('b.id_banknotes = pu1.id_banknotes');
		$this->db->where('pu1.id_users',$id_user1);
		$this->db->where('pu2.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 2');
		$this->db->where('pu2.id_lists = 5');
		$this->db->where('pu1.id_banknotes = pu2.id_banknotes');
		$this->db->group_by('pu1.id_banknotes');
		
		$query = $this->db->get();
		$ret['buy'] = $query->result_array();
		
		// Sell - Buy
 		$this->db->select('b.*, coun.name as Country , bt.name as title, bv.name as value');
		$this->db->from('banknotes_users pu1 , banknotes_users pu2 , banknotes b , countries coun, banknotes_title bt, banknotes_value bv, banknotes_subtitle bst');
		$this->db->where('b.id_countries = coun.id_countries'); 
		$this->db->where('b.id_banknotes_title = bt.id_banknotes_title'); 
		$this->db->where('b.id_banknotes_value = bv.id_banknotes_value');
		$this->db->where('b.id_banknotes_subtitle = bst.id_banknotes_subtitle');  
		$this->db->where('b.id_banknotes = pu1.id_banknotes');
		$this->db->where('pu1.id_users',$id_user1);
		$this->db->where('pu2.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 5');
		$this->db->where('pu2.id_lists = 2');
		$this->db->where('pu1.id_banknotes = pu2.id_banknotes');
		$this->db->group_by('pu1.id_banknotes');
		
		$query = $this->db->get();
		$ret['sell'] = $query->result_array();
		
		return $ret;
	}

			public function compare_users_stamps( $id_user1 , $id_user2 ){
 		
		// Wish - Sell, Swap
 		$this->db->select('c.* , coun.name as Country , ct.name as title, cv.name as value, pu2.id_coins_users as id_coins_users');
		$this->db->from('coins_users pu1 , coins_users pu2 , coins c , countries coun, coins_title ct, coins_value cv, coins_subtitle cst');
		$this->db->where('c.id_countries = coun.id_countries'); 
		$this->db->where('c.id_coins_title = ct.id_coins_title'); 
		$this->db->where('c.id_coins_value = cv.id_coins_value');
		$this->db->where('c.id_coins_subtitle = cst.id_coins_subtitle');  
		$this->db->where('c.id_coins = pu1.id_coins');
		$this->db->where('pu1.id_users',$id_user1);
		$this->db->where('pu2.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 2');
		$this->db->where('(pu2.id_lists = 3 OR pu2.id_lists = 5)');
		$this->db->where('pu1.id_coins = pu2.id_coins');
		$this->db->group_by('pu1.id_coins');
		
		$query = $this->db->get();
		$ret['wish'] = $query->result_array();
		
		// user2 Swap
 		$this->db->select('c.* , coun.name as Country , ct.name as title, cv.name as value');
		$this->db->from('coins_users pu1 , coins_users pu2 , coins c , countries coun, coins_title ct, coins_value cv, coins_subtitle cst');
		$this->db->where('c.id_countries = coun.id_countries'); 
		$this->db->where('c.id_coins_title = ct.id_coins_title'); 
		$this->db->where('c.id_coins_value = cv.id_coins_value');
		$this->db->where('c.id_coins_subtitle = cst.id_coins_subtitle');  
		$this->db->where('c.id_coins = pu1.id_coins');
		$this->db->where('pu2.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 3');
		$this->db->group_by('pu1.id_coins');
		
		$query = $this->db->get();
		$ret['swap'] = $query->result_array();
		
		// Buy - Sell
 		$this->db->select('c.*, coun.name as Country , ct.name as title, cv.name as value');
		$this->db->from('coins_users pu1 , coins_users pu2 , coins c , countries coun, coins_title ct, coins_value cv, coins_subtitle cst');
		$this->db->where('c.id_countries = coun.id_countries'); 
		$this->db->where('c.id_coins_title = ct.id_coins_title'); 
		$this->db->where('c.id_coins_value = cv.id_coins_value');
		$this->db->where('c.id_coins_subtitle = cst.id_coins_subtitle');  
		$this->db->where('c.id_coins = pu1.id_coins');
		$this->db->where('pu1.id_users',$id_user1);
		$this->db->where('pu2.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 4');
		$this->db->where('pu2.id_lists = 5');
		$this->db->where('pu1.id_coins = pu2.id_coins');
		$this->db->group_by('pu1.id_coins');
		
		$query = $this->db->get();
		$ret['buy'] = $query->result_array();
		
		// Sell - Buy
 		$this->db->select('c.*, coun.name as Country , ct.name as title, cv.name as value');
		$this->db->from('coins_users pu1 , coins_users pu2 , coins c , countries coun, coins_title ct, coins_value cv, coins_subtitle cst');
		$this->db->where('c.id_countries = coun.id_countries'); 
		$this->db->where('c.id_coins_title = ct.id_coins_title'); 
		$this->db->where('c.id_coins_value = cv.id_coins_value');
		$this->db->where('c.id_coins_subtitle = cst.id_coins_subtitle');  
		$this->db->where('c.id_coins = pu1.id_coins');
		$this->db->where('pu1.id_users',$id_user1);
		$this->db->where('pu2.id_users',$id_user2);
		$this->db->where('pu1.id_lists = 5');
		$this->db->where('pu2.id_lists = 4');
		$this->db->where('pu1.id_coins = pu2.id_coins');
		$this->db->group_by('pu1.id_coins');
		
		$query = $this->db->get();
		$ret['sell'] = $query->result_array();
		
		return $ret;
	}

	public function getNotifications(){
		
		@session_start();
		
		if ( isset($_SESSION['id_users']) ){
			
			$this->db->where('id_users',$_SESSION['id_users']);
			$this->db->where('status',0);
			$query = $this->db->get('notifications');
			
			if ( $query->num_rows() > 0 )
				return $query->result_array();
		}
		
		return NULL;
	}
	
	public function sendFeedback( $user , $feedback , $file, $email, $feel, $about){
		
		$params = array(
			'user' => $user,
			'email' => $email,
			'comment' => $feedback,
			'feel' => $feel,
			'about' => $about,
			'date' => time(),
			'file' => $file
		);
		
		$this->db->insert('feedback',$params);
	}
	
	public function search( $words ){
	
		if ( isset($_SESSION['id_users']) ){
			$logged = $this->isUser(array( 'id_users' => $_SESSION['id_users'] ));
		}
		
		$this->db->select('u.name , u.user , u.image , c.name as country');
		$this->db->from('users u , countries c');
		$this->db->where('c.id_countries = u.id_countries');
		$this->db->where('u.status <> 2');
		
		for ( $i = 0 ; $i < count($words) ; $i++ ){
			
			$array = array(
				'u.name',
				'u.user'
			);
			
			$wlike = "";
			
			for ( $j = 0 ; $j < count($array) ; $j++ ){
				$wlike = $wlike.$array[$j].' like "%'.$words[$i].'%" OR ';
			}
			
			$wlike = substr($wlike,0,strlen($wlike)-3);
			
			$this->db->where('( '.$wlike.' )');
		}
		
		$query = $this->db->get();
		
		$result['search'] = $query->result_array();
		
		$ids = "";
		
		for ( $i = 0 ; $i < count($result['search']) ; $i++ ){
			$ids = $ids.'u.user <> "'.$result['search'][$i]['user'].'" AND ';
		}
		
		$ids = substr($ids,0,strlen($ids)-4);
		
		// Search recomendation
		
		if ( isset($logged) ){
			
			$this->db->select('u.name , u.user , u.image , c.name as country');
			$this->db->from('users u , countries c');
			$this->db->where('c.id_countries = u.id_countries');
			$this->db->where('c.id_countries',$logged['id_countries']);
			$this->db->where('u.status <> 2');
			$this->db->order_by('rand()');
			
			
			if ( $ids )
				$this->db->where($ids);
				
			$this->db->limit(6);
			
			$query = $this->db->get();
			$result['recomended'] = $query->result_array();
			//$this->db->last_query()
		}
		else{
			$result['recomended'] = NULL;
		}
		
		return $result;
	}
	
	public function change_password($id_user, $pass){
		
		$params = array(
			"password" => $pass 
		); 
		
		return $this->db->update('users',$params,array("id_users"=>$id_user));
		
	}
	public function profile_glass($id_user1,$id_user2 ){
		
		
		$params = array(
			'id_users1' => $id_user1,
			'id_users2' => $id_user2,
			'date' => time(),
		);
		
		$this->db->insert('profile_glass',$params);
		return;
		
	}

	public function get_profile_glass($where){

		$this->db->select('u2.name , u2.user as user , u2.image as image , c.name as country, u.gender as gender, date');
		$this->db->from('users u, users u2 , countries c, profile_glass p');
		$this->db->where('u2.id_countries = c.id_countries');
		$this->db->where('p.id_users1 = u.id_users');
		$this->db->where('p.id_users2 = u2.id_users');
		$this->db->where($where);
		
		$query = $this->db->get();	

		$nums = $this->db->query('SELECT FOUND_ROWS() AS `Count`');

		$num = $nums->row()->Count;

		

		$result['num'] = $num;

		$result['users'] = $query->result_array();

		return $result;

	}
	
	public function insert_list(){
		
		
	}
	
}

?>