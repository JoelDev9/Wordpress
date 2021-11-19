<?php

/*
    Textblock
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_countdown', 'leadinjection_countdown_shortcode');

function leadinjection_countdown_shortcode($atts, $content)
{

    $default_atts = array(
        'content' => !empty($content) ? $content : '',
        'countdown_color' => '',
        'countdown_style' => 'line',
        'countdown_date' => '',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );


    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);


    $shortcode_id = leadinjection_custom_id('countdown_', $shortcode_id);
    $wrapper_class = array('li-countdown', 'li-countdown-md', $xclass, $countdown_style, $responsive_helper);

    if(empty($countdown_date) || 'YYYY/MM/DD' == $countdown_date){
       $countdown_date = '2016/01/01';
    }

    $text_color = $border_color = '';
    if(!empty($countdown_color)) {
        $text_color = 'style="color: '.$countdown_color.';"';
        $border_color = 'style="border-color: '.$countdown_color.';"';
    }

    $underline = ('line' == $countdown_style) ? 'style="border-color: '.$countdown_color.';"' : null;

    $data_effect = '';
    if ('none' !== $animation) {
        leadinjection_enqueue_animation();
        $wrapper_class[] = 'li-animate ';
        $data_effect = 'data-effect="' . esc_attr($animation) . '"';
    }

    // Create wrapper classes string
    $wrapper_class  = leadinjection_wrapper_class($wrapper_class, $css);

    wp_enqueue_script('countdown');

    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>

    <script>
        jQuery(document).ready(function($) {
            $('#<?php echo $shortcode_id ?>').countdown('<?php echo $countdown_date; ?>').on('update.countdown', function (event) {

                $('#<?php echo $shortcode_id ?> .li-countdown-counter.day-value').html(event.strftime('%-D'));
                $('#<?php echo $shortcode_id ?> .li-countdown-counter.hour-value').html(event.strftime('%-H'));
                $('#<?php echo $shortcode_id ?> .li-countdown-counter.minute-value').html(event.strftime('%-M'));
                $('#<?php echo $shortcode_id ?> .li-countdown-counter.second-value').html(event.strftime('%-S'));

            });
        });
    </script>


    <div id="<?php echo $shortcode_id; ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?> <?php echo $text_color; ?>>
        <div class="li-countdown-block" <?php echo $border_color; ?>>
            <div class="li-countdown-counter day-value" <?php echo $underline; ?>>00</div>
            <div class="li-countdown-label"><?php echo __( 'DAYS', 'leadinjection' ); ?></div>
        </div>
        <div class="li-countdown-block" <?php echo $border_color; ?>>
            <div class="li-countdown-counter hour-value" <?php echo $underline; ?>>00</div>
            <div class="li-countdown-label"><?php echo __( 'HOURS', 'leadinjection' ); ?></div>
        </div>
        <div class="li-countdown-block" <?php echo $border_color; ?>>
            <div class="li-countdown-counter minute-value" <?php echo $underline; ?>>00</div>
            <div class="li-countdown-label"><?php echo __( 'MINUTES', 'leadinjection' ); ?></div>
        </div>
        <div class="li-countdown-block" <?php echo $border_color; ?>>
            <div class="li-countdown-counter second-value" <?php echo $underline; ?>>00</div>
            <div class="li-countdown-label"><?php echo __( 'SECONDS', 'leadinjection' ); ?></div>
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

add_action('vc_before_init', 'leadinjection_countdown_vc');

function leadinjection_countdown_vc()
{
    $leadinjection_leadinjection_countdown_params = array(
        array(
            'type' => 'textfield',
            'heading' => __('Enter a countdown end date', 'leadinjection'),
            'param_name' => 'countdown_date',
            'value' => 'YYYY/MM/DD',
            'description' => 'Default format = YYYY/MM/DD',
            'admin_label' => true,
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a countdown color', 'leadinjection'),
            'param_name' => 'countdown_color',
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Countdown style', 'leadinjection'),
            'param_name' => 'countdown_style',
            'value' => array(
                __('Default', 'leadinjection') => 'line',
                __('Box', 'leadinjection') => 'box',
                __('Round', 'leadinjection') => 'round',),
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_leadinjection_countdown_params = leadinjection_add_responsive_helper_params($leadinjection_leadinjection_countdown_params);

    vc_map(array(
            "name" => __("Countdown", "leadinjection"),
            "base" => "leadinjection_countdown",
            "class" => "",
            "icon" => 'li-icon li-countdown',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Display a countdown clock', 'leadinjection'),
            "params" => $leadinjection_leadinjection_countdown_params
        )
    );
}

