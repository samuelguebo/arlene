<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Arlene
 */

get_header(); ?>
        <?php get_template_part ('slider');?>
        <section class="row">
            <div class="category-row">
                <!-- post list-->
                <div class="post-list clearfix">
                    <?php //starting slider loop;
                    
                    $i = 1;	$args = array ('post_type'=>'programme'); 
                    $programmes = new WP_Query($args);                    
                    if($programmes->have_posts() ) :
                        while ( $etudes->have_posts())  : $programmes->the_post();
                            get_template_part( 'template-parts/content', 'programme' );
                        endwhile;
                    endif; wp_reset_query();?>
                </div>
            </div>
        </section>
<?php
get_footer();
