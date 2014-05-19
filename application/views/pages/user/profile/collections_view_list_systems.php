<!-- MUESTRO EL EXPLORAR DE LISTAS SI TIENE ARTICULOS-->
<div id="collection-list-content">

    <div class="title42">5. <?php echo $this->lang->line('seleccionar_sistema'); ?></div>
    
    <table id="collection_countries" cellpadding="10">
    	<?php
		$i=1;
    	foreach( $list_items as $list_item ){ 
            
            if ( $i % 4 == 0 ){
                echo '<tr>';	
            }
            ?>
            
           <td>
                <div class="collection-step2" 
                    onClick="location.href='<?php echo base_url().$_SESSION['user'].'/collection/'.$list_item['id_lists'].'/'.$list_item['id_countries'].'/'.$list_item['phonecards_circulation'].'/'.$list_item['id_phonecards_companies'].'/'.$list_item['id_phonecards_systems']; ?>'">
                      
                    <br> 
                    <?php echo ucfirst($list_item['systems']); ?>
                    <br>
                    (<?php echo $list_item['count']; ?>)
                </div>
            </td> 
            
            <?php
            
            if ( $i % 4 == 3 ){
                echo '</tr>';	
            }
        }
        ?>
    </table>
  
</div>
 