<!--To Start-->

<script type="text/javascript">
	
	$(document).ready(function(){

		$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });
		$('#modal-close').click(function(){
			$("#lean_overlay").click();
		});
	});
	
	function modalPhonecard( _p ){
	
		$("#modal-phonecard").load(path+'ajax/showPhonecard.php',{p:_p,backs:'../'},function(){
			$("#modalP").click();
		});
	}
	
	function modalNote( id_list , id_pc , list , id_countries , catalog , id_companies ){
	
		$("#modal-note").load(path+'ajax/modalNote.php',
			{id_list:id_list,id:id_pc,list:list,id_countries:id_countries,catalog:catalog,id_companies:id_companies},function(){
			$("#modalNote").click();
		});
	}
	
	function toggle_loader(extension){
				
		if ( $("#export_loader").css('display') == 'table-cell' ){
			$("#export_loader").css({display:'none'});	
		}
		else{
			$("#export_loader").css({display:'inherit'});	
		}
		var pathname = window.location.pathname;
		var pathname1= pathname.replace("collection",extension);
		var pathname1= pathname1.replace("/collecworld/","");
		window.location=path+pathname1;
		setTimeout(function() {
		$("#export_loader").css({display:'none'});	
	}, 1000);
	}
	
</script>

<?php

switch ( $c_system ){
	case 1:
		$system_name = $this->lang->line('chip');
		break;
	case 2:
		$system_name = $this->lang->line('banda_magnetica');
		break;
	case 3:
		$system_name = $this->lang->line('sistema_optico');
		break;
	case 4:
		$system_name = $this->lang->line('memoria_remota');
		break;
	case 5:
		$system_name = $this->lang->line('sistema_inducido');
		break;	
}

switch ( $c_catalog ){
	
	case 1:
		$catalog = $this->lang->line('tarjetas_fecha');
		break;
	case 2:
		$catalog = $this->lang->line('tarjetas_sin_fecha');
		break;
	case 3:
		$catalog = $this->lang->line('tarjetas_uso_interno');
		break;
}

?>

<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>
<div id="modal-phonecard"></div>
<a id="modalNote" style="display:none;" rel="leanModal" href="#modal-note">a</a>
<div id="modal-note"></div>

<div id="content">

	<div id="toolbar">

		<div class="in">

			<div id="toolbar-left">

				<div class="item location">

					<?php
						
						$item_title = $this->lang->line('profile_mis_colecciones_tarjetas');
						
						switch ( $c_list ){
							
							case 1:
								$item_title2=$this->lang->line('coleccion'); 
								break;
							case 2:
								$item_title2=$this->lang->line('deseo'); 
								break;
							case 3:
								$item_title2=$this->lang->line('intercambio'); 
								break;
							case 4:
								$item_title2=$this->lang->line('venta'); 
								break;
							default:
								$item_title2='Lista personalizada';
								break;
								
						}
					?>

					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href="<?php echo base_url(); ?>index.php/<?php echo $c_user; ?>"><?php echo $c_user; ?></a>&nbsp;&raquo;&nbsp;<a href="<?php echo base_url(); ?>index.php/<?php echo $c_user; ?>#sec=1"><?php echo $item_title; ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $item_title2; ?></a>&nbsp;&raquo;

				</div>

			</div>

			

			<?php

			@session_start();

			if ( isset($_SESSION['user']) ){

		?>

			

			<div id="user-in" >

				<div class="separator-left"></div>

				<img height="16" width="16" alt="drop" id="arrow-down" src="<?php echo base_url(); ?>img/arrow-down.png" <?php if ( isset($_SESSION['user']) ) echo 'onclick="launchMenu();"'; ?> />

				<span id="user-name">

				<?php 

					echo $_SESSION['name'];

					

					if ( $notifications ){

					?>

						<span class="notification-out">

								<a href="<?php echo base_url(); ?>index.php/account/#sec=6">

								<span title="<?php echo $this->lang->line('nueva_notificacion'); ?>" class="notification"><?php echo count($notifications); ?></span>

							</a>

						</span>

					<?php

					}

				?>

				</span> 

				<img height="35" width="35" id="user-image" alt="user image" src="<?php echo base_url(); ?>users/img/<?php echo $_SESSION['img']; ?>" />	

			</div>

		<?php

			}

			else{

		?>

			<div id="signin">

				<a id="go" onClick="setHash('sig=1');" rel="leanModal" href="#modal-signin" class="google-button google-button-blue"><?php echo $this->lang->line('iniciar_sesion'); ?></a>

			</div>

		

		<?php

			}

		?>

			

		</div>

	</div>
    
	<div id="modal-signin">
		<script>
			$("#modal-signin").load('<?php echo base_url(); ?>ajax/signin/index.php',{path:path});
		</script>
	</div>
    
	<div id="content-in">
    	<table width="100%">
        	<tr>
            	<td>
                	<div class="title42"><?php echo (!$c_lack ? $item_title:$this->lang->line('faltantes_coleccion')).' ('.$item_title2.')' ?></div>
                </td>
                <td>
                	<?php
						if ( !$c_no_variations ){
							$variations_lang = $this->lang->line('no_mostrar_variantes');
							$variations_url = $c_list.'/'.$c_country.'/'.$c_company.'/'.$c_system.'/'.$c_catalog.'/1/'.($c_lack ? '1':'0');
						}
						else{
							$variations_lang = $this->lang->line('mostrar_variantes');
							$variations_url = $c_list.'/'.$c_country.'/'.$c_company.'/'.$c_system.'/'.$c_catalog.'/0/'.($c_lack ? '1':'0');
						}
					?>
                	<a href="<?php echo base_url(); ?>index.php/<?php echo $c_user; ?>/collection/<?php echo $variations_url; ?>" class="google-button"><?php echo $variations_lang; ?></a>
                </td>
                <td>
                	<?php
						if ( !$c_lack ){
							$lack_lang = $this->lang->line('faltantes_coleccion');
							$lack_url = $c_list.'/'.$c_country.'/'.$c_company.'/'.$c_system.'/'.$c_catalog.'/'.($c_no_variations ? '1':'0').'/1';
						}
						else{
							$lack_lang = $this->lang->line('mostrar_mi_coleccion');
							$lack_url = $c_list.'/'.$c_country.'/'.$c_company.'/'.$c_system.'/'.$c_catalog.'/'.($c_no_variations ? '1':'0').'/0';
						}
					?>
                	<a href="<?php echo base_url(); ?>index.php/<?php echo $c_user; ?>/collection/<?php echo $lack_url; ?>" class="google-button google-button-red"><?php echo $lack_lang; ?></a>
                </td>
            </tr>
        </table>
        <div class="title4"><?php echo $country['name']; ?>&nbsp;&raquo;&nbsp;<?php echo $company['name']; ?>&nbsp;&raquo;&nbsp;<?php echo $system_name; ?>&nbsp;&raquo;&nbsp;<?php echo $catalog; ?></div>
        <div class="title3" style="margin-top:5px;">
        	<table cellpadding="5">
            	<tr>
                	<td>Exportar:</td>
                    <td><span onClick="toggle_loader('pdf')" class="google-button">PDF</span></td>
                    <td><span onClick="toggle_loader('xls')" class="google-button">EXCEL</span></td>
                    <td><img id="export_loader" style="display:none;" src="<?php echo base_url(); ?>img/ajax-loader.gif" /></td>
                </tr>
            </table>
        </div>
        <table id="user_collection_table" cellpadding="10" >
        	<tr>
            	<td><b><?php echo $this->lang->line('nombre'); ?></b></td>
                <td><b><?php echo $this->lang->line('tipo_sistema'); ?></b></td>
                <td><b><?php echo $this->lang->line('logo'); ?></b></td>
                <td><b><?php echo $this->lang->line('emitida'); ?></b></td>
                <td><b><?php echo $this->lang->line('tiraje'); ?></b></td>
                <td><b><?php echo $this->lang->line('valor_facial'); ?></b></td>
                <td><b><?php echo $this->lang->line('variacion_descriptiva'); ?></b></td>
                <?php
					if ( !$c_lack ){
						?>
						<td><b><?php echo $this->lang->line('nota'); ?></b></td>
						<?php	
					}
				?>
            </tr>
            <?php
			for ( $i = 0 ; $i < count($phonecards) ; $i++ ){
				?>
                <tr>
                	<td><span style="cursor:pointer; color:#06f;" onclick="modalPhonecard(<?php echo $phonecards[$i]['id_phonecards']; ?>);"><?php echo $phonecards[$i]['name']; ?></span></td>
                	<td><?php echo $phonecards[$i]['system']; ?></td>
                	<td><?php echo $phonecards[$i]['logo']; ?></td>
                	<td <?php echo strlen($phonecards[$i]['issued_on']) == 0 ? 'onMouseOver="showInfo(this,\''.$this->lang->line('titulo_fecha_conocida').'\')"':''; ?> >
					<?php echo strlen($phonecards[$i]['issued_on']) != 0 ? $phonecards[$i]['issued_on'] : $phonecards[$i]['known_date'].'<span style="color:#f00">*</span>'; ?>
                    </td>
                	<td><?php echo $phonecards[$i]['print_run'] != 0 ? $phonecards[$i]['print_run'] : $this->lang->line('desconocido'); ?></td>
                	<td><?php echo floor( $phonecards[$i]['face_value'] ) != $phonecards[$i]['face_value'] ? number_format($phonecards[$i]['face_value'],1) : number_format($phonecards[$i]['face_value'],0); ?></td>
                	<td><?php echo $phonecards[$i]['descriptive_variation']; ?></td>
                    <?php
					if ( !$c_lack ){
							?>
							<td style="text-align:center; color:#06f; cursor:pointer;" onClick="modalNote( <?php echo $phonecards[$i]['id_phonecards_users']; ?> , <?php echo $phonecards[$i]['id_phonecards']; ?> , <?php echo $c_list; ?> , <?php echo $c_country; ?> , <?php echo $c_catalog; ?> , <?php echo $c_company; ?> )"><?php echo $this->lang->line('ver'); ?></td>
							<?php	
						}
					?>
                    
                </tr>
                <?php
			}
				//echo var_dump($phonecards);
			?>
        </table>
	</div>	

</div>