<?php
/**
 * Template part for displaying posts. 
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

$li_global_blog_excerpt = isset($leadinjection_global_option['li-global-blog-excerpt']) ? $leadinjection_global_option['li-global-blog-excerpt'] : false;

// leadinjection Post Opptions
$leadinjection_post_quote_text = get_post_meta( get_the_ID(), 'li-post-quote-text', true );
$leadinjection_post_quote_author = get_post_meta( get_the_ID(), 'li-post-quote-author', true );
$leadinjection_post_video_embed = get_post_meta( get_the_ID(), 'li-post-video-embed', true );
$leadinjection_post_gallery = get_post_meta( get_the_ID(), 'li-post-gallery', true );
$leadinjection_post_audio = get_post_meta( get_the_ID(), 'li-post-audio', true );
$leadinjection_post_link_text = get_post_meta( get_the_ID(), 'li-post-link-text', true );
$leadinjection_post_link_url = get_post_meta( get_the_ID(), 'li-post-link-url', true );
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">

        <!-- Featured Image and Image Post -->
        <?php if (has_post_thumbnail() && 'image' == get_post_format() ) : ?>
            <div class="featured-image post-image">
                <a class="image-popup" title="<?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>" href="<?php the_post_thumbnail_url(); ?>">
                    <?php the_post_thumbnail('leadinjection-featured-image'); ?>
                </a>
            </div>
        <?php elseif (has_post_thumbnail()) : ?>
            <div class="featured-image">
                <a href="<?php echo get_permalink(); ?>" >
                    <?php the_post_thumbnail('leadinjection-featured-image'); ?>
                </a>
            </div>
        <?php endif; ?>

        <!-- Quote Post -->
        <?php if (!empty($leadinjection_post_quote_text) && 'quote' == get_post_format()) : ?>
            <div class="post-quote">
                <div class="quote-text">
                    <?php echo esc_html($leadinjection_post_quote_text); ?>
                </div>
                <?php if (!empty($leadinjection_post_quote_author)) : ?>
                    <div class="quote-author">
                        <?php echo esc_html($leadinjection_post_quote_author); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Video Post -->
        <?php if (!empty($leadinjection_post_video_embed) && 'video' == get_post_format() ) : ?>
            <div class="post-video-embed">
                <?php echo sprintf("<div class='embed-responsive embed-responsive-16by9'>%s</div>", $leadinjection_post_video_embed); ?>
            </div>
        <?php endif; ?>

        <!-- Gallery Post -->
        <?php if (!empty($leadinjection_post_gallery) && 'gallery' == get_post_format() ) : ?>
            <div class="post-gallery">
                <div id="post-gallery-slider-<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner gallery-container" role="listbox">
                    <?php

                    $images_arr = explode( ',', $leadinjection_post_gallery);

                    foreach ( $images_arr as $key => $img_id ){

                        $active = ($key === 0) ? ' active' : '';

                        $att_img_link = wp_get_attachment_image_src( $img_id, 'full');
                        $att_img_link_featured = wp_get_attachment_image_src( $img_id, 'leadinjection-featured-image');
                        $att_img_caption = get_the_excerpt( $img_id );
                        $att_img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);

                        echo '<div class="item'.$active.'"><a class="gallery-popup-link" href="'. esc_url($att_img_link[0]) .'" title="'.$att_img_caption.'"><img class="gallery-image" src="'. esc_url($att_img_link_featured[0]) .'" alt="'. esc_attr($att_img_alt) .'" /></a></div>';
                    }

                    ?>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#post-gallery-slider-<?php the_ID(); ?>" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#post-gallery-slider-<?php the_ID(); ?>" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>

            </div>
        <?php endif; ?>


        <!-- Audio Post -->
        <?php if ('audio' == get_post_format() ) : ?>
            <div class="post-audio">
                <?php 
                    $url = (!empty($leadinjection_post_audio['url'])) ? $leadinjection_post_audio['url'] : '';
                    echo do_shortcode('[audio src="'.esc_url($url).'"]') 
                ?>
            </div>
        <?php endif; ?>


        <!-- Link Post -->
        <?php if (!empty($leadinjection_post_link_text) && 'link' == get_post_format()) : ?>
            <div class="post-link">
                <div class="link-title"><a href="<?php echo esc_url( $leadinjection_post_link_url ); ?>" title="<?php echo esc_attr( $leadinjection_post_link_text ); ?>"><?php echo esc_html($leadinjection_post_link_text); ?></a></div>
                <div class="link-url"><a href="<?php echo esc_url( $leadinjection_post_link_url ); ?>" title="<?php echo esc_url( $leadinjection_post_link_url ); ?>"><?php echo mb_strimwidth($leadinjection_post_link_url, 0, 100, ' ...'); ?></a></div>
            </div>
        <?php endif; ?>

        
        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
        
    </header>


    <div class="entry-content">
        <?php if(false == $li_global_blog_excerpt){
        the_content(sprintf(
            /* translators: %s: Name of current post. */
            wp_kses(__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'leadinjection'), array('span' => array('class' => array()))),
            the_title('<span class="screen-reader-text">"', '"</span>', false)
        ));
        }else{
            do_shortcode(the_excerpt());
        }
        ?>

        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'leadinjection'),
            'after' => '</div>',
        ));
        ?>
    </div>
    <!-- .entry-content -->

    <div class="entry-meta">
        <?php leadinjection_entry_meta(); ?>
    </div>
    <!-- .entry-footer -->
</article><!-- #post-## -->
