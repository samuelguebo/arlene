<?php
/*
================================================================================================
The template for displaying the menu. It contains the menu items
================================================================================================
@package        Arlene
@link           https://codex.wordpress.org/The_Loop
@copyright      Copyright (C) 2017. Samuel Guebo
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Samuel Guebo (http://samuelguebo.co/)
================================================================================================
*/
?>
    <nav class="top-bar" data-topbar >
        <ul class="title-area">
            <li class="name">
                 </li>
            <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
        </ul>
        <section class="top-bar-section">
            <?php
                /* Primary menu */
                if(function_exists('wp_nav_menu')) {
                    wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => '',
                    'container_class' => '',
                    'container_id' => '',
                    'menu_id' => 'main-menu',
                    'menu_class' => 'main-nav',
                    'fallback_cb' => '',
                    'walker' => new Multilevel_Menu()
                    )); 
                }
            ?>
        </section><!--/top-bar-section-->
    </nav><!--/top-bar-->
