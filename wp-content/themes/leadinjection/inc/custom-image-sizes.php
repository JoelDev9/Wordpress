<?php
/**
 * Custom Image Sizes
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


// Add Featured Image Size (750px x 350px )
add_image_size('leadinjection-featured-image', 750, 350, array('center', 'center'));

// Add Person Profile Image Size (261px x 261px )
add_image_size('leadinjection-person-profile', 261, 261, true);
add_image_size('leadinjection-person-profile-small', 160, 160, true);
add_image_size('leadinjection-person-profile-image', 400, 400, true);
add_image_size('leadinjection-person-profile-desc', 360, 360, true);

// Add Gallery Image Size
add_image_size('leadinjection-gallery-image-2', 952, 702, true);
add_image_size('leadinjection-gallery-image-3', 635, 468, true);
add_image_size('leadinjection-gallery-image-4', 476, 351, true);
add_image_size('leadinjection-gallery-image-5', 381, 281, true);
add_image_size('leadinjection-gallery-image-6', 317, 234, true);
add_image_size('leadinjection-gallery-image-7', 272, 201, true);
add_image_size('leadinjection-gallery-image-8', 238, 175, true);
add_image_size('leadinjection-gallery-image-9', 212, 156, true);
add_image_size('leadinjection-gallery-image-10', 190, 140, true);