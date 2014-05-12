<?php
class Collecworld_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function createEvent ( $name , $country , $place , $date , $category , $description , $invited , $private ){
		
		@session_start();
		
		if ( strlen($name) > 0 && strlen($place) > 0 && strlen($date) > 0 && strlen($description) > 0 && isset($_SESSION['id_users'])
			&& $country != -1 && $category != -1 ){
			
			$timestamp = strtotime($date);
			
			$params = array(
				"name" => $name,
				"id_countries" => $country,
				"place" => $place,
				"date" => $timestamp,
				"id_categories" => $category,
				"description" => $description,
				"id_users" => $_SESSION['id_users']
			);
			
			if ( $private ){
				$params["private"] = 1;
			}
			
			$query = $this->db->get_where('events',$params);
			
			if ( $query->num_rows() == 0 ){
				$this->db->insert('events',$params);
				
				$query = $this->db->get_where('events',$params);
				$id_new = $query->result_array();
				$id_new = $id_new[0]['id_events'];
				
				if ( !$private ){
					$activity_params = array(
						"id_categories" => -1,
						"id_item" => $id_new,
						"id_users" => $_SESSION['id_users'],
						"contribution" => -1,
						"date" => time()
					);
					
					$this->db->insert('activity',$activity_params);
				}
				
				
				// Invitaciones
				if ( $invited ){
					for ( $i = 0 ; $i < count($invited) ; $i++ ){
						
						$invited_params = array(
							"id_events" => $id_new,
							"id_users" => $invited[$i],
							"status" => 0
						);
						
						$this->db->insert('event_invitation',$invited_params);
						
						$notif_params = array(
							"description" => $name,
							"status" => 0,
							"date" => time(),
							"id_users" => $invited[$i],
							"type" => 3,
							"id_users2" => $_SESSION['id_users'],
							"info" => $id_new
						);
						
						$this->db->insert('notifications',$notif_params);
					}
				}
				
				return $id_new;
			}
		}
		
		return false;
	}
	
	public function editEvent( $id , $name , $country , $place , $date , $category , $description , $private ){
		
		@session_start();
		if ( strlen($name) > 0 && strlen($place) > 0 && strlen($date) > 0 && strlen($description) > 0
		 	&& isset($_SESSION['id_users']) && $id != NULL && $country != -1 && $category != -1 ){
			
			$timestamp = strtotime($date);
			
			$params = array(
				"name" => $name,
				"id_countries" => $country,
				"place" => $place,
				"date" => $timestamp,
				"id_categories" => $category,
				"description" => $description
			);
			
			if ( $private ){
				$params['private'] = 1;
			}
			else{
				$params['private'] = 0;
			}
			
			$this->db->update('events',$params,array( "id_events" => $id ));
			return true;
		}
		
		return false;
	}
	
	public function event_invite( $id_event , $friends ){
		
		@session_start();
		if ( !isset($_SESSION['id_users']) )
			return false;
		
		$query = $this->db->get_where('events',array( "id_events" => $id_event ));
		$event = $query->result_array();
		$event = $event[0];
		
		if ( $event['private'] == 0 ){
			
			for ( $i = 0 ; $i < count($friends) ; $i++ ){
				
				$verif = $this->db->get_where('event_invitation',array( "id_users" => $friends[$i] , "id_events" => $id_event ));
				
				if ( $verif->num_rows() == 0 ){
					$params = array(
						"id_events" => $id_event,
						"id_users" => $friends[$i],
						"status" => 0
					);
					
					$this->db->insert('event_invitation',$params);
					
					$notif_params = array(
						"description" => $event['name'],
						"status" => 0,
						"date" => time(),
						"id_users" => $friends[$i],
						"type" => 3,
						"id_users2" => $_SESSION['id_users'],
						"info" => $event['id_events']
					);
					
					$this->db->insert('notifications',$notif_params);
					
				}
			}
			
			return true;			
		}
		
		return false;		
	}
	
	public function getEventInvited( $id_event ){
		
		$this->db->select('u.*');
		$this->db->from('users u , event_invitation e');
		$this->db->where('u.id_users = e.id_users');
		$this->db->where('e.status = 0');
		$this->db->where('e.id_events',$id_event);
		$query = $this->db->get();
		
		return $query->result_array();		
	}
	
	public function EmailEventSend( $id_event ){
		
		$data = array(
			'status' => 1
		);
		$this->db->where('status = 0');
		$this->db->where('id_events',$id_event);
		$this->db->update('event_invitation', $data);
		
		return "ok";		
	}
	
	public function getEvent( $id ){
		
		$this->db->select('e.* , u.name as uname , u.user as uuser , u.image , c.name as country , cou.name as event_country , cat.name as category');
		$this->db->from('events e , users u , countries c , countries cou , categories cat');
		$this->db->where('c.id_countries = u.id_countries');
		$this->db->where('cou.id_countries = e.id_countries');
		$this->db->where('cat.id_categories = e.id_categories');
		$this->db->where('e.id_users = u.id_users');
		$this->db->where(array( "id_events" => $id ));
		$query = $this->db->get();
		
		if ( $query->num_rows() > 0 ){
			$ret = $query->result_array();
			return $ret[0];
		}
		
		return NULL;
	}
	
	public function getEvents( $where = NULL ){
		
		$this->db->select('e.* , u.name as uname , u.user as uuser , u.image , c.name as country , cou.name as event_country , cat.name as category');
		$this->db->from('events e , users u , countries c , countries cou , categories cat');
		$this->db->where('c.id_countries = u.id_countries');
		$this->db->where('cou.id_countries = e.id_countries');
		$this->db->where('cat.id_categories = e.id_categories');
		$this->db->where('e.id_users = u.id_users');
		$this->db->where('e.private = 0');
		$this->db->order_by('e.date ASC , e.id_countries');
		
		if ( $where ){
			$this->db->where($where);
		}
		$query = $this->db->get();
		
		if ( $query->num_rows() > 0 ){
			$ret = $query->result_array();
			
			$ret2 = array( 1=>array(), 2=>array(), 3=>array(), 4=>array() );
			
			for ( $i = 0 ; $i < count($ret) ; $i++ ){
				$itm = $ret[$i];
				
				$ret2[intval($itm['id_categories'])][] = $itm;
			}
			
			return $ret2;
		}
		
		return NULL;
	}
	
	public function getEventComments( $event_id ){
		
		$this->db->select('e.comment , e.date , u.*');
		$this->db->from('event_comments e , users u');
		$this->db->where('e.id_users = u.id_users');
		$this->db->where('id_events',$event_id);
		$this->db->order_by('e.date DESC');
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function getCollectiblesCount(){
		
		$query = $this->db->get('phonecards');
		
		return $query->num_rows();
	}
	
	public function getUnasweredFeedbacks(){
		
		$this->db->where('status',0);
		$query = $this->db->get('feedback');
		
		return $query->result_array();
	}
	
	public function answerFeedback( $user , $answer , $fb_id ){
		
		$this->db->where('user',$user);
		$query = $this->db->get('users');
		$res = $query->result_array();
		$u = $res[0];
		
		$params = array(
			'id_sender' => 1,
			'id_receiver' => $u['id_users'],
			'message' => $answer,
			'date' => time(),
			'readed' => 0
		);
		
		$this->db->insert('message',$params);
		$this->db->insert('notifications',array(
			'id_users2' => 1,
			'id_users' => $u['id_users'],
			'status' => 0,
			'date' => time(),
			'type' => 2,
			'description' => $answer
		));
		$this->db->update('feedback',array("status"=>1),array("id"=>$fb_id));	
	}
	
}

?>