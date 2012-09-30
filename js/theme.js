// Standard Foundation Stuff

;(function ($, window, undefined) {
  'use strict';

  var $doc = $(document),
      Modernizr = window.Modernizr;

  $.fn.foundationAlerts           ? $doc.foundationAlerts() : null;
  $.fn.foundationButtons          ? $doc.foundationButtons() : null;
  $.fn.foundationAccordion        ? $doc.foundationAccordion() : null;
  $.fn.foundationNavigation       ? $doc.foundationNavigation() : null;
  $.fn.foundationTopBar           ? $doc.foundationTopBar() : null;
  $.fn.foundationCustomForms      ? $doc.foundationCustomForms() : null;
  $.fn.foundationTabs             ? $doc.foundationTabs({callback : $.foundation.customForms.appendCustomMarkup}) : null;
  $.fn.foundationTooltips         ? $doc.foundationTooltips() : null;

  $('input, textarea').placeholder();

  // Hide address bar on mobile devices
  if (Modernizr.touch) {
    $(window).load(function () {
      setTimeout(function () {
        window.scrollTo(0, 1);
      }, 0);
    });
  }

})(jQuery, this);


// Smooth Scroll

var jump=function(e)
{
       //prevent the "normal" behaviour which would be a "hard" jump
       e.preventDefault();
       //Get the target
       var target = $(this).attr("href");
       //perform animated scrolling
       $('html,body').animate(
       {
               //get top-position of target-element and set it as scroll target
               scrollTop: $(target).offset().top
       //scrolldelay: 2 seconds
       },800,function()
       {
               //attach the hash (#jumptarget) to the pageurl
               location.hash = target;
       });

}

$(document).ready(function()
{
       $('a[href*=#]').bind("click", jump);
       return false;
});


// Zilla Likes

jQuery(document).ready(function($){

	$('.zilla-likes').live('click',
	    function() {
    		var link = $(this);
    		if(link.hasClass('active')) return false;
		
    		var id = $(this).attr('id'),
    			postfix = link.find('.zilla-likes-postfix').text();
			
    		$.post(zilla_likes.ajaxurl, { action:'zilla-likes', likes_id:id, postfix:postfix }, function(data){
    			link.html(data).addClass('active').attr('title','You already like this');
    		});
		
    		return false;
	});
	
	if( $('body.ajax-zilla-likes').length ) {
        $('.zilla-likes').each(function(){
    		var id = $(this).attr('id');
    		$(this).load(zilla.ajaxurl, { action:'zilla-likes', post_id:id });
    	});
	}

});