<?php
/**
 * Plugin Name:     Leadinjection ShortCodes
 * Plugin URI:      http://leadinjection.io
 * Description:     Adds Leadinjections ShortCodes to the theme
 * Author:          Themeinjection
 * Author URI:      http://themeinjection.com
 * Version:         1.1.7
 * Text Domain:     leadinjection
 * License:         GPL3+
 * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Check if Visual Composer is activated
 */
function leadinjection_vc_check()
{
    if ( !defined('WPB_VC_VERSION') ) {
        $error_msg = '<div class="error" id="messages"><p>';
        $error_msg .= __('The Visual Composer plugin must be installed for the <b>Leadinjection Shortcodes Extension</b> to work.</b>', 'leadinjection');
        $error_msg .= '</p></div>';
        echo $error_msg;
    }
}
add_action('admin_notices', 'leadinjection_vc_check');


/**
 * Create default xclass field
 */
function leadinjection_xclass_field()
{
    $xclass_field = array(
        'type' => 'textfield',
        'heading' => __('Extra class name', 'leadinjection'),
        'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'leadinjection'),
        'param_name' => 'xclass',
    );

    return $xclass_field;
}

/**
 * Create default icon library field
 *
 * @param string $dep_element Dependency Element
 * @param string $dep_value Dependency Element Value
 * @return array $icon_lib
 * 
 */
function leadinjection_icon_library_field($dep_element = null, $dep_value = null)
{
    $icon_lib = array(
        'type' => 'dropdown',
        'heading' => __('Select a icon library', 'leadinjection'),
        'value' => array(
            __('Font Awesome', 'leadinjection') => 'fontawesome',
            __('Icons Solid', 'leadinjection') => 'iconssolid',
            __('Open Iconic', 'leadinjection') => 'openiconic',
            __('Typicons', 'leadinjection') => 'typicons',
            __('Entypo', 'leadinjection') => 'entypo',
            __('Linecons', 'leadinjection') => 'linecons',
            __('Custom Image', 'leadinjection') => 'image',
        ),
        'param_name' => 'icon_type',
    );

    if(!is_null($dep_element) && !is_null($dep_value)){
        $icon_lib['dependency'] = array(
            'element' => $dep_element,
            'value' => $dep_value,
        );
    }

    return $icon_lib;
}


/**
 * Create default icon fontawesome field
 */
function leadinjection_icon_fontawsome_field()
{
    $fontawesome = array(
        'type' => 'iconpicker',
        'heading' => __('Select a icon', 'leadinjection'),
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
    );

    return $fontawesome;
}

/**
 * Create default icon icons solid field
 */
function leadinjection_icon_iconssolid_field()
{
    $iconssolid = array(
        'type' => 'iconpicker',
        'heading' => __('Select a icon', 'leadinjection'),
        'param_name' => 'icon_iconssolid',
        'value' => 'is is-icon-zynga',
        'settings' => array(
            'emptyIcon' => false,
            'iconsPerPage' => 4000,
            'type' => 'iconssolid',
        ),
        'dependency' => array(
            'element' => 'icon_type',
            'value' => 'iconssolid',
        ),
    );

    return $iconssolid;
}

/**
 * Create default icon openiconic field
 */
function leadinjection_icon_openiconic_field()
{
    $openiconic = array(
        'type' => 'iconpicker',
        'heading' => __('Select a icon', 'leadinjection'),
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
    );

    return $openiconic;
}


/**
 * Create default icon typicons field
 */
function leadinjection_icon_typicons_field()
{
    $typicons = array(
        'type' => 'iconpicker',
        'heading' => __('Select a icon', 'leadinjection'),
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
    );

    return $typicons;
}


/**
 * Create default icon entypo field
 */
function leadinjection_icon_entypo_field()
{
    $entypo = array(
        'type' => 'iconpicker',
        'heading' => __('Select a icon', 'leadinjection'),
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
    );

    return $entypo;
}


/**
 * Create default icon linecons field
 */
function leadinjection_icon_linecons_field()
{
    $linecons = array(
        'type' => 'iconpicker',
        'heading' => __('Select a icon', 'leadinjection'),
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
    );

    return $linecons;
}


/**
 * Create default icon image field
 */
function leadinjection_icon_image_field($desc = null)
{
    $image = array(
        'type' => 'attach_image',
        'heading' => __('Select custom icon image', 'leadinjection'),
        'param_name' => 'icon_image',
        'value' => '',
        'dependency' => array(
            'element' => 'icon_type',
            'value' => 'image',
        ),

    );

    if(!is_null($desc)){
        $image['description'] = $desc;
    }

    return $image;
}


/**
 * Create default animation field
 */
function leadinjection_animation_field()
{
    $animation_field = array(
        'type' => 'animation_style',
        'heading' => __('Select a animation style', 'leadinjection'),
        'param_name' => 'animation',
    );

    return $animation_field;
}

/**
 * Create wrapper class string
 */
function leadinjection_wrapper_class($wrapper_class, $css)
{
    $wrapper_class  = implode(' ', $wrapper_class);
    $wrapper_class .= vc_shortcode_custom_css_class($css, ' ');
    // Remove white spaces
    $wrapper_class  = trim($wrapper_class);

    return $wrapper_class;
}

/**
 * Create default css editor field
 */
function leadinjection_css_editor_field()
{
    $css_editor_field = array(
        'type' => 'css_editor',
        'heading' => __('Css', 'leadinjection'),
        'param_name' => 'css',
        'group' => __('Design options', 'leadinjection'),
    );

    return $css_editor_field;
}

/**
 * Create default element ID field
 */
function leadinjection_shortcode_id_field()
{
    $xclass_field = array(
        'type' => 'textfield',
        'heading' => __('Shortcode ID', 'leadinjection'),
        'description' => __('Enter shortcode ID (Note: make sure it is unique and valid according to w3c specification).', 'leadinjection'),
        'param_name' => 'shortcode_id',
        'value' => '',
    );

    return $xclass_field;
}

/**
 * Create a custom element ID
 */
function leadinjection_custom_id($prefix = 'custom-', $shortcode_id)
{
    $shortcode_id = ('' === $shortcode_id) ? $prefix . uniqid() : $shortcode_id;
    return $shortcode_id;
}

/**
 * Enqueue styles and scripts for aninmtion
 */
function leadinjection_enqueue_animation()
{
    wp_enqueue_script('waypoints');
}

/**
 * Enqueue styles and scripts for counter
 */
function leadinjection_enqueue_counter()
{
    wp_enqueue_script('waypoints');
    wp_enqueue_script('animate-number');
}

/**
 * Get attributes of nested shortcodes
 */
function leadinjection_attribute_map($str, $att = null)
{
    $res = array();
    $return = array();
    $reg = get_shortcode_regex();
    preg_match_all('~' . $reg . '~', $str, $matches);
    foreach ($matches[2] as $key => $name) {
        $parsed = shortcode_parse_atts($matches[3][$key]);
        $parsed = is_array($parsed) ? $parsed : array();
        $res[$name] = $parsed;
        $return[] = $res;
    }
    return $return;
}

/**
 * Get all Modals
 */
function leadinjection_get_modals()
{
    $query = new WP_Query(array( 'post_type' => 'li_modals', 'posts_per_page'=> -1 ));

    $modals = array();
    $modals[] = __('Please select a Modal', 'leadinjection');
    foreach ($query->posts as $modal) {
        $modals['[ #liModal-' . $modal->ID . ' ] - ' . $modal->post_title] = $modal->ID.';'.$modal->post_title;
    }

    return $modals;
}



/**
 * Get a Lead Modal
 */
function leadinjection_get_modal($modal_id){
    $modal_id_title = explode(';', $modal_id);
    
    if(!empty($modal_id_title[0])){
        $modal = get_post($modal_id_title[0]);
        if('li_modals' == $modal->post_type){
            return array('success' => true, 'result' => $modal, 'modal_id' => $modal->ID);
        }
    }

    if(!empty($modal_id_title[1])){
        $modal = get_page_by_title($modal_id_title[1], OBJECT, 'li_modals');
        if(!is_null($modal)){
            return array('success' => true, 'result' => $modal, 'modal_id' => $modal->ID);
        }
    }
    leadinjection_debug_console('Modal not found!');
    return array('success' => false, 'result' => null, 'modal_id' => $modal_id);
}



/**
 * Get all Forms
 */
function leadinjection_get_forms()
{
    $query = new WP_Query(array( 'post_type' => 'li_forms', 'posts_per_page'=> -1 ));

    $forms = array();
    $forms[] = __('Please select a Form', 'leadinjection');
    foreach ($query->posts as $form) {
        $forms['[ #liForm-' . $form->ID . ' ] - ' . $form->post_title] = $form->ID.';'.$form->post_title;
    }

    return $forms;
}



/**
 * Get a Lead Form
 */
function leadinjection_get_form($form_id){
    $form_id_title = explode(';', $form_id);

    if(!empty($form_id_title[0])){
        $form = get_post($form_id_title[0]);
        if('li_modals' == $form->post_type){
            return array('success' => true, 'result' => $form, 'form_id' => $form->ID);
        }
    }

    if(!empty($form_id_title[1])){
        $form = get_page_by_title($form_id_title[1], OBJECT, 'li_forms');
        if(!is_null($form)){
            return array('success' => true, 'result' => $form, 'form_id' => $form->ID);
        }
    }
    leadinjection_debug_console('Modal not found!');
    return array('success' => false, 'result' => null, 'form_id' => $form_id);
}


/**
 * Load Responsive Helper Options
 */
require_once(plugin_dir_path(__FILE__) . '/leadinjection_shortcodes_responsive_helper.php');



/**
 *  Extend Default VC Elements Params
 */
function leadinjection_extend_default_vc_params()
{
    // Row Alignment
    $param = array(
        'type' => 'dropdown',
        'heading' => __('Select content alignment', 'leadinjection'),
        'admin_label' => true,
        'param_name' => 'content_align',
        'value' => array(
            __('None', 'leadinjection') => '',
            __('Left', 'leadinjection') => 'text-left',
            __('Center', 'leadinjection') => 'text-center',
            __('Right', 'leadinjection') => 'text-right',
        ));

    vc_add_param('vc_row', $param);

    // Row Hidden Overflow
    $param = array(
        'type' => 'checkbox',
        'param_name' => 'overflow',
        'value' => array(__('Display overflow hidden', 'leadinjection') => 'of-hidden')
    );

    vc_add_param('vc_row', $param);


    // Row Animation
    vc_add_param('vc_row', leadinjection_animation_field());

    // Column Animation
    vc_add_param('vc_column', leadinjection_animation_field());

    vc_remove_param('vc_column', 'css_animation');

    // Row Background position
    vc_add_param("vc_row", array(
        "type" => "dropdown",
        "heading" => "Background position",
        "param_name" => "background_position",
        "value" => array(
            __('None', 'leadinjection') => '',
            __('center center', 'leadinjection') => 'center center',
            __('center top', 'leadinjection') => 'center top',
            __('center bottom', 'leadinjection') => 'center bottom',
        )
    ));

    // Row Style
    vc_add_param("vc_row", array(
        "type" => "dropdown",
        "heading" => "Row Style",
        "param_name" => "row_style",
        "value" => array(
            __('None', 'leadinjection') => '',
            __('Arrow Top', 'leadinjection') => 'arrow-top',
            __('Arrow Bottom', 'leadinjection') => 'arrow-bottom',
            __('Arrow Top and Bottom', 'leadinjection') => 'arrow-top-bottom',
            __('Shadow Gap', 'leadinjection') => 'shadow-gap',
        ),
        'group' => 'Row Style'
    ));

    vc_add_param("vc_row", array(
        'type' => 'colorpicker',
        'heading' => __('Background Top Color', 'leadinjection'),
        'param_name' => 'row_style_background_top',
        'dependency' => array(
            'element' => 'row_style',
            'value' => array('arrow-top', 'arrow-top-bottom')
        ),
        'group' => 'Row Style'
    ));

    vc_add_param("vc_row", array(
        'type' => 'colorpicker',
        'heading' => __('Background Bottom Color', 'leadinjection'),
        'param_name' => 'row_style_background_bottom',
        'dependency' => array(
            'element' => 'row_style',
            'value' => array('arrow-bottom', 'arrow-top-bottom')
        ),
        'group' => 'Row Style'
    ));

}


function leadinjection_default_button($button_data){

    $attributes = null;
    if ('yes' === $button_data['enable_link']) {
        $link = vc_build_link($button_data['link_url']);

        $attributes = array();
        $attributes[] = 'href="' . esc_url($link['url']) . '"';
        $attributes[] = ('' !== $link['title']) ? 'title="' . esc_attr($link['title']) . '"' : null;
        $attributes[] = ('' !== $link['target']) ? 'target="' . esc_attr($link['target']) . '"' : null;

        $attributes = implode(' ', $attributes);
    }

    ('yes' === $button_data['trigger_modal']) ? $attributes = 'data-toggle="modal" data-target="#liModal-' . $button_data['modal_id'] . '"' : null;

    $button_class = implode(' ', $button_data['button_class']);

    $button = '<a class="btn '.$button_class.'" '.$attributes.' id="'.$button_data['button_id'].'">'.$button_data['button_value'].'</a>';


    return $button;
}



/**
 *  Load Leadinjection Params Shortcodes
 */
if (defined('WPB_VC_VERSION')) {

    add_action('vc_after_init', 'leadinjection_extend_default_vc_params');

    require_once(plugin_dir_path(__FILE__) . '/shortcodes/side_icon_text.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/heading.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/feature_icon_text.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/image_testimonial_slider.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/person-profile.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/icon_list.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/number_counter.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/textblock.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/button.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/pricing_table_simple.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/icon.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/accordion.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/tabs.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/image.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/video.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/rating_slider.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/location_map.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/icon_text_box.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/countdown.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/group_list.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/alert.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/divider.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/image-gallery.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/progress_bar.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/portfolio.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/review_block.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/pricing_table_advanced.php');
    require_once(plugin_dir_path(__FILE__) . '/shortcodes/before_after_image.php');

    require_once(plugin_dir_path(__FILE__) . '/shortcodes/modal.php');
    
    // require_once(plugin_dir_path(__FILE__) . '/shortcodes/form.php');

    // Init Icons Solid for Iconpicker
    require_once(plugin_dir_path(__FILE__) . '/iconssolid_init.php');

}


