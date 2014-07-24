jQuery(document).ready(function(){
	"use strict";	
	
	//Navigation
	jQuery('#nav').onePageNav({
		currentClass:'current',
		changeHash:false,
		scrollSpeed:800,
		scrollOffset:20
	});

	
	
	  jQuery('#slides').slidesjs({
	  	start: 1,
	    width: 940,
	    height: 240,
	    
	    pagination: {
	    	active: true,
	    	effect: "fade"
	    },
    
	    navigation: {
	    	active: false,
	   	},
	   	
	    play: {
	      active: true,
	      auto: true,
	      interval: 5000,
	      effect: "fade",
	      swap: false,
	    },
	    
	    effect: {
	       fade: {
	       	speed: 750
	    }
	    
	   }
	  });
	
	

	//Modal Window
// 	jQuery('.diamond').dialog();
//
// 	jQuery('#foo').dialog({
//		appearence	: null,
//		applyClass	: 'fade'
//	});


	//Dropdown Form
	jQuery(".chosen-select").chosen({
		width: "100%",
		disable_search_threshold: 10
	});

	//Calendar
	jQuery('.datepicker').datepicker({  
            inline: true,  
            showOtherMonths: true,  
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],  
    }); 


});