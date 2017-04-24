<?php
/**
 * Template part for displaying articles in loop
 *
 * @link https://codex.wordpress.org/The_Loop
 *
 * @package Arlene
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
            <p><?php echo arlene_new_excerpt_length(100);?></p> 
        
            <a href="<?php the_permalink();?>" class="small button"><?php _e('Read more','arlene')?></a>    
        </div>
    </div>
</article>
