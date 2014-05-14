<!--
      Happy collecting
 
        ..-"""""-..
       .'    ___    '.
      /    ."\  `\    \
     ;    /, (    |    ;
    ;    /_   '._ /     ;
    |     |-  '._`)     |
    ;     '-;-'  \      ;
     ;      /    \\    ;
      \    '.__..-'   /
       '._ 1 9 9 9 _.'
          ""-----""
       COLLECWORLD.COM
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $title ?> - CollecWorld</title>
	<meta name="title" content="<?php echo $title ?> - CollecWorld">
	<meta name="description" content="All your collections in one place, Organize it online, trade with other collectors around the world, explore other collections and find the one you need." />	
	<meta name="keywords" content="collection, collections, colection, colections, collectibles, collector, collectors, world's collection, worlds collection, world collection, collections of the world, explore collections, phonecards collections, phonecard collection, coins collections, coin collection, stamps collections, stamp collection, bottle caps collections, bottle cap collection, banknotes collection, banknote collection, share collections, share collection, buy collections, buy collection, sell collections, sell collection, auction collections, auction collection, sale collections, sale collection, collection for sale, collections for sale, bidding collections, bidding collections, rare collections, rare collection, old collections, all collections, collect online, trade collections, trade collection" />
	<meta name="author" content="CollecWorld">
	<meta name="publisher" content="CollecWorld">
	<meta name="language" content="en">
	<link rel="apple-touch-icon" href="">
	<!--<link rel="shortcut icon" href="">-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" />
	
	<!-- jQuery -->
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js" ></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.leanModal.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.getUrlParam.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/functions/functions_general.js"></script>
	
	<!-- on Ready -->
	
	<script>
		pageInit();
		
		$(window).ready(function(){
			
			
			setTimeout(function(){

				

				var gt = document.createElement('script'); gt.type = 'text/javascript'; gt.async = true;

				gt.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';

				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gt, s);
 

			});
			
		});
		
	</script> 
	<script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-35549594-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>

</head>
<body>
<div id="fb-root"></div>

<div id="top">
    <div class="in">
        <table>
            <tr valign="middle">
                <td>
                    <a href="<?php echo base_url(); ?>init"><img id="logo" src="<?php echo base_url(); ?>img/logo.png" height="40" width="80" alt="logo" /></a>
                </td>
                <td>
                    <select style="width:160px;" onChange="switch_language(this);">
                        <option value="-1">Seleccionar idioma</option>
                        <option <?php if ( isset($_SESSION['selected_lang']) && strcmp($_SESSION['selected_lang'],'en') == 0) echo 'selected="selected"' ?> value="en">English</option>
                        <option <?php if ( isset($_SESSION['selected_lang']) && strcmp($_SESSION['selected_lang'],'es') == 0) echo 'selected="selected"' ?> value="es">Espa&ntilde;ol</option>
                        <option <?php if ( isset($_SESSION['selected_lang']) && strcmp($_SESSION['selected_lang'],'other') == 0) echo 'selected="selected"' ?> value="other">Otro</option>
                    </select>
                </td>
                <td>
                    <?php if ( isset($_SESSION['selected_lang']) && strcmp($_SESSION['selected_lang'],'other') == 0){ ?><div id="google_translate_element"></div> <?php } ?>
                </td>
            </tr>
        </table>
        
        <div id="account" >
            <div id="search-top">
                
                <?php
                   /* if ( isset($_SESSION['user']) && $_SESSION['status'] == 1 && isset($num_feedbacks) && $num_feedbacks > 0 ){
                        ?>
                        <a href="<?php echo base_url(); ?>answer_feedback">Sugerencias (<?php echo $num_feedbacks; ?>)</a>
                        <?php	
                    }*/
                ?>
                
                <img id="search-go" src="<?php echo base_url(); ?>img/search2.png" onClick="if(searchTop()=='true'){showGlobalInfo('<?php echo  $this->lang->line('palabras_con_3_caracteres'); ?>');}" />
    
                <input type="text" id="search" value="<?php echo $this->lang->line('header_busqueda'); ?>" onkeyup="searchInput();" />
    
			</div>
		</div>
	</div>
</div>