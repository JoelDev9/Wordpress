<?php

/*
    Textblock
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_review_block', 'leadinjection_review_block_shortcode');

function leadinjection_review_block_shortcode($atts, $content)
{

    $default_atts = array(
        'review_block_type' => 'image',
        'review_block_image' => '',
        'review_block_image_style' => 'square',
        'image_border_color' => '',
        'content' => !empty($content) ? $content : '',
        'content_color' => '',
        'review_block_author' => '',
        'review_block_author_source' => '',
        'author_color' => '',
        'author_source_color' => '',
        'rating_color' => '',
        'review_block_shadow' => '',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('review_block_', $shortcode_id);
    $wrapper_class = array('li-review-block', $review_block_shadow, $xclass, $responsive_helper);


    $review_image = ('' != $review_block_image) ? wp_get_attachment_image($review_block_image, 'leadinjection-person-profile', false, array('class' => 'img-responsive')) : '';


    $style  = '';
    $style .= (!empty($content_color)) ? "#$shortcode_id .review-block-review p { color: $content_color; }" : null;
    $style .= (!empty($author_color)) ? "#$shortcode_id .review-block-author { color: $author_color; }" : null;
    $style .= (!empty($author_source_color)) ? "#$shortcode_id .review-block-author-source { color: $author_source_color; }" : null;
    $style .= (!empty($rating_color)) ? "#$shortcode_id .review-block-rating { color: $rating_color; }" : null;

    $style .= (!empty($image_border_color)) ? "#$shortcode_id .review-block-image { border: 1px solid $image_border_color; }" : null;


    $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;


    $data_effect = '';
    if ('none' !== $animation) {
        leadinjection_enqueue_animation();
        $wrapper_class[] = 'li-animate';
        $data_effect = 'data-effect="' . esc_attr($animation) . '"';
    }

    // Create wrapper classes string
    $wrapper_class  = leadinjection_wrapper_class($wrapper_class, $css);

    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>

    <?php echo $output_style; ?>
    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>>

        <?php if('image' == $review_block_type) :?>
        <div class="review-block-image-container">
            <div class="review-block-image <?php echo $review_block_image_style; ?>">
                <?php echo $review_image; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="review-block-review-container">
            <div class="review-block-review"><?php echo wpb_js_remove_wpautop( $content, true ); ?></div>
            <div class="review-block-author"><?php echo $review_block_author; ?> <span class="review-block-author-source"><?php echo $review_block_author_source; ?></span></div>
            <div class="review-block-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>
        </div>

    </div>


     <?php
    // End Output
    //////////////////////////////////////////////////////////////////////////////////////////

    $output = ob_get_contents();
    ob_end_clean();

    return $output;

}


/*
    Visual Composer Registration
*/

add_action('vc_before_init', 'leadinjection_review_block_vc');

function leadinjection_review_block_vc()
{
    $leadinjection_review_block_params = array(
        array(
            'type' => 'dropdown',
            'heading' => __('Review Block Type', 'leadinjection'),
            'param_name' => 'review_block_type',
            'value' => array(
                __('Review Block with Image', 'leadinjection') => 'image',
                __('Review Block without Image', 'leadinjection') => 'no-image',
            )
        ),
        array(
            'type' => 'attach_images',
            'heading' => __('Review image', 'leadinjection'),
            'param_name' => 'review_block_image',
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Review Block Image Style', 'leadinjection'),
            'param_name' => 'review_block_image_style',
            'value' => array(
                __('Round', 'leadinjection') => 'round',
                __('Square', 'leadinjection') => 'square',
                __('Rounded (6px)', 'leadinjection') => 'rounded',
            ),
            'std' => 'square',
            'dependency' => array(
                'element' => 'review_block_type',
                'value' => 'image',
            ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Image Border', 'leadinjection'),
            'param_name' => 'image_border_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'textarea_html',
            'heading' => __('Textblock', 'leadinjection'),
            'param_name' => 'content',
            'admin_label' => true,
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Review Author', 'leadinjection'),
            'param_name' => 'review_block_author',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Review Author Source', 'leadinjection'),
            'param_name' => 'review_block_author_source',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Review color', 'leadinjection'),
            'param_name' => 'content_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Author color', 'leadinjection'),
            'param_name' => 'author_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Source color', 'leadinjection'),
            'param_name' => 'author_source_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),array(
            'type' => 'colorpicker',
            'heading' => __('Rating color', 'leadinjection'),
            'param_name' => 'rating_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'review_block_shadow',
            'value' => array(__('Display boxed with over shadow effect', 'leadinjection') => 'review-block-shadow'),
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_review_block_params = leadinjection_add_responsive_helper_params($leadinjection_review_block_params);

    vc_map(array(
            "name" => __("Review Block", "leadinjection"),
            "base" => "leadinjection_review_block",
            "class" => "",
            "icon" => 'li-icon li-review-block',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('A simple review block', 'leadinjection'),
            "params" => $leadinjection_review_block_params
        )
    );
}

