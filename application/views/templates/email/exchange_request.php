<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>

<title><?php echo $name.' '.$request_exchange; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

<style>

@charset "utf-8";
/* CSS Document */

@font-face {
  font-family: 'Raleway';
}

@media screen and (max-width: 480px) and (min-width: 321px) {
	
	body {
		margin: 0 !important;
	}
	
	.wrapper_table {
		width: 460px !important;
	}

	.featured_image img{
		max-width: 460px !important;
          height: auto !important;
	}
	
	.padding {
		width: 5px !important;
	}
	
	.content {
		width: 440px !important;
	}
	
	.content_row {
		width: 440px !important;
	}
	
	.logo img {
		margin: 0 auto !important;
	}
	
	.logo {
		margin: 0 auto;
		width: 460px !important;
		float: left;
		margin-bottom: 15px;
	}
	
	.header_right {
		width: 460px !important;
		float: left;
		margin-bottom: 10px;
	}
	
	.mobile_centered_table {
		margin: 0 auto !important;
	}
	
	.header_spacer {
		display: none !important;
	}
	
	.featured_description {
		width: 440px !important;
	}
	
	.blog_img {
		float: left;
		width: 440px !important;
		margin-bottom: 20px;
	}
	
	.blog_img img {
		margin: 20px auto 10px;
	}
	
	.blog_description {
		float: left;
		width: 440px !important;
		text-align: center;
	}
	
	.blog_description img{
		margin: 10px auto 20px;
	}
	
	#firstsecond{
		margin-top: 220px;
	}
	
	#secondfirst{
		margin-top: -370px;
	}
	
	.one_third {
		float: left;
		width: 440px !important;
		margin-bottom: 30px;
	}
	
	.one_third img {
		margin: 0 auto;
	}
	
	.one_third .noresize {
		margin: 0 auto;
	}
	
	.one_third_spacer {
		display: none;
	}
	
	.one_half {
		float: left;
		width: 440px !important;
		margin-bottom: 20px;
	}
	
	.one_quarter {
		width: 210px !important;
		text-align: center;
	}
	
	.one_half_spacer {
		display: none;
	}
	
	.center_mob_button {
		margin-left: 165px !important;
		float: left !important;
	}
	
	.one_half img{
		margin: 0 auto;
	}
	
	.price_table {
		float: left;
		width: 440px !important;
	}
	
	.price_table table {
		margin: 5px auto 10px !important;
	}
}

@media screen and (max-width: 320px) {
	
	body {
		margin: 0 !important;
	}
	
	.wrapper_table {
		width: 300px !important;
	}
.featured_image img {
		max-width: 280px !important;
                   height: auto !important
	}
	
	.padding {
		width: 10px !important;
	}
	
	.content {
		width: 280px !important;
	}
	
	.content_row {
		width: 280px !important;
	}
	
	.logo img {
		margin: 0 auto !important;
	}
	
	.logo {
		margin: 0 auto;
		width: 280px !important;
		float: left;
		margin-bottom: 15px;
	}
	
	.header_right {
		width: 280px !important;
		float: left;
		margin-bottom: 10px;
	}
	
	.mobile_centered_table {
		margin: 0 auto !important;
	}
	
	.header_spacer {
		display: none !important;
	}
	
	.featured_description {
		width: 280px !important;
	}
	
	.blog_img {
		float: left;
		width: 280px !important;
		margin-bottom: 20px;
	}
	
	.blog_img img {
		margin: 20px auto 10px;
	}
	
	.blog_description {
		float: left;
		width: 280px !important;
		text-align: center;
	}
	
	.blog_description img{
		margin: 10px auto 20px;
	}
	
	#firstsecond{
		margin-top: 200px;
	}
	
	#secondfirst{
		margin-top: -370px;
	}
	
	.one_third {
		float: left;
		width: 280px !important;
		margin-bottom: 30px;
	}
	
	.one_third img {
		margin: 0 auto;
	}
	
	.one_third .noresize {
		margin: 0 auto;
	}
	
	.one_third_spacer {
		display: none;
	}
	
	.one_half {
		float: left;
		width: 280px !important;
		margin-bottom: 20px;
	}
	
	.one_quarter {
		width: 130px !important;
		text-align: center;
	}
	
	.featured_img {
		width: 280px !important;
		height: 162px !important;
	}
	
	.one_half_spacer {
		display: none;
	}
	
	.center_mob_button {
		margin-left: 85px !important;
		float: left !important;
	}
	
	.one_half img{
		margin: 0 auto;
	}
	
	.price_table {
		float: left;
		width: 280px !important;
	}
	
	.price_table table {
		margin: 5px auto 10px !important;
	}
	
}

@media screen and (max-width: 480px) and (min-width: 321px) {
	td[id="nomobile"]{
		display: none !important;
	}
	
	td[id="nomobile1"]{
		display: none !important;
	}
	
	td[id="nomobile2"]{
		display: none !important;
	}
	
	td[id="nomobile3"]{
		display: none !important;
	}
	
	td[id="nomobile4"]{
		display: none !important;
	}
	
	td[id="nomobile5"]{
		display: none !important;
	}
	
	td[id="nomobile6"]{
		display: none !important;
	}
	
	td[id="offermobileoffset"]{
		width: 95px !important;
	}
}

@media screen and (max-width: 320px) {
	td[id="nomobile"]{
		display: none !important;
	}
	
	td[id="nomobile1"]{
		display: none !important;
	}
	
	td[id="nomobile2"]{
		display: none !important;
	}
	
	td[id="nomobile3"]{
		display: none !important;
	}
	
	td[id="nomobile4"]{
		display: none !important;
	}
	
	td[id="nomobile5"]{
		display: none !important;
	}
	
	td[id="nomobile6"]{
		display: none !important;
	}
}

</style>

</head>

<body style="background-color: #e1e1e1; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #4f4f4f; margin: 0;">

<table align="center" border="0" cellpadding="0" cellspacing="0" class="wrapper_table" style="width: 100%;">
    <tr>
    	<td bgcolor="#ffffff" align="center">
        	<table cellspacing="0" cellpadding="0" border="0">
            	<tr>
                	<td class="padding" style="width: 10px;">
                    </td>
                    <td class="content" style="width: 580px;">
                    	<table cellspacing="0" cellpadding="0" border="0">
                        	<tr>
                            	<td class="content_row" style="width: 580px;" height="5">
                                </td>
                         </tr>
                        	<tr>
                            	<td class="content_row" style="width: 580px;">
                                	<table cellspacing="0" cellpadding="0" border="0">
                                    	<tr>
                                        	<td class="logo" align="left" style="width: 150px;">
                                            		<a href="#" style="text-decoration: none;">
                                            			<!-- <img src="#" width="110" height="43" style="display: block;" border="0" alt=""  /> --><h3>Collecworld</h3>
                                                	</a>
                                            </td>
                                            <td class="header_spacer" style="width: 255px;">
                                            </td>
                                            <td class="header_right" style="width: 175px;" valign="bottom">
                                            	<table class="mobile_centered_table" cellspacing="0" cellpadding="0" border="0">
                                                	<tr>
                                                        <td class="social_holder" align="right" style="width: 175px;">
                                                            <table cellspacing="0" cellpadding="0" border="0">
                                                                <tr>
                                                                    <td class="social_button" style="width: 24px;">
                                                                        <a href="https://www.facebook.com/collecworld" class="nodecoration" target="_blank" style="text-decoration: none;">
                                                                            <img src="http://www.collecworld.com/img/social_email/fb.png" width="24" height="24" style="display: block;" border="0"  />
                                                                        </a>
                                                                    </td>
                                                                    <!-- <td class="social_spacer" style="width: 6px;">
                                                                    </td>
                                                                    <td class="social_button" style="width: 24px;">
                                                                        <a href="#" class="nodecoration" target="_blank" style="text-decoration: none;">
                                                                            <img src="http://www.collecworld.com/img/social_email/g+.png" width="24" height="24" style="display: block;" border="0" />
                                                                        </a>
                                                                    </td>-->
                                                                    <td class="social_spacer" style="width: 6px;">
                                                                    </td>
                                                                    <td class="social_button" style="width: 24px;">
                                                                        <a href="https://twitter.com/collecworld" class="nodecoration" target="_blank" style="text-decoration: none;">
                                                                            <img src="http://www.collecworld.com/img/social_email/tw.png" width="24" height="24" style="display: block;" border="0"  />
                                                                        </a>
                                                                    </td>
                                                                    <td class="social_spacer" style="width: 6px;">
                                                                    </td>
																</tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            		<td class="content_row" style="width: 580px;" height="10">
                                	</td>
                            </tr>
                        </table>
                    </td>
                    <td class="padding" style="width: 10px;">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td bgcolor="#3396d8" align="center">
        	<table cellspacing="0" cellpadding="0" border="0">
            	<tr>
                	<td class="padding" style="width: 10px;">
                    </td>
                    <td class="content" style="width: 580px;">
                    	<table cellspacing="0" cellpadding="0" border="0">
                        	<tr>
                            	<td class="content_row" style="width: 580px;" height="10">
                                </td>
                            </tr>
                            <tr>
                            	<td class="content_row featured_image" align="left" style="width: 580px; color:#fff;">
									<h1><?php echo $name.' '.$request_exchange; ?></h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="padding" style="width: 10px;">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td bgcolor="#ffffff" align="center">
        	<table cellspacing="0" cellpadding="0" border="0">
            	<tr>
                	<td class="padding" style="width: 10px;">
                    </td>
                    <td class="content" style="width: 580px;">
                    	<table cellspacing="0" cellpadding="0" border="0">
                        	<tr>
                            	<td class="content_row" style="width: 580px;" height="30">
                                </td>
                            </tr>
                            <tr>
								<td align="left">
									<table>
										<tr>
											<td>
												<a href="#" style="text-decoration: none;" class="nodecoration">
													<img class="noresize" src="http://www.collecworld.com/users/img/<?php echo $image; ?>" width="60" height="60" style="display: block; border-radius: 6px;" border="0" alt=""  />
												</a>
											</td>
											<td>
												<table>
													<tr>
														<td>
												<p class="blog_excerpt" style="font-family: 'Raleway'; font-size: 14px; color: #394041; margin:3px; line-height: 10px;"><b><?php echo $name; ?></b></p>														
														</td>													
													</tr>
													<tr>
														<td>
												<p class="blog_excerpt" style="font-family: 'Raleway'; font-size: 14px; color: #999; margin:3px; line-height: 10px;"><?php echo $user; ?>                                                     </p>
														
														</td>													
													</tr>
													
													
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
                            	<td class="content_row" style="width: 580px;">
                                	<table cellspacing="0" cellpadding="0" border="0">
                                    	<tr>
                                            <td class="blog_description" valign="top" align="left" style="width:600px;">
                                            	<table cellspacing="0" cellpadding="0" border="0">
													<tr>
                                                    	<td valign="top" width="200px" colspan="2">
                                                            <p class="blog_excerpt" style="font-family: 'Raleway'; font-size: 16px; color: #394041; margin: 10px 0; line-height: 18px;">
                                                            	
																<?php echo $wants_give; ?>
                                                            </p>
                                                        </td>
														
														<td valign="top" width="200px" colspan="2">
                                                            <p class="blog_excerpt" style="font-family: 'Raleway'; font-size: 16px; color: #394041; margin: 10px 0; line-height: 18px;">
                                                            	
																<?php echo $in_exchange; ?>
                                                            </p>
                                                        </td>
                                                    </tr>
													<tr>
														<td valign="top" colspan="2" width="270px">
															<table>
																<tr>
																	<td>
																		<p class="blog_title" style="font-family: 'Raleway'; font-size: 18px; color: #3498db; margin: 0; line-height: 18px; width:150px;">
																			<?php echo $phonecards; ?>
                                                                            <br />

																		</p>
																	</td>
																</tr>
																<?php
																
																for($i=0; $i<count($items); $i++){
																
																?>
																<tr>
                                                                	<td valign="top">
                                                                    	<img class="noresize" src="http://www.collecworld.com/upload/img/<?php echo $items[$i]['image']; ?>" width="140" height="85" style="display: block; border-radius: 6px;" border="0" alt=""  />
                                                                    </td>
																	<td valign="top">
																		<p class="blog_excerpt" style="font-family: 'Raleway'; font-size: 14px; color: #394041; margin: 10px 0; line-height: 18px;">
																			
																			<b><?php echo $items[$i]['name']; ?></b><br />
																			<?php echo $items[$i]['serie']; ?><br />
																			<?php echo $items[$i]['company']; ?><br />
																			<?php echo $items[$i]['country']; ?>
																	
																		</p>
                                                                        
																	</td>
																</tr>
                                                                <tr>
																	<td class="content_row" width="250px" colspan="2">
																	<hr>
																	</td>
																</tr>
                                                                <?php
																}
																?>
															</table>
                                                        </td>
														<td valign="top" colspan="2" width="270px">
															<table>
																<tr>
																	<td>
																		<p class="blog_title" style="font-family: 'Raleway'; font-size: 18px; color: #3498db; margin: 0; line-height: 18px; width:150px;">
																			<?php echo $phonecards; ?>
                                                                            <br />

																		</p>
																	</td>
																</tr>
																<?php
																
																for($i=0; $i<count($items1); $i++){
																
																?>
																<tr>
                                                                	<td valign="top">
                                                                    	<img class="noresize" src="http://www.collecworld.com/upload/img/<?php echo $items1[$i]['image']; ?>" width="140" height="85" style="display: block; border-radius: 6px;" border="0" alt=""  />
                                                                    </td>
																	<td valign="top">
																		<p class="blog_excerpt" style="font-family: 'Raleway'; font-size: 14px; color: #394041; margin: 10px 0; line-height: 18px;">
																			
																			<b><?php echo $items1[$i]['name']; ?></b><br />
																			<?php echo $items1[$i]['serie']; ?><br />
																			<?php echo $items1[$i]['company']; ?><br />
																			<?php echo $items1[$i]['country']; ?>
																	
																		</p>
                                                                        
																	</td>
																</tr>
                                                                <tr>
																	<td class="content_row" width="250px" colspan="2">
																	<hr>
																	</td>
																</tr>
                                                                <?php
																}
																?>
															</table>
                                                        </td>
													</tr>
													<!--<tr>
														<td class="content_row" style="width: 580px;" height="20" colspan="2">
														</td>
													</tr>-->
													
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
							<tr>
                            	<td class="content_row" style="width: 580px;" height="30">
                                </td>
                            </tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td bgcolor="#ffffff" align="center">
				<table cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td class="padding" style="width: 10px;">
						</td>
						<td class="content" style="width: 580px;">
							<table cellspacing="0" cellpadding="0" border="0">
								<tr>
                            	<td class="content_row" style="width: 580px;">
                                	<table cellspacing="0" cellpadding="0" border="0">
                                    	<tr>
											<td class="content_row" style="width: 580px;" height="30">
											</td>
										</tr>
										<tr>
											<td class="content_row" style="width: 580px;" height="1" bgcolor="#b6b6b6">
											</td>
										</tr>

										<tr>
                                            <td class="blog_description" valign="top" align="left" style="width:500px;">
                                            	<table cellspacing="0" cellpadding="0" border="0">
                                                	<tr>
                                                    	<td valign="top">
                                                            <p class="blog_excerpt" style="font-family: 'Raleway'; font-size: 14px; color: #999; margin: 10px 0; line-height: 18px;">
                                                            	<?php echo $know_more; ?>
                                                            </p>
                                                        </td>
                                                    </tr>
													<tr>
														<td bgcolor="#3396d8" height="30" width="110" align="center" class="button" style="font-family: 'Raleway', font-size: 12px; color: #ffffff; font-size: 13px; text-align: center; font-weight: normal; border-radius: 3px;">
															<a class="nodecoration" href="#" style="text-decoration: none; display: block; color: #ffffff; line-height: 30px;">
																<?php echo $view_more; ?>
															</a>
														</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
										<tr>
											<td class="content_row" style="width: 580px;" height="30">
											</td>
										</tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
    <tr>
    	<td bgcolor="#ecf0f1" align="center">
        	<table cellspacing="0" cellpadding="0" border="0">
            	<tr>
                	<td class="padding" style="width: 10px;">
                    </td>
                    <td class="content" style="width: 580px;">
                    	<table cellspacing="0" cellpadding="0" border="0">
                        	<tr>
                            	<td class="content_row" style="width: 580px;" height="20">
                                </td>
                            </tr>
                            <tr>
                            	<td class="content_row" style="width: 580px; color: #394041; font-size: 12px; text-align: center; font-family: 'Raleway';">
                                	<a href="#" style="text-decoration: none; color: #394041;"><a href="#" style="text-decoration: none; color: #394041;"><?php echo $unsuscribe; ?></a><br/>
                                   <br/>
<?php echo $send_by; ?><br/><br/> <a href="#" style="text-decoration: none; color: #394041;"><?php echo $email_send; ?></a>
                                </td>
                            </tr>
                            <tr>
                            	<td class="content_row" style="width: 580px;" height="20">
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="padding" style="width: 10px;">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td bgcolor="#2980b9" align="center">
        	<table cellspacing="0" cellpadding="0" border="0">
            	<tr>
                	<td class="padding" style="width: 10px;">
                    </td>
                    <td class="content" style="width: 580px;">
                    	<table cellspacing="0" cellpadding="0" border="0">
                        	<tr>
                            	<td class="content_row" style="width: 580px;" height="15">
                                </td>
                            </tr>
                            <tr>
                            	<td class="content_row" align="center" style="width: 580px;" height="10">
                                	<table cellspacing="0" cellpadding="0" border="0">
                                    	<tr>
                                            <td class="social_holder" align="center" style="width: 175px;">
                                                <table cellspacing="0" cellpadding="0" border="0">
                                                    <tr>
                                                        <td class="social_button" style="width: 24px;">
                                                            <a href="https://www.facebook.com/collecworld" class="nodecoration" target="_blank" style="text-decoration: none;">
                                                                <img src="http://www.collecworld.com/img/social_email/fb.png" width="24" height="24" style="display: block;" border="0"  />
                                                            </a>
                                                        </td>
                                                        <!-- <td class="social_spacer" style="width: 6px;">
                                                        </td>
                                                        <td class="social_button" style="width: 24px;">
                                                            <a href="#" class="nodecoration" target="_blank" style="text-decoration: none;">
                                                                <img src="http://www.collecworld.com/img/social_email/g+.png" width="24" height="24" style="display: block;" border="0" />
                                                            </a>
                                                        </td>-->
                                                        <td class="social_spacer" style="width: 6px;">
                                                        </td>
                                                        <td class="social_button" style="width: 24px;">
                                                            <a href="https://twitter.com/collecworld" class="nodecoration" target="_blank" style="text-decoration: none;">
                                                                <img src="http://www.collecworld.com/img/social_email/tw.png" width="24" height="24" style="display: block;" border="0"  />
                                                            </a>
                                                        </td>
                                                        <td class="social_spacer" style="width: 6px;">
                                                        </td>
                                                        
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td class="content_row" style="width: 580px;" height="15">
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="padding" style="width: 10px;">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
