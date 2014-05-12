<?php
if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 


function ago($time)
{
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference $periods[$j] ago ";
}
?>
<script>
	$(document).ready(function(){
		setPlaceHolder("comment");
		$(".report-comment").css({opacity:0});
		
		$("#comment-table tr").hover(
			function () {
				$(this).find('.report-comment').animate({opacity:1},100);
		  	}, 
		 	 function () {
				$(this).find('.report-comment').animate({opacity:0},100);
		  	}
		);
		
	});
</script>
<?php

$id = $_REQUEST['id'];

session_start();

$sql= 'SELECT c.* , u.image , u.user , u.name FROM comment c , users u WHERE c.id_categories = 1 AND c.id_item = '.$id.' AND u.id_users = c.id_users ORDER BY c.date  desc';
$cursor=mysql_query($sql);
$num=mysql_num_rows($cursor);

?>

<div>
	<ul id="show-tabs">
		<li class="box1" onClick="showPhonecardTab(0,<?php echo $id; ?>);"><?php echo $lang['informacion']; ?></li>
		<li class="box1" onClick="showPhonecardTab(1,<?php echo $id; ?>);"><?php echo $lang['coleccionistas']; ?></li>
		<li class="box1" onClick="showPhonecardTab(2,<?php echo $id; ?>);"><?php echo $lang['relacionadas']; ?></li>
		<li class="box1 selected" onClick="showPhonecardTab(3,<?php echo $id; ?>);"><?php echo $lang['comentarios']; ?></li>
	</ul>
</div>
<div id="comment-list">
	<table id="comment-table" cellpadding="5" cellspacing="0">
		<?php
			for ($i=0 ; $i < $num ; $i++){
			
				$datos = mysql_fetch_array($cursor);
				
				?>
				<tr <?php if ( $i % 2 != 0 ) echo 'class="odd"'; ?> >
					<td class="comment-image">
						<a href="<?php echo $path.'index.php/'.$datos['user']; ?>">
							<img title="<?php echo $datos['name']; ?>" src="<?php echo $path.'users/img/'.$datos['image']; ?>" width="40" height="40" />
						</a>
					</td>
					<td class="comment-text">
						<?php echo $datos['comment']; ?>
						<br />
						<br />
						<span onclick="modalFeedback();" title="<?php echo $lang['reportar_comentario']; ?>" id="report_<?php echo $i; ?>" class="report-comment">
							<img  src="<?php echo $path.'img/report.png'; ?>" />
						</span>						
						<span class="comment-date" title="<?php echo date('d/m/Y h:m a',$datos['date']); ?>"><?php echo ago($datos['date']); ?></span>
					</td>
				</tr>
				<?php
			}
		?>
	</table>
	<?php
	if ( !$num ){
		?>
			<span class="title3"><?php echo $lang['sin_comentarios_tarjeta_telefonica']; ?>.</span>
		<?php
	}
	?>
</div>	
<?php
	if ( isset($_SESSION['user']) ){
?>
	<div id="new-comment">
		<input type="hidden" id="id_sender" value="<?php echo $_SESSION['id_users']; ?>" />
		<input type="hidden" id="id_item" value="<?php echo $id; ?>"  />
		<table id="new-comment-table" cellpadding="0" cellspacing="0">
			<tr>
				<td><img id="user-comment" src="<?php echo $path.'users/img/'.$_SESSION['img']; ?>" width="50" height="50" /></td>
				<td><textarea id="comment"><?php echo $lang['escribe_comentario']; ?></textarea></td>
				<td><span id="send-comment" class="google-button google-button-blue" onclick="sendComment();"><?php echo $lang['enviar']; ?></span></td>
			</tr>
		</table>
	</div>
<?php
	}
	else{
		?>
		<span class="title32">
			<?php echo $lang['tu_debes']; ?> <a href="<?php echo $path; ?>index.php/login"><?php echo $lang['iniciar_sesion']; ?></a> <?php echo $lang['para_escribir_comentarios']; ?>.
		</span>
		<?php
	}
?>


