<?php

// CHIP

if ( $num == 0 || $num == 2 ){

	

	switch( $id ){
		case 1:
			$info = $this->lang->line('info_gem_1');
			break;
		case 2:
			$info = $this->lang->line('info_gem_1_a');
			break;			
		case 3:
			$info = $this->lang->line('info_gem_1_b');
			break;
		case 4:
			$info = $this->lang->line('info_gem_2');
			break;
		case 5:
			$info = $this->lang->line('info_gem_2_a');
			break;
		case 6:
			$info = $this->lang->line('info_gem_2_b');
			break;
		case 7:
			$info = $this->lang->line('info_gem_3');
			break;
		case 8:
			$info = $this->lang->line('info_gem_3_a');
			break;		
		case 9:
			$info = $this->lang->line('info_gem_3_b');
			break;		
		case 10:
			$info = $this->lang->line('info_gd_1');
			break;		
		case 11:
			$info = $this->lang->line('info_gd_1_a');
			break;	
		case 12:
			$info = $this->lang->line('info_gpt_1');
			break;		
		case 13:
			$info = $this->lang->line('info_inc_1');
			break;			
		case 14:
			$info = $this->lang->line('info_inc_1_a');
			break;			
		case 15:
			$info = $this->lang->line('info_inc_2');
			break;			
		case 16:
			$info = $this->lang->line('info_inc_2_a');
			break;			
		case 25:
			$info = $this->lang->line('info_inc_2_b');
			break;				
		case 17:
			$info = $this->lang->line('info_inc_3');
			break;			
		case 18:
			$info = $this->lang->line('info_inc_4');
			break;			
		case 29:
			$info = $this->lang->line('info_obe_1');
			break;			
		case 19:
			$info = $this->lang->line('info_obe_1_a');
			break;			
		case 20:
			$info = $this->lang->line('info_sol_1');
			break;				
		case 21:
			$info = $this->lang->line('info_sol_1_a');
			break;			
		case 30:
			$info = $this->lang->line('info_sol_1_b');
			break;			
		case 22:
			$info = $this->lang->line('info_sol_2');
			break;			
		case 23:
			$info = $this->lang->line('info_sol_2_b');
			break;		
		case 65:
			$info = $this->lang->line('info_sol_3');
			break;				
		case 64:
			$info = $this->lang->line('info_sol_4');
			break;				
		case 26:
			$info = $this->lang->line('info_sol_5');
			break;		
		case 27:
			$info = $this->lang->line('info_sol_6');
			break;				
		case 24:
			$info = $this->lang->line('info_sol_7');
			break;			
		case 37:
			$info = $this->lang->line('info_sch_1');
			break;			
		case 38:
			$info = $this->lang->line('info_sch_1_a');
			break;			
		case 39:
			$info = $this->lang->line('info_sch_1_b');
			break;			
		case 40:
			$info = $this->lang->line('info_sch_1_c');
			break;			
		case 41:
			$info = $this->lang->line('info_sch_2');
			break;			
		case 42:
			$info = $this->lang->line('info_sch_2_a');
			break;			
		case 45:
			$info = $this->lang->line('info_sch_2_b');
			break;			
		case 46:
			$info = $this->lang->line('info_sch_2_c');
			break;			
		case 47:
			$info = $this->lang->line('info_sch_2_d');
			break;			
		case 48:
			$info = $this->lang->line('info_sch_2_e');
			break;			
		case 53:
			$info = $this->lang->line('info_sch_3');
			break;			
		case 55:
			$info = $this->lang->line('info_sch_3_a');
			break;			
		case 56:
			$info = $this->lang->line('info_sch_3_b');
			break;			
		case 57:
			$info = $this->lang->line('info_sch_3_c');
			break;			
		case 58:
			$info = $this->lang->line('info_sch_4');
			break;			
		case 59:
			$info = $this->lang->line('info_sch_4_a');
			break;				
		case 28:
			$info = $this->lang->line('info_sch_5');
			break;			
		case 60:
			$info = $this->lang->line('info_sch_5_a');
			break;		
		case 31:
			$info = $this->lang->line('info_bul_1');
			break;			
		case 32:
			$info = $this->lang->line('info_bul_1_a');
			break;

	}
}

// LOGO

else{

	switch( $id ){
		case 1:
			$info = $this->lang->line('info_inn_1');
			break;
		case 2:
			$info = $this->lang->line('info_inn_2');
			break;
		case 3:
			$info = $this->lang->line('info_inn_3');
			break;
		case 4:
			$info = $this->lang->line('info_inn_4');
			break;
		case 5:
			$info = $this->lang->line('info_inn_5');
			break;
		case 6:
			$info = $this->lang->line('info_gd_1');
			break;
		case 7:
			$info = $this->lang->line('info_gpt_1');
			break;
		case 8:
			$info = $this->lang->line('info_logo_sol_1');
			break;
		case 9:
			$info = $this->lang->line('info_logo_sol_2');
			break;
	}

}

?>

<table id="table_info_chip_logo">
	<tr>
    	<td>
        	<img src="<?php echo $src; ?>" width="150" height="150" />
        </td>
        <td valign="top">
        	<?php echo $info; ?>
        </td>
    </tr>
</table>