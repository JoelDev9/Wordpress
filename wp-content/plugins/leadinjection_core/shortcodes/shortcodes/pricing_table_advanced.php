<?php

/*
    Pricing Table Advanced
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

add_shortcode('leadinjection_pricing_table_advanced', 'leadinjection_pricing_table_advanced_shortcode');

function leadinjection_pricing_table_advanced_shortcode($atts, $content)
{
    $default_atts = array(
        'price_label_value' => '',
        'pricing_feature_labels' => '',
        'header_background_color' => '',
        'header_text_color' => '',
        'price_background_color' => '',
        'price_text_color' => '',
        'feature_background_color' => '',
        'feature_label_color' => '',
        'feature_text_color' => '',
        'action_background_color' => '',
        'table_border_color' => '',
        'table_highlight_border_color' => '',
        'content' => !empty($content) ? $content : '',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper = leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('pricing_table_advanced_', $shortcode_id);
    $wrapper_class = array('li-pricing-table-advanced', $xclass, $responsive_helper);

    $data_effect = '';
    if ('none' !== $animation) {
        leadinjection_enqueue_animation();
        $wrapper_class[] = 'li-animate';
        $data_effect = 'data-effect="' . esc_attr($animation) . '"';
    }

    $feature_labels = (!empty($pricing_feature_labels)) ? explode(',', $pricing_feature_labels) : null;
    $GLOBALS['feature_labels'] = $feature_labels;

    $style = '';
    $style .= (!empty($header_background_color)) ? "#$shortcode_id .pricing-table-header { background-color: $header_background_color; }" : null;
    $style .= (!empty($header_text_color)) ? "#$shortcode_id .pricing-table-header { color: $header_text_color; }" : null;

    $style .= (!empty($price_background_color)) ? "#$shortcode_id .pricing-table-price-label, #$shortcode_id .pricing-table-price { background-color: $price_background_color; }" : null;
    $style .= (!empty($price_text_color)) ? "#$shortcode_id .pricing-table-price { color: $price_text_color; }" : null;

    $style .= (!empty($feature_label_color)) ? "#$shortcode_id .pricing-table-price-label, #$shortcode_id .pricing-table-feature-label { color: $feature_label_color; }" : null;

    $style .= (!empty($feature_background_color)) ? "#$shortcode_id .pricing-table-feature-label, #$shortcode_id .pricing-table-feature-value { background-color: $feature_background_color; }" : null;
    $style .= (!empty($feature_text_color)) ? "#$shortcode_id .pricing-table-feature-value { color: $feature_text_color; }" : null;

    $style .= (!empty($action_background_color)) ? "#$shortcode_id .pricing-table-action { background-color: $action_background_color; }" : null;

    $style .= (!empty($table_border_color)) ? "#$shortcode_id .pricing-table-col { border-color: $table_border_color; }" : null;
    $style .= (!empty($table_border_color)) ? "#$shortcode_id .pricing-table-header { border-color: $table_border_color; }" : null;
    $style .= (!empty($table_border_color)) ? "#$shortcode_id .pricing-table-price-label { border-color: $table_border_color; }" : null;
    $style .= (!empty($table_border_color)) ? "#$shortcode_id .pricing-table-price { border-color: $table_border_color; }" : null;
    $style .= (!empty($table_border_color)) ? "#$shortcode_id .pricing-table-feature-label { border-color: $table_border_color; }" : null;
    $style .= (!empty($table_border_color)) ? "#$shortcode_id .pricing-table-feature-value { border-color: $table_border_color; }" : null;

    $style .= (!empty($table_highlight_border_color)) ? "#$shortcode_id .pricing-table-col.highlight-col { border-color: $table_highlight_border_color; }" : null;

    $output_style = (!empty($style)) ? '<style scoped>' . $style . '</style>' : null;

    // Create wrapper classes string
    $wrapper_class = leadinjection_wrapper_class($wrapper_class, $css);

    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>


    <?php echo $output_style; ?>

    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect ?>>

        <div class="pricing-table-col label-col hidden-xs">
            <div class="pricing-table-header"></div>
            <div class="pricing-table-price-label">
                <?php echo (!empty($price_label_value)) ? $price_label_value : 'PRICE' ?>
            </div>
            <?php if(!is_null($feature_labels)) : ?>
                <?php foreach ($feature_labels as $label) : ?>
                    <div class="pricing-table-feature-label"><?php echo $label; ?></div>
                <?php endforeach; ?>
            <?php endif;  ?>
            <div class="pricing-table-action"></div>
        </div>
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
    Pricing Table Advanced Item
*/

add_shortcode('leadinjection_pricing_table_advanced_item', 'leadinjection_pricing_table_advanced_shortcode_item');

function leadinjection_pricing_table_advanced_shortcode_item($atts, $content)
{
    $feature_labels = $GLOBALS['feature_labels'];

    $defaults = shortcode_atts(array(
        'highlight' => '',
        'price_title' => '',
        'price_subtitle' => '',
        'price_currency_sign' => '$',
        'price_value' => '100',
        'price_condition' => '/mo',
        'pricing_feature_values' => '',
        'content' => !empty($content) ? $content : '',
        'action_button' => '',
        'button_value' => '',
        'size' => 'btn-md',
        'color' => '',
        'style' => '',
        'enable_link' => '',
        'link_url' => '',
        'trigger_modal' => '',
        'modal_id' => '',
        'xclass' => '',
    ), $atts);


    extract($defaults);

    $wrapper_class = array($xclass, $highlight);

    $feature_values = (!empty($pricing_feature_values)) ? explode(',', $pricing_feature_values) : null;

    $button = '';
    if('true' === $action_button){

        if(!empty($trigger_modal)) {
            $modal = leadinjection_get_modal($modal_id);
            $modal_id = $modal['modal_id'];
        }

        $button_id = leadinjection_custom_id('apt-btn-', '');
        $button_class = array($xclass, $size, $color, $style);

        $button_data = array(
            'enable_link' => $enable_link,
            'link_url' => $link_url,
            'trigger_modal' => $trigger_modal,
            'modal_id' => $modal_id,
            'button_class' => $button_class,
            'button_id' => $button_id,
            'button_value' => $button_value,
        );
        $button = leadinjection_default_button($button_data);
    }


    $style = '';
    //$style .= (!empty($content_color)) ? "#$shortcode_id .review-block-review p { color: $content_color; }" : null;
    $output_style = (!empty($style)) ? '<style scoped>' . $style . '</style>' : null;

    // Create wrapper classes string
    $wrapper_class = leadinjection_wrapper_class($wrapper_class, $css ='');

    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>

    <?php echo $output_style; ?>
    <div class="pricing-table-col <?php echo $wrapper_class; ?>">
        <div class="pricing-table-header">
            <div class="pricing-table-title">
                <?php echo $price_title; ?>
                <span class="pricing-table-subtitle">
                    <?php echo $price_subtitle; ?>
                </span>
            </div>
        </div>

        <div class="pricing-table-price">
            <div class="pricing-table-currency-sign"><?php echo $price_currency_sign; ?></div>
            <div class="pricing-table-price-value"><?php echo $price_value; ?></div>
            <div class="pricing-table-condition"><?php echo $price_condition ?></div>
        </div>

        <?php if(!is_null($feature_values)) : ?>
            <?php foreach ($feature_values as $key => $value) : ?>
                <div class="pricing-table-feature-value">
                    <?php switch ($value){
                        case 'check_icon' :
                            $mobile_label = (isset($feature_labels[$key])) ? '<span class="pricing-table-feature-mobile-label">'.$feature_labels[$key].'</span>' : '';
                            echo $mobile_label.'<i class="fa fa-check check-icon" aria-hidden="true"></i>';
                        break;

                        case 'x_cross_icon' :
                            $mobile_label = (isset($feature_labels[$key])) ? '<span class="pricing-table-feature-mobile-label">'.$feature_labels[$key].'</span>' : '';
                            echo $mobile_label.'<i class="fa fa-times x-cross-icon" aria-hidden="true"></i>';
                        break;

                        default:
                            $mobile_label = (isset($feature_labels[$key])) ? '<span class="pricing-table-feature-mobile-label">'.$feature_labels[$key].'</span>' : '';
                            echo $mobile_label.$value;
                    }  ?>

                </div>
            <?php endforeach; ?>
        <?php endif;  ?>

        <div class="pricing-table-action">
            <?php echo $button; ?>
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

add_action('vc_before_init', 'leadinjection_pricing_table_advanced_vc');

function leadinjection_pricing_table_advanced_vc()
{
    $leadinjection_pricing_table_advanced_params = array(
        array(
            'type' => 'textfield',
            'heading' => __('Price Label Value', 'leadinjection'),
            'description' => __('Price Label Value', 'leadinjection'),
            'param_name' => 'price_label_value',
        ),
        array(
            'type' => 'exploded_textarea',
            'heading' => __('Pricing Feature Labels', 'leadinjection'),
            'description' => __('Add one feature label per line', 'leadinjection'),
            'param_name' => 'pricing_feature_labels',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Header Background Color', 'leadinjection'),
            'param_name' => 'header_background_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Header Text Color', 'leadinjection'),
            'param_name' => 'header_text_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Price Background Color', 'leadinjection'),
            'param_name' => 'price_background_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Price Text Color', 'leadinjection'),
            'param_name' => 'price_text_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Feature Background Color', 'leadinjection'),
            'param_name' => 'feature_background_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Feature Label Color', 'leadinjection'),
            'param_name' => 'feature_label_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Feature Text Color', 'leadinjection'),
            'param_name' => 'feature_text_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Action Background Color', 'leadinjection'),
            'param_name' => 'action_background_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Table Border Color', 'leadinjection'),
            'param_name' => 'table_border_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Highlight Border Color', 'leadinjection'),
            'param_name' => 'table_highlight_border_color',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_pricing_table_advanced_params = leadinjection_add_responsive_helper_params($leadinjection_pricing_table_advanced_params);

    vc_map(array(
            "name" => __("Advanced Pricing Table", "leadinjection"),
            "base" => "leadinjection_pricing_table_advanced",
            "as_parent" => array('only' => 'leadinjection_pricing_table_advanced_item'),
            "content_element" => true,
            "is_container" => true,
            "class" => '',
            "icon" => 'li-icon li-adv-pricing-table',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Pricing Table with Action', 'leadinjection'),
            "params" => $leadinjection_pricing_table_advanced_params,
            "js_view" => 'VcColumnView'
        )
    );

    vc_map(array(
            "name" => __("Advanced Pricing Table Item", "leadinjection"),
            "base" => "leadinjection_pricing_table_advanced_item",
            "icon" => 'li-icon li-adv-pricing-table',
            "content_element" => true,
            "as_child" => array('only' => 'leadinjection_pricing_table_advanced'), // Use only|except attributes to limit parent (separate multiple values with comma)
            "params" => array(
                array(
                    'type' => 'checkbox',
                    'heading' => __('Highlight', 'leadinjection'),
                    'param_name' => 'highlight',
                    'value' => array(__('Highlight this Table', 'leadinjection') => 'highlight-col'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Price Title', 'leadinjection'),
                    'param_name' => 'price_title',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Price Subtitle', 'leadinjection'),
                    'param_name' => 'price_subtitle',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Price Currency Sign', 'leadinjection'),
                    'param_name' => 'price_currency_sign',
                    'value' => '$',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Price Value', 'leadinjection'),
                    'param_name' => 'price_value',
                    'value' => '100',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Price Condition', 'leadinjection'),
                    'param_name' => 'price_condition',
                    'value' => '/mo',
                ),
                array(
                    'type' => 'exploded_textarea',
                    'heading' => __('Pricing Feature Values', 'leadinjection'),
                    'description' => __('Add one value label per line. (Available icons: check_icon, x_cross_icon)', 'leadinjection'),
                    'param_name' => 'pricing_feature_values',
                    'admin_label' => true,
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
    class WPBakeryShortCode_leadinjection_pricing_table_advanced extends WPBakeryShortCodesContainer
    {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_leadinjection_pricing_table_advanced_item extends WPBakeryShortCode
    {
    }
}