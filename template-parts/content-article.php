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
        <div class="post-item-image"> 
            <?php
                if ( has_post_thumbnail_or_image ()) { 
                    the_post_thumbnail( 'post-thumb' ); 
                }
            ?>

        </div>
        <div class="panel">
            <h6 class="post-item-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h6>
            <span class="post-item-date"><?php echo get_the_date('d/m/Y')?></span><br><!--date/-->
            <p><?php echo arlene_new_excerpt_length(100);?></p> 
        
            <a href="<?php the_permalink();?>" class="small button"><?php _e('Read more','arlene')?></a>    
        </div>
    </div>
</article>
