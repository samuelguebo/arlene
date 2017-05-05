<?php
/*
================================================================================================
Template part for displaying articles in loop
================================================================================================
@package        Arlene
@link           https://codex.wordpress.org/The_Loop
@copyright      Copyright (C) 2017. Samuel Guebo
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Samuel Guebo (https://samuelguebo.co/)
================================================================================================
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
    <div class="post-item-caption">
        <?php if ( has_post_thumbnail() ):?>
            <div class="post-item-image"> 
                <?php the_post_thumbnail( 'single-thumb',array('class' =>'delay placeholder') );?>
    
            </div>        
        <?php endif;?>
        
        <?php if(is_single()): global $numpages; ?>
            <div class="panel">
                <div class="post-content">
                    <?php if(is_singular('post')):?>
                        <span class="post-item-date"><?php echo get_the_date('d/m/Y')?> / <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span><br><!--date/-->
                    <?php endif;?>
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
                <?php if(is_single('post')):?>
                    <div class="post-categories breadcrumbs">
                        <?php $categories = get_the_category();
                            if ( $categories ): ?>
                                <span><?php _e('categories','arlene');?></span>
                                <?php foreach($categories as $cat):
                                    echo '<span><a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a></span>';
                                endforeach;
                            endif;
                        ?>
                    </div><!-- .post-categories -->
                    <div class="post-tags breadcrumbs">
                        <?php $tags = get_the_tags(get_the_ID());
                            if ( $tags ): ?>
                                <span><?php _e('tags','arlene');?></span>
                                <?php foreach($tags as $tag):
                                    echo '<span><a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a></span>';
                                endforeach;
                            endif;
                        ?>
                    </div><!-- .post-tags -->
                
                <div class="panel post-item-author row reveal">
                    <div class="medium-4 large-3 columns"> <?php echo get_avatar( get_the_author_meta('ID'), 120 ); ?> </div>
                    <div class="medium-8 large-9 columns">
                        <h3><?php _e('About the author','arlene'); ?></h3>
                        <div><?php echo nl2br(get_the_author_meta('description')); ?></div>
                    </div>
                </div><!-- gravatar -->
                <?php endif;?>
            </div>
        <?php endif;?>
    </div>
</article>
<?php 
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() && !post_password_required())  :?>
    <article class="post-item comment-wrapper">
        <div class="panel">
            <?php comments_template();?>
        </div>
    </article>
<?php endif;?>