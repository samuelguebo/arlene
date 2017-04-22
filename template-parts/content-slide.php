<?php
/**
 * Template part for displaying articles in the Slider loop
 *
 * @link https://codex.wordpress.org/The_Loop
 *
 * @package Alliance Lab
 */

?>



<li class="post-item">
    <?php the_post_thumbnail( 'slider-cover' , array('class'=>'responsive delay')); ?>
        <div class="large-4 small-8 columns slider-caption post-item-caption">
            <div class="panel">
                <span class="post-item-date"><?php echo get_the_date('d/m/Y')?></span>
                <h3 class="post-item-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                <p><?php arlene_new_excerpt_length(140,' [...]');?></p> <a href="<?php the_permalink();?>" class="small button post-item-buttom radius"><?php _e('Read more','arlene')?></a>
            </div>
        </div>
</li> 