<?php

/*
    Tabs
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_tabs', 'leadinjection_tabs_shortcode');

function leadinjection_tabs_shortcode($atts, $content)
{
    if( isset( $GLOBALS['tabs_count'] ) ) {
        $GLOBALS['tabs_count']++;
    }else {
        $GLOBALS['tabs_count'] = 0;
    }
    $GLOBALS['tabs_default_count'] = 0;


    $default_atts = shortcode_atts(array(
        'tab_style' => 'li-tabs',
        'tab_border_color' => '',
        'tab_title_color' => '',
        'tab_title_hover_color' => '',
        'tab_title_active_color' => '',
        'tab_content_color' => '',
        'tab_background_color' => '',
        'tab_active_background_color' => '',
        'tab_hover_background_color' => '',
        'content' => !empty($content) ? $content : '',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    ), $atts);

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($default_atts);

    $shortcode_id = leadinjection_custom_id('tabs_', $shortcode_id);
    $wrapper_class = array($tab_style, $xclass, $responsive_helper);


    $atts_map = leadinjection_attribute_map( $content );

    if ( $atts_map ) {
        $tabs = array();
        $GLOBALS['tabs_default_active'] = true;
        foreach( $atts_map as $check ) {
            if( !empty($check["tab"]["active"]) ) {
                $GLOBALS['tabs_default_active'] = false;
            }
        }
        $i = 0;
        foreach( $atts_map as $tab ) {
            if(isset($tab['leadinjection_tabs_item'])){
                $tab_href='custom-tab-' . $GLOBALS['tabs_count'] . '-' . md5($tab["leadinjection_tabs_item"]["title"]);
                $is_active = (isset($tab['leadinjection_tabs_item']['active'])) ? 'active' : null;

                $tabs[] = ' <li role="presentation" class="'.$is_active.'"><a href="#'.$tab_href.'" role="tab" data-toggle="tab">'.$tab['leadinjection_tabs_item']['title'].'</a></li>';
                $i++;
            }
        }
    }

    // Styles
    if('li-tabs' == $tab_style){
        $style  = '';
        $style .= (!empty($tab_title_color)) ? "#$shortcode_id .nav-tabs li a { color: $tab_title_color; }" : null;
        $style .= (!empty($tab_title_hover_color)) ? "#$shortcode_id .nav-tabs li:hover a { color: $tab_title_hover_color; }" : null;
        $style .= (!empty($tab_title_active_color)) ? "#$shortcode_id .nav-tabs li.active a { color: $tab_title_active_color; }" : null;
        $style .= (!empty($tab_border_color)) ? "#$shortcode_id .nav-tabs li:before { border-bottom-color: $tab_border_color; }" : null;
        $style .= (!empty($tab_border_color)) ? "#$shortcode_id .nav-tabs li:after { border-bottom-color: $tab_border_color; }" : null;
        $style .= (!empty($tab_border_color)) ? "#$shortcode_id .nav-tabs li.active:before { border-top-color: $tab_border_color; border-left-color: $tab_border_color; }" : null;
        $style .= (!empty($tab_border_color)) ? "#$shortcode_id .nav-tabs li.active:after { border-top-color: $tab_border_color; border-right-color: $tab_border_color; }" : null;
        $style .= (!empty($tab_border_color)) ? "#$shortcode_id .tab-content { border-color: $tab_border_color; }" : null;
        $style .= (!empty($tab_border_color)) ? "#$shortcode_id .nav-tabs li.active a { border-color: $tab_border_color; }" : null;
        $style .= (!empty($tab_background_color)) ? "#$shortcode_id .nav-tabs li:before { background-color: $tab_background_color; }" : null;
        $style .= (!empty($tab_background_color)) ? "#$shortcode_id .nav-tabs li:after { background-color: $tab_background_color; }" : null;
        $style .= (!empty($tab_active_background_color)) ? "#$shortcode_id .tab-content { background-color: $tab_active_background_color; }" : null;
        $style .= (!empty($tab_content_color)) ? "#$shortcode_id .tab-content { color: $tab_content_color; }" : null;
        $style .= (!empty($tab_active_background_color)) ? "#$shortcode_id .nav-tabs li.active:before { background-color: $tab_active_background_color; }" : null;
        $style .= (!empty($tab_active_background_color)) ? "#$shortcode_id .nav-tabs li.active:after { background-color: $tab_active_background_color; }" : null;
        $style .= (!empty($tab_hover_background_color)) ? "#$shortcode_id .nav-tabs li:not([class='active']):hover:before { background-color: $tab_hover_background_color; }" : null;
        $style .= (!empty($tab_hover_background_color)) ? "#$shortcode_id .nav-tabs li:not([class='active']):hover:after { background-color: $tab_hover_background_color; }" : null;

        $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;
    }

    if('li-tabs-minimal' == $tab_style){
        $style  = '';
        $style .= (!empty($tab_title_color)) ? "#$shortcode_id .nav-tabs li a { color: $tab_title_color; }" : null;
        $style .= (!empty($tab_title_hover_color)) ? "#$shortcode_id .nav-tabs li:hover a { color: $tab_title_hover_color; }" : null;
        $style .= (!empty($tab_title_active_color)) ? "#$shortcode_id .nav-tabs li.active a { color: $tab_title_active_color; }" : null;
        $style .= (!empty($tab_border_color)) ? "#$shortcode_id .nav-tabs { border-color: $tab_border_color; }" : null;
        $style .= (!empty($tab_border_color)) ? "#$shortcode_id .nav-tabs li a { border-color: $tab_border_color; }" : null;
        $style .= (!empty($tab_content_color)) ? "#$shortcode_id .tab-content { color: $tab_content_color; }" : null;
        $style .= (!empty($tab_active_background_color)) ? "#$shortcode_id  .nav-tabs li.active a { border-color: $tab_active_background_color; }" : null;
        $style .= (!empty($tab_hover_background_color)) ? "#$shortcode_id .nav-tabs li a:hover { background-color: $tab_hover_background_color; }" : null;

        $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;
    }

    if('li-tabs-vertical' == $tab_style){
        $style  = '';
        $style .= (!empty($tab_title_color)) ? "#$shortcode_id .nav-tabs li a { color: $tab_title_color; }" : null;
        $style .= (!empty($tab_title_hover_color)) ? "#$shortcode_id .nav-tabs li:hover a { color: $tab_title_hover_color; }" : null;
        $style .= (!empty($tab_title_active_color)) ? "#$shortcode_id .nav-tabs li.active a { color: $tab_title_active_color; }" : null;
        $style .= (!empty($tab_border_color)) ? "#$shortcode_id .nav-tabs li.active a { border-color: $tab_border_color; }" : null;
        $style .= (!empty($tab_border_color)) ? "#$shortcode_id .tab-content { border-color: $tab_border_color; }" : null;
        $style .= (!empty($tab_background_color)) ? "#$shortcode_id .nav-tabs li a { background-color: $tab_background_color; }" : null;
        $style .= (!empty($tab_active_background_color)) ? "#$shortcode_id  .nav-tabs li.active a { background-color: $tab_active_background_color; }" : null;
        $style .= (!empty($tab_active_background_color)) ? "#$shortcode_id  .nav-tabs li.active a:hover { background-color: $tab_active_background_color; }" : null;
        $style .= (!empty($tab_active_background_color)) ? "#$shortcode_id  .tab-content { background-color: $tab_active_background_color; }" : null;
        $style .= (!empty($tab_content_color)) ? "#$shortcode_id .tab-content { color: $tab_content_color; }" : null;
        $style .= (!empty($tab_hover_background_color)) ? "#$shortcode_id .nav-tabs li a:hover { background-color: $tab_hover_background_color; }" : null;

        $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;
    }

    if('li-tabs-minimal-vertical' == $tab_style){
        $style  = '';
        $style .= (!empty($tab_title_color)) ? "#$shortcode_id .nav-tabs li a { color: $tab_title_color; }" : null;
        $style .= (!empty($tab_title_hover_color)) ? "#$shortcode_id .nav-tabs li:hover a { color: $tab_title_hover_color; }" : null;
        $style .= (!empty($tab_title_active_color)) ? "#$shortcode_id .nav-tabs li.active a { color: $tab_title_active_color; }" : null;
        $style .= (!empty($tab_border_color)) ? "#$shortcode_id .tab-content { border-color: $tab_border_color; }" : null;
        $style .= (!empty($tab_border_color)) ? "#$shortcode_id .nav-tabs li a { border-bottom-color: $tab_border_color; }" : null;
        $style .= (!empty($tab_content_color)) ? "#$shortcode_id .tab-content { color: $tab_content_color; }" : null;
        $style .= (!empty($tab_active_background_color)) ? "#$shortcode_id  .nav-tabs li.active a { border-bottom-color: $tab_active_background_color; }" : null;
        $style .= (!empty($tab_hover_background_color)) ? "#$shortcode_id .nav-tabs li a:hover { background-color: $tab_hover_background_color; }" : null;

        $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;
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

    <?php echo $output_style; ?>

    <?php if('li-tabs' == $tab_style || 'li-tabs-minimal' == $tab_style) :?>
    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>>
        <ul class="nav nav-tabs" role="tablist">
            <?php echo ($tabs) ? implode( $tabs ) : ''; ?>
        </ul>
        <div class="tab-content">
            <?php echo do_shortcode($content) ?>
        </div>
    </div>
    <?php else: ?>
    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect; ?>>
        <div class="row">
            <div class="col-xs-3">
                <ul class="nav nav-tabs" role="tablist">
                    <?php echo ($tabs) ? implode( $tabs ) : ''; ?>
                </ul>
            </div>
            <div class="col-xs-9">
                <div class="tab-content">
                    <?php echo do_shortcode($content) ?>
                </div>
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
    Image Review Slider Item
*/

add_shortcode('leadinjection_tabs_item', 'leadinjection_tabs_shortcode_item');

function leadinjection_tabs_shortcode_item($atts, $content)
{

    $default_atts = shortcode_atts(array(
        'title' => '',
        'content' => !empty($content) ? $content : '',
        'active' => '',
    ), $atts);

    if( $GLOBALS['tabs_default_active'] && $GLOBALS['tabs_default_count'] == 0 ) {
        $atts['active'] = true;
    }
    $GLOBALS['tabs_default_count']++;

    $id = 'custom-tab-'. $GLOBALS['tabs_count'] . '-'. md5( $atts['title'] );

    extract($default_atts);

    $is_active = ('' !== $active) ? 'active' : 'fade';

    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>


    <div role="tabpanel" class="tab-pane <?php echo $is_active; ?>" id="<?php echo $id; ?>">
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
    Visual Composer Registration
*/

add_action('vc_before_init', 'leadinjection_tabs_vc');

function leadinjection_tabs_vc()
{

    $leadinjection_tabs_params = array(
        array(
            'type' => 'dropdown',
            'heading' => __('Tab style ', 'leadinjection'),
            'param_name' => 'tab_style',
            'value' => array(
                __('Horizontal Default', 'leadinjection') => 'li-tabs',
                __('Horizontal Minimal', 'leadinjection') => 'li-tabs-minimal',
                __('Vertical Default', 'leadinjection') => 'li-tabs-vertical',
                __('Vertical Minimal', 'leadinjection') => 'li-tabs-minimal-vertical',
            ),
            'std' => 'li-tabs',
            'admin_label' => true,
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Tabs border color', 'leadinjection'),
            'param_name' => 'tab_border_color',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Tabs background color', 'leadinjection'),
            'param_name' => 'tab_background_color',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Tabs title color', 'leadinjection'),
            'param_name' => 'tab_title_color',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Tabs title color (hover)', 'leadinjection'),
            'param_name' => 'tab_title_hover_color',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Tabs title color (active)', 'leadinjection'),
            'param_name' => 'tab_title_active_color',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Tabs content color', 'leadinjection'),
            'param_name' => 'tab_content_color',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Active tab background color', 'leadinjection'),
            'param_name' => 'tab_active_background_color',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Hover tab background color', 'leadinjection'),
            'param_name' => 'tab_hover_background_color',
            'edit_field_class' => 'vc_col-sm-6'
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),
    );

    $leadinjection_tabs_params = leadinjection_add_responsive_helper_params($leadinjection_tabs_params);

    vc_map(array(
            "name" => __("Tabs", "leadinjection"),
            "base" => "leadinjection_tabs",
            "as_parent" => array('only' => 'leadinjection_tabs_item'),
            "content_element" => true,
            "show_settings_on_create" => true,
            "is_container" => true,
            "class" => '',
            "icon" => 'li-icon li-tabs',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Create tabbed content', 'leadinjection'),
            "params" => $leadinjection_tabs_params,
            "js_view" => 'VcColumnView'
        )
    );

    vc_map(array(
            "name" => __("Tabs Item", "leadinjection"),
            "base" => "leadinjection_tabs_item",
            "icon" => 'li-icon li-tabs',
            "content_element" => true,
            "as_child" => array('only' => 'leadinjection_tabs'),
            "params" => array(
                array(
                    'type' => 'textfield',
                    'heading' => __('Enter a tab name.', 'leadinjection'),
                    'param_name' => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textarea_html',
                    'heading' => __('Enter a tab content.', 'leadinjection'),
                    'param_name' => 'content',
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'active',
                    'value' => array(__('Make this tab active.', 'leadinjection') => 'active'),
                ),
            )
        )
    );
}


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_leadinjection_tabs extends WPBakeryShortCodesContainer
    {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_leadinjection_tabs_item extends WPBakeryShortCode
    {
    }
}