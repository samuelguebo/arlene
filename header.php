<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Arlene
 */

?><!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php 
    if( false === get_option( 'site_icon', false ) ) {
    // Show favicon
        wp_site_icon(); 
    }
    ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <section id ="boxed-wrapper">
        <section class= "fixed-header">
            <header class="background-white">
                <div class="row clearfix">
                    <?php if(has_custom_logo()):?>
                    <div class="small-3 large-2 columns logo">
                        <a href="<?php echo site_url(); ?>">  
                            <?php the_custom_logo();?>
                        </a>
                    </div>
                    <?php else:?>
                    <div class="small-3 large-2 columns">
                        <h2 class="site-title">
                            <a href="<?php echo site_url(); ?>"><?php bloginfo('title'); ?></a>
                        </h2>
                    </div>
                    <?php endif;?>
                    <div class="nav-wrapper large-9 medium-8 columns">
                        <?php get_template_part('menu'); ?>
                    </div><!--/nav-wrapper-->   
                    <div class="socials small-4 large-1 medium-2 columns socials medium-uncentered small-centered large-uncentered ">
                        <ul class="right">
                            <?php get_template_part('menu', 'social'); ?>
                        </ul>

                    </div><!--socials/-->
                </div>
            </header>
        </section>