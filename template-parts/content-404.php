<?php
/**
 * Template part for displaying 404 error message
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
        <div class="post-list columns">
            <h4><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'arlene' ); ?></h4>

        </div>

        <div class="post-list not-found columns">
            <ol>
            <?php $lostposts = get_posts("numberposts=50&suppress_filters=0");
                if ( $lostposts ): ?>
                    <?php foreach($lostposts as $lostpost):
                        echo '<li class="large-4 columns"><a href="'.$lostpost->guid.'">'.$lostpost->post_title.'</a></li>';
                    endforeach;
                endif;
            ?>
            </ol>
        </div>
    </div>
</article>
