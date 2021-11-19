<?php

/*
    Textblock
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_alert', 'leadinjection_alert_shortcode');

function leadinjection_alert_shortcode($atts, $content)
{
    $default_atts = array(
        'content' => !empty($content) ? $content : '',
        'alert_style' => 'li-alert',
        'alert_type' => 'li-alert_success',
        'icon_type' => 'fontawesome',
        'icon_fontawesome' => 'fa fa-adjust',
        'icon_iconssolid' => 'is is-icon-zynga',
        'icon_openiconic' => 'vc-oi vc-oi-dial',
        'icon_typicons' => 'typcn typcn-adjust-brightness',
        'icon_entypo' => 'entypo-icon entypo-icon-note',
        'icon_linecons' => 'vc_li vc_li-heart',
        'alert_dismissible' => '',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    // Enqueue needed icon font.
    vc_icon_element_fonts_enqueue($icon_type);

    $shortcode_id = leadinjection_custom_id('alert_', $shortcode_id);
    $wrapper_class = array('alert', $alert_style, $alert_type, $xclass, $responsive_helper);

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

    <div class="<?php echo esc_attr($wrapper_class); ?>" role="alert" id="<?php echo esc_attr($shortcode_id); ?> <?php echo $data_effect; ?>">
        <?php if(!empty($alert_dismissible)) : ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php endif; ?>
        <div class="alert-icon"><?php echo $icon; ?></div>
        <div class="alert-content"><?php echo wpb_js_remove_wpautop( $content, true ); ?></div>
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

add_action('vc_before_init', 'leadinjection_alert_vc');

function leadinjection_alert_vc()
{
    $leadinjection_alert_params = array(
        array(
            'type' => 'dropdown',
            'heading' => __('Alert style', 'leadinjection'),
            'param_name' => 'alert_style',
            'value' => array(
                __('Classic Style', 'leadinjection') => 'li-alert',
                __('Light Color', 'leadinjection') => 'li-alert_light-color',
                __('Solid Color', 'leadinjection') => 'li-alert_solid-color',),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Alert type', 'leadinjection'),
            'param_name' => 'alert_type',
            'value' => array(
                __('Success', 'leadinjection') => 'li-alert_success',
                __('Info', 'leadinjection') => 'li-alert_info',
                __('Warning', 'leadinjection') => 'li-alert_warning',
                __('Danger', 'leadinjection') => 'li-alert_danger',),
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'alert_dismissible',
            'value' => array(__('Make alert dismissible', 'leadinjection') => true),
        ),
        // Icon select fields
        leadinjection_icon_library_field(),
        leadinjection_icon_fontawsome_field(),
        leadinjection_icon_iconssolid_field(),
        leadinjection_icon_openiconic_field(),
        leadinjection_icon_typicons_field(),
        leadinjection_icon_entypo_field(),
        leadinjection_icon_linecons_field(),
        array(
            'type' => 'textarea_html',
            'heading' => __('Alert content', 'leadinjection'),
            'param_name' => 'content',
            'admin_label' => true,
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_alert_params = leadinjection_add_responsive_helper_params($leadinjection_alert_params);

    vc_map(array(
            "name" => __("Alert", "leadinjection"),
            "base" => "leadinjection_alert",
            "class" => "",
            "icon" => 'li-icon li-alert',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Provide contextual feedback messages', 'leadinjection'),
            "params" => $leadinjection_alert_params
        )
    );
}

