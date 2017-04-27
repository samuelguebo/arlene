<?php
/*
================================================================================================
The sidebar containing the main widget area
================================================================================================
@package        Arlene
@link           https://developer.wordpress.org/themes/basics/template-files/#template-partials
@copyright      Copyright (C) 2017. Samuel Guebo
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Samuel Guebo (http://samuelguebo.co/)
================================================================================================
*/
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<!-- #secondary -->
<aside id="sidebar" class="large-4 columns">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>