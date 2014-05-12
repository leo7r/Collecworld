<?php

class Export extends CW_Controller {

	public function __construct(){
		
		parent::__construct();	
	}

	public function view($type, $user, $list, $country, $company, $catalog, $system, $variation ,$missed){
		 
		$data['collectibles_count'] = $this->getCollectiblesCount();
		$data['type'] = $type;
		$data['user'] = $user;
		$data['id_list'] = $list;
		$data['country'] = $country;
		$data['company'] = $company;
		$data['catalog'] = $catalog;
		$data['system'] = $system;
		$data['variation'] = $variation;
		
		$this->load->model('user_model');
		$data['user_info'] = $this->user_model->isUser(array ("id_users"=>$user));
		
		$this->load->model('phonecard_model');
		$data['list'] = $this->phonecard_model->get_lists(array ("id_lists"=>$list));
		
		$data['country_info'] = $this->phonecard_model->get_countries(array ( "id_countries"=>$country) );
		$data['country_info'] = $data['country_info'][0];
		
		$data['company_info'] = $this->phonecard_model->get_phonecards_companies(array ( "id_phonecards_companies"=>$company) );
		$data['company_info'] = $data['company_info'][0];
		
		if($missed == 0){
			if(strcmp ($type,'pdf')==0){
				
			$this->load->view('templates/export/pdf',$data);
			
			}else if(strcmp ($type,'excel')==0){
			
			$this->load->view('templates/export/excel',$data);
			
			}
		}else{
			if(strcmp ($type,'pdf')==0){
				
			$this->load->view('templates/export/pdf_missed',$data);
			
			}else if(strcmp ($type,'excel')==0){
			
			$this->load->view('templates/export/excel_missed',$data);
			
			}
			
		}
	}
	
	
}