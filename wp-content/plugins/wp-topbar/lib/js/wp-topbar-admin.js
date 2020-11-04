    function checkAll(checkId){
        var inputs = document.getElementsByTagName("input");
        var x=jQuery("#chk_new").is(":checked");
        if(x == false)
	        jQuery( ".wptbCheckBox" ).prop( "checked", false );
        else
	        jQuery( ".wptbCheckBox" ).prop( "checked", true );
          
    }
  
	function post_to_url(path, params, method) {
	    method = method || "post"; // Set method to post by default if not specified.
	
	    // The rest of this code assumes you are not using a library.
	    // It can be made less wordy if you use one.
	    var form = document.createElement("form");
	    form.setAttribute("method", method);
	    form.setAttribute("action", path);
	
	    for(var key in params) {
	        if(params.hasOwnProperty(key)) {
	            var hiddenField = document.createElement("input");
	            hiddenField.setAttribute("type", "hidden");
	            hiddenField.setAttribute("name", key);
	            hiddenField.setAttribute("value", params[key]);
	
	            form.appendChild(hiddenField);
	         }
	    }
	
	    document.body.appendChild(form);
	    form.submit();
	}   
    
    function processCheckBoxes() {

	    var selectedaction = jQuery( "#selectOpt" ).val(); //get value of dropdown selection
	    		/* declare an checkbox array */


		var selected = [];
		
		/* look for all checkboes that have a class 'wptbCheckBox' attached to it and check if it was checked */
		jQuery(".wptbCheckBox:checked").each(function() {
			selected.push(jQuery(this).val());
		});
		
		/* check if there is selected checkboxes, if so process them */
		if(selected.length > 0){
			myurl = MyAjax.ajaxurl + '&action=' + selectedaction;
			
			var params = new Array(); 
			params.barid = selected;		
//			alert(myurl + " | " + selectedaction + " | " + params.barid);
	
			post_to_url(myurl, params);
		}
	}
    
jQuery(document).ready(function() {



  jQuery(function () {
    jQuery("#footable").footable().bind('footable_filtering', function (e) {
      var selected = jQuery('.filter-status').find(':selected').text();
      if (selected && selected.length > 0) {
        e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
        e.clear = !e.filter;
      }
    });

    jQuery('.clear-filter').click(function (e) {
      e.preventDefault();
      jQuery('.filter-status').val('');
//      jQuery('#filter').val('');
      jQuery('table.demo').trigger('footable_clear_filter');
	jQuery('table').data('footable-filter').clearFilter;
      
    });

    jQuery('.option-select').change(function (e) {
      e.preventDefault();
      var selected = jQuery('.option-select').find(':selected').text();
      alert(selected);
    });
    
	jQuery('.rowoptions').bind('change', function () {
          var url = jQuery(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
	});    
    

    jQuery('.filter-status').change(function (e) {
      e.preventDefault();
      jQuery('table.demo').trigger('footable_filter', {filter: jQuery('#filter').val()});
    });

    jQuery('.filter-api').click(function (e) {
      e.preventDefault();

      //get the footable filter object
      var footableFilter = jQuery('table').data('footable-filter');

//      alert('about to filter table by "bob"');
      //filter by 'tech'
      footableFilter.filter('Bob');

      //clear the filter
      if (confirm('clear filter now?')) {
        footableFilter.clearFilter();
      }
    });
  });
//
//
//		

	jQuery("tr").not(':first').hover(
	  function () {
	      jQuery(this).find('.wptbactions').css("visibility","visible");
	  }, 
	  function () {
	      jQuery(this).find('.wptbactions').css("visibility","hidden");
	  }
	); 
    
	jQuery( "#radio0" ).buttonset();
	jQuery( "#radio1" ).buttonset();
	jQuery( "#radio2" ).buttonset();
	jQuery( "#radio3" ).buttonset();
	jQuery( "#radio4" ).buttonset();
	jQuery( "#radio5" ).buttonset();
	jQuery( "#radio6" ).buttonset();
	jQuery( "#radio7" ).buttonset();
	jQuery( "#radio8" ).buttonset();
	jQuery( "#radio9" ).buttonset();
	jQuery( "#radio10" ).buttonset();
	jQuery( "#radio11" ).buttonset();
	jQuery( "#radio12" ).buttonset();
	jQuery( "#radio13" ).buttonset();
	jQuery( "#radio14" ).buttonset();
	jQuery( "#radio15" ).buttonset();
	jQuery( "#radio16" ).buttonset();
	jQuery( "#radio17" ).buttonset();
	jQuery( "#radio18" ).buttonset();
	jQuery( "#radio19" ).buttonset();
	jQuery( "#radio20" ).buttonset();//
//
//
    jQuery( "#wptb-priority" ).slider({
	  value: jQuery("#priority").val(),
      min: 0,
      max: 100,
      step: 1,
      slide: function( event, ui ) {
        jQuery( "#priority" ).val( ui.value );
      }
    });

    jQuery( "#priority" ).val( jQuery( "#wptb-priority" ).slider( "value" ) );
   
	jQuery( "#priority" ).change(function() {
	    jQuery( "#wptb-priority" ).slider( "value", jQuery(this).val() );
	});   
//
//
//
   jQuery( "#wptb-rotatedisplaytime" ).slider({
	  value: jQuery("#rotatedisplaytime").val(),
      min: 0,
      max: 60000,
      step: 250,
      slide: function( event, ui ) {
        jQuery( "#rotatedisplaytime" ).val( ui.value );
      }
    });

    jQuery( "#rotatedisplaytime" ).val( jQuery( "#wptb-rotatedisplaytime" ).slider( "value" ) );
   
	jQuery( "#rotatedisplaytime" ).change(function() {
	    jQuery( "#wptb-rotatedisplaytime" ).slider( "value", jQuery(this).val() );
	}); 
//
//
//
   jQuery( "#wptb-rotatestartdelay" ).slider({
	  value: jQuery("#rotatestartdelay").val(),
      min: 0,
      max: 10000,
      step: 250,
      slide: function( event, ui ) {
        jQuery( "#rotatestartdelay" ).val( ui.value );
      }
    });

    jQuery( "#rotatestartdelay" ).val( jQuery( "#wptb-rotatestartdelay" ).slider( "value" ) );
   
	jQuery( "#rotatestartdelay" ).change(function() {
	    jQuery( "#wptb-rotatestartdelay" ).slider( "value", jQuery(this).val() );
	});  
	//
//
//
   jQuery( "#wptb-rotatecount" ).slider({
	  value: jQuery("#rotatecount").val(),
      min: 0,
      max: 100,
      step: 1,
      slide: function( event, ui ) {
        jQuery( "#rotatecount" ).val( ui.value );
      }
    });

    jQuery( "#rotatecount" ).val( jQuery( "#wptb-rotatecount" ).slider( "value" ) );
   
	jQuery( "#rotatecount" ).change(function() {
	    jQuery( "#wptb-rotatecount" ).slider( "value", jQuery(this).val() );
	});    
//
//
//
   jQuery( "#wptb-delayintime" ).slider({
	  value: jQuery("#delayintime").val(),
      min: 0,
      max: 60000,
      step: 250,
      slide: function( event, ui ) {
        jQuery( "#delayintime" ).val( ui.value );
      }
    });

    jQuery( "#delayintime" ).val( jQuery( "#wptb-delayintime" ).slider( "value" ) );
   
	jQuery( "#delayintime" ).change(function() {
	    jQuery( "#wptb-delayintime" ).slider( "value", jQuery(this).val() );
	});  
//
//
//   
   jQuery( "#wptb-slidetime" ).slider({
	  value: jQuery("#slidetime").val(),
      min: 0,
      max: 5000,
      step: 50,
      slide: function( event, ui ) {
        jQuery( "#slidetime" ).val( ui.value );
      }
    });

    jQuery( "#slidetime" ).val( jQuery( "#wptb-slidetime" ).slider( "value" ) );
   
	jQuery( "#slidetime" ).change(function() {
	    jQuery( "#wptb-slidetime" ).slider( "value", jQuery(this).val() );
	});   
//
//
//
   jQuery( "#wptb-displaytime" ).slider({
	  value: jQuery("#displaytime").val(),
      min: 0,
      max: 60000,
      step: 250,
      slide: function( event, ui ) {
        jQuery( "#displaytime" ).val( ui.value );
      }
    });

    jQuery( "#displaytime" ).val( jQuery( "#wptb-displaytime" ).slider( "value" ) );
   
	jQuery( "#displaytime" ).change(function() {
	    jQuery( "#wptb-displaytime" ).slider( "value", jQuery(this).val() );
	});   
//
//
//   
   jQuery( "#wptb-bottomborderheight" ).slider({
	  value: jQuery("#bottomborderheight").val(),
      min: 0,
      max: 500,
      step: 1,
      slide: function( event, ui ) {
        jQuery( "#bottomborderheight" ).val( ui.value );
      }
    });

    jQuery( "#bottomborderheight" ).val( jQuery( "#wptb-bottomborderheight" ).slider( "value" ) );
   
	jQuery( "#bottomborderheight" ).change(function() {
	    jQuery( "#wptb-bottomborderheight" ).slider( "value", jQuery(this).val() );
	});   
//
//
//   
   jQuery( "#wptb-paddingtop" ).slider({
	  value: jQuery("#paddingtop").val(),
      min: 0,
      max: 500,
      step: 1,
      slide: function( event, ui ) {
        jQuery( "#paddingtop" ).val( ui.value );
      }
    });

    jQuery( "#paddingtop" ).val( jQuery( "#wptb-paddingtop" ).slider( "value" ) );
   
	jQuery( "#paddingtop" ).change(function() {
	    jQuery( "#wptb-paddingtop" ).slider( "value", jQuery(this).val() );
	});   
//
//
//   
   jQuery( "#wptb-paddingbottom" ).slider({
	  value: jQuery("#paddingbottom").val(),
      min: 0,
      max: 500,
      step: 1,
      slide: function( event, ui ) {
        jQuery( "#paddingbottom" ).val( ui.value );
      }
    });

    jQuery( "#paddingbottom" ).val( jQuery( "#wptb-paddingbottom" ).slider( "value" ) );
   
	jQuery( "#paddingbottom" ).change(function() {
	    jQuery( "#wptb-paddingbottom" ).slider( "value", jQuery(this).val() );
	});   
//
//
//

   jQuery( "#wptb-margintop" ).slider({
	  value: jQuery("#margintop").val(),
      min: -500,
      max: 500,
      step: 1,
      slide: function( event, ui ) {
        jQuery( "#margintop" ).val( ui.value );
      }
    });

    jQuery( "#margintop" ).val( jQuery( "#wptb-margintop" ).slider( "value" ) );
   
	jQuery( "#margintop" ).change(function() {
	    jQuery( "#wptb-margintop" ).slider( "value", jQuery(this).val() );
	});   
//
//
//	
   jQuery( "#wptb-marginbottom" ).slider({
	  value: jQuery("#marginbottom").val(),
      min: -500,
      max: 500,
      step: 1,
      slide: function( event, ui ) {
        jQuery( "#marginbottom" ).val( ui.value );
      }
    });

    jQuery( "#marginbottom" ).val( jQuery( "#wptb-marginbottom" ).slider( "value" ) );
   
	jQuery( "#marginbottom" ).change(function() {
	    jQuery( "#wptb-marginbottom" ).slider( "value", jQuery(this).val() );
	});   
//
//
//
   jQuery( "#wptb-marginleft" ).slider({
	  value: jQuery("#marginleft").val(),
      min: -500,
      max: 500,
      step: 1,
      slide: function( event, ui ) {
        jQuery( "#marginleft" ).val( ui.value );
      }
    });

    jQuery( "#marginleft" ).val( jQuery( "#wptb-marginleft" ).slider( "value" ) );
   
	jQuery( "#marginleft" ).change(function() {
	    jQuery( "#wptb-marginleft" ).slider( "value", jQuery(this).val() );
	});   
//
//
//
   jQuery( "#wptb-marginright" ).slider({
	  value: jQuery("#marginright").val(),
      min: -500,
      max: 500,
      step: 1,
      slide: function( event, ui ) {
        jQuery( "#marginright" ).val( ui.value );
      }
    });

    jQuery( "#marginright" ).val( jQuery( "#wptb-marginright" ).slider( "value" ) );
   
	jQuery( "#marginright" ).change(function() {
	    jQuery( "#wptb-marginright" ).slider( "value", jQuery(this).val() );
	});   
//
//
//
   jQuery( "#wptb-fontsize" ).slider({
	  value: jQuery("#fontsize").val(),
      min: 0,
      max: 148,
      step: 1,
      slide: function( event, ui ) {
        jQuery( "#fontsize" ).val( ui.value );
      }
    });

    jQuery( "#fontsize" ).val( jQuery( "#wptb-fontsize" ).slider( "value" ) );
   
	jQuery( "#fontsize" ).change(function() {
	    jQuery( "#wptb-fontsize" ).slider( "value", jQuery(this).val() );
	});   
//
//
//		
   jQuery( "#wptb-scroll-amount" ).slider({
	  value: jQuery("#scrollamount").val(),
      min: 0,
      max: 5000,
      step: 5,
      slide: function( event, ui ) {
        jQuery( "#scrollamount" ).val( ui.value );
      }
    });

    jQuery( "#scrollamount" ).val( jQuery( "#wptb-scroll-amount" ).slider( "value" ) );
   
	jQuery( "#scrollamount" ).change(function() {
	    jQuery( "#wptb-scroll-amount" ).slider( "value", jQuery(this).val() );
	}); 
//
//
//
	jQuery('#wptbstarttimebtnClear').click( function(e) {jQuery('#wptbstarttimebtn').val('').change(); } );
	jQuery('#wptbtimebtnClear').click( function(e) {jQuery('#wptbendtimebtn').val('').change(); } );
	
	jQuery('#wptbstarttimebtn').datetimepicker( {
		addSliderAccess: true,
		sliderAccessArgs: { touchonly: false }

	});
	jQuery('#wptbendtimebtn').datetimepicker( {
		addSliderAccess: true,
		sliderAccessArgs: { touchonly: false }

	});
//	jQuery('#wptbstarttimebtn').datetimepicker({timeFormat: 'hh:mm tt z'});
//	jQuery('#wptbendtimebtn').datetimepicker({timeFormat: 'hh:mm tt z'});



    
});
