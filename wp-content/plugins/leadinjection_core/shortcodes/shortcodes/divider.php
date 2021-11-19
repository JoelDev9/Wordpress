<?php

/*
    Video
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_dividers', 'leadinjection_dividers_shortcode');

function leadinjection_dividers_shortcode($atts, $content)
{
    $default_atts = array(
        'content' => !empty($content) ? $content : '',
        'divider_style' => 'li-divider_line',
        'divider_color' => '',
        'divider_color_middle' => '',
        'divider_icon_color' => '',
        'divider_icon_background_color' => '',
        'icon_type' => 'fontawesome',
        'icon_fontawesome' => 'fa fa-adjust',
        'icon_iconssolid' => 'is is-icon-zynga',
        'icon_openiconic' => 'vc-oi vc-oi-dial',
        'icon_typicons' => 'typcn typcn-adjust-brightness',
        'icon_entypo' => 'entypo-icon entypo-icon-note',
        'icon_linecons' => 'vc_li vc_li-heart',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('divider_', $shortcode_id);
    $wrapper_class = array($divider_style, $xclass, $responsive_helper);


    $style  = '';
    $style .= (!empty($divider_color)) ? '#'.$shortcode_id.' { border-color: '.$divider_color.'; }' : null;
    $style .= (!empty($divider_color_middle)) ? '#'.$shortcode_id.':after { background-color: '.$divider_color_middle.'; }' : null;
    $style .= (!empty($divider_icon_color)) ? '#'.$shortcode_id.' .divider-icon { color: '.$divider_icon_color.'; }' : null;
    $style .= (!empty($divider_icon_background_color)) ? '#'.$shortcode_id.' .divider-icon { background-color: '.$divider_icon_background_color.'; }' : null;

    $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;

    // Enqueue needed icon font.
    vc_icon_element_fonts_enqueue($icon_type);

    switch ($icon_type) {
        case 'fontawesome':
            $icon = '<i class="' . $icon_fontawesome . '"></i>';
            break;

        case 'openiconic':
            $icon = '<span class="oi ' . $icon_openiconic . '" aria-hidden="true"></span>';
            break;

        case 'typicons':
            $icon = '<span class="' . $icon_typicons . '"></span>';
            break;

        case 'entypo':
            $icon = '<span class="' . $icon_entypo . '"></span>';
            break;

        case 'linecons':
            $icon = '<span class="' . $icon_linecons . '"></span>';
            break;

        case 'iconssolid':
            $icon = '<span class="' . $icon_iconssolid . '"></span>';
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

    <?php echo $output_style; ?>
    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>>
        <?php if('li-divider_line-icon-center' == $divider_style) :?>
            <div class="divider-icon"><?php echo $icon; ?></div>
        <?php endif; ?>
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

add_action('vc_before_init', 'leadinjection_dividers_vc');

function leadinjection_dividers_vc()
{
    $leadinjection_dividers_params = array(
        array(
            'type' => 'dropdown',
            'heading' => __('Divider style', 'leadinjection'),
            'param_name' => 'divider_style',
            'value' => array(
                __('Line Default', 'leadinjection') => 'li-divider_line',
                __('Double Line', 'leadinjection') => 'li-divider_double-line',
                __('Double Line Bold', 'leadinjection') => 'li-divider_double-line-bold',
                __('Dashed Line', 'leadinjection') => 'li-divider_dashed',
                __('Double Dashed Line', 'leadinjection') => 'li-divider_double-dashed',
                __('Dashed Bold', 'leadinjection') => 'li-divider_dashed-bold',
                __('Line Middle Color', 'leadinjection') => 'li-divider_line-middle-color',
                __('Line Icon Center', 'leadinjection') => 'li-divider_line-icon-center',
            ),
            'admin_label' => true,
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a divider color', 'leadinjection'),
            'param_name' => 'divider_color',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a divider middle color', 'leadinjection'),
            'param_name' => 'divider_color_middle',
            'dependency' => array(
                'element' => 'divider_style',
                'value' => array('li-divider_line-middle-color')
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a divider Icon color', 'leadinjection'),
            'param_name' => 'divider_icon_color',
            'dependency' => array(
                'element' => 'divider_style',
                'value' => array('li-divider_line-icon-center')
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a divider Icon background color', 'leadinjection'),
            'param_name' => 'divider_icon_background_color',
            'dependency' => array(
                'element' => 'divider_style',
                'value' => array('li-divider_line-icon-center')
            ),
        ),
        // Icon select fields
        leadinjection_icon_library_field('divider_style', 'li-divider_line-icon-center'),
        leadinjection_icon_fontawsome_field(),
        leadinjection_icon_iconssolid_field(),
        leadinjection_icon_openiconic_field(),
        leadinjection_icon_typicons_field(),
        leadinjection_icon_entypo_field(),
        leadinjection_icon_linecons_field(),
        
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_dividers_params = leadinjection_add_responsive_helper_params($leadinjection_dividers_params);

    vc_map(array(
            "name" => __("Divider", "leadinjection"),
            "base" => "leadinjection_dividers",
            "class" => "",
            "icon" => 'li-icon li-divider',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Horizontal separator line', 'leadinjection'),
            "params" => $leadinjection_dividers_params
        )
    );
}

