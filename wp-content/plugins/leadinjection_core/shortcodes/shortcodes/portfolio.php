<?php

/*
    Textblock
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_portfolio', 'leadinjection_portfolio_shortcode');

function leadinjection_portfolio_shortcode($atts, $content)
{

    $default_atts = array(
        'portfolio_style' => 'portfolio_small',
        'portfolio_title' => '',
        'portfolio_images' => '',
        'content' => !empty($content) ? $content : '',
        'portfolio_title_color' => '',
        'portfolio_content_color' => '',
        'portfolio_background_color' => '',
        'portfolio_overlay_color' => '',
        'portfolio_launch_link' => '',
        'portfolio_launch_link_color' => '',
        'portfolio_launch_link_background_color' => '',
        'portfolio_launch_link_border_color' => '',
        'portfolio_launch_link_value_color' => '',
        'portfolio_details_link' => '',
        'portfolio_details_link_color' => '',
        'portfolio_details_link_background_color' => '',
        'portfolio_details_link_border_color' => '',
        'portfolio_details_link_value_color' => '',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('portfolio_', $shortcode_id);
    $wrapper_class = array('li-portfolio', $portfolio_style, $xclass, $responsive_helper);
    
    // Load Images
    $image_container = array();
    if(!empty($portfolio_images)){

        $images_arr = explode( ',', $portfolio_images);

        foreach ( $images_arr as $key => $img_id ){

            $att_img_link = wp_get_attachment_image_src( $img_id, 'full');
            $att_img_link_featured = wp_get_attachment_image_src( $img_id, 'li-portfolio-image');
            $att_img_caption = get_the_excerpt( $img_id );
            $att_img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);


            $image_container[] = '<a class="gallery-image-link" href="'. esc_url($att_img_link[0]) .'" title="'.$att_img_caption.'"><img class="img-responsive" src="'. esc_url($att_img_link_featured[0]) .'" alt="'. esc_attr($att_img_alt) .'" /></a>';
        }
    }


    // Links
    $launch_link ='';
    if(!empty($portfolio_launch_link)){
        $launch_link_data = vc_build_link($portfolio_launch_link);

        $launch_link_atts[] = 'href="' . esc_url($launch_link_data['url']) . '"';
        $launch_link_atts[] = ('' !== $launch_link_data['title']) ? 'title="' . esc_attr($launch_link_data['title']) . '"' : null;
        $launch_link_atts[] = ('' !== $launch_link_data['target']) ? 'target="' . esc_attr($launch_link_data['target']) . '"' : null;

        $launch_link_atts = implode(' ', $launch_link_atts);
        $launch_link = '<a ' . $launch_link_atts . ' class="btn btn-sm btn-launch '.$portfolio_launch_link_color.'">' . esc_attr($launch_link_data['title']) . '</a>';
    }

    $details_link ='';
    if(!empty($portfolio_details_link)){
        $details_link_data = vc_build_link($portfolio_details_link);

        $details_link_atts[] = 'href="' . esc_url($details_link_data['url']) . '"';
        $details_link_atts[] = ('' !== $details_link_data['title']) ? 'title="' . esc_attr($details_link_data['title']) . '"' : null;
        $details_link_atts[] = ('' !== $details_link_data['target']) ? 'target="' . esc_attr($details_link_data['target']) . '"' : null;

        $details_link_atts = implode(' ', $details_link_atts);
        $details_link = '<a ' . $details_link_atts . ' class="btn btn-sm btn-details '.$portfolio_details_link_color.'">' . esc_attr($details_link_data['title']) . '</a>';
    }


    // Styles
    $style  = '';
    $style .= (!empty($portfolio_title_color)) ? '#'.$shortcode_id.' .portfolio_title { color: '.$portfolio_title_color.'; }' : null;
    $style .= (!empty($portfolio_content_color)) ? '#'.$shortcode_id.' .portfolio_description { color: '.$portfolio_content_color.'; }' : null;
    $style .= (!empty($portfolio_background_color)) ? '#'.$shortcode_id.' .portfolio_info { background-color: '.$portfolio_background_color.'; }' : null;
    $style .= (!empty($portfolio_background_color)) ? '#'.$shortcode_id.'.portfolio_small .portfolio_info:before { border-bottom-color: '.$portfolio_background_color.'; }' : null;
    $style .= (!empty($portfolio_overlay_color)) ? '#'.$shortcode_id.'.portfolio_small .portfolio_info_overlay { background-color: '.$portfolio_overlay_color.'; }' : null;
    $style .= (!empty($portfolio_overlay_color)) ? '#'.$shortcode_id.'.portfolio_small .portfolio_info_overlay:before { border-bottom-color: '.$portfolio_overlay_color.'; }' : null;
    $style .= (!empty($portfolio_background_color)) ? '#'.$shortcode_id.'.portfolio_large .portfolio_info:before { border-right-color: '.$portfolio_background_color.'; }' : null;
    $style .= (!empty($portfolio_launch_link_background_color)) ? '#'.$shortcode_id.' .btn-launch { background-color: '.$portfolio_launch_link_background_color.'; }' : null;
    $style .= (!empty($portfolio_launch_link_border_color)) ? '#'.$shortcode_id.' .btn-launch { border-color: '.$portfolio_launch_link_border_color.'; }' : null;
    $style .= (!empty($portfolio_launch_link_value_color)) ? '#'.$shortcode_id.' .btn-launch { color: '.$portfolio_launch_link_value_color.'; }' : null;
    $style .= (!empty($portfolio_details_link_background_color)) ? '#'.$shortcode_id.' .btn-details { background-color: '.$portfolio_details_link_background_color.'; }' : null;
    $style .= (!empty($portfolio_details_link_border_color)) ? '#'.$shortcode_id.' .btn-details { border-color: '.$portfolio_details_link_border_color.'; }' : null;
    $style .= (!empty($portfolio_details_link_value_color)) ? '#'.$shortcode_id.' .btn-details { color: '.$portfolio_details_link_value_color.'; }' : null;

    $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;


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
            $('#<?php echo $shortcode_id ?> .portfolio_image_item').magnificPopup({
                delegate: 'a', type: 'image', gallery:{ enabled:true }
            });
        });
    </script>

    <?php echo $output_style; ?>

    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>>

        <div class="portfolio_images">

            <?php if(1 < count($image_container)) :?>
            <div id="<?php echo esc_attr($shortcode_id).'-carousel'; ?>" class="carousel slide" data-ride="carousel">

                <!-- Wrapper for slides -->
                <div class="carousel-inner portfolio_image_item" role="listbox">
                    <?php foreach ($image_container as $key => $image) :?>
                    <div class="item <?php echo (0 == $key) ? 'active' : ''; ?>">
                        <?php echo $image; ?>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Indicators -->
                <?php if('portfolio_large' == $portfolio_style) : ?>
                    <ol class="carousel-indicators">
                    <?php foreach ($image_container as $key => $image) :?>
                        <li data-target="#<?php echo esc_attr($shortcode_id).'-carousel'; ?>" data-slide-to="<?php echo $key; ?>" <?php echo (0 == $key) ? 'class="active"' : ''; ?>></li>
                    <?php endforeach; ?>
                    </ol>
                <?php endif; ?>

                <!-- Controls -->
                <?php if('portfolio_small' == $portfolio_style) : ?>
                    <a class="left carousel-control" href="#<?php echo esc_attr($shortcode_id).'-carousel'; ?>" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#<?php echo esc_attr($shortcode_id).'-carousel'; ?>" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                <?php endif; ?>

            </div>
            <?php else: ?>
                <div class="portfolio_image_item">
                    <?php echo (!empty($image_container[0])) ? $image_container[0] : ''; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="portfolio_meta">
            <div class="portfolio_info">
                <div class="portfolio_title"><?php echo $portfolio_title; ?></div>
                <div class="portfolio_description"><?php echo wpb_js_remove_wpautop( $content, true ); ?></div>
                
                <?php if(!empty($launch_link) || !empty($details_link)) :?>
                    <div class="portfolio_info_overlay">
                        <?php echo $launch_link; ?>
                        <?php echo $details_link; ?>
                    </div>
                <?php endif; ?>
                
            </div>
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

add_action('vc_before_init', 'leadinjection_portfolio_vc');

function leadinjection_portfolio_vc()
{
    $leadinjection_portfolio_params = array(
        array(
            'type' => 'dropdown',
            'heading' => __('Select a portfolio style.', 'leadinjection'),
            'param_name' => 'portfolio_style',
            'value' => array(
                __('Small', 'leadinjection') => 'portfolio_small',
                __('Large', 'leadinjection') => 'portfolio_large',
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Portfolio title', 'leadinjection'),
            'param_name' => 'portfolio_title',
            'admin_label' => true,
        ),
        array(
            'type' => 'attach_images',
            'heading' => __('Portfolio images', 'leadinjection'),
            'param_name' => 'portfolio_images',
        ),
        array(
            'type' => 'textarea',
            'heading' => __('Portfolio description', 'leadinjection'),
            'param_name' => 'content',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Portfolio background color', 'leadinjection'),
            'param_name' => 'portfolio_background_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Portfolio overlay color', 'leadinjection'),
            'param_name' => 'portfolio_overlay_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Portfolio title color', 'leadinjection'),
            'param_name' => 'portfolio_title_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Portfolio content color', 'leadinjection'),
            'param_name' => 'portfolio_content_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'enable_launch_link',
            'value' => array(__('Add a launch project link.', 'leadinjection') => 'yes'),
        ),

        // Launch Link
        array(
            'type' => 'vc_link',
            'param_name' => 'portfolio_launch_link',
            'dependency' => array(
                'element' => 'enable_launch_link',
                'value' => array('yes')
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Select a button color.', 'leadinjection'),
            'admin_label' => true,
            'param_name' => 'portfolio_launch_link_color',
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
            'dependency' => array(
                'element' => 'enable_launch_link',
                'value' => 'yes',
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a button background color.', 'leadinjection'),
            'param_name' => 'portfolio_launch_link_background_color',
            'dependency' => array(
                'element' => 'portfolio_launch_link_color',
                'value' => 'custom',
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a button border color.', 'leadinjection'),
            'param_name' => 'portfolio_launch_link_border_color',
            'dependency' => array(
                'element' => 'portfolio_launch_link_color',
                'value' => 'custom',
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a button text color.', 'leadinjection'),
            'param_name' => 'portfolio_launch_link_value_color',
            'dependency' => array(
                'element' => 'portfolio_launch_link_color',
                'value' => 'custom',
            ),
        ),

        // Details Link
        array(
            'type' => 'checkbox',
            'param_name' => 'enable_details_link',
            'value' => array(__('Link portfolio to an details page', 'leadinjection') => 'yes'),
        ),
        array(
            'type' => 'vc_link',
            'param_name' => 'portfolio_details_link',
            'dependency' => array(
                'element' => 'enable_details_link',
                'value' => array('yes')
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Select a button color.', 'leadinjection'),
            'admin_label' => true,
            'param_name' => 'portfolio_details_link_color',
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
            'dependency' => array(
                'element' => 'enable_details_link',
                'value' => 'yes',
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a button background color.', 'leadinjection'),
            'param_name' => 'portfolio_details_link_background_color',
            'dependency' => array(
                'element' => 'portfolio_details_link_color',
                'value' => 'custom',
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a button border color.', 'leadinjection'),
            'param_name' => 'portfolio_details_link_border_color',
            'dependency' => array(
                'element' => 'portfolio_details_link_color',
                'value' => 'custom',
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a button text color.', 'leadinjection'),
            'param_name' => 'portfolio_details_link_value_color',
            'dependency' => array(
                'element' => 'portfolio_details_link_color',
                'value' => 'custom',
            ),
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_portfolio_params = leadinjection_add_responsive_helper_params($leadinjection_portfolio_params);

    vc_map(array(
            "name" => __("Portfolio", "leadinjection"),
            "base" => "leadinjection_portfolio",
            "class" => "",
            "icon" => 'li-icon li-portfolio',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Launch a Lead Modal', 'leadinjection'),
            "params" => $leadinjection_portfolio_params
        )
    );
}

