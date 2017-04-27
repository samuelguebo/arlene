<?php
/*
================================================================================================
Sample implementation of the Custom Header feature.
================================================================================================
@package        Arlene
@link           https://developer.wordpress.org/themes/functionality/custom-headers/
@copyright      Copyright (C) 2017. Samuel Guebo
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Samuel Guebo (http://samuelguebo.co/)
================================================================================================
*/

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses arlene_header_back()
 */

$args = array(
		'flex-height'            => true,
		'width'                  => 1350,
		'height'                 => 310,
	);
add_theme_support( 'custom-header', $args );

/**
 * Set up the default content width
 *
 */
if ( ! isset( $content_width ) ) $content_width = 900;

/**
 *  Taking advantage of the Custom Logo API
 *  @link https://codex.wordpress.org/Theme_Logo
 *  @link https://www.sitepoint.com/wordpress-custom-logo-api/
 */
add_theme_support('custom-logo');
add_image_size('inverse-logo', 150, 150);
add_theme_support('custom-logo', array(
    'size' => 'inverse-logo'
));
