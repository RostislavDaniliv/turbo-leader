<?php
/* ------------------------------------------------------------------------ */
/* Translation
/* ------------------------------------------------------------------------ */

/* ------------------------------------------------------------------------ */
/* Translations can be filed in the framework/languages/ directory */
load_theme_textdomain( 'richer', get_template_directory() . '/languages' );
load_theme_textdomain( 'richer-framework', get_template_directory() . '/languages' );
load_theme_textdomain( 'richer-builder', get_template_directory() . '/languages' );

$locale = get_locale();
$locale_file = get_template_directory() . "/framework/languages/$locale.php";
if ( is_readable($locale_file) )
	    require_once($locale_file);  
/* ------------------------------------------------------------------------ */
/* Inlcudes
/* ------------------------------------------------------------------------ */
	
	//tinyMCE includes
	include_once('framework/inc/tinymce/tinymce-shortcodes.php');
	/* ------------------------------------------------------------------------ */
	/* Include SMOF */
	require_once('admin/index.php'); // Slightly Modified Options Framework
	/* ------------------------------------------------------------------------ */
	//auto upadtes
	load_template( trailingslashit( get_template_directory() ) . 'framework/envato-theme-update/envato-wp-theme-updater.php' );
	global $options_data;
	$username = isset($options_data['username']) ? $options_data['username'] : '';
	$apikey = isset($options_data['apikey']) ? $options_data['apikey'] : '';
	$author = 'ArtstudioWorks';
	Envato_WP_Theme_Updater::init( $username, $apikey, $author );

	/* Misc Includes */
	include_once('framework/inc/googlefonts.php'); // Enqueue google fonts
	include_once('framework/inc/enqueue.php'); // Enqueue JavaScripts & CSS

	include_once('framework/inc/customjs.php'); // Load Custom JS
	include_once('framework/inc/sidebars.php'); // Generated Sidebars
	include_once('framework/inc/sidebar-generator.php'); // Include Sidebar Generator
	include_once('framework/inc/breadcrumbs.php'); // Load Breadcrumbs

	include_once('framework/inc/shortcodes.php'); // Load Shortcodes
	include_once('framework/inc/cpt-portfolio.php'); // Portfolio
	include_once('framework/inc/cpt-testimonial.php'); // Testimonial
	/* ------------------------------------------------------------------------ */
	/* Widget Includes */
	include_once('framework/inc/widgets/embed.php');
	include_once('framework/inc/widgets/facebook.php');
	include_once('framework/inc/widgets/flickr.php');
	include_once('framework/inc/widgets/instagram.php');
	include_once('framework/inc/widgets/sponsor.php');
	include_once('framework/inc/widgets/twitter.php');
	include_once('framework/inc/widgets/contact.php');
	include_once('framework/inc/widgets/portfolio.php');
	include_once('framework/inc/widgets/latestposts.php');

	if(class_exists('Woocommerce')) {
		include_once('framework/inc/widgets/featured_products.php');
		include_once('woocommerce/woocommerce-config.php');
	}

	require_once('API/userAPI.php');


	function colorpicker(){ 
	  wp_enqueue_style( 'wp-color-picker');
	  wp_enqueue_script( 'wp-color-picker');
	}
	add_action('admin_enqueue_scripts', 'colorpicker'); 
	/* ------------------------------------------------------------------------ */
	/* Include Meta Box Script */
    define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/framework/inc/meta-box' ) );
    define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/framework/inc/meta-box' ) );
    require_once RWMB_DIR . 'meta-box.php';
   	add_action('init','include_meta_boxes',1);
    function include_meta_boxes(){
    	include 'framework/inc/meta-boxes.php';
    }
    if(class_exists('WPBakeryVisualComposerAbstract')) include_once('framework/inc/vc-shortcodes.php'); // Load Visual Composer Shortcodes

    include_once('framework/importer/importer.php');
    /* ------------------------------------------------------------------------ */
	/* Automatic Plugin Activation */
	require_once('framework/inc/plugin-activation.php');
	
	add_action('tgmpa_register', 'richer_register_required_plugins');
	function richer_register_required_plugins() {
		$plugins = array(

			array(
            	'name'      => 'Contact Form 7',
            	'slug'      => 'contact-form-7',
				'source'   				=> 'http://artstudioworks.net/recommended-plugins/contact-form-7.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
            ),
            array(
            	'name'      => 'Revolution Slider',
            	'slug'      => 'revslider',
				'source'   				=> 'http://artstudioworks.net/recommended-plugins/revslider.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
            ),
            array(
            	'name'      => 'Visual Composer',
            	'slug'      => 'js_composer',
				'source'   				=> 'http://artstudioworks.net/recommended-plugins/js_composer.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '4.1.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
            ),
		);
	
		// Change this to your theme text domain, used for internationalising strings
		$theme_text_domain = 'richer-framework';
	
		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
			'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
				'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
				'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);
	
		tgmpa($plugins, $config);
		
	}

/* ------------------------------------------------------------------------ */
/* Basics
/* ------------------------------------------------------------------------ */
	
	function richer_comment( $comment, $args, $depth ) {
	   $GLOBALS['comment'] = $comment; ?>
	
	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	   <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix"> 
	   		
	   		<div class="avatar"><?php echo get_avatar($comment, $size = '50'); ?></div>
	         
	         <div class="comment-text">
				 <div class="alignright"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
				 <div class="author">
				 	<strong><?php printf( __( '%s', 'richer-framework'), get_comment_author() ) ?></strong>
				 	<div class="date-comment">
				 		<?php printf(__('%1$s at %2$s', 'richer-framework'), get_comment_date(),  get_comment_time() ) ?></a><?php edit_comment_link( __( '(Edit)', 'richer-framework'),' ','' ) ?>
				 	</div>  
				</div>
				<div class="text clearfix">
				<?php comment_text() ?>
				<?php if ( $comment->comment_approved == '0' ) : ?>
			        <em><?php _e( 'Your comment is awaiting moderation.', 'richer-framework') ?></em>
			        <br />
		      	<?php endif; ?>
		      </div>
	      	</div>
	   </div>
	<?php
	}

   /* ------------------------------------------------------------------------ */
   /* Pagination */
   
   function pagination($pages = '', $range = 4) {
		$showitems = ($range * 2)+1;
		$out ='';
		global $paged;
		if(empty($paged)) $paged = 1;
		
		if($pages == '') {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages) {
				$pages = 1;
			}
		}
		
		if(1 != $pages) {
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) $out .= "<a href='".get_pagenum_link(1)."'>&laquo; " . __('First', 'richer-framework') . "</a>";
			if($paged > 1) $out .= "<a class=\"previous\" href='".get_pagenum_link($paged - 1)."'>" . __('Previous', 'richer-framework') . "</a>";
			
			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
					$out .= ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
				}
			}
		
			if ($paged < $pages) $out .= "<a class=\"next\" href=\"".get_pagenum_link($paged + 1)."\">". __('Next', 'richer-framework') . "</a>";
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) $out .= "<a href='".get_pagenum_link($pages)."'>" . __('Last', 'richer-framework') . " &raquo;</a>";
		}
		return $out;
	}
	
	/* ------------------------------------------------------------------------ */
	// The excerpt based on words
	function my_string_limit_words($string, $word_limit)
	{
	  $string = strip_tags($string, '<p>');
	  $words = explode(' ', $string, ($word_limit + 1));
	  if(count($words) > $word_limit)
	  	array_pop($words);
	  return implode(' ', $words);
	}

	function my_custom_excerpt($text) {
		global $post;
		global $options_data;
		if ($text ==  '') {
			$text = get_the_content('');
			$text = apply_filters('the_content', $text);
			$text = str_replace('\]\]\>', ']]>', $text);
			$fulltext = str_replace('\]\]\>', ']]>', $text);
			$text = strip_tags($text, '<p>');
			$excerpt_length = $options_data['text_excerptlength'];
			$words = explode(' ', $text, $excerpt_length + 1);
			if (count($words) > $excerpt_length) {
				array_pop($words);
				$text = implode(' ', $words);
			}
			else {
				$text = $fulltext;
			}
		}
		return $text;
	}
	remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	add_filter('get_the_excerpt', 'my_custom_excerpt');
	/* ------------------------------------------------------------------------ */
	/* Post Thumbnails */
	if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );
	
	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'standard', 875, 410, true );			// standard Blog Image (for span8 width)
		add_image_size( 'span12', 1170, 420, true ); 			// for portfolio wide
		add_image_size( 'span8', 770, 400, true );				// for portfolio side-by-side
		add_image_size( 'span4', 470, 340, true ); 				// perfect for responsive - adjust height in CSS
		add_image_size( 'span4-tall', 470, 640, true ); 		//
		add_image_size( 'span4-square', 470, 485, true ); 		// 
		add_image_size( 'span4-thin', 470, 240, true );			// 
		add_image_size( 'mini', 160, 160, true ); 				// used for widget thumbnail

		function pw_show_image_sizes($sizes) {
		$sizes['span4'] = __( 'Extra thumbnail', 'richer' );	
	    $sizes['standard'] = __( 'Standard', 'richer' );
	    $sizes['span12'] = __( 'Fullwidth large', 'richer' );
		    return $sizes;
		}
		add_filter('image_size_names_choose', 'pw_show_image_sizes');
	}
	/* ------------------------------------------------------------------------ */
	function remove_pages_from_search() {
    global $wp_post_types;
    global $options_data;
    if(isset($options_data['check_excludepages']) && $options_data['check_excludepages'] != 0){
    	$check = true;
    } else {
    	$check = false;
    }
    $wp_post_types['page']->exclude_from_search = $check;
	}
	add_action('init', 'remove_pages_from_search');
	/* ------------------------------------------------------------------------ */

	/* Define Content Width */
	if ( ! isset( $content_width ) )
    	$content_width = 1170;
	function mytheme_adjust_content_width() {
	    global $content_width;
		if ( is_page_template( 'page.php' ) || is_page_template( 'page-sidebar-left.php' ) || is_page_template( 'page-side-navigation.php' ) )
	    $content_width = 875;
	}
	add_action( 'template_redirect', 'mytheme_adjust_content_width' );
	
	/* ------------------------------------------------------------------------ */
	/* Add RSS Links to head section */
	add_theme_support( 'automatic-feed-links' );
	
	/* ------------------------------------------------------------------------ */
	/* WP 3.1 Post Formats */
	add_theme_support( 'post-formats', array('image', 'gallery', 'link', 'quote', 'audio', 'video')); 	
	
	/* ------------------------------------------------------------------------ */
	/* Add Custom Primary Navigation */
	add_action('init', 'register_custom_menu');
 
	function register_custom_menu() {
		register_nav_menu('main_navigation', 'Main Navigation');
		register_nav_menu('footer_navigation', 'Footer Navigation');
		register_nav_menu('top_bar_navigation', 'Top Bar Navigation');
		register_nav_menu('aside_navigation', 'Sidebar Navigation');
	}
	/* ------------------------------------------------------------------------ */

function HexToRGB($hex, $grad=0) {
	$hex = preg_replace("/#/", "", $hex);
	$color = array();

	if(strlen($hex) == 3) {
		$color['r'] = hexdec(substr($hex, 0, 1) . $r)+$grad;
		$color['g'] = hexdec(substr($hex, 1, 1) . $g)+$grad;
		$color['b'] = hexdec(substr($hex, 2, 1) . $b)+$grad;
	}
	else if(strlen($hex) == 6) {
		$color['r'] = hexdec(substr($hex, 0, 2))+$grad;
		$color['g'] = hexdec(substr($hex, 2, 2))+$grad;
		$color['b'] = hexdec(substr($hex, 4, 2))+$grad;
	}

	return implode(",", $color);
}
function overlay_link($randomid) {
	global $wpdb, $post;
    $meta = get_post_meta( get_the_ID( ), 'richer_screenshot', false );
    if ( !is_array( $meta ) )
    	$meta = ( array ) $meta;
    if ( !empty( $meta ) ) {
    	$meta = implode( ',', $meta );
    	$images = $wpdb->get_col( "
    	SELECT ID FROM $wpdb->posts
    	WHERE post_type = 'attachment'
    	AND ID IN ( $meta )
    	ORDER BY menu_order ASC
    	" );
    }
	// Define if Lightbox Link or Not 
        if( get_post_meta( get_the_ID(), 'richer_embed', true ) != "" && get_post_meta( get_the_ID(), 'richer_portfolio-lightbox', true ) == "true") { 
             $overlay_link = '<span class="overlay-link"><i class="fa fa-caret-square-o-right"></i></span>';
            if ( get_post_meta( get_the_ID(), 'richer_source', true ) == 'youtube' ) {
              $link_video = '<a href="http://www.youtube.com/watch?v='.get_post_meta( get_the_ID(), 'richer_embed', true ).'" class="prettyPhoto" rel="prettyPhoto" title="'. get_the_title() .'">';
              } else if ( get_post_meta( get_the_ID(), 'richer_source', true ) == 'vimeo' ) {
                $link_video = '<a href="http://vimeo.com/'. get_post_meta( get_the_ID(), 'richer_embed', true ) .'" class="prettyPhoto" rel="prettyPhoto" title="'. get_the_title() .'">';
              } else if ( get_post_meta( get_the_ID(), 'richer_source', true ) == 'own' ) {
                $link_video = '<a href="#embedd-video-'.$randomid.'" class="prettyPhoto" title="'. get_the_title() .'" rel="prettyPhoto">';
                $embedd = '<div id="embedd-video-'.$randomid.'" class="embedd-video"><p>'. get_post_meta( get_the_ID(), 'richer_embed', true ) .'</p></div>';
            }
            $overlay_link = $link_video.$overlay_link.'</a>';
        } elseif( has_post_thumbnail() && get_post_meta( get_the_ID(), 'richer_portfolio-lightbox', true ) == "true") {
          $overlay_link = '<span class="overlay-link"><i class="fa fa-search-plus"></i></span>';    
          /* $images is now a object that contains all images (related to post id 1) and their information ordered like the gallery interface. */
          $out_images = '';
          if ( isset($images) ) {
            //looping through the images
            
            foreach( $images as $image ) :  
				$src = wp_get_attachment_image_src( $image, 'full' );
				$out_images .= '<a style="display:none;" href="'.$src[0].'" rel="prettyPhoto[portfolio-'.$randomid.']"></a>';
			 endforeach;
          }
          $link_img = '<a href="'. wp_get_attachment_url( get_post_thumbnail_id() ) .'" class="prettyPhoto" rel="prettyPhoto[portfolio-'.$randomid.']" title="'. get_the_title() .'">';
          $overlay_link = $link_img.$overlay_link.'</a>'.$out_images;
        } else {
          $overlay_link = '<span class="overlay-link"><i class="fa fa-share-square-o"></i></span>';
          $link = '<a href="'. get_permalink() .'" title="'. get_the_title() .'">';
          $overlay_link = $link.$overlay_link.'</a>';
        }
    return $overlay_link;    
}
function my_get_comments_count() {
	$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = __('No Comments','richer-framework');
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . __(' Comments','richer-framework');
		} else {
			$comments = __('1 Comment','richer-framework');
		}
		$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
	} else {
		if ( $num_comments == 0 ) {
			$comments = __('No Comments','richer-framework');
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . __(' Comments','richer-framework');
		} else {
			$comments = __('1 Comment','richer-framework');
		}
		$write_comments =  $comments;
	}
	return $write_comments;
}

function my_url($url) {
  $value = $url;
  if (substr($value, 0, 7) == "http://") return $value;
  return "http://" . $value;
}

add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
function posts_columns($defaults){
    $defaults['riv_post_thumbs'] = __('Thumbs','richer-framework');
    return $defaults;
}
function posts_custom_columns($column_name, $id){
        if($column_name === 'riv_post_thumbs'){
        	$width = (int) 35;
			$height = (int) 35;
			$thumbnail_id = get_post_meta( get_the_ID(), '_thumbnail_id', true );
			
			// Display the featured image in the column view if possible
			if ( $thumbnail_id ) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset( $thumb ) ) {
				echo $thumb;
			} else {
				echo __('None', 'richer-framework');
			}
    }
}

add_action( 'init', 'richer_page_keywords', 0 );
function richer_page_keywords(){
	$labels = array(
		'name'              => __("Keywords",'richer-framework'),
		'singular_name'     => __("keyword",'richer-framework'),
		'search_items'      => __( 'Search Keywords','richer-framework'),
		'all_items'         => __( 'All Keywords','richer-framework'),
		'parent_item'       => __( 'Parent keyword','richer-framework' ),
		'parent_item_colon' => __( 'Parent keyword:','richer-framework' ),
		'edit_item'         => __( 'Edit keyword','richer-framework' ),
		'update_item'       => __( 'Update keyword','richer-framework' ),
		'add_new_item'      => __( 'Add New keyword','richer-framework' ),
		'new_item_name'     => __( 'New keyword Name','richer-framework' ),
		'menu_name'         => __( 'Keywords','richer-framework' )
	);
	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'rewrite'           => true
	);
	register_taxonomy("page_keywords", array("page"), $args);
}

add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
  return is_array($var) ? array() : '';
}

//WPML compatibility
function richer_wpml_translate_filter( $name, $value ) {
	if ( function_exists('icl_translate') ) {
		return icl_translate( 'richer', 'richer_' . $name, $value );
	} else {
		return $value;
	}
}
//Check if WPML is activated
add_filter( 'richer_text_translate', 'richer_wpml_translate_filter', 10, 2 );

function cc_mime_types( $mimes ){
	$mimes['eot'] = 'font/eot';
	$mimes['woff'] = 'font/woff';
	$mimes['ttf'] = 'font/ttf';
	$mimes['svg'] = 'font/svg';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );
remove_filter( 'the_content', 'wptexturize' );// remove this line for wordpress version less than 4.0 and higher than 4.0

add_post_type_support( 'testi', 'author' );
add_post_type_support( 'portfolio', 'author' );
/*--------------------------------------------------------*/
if(!function_exists('font_style')){	
	function font_style($style) {
		switch ($style) {
			case 'italic':
				return "font-style: italic; font-weight: normal;";
				break;
			case '600':
				return "font-weight: 600;";
				break;
			case '600 italic':
				return "font-style: italic; font-weight: 600;";
				break;
			case 'bold':
				return "font-weight: bold;";
				break;
			case 'bold italic':
				return "font-style: italic; font-weight: bold;";
				break;	
			default:
				return "";
				break;
		}
	}
}
/*--------------------------------------------------------*/
if(!function_exists('asw_compress')){
	function asw_compress( $minify ) 
	{
	/* remove comments */
		$minify = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $minify );

	    /* remove tabs, spaces, newlines, etc. */
		$minify = str_replace( array("\r\n", "\r", "\n", "\t", '; ', '  ', '    ', '    ',': ', ', ','{ '), array('','','','',';','','','',':',',','{'), $minify );
			
	    return $minify;
	}
}
/*--------------------------------------------------------*/
if(!function_exists('asw_page_custom_style')){
	function asw_page_custom_style () {
		global $options_data;
		$out = '<style type="text/css" id="custom-style">';
		if($options_data['select_layoutstyle'] == 'boxed' || $options_data['select_layoutstyle'] == 'framed' || $options_data['select_layoutstyle'] == 'rounded' ) {
			// Specific Page Background defined 

			if( get_post_meta( get_the_ID(), 'richer_bgurl', true ) != '' ) {
				$out .= 'body.page-ig-'.get_the_ID().' {';
				$images = rwmb_meta( 'richer_bgurl', 'type=image' );
				if(!empty($images)){
					foreach ( $images as $image )
					{
						$src = $image['full_url'];
						break;
					}
				}
				
				if(get_post_meta( get_the_ID(), 'richer_bgcolor', true )) { $out .= 'background-color: '.get_post_meta( get_the_ID(), 'richer_bgcolor', true ).';';}
				if(get_post_meta( get_the_ID(), 'richer_bgurl', true )) { $out .= 'background-image: url('.$src.');background-position:'.get_post_meta( get_the_ID(), 'richer_bg_position_x', true ).' '.get_post_meta( get_the_ID(), 'richer_bg_position_y', true ).';';}
				if(get_post_meta( get_the_ID(), 'richer_bgstyle', true ) != 'stretch') { 
					echo $out .= 'background-repeat: '.get_post_meta( get_the_ID(), 'richer_bgstyle', true ).';'; 
				} else { 
					echo $out .= '-webkit-background-size: 100% auto; -moz-background-size: 100% auto; -o-background-size: cover; background-size: 100% auto; background-attachment: fixed;';  
				}
				if(get_post_meta( get_the_ID(), 'richer_bg_fixed', true ) != 0){
					$out .= 'background-attachment: fixed;';
				}
				$out .= '}';
			} // EOF Specific BG
			// If No Specific Page Background take Defaults
			else {
				$out .= 'body {';
				if($options_data['color_bg'] != "") { $out .= 'background-color: '. $options_data['color_bg'] .';'; }
				if($options_data['media_bg'] != "") { 
					$out .= 'background-image: url('.$options_data['media_bg'].'); 
					background-position:'.$options_data['body_background_options']['position-x'].' '.$options_data['body_background_options']['position-y'].';
					background-attachment:'.$options_data['body_background_options']['attachment'].';
					background-repeat:'.$options_data['body_background_options']['repeat'].';'; 
				} 
				if($options_data['body_background_size'] == 1) { 
					$out .= '-webkit-background-size: 100% auto; -moz-background-size: 100% auto; -o-background-size: cover; background-size: 100% auto;background-attachment: fixed;'; 
				}
				$out .= '}';
			} // EOF Default BG
			
			
		}
		$out .= '</style>'; 
		echo asw_compress($out);
	}
	add_action( 'wp_head', 'asw_page_custom_style', 100 );	
}
/*--------------------------------------------------------*/
if(!function_exists('asw_css_folder_writable')) {
	/**
	 * Function that checks if css folder is writable
	 */
	function asw_css_folder_writable() {
		$upload_dir = wp_upload_dir();
		$css_dir = $upload_dir['basedir'].'/caches/';
		return is_writable($css_dir);
	}
}
if (!function_exists('asw_generate_custom_css')){
	/**
	 * Function that gets content of dynamic assets files and puts that in static ones
	 */
	function asw_generate_custom_css() {
		$options_data = of_get_options();
		$upload_dir = wp_upload_dir();
		$css_dir = $upload_dir['basedir'].'/caches/';
		if (!asw_css_folder_writable()) {
		    mkdir($css_dir, 0777, true);
		}
		if(asw_css_folder_writable()) {
			ob_start();
			include_once(get_template_directory().'/framework/inc/customcss.php');
			$css = ob_get_clean();
			file_put_contents($css_dir.'style_dynamic.css', $css, LOCK_EX);
		}
	}
	add_action('of_save_options_after', 'asw_generate_custom_css');
}

// Echo theme's meta data if enabled
if(!function_exists('asw_header_meta')) {
	/**
	 * Function that echoes meta data if our seo is enabled
	 */
	function asw_header_meta() {
		global $options_data;
		$metas = '';
		if(!isset($options_data['check_seodisable']) || $options_data['check_seodisable'] != 1 ) {
			$meta_description = esc_html(get_post_meta(get_the_ID(), "richer_meta_description", true));
			$meta_keywords = esc_html(get_post_meta(get_the_ID(), "richer_meta_keywords", true));
			if($meta_description) { 
				$metas .= '<meta name="description" content="'.$meta_description.'">'."\r\n";
			} else if(isset($options_data['meta_description']) && $options_data['meta_description']){
				$metas .= '<meta name="description" content="'.$options_data['meta_description'].'">'."\r\n";
			} else {
				$metas .= '<meta name="description" content="'.get_bloginfo('name').' - '.get_bloginfo('description').'">'."\r\n";
			}
			if($meta_keywords) {
				$metas .= '<meta name="keywords" content="'.$meta_keywords.'">'."\r\n";
			} else if(isset($options_data['meta_keywords']) && $options_data['meta_keywords']){
				$metas .= '<meta name="keywords" content="'.$options_data['meta_keywords'].'">'."\r\n";
			} else {
				$keywords = '';
				$terms = get_terms( array('post_tag','category','portfolio_filter'), array('orderby' => 'count', 'order' => 'DESC', "fields" => "names", 'number'=> 9) );
				$keywords = implode(', ', $terms);
				$metas .= '<meta name="keywords" content="'.$keywords.'">'."\r\n";
			}
		}
		echo $metas;
	}
	add_action('asw_header_meta', 'asw_header_meta');
}
/* ------------------------------------------------------------------------ */
/* EOF
/* ------------------------------------------------------------------------ */
/**
 * User functions
 */
/**
 * Get the current user's ID
 *
 * @since MU
 *
 * @return int The current user's ID
 */
function get_current_user_id_by_user() {
	//if ( ! function_exists( 'wp_get_current_user' ) )
		//return 0;
	$user = wp_get_current_user();
	return ( isset( $user->ID ) ? (int) $user->ID : 0 );
}

function info_user() {
foreach (getallheaders() as $name => $value) {

	if ($name == 'Referer') $key = $value;

}

//if (base64_decode($key) === 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLm9yZyIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUuY29tIiwiaWF0IjoxMzU2OTk5NTI0LCJuYmYiOjEzNTcwMDAwMDAsImRhdGEiOnsiaWQiOiI5IiwiZmlyc3RuYW1lIjoiTWlrZSIsImxhc3RuYW1lIjoiRGFsaXNheSIsImVtYWlsIjoibWlrZUBjb2Rlb2ZhbmluamEuY29tIn19.h_Q4gJ3epcpwdwNCNCYxtiKdXsN34W9MEjxZ7sx21Vs') {
if (true) {
	if ($_GET['user_name']) {

		$uq = new WP_User_Query( array( 
			'search' 			=> $_GET['user_name'], 
			'search_columns' 	=> array('user_email', 'user_nicename', 'user_login') 
		) );

		if ( ! empty( $uq->results ) ) {
		 
			foreach ( $uq->results as $u ) {
				
				$data_user['ID'] = $u->ID;

				$user_info = get_userdata($u->ID);

				$data_user['display_name'] = $u->user_nicename;

				$data_user['first_name'] = $user_info->first_name;

				$data_user['last_name'] = $user_info->last_name;

				$data_user['user_email'] = $u->user_email;

				$data_user['phone_number'] = get_user_meta( $u->ID, 'phone_number', true );

				$data_user['regpartner'] = get_user_meta( $u->ID, 'regpartner', true );

				$data_user['demo_version'] = get_user_meta( $u->ID, 'payproduct', true );

				$data_user['buy_license'] = get_user_meta( $u->ID, 'payproduct_18', true );

				$data_user['bot_link'] = get_user_meta( $u->ID, 'arendaproduct', true );

				$data_user['instagram'] = get_user_meta( $u->ID, 'instagram', true );

				$data_user['facebook'] = get_user_meta( $u->ID, 'facebook', true );

				$data_user['vk'] = get_user_meta( $u->ID, 'vk', true ); 

				$data_user['vk1'] = get_user_meta( $u->ID, 'googleplus', true ); 

				$data_user['whatsapp'] = get_user_meta( $u->ID, 'vkontakte', true ); 				

				$data_user['telegram'] = get_user_meta( $u->ID, 'skype', true );
				
				$data_user['sushi_site'] = get_user_meta( $u->ID, 'arendaproduct', true );
				
				$data_user['sushireg'] = get_user_meta( $u->ID, 'yoke_promo', true );
	
					    if(get_user_meta( $u->ID, 'role', true ) == "guest-game"){
		echo "Оплати систему";
		exit;
} 
if(get_user_meta( $u->ID, 'role', true ) == "guest-yoke"){
		echo "Оплати систему";
		exit;

                }

				//$all_meta_for_user = get_user_meta( $u->ID );

				//var_dump($all_meta_for_user);

			}
		} else {

			$message = 'Пользователей по заданным критериям не найдено.';

		}

	}

	return $data_user;

} else {

	return false;

	die();



}

}

function get_user_role() {
    global $current_user;

    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);

    return $user_role;
}

function removeFromHome($query) {
if ($query->is_home)
    {$query->set('cat','-97,-102,-103');}
return $query; }
add_filter('pre_get_posts','removeFromHome');

function fb_filter_query( $query, $error = true ) {

	if ( is_search() ) {
		$query->is_search = false;
		$query->query_vars[s] = false;
		$query->query[s] = false;

		// Ошибка
		if ( $error == true )
			$query->is_404 = true;
	}
}

add_action( 'parse_query', 'fb_filter_query' );
add_filter( 'get_search_form', create_function( '$a', "return null;" ) );



add_action('init', 'omyblog_init_session', 1);
 
if ( !function_exists('omyblog_init_session')):
    function omyblog_init_session()
    {
        session_start();
    }
endif;

function info_user_s($user_name) {
foreach (getallheaders() as $name => $value) {

	if ($name == 'Referer') $key = $value;

}

//if (base64_decode($key) === 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLm9yZyIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUuY29tIiwiaWF0IjoxMzU2OTk5NTI0LCJuYmYiOjEzNTcwMDAwMDAsImRhdGEiOnsiaWQiOiI5IiwiZmlyc3RuYW1lIjoiTWlrZSIsImxhc3RuYW1lIjoiRGFsaXNheSIsImVtYWlsIjoibWlrZUBjb2Rlb2ZhbmluamEuY29tIn19.h_Q4gJ3epcpwdwNCNCYxtiKdXsN34W9MEjxZ7sx21Vs') {
if (true) {
	if ($user_name) {

		$uq = new WP_User_Query( array( 
			'search' 			=> $user_name, 
			'search_columns' 	=> array('user_email', 'user_nicename', 'user_login') 
		) );

		if ( ! empty( $uq->results ) ) {
		 
			foreach ( $uq->results as $u ) {
				
				$data_user['ID'] = $u->ID;

				$user_info = get_userdata($u->ID);

				$data_user['display_name'] = $u->user_nicename;

				$data_user['first_name'] = $user_info->first_name;

				$data_user['last_name'] = $user_info->last_name;

				$data_user['user_email'] = $u->user_email;

				$data_user['phone_number'] = get_user_meta( $u->ID, 'phone_number', true );

				$data_user['regpartner'] = get_user_meta( $u->ID, 'regpartner', true );

				$data_user['demo_version'] = get_user_meta( $u->ID, 'payproduct', true );

				$data_user['buy_license'] = get_user_meta( $u->ID, 'payproduct_18', true );

				$data_user['bot_link'] = get_user_meta( $u->ID, 'arendaproduct', true );

				$data_user['instagram'] = get_user_meta( $u->ID, 'instagram', true );

				$data_user['facebook'] = get_user_meta( $u->ID, 'facebook', true );

				$data_user['vk'] = get_user_meta( $u->ID, 'vk', true ); 
				$data_user['vk1'] = get_user_meta( $u->ID, 'googleplus', true ); 

				$data_user['whatsapp'] = get_user_meta( $u->ID, 'vkontakte', true ); 				

				$data_user['telegram'] = get_user_meta( $u->ID, 'skype', true );
				
				$data_user['sushi_site'] = get_user_meta( $u->ID, 'arendaproduct', true );
				
				$data_user['sushireg'] = get_user_meta( $u->ID, 'yoke_promo', true );
				
				$data_user['synced_profile_photo'] = get_user_meta( $u->ID, 'synced_profile_photo', true );

				$data_user['img_lend'] = get_user_meta( $u->ID, 'img_lend', true );
	
				$data_user['video_lp5'] = get_user_meta( $u->ID, 'video_lp5', true );

					    if(get_user_meta( $u->ID, 'role', true ) == "guest-game"){
		echo "";
		exit;
} 
if(get_user_meta( $u->ID, 'role', true ) == "guest-yoke"){
		echo "Оплати систему";
		exit;

                }
				//$all_meta_for_user = get_user_meta( $u->ID );

				//var_dump($all_meta_for_user);

			}
		} else {

			$message = 'Пользователей по заданным критериям не найдено.';

		}

	}

	return $data_user;

} else {

	return false;

	die();



}

}

function form_bot_data() {
    wp_enqueue_script('jquery');
    wp_localize_script( 'jquery', 'MS_Ajax', array(
            'ajaxurl'       => admin_url( 'admin-ajax.php' ),
            'form_bot_nonce'     => wp_create_nonce( 'form_bot-next-nonce' ))
    );
}
add_action('wp_enqueue_scripts','form_bot_data');

add_action( 'wp_ajax_nopriv_form_bot_submit', 'form_bot_submit' );
add_action( 'wp_ajax_form_bot_submit', 'form_bot_submit' );
function form_bot_submit(){
    //check_ajax_referer( 'form_bot-nonce', 'nonce_code' );
    //if( ! wp_verify_nonce( $_POST['nonce_code'], 'myajax-nonce' ) ) die( 'Stop!');

    $user_name = isset($_REQUEST['id_user']) ? form_specialchars_fild($_REQUEST['id_user']) : false;
    $name = isset($_REQUEST['name']) ? form_specialchars_fild($_REQUEST['name']) : false;
    $tel = isset($_REQUEST['tel']) ? form_specialchars_fild($_REQUEST['tel']) : false;
    $lend_link = isset($_REQUEST['ref']) ? form_specialchars_fild($_REQUEST['ref']) : false;

    if ($user_name) {
        $uq = new WP_User_Query(array(
            'search' => $user_name,
            'search_columns' => array('user_email', 'user_nicename', 'user_login')
        ));
    } else {
        echo false;
        wp_die();
    }

    if ( !empty( $uq->results ) && $tel ){
        $request_invited_user = [
            'user_ref'          => $user_name,
            'invited_number'    => $tel,
            'invited_firstname' => $name,
            'invited_scr'       => $lend_link,
        ];
        foreach ( $uq->results as $u ) {
            $user_id = $u->ID;
        }
        if (get_user_meta( $user_id, 'invited_user_lend', true ))
            $invited_user = json_decode(get_user_meta( $user_id, 'invited_user_lend', true ), true);
        else
            $invited_user = array();
        if (!array_key_exists($tel, $invited_user))
            $invited_user[$request_invited_user['invited_number']] = (array)$request_invited_user;
        update_user_meta( $user_id, 'invited_user_lend', json_encode($invited_user, JSON_UNESCAPED_UNICODE) );

        echo true;
    } else {
        echo false;
    }

    wp_die();
}

function form_specialchars_fild($fild)
{
    $fild = addslashes($fild);
    $fild = htmlspecialchars ($fild);
    $fild = preg_replace("/^[^0-9A-Za-zА-Яа-яЁё]+$/u", "", $fild);
    $fild = trim($fild);
    return $fild;
}
