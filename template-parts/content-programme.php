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
            
            <?php $free = get_field('free',$post->ID);
            if($free!=""):?>
                <?php if($free==='true'):?>
                    <a href="<?php the_permalink();?>" class="small button green"><i class="fa fa-bar-chart"></i> <?php _e('Consulter','arlene')?></a> 
                    <span class="small button navy">
                        <?php _e('Gratuit','arlene')?>
                    </span> 
                <?php else:?>
                 <a href="<?php the_permalink();?>" class="small button blue"><i class="fa fa-shopping-cart"></i> <?php _e('Commander','arlene')?></a> 
                <span class="small button red">
                    <?php _e('Payant','arlene')?>
                </span> 
                    <?php endif;
            else:?>
                <a href="<?php the_permalink();?>" class="small button blue"><?php _e('Read more','arlene')?></a>      
            <?php endif;?>
        </div>
    </div>
</article>
