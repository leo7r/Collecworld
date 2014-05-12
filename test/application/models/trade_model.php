<?php
class Trade_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function new_buy ( $category , $id_user , $trade_user , $selected_items ){
		
		if ( $category && $id_user && $trade_user && $selected_items ){
			
			$params = array( 
				'type' => 1 ,
				'id_categories' => $category ,
				'date' => time() ,
				'id_users' => $id_user ,
				'id_trade_users' => $trade_user ,
				'status' => 0
			);
					
			$this->db->insert('trade',$params);
			
			$query = $this->db->get_where('trade', $params );
		
			if ( $query->num_rows() > 0 ){
			
				$res = $query->result_array();
				$res = $res[0];
				
				$id_trade = $res['id_trade'];
				
				$selected_items_array = explode(',',$selected_items);
				
				$params2 = array( 
					'id_trade' => $id_trade ,
					'status' => 0
				);
				
				for ( $i = 0 ; $i < count($selected_items_array) ; $i++ ){
					
					$params2['id_item'] = (int) $selected_items_array[$i];
					$this->db->insert('trade_items',$params2);
				}
				
				$notif_params = array(
					"description" => '',
					"status" => 0,
					"date" => time(),
					"id_users" => $trade_user,
					"type" => 4,
					"id_users2" => $id_user,
					"info" => $id_trade
				);
				
				$this->db->insert('notifications',$notif_params);
				
				return $id_trade;				
			}
			else{
				echo 'error inserting trade';
				return FALSE;
			}
		}
		
	}
	
	public function new_exchange ( $category , $id_user , $trade_user , $selected_items , $selected_items1 ){
		
		if ( $category && $id_user && $trade_user && $selected_items && $selected_items1 ){
			
			$params = array( 
				'type' => 2 ,
				'id_categories' => $category ,
				'date' => time() ,
				'id_users' => $id_user ,
				'id_trade_users' => $trade_user ,
				'status' => 0
			);
					
			$this->db->insert('trade',$params);
			
			$query = $this->db->get_where('trade', $params );
		
			if ( $query->num_rows() > 0 ){
			
				$res = $query->result_array();
				$res = $res[0];
				
				$id_trade = $res['id_trade'];
				
				$selected_items_array = explode(',',$selected_items);
				$selected_items_array1 = explode(',',$selected_items1);
				
				$params2 = array( 
					'id_trade' => $id_trade ,
					'status' => 0
				);
				
				for ( $i = 0 ; $i < count($selected_items_array) ; $i++ ){
					
					$params2['id_item'] = (int) $selected_items_array[$i];
					$this->db->insert('trade_items',$params2);
				}
				
				for ( $i = 0 ; $i < count($selected_items_array1) ; $i++ ){
					
					$params2['id_item'] = (int) $selected_items_array1[$i];
					$params2['exchange_item'] = 1;
					$this->db->insert('trade_items',$params2);
				}
				
				$notif_params = array(
					"description" => '',
					"status" => 0,
					"date" => time(),
					"id_users" => $trade_user,
					"type" => 5,
					"id_users2" => $id_user,
					"info" => $id_trade
				);
				
				$this->db->insert('notifications',$notif_params);
				
				return $id_trade;			
			}
			else{
				echo 'error inserting trade';
				return FALSE;
			}
		}
		
	}
	
	public function getTrade( $id_trade ){
		
		if ( $id_trade ){
			
			$params = array( 
				'id_trade' => $id_trade
			);
			
			$query = $this->db->get_where('trade', $params );
			$res = $query->result_array();
			$res = $res[0];
			
			return $res;
		}
		
		return NULL;
	}
	
	public function getTradeItems( $id_trade ){
		
		$trade = $this->getTrade( $id_trade );
		
		if ( $id_trade ){
			
			$this->db->where('ti.id_trade',$id_trade);
			
			if ( $trade['id_categories'] == 1 ){
				$this->db->select('ti.* , p.name , p.id_phonecards , c.name as country , pc.name as company , pu.id_phonecards_users');
				$this->db->from('trade_items ti , phonecards p , phonecards_companies pc, countries c, phonecards_users pu');
				$this->db->where('pu.id_phonecards_users = ti.id_item');
				$this->db->where('pu.id_phonecards = p.id_phonecards');
				$this->db->where('p.id_phonecards_companies = pc.id_phonecards_companies');
				$this->db->where('p.id_countries = c.id_countries');
			}
			
			if ( $trade['type'] == 1 ){
			
				$query = $this->db->get();
				$res = array( 'items0' => $query->result_array() );
			}
			else{
				$this->db->where('ti.exchange_item',1);
				$query0 = $this->db->get();
				
				if ( $trade['id_categories'] == 1 ){
					$this->db->select('ti.* , p.name , p.id_phonecards , c.name as country , pc.name as company , pu.id_phonecards_users');
					$this->db->from('trade_items ti , phonecards p , phonecards_companies pc, countries c , phonecards_users pu');
					$this->db->where('ti.id_trade',$id_trade);
					$this->db->where('pu.id_phonecards_users = ti.id_item');
					$this->db->where('pu.id_phonecards = p.id_phonecards');
					$this->db->where('p.id_phonecards_companies = pc.id_phonecards_companies');
					$this->db->where('p.id_countries = c.id_countries');
				}
				
				$this->db->where('ti.exchange_item',0);
				$query1 = $this->db->get();
				
				$res = array( 'items0' => $query0->result_array() , 'items1' => $query1->result_array() );
			}			
		}
		
		
		return $res;
	}
	
	public function not_rated( $id_trade , $id_users ){
		
		$result = $this->db->get_where( 'trade_users' , array( 'id_trade' => $id_trade , 'id_users' => $id_users ) );
		
		if ( $result->num_rows() > 0 ){
			return false;
		}
		
		return true;
	}
	
	public function get_rates( $id_trade ){
		
		$this->db->select('u.* , tu.calification');
		$this->db->from('users u , trade_users tu');
		$this->db->where('u.id_users = tu.id_users');
		$this->db->where('tu.id_trade = '.$id_trade);
					
		$result = $this->db->get();
		$array = $result->result_array();
		
		if ( $result->num_rows() == 1 ){
			
			return array( $array[0] );
		}
		elseif( $result->num_rows() == 2 ){
		
			return array( $array[0] , $array[1] );
		}
		else{
			return false;
		}
	}
	
}

?>