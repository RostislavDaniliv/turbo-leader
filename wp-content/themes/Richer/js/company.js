jq(document).ready(function(){

	// плавный скролл
	jq('.scrollMenu .button-item a').click(function(event){
	    event.preventDefault();
	    var target_offset = jq(this.hash).offset() ? jq(this.hash).offset().top : 0;
	    //change this number to create the additional off set        
	    var customoffset = 0;
	    jq('html, body').animate({scrollTop:target_offset - customoffset}, 500);
	});



});