<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$post_id = $post_title = '';
global $pagenow;
if ( is_admin() && $pagenow == "post.php" && isset( $_GET['post'] ) ) {
    $post_id = $_GET['post'];
    $post_title = get_the_title($post_id);
}

return array(
    /**
     * Modal Options
     */
    array(
        'title' => __('Modal Options', 'leadinjection'),
        'icon' => 'el el-cog', // Only used with metabox position normal or advanced
        'fields' => array(
            array(
                'id'       => 'li-modal-width',
                'type'     => 'dimensions',
                'units'    => array('px','%'),
                'height'   => false,
                'title'    => __('Modal Width', 'leadinjection'),
                'subtitle' => __('Select modal width', 'leadinjection'),
                'description' => __('Set to 100% for full screen.', 'leadinjection'),
            ),
            array(
                'id'       => 'li-modal-height',
                'type'     => 'dimensions',
                'units'    => array('px','%'),
                'width'   => false,
                'title'    => __('Modal Height', 'leadinjection'),
                'subtitle' => __('Select modal height', 'leadinjection'),
                'description' => __('Set to 100% for full screen. Leave empty for dynamic height.', 'leadinjection'),
            ),
            array(
                'id' => 'li-modal-position',
                'type' => 'select',
                'title' => __('Modal Position', 'leadinjection'),
                'subtitle' => __('Select a modal position', 'leadinjection'),
                'description' => __('Default = Center/ Top', 'leadinjection'),
                'options' => array(
                    '' => __('Default', 'leadinjection'),
                    'top_left' => __('Top / Left', 'leadinjection'),
                    'top_right' => __('Top / Right', 'leadinjection'),
                    'bottom_left' => __('Bottom / Left', 'leadinjection'),
                    'bottom_right' => __('Bottom / Right', 'leadinjection'),
                ),
                'default' => '',
            ),
            array(
                'id'             => 'li-modal-spacing',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'units'          => array('%', 'px'),
                'title'          => __('Modal Spacing', 'leadinjection'),
                'subtitle'       => __('Add a modal spacing', 'leadinjection'),
            ),
            array(
                'id' => 'li-modal-background',
                'type' => 'color',
                'title' => __('Modal Color/Image', 'leadinjection'),
                'subtitle' => __('Select a background color or an image for the modal', 'leadinjection'),
            ),
            array(
                'id'       => 'li-modal-border',
                'type'     => 'border',
                'all'      => false,
                'title'    => __('Modal Border', 'redux-framework-demo'),
                'subtitle' => __('Select a modal border', 'redux-framework-demo'),
                'default'  => array(
                    'border-color'  => '#ffffff',
                    'border-style'  => 'solid',
                    'border-top'    => '',
                    'border-right'  => '',
                    'border-bottom' => '',
                    'border-left'   => ''
                )
            ),
            array(
                'id' => 'li-modal-shadow',
                'type' => 'switch',
                'title' => __('Modal Shadow', 'leadinjection'),
                'subtitle' => __('Disable the modal shadow', 'leadinjection'),
                'default' => false,
            ),
            array(
                'id' => 'li-modal-close-button-color',
                'type'     => 'link_color',
                'regular'  => true,
                'hover'    => true,
                'visited'  => false,
                'active'   => false,
                'title'    => __('Close Button Color', 'leadinjection'),
                'subtitle' => __('Select a close button color.', 'leadinjection'),
                'validate' => 'color',
            ),
            array(
                'id' => 'li-modal-backdrop',
                'type'     => 'switch',
                'title'    => __('Disable Backdrop', 'leadinjection'),
                'subtitle' => __("Disable modal backdrop", 'leadinjection'),
                'default' => false,
            ),
            array(
                'id' => 'li-modal-backdrop-color',
                'type'     => 'color',
                'title'    => __('Backdrop Color', 'leadinjection'),
                'subtitle' => __('Select a backdrop color.', 'leadinjection'),
                'validate' => 'color',
                'required' => array('li-modal-backdrop','equals',false),
            ),
            array(
                'id' => 'li-modal-backdrop-close',
                'type'     => 'switch',
                'title'    => __('Backdrop Close', 'leadinjection'),
                'subtitle' => __("Disable close the modal on click.", 'leadinjection'),
                'default' => false,
                'required' => array('li-modal-backdrop','equals',false),
            ),
            array(
                'id' => 'li-modal-scrolling',
                'type'     => 'switch',
                'title'    => __('Modal Scrolling', 'leadinjection'),
                'subtitle' => __("Enable scrolling if the modal is visible ", 'leadinjection'),
                'default' => false,
            ),
            array(
                'id' => 'li-modal-entrances',
                'type' => 'select',
                'title' => __('Modal Entrance Animation', 'leadinjection'),
                'subtitle' => __('Select a modal entrance animation', 'leadinjection'),
                'options' => array(
                    'bounce' => __('bounce', 'leadinjection'),
                    'flash' => __('flash', 'leadinjection'),
                    'pulse' => __('pulse', 'leadinjection'),
                    'rubberBand' => __('rubberBand', 'leadinjection'),
                    'shake' => __('shake', 'leadinjection'),
                    'swing' => __('swing', 'leadinjection'),
                    'tada' => __('tada', 'leadinjection'),
                    'wobble' => __('wobble', 'leadinjection'),
                    'jello' => __('jello', 'leadinjection'),

                    'bounceIn' => __('bounceIn', 'leadinjection'),
                    'bounceInDown' => __('bounceInDown', 'leadinjection'),
                    'bounceInLeft' => __('bounceInLeft', 'leadinjection'),
                    'bounceInRight' => __('bounceInRight', 'leadinjection'),
                    'bounceInUp' => __('bounceInUp', 'leadinjection'),

                    'fadeIn' => __('fadeIn', 'leadinjection'),
                    'fadeInDown' => __('fadeInDown', 'leadinjection'),
                    'fadeInDownBig' => __('fadeInDownBig', 'leadinjection'),
                    'fadeInLeft' => __('fadeInLeft', 'leadinjection'),
                    'fadeInLeftBig' => __('fadeInLeftBig', 'leadinjection'),
                    'fadeInRight' => __('fadeInRight', 'leadinjection'),
                    'fadeInRightBig' => __('fadeInRightBig', 'leadinjection'),
                    'fadeInUp' => __('fadeInUp', 'leadinjection'),
                    'fadeInUpBig' => __('fadeInUpBig', 'leadinjection'),

                    'flipInX' => __('flipInX', 'leadinjection'),
                    'flipInY' => __('flipInY', 'leadinjection'),

                    'lightSpeedIn' => __('lightSpeedIn', 'leadinjection'),

                    'rotateIn' => __('rotateIn', 'leadinjection'),
                    'rotateInDownLeft' => __('rotateInDownLeft', 'leadinjection'),
                    'rotateInDownRight' => __('rotateInDownRight', 'leadinjection'),
                    'rotateInUpLeft' => __('rotateInUpLeft', 'leadinjection'),
                    'rotateInUpRight' => __('rotateInUpRight', 'leadinjection'),

                    'slideInUp' => __('slideInUp', 'leadinjection'),
                    'slideInDown' => __('slideInDown', 'leadinjection'),
                    'slideInLeft' => __('slideInLeft', 'leadinjection'),
                    'slideInRight' => __('slideInRight', 'leadinjection'),

                    'zoomIn' => __('zoomIn', 'leadinjection'),
                    'zoomInDown' => __('zoomInDown', 'leadinjection'),
                    'zoomInLeft' => __('zoomInLeft', 'leadinjection'),
                    'zoomInRight' => __('zoomInRight', 'leadinjection'),
                    'zoomInUp' => __('zoomInUp', 'leadinjection'),

                    'rollIn' => __('rollIn', 'leadinjection'),
                ),
                'default' => 'fadeInDown',
            ),
            array(
                'id' => 'li-modal-exits',
                'type' => 'select',
                'title' => __('Modal Exit Animation', 'leadinjection'),
                'subtitle' => __('Select a modal exit animation', 'leadinjection'),
                'options' => array(
                    'bounce' => __('bounce', 'leadinjection'),
                    'flash' => __('flash', 'leadinjection'),
                    'pulse' => __('pulse', 'leadinjection'),
                    'rubberBand' => __('rubberBand', 'leadinjection'),
                    'shake' => __('shake', 'leadinjection'),
                    'swing' => __('swing', 'leadinjection'),
                    'tada' => __('tada', 'leadinjection'),
                    'wobble' => __('wobble', 'leadinjection'),
                    'jello' => __('jello', 'leadinjection'),

                    'bounceOut' => __('bounceOut', 'leadinjection'),
                    'bounceOutDown' => __('bounceOutDown', 'leadinjection'),
                    'bounceOutLeft' => __('bounceOutLeft', 'leadinjection'),
                    'bounceOutRight' => __('bounceOutRight', 'leadinjection'),
                    'bounceInUp' => __('bounceInUp', 'leadinjection'),

                    'fadeOut' => __('fadeOut', 'leadinjection'),
                    'fadeOutDown' => __('fadeOutDown', 'leadinjection'),
                    'fadeOutDownBig' => __('fadeOutDownBig', 'leadinjection'),
                    'fadeOutLeft' => __('fadeOutLeft', 'leadinjection'),
                    'fadeOutLeftBig' => __('fadeOutLeftBig', 'leadinjection'),
                    'fadeOutRight' => __('fadeOutRight', 'leadinjection'),
                    'fadeOutRightBig' => __('fadeOutRightBig', 'leadinjection'),
                    'fadeOutUp' => __('fadeOutUp', 'leadinjection'),
                    'fadeOutUpBig' => __('fadeOutUpBig', 'leadinjection'),

                    'flipOutX' => __('flipOutX', 'leadinjection'),
                    'flipOutY' => __('flipOutY', 'leadinjection'),

                    'lightSpeedOut' => __('lightSpeedOut', 'leadinjection'),

                    'rotateOut' => __('rotateOut', 'leadinjection'),
                    'rotateOutDownLeft' => __('rotateOutDownLeft', 'leadinjection'),
                    'rotateOutDownRight' => __('rotateOutDownRight', 'leadinjection'),
                    'rotateOutUpLeft' => __('rotateOutUpLeft', 'leadinjection'),
                    'rotateOutUpRight' => __('rotateOutUpRight', 'leadinjection'),

                    'slideOutUp' => __('slideOutUp', 'leadinjection'),
                    'slideOutDown' => __('slideOutDown', 'leadinjection'),
                    'slideOutLeft' => __('slideOutLeft', 'leadinjection'),
                    'slideOutRight' => __('slideOutRight', 'leadinjection'),

                    'zoomOut' => __('zoomOut', 'leadinjection'),
                    'zoomOutDown' => __('zoomOutDown', 'leadinjection'),
                    'zoomOutLeft' => __('zoomOutLeft', 'leadinjection'),
                    'zoomOutRight' => __('zoomOutRight', 'leadinjection'),
                    'zoomOutUp' => __('zoomOutUp', 'leadinjection'),

                    'rollOut' => __('rollOut', 'leadinjection'),
                ),
                'default' => 'fadeOutUp',
            ),
        ),
    ),


    /**
     * Modal Options
     */
        array(
            'title' => __('Modal Link Shortcode', 'leadinjection'),
                'id' => 'modal-info',
                'desc' => __('Copying and pasting this code into the WordPress post editor will display a link that launch this modal.', 'leadinjection'),
                'icon' => 'el el-adjust-alt',
                'fields' => array(
                    array(
                        'id'=>'li-modal-link-shortcode',
                        'type'  => 'info',
                        'style' => 'success',
                        'title' => '[leadinjection_modal modal_id="'.$post_id.';'.get_the_title($post_id).'"]Enter a Link Text[/leadinjection_modal]',
                    ),
                )
        ),


);