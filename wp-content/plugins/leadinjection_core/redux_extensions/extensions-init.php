<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$redux_opt_name = "rdx_option";

// Place any extra hooks/configs in here for extensions and 
// place the actual extension within the /extensions dir


// BE SURE TO RENAME THE FUNCTION NAMES TO YOUR OWN NAME OR PREFIX
if ( !function_exists( "li_onpage_metabox" ) ):
    function li_onpage_metabox($metaboxes) {

        // Page Metaboxes
        $boxSectionsPage = require_once(dirname(__FILE__).'/page_metaboxes.php');

        // Post Metaboxes
        $boxSectionsPost = require_once(dirname(__FILE__).'/post_metaboxes.php');

        // Modal Metaboxes
        $boxSectionsModal = require_once(dirname(__FILE__).'/modal_metaboxes.php');

        // Declare your metaboxes
        $metaboxes = array();
        $metaboxes[] = array(
            'id'            => 'onpage_options',
            'title'         => __( 'On Page Options', 'leadinjection' ),
            'post_types'    => array( 'page', 'product'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low - Priorities of placement
            'sections'      => $boxSectionsPage,
        );

        // Declare your metaboxes
        $metaboxes[] = array(
            'id'            => 'post_options',
            'title'         => __( 'Post Options', 'leadinjection' ),
            'post_types'    => array( 'post'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low - Priorities of placement
            'sections'      => array_merge($boxSectionsPost, $boxSectionsPage),
        );

        $metaboxes[] = array(
            'id'            => 'modal_options',
            'title'         => __( 'Modal Options', 'leadinjection' ),
            'post_types'    => array( 'li_modals'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low - Priorities of placement
            'sections'      => $boxSectionsModal,
        );

        return $metaboxes;
    }

    add_action("redux/metaboxes/{$redux_opt_name}/boxes", "li_onpage_metabox");
endif;



// The loader will load all of the extensions automatically.
// Alternatively you can run the include/init statements below.
require_once(dirname(__FILE__).'/loader.php');