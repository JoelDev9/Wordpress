<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Add Responsive Helper Params
 */
function leadinjection_add_responsive_helper_params($params)
{
    $params[] = array(
        'type' => 'dropdown',
        'heading' => __('<span class="fa fa-fw fa-desktop"></span> Element Options for Large Devices', 'leadinjection'),
        'param_name' => 'align_lg',
        'value' => array(
            __('Select Content alignment on Large Devices', 'leadinjection') => '',
            __('Align Left on Large Devices', 'leadinjection') => 'content-left-lg',
            __('Align Center on Large Devices', 'leadinjection') => 'content-center-lg',
            __('Align Right on Large Devices', 'leadinjection') => 'content-right-lg',
        ),
        'group' => 'Responsive Helpers',
    );

    $params[] = array(
        'type' => 'dropdown',
        'param_name' => 'float_lg',
        'value' => array(
            __('Select Element floating on Large Devices', 'leadinjection') => '',
            __('Float Left on Large Devices', 'leadinjection') => 'pull-left-lg',
            __('Float Right on Large Devices', 'leadinjection') => 'pull-right-lg',
        ),
        'group' => 'Responsive Helpers',
    );

    /*
     * Start Medium Devices
     */
    $params[] = array(
        'type' => 'dropdown',
        'heading' => __('<span class="fa fa-fw fa-laptop" aria-hidden="true"></span> Element Options for Medium Devices', 'leadinjection'),
        'param_name' => 'align_md',
        'value' => array(
            __('Select Content alignment on Medium Devices', 'leadinjection') => '',
            __('Align Left on Medium Devices', 'leadinjection') => 'content-left-md',
            __('Align Center on Medium Devices', 'leadinjection') => 'content-center-md',
            __('Align Right on Medium Devices', 'leadinjection') => 'content-right-md',
        ),
        'group' => 'Responsive Helpers',
    );

    $params[] = array(
        'type' => 'dropdown',
        'param_name' => 'float_md',
        'value' => array(
            __('Select Element floating on Medium Devices', 'leadinjection') => '',
            __('Float Left on Medium Devices', 'leadinjection') => 'pull-left-md',
            __('Float Right on Medium Devices', 'leadinjection') => 'pull-right-md',
        ),
        'group' => 'Responsive Helpers',
    );

    /*
     * Start Small Devices
     */
    $params[] = array(
        'type' => 'dropdown',
        'heading' => __('<span class="fa fa-fw fa-tablet" aria-hidden="true"></span> Element Options for Small Devices', 'leadinjection'),
        'param_name' => 'align_sm',
        'value' => array(
            __('Select Content alignment on Small Devices', 'leadinjection') => '',
            __('Align Left on Small Devices', 'leadinjection') => 'content-left-sm',
            __('Align Center on Small Devices', 'leadinjection') => 'content-center-sm',
            __('Align Right on Small Devices', 'leadinjection') => 'content-right-sm',
        ),
        'group' => 'Responsive Helpers',
    );

    $params[] = array(
        'type' => 'dropdown',
        'param_name' => 'float_sm',
        'value' => array(
            __('Select Element floating on Small Devices', 'leadinjection') => '',
            __('Float Left on Small Devices', 'leadinjection') => 'pull-left-sm',
            __('Float Right on Small Devices', 'leadinjection') => 'pull-right-sm',
        ),
        'group' => 'Responsive Helpers',
    );

    /*
     * Start Extra Small Devices
     */
    $params[] = array(
        'type' => 'dropdown',
        'heading' => __('<span class="fa fa-fw fa-mobile-phone" aria-hidden="true"></span> Element Options for Extra Small Devices', 'leadinjection'),
        'param_name' => 'align_xs',
        'value' => array(
            __('Select Content alignment on Extra Small Devices', 'leadinjection') => '',
            __('Align Left on Extra Small Devices', 'leadinjection') => 'content-left-xs',
            __('Align Center on Extra Small Devices', 'leadinjection') => 'content-center-xs',
            __('Align Right on Extra Small Devices', 'leadinjection') => 'content-right-xs',
        ),
        'group' => 'Responsive Helpers',
    );

    $params[] = array(
        'type' => 'dropdown',
        'param_name' => 'float_xs',
        'value' => array(
            __('Select Element floating on Extra Small Devices', 'leadinjection') => '',
            __('Float Left on Extra Small Devices', 'leadinjection') => 'pull-left-xs',
            __('Float Right on Extra Small Devices', 'leadinjection') => 'pull-right-xs',
        ),
        'group' => 'Responsive Helpers',
    );

    // Column Animation
    //vc_add_param('vc_column', $params[0]);

    return $params;
}

/**
 * Add Responsive Helper Atts
 */
function leadinection_add_responsive_helper_atts($default_atts){

    $default_atts['align_lg'] = '';
    $default_atts['align_md'] = '';
    $default_atts['align_sm'] = '';
    $default_atts['align_xs'] = '';
    $default_atts['float_lg'] = '';
    $default_atts['float_md'] = '';
    $default_atts['float_sm'] = '';
    $default_atts['float_xs'] = '';

    return $default_atts;
}

/**
 * Create Responsive Helper Classes
 */
function leadinjection_create_responsive_helper_classes($default_atts){

    $responsive_helper  = $default_atts['align_lg'].' ';
    $responsive_helper .= $default_atts['align_md'].' ';
    $responsive_helper .= $default_atts['align_sm'].' ';
    $responsive_helper .= $default_atts['align_xs'].' ';
    $responsive_helper .= $default_atts['float_lg'].' ';
    $responsive_helper .= $default_atts['float_md'].' ';
    $responsive_helper .= $default_atts['float_sm'].' ';
    $responsive_helper .= $default_atts['float_xs'];

    return $responsive_helper;

}

/**
 * Add Responsive Helper to VC Column
 */
if (defined('WPB_VC_VERSION')) {
    $params = leadinjection_add_responsive_helper_params(array());
    foreach ($params as $param) {
        vc_add_param('vc_column', $param);
    }
}

