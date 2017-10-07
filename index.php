<?php
/*
================================================================================================
The main template file. This is the most generic template file in a WordPress theme
and one of the two required files for a theme (the other being style.css).
It is used to display a page when nothing more specific matches a query.
E.g., it puts together the home page when no home.php file exists.
================================================================================================
@package        Arlene
@link           @link https://codex.wordpress.org/Template_Hierarchy
@copyright      Copyright (C) 2017. Samuel Guebo
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Samuel Guebo (https://samuelguebo.co/)
================================================================================================
*/
get_header(); ?>
		<?php get_template_part ('slider');?>

		<?php 
			// Make sure Kirki is activated
			if ( class_exists( 'Kirki' ) ) {
				// get_template_part ('home-main-kirki')
			} else {
				get_template_part ('template-parts/home-main');
			}
		?>
<?php
get_footer();