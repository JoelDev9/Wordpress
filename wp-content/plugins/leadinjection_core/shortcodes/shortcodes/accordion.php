<?php

/*
    Accordion
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_accordion', 'leadinjection_accordion_shortcode');

function leadinjection_accordion_shortcode($atts, $content)
{
    $default_atts = array(
        'content' => !empty($content) ? $content : '',
        'accordion_style' => 'li-accordion-bullets',
        'item_icon_color' => '',
        'item_icon_background_color' => '',
        'item_title_color' => '',
        'item_title_background_color' => '',
        'item_active_title_background_color' => '',
        'item_content_color' => '',
        'item_content_background_color' => '',
        'item_border_color' => '',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );
  
    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('accordion_', $shortcode_id);
    $GLOBALS['accordion_id'] = $shortcode_id;
    $GLOBALS['accordion_style'] = $accordion_style;

    $wrapper_class = array('panel-group', $accordion_style, $xclass, $responsive_helper);

    // Styles
    if('li-accordion-plus-minus' == $accordion_style || 'li-accordion-plus-minus-cornered' == $accordion_style || 'li-accordion-plus-minus-round' == $accordion_style){
        // Add extra wrapper class for plus-minus toggle
        $wrapper_class[] = 'li-plus-minus-toogle';

        $style  = '';
        $style .= (!empty($item_icon_color)) ? "#$shortcode_id .panel-title-link-toggle { color: $item_icon_color; }" : null;
        $style .= (!empty($item_icon_background_color)) ? "#$shortcode_id .panel-title-link-toggle { background-color: $item_icon_background_color; }" : null;

        $style .= (!empty($item_title_color)) ? "#$shortcode_id .panel-title a { color: $item_title_color; }" : null;
        $style .= (!empty($item_title_background_color)) ? "#$shortcode_id .panel-heading { background-color: $item_title_background_color; }" : null;
        $style .= (!empty($item_active_title_background_color)) ? "#$shortcode_id .panel-heading_active { background-color: $item_active_title_background_color; }" : null;

        $style .= (!empty($item_content_color)) ? "#$shortcode_id .panel-body { color: $item_content_color; }" : null;
        $style .= (!empty($item_content_background_color)) ? "#$shortcode_id .panel-body { background-color: $item_content_background_color; }" : null;

        $style .= (!empty($item_border_color)) ? "#$shortcode_id .panel, #$shortcode_id .panel-collapse, #$shortcode_id .panel-heading { border-color: $item_border_color; }" : null;

        $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;
    }

    if('li-accordion-bullets' == $accordion_style || 'li-accordion-bullets-cornered' == $accordion_style || 'li-accordion-bullets-round' == $accordion_style){
        // Add extra wrapper class for plus-minus toggle
        $wrapper_class[] = 'li-bullets-toogle';

        $style  = '';
        $style .= (!empty($item_icon_color)) ? "#$shortcode_id .panel-title-link-toggle { color: $item_icon_color; }" : null;
        $style .= (!empty($item_icon_background_color)) ? "#$shortcode_id .panel-title-link-toggle { background-color: $item_icon_background_color; }" : null;

        $style .= (!empty($item_title_color)) ? "#$shortcode_id .panel-title a { color: $item_title_color; }" : null;
        $style .= (!empty($item_title_background_color)) ? "#$shortcode_id .panel-heading { background-color: $item_title_background_color; }" : null;
        $style .= (!empty($item_active_title_background_color)) ? "#$shortcode_id .panel-heading_active { background-color: $item_active_title_background_color; }" : null;

        $style .= (!empty($item_content_color)) ? "#$shortcode_id .panel-body { color: $item_content_color; }" : null;
        $style .= (!empty($item_content_background_color)) ? "#$shortcode_id .panel-body { background-color: $item_content_background_color; }" : null;

        $style .= (!empty($item_border_color)) ? "#$shortcode_id .panel, #$shortcode_id .panel-collapse, #$shortcode_id .panel-heading { border-color: $item_border_color; }" : null;

        $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;
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

    <?php echo $output_style; ?>
    <div class="<?php echo esc_attr($wrapper_class); ?>" id="<?php echo esc_attr($shortcode_id); ?>" <?php echo $data_effect; ?> role="tablist" aria-multiselectable="true">
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

add_shortcode('leadinjection_accordion_item', 'leadinjection_accordion_shortcode_item');

function leadinjection_accordion_shortcode_item($atts, $content)
{
    if( isset($GLOBALS['collapse_count']) ) {
        $GLOBALS['collapse_count']++;
    }else{
        $GLOBALS['collapse_count'] = 0;
    }
    $collapse_id = $GLOBALS['collapse_count'];
    $shortcode_id = $GLOBALS['accordion_id'];
    $accourdion_style = $GLOBALS['accordion_style'];

    $defaults = shortcode_atts(array(
        'item_color' => '',
        'title' => '',
        'content' => !empty($content) ? $content : '',
        'open' => '',
        'xclass' => '',
    ), $atts);

    extract($defaults);

    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>

    <?php // Accordion Bullets Style ?>
    <?php if('li-accordion-bullets' == $accourdion_style || 'li-accordion-bullets-cornered' == $accourdion_style || 'li-accordion-bullets-round' == $accourdion_style) :?>
    <div class="panel <?php echo esc_attr($xclass); ?>">
        <div class="panel-heading <?php echo ('in' === $open) ? 'panel-heading_active' : ''; ?>" role="tab" id="heading-<?php echo esc_attr($collapse_id); ?>">
            <h4 class="panel-title">
                <a class="panel-title-link" role="button" data-toggle="collapse" data-parent="#<?php echo esc_attr($shortcode_id); ?>" href="#collapse-<?php echo esc_attr($collapse_id); ?>" aria-expanded="true" aria-controls="collapse-<?php echo esc_attr($collapse_id); ?>">
                    <?php echo esc_html($title); ?>
                    <?php if('in' === $open) : ?>
                        <i class="panel-title-link-toggle fa fa-dot-circle-o"></i>
                    <?php else : ?>
                            <i class="panel-title-link-toggle fa fa-circle-o"></i>
                    <?php endif; ?>
                </a>
            </h4>
        </div>
        <div id="collapse-<?php echo esc_attr($collapse_id); ?>" class="panel-collapse collapse <?php echo esc_attr($open); ?>" role="tabpanel" aria-labelledby="heading-<?php echo esc_attr($collapse_id); ?>">
            <div class="panel-body">
                <?php echo do_shortcode($content); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php // Accordion Plus/Minus Style ?>
    <?php if('li-accordion-plus-minus' == $accourdion_style || 'li-accordion-plus-minus-cornered' == $accourdion_style || 'li-accordion-plus-minus-round' == $accourdion_style) :?>
    <div class="panel panel-plus-minus <?php echo esc_attr($xclass); ?>">
        <div class="panel-heading <?php echo ('in' === $open) ? 'panel-heading_active' : ''; ?>" role="tab" id="heading-<?php echo esc_attr($collapse_id); ?>">
            <h4 class="panel-title">
                <a class="panel-title-link" role="button" data-toggle="collapse" data-parent="#<?php echo esc_attr($shortcode_id); ?>" href="#collapse-<?php echo esc_attr($collapse_id); ?>" aria-expanded="true" aria-controls="collapse-<?php echo esc_attr($collapse_id); ?>">
                    <?php if('in' === $open) : ?>
                        <span class="panel-title-link-toggle panel-title-link-toggle_collapse">-</span>
                    <?php else : ?>
                        <span class="panel-title-link-toggle">+</span>
                    <?php endif; ?>
                    <?php echo esc_html($title); ?>
                </a>
            </h4>
        </div>
        <div id="collapse-<?php echo esc_attr($collapse_id); ?>" class="panel-collapse collapse <?php echo esc_attr($open); ?>" role="tabpanel" aria-labelledby="heading-<?php echo esc_attr($collapse_id); ?>">
            <div class="panel-body panel-body">
                <?php echo do_shortcode($content); ?>
            </div>
        </div>
    </div>
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

add_action('vc_before_init', 'leadinjection_accordion_vc');

function leadinjection_accordion_vc()
{

    $leadinjection_accordion_params = array(
        array(
            'type' => 'dropdown',
            'heading' => __('Select a accordion style', 'leadinjection'),
            'param_name' => 'accordion_style',
            'value' => array(
                __('bullets', 'leadinjection') => 'li-accordion-bullets',
                __('bullets cornered', 'leadinjection') => 'li-accordion-bullets-cornered',
                __('bullets round', 'leadinjection') => 'li-accordion-bullets-round',
                __('plus/minus', 'leadinjection') => 'li-accordion-plus-minus',
                __('plus/minus cornered', 'leadinjection') => 'li-accordion-plus-minus-cornered',
                __('plus/minus round', 'leadinjection') => 'li-accordion-plus-minus-round',
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Item icon color', 'leadinjection'),
            'param_name' => 'item_icon_color',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Item icon background color', 'leadinjection'),
            'param_name' => 'item_icon_background_color',
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element' => 'accordion_style',
                'value' => array('li-accordion-plus-minus', 'li-accordion-plus-minus-cornered', 'li-accordion-plus-minus-round'),
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Item title color', 'leadinjection'),
            'param_name' => 'item_title_color',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Item title background color', 'leadinjection'),
            'param_name' => 'item_title_background_color',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Active Item title background color', 'leadinjection'),
            'param_name' => 'item_active_title_background_color',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Item content color.', 'leadinjection'),
            'param_name' => 'item_content_color',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Item content background color', 'leadinjection'),
            'param_name' => 'item_content_background_color',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Item border color', 'leadinjection'),
            'param_name' => 'item_border_color',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_accordion_params = leadinjection_add_responsive_helper_params($leadinjection_accordion_params);

    vc_map(array(
            "name" => __("Accordion", "leadinjection"),
            "base" => "leadinjection_accordion",
            "as_parent" => array('only' => 'leadinjection_accordion_item'),
            "content_element" => true,
            "show_settings_on_create" => true,
            "is_container" => true,
            "class" => '',
            "icon" => 'li-icon li-accordion',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Collapsible content panels', 'leadinjection'),
            "params" => $leadinjection_accordion_params,
            "js_view" => 'VcColumnView'
        )
    );

    vc_map(array(
            "name" => __("Accordion Item", "leadinjection"),
            "base" => "leadinjection_accordion_item",
            "icon" => 'li-icon li-accordion',
            "content_element" => true,
            "as_child" => array('only' => 'leadinjection_accordion'),
            "params" => array(
                array(
                    'type' => 'textfield',
                    'heading' => __('Enter a collapse title', 'leadinjection'),
                    'param_name' => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textarea_html',
                    'heading' => __('Enter a collapse content', 'leadinjection'),
                    'param_name' => 'content',
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'open',
                    'value' => array(__('Display this collapse open', 'leadinjection') => 'in'),
                ),
                leadinjection_xclass_field(),
            )
        )
    );
}


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_leadinjection_accordion extends WPBakeryShortCodesContainer
    {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_leadinjection_accordion_item extends WPBakeryShortCode
    {
    }
}