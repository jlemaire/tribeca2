jQuery.fn.extend({
  haccordion: function(params){  	
    var jQ = jQuery;
    var params = jQ.extend({
      speed: 900,
      headerclass: 'header',
      contentclass: 'content',
      // Add live-resizeable: someday
      callback: '',
      firstopen: null,
      load: '',
      easing: ''
    }, params);
    
    
    // hAccordion Logic
    function accordionLogic(that) {
   		// Parent Element	      	  	
        var p = jQ(that).parent()[0];
        
        // Width of Parent Element (eventually update this value with $(window).resize() event;)
        var p_width = $(p).width();
      	
		// Total Number of Headers for specific container
		var number_of_headers = $('.' + params.headerclass, p).length;
				
		// Total Width of an Individual Header
		var width_of_header = $(that).width();
		
		// Total, combined width of all headers
		var total_width_of_headers = width_of_header * number_of_headers;   
                
		// Sliding Action
        if (p.opened != 'undefined'){
          jQ(p.opened).next('div.' + params.contentclass).stop().animate({
            width:'0px'
          }, params.speed, params.easing);
        }
        
        p.opened = that;
        jQ(that).next('div.' + params.contentclass).stop().animate({
          width: p_width - total_width_of_headers
        }, params.speed, params.easing, params.callback);
    }
    
    // Plugin Logic
    return this.each(function(){  
      
      // Basic hAccordion Functionality
      jQ('.' + params.headerclass, this).click(function(event){
      	event.preventDefault();
      	 
      	accordionLogic(this);
      	
      });
      
	  // After DOM loads
	  $(document).ready(function() {
		  //If a firstopen parameter is present
		  if (params.firstopen !== null) {
		
			// Store the original speed parameter
			var original_speed = params.speed;
			// Set the speed of the first open to zero (because we don't want it to slide every time it loads)
			params.speed = 0;
			// Onload, click the defined firstopen parameter
			jQ('.' + params.headerclass + ':eq(' + params.firstopen + ')', this).click();
			
			// Reset the global slidespeed back to the original speed
			params.speed = original_speed;	   
		  }
		
	  });
      
    });
     
  }
});


