<!-- MUESTRO EL EXPLORAR DE LISTAS SI TIENE ARTICULOS-->
<div id="collection-list-content">

    <div class="title42">3. <?php echo $this->lang->line('seleccionar_circulacion'); ?></div>
    
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
                    onClick="collectionListShowCompanies(<?php echo $list_item['id_lists']; ?>, <?php echo $list_item['id_countries']; ?>, <?php echo $list_item['phonecards_circulation']; ?>)">
                      
                    <br> 
                    <?php
						
					switch($list_item['phonecards_circulation']){
						
						case 0 : echo $this->lang->line('normal');
						break;
						case 1 : echo $this->lang->line('especial');
						break;
					}
					 
					?>
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
