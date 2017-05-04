<?php
/*
================================================================================================
Template Name: Blog
This is the template that displays all posts. Let's call it the Blog as a conventional pattern.
================================================================================================
@package        Arlene
@link           https://codex.wordpress.org/Pages
@copyright      Copyright (C) 2017. Samuel Guebo
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Samuel Guebo (http://samuelguebo.co/)
================================================================================================
*/


get_header(); ?>
    <section class="single-cover" 
             style="background-image:url(<?php echo esc_url(get_header_image());?>); background-position:center center;">
                <div class="overlay">
                    <h3 class="center title">
                        <?php the_title();?>
                    </h3>
                </div>
            </section>
            <section id="breadcrumbs" >
                <div class="breadcrumbs">
                    <?php if (function_exists('arlene_custom_breadcrumbs')) arlene_custom_breadcrumbs(); ?>
                </div>
            </section>
            <section class="category-row row">                
                <!-- post list-->
                <section class="large-8 columns main-column">
                    <div class="post-list clearfix">
                        <?php
                            if ( have_posts() ) :
                                /* Start the Loop */
                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // for pagination purpose
                                $args = array(
                                        'post_type' => array('post'),
                                        'posts_per_page' =>4,
                                        'paged'=>$paged
                                        );

                                $blog_posts = new WP_Query($args);
                                while ( $blog_posts->have_posts() ) : $blog_posts->the_post();

                                                                       if(has_post_thumbnail()){
                                    get_template_part( 'template-parts/content', 'article' );
                                    }else {
                                        get_template_part( 'template-parts/content', 'article-without-thumb' );
                                    }

                                endwhile;

                            else :

                                get_template_part( 'template-parts/content', '404' );

                            endif; wp_reset_query();?>
                    </div>
                    <div class="pagination-wrapper columns large-4 large-centered" >
                        <?php $GLOBALS['wp_query']->max_num_pages = $blog_posts->max_num_pages;
                        
                        the_posts_pagination( array(
                            'mid_size' => 2,
                            'prev_text' => __( '&laquo;', 'arlene' ),
                            'next_text' => __( '&raquo;', 'arlene' ),
                            'screen_reader_text' => ' '
                        ) ); ?>
                    </div>
                </section>
                <?php get_sidebar();?>
            </section>
<?php
get_footer();
