<?php

/*
    Icon
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_icon', 'leadinjection_icon_shortcode');

function leadinjection_icon_shortcode($atts)
{
    $default_atts = array(
        'icon_type' => 'fontawesome',
        'icon_fontawesome' => 'fa fa-adjust',
        'icon_iconssolid' => 'is is-icon-zynga',
        'icon_openiconic' => 'vc-oi vc-oi-dial',
        'icon_typicons' => 'typcn typcn-adjust-brightness',
        'icon_entypo' => 'entypo-icon entypo-icon-note',
        'icon_linecons' => 'vc_li vc_li-heart',
        'icon_image' => '',
        'icon_style' => '',
        'icon_size' => '',
        'alignment' => '',
        'icon_sign_color' => '',
        'icon_background_color' => '',
        'icon_border_color' => '',
        'linked' => false,
        'link_url' => '',
        'animation' => 'none',
        'css' => '',
        'xclass' => '',
        'shortcode_id' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('icon_', $shortcode_id);
    $wrapper_class = array('li-icon', $xclass, $responsive_helper, $alignment);

    $icon_class = array($icon_style, $icon_size);

    // Enqueue needed icon font.
    vc_icon_element_fonts_enqueue( $icon_type );

    switch ($icon_type) {
        case 'fontawesome':
            $icon = '<i class="' . $icon_fontawesome . '"></i>';
            break;

        case 'iconssolid':
            $icon = '<span class="' . $icon_iconssolid . '"></span>';
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
    }

    if('add_link' === $linked){
        $link = vc_build_link( $link_url );
    }

    $data_effect = '';
    if ('none' !== $animation) {
        leadinjection_enqueue_animation();
        $wrapper_class[] = 'li-animate';
        $data_effect = 'data-effect="' . esc_attr($animation) . '"';
    }


    $style  = '';

    // Default
    $style .= (!empty($icon_sign_color)) ? '#'.$shortcode_id.' .li-icon-sign { color: '.$icon_sign_color.';}' : null;
    $style .= (!empty($icon_border_color)) ? '#'.$shortcode_id.' .li-icon-sign { border-color: '.$icon_border_color.';}' : null;
    $style .= (!empty($icon_background_color)) ? '#'.$shortcode_id.' .li-icon-sign { background-color: '.$icon_background_color.';}' : null;

    // Hover
    $style .= (!empty($icon_sign_color)) ? '#'.$shortcode_id.' .li-icon-sign:hover { color: '.$icon_background_color.';}' : null;
    $style .= (!empty($icon_background_color)) ? '#'.$shortcode_id.' .li-icon-sign:hover { background-color: '.$icon_sign_color.';}' : null;

    $style .= (!empty($icon_sign_color)) ? '#'.$shortcode_id.':hover .li-icon-sign a { color: '.$icon_background_color.';}' : null;
    $style .= (!empty($icon_sign_color)) ? '#'.$shortcode_id.' .li-icon-sign a { color: '.$icon_sign_color.';}' : null;

    $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;
    
    
    
    // Create wrapper classes string
    $wrapper_class  = leadinjection_wrapper_class($wrapper_class, $css);

    $icon_class = implode(' ', $icon_class);

    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>


    <?php echo $output_style; ?>

    <div class="<?php echo esc_attr($wrapper_class); ?>" id="<?php echo esc_attr($shortcode_id); ?>" <?php echo $data_effect; ?>>
        <?php if('add_link' === $linked){ echo '<a href="' . $link['url'] . '" target="' . $link['target'] . '" title="' . $link['title'] . '">'; } ?>
            <div class="li-icon-sign <?php echo esc_attr($icon_class); ?>">
                <?php echo $icon; ?>
            </div>
        <?php if('add_link' === $linked){ echo '</a>'; } ?>
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

add_action('vc_before_init', 'leadinjection_icon_vc');

function leadinjection_icon_vc()
{
    $leadinjection_icon_params = array(
        // Icon select fields
        leadinjection_icon_library_field(),
        leadinjection_icon_fontawsome_field(),
        leadinjection_icon_iconssolid_field(),
        leadinjection_icon_openiconic_field(),
        leadinjection_icon_typicons_field(),
        leadinjection_icon_entypo_field(),
        leadinjection_icon_linecons_field(),
        array(
            'type' => 'dropdown',
            'heading' => __('Select a icon style.', 'leadinjection'),
            'param_name' => 'icon_style',
            'admin_label' => true,
            'value' => array(
                __('Default', 'leadinjection') => '',
                __('Round', 'leadinjection') => 'round',
                __('Square', 'leadinjection') => 'square',
                __('Underline', 'leadinjection') => 'underline',
                __('Rounded', 'leadinjection') => 'rounded',
                __('Zoom Big', 'leadinjection') => 'big',
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'not_empty' => false,
                'value' => array('fontawesome', 'iconssolid', 'openiconic', 'typicons', 'entypo', 'linecons')
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Select a Icon size', 'leadinjection'),
            'admin_label' => true,
            'param_name' => 'icon_size',
            'value' => array(
                __('Default', 'leadinjection') => 'none',
                __('Mini', 'leadinjection') => 'x05',
                __('Small', 'leadinjection') => 'x07',
                __('Large', 'leadinjection') => 'x12',
                __('Extra Large', 'leadinjection') => 'x15',
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Select button alignment', 'leadinjection'),
            'param_name' => 'alignment',
            'value' => array(
                __('Default Alignment', 'leadinjection') => '',
                __('Inline', 'leadinjection') => 'inline',
                __('Left', 'leadinjection') => 'left',
                __('Center', 'leadinjection') => 'center',
                __('Rigth', 'leadinjection') => 'right',
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Icon color', 'leadinjection'),
            'param_name' => 'icon_sign_color',
            'edit_field_class' => 'vc_col-sm-4'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Icon background color', 'leadinjection'),
            'param_name' => 'icon_background_color',
            'dependency' => array(
                'element' => 'icon_style',
                'not_empty' => false,
                'value' => array('round', 'square', 'rounded')
            ),
            'edit_field_class' => 'vc_col-sm-4'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Icon border color', 'leadinjection'),
            'param_name' => 'icon_border_color',
            'dependency' => array(
                'element' => 'icon_style',
                'not_empty' => false,
                'value' => array('round', 'square', 'rounded', 'underline')
            ),
            'edit_field_class' => 'vc_col-sm-4'
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'linked',
            'value' => array(__('Add a link to the feature', 'leadinjection') => 'add_link'),
        ),
        array(
            'type' => 'vc_link',
            'param_name' => 'link_url',
            'dependency' => array(
                'element' => 'linked',
                'not_empty' => false,
                'value' => array('add_link')
            ),
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_icon_params = leadinjection_add_responsive_helper_params($leadinjection_icon_params);

    vc_map(array(
            "name" => __("Icon", "leadinjection"),
            "base" => "leadinjection_icon",
            "icon" => 'li-icon li-single-icon',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Create an Icon', 'leadinjection'),
            "params" => $leadinjection_icon_params
        )
    );
}
