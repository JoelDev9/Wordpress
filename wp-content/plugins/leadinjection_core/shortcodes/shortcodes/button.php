<?php

/*
    Button
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_button', 'leadinjection_button_shortcode');

function leadinjection_button_shortcode($atts, $content)
{

    $defaults = shortcode_atts(array(
        'content' => !empty($content) ? $content : '',
        'alignment' => 'inline',
        'display_block' => '',
        'size' => 'btn-md',
        'color' => '',
        'background_color' => '',
        'border_color' => '',
        'value_color' => '',
        'style' => '',
        'enable_icon' => null,
        'icon_type' => 'fontawesome',
        'icon_fontawesome' => 'fa fa-adjust',
        'icon_iconssolid' => 'is is-icon-zynga',
        'icon_openiconic' => 'vc-oi vc-oi-dial',
        'icon_typicons' => 'typcn typcn-adjust-brightness',
        'icon_entypo' => 'entypo-icon entypo-icon-note',
        'icon_linecons' => 'vc_li vc_li-heart',
        'icon_site' => 'btn-icon-left',
        'enable_link' => null,
        'link_url' => null,
        'trigger_modal' => null,
        'modal_id' => null,
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    ), $atts);

    extract($defaults);
    $shortcode_id = leadinjection_custom_id('button_', $shortcode_id);

    $button_class = array($xclass, $size, $color, $style);

    if(!empty($trigger_modal)) {
        $modal = leadinjection_get_modal($modal_id);
        $modal_id = $modal['modal_id'];
    }

    if(!empty($display_block)){
        $button_class[] = $display_block;
    }

    $output_style = null;
    if ('custom' === $color) {

        $bacground_css = ('' !== $background_color) ? 'background-color: ' . $background_color . '; ' : null;
        $border_css = ('' !== $border_color) ? 'border-color: ' . $border_color . '; ' : null;
        $value_css = ('' !== $value_color) ? 'color:' . $value_color . '; ' : null;


        $output_style = '<style scoped>';
        $output_style .= '#' . $shortcode_id . '{' . $bacground_css . $border_css . $value_css . '}';
        $output_style .= '</style>';
    }

    $attributes = array();


    if ('none' !== $animation) {
        leadinjection_enqueue_animation();
        $button_class[] = 'li-animate';
        $attributes[] = 'data-effect="' . $animation . '"';
    }


    if ('yes' === $enable_icon) {
        switch ($icon_type) {
            case 'fontawesome':
                $icon = '<i class="fa ' . esc_attr($icon_fontawesome) . '"></i>';
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
        }

        $button_content = ('btn-icon-left' === $icon_site) ? $icon . $content : $content . $icon;
        $button_class[] = $icon_site;

    } else {
        $icon = null;
        $button_content = $content;
    }

    ('yes' === $trigger_modal) ? $attributes[] = 'data-toggle="modal" data-target="#liModal-' . $modal_id . '"' : null;

    $button_class = implode(' ', $button_class);

    if ('yes' != $enable_link) {
        $button_atts = implode(' ', $attributes);
        $button = '<button type="button" id="' . esc_attr($shortcode_id) . '" class="btn ' . esc_attr($button_class) . '" ' . $button_atts . '>' . $button_content . '</button>';
    } else {
        $link = vc_build_link($link_url);
        $attributes[] = 'href="' . esc_url($link['url']) . '"';
        $attributes[] = ('' !== $link['title']) ? 'title="' . esc_attr($link['title']) . '"' : null;
        $attributes[] = ('' !== $link['target']) ? 'target="' . esc_attr($link['target']) . '"' : null;

        $button_atts = implode(' ', $attributes);
        $button = '<a ' . $button_atts . ' class="btn ' . esc_attr($button_class) . '" id="' . esc_attr($shortcode_id) . '">' . $button_content . '</a>';
    }


    // Design options Css
    $wrapper_class = $alignment . ' ' . vc_shortcode_custom_css_class($css, ' ');

    $output = '<div class="btn-wrapper ' . esc_attr($wrapper_class) . '">';
    $output .= $button;
    $output .= '</div>';

    return $output_style . $output;

}


/*
    Visual Composer Registration
*/

add_action('vc_before_init', 'leadinjection_button_vc');

function leadinjection_button_vc()
{
    vc_map(array(
            "name" => __("Button", "leadinjection"),
            'description' => __('Create a Button', 'leadinjection'),
            "base" => "leadinjection_button",
            "icon" => 'li-icon li-button',
            "category" => __("Leadinjection", "leadinjection"),
            "params" => array(
                array(
                    'type' => 'textfield',
                    'heading' => __('Enter a Button Text.', 'leadinjection'),
                    'param_name' => 'content',
                    'value' => 'Button Text',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('Select button alignment.', 'leadinjection'),
                    'param_name' => 'alignment',
                    'value' => array(
                        __('Inline', 'leadinjection') => 'inline',
                        __('Left', 'leadinjection') => 'left',
                        __('Center', 'leadinjection') => 'center',
                        __('Rigth', 'leadinjection') => 'right',
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'display_block',
                    'value' => array(__('Button display block.', 'leadinjection') => 'btn-block'),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('Select a button size', 'leadinjection'),
                    'admin_label' => true,
                    'param_name' => 'size',
                    'value' => array(
                        __('Medium Button', 'leadinjection') => 'btn-md',
                        __('Small Button', 'leadinjection') => 'btn-sm',
                        __('Large Button', 'leadinjection') => 'btn-lg',
                        __('Extra Large Button', 'leadinjection') => 'btn-xl',
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('Select a button color.', 'leadinjection'),
                    'admin_label' => true,
                    'param_name' => 'color',
                    'value' => array(
                        __('Defualt', 'leadinjection') => '',
                        __('Red', 'leadinjection') => 'btn-red',
                        __('Green', 'leadinjection') => 'btn-green',
                        __('Blue', 'leadinjection') => 'btn-blue',
                        __('Yellow', 'leadinjection') => 'btn-yellow',
                        __('Gray', 'leadinjection') => 'btn-gray',
                        __('Turquoise', 'leadinjection') => 'btn-turquoise',
                        __('Purple', 'leadinjection') => 'btn-purple',
                        __('White', 'leadinjection') => 'btn-white',
                        __('Custom Style 1', 'leadinjection') => 'btn-custom1',
                        __('Custom Style 2', 'leadinjection') => 'btn-custom2',
                        __('Custom Style 3', 'leadinjection') => 'btn-custom3',
                        __('Custom Style 4', 'leadinjection') => 'btn-custom4',
                        __('Custom Color', 'leadinjection') => 'custom',
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select a button background color.', 'leadinjection'),
                    'param_name' => 'background_color',
                    'dependency' => array(
                        'element' => 'color',
                        'value' => 'custom',
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select a button border color.', 'leadinjection'),
                    'param_name' => 'border_color',
                    'dependency' => array(
                        'element' => 'color',
                        'value' => 'custom',
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select a button text color.', 'leadinjection'),
                    'param_name' => 'value_color',
                    'dependency' => array(
                        'element' => 'color',
                        'value' => 'custom',
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('Select a button style.', 'leadinjection'),
                    'param_name' => 'style',
                    'value' => array(
                        __('Rounded', 'leadinjection') => '',
                        __('Square', 'leadinjection') => 'btn-square',
                        __('Round', 'leadinjection') => 'btn-round',

                        __('Rounded 3D', 'leadinjection') => 'btn-3d',
                        __('Square 3D', 'leadinjection') => 'btn-square btn-3d',
                        __('Round 3D', 'leadinjection') => 'btn-round btn-3d',

                        __('Rounded Outline', 'leadinjection') => 'btn-outline',
                        __('Square Outline', 'leadinjection') => 'btn-square btn-outline',
                        __('Round Outline', 'leadinjection') => 'btn-round btn-outline',
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'enable_icon',
                    'value' => array(__('Add an icon to the button.', 'leadinjection') => 'yes'),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('Select a Icon library.', 'leadinjection'),
                    'value' => array(
                        __('Font Awesome', 'leadinjection') => 'fontawesome',
                        __('Icons Solid', 'leadinjection') => 'iconssolid',
                        __('Open Iconic', 'leadinjection') => 'openiconic',
                        __('Typicons', 'leadinjection') => 'typicons',
                        __('Entypo', 'leadinjection') => 'entypo',
                        __('Linecons', 'leadinjection') => 'linecons',
                    ),
                    'param_name' => 'icon_type',
                    'dependency' => array(
                        'element' => 'enable_icon',
                        'value' => 'yes',
                    ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => __('Select a Icon.', 'leadinjection'),
                    'param_name' => 'icon_fontawesome',
                    'value' => 'fa fa-adjust',
                    'settings' => array(
                        'emptyIcon' => false,
                        'iconsPerPage' => 4000
                    ),
                    'dependency' => array(
                        'element' => 'icon_type',
                        'value' => 'fontawesome',
                    ),
                ),
                leadinjection_icon_iconssolid_field(),
                array(
                    'type' => 'iconpicker',
                    'heading' => __('Select a Icon.', 'leadinjection'),
                    'param_name' => 'icon_openiconic',
                    'value' => 'vc-oi vc-oi-dial',
                    'settings' => array(
                        'emptyIcon' => false,
                        'type' => 'openiconic',
                        'iconsPerPage' => 4000,
                    ),
                    'dependency' => array(
                        'element' => 'icon_type',
                        'value' => 'openiconic',
                    ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => __('Select a Icon.', 'leadinjection'),
                    'param_name' => 'icon_typicons',
                    'value' => 'typcn typcn-adjust-brightness',
                    'settings' => array(
                        'emptyIcon' => false,
                        'type' => 'typicons',
                        'iconsPerPage' => 4000,
                    ),
                    'dependency' => array(
                        'element' => 'icon_type',
                        'value' => 'typicons',
                    ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => __('Select a Icon.', 'leadinjection'),
                    'param_name' => 'icon_entypo',
                    'value' => 'entypo-icon entypo-icon-note',
                    'settings' => array(
                        'emptyIcon' => false,
                        'type' => 'entypo',
                        'iconsPerPage' => 4000,
                    ),
                    'dependency' => array(
                        'element' => 'icon_type',
                        'value' => 'entypo',
                    ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => __('Select a Icon.', 'leadinjection'),
                    'param_name' => 'icon_linecons',
                    'value' => 'vc_li vc_li-heart',
                    'settings' => array(
                        'emptyIcon' => false,
                        'type' => 'linecons',
                        'iconsPerPage' => 4000,
                    ),
                    'dependency' => array(
                        'element' => 'icon_type',
                        'value' => 'linecons',
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('Select a icon alignment.', 'leadinjection'),
                    'param_name' => 'icon_site',
                    'value' => array(
                        __('Icon on the left site', 'leadinjection') => 'btn-icon-left',
                        __('Icon on the right site', 'leadinjection') => 'btn-icon-right',
                    ),
                    'dependency' => array(
                        'element' => 'enable_icon',
                        'value' => 'yes',
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    //'heading' => __('Add a Link', 'leadinjection'),
                    'param_name' => 'enable_link',
                    'value' => array(__('Add a Link to the button.', 'leadinjection') => 'yes'),
                ),
                array(
                    'type' => 'vc_link',
                    //'heading' => __('Link Url'),
                    'param_name' => 'link_url',
                    'dependency' => array(
                        'element' => 'enable_link',
                        'value' => array('yes')
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    //'heading' => __('Trigger a Modal', 'leadinjection'),
                    'param_name' => 'trigger_modal',
                    'value' => array(__('Add a modal trigger action.', 'leadinjection') => 'yes'),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('Select a available modal.', 'leadinjection'),
                    'value' => leadinjection_get_modals(),
                    'admin_label' => true,
                    'param_name' => 'modal_id',
                    'description' => __('Note! You also need to set the Modal in the page', 'leadinjection'),
                    'dependency' => array(
                        'element' => 'trigger_modal',
                        'value' => array('yes')
                    ),
                ),
                leadinjection_animation_field(),
                leadinjection_css_editor_field(),
                leadinjection_xclass_field(),
                leadinjection_shortcode_id_field(),
            )
        )
    );
}

