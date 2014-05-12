jQuery(document).ready(function($) {
  $(".slides-mini").delay(500).animate({
    bottom:'+=900'
  }, 1000, 'easeOutQuint');
  $("a[rel^='prettyPhoto']").prettyPhoto();
  $('#slides').slides({
    animationStart: function() {
      $('.slides-h1').fadeTo(400,0);
      $('.slides-txt').fadeTo(400,0);
      if ($('.slides-mini').is(":visible")) {
        $('.slides-mini').animate({
          bottom:'-=900'
        }, 1000, 'easeOutQuint');
      }
      else {
        $('.slides-phone').animate({
          bottom:'-=900'
        }, 1000, 'easeOutQuint');
      }
    },
    animationComplete: function() {
      $('.slides-h1').fadeTo(400,1);
      $('.slides-txt').fadeTo(400,1);
      if ($('.slides-phone').is(":visible")) {
        $('.slides-phone').animate({
          bottom:'+=900'
        }, 1000, 'easeOutQuint');
        $('.badge').animate({
          top:'+=45'
        }, 1000, 'easeOutQuint')
      }
      else {
        $('.slides-mini').animate({
          bottom:'+=900'
        }, 1000, 'easeOutQuint');
        $('.badge').animate({
          top:'-=45'
        }, 1000, 'easeOutQuint')
      }
    },
    container:'slides-container',
    crossfade:true,
    currentClass:'slides-curr',
    effect:'fade',
    fadeSpeed:500,
    generateNextPrev:true,
    next:'slides-next',
    paginationClass:'slides-pages',
    preload:true,
    prev:'slides-prev'
  });
  $(window).scroll(function(){
    var hdr = $('.l-hdr');
    if(hdr.offset().top !== 0){
      if(!hdr.hasClass('is-shadowed')){
        hdr.addClass('is-shadowed');
      }
    }else{
      hdr.removeClass('is-shadowed');
    }
  });
});


$(document).ready(function(){
$('#login-trigger').click(function(){
	$(this).next('#login-content').slideToggle();
	$(this).toggleClass('active');					
	
	if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
		else $(this).find('span').html('&#x25BC;')
	})
});


function requestInv(){
	document.getElementById('mes-err').innerHTML = '';
	mail = document.getElementById('email').value;
    var path = 'http://collecworld.com/';

	validateForm(mail);
	
	div = document.createElement('div');
	
	$(div).load(path+'ajax/subscribe.php',{mail:mail},function(){
		
		if ( div.innerHTML.search('ok') != -1 ){		
			document.getElementById('send-req-inv').innerHTML = '<br><h2 class="title-rq">We Will Write You Soon.! :)</h2>';
		}
		else{
			
			document.getElementById('send-req-inv').innerHTML = '<br><h2 class="title-rq">We already have your email.</h2>';
		}
		
	});	
}
	
function validateForm(email)
{
var x = email;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  document.getElementById('mes-err').innerHTML = 'Put a Valid Email Address';
  return false;
  }
}