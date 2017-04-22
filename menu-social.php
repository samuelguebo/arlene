<?php
/**
 * The template for displaying the menu
 *
 * Contains the social menu items
 *
 * @link https://developer.wordpress.org/reference/functions/wp_nav_menu/
 * @link https://codex.wordpress.org/Class_Reference/Walker
 * @package Arlene
 */

?>

<?php if ( has_nav_menu( 'social' ) ) {

	wp_nav_menu(
		array(
			'theme_location'  => 'social',
			'container'       => 'div',
			'container_id'    => 'menu-social',
			'container_class' => 'menu',
			'menu_id'         => 'menu-social-items',
			'menu_class'      => 'menu-items',
			'depth'           => 1,
			'link_before'     => '<span class="screen-reader-text">',
			'link_after'      => '</span>',
			'fallback_cb'     => '',
		)
	);

} ?>