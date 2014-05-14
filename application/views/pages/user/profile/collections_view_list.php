<div class="title4">
    <?php echo $this->lang->line('mis_colecciones').' - '.$this->lang->line(); ?> [<?php echo $name_list; ?>]    
</div>

<input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id_users']; ?>" />
<input type="hidden" name="list_name_old" id="list_name_old" value="<?php echo $datos_list['name']; ?>" />
<table id="collections-table" cellpadding="2" >
 <?php if($list > 5){ ?>
    <tr>
        <td>Name: &nbsp; <input type="text" name="list_name" id="list_name" value="<?php echo $datos_list['name']; ?>" /></td>
        <td colspan="2">Privacy: &nbsp; 
            <select name="list_priv" id="list_priv">
                <option value="<?php echo $datos_list['status']; ?>"><?php echo $priv; ?></option>
                <?php if($datos_list['status']!=0){ ?><option value="0">Public</option> <?php } ?>
                <?php if($datos_list['status']!=1){ ?><option value="1">Friends</option> <?php } ?>
                <?php if($datos_list['status']!=2){ ?><option value="2">Just me</option> <?php } ?>
            </select>
        </td>
        <td><span class="google-button" onClick="editlist();" >Edit List</span></td>
    </tr> 
 <?php } ?>
</table>