<?php

/*
    Rating Slider
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_rating_slider', 'leadinjection_rating_slider_shortcode');

function leadinjection_rating_slider_shortcode($atts, $content)
{
    global $lp_slider_count;
    $lp_slider_count = 0;

    $default_atts = array(
        'type' => 'fontawesome',
        'content' => !empty($content) ? $content : '',
        'rating_color' => '',
        'comment_color' => '',
        'author_color' => '',
        'source_color' => '',
        'animation' => 'none',
        'css' => '',
        'xclass' => '',
        'shortcode_id' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('rating_slider_', $shortcode_id);
    $wrapper_class = array('li-rating-slider', $xclass, $responsive_helper);

    // Create Output

    $child_atts = leadinjection_attribute_map($content);
    $indicators = '';
    $indicators_counter = 0;
    foreach ($child_atts as $key => $value) {
        $active = (0 == $indicators_counter) ? 'class="active"' : null;
        $indicators .= '<li data-target="#' . esc_attr($shortcode_id) . '" data-slide-to="' . esc_attr($indicators_counter) . '" ' . $active . '"></li>';
        $indicators_counter++;
    }

    $output_style = '';
    if (!empty($rating_color) || !empty($comment_color) || !empty($author_color) || !empty($source_color)) {
        $output_style  = '<style>';
        $output_style .= (!empty($rating_color)) ? ' .li-rating-slider .stars{ color: ' . $rating_color . '; } ' : null;
        $output_style .= (!empty($comment_color)) ? '.li-rating-slider .review{ color: ' . $comment_color . '; } ' : null;
        $output_style .= (!empty($author_color)) ? ' .li-rating-slider .author{ color: ' . $author_color . '; } ' : null;
        $output_style .= (!empty($source_color)) ? ' .li-rating-slider .author cite{ color: ' . $source_color . '; }' : null;
        $output_style .= '</style>';
    }


    $data_effect = '';
    if ('none' !== $animation) {
        leadinjection_enqueue_animation();
        $wrapper_class[] = 'li-animate ';
        $data_effect = 'data-effect="' . esc_attr($animation) . '"';
    }

    // Create wrapper classes string
    $wrapper_class  = leadinjection_wrapper_class($wrapper_class, $css);

    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>

    <?php echo $output_style; ?>

    <div class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>>

        <div class="stars">
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star big"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
        </div>


        <div id="<?php echo esc_attr($shortcode_id); ?>" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <?php echo do_shortcode($content); ?>
            </div>

            <!-- Review Nav start -->
            <ol class="carousel-indicators">
                <?php echo $indicators; ?>
            </ol>
            <!-- Review Nav end -->

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
    Image Review Slider Item
*/

add_shortcode('leadinjection_rating_slider_item', 'leadinjection_rating_slider_shortcode_item');

function leadinjection_rating_slider_shortcode_item($atts, $content)
{
    $defaults = shortcode_atts(array(
        'content' => !empty($content) ? $content : '',
        'content_text_color' => '',
        'author' => '',
        'author_text_color' => '',
        'author_source' => '',
        'author_source_text_color' => '',
        'author_source_linked' => '',
        'author_source_url' => '',
        'xclass' => '',
    ), $atts);


    extract($defaults);

    // TODO: Add source color and link

    // Create Output
    global $lp_slider_count;
    $active = (0 == $lp_slider_count) ? 'active' : null;

    $author_source = ('' != $author_source) ? ' <cite title="Source Title">' . esc_html($author_source) . '</cite>' : '';

    $content_text_color = ('' != $content_text_color) ? 'style="color: ' . $content_text_color . '"' : null;
    $author_text_color = ('' != $author_text_color) ? 'style="color: ' . $author_text_color . '"' : null;


    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>


    <div class="item rating-slider-item <?php echo $active; ?>">
        <div class="review">
            <p <?php echo $content_text_color ?> ><?php echo $content; ?></p>
        </div>
        <div class="author" <?php echo $author_text_color ?> >
            <?php echo esc_html($author); ?><?php echo $author_source; ?>
        </div>
    </div>


    <?php
    // End Output
    //////////////////////////////////////////////////////////////////////////////////////////

    $output = ob_get_contents();
    ob_end_clean();

    $lp_slider_count++;

    return $output;

}


/*
    Visual Composer Registration
*/

add_action('vc_before_init', 'leadinjection_rating_slider_vc');

function leadinjection_rating_slider_vc()
{
    $leadinjection_rating_slider_params = array(
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a Rating Color', 'leadinjection'),
            'param_name' => 'rating_color',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a Comment Color', 'leadinjection'),
            'param_name' => 'comment_color',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a Author Color', 'leadinjection'),
            'param_name' => 'author_color',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a Source Color', 'leadinjection'),
            'param_name' => 'source_color',
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_rating_slider_params = leadinjection_add_responsive_helper_params($leadinjection_rating_slider_params);

    vc_map(array(
            "name" => __("Rating Slider", "leadinjection"),
            "base" => "leadinjection_rating_slider",
            "as_parent" => array('only' => 'leadinjection_rating_slider_item'),
            "content_element" => true,
            "show_settings_on_create" => true,
            "is_container" => true,
            "class" => '',
            "icon" => 'li-icon li-rating-slider',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Five star rating slider', 'leadinjection'),
            "params" => $leadinjection_rating_slider_params,
            "js_view" => 'VcColumnView'
        )
    );

    vc_map(array(
            "name" => __("Rating Slider Item", "leadinjection"),
            "base" => "leadinjection_rating_slider_item",
            "content_element" => true,
            "icon" => 'li-icon li-rating-slider',
            "as_child" => array('only' => 'leadinjection_rating_slider'),
            "params" => array(
                array(
                    'type' => 'textarea',
                    'heading' => __('Comment', 'leadinjection'),
                    'param_name' => 'content',
                    'description' => __('Enter commeten here', 'leadinjection'),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Author', 'leadinjection'),
                    'param_name' => 'author',
                    'description' => __('Enter section title here', 'leadinjection'),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Source', 'leadinjection'),
                    'param_name' => 'author_source',
                    'description' => __('Enter section title here', 'leadinjection'),
                    'admin_label' => true,
                ),
                leadinjection_xclass_field(),
            )
        )
    );
}


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_leadinjection_rating_slider extends WPBakeryShortCodesContainer
    {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_leadinjection_rating_slider_item extends WPBakeryShortCode
    {
    }
}