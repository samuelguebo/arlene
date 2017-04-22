<?php
/**
 * Template part for displaying articles in the Slider loop
 *
 * @link https://codex.wordpress.org/The_Loop
 *
 * @package Alliance Lab
 */

?>



<li class="post-item" style="background:url(<?php echo get_the_post_thumbnail_url($post, 'slider-cover'); ?>);background-size:cover;background-position:center;">
    <div class="row summary-wrapper" style="position:relative; top:30%;">
        <div class="large-10 small-10 large-centered summary columns">
            <div class="caption">
                <h1><?php echo $post->post_title;?></h1>
                <h3><?php echo $post->post_content;?></h3>
            </div>
        </div>
        <div class="large-7 small-8 large-centered summary columns">
            <a href="<?php echo get_permalink( get_page_by_path( 'etudes' ) );?>" class="small button round navy"><?php _e('Etudes réalisées','alliancelab')?></a>
            <a href="<?php echo get_permalink( get_page_by_path( 'commander' ) );?>" class="small button round green right"><?php _e('Commander une étude','alliancelab')?></a>

        </div>
    </div>

    
</li> 