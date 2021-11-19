<?php

/**
 *   Form Shortcode
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_form', 'leadinjection_form_shortcode');

function leadinjection_form_shortcode($atts, $content)
{
    $default_atts = shortcode_atts(array(
        'content' => !empty($content) ? $content : '',
        'form_id' => null,
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    ), $atts);

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('form_', $shortcode_id);
    $wrapper_class = array('li-textblock', $xclass, $responsive_helper);

    $style  = '';
    //$style .= (!empty($content_color)) ? "#$shortcode_id, #$shortcode_id p { color: $content_color; }" : null;
    $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;


    $data_effect = '';
    if ('none' !== $animation) {
        leadinjection_enqueue_animation();
        $wrapper_class[] = 'li-animate';
        $data_effect = 'data-effect="' . esc_attr($animation) . '"';
    }

    // Create wrapper classes string
    $wrapper_class  = leadinjection_wrapper_class($wrapper_class, $css);

    $form = leadinjection_get_form($form_id);

    //$form_id = $form['form_id'];
    if($form['success']){
        $form_data = $form['result']->post_content;
    }else{
        $form_data = "<br><div style='background: red; color: #fff; margin: 50px; text-align: center; padding: 30px;'>Form not found!</div><br>";
    }
    
    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>

    <?php echo $output_style; ?>
    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>>
        <?php echo do_shortcode($form_data); ?>
        <form action="<?php get_permalink(); ?>" method="post">

            <input type="text" name="textfield" id="textfield">
            <input type="hidden" name="li_form_submission" value="1">
            <input type="submit" value="Send" name="submit" id="submit">

        </form>
    </div>

    <?php
    // End Output
    //////////////////////////////////////////////////////////////////////////////////////////

    $output = ob_get_contents();
    ob_end_clean();

    return $output;

}


/**
 * Visual Composer Registration
 */

add_action('vc_before_init', 'leadinjection_form_vc');

function leadinjection_form_vc()
{
    vc_map(array(
            "name" => __("Lead Form", "leadinjection"),
            "base" => "leadinjection_form",
            "class" => "",
            "icon" => 'li-icon',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Title and Sub Title for a Section', 'leadinjection'),
            "params" => array(
                array(
                    'type' => 'dropdown',
                    'heading' => __('Available Forms', 'leadinjection'),
                    'value' => leadinjection_get_forms(),
                    'admin_label' => true,
                    'param_name' => 'form_id',
                    'description' => __('Select icon library', 'leadinjection'),
                ),
                leadinjection_animation_field(),
                leadinjection_css_editor_field(),
                leadinjection_xclass_field(),
                leadinjection_shortcode_id_field(),
            )
        )
    );
}