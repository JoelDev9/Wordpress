<?php

/*
    Heading
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_heading', 'leadinjection_heading_shortcode');

function leadinjection_heading_shortcode($atts)
{

    $default_atts = array(
        'heading_type' => 'h2',
        'heading_text' => '',
        'heading_text_weight' => 'fw-bold',
        'secondary_text' => '',
        'secondary_text_weight' => 'fw-light',
        'heading_text_color' => null,
        'secondary_text_color' => null,
        'align' => 'left',
        'animation' => 'none',
        'css' => '',
        'xclass' => '',
        'shortcode_id' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('heading_', $shortcode_id);
    $wrapper_class = array('li-heading',$xclass, $align, $heading_text_weight, $responsive_helper);

    if (!is_null($heading_text_color)) {
        $heading_text_color = 'style="color: ' . $heading_text_color . ';"';
    }

    if (!is_null($secondary_text_color)) {
        $secondary_text_color = 'style="color: ' . $secondary_text_color . ';"';
    }

    if('' != $secondary_text){
        $secondary_text = '<small ' . $secondary_text_color . ' class="'.$secondary_text_weight.'">' . $secondary_text . '</small>';
    }

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



    <<?php echo $heading_type ?> id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $heading_text_color; ?> <?php echo $data_effect; ?>>
        <?php echo $heading_text; ?>
        <?php echo $secondary_text; ?>
    </<?php echo $heading_type ?>>



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

add_action('vc_before_init', 'leadinjection_heading_vc');

function leadinjection_heading_vc()
{
    $leadinjection_heading_params = array(
        array(
            'type' => 'dropdown',
            'heading' => __('Select a heading type', 'leadinjection'),
            'param_name' => 'heading_type',
            'value' => array(
                __('H1 Heading', 'leadinjection') => 'h1',
                __('H2 Heading', 'leadinjection') => 'h2',
                __('H3 Heading', 'leadinjection') => 'h3',
                __('H4 Heading', 'leadinjection') => 'h4',
                __('H5 Heading', 'leadinjection') => 'h5',
                __('H6 Heading', 'leadinjection') => 'h6',
            ),
            "std" => 'h2',
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Heading alignment', 'leadinjection'),
            'param_name' => 'align',
            'value' => array(
                __('Align left', 'leadinjection') => 'left',
                __('Align Center', 'leadinjection') => 'center',
                __('Align right', 'leadinjection') => 'right',),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Enter heading text', 'leadinjection'),
            'param_name' => 'heading_text',
            'admin_label' => true,
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('', 'leadinjection'),
            'param_name' => 'heading_text_weight',
            'admin_label' => true,
            'value' => array(
                __('Font Weight Light', 'leadinjection') => 'fw-light',
                __('Font Weight Normal', 'leadinjection') => 'fw-normal',
                __('Font Weight Bold', 'leadinjection') => 'fw-bold',),
            'std' => 'fw-bold',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a heading color', 'leadinjection'),
            'param_name' => 'heading_text_color',
        ),
        array(
            'type' => 'textarea',
            'heading' => __('Enter secondary text', 'leadinjection'),
            'param_name' => 'secondary_text',
            'admin_label' => true,
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('', 'leadinjection'),
            'param_name' => 'secondary_text_weight',
            'admin_label' => true,
            'value' => array(
                __('Font Weight Light', 'leadinjection') => 'fw-light',
                __('Font Weight Normal', 'leadinjection') => 'fw-normal',
                __('Font Weight Bold', 'leadinjection') => 'fw-bold',),
            'std' => 'fw-light',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a secondary text color', 'leadinjection'),
            'param_name' => 'secondary_text_color',
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );


    $leadinjection_heading_params = leadinjection_add_responsive_helper_params($leadinjection_heading_params);

    vc_map(array(
            "name" => __("Heading", "leadinjection"),
            "base" => "leadinjection_heading",
            "class" => "",
            "icon" => 'li-icon li-heading',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Heading with Secondary text', 'leadinjection'),
            "params" => $leadinjection_heading_params
        )
    );
}

