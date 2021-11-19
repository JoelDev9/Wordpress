<?php
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */

add_action( 'tgmpa_register', 'leadinjection_register_required_plugins' );
function leadinjection_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name' => 'Redux Framework',
            'slug' => 'redux-framework',
            'source' => get_template_directory_uri() . '/inc/plugins/redux-framework.zip',
            'required' => true,
            'version' => '4.1.29',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        ),
        array(
            'name' => 'Leadinjection Core',
            'slug' => 'leadinjection_core',
            'source' => get_template_directory_uri() . '/inc/plugins/leadinjection_core.zip',
            'required' => true,
            'version' => '2.3.14',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        ),
        array(
            'name' => 'Visual Composer',
            'slug' => 'js_composer',
            'source' => get_template_directory_uri() . '/inc/plugins/js_composer.zip',
            'required' => true,
            'version' => '6.6.0',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        ),
        array(
            'name' => 'Slider Revolution',
            'slug' => 'revslider',
            'source' => get_template_directory_uri() . '/inc/plugins/revslider.zip',
            'required' => true,
            'version' => '6.5.3',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        ),
        array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'source' => get_template_directory_uri() . '/inc/plugins/contact-form-7.zip',
            'required' => true,
            'version' => '5.4.1',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        ),
        array(
            'name' => 'Mega Main Menu',
            'slug' => 'mega_main_menu',
            'source' => get_template_directory_uri() . '/inc/plugins/mega_main_menu.zip',
            'required' => true,
            'version' => '2.2.1',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        ),
        array(
            'name' => 'SVG Support',
            'slug' => 'svg-support',
            'source' => get_template_directory_uri() . '/inc/plugins/svg-support.zip',
            'required' => true,
            'version' => '2.3.18',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        )

    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'leadinjection',             // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings' => array(
            'page_title' => __('Install Required Plugins', 'leadinjection'),
            'menu_title' => __('Install Plugins', 'leadinjection'),
            'installing' => __('Installing Plugin: %s', 'leadinjection'), // %1$s = plugin name
            'oops' => __('Something went wrong with the plugin API.', 'leadinjection'),
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'leadinjection'),
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'leadinjection'),
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'leadinjection'),
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'leadinjection'),
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'leadinjection'),
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'leadinjection'),
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'leadinjection'),
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'leadinjection'),
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins', 'leadinjection'),
            'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins', 'leadinjection'),
            'return' => __('Return to Required Plugins Installer', 'leadinjection'),
            'plugin_activated' => __('Plugin activated successfully.', 'leadinjection'),
            'complete' => __('All plugins installed and activated successfully. %s', 'leadinjection'),
            'nag_type' => 'updated'
        )
    );

    tgmpa( $plugins, $config );
}
