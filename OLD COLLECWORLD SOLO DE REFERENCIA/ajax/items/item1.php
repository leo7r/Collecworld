<?php

$id_phonecards=$_POST['id_phonecards'];

$id = $_REQUEST['p'];
$title_modal=$_REQUEST['title'];

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
}


?>

<div id="show-pc" style="width:480px">

	<div id="modal-close" class="modal-close" onClick="closeSignin();">

		<img src="<?php echo $path; ?>img/modal-close.png" height="16" width="16" />

	</div>

		<table id="showPcTable">

			<tr>

				<td valign="top">
                	
					<div id='show-left' style="border-right:none">
						<div id="show-title">
							<table>
							<th><?php echo $lang['marcado_rapido']; ?></th>
							<?php echo $title_modal; ?>
							</table>

							<table>
								 <tr>
							 	<td>name</td><td>image</td><td>note</td><td>status</td><td>quit</td>
							 </tr>
								<?php
								for($i=0;$i<count($id_phonecards);$i++){
								$sql=mysql_query("select * from phonecards where id_phonecards='".$id_phonecads['$i']."'");
								$x=mysql_fetch_array($sql);
							 ?>
							<tr>
							 	<td><?php echo $phonecards[$i] ?></td>
							 	<td><?php echo $x['name'] ?></td>
							 	<td><input type="text"></td>
							 	<td><select>
							 		<option>a</option>
							 	</select></td>
							 	<td><a>x</a></td>
							 </tr>
								<?php
									}
								 ?>
							</table>
						</div>


					</div>

				</td>



			</tr>

		</table>

</div>