<?php
/*
================================================================================================
The template for displaying all single posts
================================================================================================
@package        Arlene
@link           https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
@copyright      Copyright (C) 2017. Samuel Guebo
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Samuel Guebo (http://samuelguebo.co/)
================================================================================================
*/
get_header(); ?>
    <section class="single-cover" 
     style="background-image:url(<?php echo esc_url(get_header_image());?>); background-position:center center;">
        <div class="overlay">
        <h3 class="center title columns large-10 large-centered">
            <?php the_title();?>
        </h3>
            <section class="clearfix"></section>
        </div>
        
    
    </section>
    
    <section class="row single-row">
        <section id="breadcrumbs" class="clearfix">
            <div class="breadcrumbs">
                <?php if (function_exists('arlene_custom_breadcrumbs')) arlene_custom_breadcrumbs(); ?>
            </div>
        </section>
        <section class="large-8 columns main-column">
            <?php
            while ( have_posts() ) : the_post();

                // Include the single post content template.
			     get_template_part( 'template-parts/content', 'single' );

            endwhile; // End of the loop.
            ?>
        </section>
        <?php get_sidebar();?>
    </section>
    <?php get_footer();?>