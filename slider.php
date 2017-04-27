<?php
/*
================================================================================================
The slider containing the carousel animation
================================================================================================
@package        Arlene
@link           https://developer.wordpress.org/themes/basics/template-files/#template-partials
@copyright      Copyright (C) 2017. Samuel Guebo
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Samuel Guebo (http://samuelguebo.co/)
================================================================================================
*/
?>
    <?php //starting slider loop;
    $i = 1;	$args = array(
                        //'category'=>$analysis_cat_ID,
                        'post_type'=>'post',
                        'showposts'=>4,
                        'post__in'  => get_option( 'sticky_posts' ),
                        'suppress_filters'  => 0 
                         ); 
    $sliders = get_posts( $args );
    if($sliders):?>
        <section id="slider" class="row">
        <ul class="slider-orbit slider-wrapper" data-auto-play="true" data-orbit
            data-options="animation:fade;
            pause_on_hover:false;
            animation_speed:500;
            navigation_arrows:false;
            timer_speed:4000;
            timer:false;
            bullets:true;
            slide_number:false;"
            >

                <?php
                foreach ( $sliders  as $post )  : setup_postdata( $post );
                    get_template_part('template-parts/content','slide');
                endforeach; ?>
        </ul>
        </section>
    <?php endif; wp_reset_postdata(); $sliders = null;?>
    
