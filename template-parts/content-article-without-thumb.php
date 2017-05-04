<?php
/*
================================================================================================
Template part for displaying articles in loop
================================================================================================
@package        Arlene
@link           https://codex.wordpress.org/The_Loop
@copyright      Copyright (C) 2017. Samuel Guebo
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Samuel Guebo (http://samuelguebo.co/)
================================================================================================
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
    <!--post/-->
    <div class="post-item-caption">        
        <div class="panel">
            <span class="post-item-date wrap"><?php echo get_the_date('d/m/Y')?></span>
            <h6 class="post-item-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h6>
            <p><?php the_excerpt();?></p> 
            <a href="<?php the_permalink();?>" class="small button post-item-buttom"><?php _e('Read more','arlene')?></a> 
            <?php if ( get_edit_post_link() ) : ?>
                <a href="<?php echo get_edit_post_link();?>" class="small button alert"><i class="fa fa-edit"></i> <?php _e('Edit','arlene')?></a> 
                    
            <?php endif; ?>
        </div>
    </div>
</article>


