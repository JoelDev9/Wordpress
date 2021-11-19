<?php
/**
 * The template for displaying 404 pages (not found).
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

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

        <?php get_template_part('template-parts/title', '404'); ?>

		<section class="error-404 not-found">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2><?php esc_html_e( 'Oops, This Page Could Not Be Found!', 'leadinjection' ); ?></h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<div class="error-number">404</div>
					</div>
					<div class="col-md-5 col-md-offset-1 error-search">
						<h3>
							<?php esc_html_e( "Can't find what you need?", 'leadinjection' ); ?><br/>
							<span><?php esc_html_e( "Take a moment and do a search below!", 'leadinjection' ); ?></span>
						</h3>
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
		</section>

	</main>
</div>

<?php get_footer(); ?>
