<?php

/*
    Person Profile
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_person_profile', 'leadinjection_person_profile_shortcode');

function leadinjection_person_profile_shortcode($atts, $content)
{

    $default_atts = array(
        'person_profile_style' => 'li-person-profile',
        'person_profile_image_overlay' => '',
        'person_profile_desc_background' => '',
        'person_profile_desc_background_hover' => '',
        'person_profile_image' => '',
        'person_profile_image_style' => '',
        'person_profile_name' => '',
        'person_profile_name_color' => '',
        'person_profile_name_color_hover' => '',
        'person_profile_title' => '',
        'person_profile_title_color' => '',
        'person_profile_title_color_hover' => '',
        'content' => !empty($content) ? $content : '',
        'person_profile_content_color' => '',
        'person_profile_content_color_hover' => '',
        'css' => '',
        'animation' => 'none',
        'social_links_color' => '',
        'social_links_hover_color' => '',
        'social_links_bar_color' => '',
        'facebook_url' => '',
        'twitter_url' => '',
        'google_plus_url' => '',
        'email_address' => '',
        'linkedin_url' => '',
        'xclass' => '',
        'shortcode_id' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('person_profile_', $shortcode_id);
    $wrapper_class = array($person_profile_style, $xclass, $responsive_helper);

    //$default_image = array(get_template_directory_uri() . '/img/person-profile-default.png');
    $profile_image = ('' != $person_profile_image) ? wp_get_attachment_image($person_profile_image, 'leadinjection-person-profile', false, array('class' => 'img-responsive')) : '';
    $profile_image_small = ('' != $person_profile_image) ? wp_get_attachment_image($person_profile_image, 'leadinjection-person-profile-small', false, array('class' => 'img-responsive')) : '';
    $profile_image_image = ('' != $person_profile_image) ? wp_get_attachment_image($person_profile_image, 'leadinjection-person-profile-image', false, array('class' => 'img-responsive')) : '';
    $profile_image_desc = ('' != $person_profile_image) ? wp_get_attachment_image($person_profile_image, 'leadinjection-person-profile-desc', false, array('class' => 'img-responsive')) : '';


    $data_effect = '';
    if ('none' !== $animation) {
        leadinjection_enqueue_animation();
        $wrapper_class[] = 'li-animate';
        $data_effect = 'data-effect="' . esc_attr($animation) . '"';
    }

    $social_icons  = ('' != $facebook_url) ? '<li><a href="' . esc_url($facebook_url) . '"><i class="fa fa-fw fa-facebook"></i></a></li>' : null;
    $social_icons .= ('' != $twitter_url) ? '<li><a href="' . esc_url($twitter_url) . '"><i class="fa fa-fw fa-twitter"></i></a></li>' : null;
    $social_icons .= ('' != $google_plus_url) ? '<li><a href="' . esc_url($google_plus_url) . '"><i class="fa fa-fw fa-google-plus"></i></a></li>' : null;
    $social_icons .= ('' != $email_address) ? '<li><a href="mailto:' . $email_address . '"><i class="fa fa-fw fa-at"></i></a></li>' : null;
    $social_icons .= ('' != $linkedin_url) ? '<li><a href="' . esc_url($linkedin_url) . '"><i class="fa fa-fw fa-linkedin"></i></a></li>' : null;

    // Styles
    $style  = '';
    $style .= (!empty($person_profile_name_color)) ? "#$shortcode_id .profile-name { color: $person_profile_name_color; }" : null;
    $style .= (!empty($person_profile_title_color)) ? "#$shortcode_id .profile-name small { color: $person_profile_title_color; }" : null;
    $style .= (!empty($person_profile_content_color)) ? "#$shortcode_id .profile-description { color: $person_profile_content_color; }" : null;
    $style .= (!empty($social_links_color)) ? "#$shortcode_id .profile-social-links li a { background-color: $social_links_color; }" : null;
    $style .= (!empty($social_links_color)) ? "#$shortcode_id .profile-social-links li a:hover { background-color: #fff; border-color:$social_links_color; color: $social_links_color; }" : null;
    $style .= (!empty($person_profile_image_overlay)) ? "#$shortcode_id .profile-content { background-color: $person_profile_image_overlay; }" : null;
    $style .= (!empty($social_links_hover_color)) ? "#$shortcode_id .profile-social-links li a:hover { border-color: $social_links_hover_color; color: $social_links_hover_color; }" : null;
    $style .= (!empty($social_links_bar_color)) ? "#$shortcode_id .profile-social-links { background-color: $social_links_bar_color; }" : null;
    $style .= (!empty($person_profile_desc_background)) ? "#$shortcode_id .profile-content { background-color: $person_profile_desc_background; }" : null;
    $style .= (!empty($person_profile_desc_background_hover)) ? "#$shortcode_id:hover .profile-content { background-color: $person_profile_desc_background_hover; }" : null;
    $style .= (!empty($person_profile_name_color_hover)) ? "#$shortcode_id:hover .profile-name { color: $person_profile_name_color_hover; }" : null;
    $style .= (!empty($person_profile_title_color_hover)) ? "#$shortcode_id:hover .profile-name small { color: $person_profile_title_color_hover; }" : null;
    $style .= (!empty($person_profile_content_color_hover)) ? "#$shortcode_id:hover .profile-description { color: $person_profile_content_color_hover; }" : null;

    $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;

    $person_profile_title = ('' != $person_profile_title) ? '<small>' . $person_profile_title . '</small>' : null;

    // Create wrapper classes string
    $wrapper_class  = leadinjection_wrapper_class($wrapper_class, $css);
    
    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>

    <?php echo $output_style; ?>

    <?php if('li-person-profile' == $person_profile_style) :?>
    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect ?>>
        <div class="profile-image <?php echo (!empty($person_profile_image_style)) ? $person_profile_image_style : ''; ?>">
            <?php echo $profile_image; ?>
        </div>

        <div class="profile-content">
            <h3 class="profile-name"><?php echo $person_profile_name; ?> <?php echo $person_profile_title; ?></h3>
            <div class="profile-description" ><?php echo wpb_js_remove_wpautop( $content, true ); ?></div>
            <ul class="profile-social-links">
            <?php echo $social_icons; ?>
            </ul>
        </div>

        <div class="clearfix"></div>
    </div>
    <?php endif; ?>



    <?php if('li-person-profile-small' == $person_profile_style) :?>
    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect ?>>
        <div class="profile-image <?php echo (!empty($person_profile_image_style)) ? $person_profile_image_style : ''; ?>">
            <?php echo $profile_image_small; ?>
        </div>

        <div class="profile-content">
            <h3 class="profile-name"><?php echo $person_profile_name; ?> <?php echo $person_profile_title; ?></h3>
            <div class="profile-description" ><?php echo wpb_js_remove_wpautop( $content, true ); ?></div>
            <ul class="profile-social-links">
                <?php echo $social_icons; ?>
            </ul>
        </div>

        <div class="clearfix"></div>
    </div>
    <?php endif; ?>



    <?php if('li-person-profile-image' == $person_profile_style) :?>
    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?> <?php echo (!empty($person_profile_image_style)) ? $person_profile_image_style : ''; ?>" <?php echo $data_effect ?>>
        <div class="profile-image">
            <?php echo $profile_image_image; ?>
        </div>

        <div class="profile-content">
            <h3 class="profile-name"><?php echo $person_profile_name; ?> <?php echo $person_profile_title; ?></h3>
            <ul class="profile-social-links">
                <?php echo $social_icons; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>


    <?php if('li-person-profile-desc' == $person_profile_style) :?>
    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo esc_attr($wrapper_class); ?>" <?php echo $data_effect ?>>
        <div class="profile-image <?php echo (!empty($person_profile_image_style)) ? $person_profile_image_style : ''; ?>">
            <?php echo $profile_image_desc; ?>
        </div>

        <div class="profile-content">
            <ul class="profile-social-links">
                <?php echo $social_icons; ?>
            </ul>
            <div class="clearfix"></div>
            <h3 class="profile-name"><?php echo $person_profile_name; ?> <?php echo $person_profile_title; ?></h3>
            <div class="profile-description" ><?php echo wpb_js_remove_wpautop( $content, true ); ?></div>
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

add_action('vc_before_init', 'leadinjection_person_profile_vc');

function leadinjection_person_profile_vc()
{
    $leadinjection_person_profile_params = array(
        array(
            'type' => 'dropdown',
            'heading' => __('Profile style ', 'leadinjection'),
            'param_name' => 'person_profile_style',
            'value' => array(
                __('Default', 'leadinjection') => 'li-person-profile',
                __('Small', 'leadinjection') => 'li-person-profile-small',
                __('Only Image', 'leadinjection') => 'li-person-profile-image',
                __('Long Description', 'leadinjection') => 'li-person-profile-desc',
            ),
            'std' => 'li-person-profile',
            'admin_label' => true,
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Select a image overlay color', 'leadinjection'),
            'param_name' => 'person_profile_image_overlay',
            'dependency' => array(
                'element' => 'person_profile_style',
                'value' => array('li-person-profile-image'),
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Content background color', 'leadinjection'),
            'param_name' => 'person_profile_desc_background',
            'dependency' => array(
                'element' => 'person_profile_style',
                'value' => array('li-person-profile-desc'),
            ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Content background color (hover)', 'leadinjection'),
            'param_name' => 'person_profile_desc_background_hover',
            'dependency' => array(
                'element' => 'person_profile_style',
                'value' => array('li-person-profile-desc'),
            ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'attach_image',
            'heading' => __('Select person image', 'leadinjection'),
            'param_name' => 'person_profile_image',
            'value' => '',
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Image style ', 'leadinjection'),
            'param_name' => 'person_profile_image_style',
            'value' => array(
                __('Square', 'leadinjection') => '',
                __('Rounded', 'leadinjection') => 'profile-image_rounded',
                __('Round', 'leadinjection') => 'profile-image_round',
            ),
            'std' => '',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Enter person name here', 'leadinjection'),
            'param_name' => 'person_profile_name',
            'admin_label' => true,
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Name color', 'leadinjection'),
            'param_name' => 'person_profile_name_color',
            'dependency' => array(
                'element' => 'person_profile_style',
                'value' => array('li-person-profile', 'li-person-profile-small', 'li-person-profile-desc'),
            ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Name color (hover)', 'leadinjection'),
            'param_name' => 'person_profile_name_color_hover',
            'dependency' => array(
                'element' => 'person_profile_style',
                'value' => array('li-person-profile-desc'),
            ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Enter person title here', 'leadinjection'),
            'param_name' => 'person_profile_title',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Title color', 'leadinjection'),
            'param_name' => 'person_profile_title_color',
            'dependency' => array(
                'element' => 'person_profile_style',
                'value' => array('li-person-profile', 'li-person-profile-small', 'li-person-profile-desc'),
            ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Title color (hover)', 'leadinjection'),
            'param_name' => 'person_profile_title_color_hover',
            'dependency' => array(
                'element' => 'person_profile_style',
                'value' => array('li-person-profile-desc'),
            ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'textarea_html',
            'heading' => __('Enter a person short description here', 'leadinjection'),
            'param_name' => 'content',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Description color', 'leadinjection'),
            'param_name' => 'person_profile_content_color',
            'dependency' => array(
                'element' => 'person_profile_style',
                'value' => array('li-person-profile', 'li-person-profile-small', 'li-person-profile-desc'),
            ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Description color (hover)', 'leadinjection'),
            'param_name' => 'person_profile_content_color_hover',
            'dependency' => array(
                'element' => 'person_profile_style',
                'value' => array('li-person-profile-desc'),
            ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        leadinjection_animation_field(),
        leadinjection_css_editor_field(),
        leadinjection_xclass_field(),
        leadinjection_shortcode_id_field(),

        array(
            'type' => 'colorpicker',
            'heading' => __('Social media links color', 'leadinjection'),
            'param_name' => 'social_links_color',
            'group' => __('Social Media Links', 'leadinjection'),
            'dependency' => array(
                'element' => 'person_profile_style',
                'value' => array('li-person-profile', 'li-person-profile-small'),
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Social media links hover color', 'leadinjection'),
            'param_name' => 'social_links_hover_color',
            'group' => __('Social Media Links', 'leadinjection'),
            'dependency' => array(
                'element' => 'person_profile_style',
                'value' => array('li-person-profile-image'),
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __('Social media bar color', 'leadinjection'),
            'param_name' => 'social_links_bar_color',
            'group' => __('Social Media Links', 'leadinjection'),
            'dependency' => array(
                'element' => 'person_profile_style',
                'value' => array('li-person-profile-desc'),
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Facebook URL', 'leadinjection'),
            'param_name' => 'facebook_url',
            'description' => __('Address to your Facebook Profile (e.g. https://www.facebook.com/themeinjection)', 'leadinjection'),
            'group' => __('Social Media Links', 'leadinjection'),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Twitter URL', 'leadinjection'),
            'param_name' => 'twitter_url',
            'description' => __('Address to your Twitter Profile (e.g. https://twitter.com/themeinjection)', 'leadinjection'),
            'group' => __('Social Media Links', 'leadinjection'),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Google Plus URL', 'leadinjection'),
            'param_name' => 'google_plus_url',
            'description' => __('Address to your Google Plus Profile (e.g. https://plus.google.com/+Themeinjection-Themes)', 'leadinjection'),
            'group' => __('Social Media Links', 'leadinjection'),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Public Email Address', 'leadinjection'),
            'param_name' => 'email_address',
            'description' => __('Enter your Email Address here (e.g. mail@themeinjection.com)', 'leadinjection'),
            'group' => __('Social Media Links', 'leadinjection'),
        ),array(
            'type' => 'textfield',
            'heading' => __('LinkedIn Profile URL', 'leadinjection'),
            'param_name' => 'linkedin_url',
            'description' => __('Address to your LinkedIn Profile (e.g. https://www.linkedin.com/in/themeinjection-a7aa5b1b)', 'leadinjection'),
            'group' => __('Social Media Links', 'leadinjection'),
        ),
    );

    $leadinjection_person_profile_params = leadinjection_add_responsive_helper_params($leadinjection_person_profile_params);

    vc_map(array(
            "name" => __("Person Profile", "leadinjection"),
            "base" => "leadinjection_person_profile",
            "icon" => 'li-icon li-person-profile',
            "class" => '',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Person Profile with social links', 'leadinjection'),
            "params" => $leadinjection_person_profile_params
        )
    );
}


