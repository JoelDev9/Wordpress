<?php

/*
    Textblock
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_textblock', 'leadinjection_textblock_shortcode');

function leadinjection_textblock_shortcode($atts, $content)
{

    $default_atts = array(
        'content' => !empty($content) ? $content : '',
        'content_color' => '',
        'font_size' => '',
        'line_height' => '',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('textblock_', $shortcode_id);
    $wrapper_class = array('li-textblock', $xclass, $responsive_helper);

    $style  = '';
    $style .= (!empty($content_color)) ? "#$shortcode_id, #$shortcode_id p { color: $content_color; }" : null;
    $style .= (!empty($font_size)) ? "#$shortcode_id, #$shortcode_id p { font-size: $font_size; }" : null;
    $style .= (!empty($line_height)) ? "#$shortcode_id, #$shortcode_id p { line-height: $line_height; }" : null;

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
        <?php echo wpb_js_remove_wpautop( $content, true ); ?>
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

add_action('vc_before_init', 'leadinjection_textblock_vc');

function leadinjection_textblock_vc()
{
    $leadinjection_textblock_params = array(
        array(
            'type' => 'textarea_html',
            'heading' => __('Textblock', 'leadinjection'),
            'param_name' => 'content',
            'admin_label' => true,
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Textblock color', 'leadinjection'),
            'param_name' => 'content_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'custom_font_size',
            'value' => array(__('Set a custom font size', 'leadinjection') => 'yes'),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Font size (e.g. 16px)', 'leadinjection'),
            'param_name' => 'font_size',
            'edit_field_class' => 'vc_col-sm-6',
            'value' => '',
            'dependency' => array(
                'element' => 'custom_font_size',
                'value' => 'yes',
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Line height (e.g. 16px)', 'leadinjection'),
            'param_name' => 'line_height',
            'edit_field_class' => 'vc_col-sm-6',
            'value' => '',
            'dependency' => array(
                'element' => 'custom_font_size',
                'value' => 'yes',
            ),
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_textblock_params = leadinjection_add_responsive_helper_params($leadinjection_textblock_params);

    vc_map(array(
            "name" => __("Textblock", "leadinjection"),
            "base" => "leadinjection_textblock",
            "class" => "",
            "icon" => 'li-icon li-textblock',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('A simple textblock', 'leadinjection'),
            "params" => $leadinjection_textblock_params
        )
    );
}

