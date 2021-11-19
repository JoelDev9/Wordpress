<?php

/*
    Image Testimonial Slider
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_image_testimonial_slider', 'leadinjection_image_testimonial_slider_shortcode');

function leadinjection_image_testimonial_slider_shortcode($atts, $content)
{
    global $lp_slider_count;
    $lp_slider_count = 0;

    $default_atts = array(
        'type' => 'fontawesome',
        'content' => !empty($content) ? $content : '',
        'testimonial_color' => '',
        'testimonial_outline' => '',
        'animation' => 'none',
        'css' => '',
        'xclass' => '',
        'shortcode_id' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('image_testimonial_slider_', $shortcode_id);
    $wrapper_class = array('carousel', 'slide', 'image-testimonial-slider', $xclass, $testimonial_outline, $responsive_helper);

    // Create Output

    $child_atts = leadinjection_attribute_map($content);
    $indicators = '';
    $indicators_counter = 0;
    foreach ($child_atts as $key => $value) {

        if (isset($value['leadinjection_image_testimonial_slider_item']['author_image'])) {
            $author_image = $value['leadinjection_image_testimonial_slider_item']['author_image'];
        } else {
            $author_image = '';
        }

        $author_image_path = ('' != $author_image) ? wp_get_attachment_image_src($author_image) : array(get_template_directory_uri() . '/img/testimonial-avatar.png');
        $active = (0 == $indicators_counter) ? 'class="active"' : null;
        $author = (isset($value['leadinjection_image_testimonial_slider_item']['author'])) ? $value['leadinjection_image_testimonial_slider_item']['author'] : null;

        $indicators .= '<li data-target="#' . esc_attr($shortcode_id) . '" data-slide-to="' . $indicators_counter . '" ' . $active . '>';
        $indicators .= '<img class="image-testimonial-slider-image" src="' . esc_url($author_image_path[0]) . '" alt="' . esc_attr($author) . '" />';
        $indicators .= '</li>';

        $indicators_counter++;
    }

    $output_style = '';
    if ('' != $testimonial_color) {
        $output_style = '<style scoped>';
        $output_style .= '#' . $shortcode_id . ' .image-testimonial-slider-indicators li.active{ border-color: ' . $testimonial_color . '; }';
        $output_style .= '#' . $shortcode_id . ' .image-testimonial-slider-slides{ background-color: ' . $testimonial_color . '; }';
        $output_style .= '#' . $shortcode_id . '.outline .image-testimonial-slider-slides{ background-color: transparent; border-color: ' . $testimonial_color . '; }';
        $output_style .= '#' . $shortcode_id . ' .image-testimonial-slider-arrow{ border-top-color: ' . $testimonial_color . '; }';
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

    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" data-ride="carousel" <?php echo $data_effect; ?>>

        <div class="carousel-inner image-testimonial-slider-slides" role="listbox">
        <?php echo do_shortcode($content); ?>
        </div>
        <div class="image-testimonial-slider-arrow"></div>

        <ol class="carousel-indicators image-testimonial-slider-indicators">
            <?php echo $indicators; ?>
        </ol>
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

add_shortcode('leadinjection_image_testimonial_slider_item', 'leadinjection_image_testimonial_slider_shortcode_item');

function leadinjection_image_testimonial_slider_shortcode_item($atts, $content)
{
    $defaults = shortcode_atts(array(
        'content' => !empty($content) ? $content : '',
        'content_text_color' => '',
        'author_image' => '',
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

    $author_source = ('' != $author_source) ? ' <cite title="Source Title">' . $author_source . '</cite>' : '';

    $content_text_color = ('' != $content_text_color) ? 'style="color: ' . $content_text_color . '"' : null;
    $author_text_color = ('' != $author_text_color) ? 'style="color: ' . $author_text_color . '"' : null;


    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>


    <div class="item image-testimonial-slider-item <?php echo $active; ?>">
        <blockquote>
            <p <?php echo $content_text_color ?>><?php echo do_shortcode($content); ?></p>
            <footer <?php echo $author_text_color ?>><?php echo $author; ?> <?php echo $author_source; ?></footer>
        </blockquote>
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

add_action('vc_before_init', 'leadinjection_image_testimonial_slider_vc');

function leadinjection_image_testimonial_slider_vc()
{
    $leadinjection_image_testimonial_slider_params = array(
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a testimonial background color', 'leadinjection'),
            'param_name' => 'testimonial_color',
        ),
        array(
            'type' => 'checkbox',
            'heading' => __('Outline', 'leadinjection'),
            'param_name' => 'testimonial_outline',
            'value' => array(__('Display only the outline!', 'leadinjection') => 'outline'),
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_image_testimonial_slider_params = leadinjection_add_responsive_helper_params($leadinjection_image_testimonial_slider_params);

    vc_map(array(
            "name" => __("Image Testimonial Slider", "leadinjection"),
            "base" => "leadinjection_image_testimonial_slider",
            "as_parent" => array('only' => 'leadinjection_image_testimonial_slider_item'),
            "content_element" => true,
            "show_settings_on_create" => true,
            "is_container" => true,
            "class" => '',
            "icon" => 'li-icon li-testimonial-slider',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Testimonial Slider with an Image', 'leadinjection'),
            "params" => $leadinjection_image_testimonial_slider_params,
            "js_view" => 'VcColumnView'
        )
    );

    vc_map(array(
            "name" => __("Testimonial Item", "leadinjection"),
            "base" => "leadinjection_image_testimonial_slider_item",
            "icon" => 'li-icon li-testimonial-slider',
            "content_element" => true,
            "as_child" => array('only' => 'leadinjection_image_testimonial_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
            "params" => array(
                array(
                    'type' => 'textarea',
                    'heading' => __('Enter testimonial comment here', 'leadinjection'),
                    'param_name' => 'content',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select a comment color', 'leadinjection'),
                    'param_name' => 'content_text_color',
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => __('Add an author image', 'leadinjection'),
                    'param_name' => 'author_image',
                    'value' => '',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Enter testimonial author here', 'leadinjection'),
                    'param_name' => 'author',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Author text color', 'leadinjection'),
                    'param_name' => 'author_text_color',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Enter testimonial source here', 'leadinjection'),
                    'param_name' => 'author_source',
                    'admin_label' => true,
                ),
                leadinjection_xclass_field(),
            )
        )
    );
}


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_leadinjection_image_testimonial_slider extends WPBakeryShortCodesContainer
    {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_leadinjection_image_testimonial_slider_item extends WPBakeryShortCode
    {
    }
}