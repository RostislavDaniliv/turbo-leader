<?php  
    if (get_post_meta( $post->ID, 'richer_source', true ) == 'vimeo') {  
        echo '<div class="post-video"><iframe src="http://player.vimeo.com/video/'.get_post_meta( $post->ID, 'richer_embed', true ).'?title=0&amp;byline=0&amp;portrait=0" width="960" height="540" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';  
    }  
    else if (get_post_meta( $post->ID, 'richer_source', true ) == 'youtube') {  
        echo '<div class="post-video"><iframe width="960" height="540" src="http://www.youtube.com/embed/'.get_post_meta( $post->ID, 'richer_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1" frameborder="0" allowfullscreen></iframe></div>';  
    }  
    else {  
        echo '<div class="post-video">'.get_post_meta( $post->ID, 'richer_embed', true ).'</div>'; 
    }  
?>	
	

