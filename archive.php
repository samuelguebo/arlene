<?php
/*
================================================================================================
The archive template file
================================================================================================

@link           @link https://codex.wordpress.org/Template_Hierarchy
@package        Arlene
@copyright      Copyright (C) 2017. Samuel Guebo
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Samuel Guebo (https://samuelguebo.co/)
================================================================================================
*/

get_header(); ?>
            <section class="single-cover" 
             style="background-image:url(<?php echo esc_url(get_header_image());?>); background-position:center center;">
                <div class="overlay">
                    <h3 class="center title">
                        <?php the_archive_title();?>
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
                                while ( have_posts() ) : the_post();

                                    if(has_post_thumbnail()){
                                        get_template_part( 'template-parts/content', 'article' );
                                    }else {
                                        get_template_part( 'template-parts/content', 'article-without-thumb' );
                                    }

                                endwhile;

                            else :

                                get_template_part( 'template-parts/content', '404' );

                            endif; ?>
                    </div>
                    <div class="pagination-wrapper columns large-4 large-centered" >
                        <?php the_posts_pagination( array(
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
