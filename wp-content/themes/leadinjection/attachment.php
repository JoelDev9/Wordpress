<?php
/**
 * The template for displaying all single posts.
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

get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php get_template_part('template-parts/title', 'default'); ?>

        <div class="container">
            <div class="row">
                <!--start main content-->
                <div class="col-md-12">

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header text-center">

                            <?php if (has_post_thumbnail()) : ?>
                                <div class="featured-image">
                                    <a href="<?php echo get_permalink(); ?>" >
                                        <?php the_post_thumbnail('leadinjection-featured-image'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

                            <div class="entry-meta">
                                <?php leadinjection_posted_on_sp(); ?>
                            </div><!-- .entry-meta -->
                        </header><!-- .entry-header -->

                        <hr>

                    <div class="entry-content text-center">
                        <div class="entry-attachment">
                            <?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "large"); ?>
                                <p class="attachment"><a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo esc_url( $att_image[0] );?>" width="<?php echo esc_attr( $att_image[1] );?>" height="<?php echo esc_attr( $att_image[2] );?>"  class="attachment-medium" alt="<?php $post->post_excerpt; ?>" /></a>
                                </p>
                            <?php else : ?>
                                <a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
                            <?php endif; ?>
                        </div>

                        <hr>
                        <div class="entry-caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt() ?></div>


                        <?php echo get_post_field('post_content', $post->id) ?>


                        <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'leadinjection' ) . '&amp;after=</div>') ?>

                    </div><!-- .entry-content -->


                    </article><!-- #post-## -->



                </div>
                <!--end main content-->


            </div>
        </div>


    </main>

</div>

<?php get_footer(); ?>
