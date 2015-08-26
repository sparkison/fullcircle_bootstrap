<?php
/**
 * fullcircle_bootstrap functions and definitions
 *
 * @package fullcircle_bootstrap
 */

if ( ! function_exists( 'fullcircle_bootstrap_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fullcircle_bootstrap_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on fullcircle_bootstrap, use a find and replace
	 * to change 'fullcircle_bootstrap' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'fullcircle_bootstrap', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'fullcircle_bootstrap' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'fullcircle_bootstrap_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/**
	 *	Style the comment form and comments to match Bootstrap
	 * 	Also includes schema.org microdata
	 */

	// Custom comment
	function fullcircle_bootstrap_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
		
		if ( 'article' == $args['style'] ) {
			$tag = 'article';
			$add_below = 'comment';
		} else {
			$tag = 'article';
			$add_below = 'comment';
		}

		?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemscope itemtype="http://schema.org/Comment">
			<div class="panel panel-default">
				<div class="comment-meta post-meta panel-heading" role="complementary">
					<figure class="gravatar circle"><?php echo get_avatar( $comment, 38, '', 'Author’s gravatar' ); ?></figure>
					<h3 class="comment-author panel-title">
						<a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a>
					</h3>
					<time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('jS F Y') ?>, <a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a></time>
					<?php edit_comment_link('<p class="comment-meta-item">Edit this comment</p>','',''); ?>
					<?php if ($comment->comment_approved == '0') : ?>
						<p class="comment-meta-item">Your comment is awaiting moderation.</p>
					<?php endif; ?>
				</div>
			</div>
			<div class="comment-content post-content panel-body" itemprop="text">
				<?php comment_text() ?>
				<div class="comment-reply">
					<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
			</div>
		<?php 
	}
	// Change comment reply link style
	function custom_comment_reply_link_class($class){
    	$class = str_replace("class='comment-reply-link", "class='btn btn-sm btn-primary comment-reply-link", $class);
    	return $class;
	}
	add_filter('comment_reply_link', 'custom_comment_reply_link_class');
	// End custom comment
	function fullcircle_bootstrap_comment_close() {
		echo '</article>';
	}

	// Add bootstrap3 styling to comment form
	function bootstrap3_comment_form_fields( $fields ) {
	    $commenter = wp_get_current_commenter();
	    
	    $req      = get_option( 'require_name_email' );
	    $aria_req = ( $req ? " aria-required='true'" : '' );
	    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
	    
	    $fields   =  array(
	        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
	                    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
	        'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
	                    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
	        'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
	                    '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>'        
	    );
	    
	    return $fields;
	}
	add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );
	
	// Add bootstrap3 styling to comment form
	function bootstrap3_comment_form( $args ) {
	    $args['comment_field'] = '<div class="form-group comment-form-comment">
	            <label for="comment">' . _x( 'Comment', 'noun' ) . '</label> 
	            <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" width="100%" aria-required="true"></textarea>
	        </div>';
	    $args['class_submit'] = 'btn btn-default';
	    
	    return $args;
	}
	add_filter( 'comment_form_defaults', 'bootstrap3_comment_form' );

	/**
	 *	End comments styling
	 */

	//Add class to edit button
	function custom_edit_post_link_style($output) {
		$output = str_replace('class="post-edit-link"', 'class="btn btn-primary btn-sm post-edit-link"', $output);
		return $output;
	}
	add_filter('edit_post_link', 'custom_edit_post_link_style');

}
endif; // fullcircle_bootstrap_setup
add_action( 'after_setup_theme', 'fullcircle_bootstrap_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fullcircle_bootstrap_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fullcircle_bootstrap_content_width', 640 );
}
add_action( 'after_setup_theme', 'fullcircle_bootstrap_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function fullcircle_bootstrap_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'fullcircle_bootstrap' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'fullcircle_bootstrap_widgets_init' );

/**
 * ACF includes
 */

// 1. customize ACF path
function my_acf_settings_path( $path ) {
 
    // update path
    $path = get_template_directory() . '/assets/acf/';
    
    // return
    return $path;
    
}
add_filter('acf/settings/path', 'my_acf_settings_path');

// 2. customize ACF dir
function my_acf_settings_dir( $dir ) {
 
    // update path
    $dir = get_template_directory_uri() . '/assets/acf/';

    // return
    return $dir;
    
}
add_filter('acf/settings/dir', 'my_acf_settings_dir');

// 3. Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');


// 4. Include ACF
include_once( get_template_directory() . '/assets/acf/acf.php' );

/**
 * Add ACF Options page
 */
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));
    
}

/**
 * Enqueue scripts and styles.
 */
function fullcircle_bootstrap_scripts() {

	// cache the directory path
	$template_directory = get_template_directory_uri() . '/assets';

	// styles
	wp_enqueue_style( 'fullcircle_bootstrap', $template_directory . '/css/fullcircle_bootstrap.min.css' );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );

	// scripts
	wp_enqueue_script( 'fullcircle_bootstrap', $template_directory . '/js/fullcircle_bootstrap.min.js', array( 'jquery' ), '20150715', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fullcircle_bootstrap_scripts' );
/**
 * Add Bootstrap navwalker
 */
require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');

/**
 * Add Bootstrap pagination
 */
require_once(get_template_directory() . '/inc/wp_bootstrap_pagination.php');

/**
 * Add Better Admin Bar
 */
require_once(get_template_directory() . '/inc/better-admin-bar.php');

/**
 * Include minification class.
 */
require get_template_directory() . '/inc/wp_html_minify.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
