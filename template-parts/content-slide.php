<?php
/*
================================================================================================
Template part for displaying articles in the Slider loop
================================================================================================
@package        Arlene
@link https://codex.wordpress.org/The_Loop
@copyright      Copyright (C) 2017. Samuel Guebo
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Samuel Guebo (http://samuelguebo.co/)
================================================================================================
*/
?>



<li class="post-item">
    <?php the_post_thumbnail( 'slider-cover' , array('class'=>'responsive delay')); ?>
        <div class="large-4 small-10 medium-7 columns slider-caption post-item-caption">
            <div class="panel">
                <span class="post-item-date"><?php echo get_the_date('d/m/Y')?></span>
                <h3 class="post-item-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                <p><?php arlene_new_excerpt_length(140,' [...]');?></p> <a href="<?php the_permalink();?>" class="small button post-item-buttom radius"><?php _e('Read more','arlene')?></a>
            </div>
        </div>
    <div class="clearfix"></div>
</li> 