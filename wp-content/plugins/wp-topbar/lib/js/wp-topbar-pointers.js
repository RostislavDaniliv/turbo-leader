jQuery(document).ready( function($) {

	for(var i in wptbPointer.pointers) {
		wptb_open_pointer(i);
	}
    
    function wptb_open_pointer(i) {
        pointer = wptbPointer.pointers[i];
        options = $.extend( pointer.options, {
            close: function() {
                $.post( ajaxurl, {
                    pointer: pointer.pointer_id,
                    action: 'dismiss-wp-pointer'
                });
            }
        });
 
        $(pointer.target).pointer( options ).pointer('open');
    }
});
