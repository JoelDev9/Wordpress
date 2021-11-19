<?php

/*
    Textblock
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('leadinjection_location_map', 'leadinjection_location_map_shortcode');

function leadinjection_location_map_shortcode($atts, $content)
{

    $default_atts = array(
        'map_style' => 'li-location-map',
        'map_width' => '',
        'map_height' => '',
        'content' => !empty($content) ? $content : '',
        'address_title' => '',
        'street' => '',
        'city' => '',
        'state' => '',
        'zip' => '',
        'country' => '',
        'address_box_color' => '',
        'enable_button' => '',
        'btn_color' => '',
        'btn_background_color' => '',
        'btn_border_color' => '',
        'btn_value_color' => '',
        'animation' => 'none',
        'css' => '',
        'shortcode_id' => '',
        'xclass' => '',
    );

    $default_atts = leadinection_add_responsive_helper_atts($default_atts);
    $defaults = shortcode_atts($default_atts, $atts);
    $responsive_helper =  leadinjection_create_responsive_helper_classes($defaults);

    extract($defaults);

    $shortcode_id = leadinjection_custom_id('location_map_', $shortcode_id);
    $map_id = 'gmap_'.uniqid();
    $wrapper_class = array('location-map', $xclass, $responsive_helper);

    // Styles
    $style  = '';
    $style .= (!empty($address_box_color)) ? "#$shortcode_id .location-map-address-box{ background-color: $address_box_color; }" : null;
    $style .= (!empty($btn_value_color)) ? "#$shortcode_id .btn{ color: $btn_value_color; }" : null;
    $style .= (!empty($btn_background_color)) ? "#$shortcode_id .btn{ background-color: $btn_background_color; }" : null;
    $style .= (!empty($btn_border_color)) ? "#$shortcode_id .btn{ border-color: $btn_border_color; }" : null;
    $style .= (!empty($map_width)) ? "#$shortcode_id, #$map_id { width: $map_width; }" : null;
    $style .= (!empty($map_height)) ? "#$shortcode_id, #$map_id { height: $map_height; }" : null;

    $output_style = (!empty($style)) ? '<style scoped>'.$style.'</style>' : null;

    $data_effect = '';
    if ('none' !== $animation) {
        leadinjection_enqueue_animation();
        $wrapper_class[] = 'li-animate ';
        $data_effect = 'data-effect="' . esc_attr($animation) . '"';
    }

    // Create wrapper classes string
    $wrapper_class  = leadinjection_wrapper_class($wrapper_class, $css);

    // leadinjection Global options
    $leadinjection_global_option = get_option( 'rdx_option' );

    if(!empty($leadinjection_global_option['li-global-api-key-gmaps'])){
        wp_enqueue_script('li-google-maps', 'https://maps.googleapis.com/maps/api/js?key='.$leadinjection_global_option['li-global-api-key-gmaps']);
    }else{
        $api_notice = true;
    }

    ob_start();

    // Start Output
    //////////////////////////////////////////////////////////////////////////////////////////
    ?>

    <?php echo $output_style; ?>

    <script>

        <?php if(isset($api_notice)) :?>
            alert('To use the Location Map you need to set your Google Map API Key in the Leadinjection API Keys! For more information go to Leadinjection Options > API Keys')
        <?php endif; ?>

        jQuery(document).ready(function($) {

            var companyName = '<?php echo  esc_html( $address_title ); ?>';
            var address = '<?php echo esc_html( $street ) ?> <?php echo esc_html( $city ) ?> <?php echo esc_html( $state ) ?> <?php echo esc_html( $zip ) ?>';

            if ($('#<?php echo $map_id; ?>').length) {
                var geocoder;
                var map;

                var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
                var draggable = w > 992 ? true : false; // Disable on Mobile


                geocoder = new google.maps.Geocoder();

                var mapOptions = {
                    zoom: 14,
                    scrollwheel: false,
                    draggable: draggable,
                    mapTypeControl: false,
                    center: new google.maps.LatLng(0, 0),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }

                map = new google.maps.Map(document.getElementById('<?php echo $map_id; ?>'), mapOptions);

                var contentString = '<div id="content">' +
                    '<strong>' + companyName + '</strong><br>' +
                    'Address: ' + address +
                    '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                geocoder.geocode({'address': address}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location,
                            icon: '<?php echo get_template_directory_uri(); ?>/img/mapmarker.png',
                            title: address
                        });

                        google.maps.event.addListener(marker, 'click', function () {
                            infowindow.open(map, marker);
                        });

                    } else {
                        alert('Geocode was not successful for the following reason: ' + status + '\n\nTo use the Location Map you need to set a valid Google Map API Key in the Leadinjection API Keys! For more information go to Leadinjection Options > API Keys');
                    }
                });
            }
            });
    </script>

    <div id="<?php echo esc_attr($shortcode_id); ?>" class="<?php echo $wrapper_class; ?>" <?php echo $data_effect; ?>>
        <div id="<?php echo $map_id; ?>" class="location-map-gmap"></div>
        <div class="location-map-address">
            <?php if('li-location-map-direction' == $map_style) : ?>
                <div class="location-map-address-box">
                    <i class="glyphicon glyphicon-map-marker title-marker"></i>
                    <address>
                        <?php echo esc_html($street); ?> <br />
                        <?php echo esc_html($city); ?>, <?php echo esc_html($state); ?> <?php echo esc_html($zip); ?> <br />
                        <?php echo esc_html($country); ?> <br />
                    </address>
                    <?php if(!empty($enable_button)) : ?>
                    <a href="https://maps.google.com?daddr=<?php echo esc_html(urlencode($street)); ?>+<?php echo esc_html(urlencode($state)); ?>+<?php echo esc_html(urlencode($zip)); ?>+<?php echo esc_html(urlencode($country)); ?>" class="btn <?php echo $btn_color; ?> btn-md btn-icon-right"><?php echo __("Get Directions", "leadinjection") ?> <i class="fa fa-fw fa-arrow-right"></i></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
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

add_action('vc_before_init', 'leadinjection_location_map_vc');

function leadinjection_location_map_vc()
{
    vc_map(array(
            "name" => __("Location Map", "leadinjection"),
            "base" => "leadinjection_location_map",
            "class" => "",
            "icon" => 'li-icon li-location-map',
            "category" => __("Leadinjection", "leadinjection"),
            'description' => __('Location Map with Direction Button', 'leadinjection'),
            "params" => array(
                array(
                    'type' => 'dropdown',
                    'heading' => __('Select a map style', 'leadinjection'),
                    'param_name' => 'map_style',
                    'value' => array(
                        __('Simple Map', 'leadinjection') => 'li-location-map',
                        __('Map with direction', 'leadinjection') => 'li-location-map-direction'),
                    'std' => 'li-location-map',
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'enable_custom_size',
                    'value' => array(__('Add a custom map size', 'leadinjection') => 'yes'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Width (e.g. 300px)', 'leadinjection'),
                    'param_name' => 'map_width',
                    'admin_label' => true,
                    'dependency' => array(
                        'element' => 'enable_custom_size',
                        'value' => 'yes',
                    ),
                    'edit_field_class' => 'vc_col-sm-6'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Height (e.g. 300px)', 'leadinjection'),
                    'param_name' => 'map_height',
                    'admin_label' => true,
                    'dependency' => array(
                        'element' => 'enable_custom_size',
                        'value' => 'yes',
                    ),
                    'edit_field_class' => 'vc_col-sm-6'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Enter a marker title', 'leadinjection'),
                    'param_name' => 'address_title',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Street, Address', 'leadinjection'),
                    'param_name' => 'street',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('City', 'leadinjection'),
                    'param_name' => 'city',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('State', 'leadinjection'),
                    'param_name' => 'state',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('ZIP Code', 'leadinjection'),
                    'param_name' => 'zip',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Country', 'leadinjection'),
                    'param_name' => 'country',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Address block color', 'leadinjection'),
                    'description' => __('Select a Address Block Color', 'leadinjection'),
                    'param_name' => 'address_box_color',
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'enable_button',
                    'value' => array(__('Add an direction button.', 'leadinjection') => 'yes'),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('Select a button color.', 'leadinjection'),
                    'admin_label' => true,
                    'param_name' => 'btn_color',
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
                    'dependency' => array(
                        'element' => 'enable_button',
                        'value' => 'yes',
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select a button background color', 'leadinjection'),
                    'param_name' => 'btn_background_color',
                    'dependency' => array(
                        'element' => 'btn_color',
                        'value' => 'custom',
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select a button border color', 'leadinjection'),
                    'param_name' => 'btn_border_color',
                    'dependency' => array(
                        'element' => 'btn_color',
                        'value' => 'custom',
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __('Select a button text color', 'leadinjection'),
                    'param_name' => 'btn_value_color',
                    'dependency' => array(
                        'element' => 'btn_color',
                        'value' => 'custom',
                    ),
                ),
                leadinjection_animation_field(),
                leadinjection_css_editor_field(),
                leadinjection_xclass_field(),
                leadinjection_shortcode_id_field(),
            )
        )
    );
}

