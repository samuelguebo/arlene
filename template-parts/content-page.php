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
    <br>
    <div class="post-item-caption">
        <?php if ( has_post_thumbnail() ):?>
            <div class="post-item-image"> 
                <?php the_post_thumbnail( 'single-thumb',array('class' =>'delay placeholder') );?>
            </div>        
        <?php endif;?>
            <div class="panel">
                <div class="post-content">
                    <?php the_content();?> 
                </div>
                <div class="post-pagination clearfix">
                    <?php
                    if ( is_singular() && $numpages > 1 ):?>
                        <div class="pagination-wrapper" >
                            <?php wp_link_pages();?> 
                        </div>
                        <?php 
                    endif;?>
                </div>
            </div>
    </div>
</article>
<?php 
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :?>
    <article class="post-item comment-wrapper">
        <div class="panel">
            <?php comments_template();?>
        </div>
    </article>
<?php endif;?>