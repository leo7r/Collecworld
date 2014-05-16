<!-- MUESTRO EL EXPLORAR DE LISTAS SI TIENE ARTICULOS-->
<div id="collection-list-content">

    <div class="title42">2. <?php echo $this->lang->line('seleccionar_catalogo'); ?></div>
    
    <table id="collection_countries" cellpadding="10">
    	<tr>
        	<td>
                <div class="collection-step2" 
                    onClick="collectionListShowCirculations(<?php echo $list_item_cw['id_lists']; ?>, <?php echo $list_item_cw['id_countries']; ?>)"> 
                    <br>
                    Collecworld
                    <br>
                    (<?php echo $list_item_cw['count']; ?>)
                </div>
            </td>
        </tr>
    </table>
  
</div>

<?php
        /*
		CUANDO SE COLOQUEN CATALOGOS DE REFERENCIA
		$i=0;
        foreach( $list_items as $list_item ){ 
            
            if ( $i % 4 == 0 ){
                echo '<tr>';	
            }
            ?>
            
           <td>
                <div class="collection-step2" 
                    onClick="collectionListShowCatalog(<?php echo $list['id_lists']; ?>, <?php echo $list_item['id_countries']; ?>, <?php echo $list_item['id_countries']; ?>)">
                      
                    <br>
                    <?php echo $list_item['countries']; ?>
                    <br>
                    (<?php echo $list_item['count']; ?>)
                </div>
            </td> 
            
            <?php
            
            if ( $i % 4 == 3 ){
                echo '</tr>';	
            }
        }*/
        ?>