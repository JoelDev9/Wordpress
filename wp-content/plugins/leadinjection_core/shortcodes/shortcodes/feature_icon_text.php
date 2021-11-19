<?php

/*
    Feature Icon Text
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_feature_icon_text', 'leadinjection_feature_icon_text_shortcode');

function leadinjection_feature_icon_text_shortcode($atts, $content)
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
        'icon_color' => null,
        'icon_background_color' => null,
        'icon_border_color' => null,
        'title' => '',
        'title_color' => '',
        'content' => !empty($content) ? $content : '',
        'content_color' => '',
        'linked' => false,
        'link_url' => '',
        'link_text' => '',
        'link_text_disable' => 'hide',
        'animation' => 'none',
        'css' => '',
        'xclass' => '',
        'shortcode_id' => ''
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('feature_icon_text_', $shortcode_id);
    $wrapper_class = array('feature-icon-text', $xclass, $responsive_helper);

    $icon_class = array($icon_style);

    // Enqueue needed icon font.
    vc_icon_element_fonts_enqueue( $icon_type );

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

        case 'image':
            $icon_class[] = 'image';
            $image_url = wp_get_attachment_image_src($icon_image, 'full');
            $icon = '<img src="' . $image_url[0] . '" alt="" />';
            break;
    }


    if('add_link' === $linked){

        $link = vc_build_link( $link_url );

        $icon_str = '<a href="' . esc_url($link['url']) . '">' . $icon . '</a>';
        $title_str = '<h2 class="feature-icon-text-title"><a href="' . esc_url($link['url']) . '">' . esc_html($title) . '</a></h2>';
    }
    else{
        $icon_str = $icon;
        $title_str = '<h2 class="feature-icon-text-title">' . esc_html($title) . '</h2>';
    }

    $data_effect = '';
    if ('none' !== $animation) {
        leadinjection_enqueue_animation();
        $wrapper_class[] = 'li-animate';
        $data_effect = 'data-effect="' . esc_attr($animation) . '"';
    }

    $style  = '';
    $style .= (!empty($title_color)) ? '#'.$shortcode_id.' .feature-icon-text-title { color: '.$title_color.';}' : null;
    $style .= (!empty($content_color)) ? '#'.$shortcode_id.' .content { color: '.$content_color.';}' : null;

    // Default
    $style .= (!empty($icon_color)) ? '#'.$shortcode_id.' .feature-icon-text-icon { color: '.$icon_color.';}' : null;
    $style .= (!empty($icon_border_color)) ? '#'.$shortcode_id.' .feature-icon-text-icon { border-color: '.$icon_border_color.';}' : null;
    $style .= (!empty($icon_background_color)) ? '#'.$shortcode_id.' .feature-icon-text-icon { background-color: '.$icon_background_color.';}' : null;

    // Linked
    $style .= (!empty($icon_color)) ? '#'.$shortcode_id.' .feature-icon-text-icon a { color: '.$icon_color.';}' : null;
    $style .= (!empty($icon_color)) ? '#'.$shortcode_id.':hover .feature-icon-text-icon a { color: '.$icon_background_color.';}' : null;

    // Hover
    $style .= (!empty($icon_color)) ? '#'.$shortcode_id.':hover .feature-icon-text-icon { color: '.$icon_background_color.';}' : null;
    $style .= (!empty($icon_background_color)) ? '#'.$shortcode_id.':hover .feature-icon-text-icon { background-color: '.$icon_color.';}' : null;

    $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;


    // Create wrapper classes string
    $wrapper_class  = leadinjection_wrapper_class($wrapper_class, $css);

    $icon_class = implode(' ', $icon_class);

    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>
    <?php echo $output_style; ?>
    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>>
        <div class="feature-icon-text-icon <?php echo esc_attr($icon_class); ?>">
            <?php echo $icon_str; ?>
        </div>
        <?php echo $title_str; ?>
        <div class="content"><?php echo do_shortcode($content); ?></div>
        <?php if('hide' !== $link_text_disable && 'add_link' === $linked) : ?>
            <a class="feature-icon-text-more" href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['title']); ?></a>
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

add_action('vc_before_init', 'leadinjection_feature_icon_text_vc');

function leadinjection_feature_icon_text_vc()
{

    $leadinjection_feature_icon_text_params = array(
        array(
            'type' => 'dropdown',
            'heading' => __('Select a Icon library', 'leadinjection'),
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
        ),
        array(
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
        ),
        leadinjection_icon_iconssolid_field(),
        array(
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
        ),
        array(
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
        ),
        array(
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
        ),
        array(
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
        ),
        array(
            'type' => 'attach_image',
            'heading' => __('Select custom icon image', 'leadinjection'),
            'param_name' => 'icon_image',
            'value' => '',
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'image',
            ),

        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Select a icon style', 'leadinjection'),
            'param_name' => 'icon_style',
            'value' => array(
                __('Default', 'leadinjection') => '',
                __('Big', 'leadinjection') => 'big',
                __('Round', 'leadinjection') => 'round',
                __('Square', 'leadinjection') => 'square',
                __('Underline', 'leadinjection') => 'underline',
                __('Rounded', 'leadinjection') => 'rounded',
                __('Image', 'leadinjection') => 'image',
            ),
            'dependency' => array(
                'element' => 'icon_type',
                'not_empty' => false,
                'value' => array('fontawesome', 'openiconic', 'typicons', 'entypo', 'linecons')
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Icon color', 'leadinjection'),
            'param_name' => 'icon_color',
            'dependency' => array(
                'element' => 'icon_type',
                'not_empty' => false,
                'value' => array('fontawesome', 'openiconic', 'typicons', 'entypo', 'linecons')
            ),
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
            'type' => 'textfield',
            'heading' => __('Enter the feature title', 'leadinjection'),
            'param_name' => 'title',
            'value' => 'Feature Title',
            'admin_label' => true,
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a title color', 'leadinjection'),
            'param_name' => 'title_color',
        ),
        array(
            'type' => 'textarea',
            'heading' => __('Enter an feature description', 'leadinjection'),
            'param_name' => 'content',
            'value' => __('Enter your description herer. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'leadinjection'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a content color', 'leadinjection'),
            'param_name' => 'content_color',
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
        array(
            'type' => 'checkbox',
            'param_name' => 'link_text_disable',
            'value' => array(__('Show a link at the feature bottom', 'leadinjection') => 'show'),
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

    $leadinjection_feature_icon_text_params = leadinjection_add_responsive_helper_params($leadinjection_feature_icon_text_params);
    

    vc_map(array(
            "name" => __("Feature Icon Text", "leadinjection"),
            "base" => "leadinjection_feature_icon_text",
            "icon" => 'li-icon li-feature-icon',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Text with an Icon at the top', 'leadinjection'),
            "params" => $leadinjection_feature_icon_text_params
        )
    );
}
