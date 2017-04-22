<?php
/**
 * The slider containing the carousel animation
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Alliance Lab
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
            timer:true;
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
    
