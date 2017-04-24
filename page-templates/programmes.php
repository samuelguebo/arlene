<?php
/*
================================================================================================
Arlene - programmes.php
Template Name: Programmes
================================================================================================
This is the template that displays all programmes.

@package        Arlene
@copyright      Copyright (C) 2017. Samuel Guebo
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Samuel Guebo (http://samuelguebo.co/)
================================================================================================
*/

get_header(); ?>
    <section class="clearfix height-150 single-cover" 
             style="background-image:url(<?php echo esc_url(get_header_image());?>); background-position:bottom center;">
            <h1 class="center title">
                <?php the_title();?>
            </h1>
    </section>
    <section class="row etudes">
        <section id="breadcrumbs" class="clearfix">
            <div class="breadcrumbs row">
                <?php if (function_exists('arlene_custom_breadcrumbs')) arlene_custom_breadcrumbs(); ?>
            </div>
        </section>
        <section class="height-30">

        </section>
        <section class="columns main-column">
            
            <?php
                $taxonomies = get_terms('statut',array(
                                        'orderby'    => 'count',
                                        'hide_empty' => 0)); 
                foreach ( $taxonomies as $taxonomy ):?>
                    <h4 class="category-title left" class="large-8 columns"><?php echo $taxonomy->name ?></h4>
                    <div class="category-title-line large-12 columns"></div>
                    <br class="clearfix">
                    <div class="widget">
                        <ul>
                            <?php 
                            $args = array('post_type'=>'etude', 'taxonomy'=>'statut');
                            $etudes = null; $etudes = get_posts($args);
                            foreach($etudes as $post):setup_postdata( $post );?>
                            <li><a href="#"><?php echo $post->post_title;?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                <?php endforeach;?>
            <a href="<?php echo get_permalink( get_page_by_path( 'commander' ) );?>" class="button rounded green left"><i class="fa fa-shopping-cart"></i> <?php _e('Commander une nouvelle étude','alliancelab')?></a>
        </section>
    </section>
    <?php get_footer();?>