<?php

/*
    Pricing Table
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_pricing_table_simple', 'leadinjection_pricing_table_simple_shortcode');

function leadinjection_pricing_table_simple_shortcode($atts, $content)
{
    $default_atts = array(
        'content' => !empty($content) ? $content : '',
        'pricing_table_color' => '',
        'pricing_table_highlight_color' => '',
        'pricing_table_border_color' => '',
        'pricing_table_radius' => '',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('pricing_table_simple_', $shortcode_id);
    $wrapper_class = array('pricing-table', $xclass, $responsive_helper);

    $data_effect = '';
    if ('none' !== $animation) {
        leadinjection_enqueue_animation();
        $wrapper_class[] = 'li-animate';
        $data_effect = 'data-effect="' . esc_attr($animation) . '"';
    }

    $style = '';
    $style .= (!empty($pricing_table_color)) ? "#$shortcode_id .pricing-table-col .pricing-table-price { color: $pricing_table_color; }" : null;
    $style .= (!empty($pricing_table_highlight_color)) ? "#$shortcode_id .pricing-table-col.highlight { background-color: $pricing_table_highlight_color; }" : null;
    $style .= (!empty($pricing_table_border_color)) ? "#$shortcode_id .pricing-table-col { border-color: $pricing_table_border_color; }" : null;
    $style .= (!empty($pricing_table_radius)) ? "#$shortcode_id .pricing-table-col { border-radius: $pricing_table_radius; }" : null;

    $output_style = (!empty($style)) ? '<style scoped>' . $style . '</style>' : null;

    // Create wrapper classes string
    $wrapper_class  = leadinjection_wrapper_class($wrapper_class, $css);

    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>


    <?php echo $output_style; ?>

    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect ?>>
        <?php echo do_shortcode($content); ?>
    </div>


    <?php
    // End Output
    //////////////////////////////////////////////////////////////////////////////////////////

    $output = ob_get_contents();
    ob_end_clean();

    return $output;

}


/*
    Image Review Slider Item
*/

add_shortcode('leadinjection_pricing_table_simple_item', 'leadinjection_pricing_table_simple_shortcode_item');

function leadinjection_pricing_table_simple_shortcode_item($atts, $content)
{
    $defaults = shortcode_atts(array(
        'highlight' => null,
        'title' => '',
        'title_color' => '',
        'currency_sign' => '$',
        'price' => '',
        'terms' => '',
        'price_color' => '',
        'content' => !empty($content) ? $content : '',
        'content_color' => '',
        'action_button' => '',
        'button_value' => '',
        'size' => 'btn-md',
        'color' => '',
        'background_color' => '',
        'border_color' => '',
        'value_color' => '',
        'style' => '',
        'enable_link' => '',
        'link_url' => '',
        'trigger_modal' => '',
        'modal_id' => '',
        'xclass' => '',
    ), $atts);

    // TODO: Table action button!

    extract($defaults);
    $button_id = leadinjection_custom_id('tbtn-', '');

    if(!empty($trigger_modal)) {
        $modal = leadinjection_get_modal($modal_id);
        $modal_id = $modal['modal_id'];
    }

    $button_class = array($xclass, $size, $color, $style);

    $output_style = null;
    if ('custom' === $color) {

        $bacground_css = ('' !== $background_color) ? 'background-color: ' . $background_color . '; ' : null;
        $border_css = ('' !== $border_color) ? 'border-color: ' . $border_color . '; ' : null;
        $value_css = ('' !== $value_color) ? 'color:' . $value_color . '; ' : null;


        $output_style = '<style scoped>';
        $output_style .= '#' . $button_id . '{' . $bacground_css . $border_css . $value_css . '}';
        $output_style .= '</style>';
    }

    if(!empty($title_color)){
        $title_color = 'style="color: '.$title_color.';"';
    }

    if(!empty($price_color)){
        $price_color = 'style="color: '.$price_color.';"';
    }

    if(!empty($content_color)){
        $content_color = 'style="color: '.$content_color.';"';
    }

    $action = '';
    if('true' === $action_button){

        $attributes = null;
        if ('yes' === $enable_link) {
            $link = vc_build_link($link_url);

            $attributes = array();
            $attributes[] = 'href="' . esc_url($link['url']) . '"';
            $attributes[] = ('' !== $link['title']) ? 'title="' . esc_attr($link['title']) . '"' : null;
            $attributes[] = ('' !== $link['target']) ? 'target="' . esc_attr($link['target']) . '"' : null;

            $attributes = implode(' ', $attributes);
        }

        ('yes' === $trigger_modal) ? $attributes = 'data-toggle="modal" data-target="#liModal-' . $modal_id . '"' : null;

        $button_class = implode(' ', $button_class);

        $action  = '<div class="action">';
        $action .= '<a class="btn '.$button_class.'" '.$attributes.' id="'.$button_id.'">'.$button_value.'</a>';
        $action .= '</div>';
    }

    $wrapper_class = $xclass.' '.$highlight;

    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>

    <?php echo $output_style; ?>
    <div class="pricing-table-col <?php echo esc_attr($wrapper_class); ?>">
        <h3 class="pricing-table-title" <?php echo $title_color; ?>><?php echo esc_html($title); ?></h3>
        <div class="pricing-table-price" <?php echo $price_color; ?>>
            <span class="currency"><?php echo $currency_sign; ?></span>
            <span class="price"><?php echo esc_html($price); ?></span>
            <span class="terms"><?php echo $terms ?></span>
        </div>
        <div class="pricing-table-description" <?php echo $content_color; ?>><?php echo wpautop($content); ?></div>
        <?php echo $action; ?>
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

add_action('vc_before_init', 'leadinjection_pricing_table_simple_vc');

function leadinjection_pricing_table_simple_vc()
{
    $leadinjection_pricing_table_simple_params = array(
        array(
            'type' => 'colorpicker',
            'heading' => __('Pricing Table Color', 'leadinjection'),
            'param_name' => 'pricing_table_color',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Pricing Table Highlight Color', 'leadinjection'),
            'param_name' => 'pricing_table_highlight_color',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Pricing Table Border Color', 'leadinjection'),
            'param_name' => 'pricing_table_border_color',
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Select a Table Border Radius.', 'leadinjection'),
            'admin_label' => true,
            'param_name' => 'pricing_table_radius',
            'value' => array(
                __('Defualt', 'leadinjection') => '',
                __('0px', 'leadinjection') => '0px',
                __('3px', 'leadinjection') => '3px',
                __('6px', 'leadinjection') => '6px',
                __('12px', 'leadinjection') => '12px',
                __('24px', 'leadinjection') => '24px'
            ),
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_pricing_table_simple_params = leadinjection_add_responsive_helper_params($leadinjection_pricing_table_simple_params);

    vc_map(array(
            "name" => __("Simple Pricing Table", "leadinjection"),
            "base" => "leadinjection_pricing_table_simple",
            "as_parent" => array('only' => 'leadinjection_pricing_table_simple_item'),
            "content_element" => true,
            "show_settings_on_create" => false,
            "is_container" => true,
            "class" => '',
            "icon" => 'li-icon li-pricing-table',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Pricing Table with Action', 'leadinjection'),
            "params" => $leadinjection_pricing_table_simple_params,
            "js_view" => 'VcColumnView'
        )
    );

    vc_map(array(
            "name" => __("Simple Pricing Table Item", "leadinjection"),
            "base" => "leadinjection_pricing_table_simple_item",
            "icon" => 'li-icon li-pricing-table',
            "content_element" => true,
            "as_child" => array('only' => 'leadinjection_pricing_table_simple'), // Use only|except attributes to limit parent (separate multiple values with comma)
            "params" => array(
                array(
                    'type' => 'checkbox',
                    'heading' => __('Highlight', 'leadinjection'),
                    'param_name' => 'highlight',
                    'value' => array(__('Highlight this Table', 'leadinjection') => 'highlight'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Item title', 'leadinjection'),
                    'param_name' => 'title',
                    'description' => __('Enter Item Title here', 'leadinjection'),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select a title color.', 'leadinjection'),
                    'param_name' => 'title_color',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Currency sign', 'leadinjection'),
                    'param_name' => 'currency_sign',
                    'description' => __('Enter a currency sign', 'leadinjection'),
                    'value' => '$',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Price', 'leadinjection'),
                    'param_name' => 'price',
                    'description' => __('Enter a price here', 'leadinjection'),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Price terms', 'leadinjection'),
                    'param_name' => 'terms',
                    'description' => __('Enter price terms here', 'leadinjection'),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select a price color.', 'leadinjection'),
                    'param_name' => 'price_color',
                ),
                array(
                    'type' => 'textarea',
                    'heading' => __('Description', 'leadinjection'),
                    'param_name' => 'content',
                    'description' => __('Enter price description here', 'leadinjection'),
                    'admin_label' => true,
                    'value' => 'Describe your offer here!'
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select a description color.', 'leadinjection'),
                    'param_name' => 'content_color',
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'action_button',
                    'value' => array(__('Add a action button', 'leadinjection') => 'true'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Enter a button value', 'leadinjection'),
                    'param_name' => 'button_value',
                    'admin_label' => true,
                    'dependency' => array(
                        'element' => 'action_button',
                        'value' => array('true')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('Select a button size', 'leadinjection'),
                    'admin_label' => true,
                    'param_name' => 'size',
                    'value' => array(
                        __('Medium Button', 'leadinjection') => 'btn-md',
                        __('Small Button', 'leadinjection') => 'btn-sm',
                        __('Large Button', 'leadinjection') => 'btn-lg',
                        __('Extra Large Button', 'leadinjection') => 'btn-xl',
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('Select a button color.', 'leadinjection'),
                    'admin_label' => true,
                    'param_name' => 'color',
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
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select a button background color', 'leadinjection'),
                    'param_name' => 'background_color',
                    'dependency' => array(
                        'element' => 'color',
                        'value' => 'custom',
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select a button border color', 'leadinjection'),
                    'param_name' => 'border_color',
                    'dependency' => array(
                        'element' => 'color',
                        'value' => 'custom',
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select a button text color', 'leadinjection'),
                    'param_name' => 'value_color',
                    'dependency' => array(
                        'element' => 'color',
                        'value' => 'custom',
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('Select a button style', 'leadinjection'),
                    'param_name' => 'style',
                    'value' => array(
                        __('Rounded', 'leadinjection') => '',
                        __('Square', 'leadinjection') => 'btn-square',
                        __('Round', 'leadinjection') => 'btn-round',

                        __('Rounded 3D', 'leadinjection') => 'btn-3d',
                        __('Square 3D', 'leadinjection') => 'btn-square btn-3d',
                        __('Round 3D', 'leadinjection') => 'btn-round btn-3d',

                        __('Rounded Outline', 'leadinjection') => 'btn-outline',
                        __('Square Outline', 'leadinjection') => 'btn-square btn-outline',
                        __('Round Outline', 'leadinjection') => 'btn-round btn-outline',
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'enable_link',
                    'value' => array(__('Add a Link to the button', 'leadinjection') => 'yes'),
                    'dependency' => array(
                        'element' => 'action_button',
                        'value' => array('true')
                    ),
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
                    'type' => 'checkbox',
                    'param_name' => 'trigger_modal',
                    'value' => array(__('Add a modal trigger action', 'leadinjection') => 'yes'),
                    'dependency' => array(
                        'element' => 'action_button',
                        'value' => array('true')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('Select a available modal', 'leadinjection'),
                    'value' => leadinjection_get_modals(),
                    'admin_label' => true,
                    'param_name' => 'modal_id',
                    'description' => __('Note! You also need to set the Modal in the page', 'leadinjection'),
                    'dependency' => array(
                        'element' => 'trigger_modal',
                        'value' => array('yes')
                    ),
                ),
                leadinjection_xclass_field(),
            )
        )
    );
}


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_leadinjection_pricing_table_simple extends WPBakeryShortCodesContainer
    {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_leadinjection_pricing_table_simple_item extends WPBakeryShortCode
    {
    }
}