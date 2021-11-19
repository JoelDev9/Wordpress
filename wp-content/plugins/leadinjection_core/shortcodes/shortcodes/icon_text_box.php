<?php

/*
    Side Icon Text
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_icon_text_box', 'leadinjection_icon_text_box_shortcode');

function leadinjection_icon_text_box_shortcode($atts, $content)
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
        'icon_color' => null,
        'title' => '',
        'title_color' => null,
        'content' => !empty($content) ? $content : '',
        'content_color' => null,
        'enable_link' => '',
        'link' => null,
        'link_color' => null,
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('icon_text_box_', $shortcode_id);
    $wrapper_class = array('li-icon-text-box', $xclass, $responsive_helper);


    // Enqueue needed icon font.
    vc_icon_element_fonts_enqueue( $icon_type );

    $background_icon_color = $box_border_bottom_color = '';
    if (!is_null($icon_color)) {
        $background_icon_color = 'style="color: ' . esc_attr($icon_color) . ';"';
        $box_border_bottom_color = 'style="border-bottom-color: ' . esc_attr($icon_color) . ';"';
    }

    if (!is_null($title_color)) {
        $title_color = 'style="color: ' . esc_attr($title_color) . ';"';
    }

    if (!is_null($content_color)) {
        $content_color = 'style="color: ' . esc_attr($content_color) . ';"';
    }

    if (!is_null($link_color)) {
        $link_color = 'style="color: ' . esc_attr($link_color) . ';"';
    }


    if(!empty($link)){

        $link_data = vc_build_link( $link );
        $link_str = '<a '.$link_color.' class="li-icon-text-box-link" href="' . esc_url($link_data['url']) . '">' . $link_data['title'] . ' <i class="fa fa-fw fa-caret-right"></i></a>';

    }

    switch ($icon_type) {
        case 'fontawesome':
            $icon = '<i '.$background_icon_color.' class="li-icon-text-box-icon fa-fw ' . esc_attr($icon_fontawesome) . '"></i>';
            break;

        case 'openiconic':
            $icon = '<span '.$background_icon_color.' class="li-icon-text-box-icon oi ' . esc_attr($icon_openiconic) . '" aria-hidden="true"></span>';
            break;

        case 'typicons':
            $icon = '<span '.$background_icon_color.' class="li-icon-text-box-icon ti ' . esc_attr($icon_typicons) . '"></span>';
            break;

        case 'entypo':
            $icon = '<span '.$background_icon_color.' class="li-icon-text-box-icon et ' . esc_attr($icon_entypo) . '"></span>';
            break;

        case 'linecons':
            $icon = '<span '.$background_icon_color.' class="li-icon-text-box-icon li ' . esc_attr($icon_linecons) . '"></span>';
            break;

        case 'iconssolid':
            $icon = '<span '.$background_icon_color.' class="li-icon-text-box-icon li ' . esc_attr($icon_iconssolid) . '"></span>';
            break;

        case 'image':
            $icon_class[] = 'image';
            $image_url = wp_get_attachment_image_src($icon_image, 'full');
            $icon = '<span class="li-icon-text-box-icon"><img src="' . $image_url[0] . '" alt="" /></span>';
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


    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?> <?php echo $box_border_bottom_color; ?>>
        <div class="li-icon-text-box-inner">
            <h3 class="li-icon-text-box-title" <?php echo $title_color; ?>><?php echo $title; ?></h3>
            <p class="li-icon-text-box-content" <?php echo $content_color; ?>>
                <?php echo $content; ?>
            </p>

            <?php if(!empty($enable_link)) :?>
                <?php echo $link_str; ?>
            <?php endif; ?>

            <?php echo $icon; ?>
        </div>
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

add_action('vc_before_init', 'leadinjection_icon_text_box_vc');

function leadinjection_icon_text_box_vc()
{

    $leadinjection_icon_text_box_params = array(
        // Icon select fields
        leadinjection_icon_library_field(),
        leadinjection_icon_fontawsome_field(),
        leadinjection_icon_iconssolid_field(),
        leadinjection_icon_openiconic_field(),
        leadinjection_icon_typicons_field(),
        leadinjection_icon_entypo_field(),
        leadinjection_icon_linecons_field(),
        leadinjection_icon_image_field(__('Icon Image size 144px x 112px')),
        array(
            'type' => 'colorpicker',
            'heading' => __('Icon color', 'leadinjection'),
            'param_name' => 'icon_color',
            'description' => __('Enter heading text here', 'leadinjection')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Enter title here', 'leadinjection'),
            'param_name' => 'title',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Title Color', 'leadinjection'),
            'param_name' => 'title_color',
        ),
        array(
            'type' => 'textarea',
            'heading' => __('Enter content text here', 'leadinjection'),
            'param_name' => 'content',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Content color', 'leadinjection'),
            'param_name' => 'content_color',
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'enable_link',
            'value' => array(__('Add a link to the box.', 'leadinjection') => 'yes'),
        ),
        array(
            'type' => 'vc_link',
            'heading' => __('Add a link', 'leadinjection'),
            'param_name' => 'link',
            'description' => __('Enter heading text here', 'leadinjection'),
            'dependency' => array(
                'element' => 'enable_link',
                'value' => 'yes',
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Link Color', 'leadinjection'),
            'description' => __('Select a link color', 'leadinjection'),
            'param_name' => 'link_color',
            'dependency' => array(
                'element' => 'enable_link',
                'value' => 'yes',
            )
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_icon_text_box_params = leadinjection_add_responsive_helper_params($leadinjection_icon_text_box_params);

    vc_map(array(
            "name" => __("Icon Text Box", "leadinjection"),
            "base" => "leadinjection_icon_text_box",
            "class" => "",
            "icon" => 'li-icon li-icon-text-box',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Textbox with a background icon right', 'leadinjection'),
            "params" => $leadinjection_icon_text_box_params
        )
    );
}

