<?php
/**
 * The template for displaying archive pages.
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

// leadinjection Global options
$leadinjection_global_option = get_option( 'rdx_option' );
$li_global_blog_layout = isset($leadinjection_global_option['li-global-blog-layout']) ? $leadinjection_global_option['li-global-blog-layout'] : 'sidebar-right';

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

        <?php get_template_part('template-parts/title', 'archive'); ?>

		<?php switch($li_global_blog_layout){

			case 'sidebar-left':    $col_class = "sidebar-left";
				break;

			case 'no-sidebar':      $col_class = "no-sidebar";
				break;

			default:                $col_class = "sidebar-right";
		}?>
		<div class="container blog-content-area <?php echo esc_attr( $col_class ); ?>">

			<!-- Main Content Start -->
			<div class="blog-main-content">
				<?php if (have_posts()) : ?>
					<?php if (is_home() && !is_front_page()) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
					<?php endif; ?>

					<?php while (have_posts()) : the_post(); ?>
						<?php get_template_part('template-parts/content', get_post_format()); ?>
					<?php endwhile; ?>

					<?php the_posts_pagination( array(
						'mid_size' => 2,
						'prev_text' => __( 'Back', 'leadinjection' ),
						'next_text' => __( 'Next', 'leadinjection' ),
					) ); ?>
				<?php else : ?>
					<?php get_template_part('template-parts/content', 'none'); ?>
				<?php endif; ?>
			</div>
			<!-- Main Content End -->


			<!-- Sidebar Start -->
			<?php if('no-sidebar' != $li_global_blog_layout) :?>
				<div class="blog-sidebar-content">
					<?php get_sidebar(); ?>
				</div>
			<?php endif; ?>
			<!-- Sidebar End -->


		</div>

	</main>
</div>

<?php get_footer(); ?>
