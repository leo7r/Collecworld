<?php

$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);



switch ($lang){

    

    case "es":

        include("lang/landing_es.php");

        break;

    case "en":

        include("lang/landing_en.php");

        break;        

    default:

        include("lang/landing_en.php");

        break;

}

?>



<!DOCTYPE html>

<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->

<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->

<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->

<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>



	<!-- Basic Page Needs

  ================================================== -->

	<meta charset="utf-8">

	<title><?php echo $title; ?></title>

	<meta name="title" content="CollecWorld">

	<meta name="description" content="All your collections in one place, Organize it online, trade with other collectors around the world, explore other collections and find the one you need." />	

	<meta name="keywords" content="collection, collections, colection, colections, collectibles, collector, collectors, world's collection, worlds collection, world collection, collections of the world, explore collections, phonecards collections, phonecard collection, coins collections, coin collection, stamps collections, stamp collection, bottle caps collections, bottle cap collection, banknotes collection, banknote collection, share collections, share collection, buy collections, buy collection, sell collections, sell collection, auction collections, auction collection, sale collections, sale collection, collection for sale, collections for sale, bidding collections, bidding collections, rare collections, rare collection, old collections, all collections, collect online, trade collections, trade collection" />

	<meta name="author" content="CollecWorld">

	<meta name="publisher" content="CollecWorld">

	<meta name="language" content="en">





	<!-- Mobile Specific Metas

  ================================================== -->

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">



	<!-- CSS

  ================================================== -->

	<link rel="stylesheet" href="css/landing/base.css">

	<link rel="stylesheet" href="css/landing/skeleton.css">

	<link href="css/landing/prettyPhoto.css" rel="stylesheet">

	<link href="css/landing/site.css" rel="stylesheet">

	<link rel="stylesheet" href="css/landing/layout.css">

	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300' rel='stylesheet' type='text/css'>



	<!--[if lt IE 9]>

		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

	<![endif]-->

	

	 <!-- JS

	================================================== -->

	<script src="js/landing/jquery-1.8.2.min.js"></script>

	<script src="js/landing/jquery-ui-1.9.0.custom.min.js"></script>

	<script src="js/landing/slides.min.jquery.js"></script>

	<script src="js/landing/jquery.prettyPhoto.js"></script>

	<script src="js/landing/site.js"></script>

	<script>

		

		function show(){

			document.getElementById('request-inv').style.display="none";

			document.getElementById('send-req-inv').style.display="block";

		}

	</script>

    <script>

		function googleTranslateElementInit() {

			new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: true}, 'google_translate_element');

		}

		

		$(window).ready(function(){

		

			setTimeout(function(){

				

				var gt = document.createElement('script'); gt.type = 'text/javascript'; gt.async = true;

				gt.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';

				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gt, s);
 

			});

		});

		

	</script>



</head>

<body>







	<!-- Primary Page Layout

	================================================== -->



	<!-- Delete everything in this .container and get started on your own site! -->

	<div class="l-hdr">

		<div class="container">

			<div class="ten columns" >

			

				<h1 class="logo">Collecworld</h1>

				

			</div>

			<div class="six columns">

            	

                <div style="float:left;">

                    <nav>

                        <ul>

                            <li id="login">

                                <a id="login-trigger" style="cursor:pointer">

                                    <?php echo $top_login; ?><span>▼</span>

                                </a>

                                <div id="login-content">

                                    <form method="post" action="">

                                            <input id="username" type="text" name="user" placeholder="User" required>   

                                            <input id="password" type="password" name="pass" placeholder="Password" required>

                                            

                                            <input type="submit" class="btn" value="<?php echo $top_login; ?>">

                                    </form>

                                </div>                     

                            </li>

                        </ul>

                    </nav>

                </div>

                <div style="float:left;" id="social-div">					

                    <a href="https://www.facebook.com/collecworld" class="social social-fb" target="_blank"></a>

                    <a href="https://twitter.com/collecworld" class="social social-tw" target="_blank"></a>

                </div>

                    

			</div>

		</div>

	</div>

	<div class="l-top">

		<div class="container" id="big-ver">

			<div class="one-third column">

				<div class="slides-left">

				  <h1 class="slides-h1"><?php echo $main_title; ?></h1>

				  <p class="slides-txt"><?php echo $main_description; ?></p>

				  <br>

				  <br>

				  

					  <p class="slides-fineprint"><?php echo $main_trial; ?></p>

				  <div id="request-inv">

					  <input type="button" class="btn btn-big" value="<?php echo $request; ?>" onClick="show();">

				  </div>

				  <div id="send-req-inv" style="display:none;"><br>

					  <input type="email" style="padding:15px; float:left;" placeholder="<?php echo $email; ?>" id="email" required>

                      <input type="button" class="btn btn-sus" value="<?php echo $send; ?>" onClick="requestInv();">

				  </div>

                  <div id="mes-err"></div> 

				</div>



                      

			</div>

			<div class="one-thirds column" id="video-cont">

				<span class="slides-vid-wrap">

					<img src="img/landing/landing.jpg" alt="Introduction Video" class="img-video">

                    <!--<a class="slides-vid-lnk" href="http://vimeo.com/52942657" rel="prettyPhoto" title="">

                        <span class="slides-vid-play"></span>

                        

                    </a>-->

				</span>

			</div>

		</div><!-- container -->

		

	</div>

	<div class="l-stripe">

		<div class="container" >

			<div class="one-third column">

				<ul class="features">

				  <li class="features-item">

					<span class="features-icon features-icon-1"><img src="img/landing/lupa.png"></span>

					<h4 class="features-title"><?php echo $manage; ?></h4>

					<p class="features-txt"><?php echo $manage_info; ?></p>

				  </li>

				</ul>

			</div>

			

			<div class="one-third column">

				<ul class="features">

				  <li class="features-item">

					<span class="features-icon features-icon-1"><img src="img/landing/world.png"></span>

					<h4 class="features-title"><?php echo $connect; ?></h4>

					<p class="features-txt"><?php echo $connect_info; ?></p>

				  </li>

				</ul>

			</div>

			

			<div class="one-third column">

				<ul class="features">

				  <li class="features-item">

					<span class="features-icon features-icon-1"><img src="img/landing/swap.png"></span>

					<h4 class="features-title"><?php echo $exchange; ?></h4>

					<p class="features-txt"><?php echo $exchange_info; ?></p>

				  </li>

				</ul>

			</div>

			

		</div>

	</div>

	<div class="l-ftr">

		<div class="container" >

			<div class="sixteen columns" >

				<ul class="ftr-list">

					<li><a href="#"><?php echo $about; ?></a></li>

					<li><a href="#"><?php echo $help; ?></a></li>

					<li><a href="#">Blog</a></li>

					<li><a href="#"><?php echo $status; ?></a></li>

					<li><a href="#"><?php echo $terms; ?></a></li>

					<li>© 2013 Collecworld</li>

				</ul>

			</div>

		</div>

	</div>





<!-- End Document

================================================== -->

</body>

</html>