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

            <section class="category-row row">
                <section id="breadcrumbs">
                    <div class="breadcrumbs row">
                        <?php if (function_exists('arlene_custom_breadcrumbs')) arlene_custom_breadcrumbs(); ?>
                    </div>
                </section>
                
                <!-- post list-->
                <section class="large-8 columns main-column">
                    <div class="post-list clearfix">
                        <?php
                            if ( have_posts() ) :
                                /* Start the Loop */
                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // for pagination purpose
                                while ( have_posts() ) : the_post();

                                    //get_template_part( 'template-parts/content', get_post_format() );
                                    get_template_part( 'template-parts/content', 'article' );

                                endwhile;

                            else :

                                get_template_part( 'template-parts/content', '404' );

                            endif; ?>
                    </div>
                    <div class="pagination-wrapper" >
                        <?php if(function_exists('arlene_pagination')) { 
                            arlene_pagination($wp_query->found_posts, $paged); 
                        }else {
                            posts_nav_link();
                        } ?>
                    </div>
                </section>
                <?php get_sidebar();?>
            </section>
<?php
get_footer();
