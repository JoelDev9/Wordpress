<?php

/*
    Icon List
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_icon_list', 'leadinjection_icon_list_shortcode');

function leadinjection_icon_list_shortcode($atts, $content)
{

    $default_atts = array(
        'content' => !empty($content) ? $content : '',
        'list_style' => 'li-alphabetical-list',
        'bullets_color' => '',
        'animation' => 'none',
        'css' => '',
        'xclass' => '',
        'shortcode_id' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('icon_list_', $shortcode_id);

    $GLOBALS['list_style'] = $list_style;
    $list_tag = ('li-ordered-list' == $list_style) ? 'ol' : 'ul';

    $wrapper_class = array($list_style, $xclass, $responsive_helper);

    // Styles
    $style  = '';
    $style .= (!empty($bullets_color)) ? '#'.$shortcode_id.' { color: '.$bullets_color.'; }' : null;
    $style .= (!empty($bullets_color)) ? '#'.$shortcode_id.' .list-item-icon  { color: '.$bullets_color.'; }' : null;

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

    <<?php echo $list_tag; ?> class="<?php echo esc_attr($wrapper_class); ?>" id="<?php echo esc_attr($shortcode_id); ?>" <?php echo $data_effect; ?>>
        <?php echo do_shortcode($content); ?>
    </<?php echo $list_tag; ?>>


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

add_shortcode('leadinjection_icon_list_item', 'leadinjection_icon_list_shortcode_item');

function leadinjection_icon_list_shortcode_item($atts, $content)
{
    $list_style = $GLOBALS['list_style'];

    $defaults = shortcode_atts(array(
        'content' => !empty($content) ? $content : '',
        'content_color' => '',
        'enable_icon' => '',
        'icon_type' => 'fontawesome',
        'icon_fontawesome' => 'fa fa-adjust',
        'icon_iconssolid' => 'is is-icon-zynga',
        'icon_openiconic' => 'vc-oi vc-oi-dial',
        'icon_typicons' => 'typcn typcn-adjust-brightness',
        'icon_entypo' => 'entypo-icon entypo-icon-note',
        'icon_linecons' => 'vc_li vc_li-heart',
        'icon_color' => '',
        'animation' => 'none',
        'xclass' => '',
    ), $atts);


    extract($defaults);

    $item_class = array($xclass);

    // Enqueue needed icon font.
    vc_icon_element_fonts_enqueue($icon_type);

    $icon_color = ('' != $icon_color) ? 'style="color: ' . $icon_color . ';"' : null;
    $content_color = ('' != $content_color) ? 'style="color: ' . $content_color . ';"' : null;

    switch ($icon_type) {
        case 'fontawesome':
            $icon = '<i class="list-item-icon ' . $icon_fontawesome . '" ' . $icon_color . '></i>';
            break;

        case 'openiconic':
            $icon = '<span class="list-item-icon oi ' . $icon_openiconic . '" aria-hidden="true" ' . $icon_color . '></span>';
            break;

        case 'typicons':
            $icon = '<span class="list-item-icon ' . $icon_typicons . '" ' . $icon_color . '></span>';
            break;

        case 'entypo':
            $icon = '<span class="list-item-icon ' . $icon_entypo . '" ' . $icon_color . '></span>';
            break;

        case 'linecons':
            $icon = '<span class="list-item-icon ' . $icon_linecons . '" ' . $icon_color . '></span>';
            break;

        case 'iconssolid':
            $icon = '<span class="list-item-icon ' . $icon_iconssolid . '" ' . $icon_color . '></span>';
            break;

    }

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


    <li class="list-item <?php echo $item_class; ?>" <?php echo $data_effect; ?>>
        <?php echo ('yes' == $enable_icon) ? $icon : ''; ?>
        <span class="list-item-content" <?php echo $content_color; ?>><?php echo $content; ?></span>
    </li>


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

add_action('vc_before_init', 'leadinjection_icon_list_vc');

function leadinjection_icon_list_vc()
{

    $leadinjection_icon_list_params = array(
        array(
            'type' => 'dropdown',
            'heading' => __('Select a list style', 'leadinjection'),
            'param_name' => 'list_style',
            'value' => array(
                __('Alphabetical List', 'leadinjection') => 'li-alphabetical-list',
                __('Unordered List', 'leadinjection') => 'li-unordered-list',
                __('Ordered List', 'leadinjection') => 'li-ordered-list',
                __('No List Style', 'leadinjection') => 'li-icon-list',
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Bullets/Number color', 'leadinjection'),
            'param_name' => 'bullets_color',
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_icon_list_params = leadinjection_add_responsive_helper_params($leadinjection_icon_list_params);

    vc_map(array(
            "name" => __("List", "leadinjection"),
            "base" => "leadinjection_icon_list",
            "as_parent" => array('only' => 'leadinjection_icon_list_item'),
            "content_element" => true,
            "show_settings_on_create" => false,
            "is_container" => true,
            "class" => '',
            "icon" => 'li-icon li-icon-list',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('List with icons on the left.', 'leadinjection'),
            "params" => $leadinjection_icon_list_params,
            "js_view" => 'VcColumnView'
        )
    );

    vc_map(array(
            "name" => __("List Item", "leadinjection"),
            "base" => "leadinjection_icon_list_item",
            "icon" => 'li-icon li-icon-list-item',
            "content_element" => true,
            "as_child" => array('only' => 'leadinjection_icon_list'),
            "params" => array(
                array(
                    'type' => 'textarea',
                    'heading' => __('Enter item content', 'leadinjection'),
                    'param_name' => 'content',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select content color.', 'leadinjection'),
                    'param_name' => 'content_color',
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'enable_icon',
                    'value' => array(__('Add an icon to the list item.', 'leadinjection') => 'yes'),
                ),
                // Icon select fields
                leadinjection_icon_library_field('enable_icon', 'yes'),
                leadinjection_icon_fontawsome_field(),
                leadinjection_icon_iconssolid_field(),
                leadinjection_icon_openiconic_field(),
                leadinjection_icon_typicons_field(),
                leadinjection_icon_entypo_field(),
                leadinjection_icon_linecons_field(),
                //leadinjection_icon_image_field(),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select a icon color', 'leadinjection'),
                    'param_name' => 'icon_color',
                    'dependency' => array(
                        'element' => 'enable_icon',
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
    class WPBakeryShortCode_leadinjection_icon_list extends WPBakeryShortCodesContainer
    {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_leadinjection_icon_list_item extends WPBakeryShortCode
    {
    }
}
