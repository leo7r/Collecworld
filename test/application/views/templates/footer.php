<a id="modalF" style="display:none;" rel="leanModal" href="#modal-feedback">a</a>
<a id="modalI" style="display:none;" rel="leanModal" href="#modal-intro">a</a>

<div id="modal-feedback"></div>
<div id="modal-intro"></div>

<div class="hiddencon" onclick="javascript:modalFeedback()">

	<div class="hiddencon-label"><?php echo $this->lang->line('enviar_comentario'); ?></div>

</div>

<a href="<?php echo base_url(); ?>index.php/help" class="hiddencon3">

	<div class="hiddencon-label"><?php echo $this->lang->line('ayuda'); ?></div>

</a>

		<div id="footer">

			<div id="footer-shadow"></div>

			<div id="footer-in">

			

				<div class="footer-collumn">

					<ul>

						<li class="title3"><?php echo $this->lang->line('categorias'); ?></li>

						<li><a href="<?php echo base_url(); ?>index.php/explore/phonecard"><?php echo $this->lang->line('tarjetas_telefonicas'); ?></a></li> 
                        <li><a href="<?php echo base_url(); ?>index.php/explore/coin"><?php echo $this->lang->line('monedas'); ?></a></li> 
                        <li><a href="<?php echo base_url(); ?>index.php/explore/banknote"><?php echo $this->lang->line('billetes'); ?></a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/explore/stamp"><?php echo $this->lang->line('estampillas'); ?></a></li>

						<li><?php echo $this->lang->line('footer_working'); ?></li>

					</ul>

				</div>

				

				<div class="footer-collumn">

					<ul>

						<li class="title3"><?php echo $this->lang->line('cuenta'); ?></li>

                        <?php if(isset($_SESSION['id_users'])){ ?>

						<li><a href="<?php echo base_url(); ?>index.php/account"><?php echo $this->lang->line('mi_cuenta'); ?></a></li>

						<li><a href="<?php echo base_url(); ?>index.php/account/#sec=1"><?php echo $this->lang->line('mis_colecciones'); ?></a></li>

						<li><a href="<?php echo base_url(); ?>index.php/account/#sec=2"><?php echo $this->lang->line('amigos'); ?></a></li>

						<li><a href="<?php echo base_url(); ?>index.php/account/#sec=3"><?php echo $this->lang->line('eventos'); ?></a></li>

						<li><a href="<?php echo base_url(); ?>index.php/account/#sec=4"><?php echo $this->lang->line('comercios'); ?></a></li>

						<li><a href="<?php echo base_url(); ?>index.php/account/#sec=5"><?php echo $this->lang->line('mensajes'); ?></a></li>

						<li><a href="<?php echo base_url(); ?>index.php/account/#sec=7"><?php echo $this->lang->line('footer_configuracion'); ?></a></li>

						<?php }else{ ?>                        

						<li><a onclick="toSignin()" rel="leanModal" href="#modal-signin" ><?php echo $this->lang->line('conectar'); ?></a></li>

						<li><a onclick="setSignup()" rel="leanModal" href="#modal-signin" ><?php echo $this->lang->line('crear_cuenta'); ?></a></li>

                        <?php } ?>

						<!-- <li class="help-collecworld"><a href="#">Be premium!</a></li> -->

					</ul>

				</div>

				

				<div class="footer-collumn">

					<ul>

						<li class="title3">Collecworld</li>

						<li><a href="javascript:modalFeedback()"><?php echo $this->lang->line('enviar_comentario'); ?></a></li><li class="help-collecworld"><a href="<?php echo base_url(); ?>index.php/upload"><?php echo $this->lang->line('footer_ayuda_construir'); ?></a></li>

                        <br />

						<li><a href="#"><?php echo $this->lang->line('footer_sobre_nosotros'); ?></a></li>

						<li><a href="<?php echo base_url();?>index.php/help"><?php echo $this->lang->line('ayuda'); ?></a></li>

						<li><a href="<?php echo base_url();?>forum"><?php echo $this->lang->line('footer_foro'); ?></a></li>

						<li><a href="#"><?php echo $this->lang->line('footer_estado'); ?></a></li>

						<li><a href="#"><?php echo $this->lang->line('footer_terminos_servicio'); ?></a></li>

					</ul>

				</div>

				

				<div class="footer-collumn">

					<ul>

						<li class="title3"><?php echo $this->lang->line('footer_social'); ?></li>

						<li><a target="_blank" href="//facebook.com/collecworld"><?php echo $this->lang->line('footer_amigos_facebook'); ?></a></li>

						<li><a target="_blank" href="//twitter.com/collecworld"><?php echo $this->lang->line('footer_siguenos_twitter'); ?></a></li>

						<li class="footer-subscribe">

							<?php echo $this->lang->line('footer_suscribete'); ?>

							<br />

							<input id="footer-subsrcibe-email" type="text" value="<?php echo $this->lang->line('correo_electronico'); ?>" onkeyup="subscribe_key_up()" />

							<span class="subscribe-go">

								<img src="<?php echo base_url(); ?>img/subscribe-email.png" height="16" width="16" onclick="subscribe()" />

							</span>

						</li>

						<br />

						<li>

							<table id="num-col-footer">

								<tr>

									<td><img src="<?php echo base_url(); ?>img/collectables.png"  /></td>

									<td>

										<span class="num-collectables"><?php echo number_format($collectibles_count); ?></span>

										<br  />

										<span><?php echo $this->lang->line('coleccionables'); ?></span>

									</td>

								</tr>

							</table>

						</li>

					</ul>

				</div>

				

			</div>			

		</div>

	</body>

</html>



<script>

	$(document).ready(function(){

		

		setPlaceHolder('footer-subsrcibe-email');

		

	});

</script>