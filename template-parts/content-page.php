<?php
/*
================================================================================================
Template part for displaying content in loop
================================================================================================
@package        Arlene
@link           @link https://codex.wordpress.org/The_Loop
@copyright      Copyright (C) 2017. Samuel Guebo
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Samuel Guebo (http://samuelguebo.co/)
================================================================================================
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
    <!--post/-->
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
                    <?php global $numpages;
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