jQuery( document ).ready(function(){
	
	jQuery('.project').on("mouseover touchstart", function(){
	    jQuery(this).find("div.content").show();
	  
	});

	jQuery('.project').on("mouseover touchend", function(){
	    jQuery(this).find("div.content").hide();
	});

	jQuery('.pagelink').on("mouseover touchstart", function(){
	    jQuery(this).find("div.content").show();
	  
	});

	jQuery('.pagelink').on("mouseover touchend", function(){
	    jQuery(this).find("div.content").hide();
	});

});
