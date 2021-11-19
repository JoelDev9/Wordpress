<?php
/**
 * Leadinjection functions and definitions.
 *
 * -------------------------------------------------------------------
 *
 * @package    Leadinjection WordPress Theme
 * @author     Themeinjection <info@themeinjection.com>
 * @copyright  2016 Themeinjection
 * @link       http://leadinjection.io/
 *
 * -------------------------------------------------------------------
 *
 */

if (!function_exists('leadinjection_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function leadinjection_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on leadinjection, use a find and replace
         * to change 'leadinjection' to the name of your theme in all the template files.
         */
        load_theme_textdomain('leadinjection', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'leadinjection'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array(
            'image',
            'gallery',
            'video',
            'quote',
            'link',
            'audio',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('leadinjection_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
    }
endif;
add_action('after_setup_theme', 'leadinjection_setup');


/**
 * Leadinjection Debuging helpers
 */

function leadinjection_debug($data) {
    echo '<!-- debug start --><pre>';
    print_r($data);
    echo '</pre> <!-- debug end -->';
}

// Send debug code to the Javascript console
function leadinjection_debug_console($data) {
    if(is_array($data) || is_object($data)) {
        echo("<script>console.info('PHP: ".json_encode($data)."');</script>");
    } else {
        echo("<script>console.info('PHP: ".$data."');</script>");
    }
}

// Write debug msg in PHP log file
function leadinjection_debug_log( $msg, $title = '' ) {
    $msg = print_r($msg,true);
    $log = $title."  |  ".$msg."\n";
    error_log( $log);
}


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 * @global int $content_width
 */
add_action('after_setup_theme', 'leadinjection_content_width', 0);
function leadinjection_content_width()
{
    $GLOBALS['content_width'] = apply_filters('leadinjection_content_width', 640);
}


/**
 * Register sidebar widget area.
 */
add_action('widgets_init', 'leadinjection_widgets_init');
function leadinjection_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'leadinjection'),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    global $wpdb;
    $pageSidebar = $wpdb->get_results("
    select * from $wpdb->postmeta 
    where meta_key='li-onpage-sidebar' 
    and (meta_value='sidebar-left' or meta_value='sidebar-right')
    ");

    if (count($pageSidebar) != 0) {
        register_sidebar(array(
            'name' => esc_html__('Page Sidebar', 'leadinjection'),
            'id' => 'page-sidebar-1',
            'description' => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));
    }

}


/**
 * Register scripts and styles.
 */
add_action('template_redirect', 'leadinjection_register_scripts', 5);
function leadinjection_register_scripts()
{
    // Register scripts
    wp_register_script('animate-number', get_template_directory_uri() . '/bower_components/jquery-animateNumber/jquery.animateNumber.min.js');
    wp_register_script('countdown', get_template_directory_uri() . '/bower_components/jquery.countdown/dist/jquery.countdown.min.js');
    wp_register_script('progressbar-js', get_template_directory_uri() . '/bower_components/progressbar.js/dist/progressbar.js', array('jquery', 'waypoints'));
    wp_register_style('imagehover', get_template_directory_uri() . '/bower_components/imagehover.css/css/imagehover.min.css');
    
    wp_register_script('waypoints', get_template_directory_uri() . '/bower_components/waypoints/lib/jquery.waypoints.min.js');
    wp_register_script('twentytwenty-jqm', get_template_directory_uri() . '/bower_components/twentytwenty/js/jquery.event.move.js');
    wp_register_script('twentytwenty-js', get_template_directory_uri() . '/bower_components/twentytwenty/js/jquery.twentytwenty.js', array('twentytwenty-jqm'));
    wp_register_style('twentytwenty-css', get_template_directory_uri() . '/bower_components/twentytwenty/css/twentytwenty-no-compass.css');

}


/**
 * Enqueue scripts and styles.
 */
add_action('wp_enqueue_scripts', 'leadinjection_enqueue_scripts');
function leadinjection_enqueue_scripts()
{
    // Enqueue CSS
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/bower_components/bootstrap/dist/css/bootstrap.min.css');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/bower_components/fontawesome/css/font-awesome.min.css');
    wp_enqueue_style('animate', get_template_directory_uri() . '/bower_components/animate.css/animate.min.css');
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/bower_components/magnific-popup/dist/magnific-popup.css');
    wp_enqueue_style('leadinjection-style', get_stylesheet_uri());

    // Enqueue JS
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/bower_components/bootstrap/dist/js/bootstrap.min.js', array('jquery'), false, true);
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/bower_components/magnific-popup/dist/jquery.magnific-popup.min.js', array('jquery'), false, true);

    // Load Nice Mouse Scroll if enable
    $redux_options = maybe_unserialize( get_option( 'rdx_option', false ) );
    if( isset($redux_options['li-global-nice-mouse-scroll']) && $redux_options['li-global-nice-mouse-scroll'] ) {
        wp_enqueue_script('nice-mouse-scroll', get_template_directory_uri() . '/js/nice_mouse_scroll.min.js', array('jquery'), false, true);
    }

    wp_enqueue_script('leadinjection-custom', get_template_directory_uri() . '/js/custom.js', array('jquery', 'waypoints'), false, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}


/**
 * Enqueue scripts and styles backend.
 */
add_action('admin_enqueue_scripts', 'leadinjection_enqueue_scripts_backend');
function leadinjection_enqueue_scripts_backend()
{
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/bower_components/fontawesome/css/font-awesome.min.css');
    wp_enqueue_style('leadinjection-vc-icons-css', get_template_directory_uri() . '/backend/css/backend-styles.css');
    wp_enqueue_style('leadinjection-backend-css', get_template_directory_uri() . '/backend/css/li-vc-icon-sprite.css');
}


/**
 * Add IE9 support
 */
add_filter('leadinjection_ie9_support', 'leadinjection_add_ie9_support');
function leadinjection_add_ie9_support($html5shiv)
{
    $html5shiv  = '<script src="' . get_template_directory_uri() . '/bower_components/html5shiv/dist/html5shiv.min.js"></script>';
    $html5shiv .= '<script src="' . get_template_directory_uri() .  '/bower_components/respond/dest/respond.min.js"></script>';
    return $html5shiv;
}


/**
 * Add custom editor stlyes
 */
add_action( 'admin_init', 'leadinjection_editor_styles' );
function leadinjection_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}

/**
 * Add excerpt editor to pages
 */
add_action( 'init', 'leadinjection_add_excerpts_to_pages' );
function leadinjection_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}


/**
 * Theme PHP scripts and libraries includes
 */
$theme_dir = get_template_directory();
require_once ( ABSPATH . 'wp-admin/includes/plugin.php' );

require_once ( $theme_dir . '/inc/template-tags.php' );

require_once ( $theme_dir . '/inc/extras.php' );

require_once ( $theme_dir . '/inc/custom-breadcrumbs.php' );

require_once ( $theme_dir . '/inc/jetpack.php' );

require_once ( $theme_dir . '/inc/custom-image-sizes.php' );

require_once ( $theme_dir . '/inc/wp_bootstrap_navwalker.php' );

require_once ( $theme_dir . '/inc/class-tgm-plugin-activation.php' );

require_once ( $theme_dir . '/inc/tgm-plugin-init.php' );

require_once( $theme_dir . '/inc/visual_composer_init.php' );

require_once( $theme_dir . '/inc/mega_main_menu.php' );

require_once( $theme_dir . '/backend/redux-options-init.php' );


/**
 *  Register Footer Widget Bar
 */
add_action( 'widgets_init', 'leadinjection_add_footer_columns' );
function leadinjection_add_footer_columns(){

    // Load Nice Mouse Scroll if enable
    $redux_options = maybe_unserialize( get_option( 'rdx_option', false ) );

    register_sidebar(array('name' => 'Footer 1 Column',
        'id' => 'footer-widget-bar-col1',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    // Register only if Footer Style 1 or 2 is active
    if(isset($redux_options['li-global-footer-style']) && 'footer-style-3' != $redux_options['li-global-footer-style']) {
        register_sidebar(array('name' => 'Footer 2 Column',
            'id' => 'footer-widget-bar-col2',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
        ));
    }

    // Register only if Footer Style 1 or 2 is active
    if(isset($redux_options['li-global-footer-style']) && 'footer-style-3' != $redux_options['li-global-footer-style']) {
        register_sidebar(array('name' => 'Footer 3 Column',
            'id' => 'footer-widget-bar-col3',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
        ));
    }

    // Register only if Footer Style 2 is active
    if(isset($redux_options['li-global-footer-style']) && 'footer-style-2' == $redux_options['li-global-footer-style']){
        register_sidebar(array('name' => 'Footer 4 Column',
            'id' => 'footer-widget-bar-col4',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
        ));
    }

    // Register only if Woocommerce is active
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        register_sidebar(array('name' => 'WooCommerce Shop Sidebar',
            'id' => 'woocommerce-shop-sidebar',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
        ));
    }

}


/**
 *  Style Comment Fields
 */
add_filter('comment_form_default_fields', 'leadinjection_bootstrap3_comment_form_fields');
function leadinjection_bootstrap3_comment_form_fields($fields)
{
    $commenter = wp_get_current_commenter();

    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');
    $html5 = current_theme_supports('html5', 'comment-form') ? 1 : 0;

    $fields = array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __('Name', 'leadinjection') . ($req ? ' <span class="required">*</span>' : '') . '</label> ' .
            '<input class="form-control input-md invert" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" placeholder="' . __('Name (required):', 'leadinjection') . '" size="30"' . $aria_req . ' /></div>',
        'email' => '<div class="form-group comment-form-email"><label for="email">' . __('Email', 'leadinjection') . ($req ? ' <span class="required">*</span>' : '') . '</label> ' .
            '<input class="form-control input-md invert" id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="' . __('E-Mail (required):', 'leadinjection') . '" size="30"' . $aria_req . ' /></div>',
        'url' => '<div class="form-group comment-form-url"><label for="url">' . __('Website', 'leadinjection') . '</label> ' .
            '<input class="form-control input-md invert" id="url" name="url" ' . ($html5 ? 'type="url"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_url']) . '" placeholder="' . __('Website', 'leadinjection') . '" size="30" /></div>'
    );

    return $fields;
}


/**
 *  Style Comment Textarea and Button
 */
add_filter('comment_form_defaults', 'leadinjection_bootstrap3_comment_form');
function leadinjection_bootstrap3_comment_form($args)
{
    $args['comment_field'] = '<div class="form-group comment-form-comment">
            <label for="comment">' . _x('Comment', 'noun', 'leadinjection') . '</label>
            <textarea class="form-control input-md invert" id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . __('Comment (required):', 'leadinjection') . '"></textarea>
        </div>';
    $args['class_submit'] = 'btn btn-md btn-blue';
    return $args;
}


/**
 *  Hide activation and update of Slider Revolution.
 */
if(function_exists( 'set_revslider_as_theme' )){
    add_action( 'init', 'leadinjection_set_revslider_activation' );
    function leadinjection_set_revslider_activation() {
        set_revslider_as_theme();
    }
}


/**
 * Disable Contactform 7 styles.css
 */
add_filter( 'wpcf7_load_css', '__return_false' );


/**
 * Disable Dashicons from the frontend
 */
add_action( 'wp_print_styles', 'leadinjection_deregister_dashicons', 100 );
function leadinjection_deregister_dashicons()    {
    if( !is_user_logged_in() )
    wp_deregister_style( 'dashicons');
}


/**
 * Remove Rev Slider Metabox
 */
if ( is_admin() ) {
    add_action( 'do_meta_boxes', 'leadinjection_remove_revslider_meta_boxes' );
    function leadinjection_remove_revslider_meta_boxes() {
        remove_meta_box( 'mymetabox_revslider_0', 'page', 'normal' );
        remove_meta_box( 'mymetabox_revslider_0', 'post', 'normal' );
        remove_meta_box( 'mymetabox_revslider_0', 'li_modals', 'normal' );
        remove_meta_box( 'mymetabox_revslider_0', 'lilm_leads', 'normal' );
        remove_meta_box( 'mymetabox_revslider_0', 'product', 'normal' );
    }
}

/**
 * Disable SVG Support Plugin Notice
 */
if(function_exists('bodhi_svg_support_settings_page')) {
    add_action( 'admin_init', 'leadinjection_disable_svg_notice' );
    function leadinjection_disable_svg_notice(){
        $notice_set = get_option( 'bodhi_svgs_admin_notice_dismissed' );

        if ($notice_set !== '1') {
            update_option('bodhi_svgs_admin_notice_dismissed', '1');
        }
    }
}

/**
 * Enable WooCommerce Support
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

function leadinjection_woocommerce_custom_breadcrumb(){
    woocommerce_breadcrumb();
}

add_action( 'leadinjection_woo_breadcrumb', 'leadinjection_woocommerce_custom_breadcrumb' );

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 3; // 3 products per row
    }
}

// Change Single Product price, rating order
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15);

// Remove Single Product Tabs description heading
add_filter('woocommerce_product_description_heading', 'leadinjection_woo_description');
function leadinjection_woo_description(){
    $heading = '';
    return $heading;
}

// Remove Single Product Tabs description heading
add_filter('woocommerce_product_additional_information_heading', 'leadinjection_woo_additional_information');
function leadinjection_woo_additional_information(){
    $heading = '';
    return $heading;
}


remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );

add_action('woocommerce_before_shop_loop_item_title', 'leadinjection_product_tags');
function leadinjection_product_tags(){
    global $product;
    echo wc_get_product_tag_list( $product->get_id(), ', </li><li>', '<ul class="woocommerce-loop-product__tags"><li>', '</li></ul>' );
}
