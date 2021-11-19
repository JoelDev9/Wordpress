<?php

/*
    Textblock
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_progress_bar', 'leadinjection_progress_bar_shortcode');

function leadinjection_progress_bar_shortcode($atts, $content)
{

    $default_atts = array(
        'content' => !empty($content) ? $content : '',
        'progressbar_style' => 'li-progressbar-bar',
        'progressbar_duration' => '1500',
        'progressbar_label' => '',
        'progressbar_label_color' => '',
        'progressbar_value' => '50',
        'progressbar_value_background_color' => '',
        'progressbar_units' => '',
        'progressbar_value_color' => '#33495F',
        'progressbar_trail_color' => '#ECF0F1',
        'progressbar_progress_color_form' => '#33495F',
        'progressbar_progress_color_to' => '#06A1F2',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('progress_bar_', $shortcode_id);
    $wrapper_class = array('li-progressbar-bar', $xclass, $responsive_helper);

    wp_enqueue_script('waypoints');
    wp_enqueue_script('progressbar-js');

    if(!empty($progressbar_label)){
        $label_style = (!empty($progressbar_label_color)) ? 'style="color: '.$progressbar_label_color.';"' : '';
        $progressbar_label = '<div class="'.$progressbar_style.'-label" '.$label_style.'>'.$progressbar_label.'</div>';
    }

    $output_style = null;
    if(!empty($progressbar_value_background_color)) {

        $output_style  = '<style scoped>';
        $output_style .= '#'.$shortcode_id.' .progressbar-round-value {background-color: '.$progressbar_value_background_color.';}';
        $output_style .= '</style>';

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

    <?php if('li-progressbar-bar' == $progressbar_style) :?>

    <script>
        jQuery(document).ready(function($) {

            $('#<?php echo $shortcode_id; ?>').waypoint(function() {
                
                var progressbar_bar = new ProgressBar.Line(<?php echo $shortcode_id; ?>, {
                        color: '<?php echo $progressbar_value_color; ?>',
                        trailColor: '<?php echo $progressbar_trail_color; ?>',
                        strokeWidth: 2.7,
                        easing: 'easeInOut',
                        duration: <?php echo $progressbar_duration; ?>,
                        trailWidth: 1.5,
                        svgStyle: {width: '100%', height: '100%'},
                        text: {
                            className: 'li-progressbar-bar-value',
                            style: {
                                color: '<?php echo $progressbar_value_color; ?>',
                            },
                            autoStyleContainer: false
                        },
                        from: {color: '<?php echo $progressbar_progress_color_form; ?>'},
                        to: {color: '<?php echo $progressbar_progress_color_to; ?>'},
                        step: function(state, progressbar_bar) {
                        progressbar_bar.path.setAttribute('stroke', state.color);
                        progressbar_bar.setText(Math.round(progressbar_bar.value() * 100) + ' <?php echo $progressbar_units; ?>');
            }

            });
                progressbar_bar.animate(<?php echo $progressbar_value / 100; ?>);
                $('#<?php echo $shortcode_id; ?>').prepend('<?php echo $progressbar_label; ?>');

                this.destroy();

            }, {
                offset: '87%'
            });

        });
    </script>

    <div id="<?php echo $shortcode_id; ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>></div>

    <?php endif; ?>




    <?php if('li-progressbar-bar-full' == $progressbar_style) :?>

    <script>
        jQuery(document).ready(function($) {

            $('#<?php echo $shortcode_id; ?>').waypoint(function() {
                
                var progressbar_bar_full = new ProgressBar.Line(<?php echo $shortcode_id; ?>, {
                        color: '<?php echo $progressbar_value_color; ?>',
                        trailColor: '<?php echo $progressbar_trail_color; ?>',
                        strokeWidth: 6.5,
                        easing: 'easeInOut',
                        duration: <?php echo $progressbar_duration; ?>,
                        trailWidth: 6.5,
                        svgStyle: {width: '100%', height: '100%'},
                        text: {
                            className: 'li-progressbar-bar-full-value',
                            style: {
                                color: '<?php echo $progressbar_value_color; ?>',
                            },
                            autoStyleContainer: false
                        },
                        from: {color: '<?php echo $progressbar_progress_color_form; ?>'},
                        to: {color: '<?php echo $progressbar_progress_color_to; ?>'},
                        step: function(state, progressbar_bar_full) {
                        progressbar_bar_full.path.setAttribute('stroke', state.color);
                        progressbar_bar_full.setText(Math.round(progressbar_bar_full.value() * 100) + ' <?php echo $progressbar_units; ?>');
            }

            });
                progressbar_bar_full.animate(<?php echo $progressbar_value / 100; ?>);
                $('#<?php echo $shortcode_id; ?>').prepend('<?php echo $progressbar_label; ?>');
                this.destroy();
            }, {
                offset: '87%'
            });

        });
    </script>

    <div id="<?php echo $shortcode_id; ?>" class="li-progressbar-bar-full <?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>></div>

    <?php endif; ?>





    <?php if('li-progressbar-round' == $progressbar_style) :?>

    <script>
        jQuery(document).ready(function($) {

            $('#<?php echo $shortcode_id; ?>').waypoint(function() {
            
            var progressbar_round = new ProgressBar.Circle(<?php echo $shortcode_id; ?>, {
                color: '<?php echo $progressbar_value_color; ?>',
                trailColor: '<?php echo $progressbar_trail_color; ?>',
                strokeWidth: 8,
                trailWidth: 3,
                easing: 'easeInOut',
                duration: <?php echo $progressbar_duration; ?>,
                text: {
                    className: 'progressbar-round-value',
                    autoStyleContainer: false
                },
                from: { color: '<?php echo $progressbar_progress_color_form; ?>', width: 6 },
                to: { color: '<?php echo $progressbar_progress_color_to; ?>', width: 6 },
                step: function(state, circle) {
                    circle.path.setAttribute('stroke', state.color);
                    circle.path.setAttribute('stroke-width', state.width);

                    var value = Math.round(circle.value() * 100) + '<?php echo $progressbar_units; ?>';
                    if (value === 0) {
                        circle.setText('');
                    } else {
                        circle.setText(value);
                    }

                }
            });
            progressbar_round.animate(<?php echo $progressbar_value / 100; ?>);  // Number from 0.0 to 1.0
            this.destroy();
        }, {
            offset: '87%'
        });

        });
    </script>

    <?php echo $output_style; ?>
    <div id="<?php echo $shortcode_id; ?>" class="li-progressbar-round <?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>></div>

    <?php endif; ?>




    <?php if('li-progressbar-half-round' == $progressbar_style) :?>

    <script>
        jQuery(document).ready(function($) {

            $('#<?php echo $shortcode_id; ?>').waypoint(function() {

            var progressbar_half_round = new ProgressBar.SemiCircle(<?php echo $shortcode_id; ?>, {
                    trailColor: '<?php echo $progressbar_trail_color; ?>',
                    color: '<?php echo $progressbar_value_color; ?>',
                    strokeWidth: 6,
                    trailWidth: 3,
                    easing: 'easeInOut',
                    duration: <?php echo $progressbar_duration; ?>,
                    svgStyle: null,
                    text: {
                        className: 'progressbar-half-round-value',
                        alignToBottom: false
                    },
                    from: {color: '<?php echo $progressbar_progress_color_form; ?>', width: 5},
                    to: {color: '<?php echo $progressbar_progress_color_to; ?>', width: 5},
                    // Set default step function for all animate calls
                    step: function(state, progressbar_half_round) {
                    progressbar_half_round.path.setAttribute('stroke', state.color);
            var value = Math.round(progressbar_half_round.value() * 100);
            if (value === 0) {
                progressbar_half_round.setText('');
            } else {
                progressbar_half_round.setText(value + '<?php echo $progressbar_units; ?>');
            }

            //progressbar_half_round.text.style.color = state.color;
        }
        });


            progressbar_half_round.animate(<?php echo $progressbar_value / 100; ?>);  // Number from 0.0 to 1.0

            this.destroy();

            }, {
                offset: '87%'
            });


        });
    </script>

    <div id="<?php echo $shortcode_id; ?>" class="li-progressbar-half-round <?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>></div>

    <?php endif; ?>



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

add_action('vc_before_init', 'leadinjection_progress_bar_vc');

function leadinjection_progress_bar_vc()
{
    $leadinjection_progress_bar_params = array(
        array(
            'type' => 'dropdown',
            'heading' => __('Select a progress bar style.', 'leadinjection'),
            'param_name' => 'progressbar_style',
            'value' => array(
                __('Bar', 'leadinjection') => 'li-progressbar-bar',
                __('Bar Full', 'leadinjection') => 'li-progressbar-bar-full',
                __('Round', 'leadinjection') => 'li-progressbar-round',
                __('Half Round', 'leadinjection') => 'li-progressbar-half-round',
            ),
            'admin_label' => true,
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Animation duration', 'leadinjection'),
            'param_name' => 'progressbar_duration',
            'value' => array(
                __('1000ms', 'leadinjection') => '1000',
                __('1500ms', 'leadinjection') => '1500',
                __('2000ms', 'leadinjection') => '2000',
                __('2500ms', 'leadinjection') => '2500',
                __('3000ms', 'leadinjection') => '3000',
            ),
            'std' => '1500',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Progress label', 'leadinjection'),
            'param_name' => 'progressbar_label',
            'description' => 'Enter a progress label',
            'dependency' => array(
                'element' => 'progressbar_style',
                'value' => array('li-progressbar-bar', 'li-progressbar-bar-full'),
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Value', 'leadinjection'),
            'param_name' => 'progressbar_value',
            'description' => 'Enter value for graph (Note: choose range from 0 to 100).',
            'value' => '50',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Units', 'leadinjection'),
            'param_name' => 'progressbar_units',
            'description' => 'Enter measurement units (Example: %, px, points, etc.).',
            'value' => '',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Label Color', 'leadinjection'),
            'param_name' => 'progressbar_label_color',
            'value' => '#33495F',
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element' => 'progressbar_style',
                'value' => array('li-progressbar-bar', 'li-progressbar-bar-full'),
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Value & Units color', 'leadinjection'),
            'param_name' => 'progressbar_value_color',
            'value' => '#33495F',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Value & Units background color', 'leadinjection'),
            'param_name' => 'progressbar_value_background_color',
            'value' => '',
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element' => 'progressbar_style',
                'value' => array('li-progressbar-round'),
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Trail color', 'leadinjection'),
            'param_name' => 'progressbar_trail_color',
            'value' => '#ECF0F1',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Progress color (from)', 'leadinjection'),
            'param_name' => 'progressbar_progress_color_form',
            'value' => '#33495F',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Progress color (to)', 'leadinjection'),
            'param_name' => 'progressbar_progress_color_to',
            'value' => '#06A1F2',
            'edit_field_class' => 'vc_col-sm-6',
        ),

        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_progress_bar_params = leadinjection_add_responsive_helper_params($leadinjection_progress_bar_params);

    vc_map(array(
            "name" => __("Progress Bar", "leadinjection"),
            "base" => "leadinjection_progress_bar",
            "class" => "",
            "icon" => 'li-icon li-progress-bar',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Animated progress bar / circle', 'leadinjection'),
            "params" => $leadinjection_progress_bar_params
        )
    );
}

