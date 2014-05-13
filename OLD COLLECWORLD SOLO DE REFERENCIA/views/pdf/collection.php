
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
          <?php
            
            $item_title = $this->lang->line('coleccion_de_tarjetas');
            
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

  <div id="content-in">
        <table id="collections-table"  cellspacing='0' cellpadding="5" border='1'>
    <tr>

      <td colspan="7" style="border: 1px solid white; font-family:sans-serif; font-size:30;">Collecworld</td>

    </tr>
        <tr>

      <td colspan="7"><h3 style="margin:0; padding:0;"><?php echo $this->lang->line('informacion'); ?></h3></td>

    </tr>

    <tr>

      <td colspan="7"><strong><?php echo $this->lang->line('usuario'); ?>:</strong> <?php echo $user_info['user']; ?></td>

    </tr>

    <tr>

      <td colspan="7"><strong><?php echo $this->lang->line('nombre') ?>:</strong> <?php echo $user_info['name']; ?></td>

    </tr>

    <tr>

      <td colspan="7"><strong><?php echo $this->lang->line('pais') ?>:</strong> <?php echo $user_info['Country']; ?></td>

    </tr>

    

    <tr>

      <td colspan="7" style="border: 1px solid white; ">&nbsp;</td>

    </tr>
          <tr >
              <td colspan="7" style="text-align:center"><b><?php echo $item_title. $c_user."(". $item_title2.")"; ?></b></td>
            </tr>
          <tr class="collections-table-head" valign="middle">
              <td><b><?php echo $this->lang->line('nombre'); ?></b></td>
                <td><b><?php echo $this->lang->line('tipo_sistema'); ?></b></td>
                <td><b><?php echo $this->lang->line('logo'); ?></b></td>
                <td><b><?php echo $this->lang->line('emitida'); ?></b></td>
                <td><b><?php echo $this->lang->line('tiraje'); ?></b></td>
                <td><b><?php echo $this->lang->line('valor_facial'); ?></b></td>
                <td><b><?php echo $this->lang->line('variacion_descriptiva'); ?></b></td>
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

                    
                </tr>
                <?php
      }
        //echo var_dump($phonecards);
      ?>
        </table>
  </div>  