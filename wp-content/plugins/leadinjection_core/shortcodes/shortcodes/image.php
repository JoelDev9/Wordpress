<?php

/*
    Default Image
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_image', 'leadinjection_image_shortcode');

function leadinjection_image_shortcode($atts, $content)
{
    $default_atts = array(
        'content' => !empty($content) ? $content : '',
        'image' => '',
        'image_size' => 'full',
        'enable_link' => '',
        'image_caption' => '',
        'link_url' => '',
        'alignment' => '',
        'imagehover' => '',
        'imagehover_effect' => 'imghvr-fade',
        'imagehover_background_color' => '',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('image_', $shortcode_id);
    $wrapper_class = array('li-image', $xclass, $alignment, $responsive_helper);

    // TODO: Add Image Action: Lightbox etc.

    if ( preg_match_all( '/(\d+)x(\d+)/', $image_size, $sizes ) ) {
        $image_size = array($sizes[1][0], $sizes[2][0]);
    }

    $caption ='';
    if('' != $image){
        $caption = wp_get_attachment_caption( $image );
        $image = wp_get_attachment_image($image, $image_size, false, array('class' => 'img-responsive'));
    }else{
        $image = '<img alt="Placeholder" src="' . get_template_directory_uri() . '/img/placeholder.png" class="img-responsive"/>';
    }

    $output_style = null;
    if('yes' == $imagehover && !empty($imagehover_background_color)) {
        $output_style  = '<style scoped>';
        $output_style .= '#'.$shortcode_id.' figure:before { background-color: '.$imagehover_background_color.'; }';
        $output_style .= '#'.$shortcode_id.' figcaption { background-color: '.$imagehover_background_color.'; }';
        $output_style .= '</style>';
    }


    if(!empty($enable_link)){
        $link = vc_build_link($link_url);

        $attributes[] = 'href="' . esc_url($link['url']) . '"';
        $attributes[] = ('' !== $link['title']) ? 'title="' . esc_attr($link['title']) . '"' : null;
        $attributes[] = ('' !== $link['target']) ? 'target="' . esc_attr($link['target']) . '"' : null;

        $link_atts = implode(' ', $attributes);
        //$image = '<a ' . $link_atts . '>' . $image . '</a>';
    }

    $data_effect = '';
    if ('none' !== $animation) {
        leadinjection_enqueue_animation();
        $wrapper_class[] = 'li-animate ';
        $data_effect = 'data-effect="' . esc_attr($animation) . '"';
    }

    if('yes' == $imagehover){
        wp_enqueue_style('imagehover');
    }

    // Create wrapper classes string
    $wrapper_class  = leadinjection_wrapper_class($wrapper_class, $css);
    
    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>


    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>>

        <?php if('yes' == $imagehover) : ?>

            <?php echo $output_style; ?>

            <figure class="<?php echo $imagehover_effect; ?>">
                <?php echo $image ?>
                <figcaption>
                    <?php echo wpb_js_remove_wpautop( $content, true ); ?>
                </figcaption>
                <?php if(!empty($enable_link)) : ?>
                    <a <?php echo $link_atts ?>></a>
                <?php endif; ?>
            </figure>

        <?php else : ?>

            <?php if(!empty($enable_link)) : ?>

                <a <?php echo $link_atts ?>>
                <figure>
                <?php echo $image ?>
                <?php if(!empty($image_caption) && !empty($caption)) : ?>
                    <figcaption style="text-align:left; font-size: 14px;"><?php echo $caption ?></figcaption>
                <?php endif; ?>
                </figure>
                </a>

            <?php else : ?>
                <figure>
                <?php echo $image ?>
                <?php if(!empty($image_caption) && !empty($caption)) : ?>
                    <figcaption style="text-align:left; font-size: 14px;"><?php echo $caption ?></figcaption>
                <?php endif; ?>
                </figure>

            <?php endif; ?>

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

add_action('vc_before_init', 'leadinjection_image_vc');

function leadinjection_image_vc()
{
    $leadinjection_image_params = array(
        array(
            'type' => 'attach_image',
            'heading' => __('Select a image', 'leadinjection'),
            'param_name' => 'image',
            'value' => '',
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'image_caption',
            'value' => array(__('Add Image Caption', 'leadinjection') => 'yes'),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Image size', 'leadinjection'),
            'param_name' => 'image_size',
            'description' => __('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'leadinjection'),
            'admin_label' => true,
            'value' => 'full',
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'enable_link',
            'value' => array(__('Add a link to the image', 'leadinjection') => 'yes'),
        ),
        array(
            'type' => 'vc_link',
            'param_name' => 'link_url',
            'dependency' => array(
                'element' => 'enable_link',
                'value' => array('yes')
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Select image alignment', 'leadinjection'),
            'param_name' => 'alignment',
            'value' => array(
                __('None', 'leadinjection') => '',
                __('Inline', 'leadinjection') => 'inline',
                __('Left', 'leadinjection') => 'left',
                __('Center', 'leadinjection') => 'center',
                __('Rigth', 'leadinjection') => 'right',
            ),
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'imagehover',
            'value' => array(__('Add a hover animation to the image', 'leadinjection') => 'yes'),
        ),
        array(
            'type' => 'textarea_html',
            'heading' => __('Textblock', 'leadinjection'),
            'param_name' => 'content',
            'dependency' => array(
                'element' => 'imagehover',
                'value' => array('yes')
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Select image hover effect', 'leadinjection'),
            'param_name' => 'imagehover_effect',
            'value' => array(
                __('Fade', 'leadinjection') => 'imghvr-fade',
                __('Image Push Up', 'leadinjection') => 'imghvr-push-up',
                __('Image Push Down', 'leadinjection') => 'imghvr-push-down',
                __('Image Push Left', 'leadinjection') => 'imghvr-push-left',
                __('Image Push Right', 'leadinjection') => 'imghvr-push-right',
                __('Image Slide Up', 'leadinjection') => 'imghvr-slide-up',
                __('Image Slide Down', 'leadinjection') => 'imghvr-slide-down',
                __('Image Slide Left', 'leadinjection') => 'imghvr-slide-left',
                __('Image Slide Right', 'leadinjection') => 'imghvr-slide-right',
                __('Image Reveal Up', 'leadinjection') => 'imghvr-reveal-up',
                __('Image Reveal Down', 'leadinjection') => 'imghvr-reveal-down',
                __('Image Reveal Left', 'leadinjection') => 'imghvr-reveal-left',
                __('Image Reveal Right', 'leadinjection') => 'imghvr-reveal-right',
                __('Image Hinge Up', 'leadinjection') => 'imghvr-hinge-up',
                __('Image Hinge Down', 'leadinjection') => 'imghvr-hinge-down',
                __('Image Hinge Left', 'leadinjection') => 'imghvr-hinge-left',
                __('Image Hinge Right', 'leadinjection') => 'imghvr-hinge-Right',
                __('Image Flip Horiz', 'leadinjection') => 'imghvr-flip-horiz',
                __('Image Flip Vert', 'leadinjection') => 'imghvr-flip-vert',
                __('Image Flip Diag 1', 'leadinjection') => 'imghvr-flip-diag-1',
                __('Image Flip Diag 2', 'leadinjection') => 'imghvr-flip-diag-2',
                __('Image Shutter Out Horiz', 'leadinjection') => 'imghvr-shutter-out-horiz',
                __('Image Shutter Out Vert', 'leadinjection') => 'imghvr-shutter-out-vert',
                __('Image Shutter Out Diag 1', 'leadinjection') => 'imghvr-shutter-out-diag-1',
                __('Image Shutter Out Diag 2', 'leadinjection') => 'imghvr-shutter-out-diag-2',
                __('Image Shutter In Horiz', 'leadinjection') => 'imghvr-shutter-in-horiz',
                __('Image Shutter In Vert', 'leadinjection') => 'imghvr-shutter-in-vert',
                __('Image Shutter In Out Horiz', 'leadinjection') => 'imghvr-shutter-in-out-horiz',
                __('Image Shutter In Out Vert', 'leadinjection') => 'imghvr-shutter-in-out-vert',
                __('Image Shutter In Out Diag 1', 'leadinjection') => 'imghvr-shutter-in-out-diag-1',
                __('Image Shutter In Out Diag 2', 'leadinjection') => 'imghvr-shutter-in-out-diag-2',
                __('Image Fold Up', 'leadinjection') => 'imghvr-fold-up',
                __('Image Fold Down', 'leadinjection') => 'imghvr-fold-down',
                __('Image Fold Left', 'leadinjection') => 'imghvr-fold-left',
                __('Image Fold Right', 'leadinjection') => 'imghvr-fold-Right',
                __('Image Zoom In', 'leadinjection') => 'imghvr-zoom-in',
                __('Image Zoom Out', 'leadinjection') => 'imghvr-zoom-out',
                __('Image Zoom Out Up', 'leadinjection') => 'imghvr-zoom-out-up',
                __('Image Zoom Out Down', 'leadinjection') => 'imghvr-zoom-out-down',
                __('Image Zoom Out Left', 'leadinjection') => 'imghvr-zoom-out-left',
                __('Image Zoom Out Right', 'leadinjection') => 'imghvr-zoom-out-right',
                __('Image Zoom Out Flip Horiz', 'leadinjection') => 'imghvr-zoom-out-flip-horiz',
                __('Image Zoom Out Flip Vert', 'leadinjection') => 'imghvr-zoom-out-flip-vert',
                __('Image Blur', 'leadinjection') => 'imghvr-blur',

            ),
            'dependency' => array(
                'element' => 'imagehover',
                'value' => array('yes')
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a image hover background color', 'leadinjection'),
            'param_name' => 'imagehover_background_color',
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_image_params = leadinjection_add_responsive_helper_params($leadinjection_image_params);

    vc_map(array(
            "name" => __("Single Image", "leadinjection"),
            "base" => "leadinjection_image",
            "class" => "",
            "icon" => 'li-icon li-image',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Single Image with CSS animation.', 'leadinjection'),
            "params" => $leadinjection_image_params
        )
    );
}

