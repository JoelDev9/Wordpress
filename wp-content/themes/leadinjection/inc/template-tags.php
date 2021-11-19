<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package leadinjection
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

global $rdx_options;

/**
 * Get the Post ID
 */
if (!function_exists('leadinjection_post_id')) :
    function leadinjection_post_id()
    {
        if (is_home()) {
            $post_id = get_option('page_for_posts');
        } else {
            $post_id = get_the_ID();
        }
        return $post_id;
    }
endif;


/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if (!function_exists('leadinjection_posted_on')) :
    function leadinjection_posted_on()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf($time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date())
        );
        $posted_on = sprintf(
            esc_html_x('%s', 'post date', 'leadinjection'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = sprintf(
            esc_html_x('by %s', 'post author', 'leadinjection'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

    }
endif;


/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if (!function_exists('leadinjection_posted_on_sp')) :
    function leadinjection_posted_on_sp()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf($time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            esc_html_x('%s', 'post date', 'leadinjection'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );


        $categories = '';
        $categories_list = get_the_category_list(esc_html__(', ', 'leadinjection'));
        if ($categories_list && leadinjection_categorized_blog()) {
            $categories = '<span class="cat-links">' . esc_html__('Posted in ', 'leadinjection') . $categories_list . '</span>';
        }

        echo '<span class="posted-on">' . $posted_on . '</span>' . $categories;

    }
endif;


/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
if (!function_exists('leadinjection_entry_meta')) :
    function leadinjection_entry_meta()
    {

        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf($time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date())
        );

        // Author
        echo sprintf(
            esc_html_x('By %s', 'post author', 'leadinjection'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        // Categories
        
        $categories_list = get_the_category_list(esc_html__(', ', 'leadinjection'));
        if ($categories_list && leadinjection_categorized_blog()) {
            echo '<span class="cat-links">' . $categories_list . '</span>';
        }

        // Post Date
        echo sprintf(
            esc_html_x('%s', 'post date', 'leadinjection'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        // Comments
        if (!post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link"><i class="fa fa-comment" aria-hidden="true"></i> ';
            comments_popup_link(esc_html__('No comments yet', 'leadinjection'), esc_html__('1 Comment', 'leadinjection'), esc_html__('% Comments', 'leadinjection'));
            echo '</span>';
        }

//	edit_post_link(
//		sprintf(
//			/* translators: %s: Name of current post */
//			esc_html__( 'Edit %s', 'leadinjection' ),
//			the_title( '<span class="screen-reader-text">"', '"</span>', false )
//		),
//		'<span class="edit-link">',
//		'</span>'
//	);
    }
endif;


/**
 * Returns true if a blog has more than 1 category.
 */
function leadinjection_categorized_blog()
{
    if (false === ($all_the_cool_cats = get_transient('leadinjection_categories'))) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(array(
            'fields' => 'ids',
            'hide_empty' => 1,

            // We only need to know if there is more than one category.
            'number' => 2,
        ));

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('leadinjection_categories', $all_the_cool_cats);
    }

    if ($all_the_cool_cats > 1) {
        // This blog has more than 1 category so leadinjection_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so leadinjection_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in leadinjection_categorized_blog.
 */
function leadinjection_category_transient_flusher()
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient('leadinjection_categories');
}

add_action('edit_category', 'leadinjection_category_transient_flusher');
add_action('save_post', 'leadinjection_category_transient_flusher');


/**
 * Prints HTML with meta information for the social networks.
 */
if (!function_exists('leadinjection_global_social_icons')) :
    function leadinjection_global_social_icons()
    {
        global $rdx_option;

        if ($rdx_option['sn_facebook_url'] !== '') {
            printf('<a href="%s" class="li-facebook"><i class="fa fa-facebook"></i></a>', $rdx_option['sn_facebook_url']);
        }

        if ($rdx_option['sn_twitter_url'] !== '') {
            printf('<a href="%s" class="li-twitter"><i class="fa fa-twitter"></i></a>', $rdx_option['sn_twitter_url']);
        }

        if ($rdx_option['sn_googleplus_url'] !== '') {
            printf('<a href="%s" class="li-google-plus"><i class="fa fa-google-plus"></i></a>', $rdx_option['sn_googleplus_url']);
        }

        if ($rdx_option['sn_youtube_url'] !== '') {
            printf('<a href="%s" class="li-youtube"><i class="fa fa-youtube"></i></a>', $rdx_option['sn_youtube_url']);
        }

        if ($rdx_option['sn_vimeo_url'] !== '') {
            printf('<a href="%s" class="li-vimeo"><i class="fa fa-vimeo"></i></a>', $rdx_option['sn_vimeo_url']);
        }

        if ($rdx_option['sn_linkedin_url'] !== '') {
            printf('<a href="%s" class="li-linkedin"><i class="fa fa-linkedin"></i></a>', $rdx_option['sn_linkedin_url']);
        }

        if ($rdx_option['sn_tumblr_url'] !== '') {
            printf('<a href="%s" class="li-tumblr"><i class="fa fa-tumblr"></i></a>', $rdx_option['sn_tumblr_url']);
        }

        if ($rdx_option['sn_pinterest_url'] !== '') {
            printf('<a href="%s" class="li-pinterest"><i class="fa fa-pinterest"></i></a>', $rdx_option['sn_pinterest_url']);
        }

        if ($rdx_option['sn_skype_url'] !== '') {
            printf('<a href="%s" class="li-skype"><i class="fa fa-skype"></i></a>', $rdx_option['sn_skype_url']);
        }

        if ($rdx_option['sn_dribbble_url'] !== '') {
            printf('<a href="%s" class="li-dribbble"><i class="fa fa-dribbble"></i></a>', $rdx_option['sn_dribbble_url']);
        }

        if ($rdx_option['sn_behance_url'] !== '') {
            printf('<a href="%s" class="li-behance"><i class="fa fa-behance"></i></a>', $rdx_option['sn_behance_url']);
        }

        if ($rdx_option['sn_flickr_url'] !== '') {
            printf('<a href="%s" class="li-flickr"><i class="fa fa-flickr"></i></a>', $rdx_option['sn_flickr_url']);
        }

        if ($rdx_option['sn_instagram_url'] !== '') {
            printf('<a href="%s" class="li-instagram"><i class="fa fa-instagram"></i></a>', $rdx_option['sn_instagram_url']);
        }

        if ($rdx_option['sn_deviantart_url'] !== '') {
            printf('<a href="%s" class="li-deviantart"><i class="fa fa-deviantart"></i></a>', $rdx_option['sn_deviantart_url']);
        }

        if ($rdx_option['sn_digg_url'] !== '') {
            printf('<a href="%s" class="li-digg"><i class="fa fa-digg"></i></a>', $rdx_option['sn_digg_url']);
        }

        if ($rdx_option['sn_reddit_url'] !== '') {
            printf('<a href="%s" class="li-reddit"><i class="fa fa-reddit"></i></a>', $rdx_option['sn_reddit_url']);
        }
    }
endif;

/**
 * Prints Header CSS Classes.
 */
if (!function_exists('leadinjection_header_classes')) :
    function leadinjection_header_classes($leadinjection_global_option, $leadinjection_onpage_header_nav)
    {
        $classes = array();

        //$leadinjection_onpage_header_nav = get_post_meta(leadinjection_post_id(), 'li-onpage-header-nav', true);

        if (!empty($leadinjection_global_option['li-global-menue-transparent'])) {
            $classes[] = 'transparent-enable';
        }

        if (!empty($leadinjection_global_option['li-global-header-shadow'])) {
            $classes[] = 'no-shadow';
        }


        if (empty($leadinjection_onpage_header_nav) || 'show' == $leadinjection_onpage_header_nav) {
            $classes[] = 'show';
        }

        if ('fixed' == $leadinjection_onpage_header_nav || 'fade-in' == $leadinjection_onpage_header_nav) {
            $classes[] = 'header-fixed';
        }

        if ('fade-in' == $leadinjection_onpage_header_nav) {
            $classes[] = 'header-hidden';
        }

        echo implode(' ', $classes);
    }
endif;


