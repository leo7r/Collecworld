<!-- MUESTRO EL EXPLORAR DE LISTAS SI TIENE ARTICULOS-->
<div id="collection-list-content">

    <div class="title42">4. <?php echo $this->lang->line('seleccionar_compania'); ?></div>
    
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
                    onClick="collectionListShowSystems(<?php echo $list_item['id_lists']; ?>, <?php echo $list_item['id_countries']; ?>, <?php echo $list_item['phonecards_circulation']; ?>, <?php echo $list_item['id_phonecards_companies']; ?>)">
                      
                    <br> 
                    <?php echo ucfirst($list_item['companies']); ?>
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
 