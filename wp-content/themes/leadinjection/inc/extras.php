<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package leadinjection
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function leadinjection_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'leadinjection_body_classes' );


/**
 * Change search form widget output
 * @param string wp search form
 * @return string customize search form
 */
function leadinjection_search_form( $form ) {

	$form = str_replace('value="Search"', 'value="&#xf002;"', $form);

	return $form;
}

add_filter( 'get_search_form', 'leadinjection_search_form' );



/**
 * Leadinjection Global Social Icons Widget
 */

class Leadinjection_Global_Social_Icons_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'li-global-social-icons-widget',
			'description' => "Displays Leadinjection's Global Social Icons",
		);
		parent::__construct( 'li-global-social-icons-widget', 'Leadinjection Social Icons', $widget_ops );
	}

	public function widget( $args, $instance ) {

		echo trim($args['before_widget']);
		if( !empty($instance['title']) ) {
			echo trim($args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title']);
		}
		esc_html(leadinjection_global_social_icons());
		echo "<div class='clearfix'></div>";
		echo trim($args['after_widget']);
	}


	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'leadinjection' );
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'leadinjection' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

}

add_action( 'widgets_init', function(){
	register_widget( 'Leadinjection_Global_Social_Icons_Widget' );
});



/**
 * Leadinjection Excerpt Options
 */

// Changing excerpt length
add_filter('excerpt_length', 'leadinjection_excerpt_length');
function leadinjection_excerpt_length($length) {
    global $rdx_option;
    if(isset($rdx_option['li-global-blog-excerpt-length']) && true == $rdx_option['li-global-blog-excerpt-length']) {
        return $rdx_option['li-global-blog-excerpt-length'];
    }
}

// Changing excerpt more
add_filter('excerpt_more', 'leadinjection_excerpt_more');
function leadinjection_excerpt_more($more) {
    global $rdx_option;
    if(isset($rdx_option['li-global-blog-excerpt-text']) && true == $rdx_option['li-global-blog-excerpt-text']) {
        //return $rdx_option['li-global-blog-excerpt-text'];
        return sprintf( ' <a href="%1$s" class="more-link">%2$s</a>', esc_url( get_permalink( get_the_ID() ) ), $rdx_option['li-global-blog-excerpt-text']);
    }
}