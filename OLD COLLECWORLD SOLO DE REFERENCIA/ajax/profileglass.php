<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
}

@session_start();

$user = $_SESSION['user'];
$usuario = $_REQUEST['usuario']; 
$GroupUser = $_REQUEST['GroupUser']; 
$BeginDate = $_REQUEST['BeginDate'];
$FinalDate = $_REQUEST['FinalDate'];

if(($GroupUser!="undefined")){
	$groupby="group by ".$GroupUser ;
}else{
	$groupby="";
}

$sql=mysql_query("SELECT `u2`.`name`, `u2`.`user` as user, `u2`.`image` as image, `c`.`name` as country, `u`.`gender` as gender, `date` FROM (`users` u, `users` u2, `countries` c, `profile_glass` p) WHERE `u2`.`id_countries` = c.id_countries AND `p`.`id_users1` = u.id_users AND `p`.`id_users2` = u2.id_users AND `u`.`user` = '$user' AND (FROM_UNIXTIME(`date`) between '$BeginDate' AND '$FinalDate') AND (`id_users1` like '%$usuario%' or c.name like '%$usuario%' or u2.name like '%$usuario%' or u2.user like '%$usuario%') ".$groupby);
$users_num=mysql_num_rows($sql);
$users_profile=mysql_fetch_array($sql);
?>
<div class="title4"><?php echo $lang['usuarios_que_visitaron']; ?></div>

											<?php

												if ( !$users_num ){

													?>

														<div style="text-align:center; color:#555">

															<img src="<?php echo $path; ?>img/not_found.png" />

															<br>

															<?php echo $lang['nadie_te_visito']; ?>

														</div>

													<?php

												}

												else{

											?>

											<table cellpadding="5">

												<?php

													for ( $i = 0 ; $i < $users_profile; $i++ ){
															

														//$width = strcmp($phonecards[$i]['vertical_anverse'],'1') == 0 ? 38:61;

														//$height = strcmp($phonecards[$i]['vertical_anverse'],'1') == 0 ? 61:38;
														if ( strcmp($users_profile['image'],'') != 0 ){

														$img = $path.'users/img/'.$users_profile['image'];

														}

														else{

															$img = $path.'img/default_coin.jpg';

														}
														



													?>

														<tr>

														<td valign="top">

																	<a href="<?php echo $path; ?>index.php/<?php echo $users_profile['user']; ?>">

																	<img src="<?php echo $path; ?>users/img/<?php echo $users_profile['image']; ?>" width="32" height="32" />

																	</a>

																</td>

															<td>

																<a href="<?php echo $path; ?>index.php/<?php echo $users_profile['user']; ?>">

																<img onClick="modalBanknote(<?php echo $users_profile['name']; ?>);" />

																</a>

															</td>

															<td>

																<a  href="<?php echo $path; ?>index.php/<?php echo $users_profile['user']; ?>" >

																	<?php echo utf8_encode($users_profile['name']); ?>

                                                                </a>

																<br>

																<?php echo $users_profile['country']."/".$lang['genero'].": ".$users_profile['gender']; ?>

															</td>
																														<td>		

																	<?php echo $lang['fecha']."<br>"; ?>
																	<?php echo gmdate('r',$users_profile['date']); ?>

															</td>
															
														</tr>

													<?php
														$users_profile=mysql_fetch_array($sql);
													}

												?>

											</table>


											<?php

												}

											if ( $users_num > 6 ){

											?>

											<div style="float:right;">

											<!--<a href="<?php echo $path; ?>index.php/search/banknotes/<?php echo str_replace(' ','+',$_SESSION['user']); ?>/1"><?php echo $this->lang->line('mostar_todos'); ?>&nbsp; <?php echo $users_num; ?>&nbsp;<?php echo $this->lang->line('coleccionistas'); ?> </a>
												-->
											</div>

											<?php

											}
											?>