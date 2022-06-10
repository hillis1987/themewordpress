

<?php


require_once('assets/bs4navwalker.php');


/*  Theme setup
/* ------------------------------------ */

if(! function_exists('nx_setup_theme')){

		function nx_setup_theme() {

	    // Enable title in header
			add_theme_support( "title-tag" );

			// Enable automatic feed links
			// add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'automatic-feed-links' );

			// Enable featured image
			add_theme_support( 'post-thumbnails' );

			// Thumbnail sizes
			add_image_size( 'nx_single', 800, 500, false );
			add_image_size( 'nx_card', 250, 250, false );
			add_image_size( 'nx_big', 1400, 800, true );
	    add_image_size( 'nx_quad', 600, 600, true ); 	//(cropped)

			// Custom menu areas
			register_nav_menus( array(
				'header' => esc_html__( 'Header', 'nx' ),
			) );

			// Load theme languages
			// load_theme_textdomain( 'slug-theme', get_template_directory().'/languages' );

			//load Theme Languages
			load_theme_textdomain('nx', get_template_directory().'/languages');

		}
}

add_action( 'after_setup_theme', 'nx_setup_theme' );

// Sidebar Setup


/*  Register sidebars
/* ------------------------------------ */
if ( ! function_exists( 'nx_sidebars' ) ) {

	function nx_sidebars()	{
		register_sidebar(array( 'name' => esc_html__( 'Primary', 'nx' ),
		'id' => 'primary',
		'description' => esc_html__( 'Main sidebar.', 'nx' ),
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'before_widget' => '<div class="widget my-5 %2$s">',
		'after_widget' => '</div>',
		)
	);
 }

}


add_action( 'widgets_init', 'nx_sidebars' );


/* Include Javascript files */

if(! function_exists('nx_scripts')){

	function nx_scripts(){

			  wp_enqueue_script( 'nx-popper-js', get_template_directory_uri().'/js/popper.min.js', array('jquery'), null, true);
				wp_enqueue_script( 'nx-bootstrap-js', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), null, true);

			}
}

add_action('wp_enqueue_scripts','nx_scripts');


if(! function_exists('nx_styles')){

	function nx_styles(){


				wp_enqueue_style( 'nx-bootstrap-css', get_template_directory_uri().'/css/bootstrap.min.css');
				wp_enqueue_style( 'nx-style-default-css', get_template_directory_uri().'/style.css');
				wp_enqueue_style( 'header', get_template_directory_uri() . '/style.css',false,'1.1','all');



	}
}
add_action('wp_enqueue_scripts','nx_styles');

function wpdocs_comment_form_defaults( $defaults ) {
  $defaults['class_submit'] = __( 'btn btn-primary btn-lg', 'nx' );
  return $defaults;
}
add_filter( 'comment_form_defaults', 'wpdocs_comment_form_defaults' );

remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

add_editor_style( 'css/custom-editor-style.css' );
add_theme_support( 'custom-background' );
add_theme_support( 'custom-header' );

function prefix_setup() {
		    add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
		}
add_action( 'after_setup_theme', 'prefix_setup' );

add_theme_support( 'wp-block-styles' );

add_theme_support( 'align-wide' );

add_theme_support( 'editor-color-palette', array(
    array(
        'name'  => esc_attr__( 'strong magenta', 'nx' ),
        'slug'  => 'strong-magenta',
        'color' => '#a156b4',
    ),
    array(
        'name'  => esc_attr__( 'light grayish magenta', 'nx' ),
        'slug'  => 'light-grayish-magenta',
        'color' => '#d0a5db',
    ),
    array(
        'name'  => esc_attr__( 'very light gray', 'nx' ),
        'slug'  => 'very-light-gray',
        'color' => '#eee',
    ),
    array(
        'name'  => esc_attr__( 'very dark gray', 'nx' ),
        'slug'  => 'very-dark-gray',
        'color' => '#444',
    ),
) );

add_theme_support( 'responsive-embeds' );
add_theme_support( 'custom-logo' );


if ( function_exists( 'register_block_style' ) ) {
    register_block_style(
        'core/quote',
        array(
            'name'         => 'blue-quote',
            'label'        => __( 'Blue Quote', 'nx' ),
            'is_default'   => true,
            'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
        )
    );
}


function wpdocs_register_block_patterns() {
        register_block_pattern(
            'wpdocs/my-example',
            array(
                'title'         => __( 'My First Block Pattern', 'nx' ),
                'description'   => _x( 'This is my first block pattern', 'Block pattern description', 'nx' ),
                'content'       => '<!-- wp:paragraph --><p>A single paragraph block style</p><!-- /wp:paragraph -->',
                'categories'    => array( 'text' ),
                'keywords'      => array( 'cta', 'demo', 'example' ),
                'viewportWidth' => 800,
            )
        );
}
add_action( 'init', 'wpdocs_register_block_patterns' );

//wp_comment_reply( int $position = 1, bool $checkbox = false, string $mode = 'single', bool $table_row = true );
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
}




 ?>
