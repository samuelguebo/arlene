<?php
/*
================================================================================================
The template for displaying the footer. It contains the closing of the body all content 
after and containing the bottom widget area
================================================================================================
@package        Arlene
@link           https://developer.wordpress.org/themes/basics/template-files/#template-partials
@copyright      Copyright (C) 2017. Samuel Guebo
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Samuel Guebo (http://samuelguebo.co/)
================================================================================================
*/
?>
    <footer id="footer">
        <div class="row">
                <div class="medium-6 large-6 columns">
                    <p class="copyright"><?php _e('Developed by ','arlene')?>Samuel Guebo.<br><a href="<?php echo esc_url( __( 'https://wordpress.org/', 'arlene' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'arlene' ), 'WordPress' ); ?></a> <?php _e('and available on','arlene')?> <a href="https://github.com/samuelguebo/arlene"><i class="fa fa-github"></i> Github</a></p>
                </div>
                <div class="medium-4 large-4 columns">
                        <?php get_search_form(); ?>
                </div>
                <div class="medium-2 large-2 columns socials right">
                        <?php get_template_part('menu', 'social'); ?>
                </div>
        </div><!-- copyright-->

    </footer>
    <?php wp_footer(); ?>
</section><!-- .boxed-wrapper-->
</body>

</html>