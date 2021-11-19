<?php

/*
    Default Image
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_before_after_image', 'leadinjection_before_after_image_shortcode');

function leadinjection_before_after_image_shortcode($atts, $content)
{
    $default_atts = array(
        'content' => !empty($content) ? $content : '',
        'image_before' => '',
        'image_after' => '',
        'image_size' => 'full',
        'slider_offset' => '',
        'alignment' => '',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('ba_image_', $shortcode_id);
    $wrapper_class = array('li-ba-image', $xclass, $alignment, $responsive_helper);

    // Enqueue TwentyTwenty JS and CSS.
    wp_enqueue_script('twentytwenty-js');
    wp_enqueue_style('twentytwenty-css');

    // TODO: Add Image Action: Lightbox etc.

    if ( preg_match_all( '/(\d+)x(\d+)/', $image_size, $sizes ) ) {
        $image_size = array($sizes[1][0], $sizes[2][0]);
    }


    $palaceholder = '<img alt="Placeholder" src="' . get_template_directory_uri() . '/img/placeholder.png" class="img-responsive"/>';
    $image_before_str = ('' != $image_before) ? wp_get_attachment_image($image_before, $image_size, false, array('class' => 'img-responsive')) : $palaceholder;
    $image_after_str = ('' != $image_after) ? wp_get_attachment_image($image_after, $image_size, false, array('class' => 'img-responsive')) : $palaceholder;

    $imgae_data = ('' != $image_before) ? wp_get_attachment_image_src($image_before,$image_size) : wp_get_attachment_image_src($image_after,$image_size);
   // var_dump($imgae_data);

    // Element Style
    $output_style  = '<style scoped>';
    $output_style .= '#'.$shortcode_id.' { max-width:'.$imgae_data[1].'px; }';
    $output_style .= '</style>';

    $slider_offset = ('' != $slider_offset) ? $slider_offset : 0.5;

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

    <script>

            jQuery(window).on('load',function() {
                jQuery("#<?php echo esc_attr($shortcode_id); ?>").twentytwenty({
                    default_offset_pct:	<?php echo $slider_offset; ?>
                });
            });

    </script>

    <?php echo $output_style; ?>

    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>>
        <?php echo $image_before_str ?>
        <?php echo $image_after_str ?>
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

add_action('vc_before_init', 'leadinjection_before_after_image_vc');

function leadinjection_before_after_image_vc()
{
    $leadinjection_before_after_image_params = array(
        array(
            'type' => 'attach_image',
            'heading' => __('Select a before image', 'leadinjection'),
            'param_name' => 'image_before',
            'value' => '',
        ),
        array(
            'type' => 'attach_image',
            'heading' => __('Select a after image', 'leadinjection'),
            'param_name' => 'image_after',
            'value' => '',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Image size', 'leadinjection'),
            'param_name' => 'image_size',
            'description' => __('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'leadinjection'),
            'admin_label' => true,
            'value' => 'full',
        ),
//        array(
//            'type' => 'dropdown',
//            'heading' => __('Select image alignment', 'leadinjection'),
//            'param_name' => 'alignment',
//            'value' => array(
//                __('None', 'leadinjection') => '',
//                __('Inline', 'leadinjection') => 'inline',
//                __('Left', 'leadinjection') => 'left',
//                __('Center', 'leadinjection') => 'center',
//                __('Rigth', 'leadinjection') => 'right',
//            ),
//        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Slider Offset', 'leadinjection'),
            'param_name' => 'slider_offset',
            'value' => array(
                __('Default 50%', 'leadinjection') => '',
                __('0%', 'leadinjection') => '0',
                __('10%', 'leadinjection') => '0.1',
                __('20%', 'leadinjection') => '0.2',
                __('30%', 'leadinjection') => '0.3',
                __('40%', 'leadinjection') => '0.4',
                __('50%', 'leadinjection') => '0.5',
                __('60%', 'leadinjection') => '0.6',
                __('70%', 'leadinjection') => '0.7',
                __('80%', 'leadinjection') => '0.8',
                __('90%', 'leadinjection') => '0.9',
                __('100%', 'leadinjection') => '1'
            ),
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_before_after_image_params = leadinjection_add_responsive_helper_params($leadinjection_before_after_image_params);

    vc_map(array(
            "name" => __("Before After Image", "leadinjection"),
            "base" => "leadinjection_before_after_image",
            "class" => "",
            "icon" => 'li-icon li-image',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Highlight the differences between two images.', 'leadinjection'),
            "params" => $leadinjection_before_after_image_params
        )
    );
}

