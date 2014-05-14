<?php

class Collecworld extends CW_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	public function loadTranslation(){
		
		$translations = $this->input->post('trans');
		$tArray = explode('$',$translations);
		
		$ret = array();
		
		for ( $i = 0 ; $i < count($tArray) ; $i++ ){
			$ret[$tArray[$i]] = $this->lang->line($tArray[$i]);
		}
		
		echo json_encode($ret);		
	}

}