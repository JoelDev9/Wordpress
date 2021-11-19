<?php
/**
 * The sidebar containing the main widget area.
 *
 * -------------------------------------------------------------------
 *
 * @package    Leadinjection WordPress Theme
 * @author     Themeinjection <info@themeinjection.com>
 * @copyright  2016 Themeinjection
 * @link       http://leadinjection.io/
 *
 * -------------------------------------------------------------------
 *
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) { return; }
?>

<div class="sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div>
