<?php
/**
 * The template for displaying search results pages.
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

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

            <?php get_template_part('template-parts/title', 'search'); ?>

			<?php switch($li_global_blog_layout ){

				case 'sidebar-left':    $col_class = "sidebar-left";
					break;

				case 'no-sidebar':      $col_class = "no-sidebar";
					break;

				default:                $col_class = "sidebar-right";
			}?>
			<div class="container blog-content-area <?php echo esc_attr( $col_class ); ?>">

				<!-- Main Content Start -->
				<div class="blog-main-content search-results">
					<h2 class="search-result-title"><?php printf( esc_html__( 'Search Results for: %s', 'leadinjection' ), '<span>' . get_search_query() . '</span>' ); ?></h2>

					<?php if (have_posts()) : ?>
						<?php if (is_home() && !is_front_page()) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>
						<?php endif; ?>

						<?php while (have_posts()) : the_post(); ?>
							<?php get_template_part('template-parts/content', 'search'); ?>
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
				<?php if('no-sidebar' != $li_global_blog_layout ) :?>
					<div class="blog-sidebar-content">
						<?php get_sidebar(); ?>
					</div>
				<?php endif; ?>
				<!-- Sidebar End -->


			</div>

		</main>
	</section>


<?php get_footer(); ?>
