<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

return array(

    /**
     * Default Options
     */
    array(
        'title' => __('Post Options', 'leadinjection'),
        'id' => 'post-options',
        'desc' => __('Post Options for leadinjection', 'leadinjection'),
        'icon' => 'el el-cogs',
        'fields' => array(
            array(
                'id' => 'li-post-gallery',
                'type' => 'gallery',
                'title' => __('Gallery', 'leadinjection'),
                'subtitle' => __('(Needed if gallery post.)', 'leadinjection'),
            ),
            array(
                'id' => 'li-post-quote-text',
                'type' => 'textarea',
                'title' => __('Quote Text', 'leadinjection'),
                'subtitle' => __('(Needed if quote post.)', 'leadinjection'),
            ),
            array(
                'id' => 'li-post-quote-author',
                'type' => 'text',
                'title' => __('Quote Author', 'leadinjection'),
                'subtitle' => __('(Needed if quote post.)', 'leadinjection'),
            ),
            array(
                'id' => 'li-post-video-embed',
                'type' => 'textarea',
                'title' => __('Video Embed Code ', 'leadinjection'),
                'subtitle' => __('(Needed if video post.)', 'leadinjection'),
            ),
            array(
                'id'       => 'li-post-audio',
                'type'     => 'media',
                'preview' => false,
                'url'      => true,
                'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'title'    => __('Audio File', 'leadinjection'),
                'subtitle' => __('(Needed if audio post.)', 'leadinjection'),
                'hint'     => array(
                    'title'   => 'Test',
                    'content' => 'This is a <b>hint</b> tool-tip for the webFonts field.<br/><br/>Add any HTML based text you like here.',
                )
            ),
            array(
                'id' => 'li-post-link-text',
                'type' => 'text',
                'title' => __('Link Text', 'leadinjection'),
                'subtitle' => __('(Needed if link post.)', 'leadinjection'),
            ),
            array(
                'id' => 'li-post-link-url',
                'type' => 'text',
                'title' => __('Link URL', 'leadinjection'),
                'subtitle' => __('(Needed if link post.)', 'leadinjection'),
            ),
        )
    ),


);