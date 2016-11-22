jQuery( document ).ready(function(){
	
	jQuery('.project').mouseover(function(){
	    jQuery(this).find("div.content").show();
	  
	});

	jQuery('.project').mouseout(function(){
	    jQuery(this).find("div.content").hide();
	});


	jQuery('.pagelink').mouseover(function(){
	    jQuery(this).find("div.content").show();
	  
	});

	jQuery('.pagelink').mouseout(function(){
	    jQuery(this).find("div.content").hide();
	});


});
