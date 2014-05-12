<?php
function trimm( $str , $num ){
	if ( strlen($str) > $num ){
		$ret = substr($str,0,$num);
		$ret = $ret.'...';
		return $ret;
	}
	
	return $str;
}
?>
<table id="user-info-table" cellpadding="5">
	<tr>
		<td><?php echo $user['name']; ?></td>
	</tr>
	<tr>
		<td><img id="user-flag" src="<?php echo base_url(); ?>img/flag-1.png"/><?php echo $user['Country']; ?></td>
	</tr>
	<tr>
		<td><?php echo $this->lang->line('miembro_desde').$this->lang->line(date('l',$user['registration_date'])).", ".date('d',$user['registration_date']).$this->lang->line(date('F',$user['registration_date'])).date('Y',$user['registration_date']);?></td>
	</tr>
	<tr>
		<td style="border-bottom:none; font-size:18px;">
			<?php
				$bio = $user['about'];
				echo trimm($bio,120);
			?>
		</td>
	</tr>
</table><!-- .date('l, d F Y',$user['registration_date']);  -->