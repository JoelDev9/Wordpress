<?php

/*
    Number Counter
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_number_counter', 'leadinjection_number_counter_shortcode');

function leadinjection_number_counter_shortcode($atts, $content)
{
    $default_atts = array(
        'counter_start' => '0',
        'counter_end' => '0',
        'counter_speed' => '5000',
        'counter_color' => '',
        'counter_label' => '',
        'counter_label_color' => '',
        'divider' => 'on',
        'divider_color' => '',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('number_counter_', $shortcode_id);
    $wrapper_class = array('number-counter', $xclass, $responsive_helper);

    // Enqueue needed js scripts.
    leadinjection_enqueue_counter();

    $data_effect = '';
    if ('none' !== $animation) {
        leadinjection_enqueue_animation();
        $wrapper_class[] = 'li-animate';
        $data_effect = 'data-effect="' . esc_attr($animation) . '"';
    }

    $counter_color = ('' !== $counter_color) ? 'style="color: '.$counter_color.';"' : null;
    $counter_label_color = ('' !== $counter_label_color) ? 'style="color: '.$counter_label_color.';"' : null;
    $divider_color = ('' !== $divider_color) ? 'style="background-color: '.$divider_color.';"' : null;

    // Create wrapper classes string
    $wrapper_class  = leadinjection_wrapper_class($wrapper_class, $css);

    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>


    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>>
        <div class="number-counter-value" <?php echo $counter_color; ?> data-start="<?php echo $counter_start; ?>" data-end="<?php echo esc_attr($counter_end); ?>" data-speed="<?php echo esc_attr($counter_speed); ?>">0</div>
        <div class="number-counter-label" <?php echo $counter_label_color; ?>><?php echo esc_html($counter_label); ?></div>
        <?php if('on' == $divider) : ?>
            <div class="number-counter-divider" <?php echo $divider_color; ?>></div>
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

add_action('vc_before_init', 'leadinjection_number_counter_vc');

function leadinjection_number_counter_vc()
{
    $leadinjection_number_counter_params = array(
        array(
            'type' => 'textfield',
            'heading' => __('Counter start ( enter a value where the counter should start. )', 'leadinjection'),
            'param_name' => 'counter_start',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Counter end ( enter a value where the counter should end. )', 'leadinjection'),
            'param_name' => 'counter_end',
            'admin_label' => true,
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select counter color', 'leadinjection'),
            'param_name' => 'counter_color',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Counter speed ( enter Time im MS )', 'leadinjection'),
            'param_name' => 'counter_speed',
            'value' => '5000',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Enter a counter label', 'leadinjection'),
            'param_name' => 'counter_label',
            'admin_label' => true,
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a label color', 'leadinjection'),
            'param_name' => 'counter_label_color',
        ),
        array(
            'type' => 'checkbox',
            'heading' => __( 'Disabel divider', 'leadinjection' ),
            'param_name' => 'divider',
            'value' => array(__('Disable divider at the bottom', 'leadinjection') => 'off'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a divider color', 'leadinjection'),
            'param_name' => 'divider_color',
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_number_counter_params = leadinjection_add_responsive_helper_params($leadinjection_number_counter_params);

    vc_map(array(
            "name" => __("Number Counter", "leadinjection"),
            "base" => "leadinjection_number_counter",
            "icon" => 'li-icon li-number-counter',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('A Number Counter', 'leadinjection'),
            "params" => $leadinjection_number_counter_params
        )
    );
}
