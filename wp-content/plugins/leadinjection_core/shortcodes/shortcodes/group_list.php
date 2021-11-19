<?php

/*
    Icon List
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_group_list', 'leadinjection_group_list_shortcode');

function leadinjection_group_list_shortcode($atts, $content)
{

    $default_atts = array(
        'group_list_border_color' => '',
        'group_list_hover_color' => '',
        'group_list_active_background_color' => '',
        'content' => !empty($content) ? $content : '',
        'animation' => 'none',
        'css' => '',
        'xclass' => '',
        'shortcode_id' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('glist_', $shortcode_id);
    $GLOBALS['glist_shortcode_id'] = $shortcode_id;

    $wrapper_class = array('li-list-group', 'list-group', $xclass, $responsive_helper);

    // Styles
    $style  = '';
    $style .= (!empty($group_list_border_color)) ? '#'.$shortcode_id.' .list-group-item { border-color: '.$group_list_border_color.'; }' : null;
    $style .= (!empty($group_list_hover_color)) ? '#'.$shortcode_id.' .list-group-item:hover { background-color: '.$group_list_hover_color.'; }' : null;
    $style .= (!empty($group_list_active_background_color)) ? '#'.$shortcode_id.' .list-group-item_active{ background-color: '.$group_list_active_background_color.'; }' : null;

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

    <ul class="<?php echo esc_attr($wrapper_class); ?>" id="<?php echo esc_attr($shortcode_id); ?>" <?php echo $data_effect; ?>>
        <?php echo do_shortcode($content); ?>
    </ul>


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

add_shortcode('leadinjection_group_list_item', 'leadinjection_group_list_shortcode_item');

function leadinjection_group_list_shortcode_item($atts, $content)
{

    $defaults = shortcode_atts(array(
        'content' => !empty($content) ? $content : '',
        'item_active' => '',
        'content_color' => '',
        'content_link' => '',
        'badge_value' => '',
        'badge_color' => '',
        'animation' => 'none',
        'xclass' => '',
    ), $atts);


    extract($defaults);
    $shortcode_id = leadinjection_custom_id('glist_item_', '');

    $item_class = array($xclass);

    $link_atts = '';
    if(!empty($content_link)){
        $link = vc_build_link( $content_link );
        $link_atts = 'href="' . $link['url'] . '" title="' . $link['title'] . '" target="' . $link['target'] . '"';
    }

    // Styles
    $style  = '';
    $style .= (!empty($content_color)) ? '#'.$shortcode_id.' { color: '.$content_color.'; }' : null;
    $style .= (!empty($badge_color)) ? '#'.$shortcode_id.' .badge { background-color: '.$badge_color.'; }' : null;

    $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;

    $data_effect = '';
    if ('none' !== $animation) {
        leadinjection_enqueue_animation();
        $item_class[] = 'li-animate';
        $data_effect = 'data-effect="' . $animation . '"';
    }

    $item_class = implode(' ', $item_class);


    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>

    <?php echo $output_style; ?>

    <a id="<?php echo $shortcode_id; ?>" class="list-group-item <?php echo $item_class; ?> <?php echo $item_active; ?>" <?php echo $data_effect; ?> <?php echo $link_atts; ?>>
        <?php echo $content; ?>
        <?php echo (!empty($badge_value)) ? '<span class="badge">'.$badge_value.'</span>' : ''; ?>
    </a>


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

add_action('vc_before_init', 'leadinjection_group_list_vc');

function leadinjection_group_list_vc()
{

    $leadinjection_group_list_params = array(
        array(
            'type' => 'colorpicker',
            'heading' => __('Select group list border color', 'leadinjection'),
            'param_name' => 'group_list_border_color',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select group list hover background color', 'leadinjection'),
            'param_name' => 'group_list_hover_color',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select group list active background color', 'leadinjection'),
            'param_name' => 'group_list_active_background_color',
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_group_list_params = leadinjection_add_responsive_helper_params($leadinjection_group_list_params);

    vc_map(array(
            "name" => __("Group List", "leadinjection"),
            "base" => "leadinjection_group_list",
            "as_parent" => array('only' => 'leadinjection_group_list_item'),
            "content_element" => true,
            "show_settings_on_create" => false,
            "is_container" => true,
            "class" => '',
            "icon" => 'li-icon li-icon-list',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Display a list list group', 'leadinjection'),
            "params" => $leadinjection_group_list_params,
            "js_view" => 'VcColumnView'
        )
    );

    vc_map(array(
            "name" => __("Group List Item", "leadinjection"),
            "base" => "leadinjection_group_list_item",
            "icon" => 'li-icon li-icon-list',
            "content_element" => true,
            "as_child" => array('only' => 'leadinjection_group_list'),
            "params" => array(
                array(
                    'type' => 'checkbox',
                    'param_name' => 'item_active',
                    'value' => array(__('Make this Item Active', 'leadinjection') => 'list-group-item_active'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Enter Item Content', 'leadinjection'),
                    'param_name' => 'content',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select content color', 'leadinjection'),
                    'param_name' => 'content_color',
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => __('Link Content', 'leadinjection'),
                    'param_name' => 'content_link',
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'enable_badge',
                    'value' => array(__('Add a badge to this item', 'leadinjection') => 'yes'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Enter a Badge Value', 'leadinjection'),
                    'param_name' => 'badge_value',
                    'admin_label' => true,
                    'dependency' => array(
                        'element' => 'enable_badge',
                        'value' => 'yes',
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Color', 'leadinjection'),
                    'param_name' => 'badge_color',
                    'dependency' => array(
                        'element' => 'enable_badge',
                        'value' => 'yes',
                    ),
                ),
                array(
                    'type' => 'animation_style',
                    'heading' => __('Animation', 'leadinjection'),
                    'param_name' => 'animation',
                ),
                leadinjection_xclass_field(),
            )
        )
    );
}


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_leadinjection_group_list extends WPBakeryShortCodesContainer
    {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_leadinjection_group_list_item extends WPBakeryShortCode
    {
    }
}