<?php

/*
    Default Image
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_image_gallery', 'leadinjection_image_gallery_shortcode');

function leadinjection_image_gallery_shortcode($atts, $content)
{
    $default_atts = array(
        'content' => !empty($content) ? $content : '',
        'images' => '',
        'images_per_row' => '4',
        'images_row_gap' => '0px',
        'images_border_radius' => '0px',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('image_gallery_', $shortcode_id);
    $wrapper_class = array('li-image-gallery', $xclass, $responsive_helper);
    
    // Load Images
    $image_container = array();
    if(!empty($images)){

        $images_arr = explode( ',', $images);

        foreach ( $images_arr as $key => $img_id ){

            $att_img_link = wp_get_attachment_image_src( $img_id, 'full');
            $att_img_link_featured = wp_get_attachment_image_src( $img_id, 'leadinjection-gallery-image-'.$images_per_row);
            $att_img_caption = get_the_excerpt( $img_id );
            $att_img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);


            $image_container[] = '<a class="gallery-image-link" href="'. esc_url($att_img_link[0]) .'" title="'.$att_img_caption.'"><img class="gallery-image" src="'. esc_url($att_img_link_featured[0]) .'" alt="'. esc_attr($att_img_alt) .'" /></a>';
        }
    }

    // Style
    $output_style = '<style scoped>';
    $output_style .= '#' . $shortcode_id . ' .image-gallery-wrapper{ width: calc(100% / '.$images_per_row.' ); }';
    
    if('0px' != $images_row_gap){
        $output_style .= '#' . $shortcode_id . '.li-image-gallery{ margin: -'.$images_row_gap.'; }';
        $output_style .= '#' . $shortcode_id . ' .image-gallery-item{ margin: '.$images_row_gap.'; }';
    }

    if('0px' != $images_border_radius){
        $output_style .= '#' . $shortcode_id . ' .gallery-image-link{ border-radius: '.$images_border_radius.'; }';
    }
    
    $output_style .= '</style>';

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

    <script>
        jQuery(document).ready(function($) {
            $('#<?php echo $shortcode_id ?>').magnificPopup({
                delegate: 'a', type: 'image', gallery:{ enabled:true }
            });
        });
    </script>

    <?php echo $output_style; ?>

    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>>
        <?php foreach ($image_container as $key => $image) :?>
            <div class="image-gallery-wrapper">
                <div class="image-gallery-item">
                    <?php echo $image; ?>
                </div>
            </div>
        <?php endforeach; ?>
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

add_action('vc_before_init', 'leadinjection_image_gallery_vc');

function leadinjection_image_gallery_vc()
{
    $leadinjection_image_gallery_params = array(
        array(
            'type' => 'attach_images',
            'heading' => __('Select images', 'leadinjection'),
            'param_name' => 'images',
            'value' => '',
            'admin_label' => false,
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Images per row', 'leadinjection'),
            'param_name' => 'images_per_row',
            'edit_field_class' => 'vc_col-sm-6',
            'value' => array(
                __('2', 'leadinjection') => '2',
                __('3', 'leadinjection') => '3',
                __('4', 'leadinjection') => '4',
                __('5', 'leadinjection') => '5',
                __('6', 'leadinjection') => '6',
                __('7', 'leadinjection') => '7',
                __('8', 'leadinjection') => '8',
                __('9', 'leadinjection') => '9',
                __('10', 'leadinjection') => '10',
            ),
            'std' => '4'
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Gap between images', 'leadinjection'),
            'param_name' => 'images_row_gap',
            'edit_field_class' => 'vc_col-sm-6',
            'value' => array(
                __('0px', 'leadinjection') => '0px',
                __('5px', 'leadinjection') => '2.5px',
                __('10px', 'leadinjection') => '5px',
                __('15px', 'leadinjection') => '7.5px',
                __('20px', 'leadinjection') => '10px',
                __('25px', 'leadinjection') => '12.5px',
                __('30px', 'leadinjection') => '15px',
            )
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Image border radius', 'leadinjection'),
            'param_name' => 'images_border_radius',
            'edit_field_class' => 'vc_col-sm-6',
            'value' => array(
                __('0px', 'leadinjection') => '0px',
                __('5px', 'leadinjection') => '5px',
                __('10px', 'leadinjection') => '10px',
                __('15px', 'leadinjection') => '15px',
                __('20px', 'leadinjection') => '20px',
                __('25px', 'leadinjection') => '25px',
                __('30px', 'leadinjection') => '30px',
            ),
            'std' => '0px'
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_image_gallery_params = leadinjection_add_responsive_helper_params($leadinjection_image_gallery_params);

    vc_map(array(
            "name" => __("Image Gallery", "leadinjection"),
            "base" => "leadinjection_image_gallery",
            "class" => "",
            "icon" => 'li-icon li-image-gallery',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Responsive image gallery', 'leadinjection'),
            "params" => $leadinjection_image_gallery_params
        )
    );
}

