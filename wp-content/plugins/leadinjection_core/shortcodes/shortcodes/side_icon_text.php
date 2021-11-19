<?php

/*
    Side Icon Text
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_side_icon_text', 'leadinjection_side_icon_text_shortcode');

function leadinjection_side_icon_text_shortcode($atts, $content)
{
    $default_atts = array(
        'icon_style' => '',
        'icon_outline' => '',
        'icon_type' => 'fontawesome',
        'icon_fontawesome' => 'fa fa-adjust',
        'icon_iconssolid' => 'is is-icon-zynga',
        'icon_openiconic' => 'vc-oi vc-oi-dial',
        'icon_typicons' => 'typcn typcn-adjust-brightness',
        'icon_entypo' => 'entypo-icon entypo-icon-note',
        'icon_linecons' => 'vc_li vc_li-heart',
        'icon_image' => '',
        'icon_color' => null,
        'icon_background_color' => null,
        'icon_border_color' => null,
        'title' => '',
        'title_color' => null,
        'content' => !empty($content) ? $content : '',
        'content_color' => null,
        'align' => 'left',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('side_icon_text_', $shortcode_id);
    $wrapper_class = array('li-side-icon-text', $xclass, $align, $responsive_helper);

    if($icon_outline){
        $icon_outline = 'li-side-icon-text-icon_outline';
    }

    // Enqueue needed icon font.
    vc_icon_element_fonts_enqueue( $icon_type );

    $output_style = null;

    // Icon Color
    if (!is_null($icon_color)) {
        $output_style .= '#'.$shortcode_id.' .li-side-icon-text-icon {color: '. esc_attr($icon_color) .';}';
    }


    // Icon Background Color
    if (!is_null($icon_background_color) && 'li-side-icon-text-icon_round' == $icon_style) {
        $output_style .= '#'.$shortcode_id.' .li-side-icon-text-icon_round {background-color: '. esc_attr($icon_background_color) .';}';
    }

    if (!is_null($icon_background_color) && 'li-side-icon-text-icon_square' == $icon_style) {
        $output_style .= '#'.$shortcode_id.' .li-side-icon-text-icon_square {background-color: '. esc_attr($icon_background_color) .';}';
    }

    if (!is_null($icon_background_color) && 'li-side-icon-text-icon_rounded' == $icon_style) {
        $output_style .= '#'.$shortcode_id.' .li-side-icon-text-icon_rounded {background-color: '. esc_attr($icon_background_color) .';}';
    }

    if (!is_null($icon_background_color) && 'li-side-icon-text-icon_hexagon' == $icon_style) {
        $output_style .= '#'.$shortcode_id.' .li-side-icon-text-icon_hexagon {background-color: '. esc_attr($icon_background_color) .';}';
        $output_style .= '#'.$shortcode_id.' .li-side-icon-text-icon_hexagon:before {border-bottom-color: '. esc_attr($icon_background_color) .';}';
        $output_style .= '#'.$shortcode_id.' .li-side-icon-text-icon_hexagon:after {border-top-color: '. esc_attr($icon_background_color) .';}';
    }

    // Icon Border Color
    if (!is_null($icon_border_color) && 'li-side-icon-text-icon_underline' == $icon_style) {
        $output_style .= '#'.$shortcode_id.' .li-side-icon-text-icon_underline {border-color: '. esc_attr($icon_border_color) .';}';
    }elseif(!is_null($icon_border_color)){
        $output_style .= '#'.$shortcode_id.' .li-side-icon-text-icon_outline {border-color: '. esc_attr($icon_border_color) .';}';
    }

    if (!is_null($icon_border_color) && 'li-side-icon-text-icon_hexagon' == $icon_style) {
        $output_style .= '#'.$shortcode_id.' .li-side-icon-text-icon_hexagon.li-side-icon-text-icon_outline {border-color: '. esc_attr($icon_border_color) .';}';
        $output_style .= '#'.$shortcode_id.' .li-side-icon-text-icon_hexagon.li-side-icon-text-icon_outline:before {border-color: '. esc_attr($icon_border_color) .';}';
        $output_style .= '#'.$shortcode_id.' .li-side-icon-text-icon_hexagon.li-side-icon-text-icon_outline:after {border-color: '. esc_attr($icon_border_color) .';}';
    }

    // Title Color
    if (!is_null($title_color)) {
        //$title_color = 'style="color: ' . esc_attr($title_color) . ';"';
        $output_style .= '#'.$shortcode_id.' .li-side-icon-text-title {color: '. esc_attr($title_color) .';}';
    }

    // Content Color
    if (!is_null($content_color)) {
        //$content_color = 'style="color: ' . esc_attr($content_color) . ';"';
        $output_style .= '#'.$shortcode_id.' .li-side-icon-text-content {color: '. esc_attr($content_color) .';}';
    }


    switch ($icon_type) {
        case 'fontawesome':
            $icon = '<i class="' . esc_attr($icon_fontawesome) . '"></i>';
            break;

        case 'openiconic':
            $icon = '<span class="oi ' . esc_attr($icon_openiconic) . '" aria-hidden="true"></span>';
            break;

        case 'typicons':
            $icon = '<span class="' . esc_attr($icon_typicons) . '"></span>';
            break;

        case 'entypo':
            $icon = '<span class="' . esc_attr($icon_entypo) . '"></span>';
            break;

        case 'linecons':
            $icon = '<span class="' . esc_attr($icon_linecons) . '"></span>';
            break;

        case 'iconssolid':
            $icon = '<span class="' . esc_attr($icon_iconssolid) . '"></span>';
            break;

        case 'image':
            $icon_class[] = 'image';
            $image_url = wp_get_attachment_image_src($icon_image, 'full');
            $icon = '<img src="' . $image_url[0] . '" alt="" />';
            break;
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


    <?php echo (!empty($output_style)) ? '<style scoped>'.$output_style.'</style>' : ''; ?>

    <div id="<?php echo $shortcode_id; ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>>
        <div class="li-side-icon-text-icon <?php echo $icon_style.' '.$icon_outline; ?>"><?php echo $icon; ?></div>
        <h3 class="li-side-icon-text-title"><?php echo esc_html($title); ?></h3>
        <div class="li-side-icon-text-content"><?php echo $content; ?></div>
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

add_action('vc_before_init', 'leadinjection_side_icon_text_vc');

function leadinjection_side_icon_text_vc()
{
    $leadinjection_side_icon_text_params = array(
        array(
            'type' => 'dropdown',
            'heading' => __('Select a icon style', 'leadinjection'),
            'param_name' => 'icon_style',
            'value' => array(
                __('Default', 'leadinjection') => '',
                __('Round', 'leadinjection') => 'li-side-icon-text-icon_round',
                __('Square', 'leadinjection') => 'li-side-icon-text-icon_square',
                __('Rounded', 'leadinjection') => 'li-side-icon-text-icon_rounded',
                __('Hexagon', 'leadinjection') => 'li-side-icon-text-icon_hexagon',
                __('Underline', 'leadinjection') => 'li-side-icon-text-icon_underline'
            ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => __('Show element outline', 'leadinjection'),
            'param_name' => 'icon_outline',
            'dependency' => array(
                'element' => 'icon_style',
                'value' => array('li-side-icon-text-icon_round', 'li-side-icon-text-icon_square', 'li-side-icon-text-icon_rounded', 'li-side-icon-text-icon_hexagon'),
            ),
        ),
        // Icon select fields
        leadinjection_icon_library_field(),
        leadinjection_icon_fontawsome_field(),
        leadinjection_icon_iconssolid_field(),
        leadinjection_icon_openiconic_field(),
        leadinjection_icon_typicons_field(),
        leadinjection_icon_entypo_field(),
        leadinjection_icon_linecons_field(),
        leadinjection_icon_image_field(),
        array(
            'type' => 'colorpicker',
            'heading' => __('Icon color', 'leadinjection'),
            'param_name' => 'icon_color',
            'edit_field_class' => 'vc_col-sm-4',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Background color', 'leadinjection'),
            'param_name' => 'icon_background_color',
            'edit_field_class' => 'vc_col-sm-4',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Border color', 'leadinjection'),
            'param_name' => 'icon_border_color',
            'edit_field_class' => 'vc_col-sm-4',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Enter title here', 'leadinjection'),
            'param_name' => 'title',
            'admin_label' => true,
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a title color', 'leadinjection'),
            'param_name' => 'title_color',
        ),
        array(
            'type' => 'textarea_html',
            'heading' => __('Enter content here', 'leadinjection'),
            'param_name' => 'content',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a content color', 'leadinjection'),
            'param_name' => 'content_color',
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Select a content alignment', 'leadinjection'),
            'param_name' => 'align',
            'value' => array(
                __('Align left', 'leadinjection') => 'left',
                __('Align right', 'leadinjection') => 'right',),
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_side_icon_text_params = leadinjection_add_responsive_helper_params($leadinjection_side_icon_text_params);

    vc_map(array(
            "name" => __("Side Icon Text", "leadinjection"),
            "base" => "leadinjection_side_icon_text",
            "class" => "",
            "icon" => 'li-icon li-side-icon',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Text with an Icon (left or right)', 'leadinjection'),
            "params" => $leadinjection_side_icon_text_params,
            "show_settings_on_create" => true,
        )
    );
}

