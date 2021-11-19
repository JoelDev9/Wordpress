<?php
/**
 * Template part for displaying a message that posts cannot be found.
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

?>

<section class="no-results not-found">
	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'leadinjection' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>
			<div class="search">
				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'leadinjection' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'leadinjection' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</section>
