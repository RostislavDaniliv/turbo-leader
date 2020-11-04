<?php 

/*
Pointer Functions

i18n Compatible

*/


//=========================================================================			
// Pointer Functions 
//=========================================================================			



 
function wptb_pointer_load( $hook_suffix ) {
 
    // Don't run on WP < 3.3
    if ( get_bloginfo( 'version' ) < '3.3' )
        return;
 
    $screen = get_current_screen();
    $screen_id = $screen->id;
 
    // Get pointers for this screen
    $pointers = apply_filters( 'wptb_admin_pointers-' . $screen_id, array() );
    
 
    if ( ! $pointers || ! is_array( $pointers ) )
        return;
  
    // Get dismissed pointers
    $dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
    $valid_pointers =array();
 
    // Check pointers and remove dismissed ones.
    foreach ( $pointers as $pointer_id => $pointer ) {
 
        // Sanity check
        if ( in_array( $pointer_id, $dismissed ) || empty( $pointer )  || empty( $pointer_id ) || empty( $pointer['target'] ) || empty( $pointer['options'] ) )
            continue;
 
        $pointer['pointer_id'] = $pointer_id;
 
        // Add the pointer to $valid_pointers array
        $valid_pointers['pointers'][] =  $pointer;
    }
    
 
    // No valid pointers? Stop here.
    if ( empty( $valid_pointers ) )
        return;
        
    // Add pointers style to queue.
    wp_enqueue_style( 'wp-pointer' );
 
    // Add pointers script to queue. Add custom script.
    wp_enqueue_script( 'wptb-pointer', plugins_url( './js/wp-topbar-pointers.js', __FILE__ ), array( 'wp-pointer' ) );
 
    // Add pointer options to script.
    wp_localize_script( 'wptb-pointer', 'wptbPointer', $valid_pointers );

}	// End of wptb_pointer_load 



function wptb_register_pointer( $p ) {
   // EDGE: On what edge do we want the pointer to appear. Options are 'top', 'left', 'right', 'bottom'
   // ALIGN: How do we want out custom pointer to align to the element it is attached to. Options are 'left', 'right', 'center'

 
    $p['525apointer1'] = array(
        'target' => '.wptb-table',
        'options' => array(
            'content' => sprintf( '<h3> %1$s </h3> <p> %2$s </p>',
                __( 'New Features in Version 5.25!' ,'wp-topbar'),
                __( 'Version 5.25 adds more options to control which TopBars are shown.<br/><br/>You can now have the TopBar excluded from sticky posts, pages, archives, and more - found on the Control Tab for each TopBar.<br/><br/>There is also a new PHP option to give you more granular control around which TopBars are selected to show — of course, use at your own risk - found on the PHP Tab for each TopBar','wp-topbar')
            ),
            'position' => array( 'edge' => 'top', 'align' => 'left' )
        )
    ); 
     $p['502pointer1'] = array(
        'target' => '.wptb-samples',
        'options' => array(
            'content' => sprintf( '<h3> %1$s </h3> <p> %2$s </p>',
                __( 'Samples!' ,'wp-topbar'),
                __( 'Check out these samples to see how you can customize your own TopBar.  You can copy any (or all) the samples for easy customizing to your needs.','wp-topbar')
            ),
            'position' => array( 'edge' => 'top', 'align' => 'left' )
        )
    );      
    
    
    return $p;
}


?>