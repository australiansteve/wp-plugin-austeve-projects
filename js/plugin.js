jQuery( document ).ready(function(){
	
	jQuery('.project').on("mouseover touchstart", function(){
	    jQuery(this).find("div.content").show();
	  
	});

	jQuery('.project').on("mouseover touchend", function(){
	    jQuery(this).find("div.content").hide();
	});
	
});
