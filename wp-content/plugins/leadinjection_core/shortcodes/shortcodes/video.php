<?php

/*
    Video
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_video', 'leadinjection_video_shortcode');

function leadinjection_video_shortcode($atts, $content)
{
    $default_atts = array(
        'content' => !empty($content) ? $content : '',
        'embed_code' => '',
        //'video_width' => '',
        'ratio' => 'embed-responsive-16by9',
        //'alignment' => 'center',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('video_', $shortcode_id);
    $wrapper_class = array('lp-video', 'embed-responsive', $xclass, $ratio, $responsive_helper);

    $embed_code = base64_decode($embed_code);
    $embed_code = urldecode($embed_code);

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

    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>>
        <?php echo $embed_code; ?>
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

add_action('vc_before_init', 'leadinjection_video_vc');

function leadinjection_video_vc()
{
    $leadinjection_video_params = array(
        array(
            'type' => 'textarea_raw_html',
            'heading' => __('Past your Youtube/Vimeo embed code here', 'leadinjection'),
            'param_name' => 'embed_code',
            'value' => '',
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Select a video ', 'leadinjection'),
            'param_name' => 'ratio',
            'value' => array(
                __('16:9 aspect ratio', 'leadinjection') => 'embed-responsive-16by9',
                __('4:3 aspect ratio', 'leadinjection') => 'embed-responsive-4by3',
            ),
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_video_params = leadinjection_add_responsive_helper_params($leadinjection_video_params);

    vc_map(array(
            "name" => __("Video", "leadinjection"),
            "base" => "leadinjection_video",
            "class" => "",
            "icon" => 'li-icon li-embed-video',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Embed a Youtube/Vimeo Video', 'leadinjection'),
            "params" => $leadinjection_video_params
        )
    );
}

